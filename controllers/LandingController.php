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
use League\Fractal;
use app\lib\ArraySerializer;

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

        $fractal = new Fractal\Manager();
        $fractal->setSerializer(new ArraySerializer());

        $sectionItems = new Fractal\Resource\Collection($landing->sections, function (Section $s) {
            return [
                'meta' => json_decode($s->meta),
                'landing_id' => $s->landing_id
            ];
        });

        /*$surveyItem = new Fractal\Resource\Item($survey, function (Survey $survey) use ($fractal, $questionItems) {
            return [
                'title' => $survey->title,
                'desc' => $survey->desc,
                'emails' => implode(', ', ArrayHelper::getColumn($survey->participants, 'email')),
                'startDate' => (new \DateTime($survey->startDate))->format("Y-m-d"),
                'sendDate' => (new \DateTime($survey->sendDate))->format("Y-m-d"),
                'expireDate' => (new \DateTime($survey->expireDate))->format("Y-m-d"),
                'questions' => $fractal->createData($questionItems)->toArray()
            ];
        });


        Yii::$app->gon->send('survey', $fractal->createData($surveyItem)->toArray());
        Yii::$app->gon->send('saveSurveyUrl', Url::to(['/survey/save-update', 'id' => $id]));
        Yii::$app->gon->send('afterSaveSurveyRedirectUrl', \Yii::$app->request->referrer);
         */

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
