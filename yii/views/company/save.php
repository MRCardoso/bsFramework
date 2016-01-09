<?php
    use yii\helpers\Html;
    use kartik\date\DatePicker;
    use \yii\widgets\ActiveForm;

    echo '<div class="border-side-bottom content content-large">';
        $form = ActiveForm::begin(viewOption([],"form"));
            echo $form->field($model, 'status')->radioList(dropDownList('status'));
            echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            echo $form->field($model, 'cnpj')->widget(\yii\widgets\MaskedInput::class, ['mask' => '99.999.999/9999-99']);
            echo $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, ['mask' => '(99) 99999999[9]']);
            echo $form->field($model, 'address')->textInput(['maxlength' => true]);
            echo $form->field($model, 'email')->textInput(['maxlength' => true]);
            echo $form->field($model, 'start_date')->widget(
                \dosamigos\datepicker\DatePicker::class,
                viewOption(['model' =>$model,"options"=>['template'=>'{input}{addon}']],"datepicker")
            );
            echo $form->field($model, 'end_date')->widget(
                \dosamigos\datepicker\DatePicker::class,
                viewOption(['model' =>$model,"options"=>['template'=>'{input}{addon}']],"datepicker")
            );

            echo \app\widgets\MyButtons::widget(['model' => $model]);
        ActiveForm::end();
    echo '</div>';