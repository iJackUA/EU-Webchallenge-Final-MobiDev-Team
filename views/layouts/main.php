<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'MobiDev Surveys',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
                [
                    'label' => 'Login',
                    'url' => ['/user/login'],
                    'visible' => Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Admin Panel',
                    'url' => ['/admin'],
                    'visible' => Yii::$app->user->can('Administrator')
                ],
                [
                    'label' => 'My Surveys',
                    'url' => ['/survey/index'],
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'My Profile',
                    'url' => ['/user/settings/profile'],
                    'visible' => !Yii::$app->user->isGuest
                ],
                [
                    'label' => 'Logout (' . ((!Yii::$app->user->isGuest) ? Yii::$app->user->identity->username : '') . ')',
                    'url' => ['/user/logout'],
                    'linkOptions' => ['data-method' => 'post'],
                    'visible' => !Yii::$app->user->isGuest
                ],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<div class="ui inverted vertical footer segment form-page">
    <div class="ui container">
        <p class="pull-right">&copy;
            <a href="https://github.com/iJackUA">Ievgen Kuzminov</a> &bullet;
            <a href="https://github.com/sergey-koba-mobidev">Sergey Koba</a> &bullet;
            <a href="https://github.com/VictorGub">Viktor Gubochkin</a> for EU Web Challenge 2015</p>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
