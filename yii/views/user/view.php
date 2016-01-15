<?php
    $employeeContent = '';
    if( $model->group == "company" )
    {
        $data =[];
        foreach ($model->employee as $employee)
            $data[] = \yii\helpers\Html::tag('div', "<strong>{$employee->name}</strong> - {$employee->email}",['class' => 'list-group-item']);
        $employeeContent = \yii\bootstrap\Collapse::widget([
            'items' => [
                [
                    'label' => t('employees'),
                    'content' => \yii\helpers\Html::tag('div', join('', $data),[ 'class' => ''])
                ]
            ]
        ]);
    }
    echo yii\helpers\Html::tag('div', join('', [
        yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'group',
                'email:email',
                'username',
                'changes'
            ],
        ]),
        $employeeContent,
        \app\widgets\MyButtons::widget(['model' => $model])
        ]),
        ['class' => 'border-side-buttom content content-large']
    );