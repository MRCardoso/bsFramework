<div class="{{css_class.save}}" ng-controller="CompanyController" ng-init="findOne()">
    <form class="form-horizontal" ng-submit="save()" ng-if="blockPage.status==200">
        <div class="form-group">
            <label class="col-md-3 control-label">
                Status:
            </label>
            <div class="col-md-6">
                <label class="radio-inline">
                    <input type="radio" value="1" ng-model="company.status">Ativo
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" ng-model="company.status">Inativo
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Nome:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="company.name" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                CNPJ:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="company.cnpj" class="form-control" mask="99.999.999/9999-99">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-registration-mark"></span>
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
                    <input type="text" ng-model="company.address" class="form-control">
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
                    <input type="text" ng-model="company.phone" class="form-control" mask="(99) 9?9999-9999">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-phone"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                E-mail:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="company.email" class="form-control">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Vinculo:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="company.start_date" id="start_date" class="form-control date" placeholder="Inicio" mask="39/19/9999">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                    <input type="text" ng-model="company.end_date" id="end_date" class="form-control date" placeholder="Fim" mask="39/19/9999">
                </div>
            </div>
        </div>
        <my-actions module="module"></my-actions>
    </form>
</div>