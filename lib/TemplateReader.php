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

    static function getSectionTplId($sectionName)
    {
        switch ($sectionName) {
            case 'heading':
                return 1;
                break;
            case 'contacts':
                return 4;
                break;
            case 'services':
                return 2;
                break;
            case 'gallery':
                return 3;
                break;
        }
    }
}
