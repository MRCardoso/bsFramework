<?php
    echo '<div class="border-side-bottom content content-large">';
        $form = yii\widgets\ActiveForm::begin(viewOption([], 'form'));
            echo $form->field($model, 'status')->radioList(dropDownList('status'));
            echo $form->field($model, 'size')->dropDownList(dropDownList('size'),['prompt'=>t('select')]);
            echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            echo $form->field($model, 'description')->textarea(['maxlength' => true]);
            echo $form->field($model, 'cost')->widget(\kartik\money\MaskMoney::class,Yii::$app->params["maskMoneyOptions"]);

            echo \app\widgets\MyButtons::widget(['model' => $model]);
        yii\widgets\ActiveForm::end();
    echo '</div>';

    $this->registerJs('
        $(document).ready(function(){
            $("form").on("submit", function(e)
            {
                $("input").trigger("blur");
            });
        });
    ');