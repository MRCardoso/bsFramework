<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$this->title = titleName(Yii::$app->request->pathInfo);
$this->params['breadcrumbs'] = makeBreadcrumb(Yii::$app->request->pathInfo);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php  $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="glyphicon glyphicon-home"></span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    if( !Yii::$app->user->isGuest )
    {
        echo Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'navbar-nav'],
            'items' => getModules()
        ]);
        echo Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' =>'nav navbar-nav navbar-right'],
            'items' => getModules(true)
        ]);
    }
    else
    {
    ?>
        <div class="pull-right">
            <?php
            echo Html::a(join('', [
                t("create account"),
                "\n<span class=\"glyphicon glyphicon-share\"></span>"
            ]),['/signup'], ['class' => 'btn mrc-btn signup', 'id' => 'signup']);

            echo Html::a(join('', [
                "<span class=\"glyphicon glyphicon-log-in\"></span>\n",
                t("access")
            ]),['/signin'], ['class' => 'btn mrc-btn signin', 'id' => 'signin']);
            ?>
        </div>
    <?php
        $this->registerJs('
            $(document).ready(function ()
            {
                $("#signup").on("mouseenter", function ()
                {
                    $(this).children("span[id=signup-txt]").text("Criar conta");
                }).on("mouseleave", function () {
                    $(this).children("span[id=signup-txt]").text("");
                });
                $("#signin").on("mouseenter", function ()
                {
                    $(this).children("span[id=signin-txt]").text("Acessar");
                }).on("mouseleave", function () {
                    $(this).children("span[id=signin-txt]").text("");
                });
            });', \yii\web\VIEW::POS_READY);
    }
    NavBar::end();
    ?>
    <div class="container">
            <div class="<?php echo (isSave() ?'content-large':''); ?>">
                <?php
                foreach( ["danger","success"] as $alert):
                    if(Yii::$app->session->hasFlash("alert-{$alert}")): ?>
                        <div class="alert alert-<?php echo $alert;?> alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo Yii::$app->session->getFlash("alert-{$alert}") ?>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        <?php
            if( Yii::$app->user->identity )
            {
                echo Html::tag('div',
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]),
                    isSave()? ['class' => 'content content-large'] :[]);
            }
            echo $content;
        ?>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
