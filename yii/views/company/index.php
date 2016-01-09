<?php
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \app\widgets\MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'cnpj',
            'address',
            'phone',
            'email:email',
        ],
    ]);
    \yii\widgets\Pjax::end();