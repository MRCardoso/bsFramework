<div ng-if="blockPage.status!=200" class="{{ css_class.save}}">
    <div class="alert alert-{{ blockPage.css }} alert-dismissible" role="alert">
        <strong>{{ blockPage.status }}</strong>
        {{ blockPage.message}}
    </div>
    <div class="text-center">
        <a ng-href role="button" onclick="javascript:window.history.back()" class="btn mrc-btn-light">Voltar</a>
    </div>
</div>