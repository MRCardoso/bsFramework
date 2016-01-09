<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

echo Html::tag('div',
    join('', [
        \yii\bootstrap\Collapse::widget([
            'items' => [
                [
                    'label' => t('client'),
                    'content' => join('', [
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'client.name',
                                'client.phone',
                                'client.address',
                            ],
                        ]),
                    ]),
                ],
                [
                    'label' => t('product'),
                    'content' => join('', [
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'product.name',
                                'product.description',
                                [
                                    'attribute' => t('size'),
                                    'format' => 'raw',
                                    'value' => \app\widgets\MyLabels::widget(["model" => $model->product,"type"=>"size"])
                                ],
                            ],
                        ]),
                    ]),
                ],
                [
                    'label' => t('deliveryman'),
                    'content' => join('', [
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'deliveryman.name',
                                'deliveryman.cpf',
                                'deliveryman.rg',
                                'deliveryman.cellphone',
                            ],
                        ]),
                    ]),
                ],
                [
                    'label' => t('request'),
                    'content' => join('', [
                        DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'description',
                                'observation',
                                'request_date',
                                'quantity',
                                'price:decimal',
                                'freight:decimal',
                                'discount:decimal',
                                'totalValue',
                                [
                                    'attribute' => 'situation',
                                    'format' => 'raw',
                                    'value' => \app\widgets\MyLabels::widget(["model" => $model,"type"=>"situation"])
                                ],
                                'changes'
                            ],
                        ]),
                    ]),
                ],
            ]
        ]),
        \app\widgets\MyButtons::widget(['model' => $model])
    ]), ['class' => 'border-site-buttom content content-large']);