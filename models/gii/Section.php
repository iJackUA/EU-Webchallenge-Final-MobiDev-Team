<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property integer $landing_id
 * @property integer $section_template_id
 * @property string $meta
 * @property string $created_at
 * @property string $updated_at
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['landing_id', 'section_template_id'], 'required'],
            [['landing_id', 'section_template_id'], 'integer'],
            [['meta'], 'string'],
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
            'landing_id' => 'Landing ID',
            'section_template_id' => 'Section Template ID',
            'meta' => 'Meta',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\SectionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\SectionQuery(get_called_class());
    }
}
