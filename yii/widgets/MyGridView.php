<?php
namespace app\widgets;


use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

class MyGridView extends GridView
{
    public $myButtons = [];
    public $withoutActions = false;
    public $contentGrid = '';
    public $enabledStatus = true;

    public function init()
    {
        $this->getProperties();
        parent::init();
    }
    private function getProperties()
    {
        $this->layout = $this->myLayout();
        $this->validateColumns();
    }
    private function myLayout()
    {
        $newButton = '';
        if( permission(NULL,'newButton') )
            $newButton = Html::tag('div', Html::a(t('new'), ['create'], ['class' => 'btn mrc-btn-light']),['class' => 'pull-right']);

        return Html::tag('div', join('', [
            Html::tag('div',
                join('', [
                    Html::tag('div', "{summary}",['class' => 'btn pull-left']),
                    $newButton,
                    Html::tag('div', "",['class' => 'clear']),
                ]),
                ['class' => 'template-head']
            ),
            "{items}",
            Html::tag('div', "{pager}",['class' => 'template-foot text-right'])
        ]));
    }
    private function getButtons()
    {
        return array_merge([
            'class' => ActionColumn::class,
            'header'=> t('Actions'),
            'contentOptions' => ['width' => '9%'],
            'buttons'=> [
                'update' => function($url, $model)
                {
                    if( permission($model, "interface") )
                    {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                            'title' => t('update'),
                            'class' => 'remove-link label label-primary'
                        ]);
                    }
                },
                'delete'=> function($url, $model)
                {
                    if( permission($model, "interface") )
                    {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                            'title' => t('delete'),
                            'class' => 'remove-link label label-danger',
                            'data-confirm' => t('you_sure_you_want_to_delete_this_record'),
                            'data-method' => 'post'
                        ]);
                    }
                },
                'view'=> function($url, $model)
                {
                    if( permission($model, "interface") )
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                            'title' => t('view'),
                            'class' => 'remove-link label label-warning'
                        ]);
                    }
                }
            ]
        ], $this->myButtons);
    }
    private function validateColumns()
    {
        if ( $this->enabledStatus )
        {
            array_push($this->columns, [
                'attribute' => 'status',
                'format'=>'raw',
                'filter' => dropDownList('status', $this->filterModel),
                'value' => function($data)
                {
                    return MyLabels::widget(["model" => $data,"type"=>"status"]);
                }
            ]);
        }
        array_push($this->columns,$this->getButtons());
    }
}