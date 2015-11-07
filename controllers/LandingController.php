<?php

namespace app\controllers;

class LandingController extends \yii\web\Controller
{
    public function actionShow()
    {
        return $this->render('show');
    }

    public function actionEdit()
    {
        return $this->render('edit');
    }
}
