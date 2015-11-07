<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "landing".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $template_id
 * @property integer $status
 * @property string $slug
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 * @property Array $sections
 */
class Landing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'landing';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'slug'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['slug'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\LandingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\LandingQuery(get_called_class());
    }

    public function getSections()
    {
        return $this->hasMany(Section::className(), ['landing_id' => 'id']);
    }
}
