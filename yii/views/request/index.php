<?php
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \app\widgets\MyGridView::widget([
        'enabledStatus' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'deliveryman_id',
                'filter' => $searchModel->arrayListModel(\app\models\Deliveryman::class),
                'value' => function($data){
                    return $data->deliveryman->name;
                }
            ],
            [
                'attribute' => 'client_id',
                'filter' => $searchModel->arrayListModel(\app\models\Client::class),
                'value' => function($data){
                    return $data->client->name;
                }
            ],
            'description',
            'totalValue',
            [
                'attribute' => 'request_date',
                'filter' => \dosamigos\datepicker\DatePicker::widget(viewOption(['model' =>$searchModel, 'attribute' => 'request_date'], 'datepicker'))
            ],
            [
                'attribute' => 'situation',
                'format'=>'raw',
                'filter' => dropDownList('situation',$searchModel),
                'value' => function($data)
                {
                    return \app\widgets\MyLabels::widget(["model" => $data,"type"=>"situation"]);
                }
            ],
        ],
    ]);
    \yii\widgets\Pjax::end();