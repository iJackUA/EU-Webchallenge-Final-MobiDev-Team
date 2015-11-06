<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
                      'brandLabel' => 'Admin Panel',
                      'brandUrl' => ['/admin'],
                      'options' => [
                          'class' => 'navbar-inverse navbar-fixed-top',
                      ],
                  ]);
    echo Nav::widget([
                         'options' => ['class' => 'navbar-nav navbar-right'],
                         'items' => [
                             [
                                 'label' => 'Go Back to Site',
                                 'url' => ['/'],
                             ],
                             [
                                 'label' => 'Manage Users',
                                 'url' => ['/user/admin'],
                             ],
                             -
                             Yii::$app->user->isGuest ?
                                 ['label' => 'Login', 'url' => ['/user/login']] :
                                 [
                                     'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                     'url' => ['/user/security/logout'],
                                     'linkOptions' => ['data-method' => 'post']
                                 ],
                         ],
                     ]);
    NavBar::end();
    ?>

    <div class="ui container">
        <?= $content ?>
    </div>

    <div class="ui inverted vertical footer segment form-page">
        <div class="ui container">
            <p class="pull-right">&copy; <a href="http://mobidev.biz/" target="_blank">MobiDev</a> for EuWeb
                Challenge <?= date('Y') ?></p>
        </div>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
