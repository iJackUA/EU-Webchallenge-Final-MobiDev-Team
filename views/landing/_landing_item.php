<a href="/<?= $model->slug ?>" target="_blank"> <?= $model->title ?> </a>
<img src="/templates/<?= $model->template_id ?>/preview.jpg" width="50" height="50" alt="..." class="img-circle pull-right">
<a href="/landing/edit/<?= $model->id ?>" class="btn btn-primary pull-right" target="_blank"> Edit </a>
<a href="/landing/delete/<?= $model->id ?>" class="btn btn-danger pull-right" data-method="post"> Delete </a>

