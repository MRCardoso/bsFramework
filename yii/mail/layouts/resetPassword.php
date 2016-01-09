<p>
    <strong>
        <?php echo t('Click here to reset your password');?>
    </strong>
    <?php
        $path = Yii::$app->urlManager->createAbsoluteUrl(["password/reset/{$content}"]);
        echo \yii\helpers\Html::a($path, $path);
    ?>
</p>