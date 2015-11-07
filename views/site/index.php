<?php

/* @var $this yii\web\View */

$this->title = 'Awesome Landing Creator';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to Awesome Landing Creator!</h1>
        <p>Below are our BEST templates FOR YOU!</p>
    </div>

    <div class="row">
        <?php foreach ($templates as $template){ ?>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="/templates/<?= $template->id ?>/preview.jpg" alt="...">
                    <div class="caption">
                        <h3><?= $template->title; ?></h3>
                        <p><a href="#" class="btn btn-primary" role="button">Start</a></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
