<?php

namespace app\components;

use yii\filters\AccessControl;

trait AdminBehavior
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['Administrator'],
                    ]
                ],
            ],
        ];
    }
}
