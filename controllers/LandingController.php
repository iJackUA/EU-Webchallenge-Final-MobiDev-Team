<?php

namespace app\controllers;

use app\models\gii\Landing;
use app\models\gii\SectionTemplate;
use app\models\gii\Section;
use app\transformers\SectionTransformer;
use app\models\SearchLanding;
use app\lib\TemplateReader;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
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
                'only' => ['edit', 'create', 'delete', 'index'],
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

    public function actionIndex()
    {
        $userId = Yii::$app->getUser()->getId();
        $searchModel = new SearchLanding();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $userId);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        $sectionItems = new Fractal\Resource\Collection($landing->sections, new SectionTransformer);

        $landingItem = new Fractal\Resource\Item($landing, function (Landing $landing) use ($fractal, $sectionItems) {
            return [
                'title' => $landing->title,
                'slug' => $landing->slug,
                'currentSection' => null,
                'sections' => $fractal->createData($sectionItems)->toArray()
            ];
        });

        $this->registerGonTemplates($landing->template_id);
        Yii::$app->gon->send('landing', $fractal->createData($landingItem)->toArray());
        Yii::$app->gon->send('saveUrl', Url::to(['/landing/save-update', 'id' => $id]));

        return $this->render('edit', [
            'landing' => $landing
        ]);
    }

    public function actionSaveUpdate($id)
    {
        $landing = $this->findModel($id);

        $title = Yii::$app->request->getBodyParam('title');
        $slug = Yii::$app->request->getBodyParam('slug');
        $landing->title = $title;
        $landing->slug = $slug;

        if ($landing->save()) {
            Section::deleteAll(['landing_id' => $landing->id]);
            $sections = Yii::$app->request->getBodyParam('sections');
            if (!empty($sections)) {
                foreach ($sections as $section) {
                    $s = new Section();
                    $s->landing_id = $landing->id;
                    $s->section_template_id = TemplateReader::getSectionTplId($section['type']);
                    $s->meta = json_encode($section['meta']);
                    $s->save();
                }
            }
        } else {
            throw new Exception('Can not save Landing page. Failed validation.');
        }

    }

    public function actionCreate($templateId)
    {
        $landing = $this->createNewLanding(Yii::$app->getUser()->getId(), $templateId);

        return $this->redirect('/landing/edit/' . $landing->id);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();;

        return $this->redirect('/landing/index');
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

        foreach ($sectionTemplates as $sectionTemplate) {
            $section = new Section();
            $section->section_template_id = $sectionTemplate->id;
            $section->landing_id = $landing->id;
            $section->save();
        }

        return $landing;
    }

    protected function registerGonTemplates($landingTplId)
    {
        $templates = [
            'contacts' => TemplateReader::getEditSectionFor($landingTplId, 'contacts'),
            'gallery' => TemplateReader::getEditSectionFor($landingTplId, 'gallery'),
            'heading' => TemplateReader::getEditSectionFor($landingTplId, 'heading'),
            'services' => TemplateReader::getEditSectionFor($landingTplId, 'services'),
        ];

        \Yii::$app->gon->send('templates', $templates);
    }
}
