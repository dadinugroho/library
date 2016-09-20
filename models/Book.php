<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $publisher
 * @property string $isbn
 * @property string $published_date
 * @property integer $authorFk
 * @property integer $status
 */
class Book extends \yii\db\ActiveRecord {

    public $authorFullName;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'publisher', 'isbn', 'published_date', 'authorFk', 'status'], 'required'],
            [['description'], 'string'],
            [['published_date'], 'safe'],
            [['authorFk', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['publisher'], 'string', 'max' => 50],
            [['isbn'], 'string', 'max' => 10],
            [['authorFk'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['authorFk' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'publisher' => Yii::t('app', 'Publisher'),
            'isbn' => Yii::t('app', 'ISBN'),
            'published_date' => Yii::t('app', 'Published date'),
            'authorFk' => Yii::t('app', 'Author'),
            'authorFullName' => Yii::t('app', 'Author'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return BookQuery the active query used by this AR class.
     */
    public static function find() {
        return new BookQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor() {
        return $this->hasOne(Author::className(), ['id' => 'authorFk']);
    }

}
