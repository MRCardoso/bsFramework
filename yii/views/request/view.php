<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
$products=["<div class=\"list-group\">"];
foreach ($model->productRequests as $productRequest) {
    $products[] = "<div class=\"list-group-item\">
            {$productRequest->quantity}  - {$productRequest->product->name}, Custo R$ ".number_format($productRequest->price,2,',','.')."
            <div class=\"pull-right\">
                ".\app\widgets\MyLabels::widget(["model" => $productRequest->product, "type" => "size"])."
            </div>

     </div>";
}

$products[]="</div>";
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
                    'label' => t('products'),
                    'content' => join('', $products),
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