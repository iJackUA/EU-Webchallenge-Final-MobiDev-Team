<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\gii\Landing]].
 *
 * @see \app\models\gii\Landing
 */
class LandingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\gii\Landing[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\gii\Landing|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
