<div class="{{css_class.save}}" ng-controller="ClientController" ng-init="findOne()">
    <form class="form-horizontal" ng-submit="save()" ng-if="blockPage.status==200">
        <div class="form-group">
            <label class="col-md-3 control-label">
                Status:
            </label>
            <div class="col-md-6">
                <label class="radio-inline">
                    <input type="radio" value="1" ng-model="client.status">Ativo
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" ng-model="client.status">Inativo
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Nome:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.name" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-home"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Telefone:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.phone" class="form-control" mask="(99) 9?9999-9999">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-phone-alt"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Data Nascimento
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.birthday" class="form-control date" mask='39/19/9999'>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Endereço:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.address" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-home"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Número
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.number" class="form-control" mask="d?" repeat="9">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-option-horizontal"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Bairro:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.neightborhood" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-road"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Referência:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.reference" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-globe"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Cidade:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" data-ng-model="client.city" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-globe"></span>
                    </div>
                </div>
            </div>
        </div>
        <my-actions module="module"></my-actions>
    </form>
</div>