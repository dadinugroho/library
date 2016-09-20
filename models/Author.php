<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property integer $status
 */
class Author extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['firstname', 'lastname', 'status'], 'required'],
            [['status'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'fullName' => Yii::t('app', 'Fullname'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @inheritdoc
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find() {
        return new AuthorQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks() {
        return $this->hasMany(Book::className(), ['authorFk' => 'id']);
    }

    /**
     * Get full name
     * @return String(firstname + lastname)
     */
    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }

}
