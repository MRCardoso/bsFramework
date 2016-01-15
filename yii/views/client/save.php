<?php
    use yii\widgets\ActiveForm;
    echo '<div class="border-side-bottom content content-large">';
        $form = ActiveForm::begin(viewOption([],"form"));
            echo $form->field($model, 'status')->radioList(dropDownList('status'));
            echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            echo $form->field($model, 'phone')
                ->widget(\yii\widgets\MaskedInput::class, ['mask' => '(99) 99999999[9]']);
            echo $form->field($model, 'birthday')
                ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '99/99/9999'] )
                ->widget(\dosamigos\datepicker\DatePicker::className(), viewOption(
                    [
                        'model' => $model,
                        'attribute' => 'birthday',
                        'options' => [
                            'clientOptions' => [
                                'startView' => 2,
                                'endDate' => date('d/m/Y'),
                            ]
                        ]
                    ], "datepicker") );
            echo $form->field($model, 'address')->textInput(['maxlength' => true]);
            echo $form->field($model, 'number')
                ->widget(\yii\widgets\MaskedInput::className(), ['mask' => '9{1,10}'] );
            echo $form->field($model, 'neightborhood')->textInput(['maxlength' => true]);
            echo $form->field($model, 'city')->textInput(['maxlength' => true]);
            echo $form->field($model, 'reference')->textInput(['maxlength' => true]);

            echo \app\widgets\MyButtons::widget([ "model" => $model ]);
        ActiveForm::end();
    echo '</div>';
