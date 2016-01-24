<?php
use yii\widgets\ActiveForm;
$contents = [];
$productIds=[];
$productList=[];
$template = ['template'=>'{label}{input}<span class=\"col-md-8 text-right\">{error}</span>'];

foreach( $model->productRequests as $i => $productRequest)
{
    $productIds[] = $productRequest->product->id;
    $productList[] = ["price"=>$productRequest->price, "quantity"=>$productRequest->quantity];
    $contents[] = Yii::$app->controller->renderPartial('partial/list.product.php',['model' => $productRequest]);
}
?>
<div class="border-side-bottom content content-large">
    <div class="breadcrumb alert alert-dismissible" role="alert">
        Pedido: <strong id="desc-request"><?php echo $model->description==NULL?t('uninformed'):$model->description;?></strong>,<br>
        valor total: <span id="price-request"><?php echo $model->totalValue;?></span>
    </div>
<?php
    $form = ActiveForm::begin(viewOption([], 'form'));
        echo \yii\bootstrap\Tabs::widget([
            'items' => [
                [
                    'label' => t('pass 1'),
                    'content' => join('', [
                        $form->field($model, 'request_date')
                            ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999'])
                            ->widget(\dosamigos\datepicker\DatePicker::className(), viewOption(['model'=>$model,'attribute' => 'request_date'],"datepicker")),
                        $form->field($model, 'description')->textInput(['maxlength' => true]),
                        $form->field($model, 'observation')->textarea(),
                        \app\widgets\MyButtons::widget(['model'=>$model,'buttons'=>['back','nextTab']])
                    ]),
                    'active' => true
                ],
                [
                    'label' => t('pass 2'),
                    'content' => join('',[
                        '<div class="content">',
                            '<div class="col-md-4">',
                                $form->field($model, 'freight',$template)->widget(\kartik\money\MaskMoney::class, Yii::$app->params["maskMoneyOptions"]),
                            '</div>',
                            '<div class="col-md-4">',
                                $form->field($model, 'discount',$template)->widget(\kartik\money\MaskMoney::class, Yii::$app->params["maskMoneyOptions"]),
                            '</div>',
                            '<div class="col-md-2">',
                                '<label class="control-label">Produto</label>',
                                \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span>'.t('add'),'#',[
                                    'class'=>'btn mrc-btn-light',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#addProduct',
                                    'id' => 'open-product',
                                ]),
                            '</div>',
                            '<div class="clear"></div>',
                            '<div class="list-group" id="list-group">'.join('',$contents).'</div>',
                            '<div id="product-list"></div>',
                        '</div>',
                        \app\widgets\MyButtons::widget(['model'=>$model, 'tabIndex' => 1, 'buttons'=>['prevTab','nextTab']])
                    ])
                ],
                [
                    'label' => t('pass 3'),
                    'content' => join('', [
                        $form->field($model, 'deliveryman_id')->dropDownList($model->arrayListModel(\app\models\Deliveryman::class),['prompt'=>t('select')]),
                        $form->field($model, 'client_id')->dropDownList($model->arrayListModel(\app\models\Client::class),['prompt'=>t('select')]),
                        $form->field($model, 'situation')->dropDownList(dropDownList('situation'), ['prompt' => t('select')]),
                        \app\widgets\MyButtons::widget(['model'=>$model,'buttons'=>['prevTab','save'],'tabIndex'=>2])
                    ])
                ]
            ],
            'navType' => 'nav nav-justified nav-tabs content',
            'options' =>['id'=>'lrt']
        ]);
    ActiveForm::end();
echo '</div>';
?>
    <div class="modal fade" tabindex="-1" role="dialog" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Produto</h4>
                </div>
                <div class="modal-body">
                    <?php echo Yii::$app->controller->renderPartial('partial/add.product.php',[]); ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php
$this->registerJs('
$(document).ready(function()
{
    var productData = {};
    var productList = '.\yii\helpers\Json::encode((!empty($productList)?$productList:[])).';
    var productIds = '.\yii\helpers\Json::encode((!empty($productIds)?$productIds:[])).';

    $("form").on("submit", function(e)
    {
        $("input").trigger("blur");
    });

    $(".next-tab").on("click", function(e)
    {
        e.preventDefault();
        var index = $(this).data("id");
        $("a[href=#lrt-tab"+index+"]").tab("show").parent().addClass("active");
    });

    $(".prev-tab").on("click", function(e)
    {
        e.preventDefault();
        var index = $(this).data("id");
        $("a[href=#lrt-tab"+index+"]").tab("show").parent().addClass("active");
    });

    $("#open-product").on("click", function(){
        $.ajax({
            url: "'.\Yii::$app->urlManager->createUrl(["request/product_list"]).'",
            method: "post",
            dataType: "json",
            data: { product_id: productIds },
            success: function(data)
            {
                $("#productrequest-product_id").html(\'<option value>'.t('select').'</option>\');
                $.each(data, function(k,row){
                    $("#productrequest-product_id").append(\'<option value="\'+k+\'">\'+row+\'</option>\');
                });
            }
        });
    });
    /*
    | -----------------------------------------------------------
    | change product
    | -----------------------------------------------------------
    */
    $("#productrequest-product_id").on("change", function()
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
                    productData = data;
                    $("#productrequest-price-disp").val(data.cost).trigger("keyup");
                }
            });
        }
    });
    /*
    | -----------------------------------------------------------
    | submit modal of the products
    | -----------------------------------------------------------
    */
    $("#submit-product").on("beforeSubmit", function()
    {
        $("input").trigger("blur");
        var $form = $(this);
        $.post(
            $form.attr("action"),
            $form.serialize(),
            function(reason)
            {
                productIds.push(reason.attributes.product_id);
                productList.push({"price":reason.attributes.price, "quantity":reason.attributes.quantity});

                calculateSum($("#request-freight-disp").val(), $("#request-discount-disp").val());
                $("#list-group").append(reason.content);
                $("#addProduct").modal("hide");
                document.getElementById("submit-product").reset();
            },
            "json"
        );
        return false;
    });
    /*
     | -----------------------------------------------------------
     | Drop a product
     | -----------------------------------------------------------
     */
    $(document).on("click", ".dropProduct", function()
    {
        var id = $(this).data("id");
        var index = productIds.indexOf(id);

        productIds.splice(index,1);
        productList.splice(index,1);

        calculateSum($("#request-freight-disp").val(), $("#request-discount-disp").val());
        $("#list-"+id).remove();
    });
    $("#request-description").on("keyup", function()
    {
        $("#desc-request").text(this.value);
    });
    $("#request-freight-disp, #request-discount-disp").on("keyup", function()
    {
        calculateSum($("#request-freight-disp").val(), $("#request-discount-disp").val());
    });
    function calculateSum(freight, discount)
    {
        var total = 0;
        $.each(productList, function(k,row)
        {
            var quantity = row["quantity"] != "" ? parseInt(row["quantity"]): 1;
            var price = (row["price"] != "" ? parseFloat( row["price"].indexOf(",") != -1 ? row["price"].replace(",", ".") : row["price"] ) : 0);
            total += quantity * price;
        });
        freight = ( freight != "" ? parseFloat( freight.indexOf(",") != -1 ? freight.replace(",", ".") : freight ) : 0 );
        discount = ( discount != "" ? parseFloat( discount.indexOf(",") != -1 ? discount.replace(",", ".") : discount ) : 0 );

        $("#price-request").text( ( ( total + freight) - discount ).toFixed(2).replace(".",",") );
    }
});
');