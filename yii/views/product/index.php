<?php
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \app\widgets\MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'description',
            'cost',
            [
                'attribute' => 'size',
                'format'=>'raw',
                'filter' => dropDownList('size', $searchModel),
                'value' => function($data)
                {
                    return \app\widgets\MyLabels::widget(["model" => $data, 'type' => 'size']);
                }
            ],
        ],
    ]);
    \yii\widgets\Pjax::end();