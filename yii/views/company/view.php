<?php
    echo \yii\helpers\Html::tag('div',
        join('', [
            \yii\widgets\DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'cnpj',
                    'address',
                    [
                        'label' => t('link'),
                        'value' => join(' à ', [
                            $model->start_date==""?t("no informed"):$model->start_date,
                            $model->end_date==""?t("no informed"):$model->end_date
                        ])
                    ],
                    'phone',
                    'email:email',
                    [
                        'label' => t('status'),
                        'format' => 'raw',
                        'value' => \app\widgets\MyLabels::widget(["model" => $model,"type"=>"status"])
                    ],
                    'changes'
                ],
            ]),
            \app\widgets\MyButtons::widget([ "model" => $model ])
        ]), ['class' => 'border-side-bottom content content-large']);