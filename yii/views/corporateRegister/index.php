<?php
    echo \app\widgets\MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'code',
        ],
    ]);