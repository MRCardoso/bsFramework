<?php
    use yii\widgets\DetailView;
    use app\widgets\MyButtons;

    echo \yii\helpers\Html::tag('div',
        join('',[
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'phone',
                'birthday',
                'address',
                'number',
                'neightborhood',
                'city',
                'reference',
                [
                    'label' => t('status'),
                    'format' => 'raw',
                    'value' => \app\widgets\MyLabels::widget(["model" => $model,"type"=>"status"])
                ],
                'changes'
            ],
        ]),
        MyButtons::widget([ "model" => $model ])
        ]), ['class'=>'border-side-bottom content content-large']);
