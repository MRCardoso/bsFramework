<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$this->title = $name;
$this->params["statusCode"] = $exception->statusCode;
$cssClass = "border-side-buttom content ".(!preg_match('/(index)/', Yii::$app->request->pathInfo)?'content-large':'');
mySendMailer('isAdmin', "[THROW]-erro de acesso a interface", join('',[
    '<h3>'.Html::encode($this->title).'</h3>',
    nl2br(Html::encode($message)),
    "<p><strong>dados do servidor:</strong></p>",
]), $_SERVER);
?>
<div class="<?php echo $cssClass; ?>">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?php echo nl2br(Html::encode($message)) ?>
    </div>
    <div class="text-center">
    <?php
        if( ($url = Yii::$app->request->referrer) != NULL )
            echo Html::a(t('back'), $url,['class'=> 'btn mrc-btn-light']);
        else
            echo Html::a(t('back'), [''],['class'=> 'btn mrc-btn-light','onclick'=> 'window.history.back()']);
    ?>
    </div>
</div>
