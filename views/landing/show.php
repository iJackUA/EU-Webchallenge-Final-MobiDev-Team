<?php
/* @var $this yii\web\View */
/* @var $landing app\models\gii\Landing */

$landing_code = file_get_contents(Yii::getAlias('@app').'/web/templates/'.$landing->template_id.'/index.html');
$landing_code = str_replace('###TEMPLATE_ID###',$landing->template_id,$landing_code);


echo $landing_code;
?>
