<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'authorFk', 'status'], 'integer'],
            [['title', 'description', 'publisher', 'isbn', 'published_date', 'authorFullName'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Set sort on author full name
        $dataProvider->sort->attributes['authorFullName'] = [
            'asc' => ['author.firstname' => SORT_ASC, 'author.lastname' => SORT_ASC],
            'desc' => ['author.lastname' => SORT_DESC, 'author.lastname' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) {
            /**
             * The following line will allow eager loading with country data 
             * to enable sorting by country on initial loading of the grid.
             */
            $query->joinWith(['author']);
            return $dataProvider;
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'published_date' => $this->published_date,
            'authorFk' => $this->authorFk,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'description', $this->description])
                ->andFilterWhere(['like', 'publisher', $this->publisher])
                ->andFilterWhere(['like', 'isbn', $this->isbn]);

        // filter by author full name
        $query->joinWith(['author' => function ($q) {
                $q->where('author.firstname LIKE "%' . $this->authorFullName . '%" OR author.lastname LIKE "%' . $this->authorFullName . '%"');
            }]);

        return $dataProvider;
    }

}
