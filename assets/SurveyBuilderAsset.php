<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SurveyBuilderAsset extends AssetBundle
{
    public $basePath = '@webroot/survey-builder';
    public $baseUrl = '@web/survey-builder';
    public $css = [
        'survey_builder.css',
    ];
    public $js = [
        'vendor/lodash.min.js',
        'build.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'Zelenin\yii\SemanticUI\assets\SemanticUICSSAsset'
    ];
}
