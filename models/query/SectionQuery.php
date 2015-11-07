<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\gii\Section]].
 *
 * @see \app\models\gii\Section
 */
class SectionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\gii\Section[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\gii\Section|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
