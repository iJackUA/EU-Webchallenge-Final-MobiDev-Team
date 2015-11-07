<?php
namespace app\lib;


class TemplateReader
{
    static function getEditSectionFor($tplId, $sectionName)
    {
        $path = \Yii::getAlias('@webroot') . "/templates/{$tplId}/edit-sections/{$sectionName}.html";
        return file_get_contents($path);
    }

    static function getSectionFor($tplId, $sectionName)
    {
        $path = \Yii::getAlias('@webroot') . "/templates/{$tplId}/sections/{$sectionName}.html";
        return file_get_contents($path);
    }
}
