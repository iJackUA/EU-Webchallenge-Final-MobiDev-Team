<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "template".
 *
 * @property integer $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
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
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return TemplateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TemplateQuery(get_called_class());
    }
}
