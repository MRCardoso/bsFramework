<?php
use yii\widgets\ActiveForm;
$contents ='';
$productIds=[];
$productList=[];
$template = ['template'=>'{label}{input}<span class=\"col-md-8 text-right\">{error}</span>'];

foreach( $model->productRequests as $i => $productRequest)
{
    $productIds[] = $productRequest->product->id;
    $productList[] = ["price"=>$productRequest->price, "quantity"=>$productRequest->quantity];
    $contents .= "<div class=\"list-group-item\" id=\"list-{$productRequest->product->id}\">
        {$productRequest->quantity}  - {$productRequest->product->name}, Custo R$ {$productRequest->price}
        <div class=\"pull-right\">
            <a href=\"#\" data-id=\"{$productRequest->product->id}\" class=\"dropProduct remove-link label label-danger\">
                <span class=\"glyphicon glyphicon-remove\"></span>
            </a>
        </div>
        <input type=\"hidden\" name=\"products[{$productRequest->product->id}][product_id]\" value=\"{$productRequest->product->id}\">
        <input type=\"hidden\" name=\"products[{$productRequest->product->id}][quantity]\" value=\"{$productRequest->quantity}\">
        <input type=\"hidden\" name=\"products[{$productRequest->product->id}][price]\" value=\"{$productRequest->price}\">
    </div>";
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
                        $form->field($model, 'deliveryman_id')->dropDownList($model->arrayListModel(\app\models\Deliveryman::class),['prompt'=>t('select')]),
                        $form->field($model, 'client_id')->dropDownList($model->arrayListModel(\app\models\Client::class),['prompt'=>t('select')]),
                        $form->field($model, 'situation')->dropDownList(dropDownList('situation'), ['prompt' => t('select')]),
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
                                \yii\helpers\Html::a('<span class="glyphicon glyphicon-plus"></span> Adicionar','#',[
                                    'class'=>'btn mrc-btn-light',
                                    'data-toggle' => 'modal',
                                    'data-target' => '#addProduct',
                                    'id' => 'open-product',
                                ]),
                            '</div>',
                            '<div class="clear"></div>',
                            '<div class="list-group" id="list-group">'.$contents.'</div>',
                            '<div id="product-list"></div>',
                        '</div>',
                    ])
                ],
                [
                    'label' => t('info_additionals'),
                    'content' => join('', [
                        $form->field($model, 'request_date')
                            ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999'])
                            ->widget(\dosamigos\datepicker\DatePicker::className(), viewOption(['model'=>$model,'attribute' => 'request_date'],"datepicker")),
                        $form->field($model, 'description')->textInput(['maxlength' => true]),
                        $form->field($model, 'observation')->textarea(),
                    ])
                ]
            ],
            'navType' => 'nav nav-justified nav-tabs content'
        ]);
        echo \app\widgets\MyButtons::widget(['model' => $model]);
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
                    <div class="form-horizontal">
                        <div class="alert alert-warning alert-dismissible display-none" role="alert" id="req-message">
                            <strong>Atenção!</strong>
                            <span id="msg-danger"></span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                <?php echo t('product'); ?>
                            </label>
                            <div class="col-md-6">
                                <select id="product_id" class="form-control product_requests">
                                    <option value=""><?php echo t('select');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                <?php echo t('quantity'); ?>
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="quantity" id="quantity" class="form-control product_requests">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                <?php echo t('price'); ?>
                            </label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <span class="glyphicon glyphicon-usd"></span>
                                    </div>
                                    <?php
                                    echo \kartik\money\MaskMoney::widget([
                                        "name" => 'price',
                                        "options" => ['id' => 'price', 'class' => 'product_requests'],
                                        "pluginOptions" => Yii::$app->params["maskMoneyOptions"]["pluginOptions"]
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-add-product" class="btn mrc-btn">Adicionar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php
$this->registerJs('
$(document).ready(function(){
    var productData = {};
    var productList = '.\yii\helpers\Json::encode((!empty($productList)?$productList:[])).';
    var productIds = '.\yii\helpers\Json::encode((!empty($productIds)?$productIds:[])).';
    $("form").on("submit", function(e)
    {
        $("input").trigger("blur");
    });

    $("#open-product").on("click", function(){
        $.ajax({
                url: "'.\Yii::$app->urlManager->createUrl(["request/product_list"]).'",
                method: "post",
                dataType: "json",
                data: { product_id: productIds },
                success: function(data)
                {
                    $("#product_id").html(\'<option value="">'.t('select').'</option>\');
                    $.each(data, function(k,row){
                        $("#product_id").append(\'<option value="\'+k+\'">\'+row+\'</option>\');
                    });
                }
            });
    });
    $("#product_id").on("change", function()
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
                    $("#price-disp").val(data.cost).trigger("keyup");
                }
            });
        }
    });

    $("#btn-add-product").on("click", function(e){
        e.preventDefault();
        var product_id = $("#product_id").val();
        var quantity = $("#quantity").val();
        var price = $("#price-disp").val();

        if(product_id == "")
        {
            $("#req-message").show();
            $("#msg-danger").text("você preciso selecionar um produto!");
        }
        else if( !(/^[0-9]{1,}$/.test(quantity)) )
        {
            $("#req-message").show();
            $("#msg-danger").text("A  quantidade de conter um número inteiro!");
        }
        else if( !(/^\d*(\.\d{0,3})?(\.\d{0,3})?(\,\d{2})?$/.test(price)) )
        {
            $("#req-message").show();
            $("#msg-danger").text("O preço deve conter um valor numérico!");
        }
        else
        {
            $("#req-message").hide();
            productIds.push(product_id);
            productList.push({"price":price, "quantity":quantity});
            var $inputs = \'<input type="hidden" name="products[\'+product_id+\'][product_id]" value="\'+product_id+\'"><input type="hidden" name="products[\'+product_id+\'][quantity]" value="\'+quantity+\'"><input type="hidden" name="products[\'+product_id+\'][price]" value="\'+price+\'">\';
            var dropLabel = \'<div class="pull-right"><a ng-href="#" data-id="\'+product_id+\'" class="dropProduct remove-link label label-danger"><span class="glyphicon glyphicon-remove"></span></a></div>\';
            var $content = $("<div/>",{html: quantity+" - "+productData.name+", Custo R$ "+price+dropLabel+$inputs,"class": "list-group-item","id": "list-"+product_id});
1
            calculateSum($("#request-freight-disp").val(), $("#request-discount-disp").val());
            $("#list-group").append($content);
            $(".product_requests").val("");
            $("#addProduct").modal("hide");
        }
    });
    $(document).on("click", ".dropProduct", function(){
        var id = $(this).data("id");
        productIds.splice(productIds.indexOf(id),1);
        productList.splice(productIds.indexOf(id),1);
        $("#request-freight-disp").trigger("keyup");
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