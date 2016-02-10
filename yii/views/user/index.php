<?php
    $columns = [];
    if( checkGroup("admin") )
    {
        $user = new \app\models\User();
        $columns = [ [
            'attribute' => 'corporate_register_id',
            'filter' => $user->arrayCorporateRegister(false),
            'value'=> function($data){ return $data->corporateRegister->name; }
        ] ];
        unset($user);
    }
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \app\widgets\MyGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => array_merge($columns,[
            [
                'format' => 'raw',
                'value' => function($data){
                    return \yii\helpers\Html::img('http://www.gravatar.com/avatar/'.md5($data->email).'?s=20');
                }
            ],
            'name',
            'email:email',
            'username',
            [
                'attribute' => 'group',
                'value' => function($data){
                    return labelText('group', $data->group);
                }
            ],
        ])
    ]);
    \yii\widgets\Pjax::end();