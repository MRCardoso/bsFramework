<?php
/*
 | ----------------------------------------------------------------------------------
 | Widget for buttons
 | ----------------------------------------------------------------------------------
 | generate the button according the interface access
 | *validate permission of the show the button(need implement)
 |
 */
namespace app\widgets;

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;

class MyButtons extends Widget
{
    /**
     * current controller access
     * @var
     */
    public $module;
    /**
     * the model class
     * @var
     */
    public $model;
    /**
     * the template for buttons
     * @var array
     */
    public $template = [
        "save" => ["back","save"],
        "view" => ["back","update","delete","create"]
    ];
    /**
     * @var int
     */
    public $tabIndex;
    /**
     * @var
     */
    public $buttons = [];

    public function init()
    {
        parent::init();
        if( $this->model == NULL )
            throw new InvalidConfigException('Please specify the "model" property.');
    }
    public function run()
    {
        return Html::tag('div',
            Html::tag('div',
                join('', $this->findButton()),
                ['class' => 'text-right']
            ),
            ['class' => 'button-group']
        );
    }

    /**
     * generate the button according the interface current
     *
     * @return array
     */
    private function findButton()
    {
        $buttons = [];
        $options = \Yii::$app->request->pathInfo;

        if( $this->module == NULL )
            $this->module = explode('/', $options)[0];
        if( !empty($this->buttons))
        {
            foreach($this->buttons as $action)
                $buttons[] = $this->{$action."Button"}();
        }
        elseif( preg_match("/(create|update)/", $options) )
        {
            foreach($this->template["save"] as $action)
                $buttons[] = $this->{$action."Button"}();
        }
        elseif( preg_match("/\/[0-9]/", $options) )
        {

            foreach($this->template["view"] as $action)
                $buttons[] = $this->{$action."Button"}();
        }
        elseif($options == "signup")
        {
            $this->module='';
            foreach($this->template["save"] as $action)
                $buttons[] = $this->{$action."Button"}();
        }
        return $buttons;
    }
    /**
     * generate link for delete record
     * @return string
     */
    private function deleteButton()
    {
        if( !permission($this->model, 'interface') )
            return '';
        return Html::a(t('delete'), ['delete', 'id' => $this->model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ]
        ]);
    }
    /**
     * generate link go to page of the edit record
     * @return string
     */
    private function updateButton()
    {
        if( !permission($this->model, 'interface') )
            return '';
        return Html::a(t('update'), ['update', 'id' => $this->model->id], ['class' => 'btn btn-primary']);
    }
    /**
     * generate link go to page of the new record
     * @return string
     */
    private function createButton()
    {
        if( !permission($this->model, 'newButton') )
            return '';
        return Html::a(t('new'),["/{$this->module}/create"], ['class' => 'btn mrc-btn-light']);
    }
    /**
     * generate button for submit the form
     *
     * @return string
     */
    private function saveButton()
    {
        return Html::submitButton(t('save'), ['class' => 'btn mrc-btn-light']);
    }
    /**
     * generate link to back page
     *
     * @return string
     */
    private function backButton()
    {
        return Html::a(t('back'),["/{$this->module}"], ['class' => 'btn btn-default']);
    }

    /**
     * generate link to next tab
     *
     * @return string
     */
    private function nextTabButton()
    {
        return Html::a(t('next'),'#', [
            'class' => 'btn btn-primary next-tab',
            'data-id' => $this->tabIndex+1
        ]);
    }

    /**
     * generate link to prev tab
     *
     * @return string
     */
    private function prevTabButton()
    {
        return Html::a(t('prev'),'', [
            'class' => 'btn btn-default prev-tab',
            'data-id' => $this->tabIndex-1
        ]);
    }
}