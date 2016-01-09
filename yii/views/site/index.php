<div class="center-list">
    <?php
    \yii\widgets\Pjax::begin(['enablePushState' => false]);
    echo \yii\grid\GridView::widget([
        'layout' => '{items}{pager}',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'columns' => [
            [
                'attribute' => 'filter',
                'format' => 'raw',
                'label' => t('more recent request in {date}', ['date' => date('d/m/Y')]),
                'value' => function($request)
                {
                    return
                        \yii\helpers\Html::tag('div',join('',[
                                "<span class=\"badge pull-right\" title=\"".t('quantity')."\">{$request->quantity}</span>",
                                "<h4 class=\"list-group-item-heading\">{$request->client->name}</h4>",
                                "{$request->description} - {$request->price}",
                                \yii\helpers\Html::tag('div', \app\widgets\MyLabels::widget(['model' => $request, 'type' => 'situation']), ['class' => 'pull-right']),
                                \yii\helpers\Html::a(' '.t('see more...'), ["/request/{$request->id}"])
                            ])
                        );
                }
            ]
        ],
    ]);
    \yii\widgets\Pjax::end();
    ?>
</div>