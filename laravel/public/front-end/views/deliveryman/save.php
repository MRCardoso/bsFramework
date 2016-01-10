<div class="{{ css_class.save }}" ng-controller="DeliverymanController" ng-init="findOne()">
    <form ng-submit="save()" class="form-horizontal" ng-if="blockPage.status==200">
        <div class="form-group">
            <label class="col-md-3 control-label">
                Status
            </label>
            <div class="col-md-6">
                <label class="radio-inline">
                    <input type="radio" value="1" ng-model="deliveryman.status">Ativo
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" ng-model="deliveryman.status">Inativo
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Empresa
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <select ng-model="deliveryman.company_id" class="form-control">
                        <option value>Selecione</option>
                        <option ng-repeat="company in companies" value="{{company.id}}"
                                ng-selected="company.id==deliveryman.company_id">{{company.name}}</option>
                    </select>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-home"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Nome:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="deliveryman.name" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                CPF:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="deliveryman.cpf" class="form-control" mask="999.999.999-99">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-option-horizontal"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Celular:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="deliveryman.cellphone" class="form-control" mask="(99) 9?9999-9999">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-phone"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                RG:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="deliveryman.rg" class="form-control" mask="d" repeat="18">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-option-horizontal"></span>
                    </div>
                </div>
            </div>
        </div>
            <div class="form-group">
                <label class="col-md-3 control-label">
                    Tipo de Comissao:
                </label>
                <div class="col-md-6">
                    <select class="form-control" ng-model="deliveryman.salary_type">
                        <option value="">Selecione</option>
                        <option ng-repeat="types in comissionTypes" value="{{types.key}}">{{ types.name}}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">
                    Valor da Comissao:
                </label>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" ng-model="deliveryman.salary_value" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-usd"></span>
                        </div>
                    </div>
                </div>
            </div>
        <my-actions module="module"></my-actions>
    </form>
</div>