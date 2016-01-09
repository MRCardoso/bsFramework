<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    echo '<div class="border-side-buttom content content-large">';
        if( $isSignup )
            echo "<h3 class='breadcrumb text-center'>Criar conta</h3>";

        $form = ActiveForm::begin(viewOption([], 'form'));
            if( !$isSignup )
                echo $form->field($model, 'status')->radioList(dropDownList('status'));
            echo $form->field($model, 'group')->dropDownList($groups,['prompt'=>t('select')]);
            echo $form->field($model, 'name')->textInput(['maxlength' => true]);
            echo $form->field($model, 'email')->textInput(['maxlength' => true]);
            echo $form->field($model, 'username')->textInput(['maxlength' => true]);
            echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
            echo Html::tag('div', join('', [
                Html::tag('div',t('corporation'),['class' => 'panel-heading']),
                Html::tag('div', join('', [
                    Html::tag('div',
                        $form->field($model, 'corporate_register_id')->dropDownList($model->arrayCorporateRegister(),['prompt'=>t('select')]),
                        ['id' => 'employee', 'class' => 'display-none']),
                    Html::tag('div',
                        join('',[
                            $form->field($corporateRegister, 'name')->textInput(),
                            $form->field($corporateRegister, 'code')->textInput(),
                        ])
                        , ['id' => 'company','class'=>'display-none'])
                ]),['class' => 'panel-body']),
                '<div class="panel-footer text-center"><div class="panel-heading">seu usuário(Login) estará ligado a corporação aqui criada[grupo:empresa] ou selecionada[grupo:funcionário]</div></div>',
            ])
            ,['class' => 'panel panel-default display-none', 'id' => 'corporate-form']);
            echo \app\widgets\MyButtons::widget(['model' => $model]);
        ActiveForm::end();
    echo '</div>';

    $employee = '';
    if( !\Yii::$app->user->identity || checkGroup('admin') )
    {
        $employee = 'case "employee":
                        $("#corporate-form,#employee").show();
                        $("#company").hide();
                        break;';
    }
    $this->registerJs('
        $(document).ready(function() {
            $("#user-group").on("change", function()
            {
                switch($(this).val())
                {
                    case "company":
                        $("#employee").hide();
                        $("#corporate-form, #company").show();
                        break;
                    '.$employee.'
                    default:
                        $("#corporate-form").hide();
                        break;
                }
            });
            $("#user-group").trigger("change");
        });', \yii\web\VIEW::POS_READY);