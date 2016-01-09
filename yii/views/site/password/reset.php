<div class="content content-large">
    <div class="breadcrumb">
        <h4 class="text-center"><?php echo t('Redefine password'); ?></h4>
    </div>
    <?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $form = ActiveForm::begin(viewOption([],'form'));
    echo $form->field($model, 'email')->textInput();
    echo $form->field($model, 'password')->passwordInput();
    echo $form->field($model, 'password_confirmation')->passwordInput();

    echo Html::tag('div',
        Html::submitButton(t('reset password'), ['class' => 'btn mrc-btn-light', 'name' => 'login-button'])
        , ['class' => 'button-group']);
    ActiveForm::end();
    ?>
</div>