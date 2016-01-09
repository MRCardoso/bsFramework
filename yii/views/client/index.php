<?php
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \app\widgets\MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'phone',
            [
                'attribute' => 'birthday',
                'contentOptions' => ['style'=>'width:20%'],
                'filter' => \dosamigos\datepicker\DatePicker::widget(viewOption(['model' =>$searchModel, 'attribute' => 'birthday'], 'datepicker'))
            ],
            [
                'attribute' => 'address',
                'value' => function($data)
                {
                    return "$data->address $data->number";
                }
            ],
        ],
    ]);
    \yii\widgets\Pjax::end();