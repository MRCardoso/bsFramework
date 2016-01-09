<div class="content content-small">
    <div class="breadcrumb">
        <h4 class="text-center"><?php echo t('recover the password'); ?></h4>
    </div>
    <?php
        use yii\helpers\Html;
        use yii\widgets\ActiveForm;

        $form = ActiveForm::begin();
            echo $form->field($model, 'email', ['template' => "<label>".t('fill_in_your_e-mail_registered')."</label>\n{input}\n{error}"])->textInput();

            echo Html::tag('div',
                Html::submitButton(t('send token'), ['class' => 'btn mrc-btn-light', 'name' => 'login-button'])
            , ['class' => 'text-center']);
        ActiveForm::end();
    ?>
</div>