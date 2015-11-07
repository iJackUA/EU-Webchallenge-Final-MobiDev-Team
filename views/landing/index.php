<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchLanding */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<h1>My Landings</h1>

<?= ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => 'ul',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'itemView' => '_landing_item',
        'itemOptions' => [
            'tag' => 'li',
            'class' => 'list-group-item landing-item',
        ],
        'pager' => [
            'firstPageLabel' => 'first',
            'lastPageLabel' => 'last',
            'nextPageLabel' => 'next',
            'prevPageLabel' => 'previous',
            'maxButtonCount' => 5,
        ],
    ]); ?>
