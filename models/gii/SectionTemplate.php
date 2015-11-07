<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "section_template".
 *
 * @property integer $id
 * @property string $title
 * @property integer $template_id
 * @property string $created_at
 * @property string $updated_at
 */
class SectionTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'template_id'], 'required'],
            [['title'], 'string'],
            [['template_id'], 'integer'],
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
            'template_id' => 'Template ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return SectionTemplateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SectionTemplateQuery(get_called_class());
    }
}
