<?php
/* @var $this yii\web\View */
/* @var $landing app\models\gii\Landing */

$this->title = $landing->title;
?>
<h1><?= $landing->title ?></h1>

<p>
    <a href="/l/<?= $landing->slug ?>" class="btn btn-primary" role="button" target="_blank">Preview</a>
</p>
