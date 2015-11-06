<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\gii\UserGii]].
 *
 * @see \app\models\gii\UserGii
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\models\gii\UserGii[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\gii\UserGii|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}