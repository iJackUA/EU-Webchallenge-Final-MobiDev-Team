<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[SectionTemplate]].
 *
 * @see SectionTemplate
 */
class SectionTemplateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SectionTemplate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SectionTemplate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
