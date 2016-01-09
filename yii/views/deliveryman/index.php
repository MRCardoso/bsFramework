<?php
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \app\widgets\MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'company_id',
                'filter' => $searchModel->arrayListModel(\app\models\Company::class),
                'value' => function($data){
                    return $data->company->name;
                }
            ],
            'name',
            'cpf',
            'rg',
            'cellphone',
        ],
    ]);
    \yii\widgets\Pjax::end();