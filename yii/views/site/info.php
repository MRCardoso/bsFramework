<div class="content text-center">
    <ul class="list-libraries">
        <li>
            <a href="https://github.com/" target="_blank" data-toggle="popover" data-placement="left"
               title="Github" data-content="Sistema de controler de versão distribuído" data-trigger="hover">
                <div class="box image-git"></div>
            </a>
        </li>
        <li>
            <a href="https://getcomposer.org/" target="_blank" data-toggle="popover" data-placement="top"
               title="Composer" data-content="Gerenciador de packages para PHP" data-trigger="hover">
                <div class="box image-composer"></div>
            </a>
        </li>
        <li>
            <a href="http://www.yiiframework.com/doc-2.0/" target="_blank" data-toggle="popover" data-trigger="hover"
               title="laravel" data-content="Framework MVC focado no desenvolvimento de aplicações robustas e complexa de jeito facil,
                                            utilizando widgets como base para um projeto personalizado.">
                <div class="box image-yii"></div>
            </a>
        </li>
    </ul>
    <a href="https://github.com/MRCardoso/bsFramework/tree/master/yii/" class="btn mrc-btn">Veja o código fonte no GitHub</a>
</div>
<?php
$this->registerJs('
$(document).ready(function(){
    var size = Math.round(window.innerWidth/9);
    var styless = { width: size+"px", height: size+"px" };
    $(".box").css(styless);
    $(window).resize(function ()
    {
        var size = Math.round(window.innerWidth/9);
        var styless = { width: size+"px", height: size+"px" };
        $(".box").css(styless);
    })
})
');