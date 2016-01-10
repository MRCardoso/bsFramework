<?php
namespace app\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class MyLabels extends Widget
{
    public $model;

    public $type;

    private $arrayList = [];

    public function init()
    {
        parent::init();

        if( $this->model == NULL )
            throw new InvalidConfigException('Please specify the "model" property.');
        if( $this->type == NULL )
            throw new InvalidConfigException('Please specify the "type" property.');

        $this->arrayList = labelText();

        if( !isset($this->arrayList[$this->type]) )
            throw new InvalidConfigException('The "type" property not found.');

        $this->arrayList = $this->arrayList[$this->type];

    }
    public function run()
    {
        return $this->{$this->type."Label"}();
    }
    private function statusLabel()
    {
        $status = $this->model->status==NULL?0:$this->model->status;
        $arrayStatus = (Object) $this->arrayList[$status];
        return Html::tag('div', $arrayStatus->name ,['class'=> "label label-{$arrayStatus->class}"]);
    }
    private function situationLabel()
    {
        $situation = $this->model->situation==NULL?0:$this->model->situation;
        $arraySituation = (Object) $this->arrayList[$situation];
        return Html::tag('div', $arraySituation->name ,['class'=> "label label-{$arraySituation->class}"]);
    }
    private function sizeLabel()
    {
        $size = $this->model->size==NULL?0:$this->model->size;
        $arraySize = (Object) $this->arrayList[$size];
        return Html::tag('div', $arraySize->name ,['class'=> "label label-{$arraySize->class}"]);
    }
    private function salaryTypeLabel()
    {
        $salary_type = $this->model->salary_type==NULL?"":$this->model->salary_type;
        if( $salary_type != "")
        {
            $arraySize = (Object) $this->arrayList[$salary_type];
            return $arraySize->name;
        }
        return t("uninformed");
    }
}