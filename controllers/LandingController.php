<?php

namespace app\controllers;

use app\models\gii\Landing;
use app\models\gii\SectionTemplate;
use app\models\gii\Section;
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
        $this->layout = 'landing';

        $landing = $this->findModelBySlug($id);

        return $this->render('show', [
            'landing' => $landing
        ]);
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

        return $this->redirect('/landing/edit/' . $landing->id);
    }

    protected function findModel($id)
    {
        if (($model = Landing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelBySlug($slug)
    {
        if (($model = Landing::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function createNewLanding($userId, $templateId)
    {
        $landing = new Landing();
        $landing->user_id = $userId;
        $landing->template_id = $templateId;
        $landing->title = 'Landing ';
        $landing->slug = 'landing';
        $landing->save();
        $landing->slug = $landing->slug . $landing->id;
        $landing->title = $landing->title . $landing->id;
        $landing->save();

        $sectionTemplates = SectionTemplate::find()->where(['template_id' => $templateId])->all();

        foreach($sectionTemplates as $sectionTemplate) {
            $section = new Section();
            $section->section_template_id = $sectionTemplate->id;
            $section->landing_id = $landing->id;
            $section->save();
        }

        return $landing;
    }
}
