<div ng-if="blockPage.status!=200" class="content content-large text-center">
    <div class="alert alert-{{ blockPage.css }} alert-dismissible" role="alert">
        <h2>{{ blockPage.status }}</h2>
        <p>{{ blockPage.message}}</p>
    </div>
<!--    <a ng-href role="button" onclick="javascript:window.history.back()" class="btn mrc-btn-light">Voltar</a>-->
</div>