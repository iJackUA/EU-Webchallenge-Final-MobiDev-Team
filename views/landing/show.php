<?php
/* @var $this yii\web\View */
/* @var $landing app\models\gii\Landing */

$landing_code = file_get_contents(Yii::getAlias('@app').'/web/templates/'.$landing->template_id.'/index.html');
$landing_code = str_replace('###TEMPLATE_ID###',$landing->template_id,$landing_code);

$contents = "";

foreach($landing->sections as $section) {
    $section_type = strtolower($section->sectionTemplate->title);
    $section_code = file_get_contents(Yii::getAlias('@app').'/web/templates/'.$landing->template_id.'/sections/'.$section_type.'.html');
    $metas = json_decode($section->meta, true);
    $searches = $replaces = [];
    foreach($metas as $key => $value) {
        switch ($section_type) {
            case 'services':
                $searches[] = '###HEADING###';
                $replaces[] = $metas['heading'];
                break;
            case 'gallery':
                $searches[] = '###HEADING###';
                $replaces[] = $metas['heading'];
                break;
            default:
                $searches[] = '###'.strtoupper($key).'###';
                $replaces[] = $value;
        }
    }
    $section_code = str_replace($searches, $replaces, $section_code);
    $contents .= $section_code;
}

$landing_code = str_replace('###CONTENT###',$contents,$landing_code);

echo $landing_code;
?>
