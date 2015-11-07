<?php
namespace lib;


class TemplateReader
{
    static function getEditSectionFor($tplId, $sectionName)
    {
        $path = Yii::getAlias('@web') . "/templates/{$tplId}/edit-sections/{$sectionName}.html";
        return file_get_contents($path);
    }

    static function getSectionFor($tplId, $sectionName)
    {
        $path = Yii::getAlias('@web') . "/templates/{$tplId}/sections/{$sectionName}.html";
        return file_get_contents($path);
    }
}
