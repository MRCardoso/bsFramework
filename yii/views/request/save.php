<?php
use yii\widgets\ActiveForm;
?>
<div class="border-side-bottom content content-large">
    <div class="breadcrumb alert alert-dismissible" role="alert">
        Pedido: <strong id="desc-request"><?php echo $model->description==NULL?t('uninformed'):$model->description;?></strong>,<br>
        valor total: <span id="price-request">0,00</span>
    </div>
<?php
    $form = ActiveForm::begin(viewOption([], 'form'));
        echo \yii\bootstrap\Tabs::widget([
            'items' => [
                [
                    'label' => t('about request'),
                    'content' => join('', [
                        $form->field($model, 'deliveryman_id')->dropDownList($model->arrayListModel(\app\models\Deliveryman::class),['prompt'=>t('select')]),
                        $form->field($model, 'client_id')->dropDownList($model->arrayListModel(\app\models\Client::class),['prompt'=>t('select')]),
                        $form->field($model, 'product_id')->dropDownList($model->arrayListModel(\app\models\Product::class),['prompt'=>t('select')])
                    ]),
                    'active' => true
                ],
                [
                    'label' => t('situation'),
                    'content' => join('',[
                        $form->field($model, 'situation')->dropDownList(dropDownList('situation'), ['prompt' => t('select')]),
                        $form->field($model, 'description')->textInput(['maxlength' => true]),
                        $form->field($model, 'observation')->textarea(),
                        $form->field($model, 'request_date')
                            ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999'])
                            ->widget(\dosamigos\datepicker\DatePicker::className(), viewOption(['model'=>$model,'attribute' => 'request_date'],"datepicker"))
                    ])
                ],
                [
                    'label' => t('values'),
                    'content' => join('', [
                        $form->field($model, 'quantity')->widget(\yii\widgets\MaskedInput::class, ['mask' => '9{1,}']),
                        $form->field($model, 'price')->widget(\kartik\money\MaskMoney::class, Yii::$app->params["maskMoneyOptions"]),
                        $form->field($model, 'freight')->widget(\kartik\money\MaskMoney::class, Yii::$app->params["maskMoneyOptions"]),
                        $form->field($model, 'discount')->widget(\kartik\money\MaskMoney::class, Yii::$app->params["maskMoneyOptions"]),
                    ])
                ]
            ],
        ]);
        echo \app\widgets\MyButtons::widget(['model' => $model]);
    ActiveForm::end();
echo '</div>';
$this->registerJs('
$(document).ready(function(){
    $("form").on("submit", function(e)
    {
        $("input").trigger("blur");
    });

    $("#request-product_id").on("change", function()
    {
        if(this.value != "" )
        {
            $.ajax({
                url: "'.\Yii::$app->urlManager->createUrl(["products"]).'",
                method: "post",
                dataType: "json",
                data: { product_id: $(this).val() },
                success: function(data)
                {
                    $("#request-price-disp").val(data.cost).trigger("keyup");
                }
            });
        }
    });

    if( $("#request-product_id").val() != "")
        $("#request-product_id").trigger("change");

    $("#request-description").on("keyup", function()
    {
        $("#desc-request").text(this.value);
    });
    $("#request-price-disp, #request-freight-disp, #request-discount-disp").on("keyup", function()
    {
        calculateSum($("#request-quantity").val(), $("#request-price-disp").val(), $("#request-freight-disp").val(), $("#request-discount-disp").val());
    });
    function calculateSum(quantity, price, freight, discount)
    {
        quantity    = quantity!= "" ? parseInt(quantity): 1;
        price = (price != "" ? parseFloat( price.indexOf(",") != -1 ? price.replace(",", ".") : price ) : 0);
        freight = ( freight != "" ? parseFloat( freight.indexOf(",") != -1 ? freight.replace(",", ".") : freight ) : 0 );
        discount = ( discount != "" ? parseFloat( discount.indexOf(",") != -1 ? discount.replace(",", ".") : discount ) : 0 );

        $("#price-request").text( ( ( (quantity * price) + freight) - discount ).toFixed(2).replace(".",",") );
    }
});
');