<?php
namespace app\components;

use yii\base\Component;
use yii\helpers\Json;
use yii\web\View;

class GonComponent extends Component
{
    public $jsVariableName = 'gon';

    protected $data = [];

    public function __construct($config = [])
    {
        \Yii::$app->view->on(View::EVENT_BEFORE_RENDER, function () {
            $script = $this->gonScript();
            $defScript = "window.{$this->jsVariableName} = {};";
            if ($script !== '[]') {
                $script = "{$defScript} window.{$this->jsVariableName} = {$script};";
            } else {
                $script = $defScript;
            }
            \Yii::$app->view->registerJs($script, View::POS_HEAD);
        });

        parent::__construct($config);
    }

    /**
     * @param $name
     * @param $value
     */
    public function send($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function gonScript()
    {
        return Json::encode($this->data);
    }
}
