<div class="content-large">
    <div class="text-center">
        <h2 class="header-title">
            Selecione o Framework
        </h2>
        <ul class="list-libraries">
            <li>
                <a href="/laravel/#!/" popover-placement="bottom" popover-title="laravel" popover="Framework MVC back-end para construção de apliações agéis e poderosas em modelo de API restful" popover-trigger="mouseenter">
                    <div class="box image-laravel"></div>
                </a>
            </li>
            <li>
                <a href="/yii" popover-placement="bottom" popover-title="laravel" popover="Framework MVC back-end para construção de apliações agéis e poderosas em modelo de API restful" popover-trigger="mouseenter">
                    <div class="box image-yii"></div>
                </a>
            </li>
        </ul>
    </div>
    <div class="alert alert-warning">
        <p>
            Recomendo, caso surja dúvida, acesso o menu '<a ng-href="/#!/about">sobre</a> ',
            pois nele há uma breve descrição da estrutura base deste sistema.
        </p>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#feeds" aria-controls="feeds" role="tab" data-toggle="tab">Feedbacks</a></li>
        <li role="presentation"><a href="#sujestions" aria-controls="issues" role="tab" data-toggle="tab">Solicitações</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content" ng-controller="FeedBackController" ng-init="find()">
        <div role="tabpanel" class="tab-pane active" id="feeds">
            <section>
                <header>
                    <h3>Feedback de usuários</h3>
                </header>
                <article class="list-group">
                    <div class="list-group-item" ng-repeat="feed in feedbacks.comment">
                        <h5>
                            {{ feed.name || 'Usuário anônimo'}}
                            <span ng-show="feed.email!=''">
                                {{ '('+feed.email+')' }}
                            </span>
                        </h5>
                        <p>
                            <strong>Mensagem:</strong>
                            {{ feed.message }}
                        </p>
                    </div>
                    <a ng-href="/#!/feedback" ng-if="feedbacks.comment.length==0">Seja o primeiro a recomendar.</a>
                </article>
            </section>
        </div>
        <div role="tabpanel" class="tab-pane" id="sujestions">
            <section>
                <header>
                    <h3>Sujestão para melhorias</h3>
                </header>
                <article class="list-group">
                    <div class="list-group-item" ng-repeat="feed in feedbacks.sujestion">
                        <h5>
                            {{ feed.name || 'Usuário anônimo'}}
                            <span ng-show="feed.email!=''">
                                {{ '('+feed.email+')' }}
                            </span>
                        </h5>
                        <p>
                            <strong>Mensagem:</strong>
                            {{ feed.message }}
                        </p>
                    </div>
                    <a ng-href="/#!/feedback" ng-if="feedbacks.sujestion.length==0">Seja o primeiro a recomendar.</a>
                </article>
            </section>
        </div>
    </div>
    <script language="JavaScript">
        $(document).ready(function(){
            var size = Math.round(window.innerWidth/10);
            var styless = { width: size+'px', height: size+'px' };
            $('.box').css(styless);
            $(window).resize(function ()
            {
                var size = Math.round(window.innerWidth/10);
                var styless = { width: size+'px', height: size+'px' };
                $('.box').css(styless);
            })
        })
    </script>
</div>