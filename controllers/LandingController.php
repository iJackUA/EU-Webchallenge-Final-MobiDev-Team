<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

class LandingController extends Controller
{
    public function behaviors()
    {
        return array_merge_recursive(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['edit', 'create', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ]
        ]);
    }

    public function actionShow()
    {
        return $this->render('show');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }
}
