<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[Template]].
 *
 * @see Template
 */
class TemplateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Template[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Template|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
