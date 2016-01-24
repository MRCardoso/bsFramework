<?php
    use \yii\widgets\ActiveForm;
    use \yii\helpers\Html;
    use \app\models\ProductRequest;
    $modelProduct = new ProductRequest();
    $params = ['options' => [ 'action' => Yii::$app->urlManager->createUrl(['request/product_request_save']),'id' => 'submit-product' ]];
    $formProduct = ActiveForm::begin(viewOption($params, 'form'));
        echo $formProduct->field($modelProduct, 'product_id')->dropDownList([],['prompt'=>t('select')]);
        echo $formProduct->field($modelProduct,'quantity')->textInput();
        echo $formProduct->field($modelProduct, 'price')->widget(\kartik\money\MaskMoney::class, Yii::$app->params["maskMoneyOptions"]);
        echo Html::tag('div',
            Html::tag('div',
                Html::submitButton(t('add'), ['class' => 'btn mrc-btn-light']),
            ['class' => 'text-right']),
        ['class' => 'button-group']);
    ActiveForm::end();