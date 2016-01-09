<?php
    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;
?>
    <div class="panel panel-default content-large">
        <div class="panel-heading">
            <h4 class="text-center">Faça o login</h4>
        </div>
        <div class="panel-body">
        <?php
            $form = ActiveForm::begin(viewOption([], 'form'));
                echo $form->field($model, 'email');
                echo $form->field($model, 'password')->passwordInput();
                echo $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-md-9 text-right\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]);
                echo Html::tag('div', join('',[
                        Html::a(t('forgot my password'),['/password/email'], ['class' => 'pull-left']),
                        Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button'])
                    ])
                    , ['class' => 'button-group']);
            ActiveForm::end();
        ?>
        </div>
    </div>