<div class="content text-center">
    <ul class="list-libraries">
        <li>
            <a href="https://github.com/" target="_blank" popover-placement="bottom" popover-title="Github"
               popover="Sistema de controler de versão distribuído" popover-trigger="mouseenter">
                <div class="box image-git"></div>
            </a>
        </li>
        <li>
            <a href="http://getbootstrap.com/" target="_blank" popover-placement="bottom" popover-title="Bootstrap"
               popover="Framework css para design responsivo" popover-trigger="mouseenter">
                <div class="box image-bootstrap"></div>
            </a>
        </li>
        <li>
            <a href="https://getcomposer.org/" target="_blank" popover-placement="bottom" popover-title="Composer"
               popover="Gerenciador de packages para PHP" popover-trigger="mouseenter">
                <div class="box image-composer"></div>
            </a>
        </li>
        <li>
            <a href="https://angularjs.org/" target="_blank" popover-placement="bottom" popover-title="Angular"
               popover="Framework MVC front-end javascript para manipuldação de Data Binding" popover-trigger="mouseenter">
                <div class="box image-angular"></div>
            </a>
        </li>
        <li>
            <a href="http://laravel.com/" target="_blank" popover-placement="bottom" popover-title="laravel"
               popover="Framework MVC back-end para construção de apliações agéis e poderosas em modelo de API restful,
               tendo um poderoso ORM (Eloquent) para gerenciamento de banco de dados" popover-trigger="mouseenter">
                <div class="box image-laravel"></div>
            </a>
        </li>
    </ul>
    <a href="https://github.com/MRCardoso/bsFramework/tree/master/laravel" target="_blank" class="btn mrc-btn">
        Veja o código fonte no GitHub
    </a>
</div>
<script type="text/javascript">
    $(document).ready(function ()
    {
        var size = Math.round(window.innerWidth/9);
        var styless = { width: size+'px', height: size+'px' };
        $('.box').css(styless);

        $(window).resize(function ()
        {
            var size = Math.round(window.innerWidth/9);
            var styless = { width: size+'px', height: size+'px' };
            $('.box').css(styless);
        });
    });
</script>