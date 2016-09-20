<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Book]].
 *
 * @see Book
 */
class BookQuery extends \yii\db\ActiveQuery {

    /**
     * Get books authored by this person
     * @return Book[]|array
     */
    public function otherBooks($authorFk, $bookId) {
        return $this->andWhere(['authorFk' => $authorFk])->andWhere(['!=', 'id', $bookId]);
    }

    /**
     * @inheritdoc
     * @return Book[]|array
     */
    public function all($db = null) {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Book|array|null
     */
    public function one($db = null) {
        return parent::one($db);
    }

}
