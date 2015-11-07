<?php

namespace app\controllers;

use app\models\gii\Landing;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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

    public function actionShow($id)
    {
        return $this->render('show');
    }

    public function actionEdit($id)
    {
        $landing = $this->findModel($id);

        return $this->render('edit', [
            'landing' => $landing
        ]);
    }

    public function actionCreate($templateId)
    {
        $landing = $this->createNewLanding(Yii::$app->getUser()->getId(), $templateId);

        return $this->redirect('/landing/edit/' . $landing->slug);
    }

    protected function findModel($id)
    {
        if (($model = Landing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function createNewLanding($userId, $templateId) {
        $landing = new Landing();
        $landing->user_id = $userId;
        $landing->template_id = $templateId;
        $landing->title = 'Landing ';
        $landing->slug = 'landing';
        $landing->save();
        $landing->slug = $landing->slug.$landing->id;
        $landing->title = $landing->title.$landing->id;
        $landing->save();
        return $landing;
    }
}
