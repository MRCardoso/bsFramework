<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

echo Html::tag('div',
    join('',[
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'description',
                'cost:decimal',
                [
                    'label' => t('size'),
                    'format' => 'raw',
                    'value' => \app\widgets\MyLabels::widget(["model" => $model,"type"=>"size"])
                ],
                [
                    'label' => t('status'),
                    'format' => 'raw',
                    'value' => \app\widgets\MyLabels::widget(["model" => $model,"type"=>"status"])
                ],
                'changes'
            ],
        ]),
        \app\widgets\MyButtons::widget(['model' => $model])
    ]),
    ['class' => 'border-side-bottom content content-large']
);