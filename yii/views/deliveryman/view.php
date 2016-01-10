<?php
    echo \yii\helpers\Html::tag('div',
        join('',[
            yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' =>t('company'),
                    'value' => $model->company->name
                ],
                'name',
                'cpf',
                'rg',
                'cellphone',
                [
                    'label' => t('comission'),
                    'value' => join('',[
                        number_format($model->salary_value,2,',','.'),
                        ' - ',
                        \app\widgets\MyLabels::widget(['model' => $model, "type" => "salaryType"])
                        ])
                ],
                [
                    'label' => t('status'),
                    'format' => 'raw',
                    'value' => \app\widgets\MyLabels::widget(["model" => $model,"type"=>"status"])
                ],
                'changes'
            ],
        ]),
        \app\widgets\MyButtons::widget([ "model" => $model ])
    ]), ['class'=>'border-side-bottom content content-large']);