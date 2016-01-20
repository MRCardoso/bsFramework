<div class="{{css_class.save}}" ng-controller="UserController" ng-init="findOne()">
    <h3 class="breadcrumb text-center" ng-if="iSignup">
        Criar sua conta
    </h3>
    <form class="form-horizontal" ng-submit="save()" ng-if="blockPage.status==200">
        <div class="form-group" ng-if="!iSignup">
            <label class="col-md-4 control-label">
                Status:
            </label>
            <div class="col-md-6">
                <label class="radio-inline">
                    <input type="radio" value="1" ng-model="user.status">Ativo
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" ng-model="user.status">Inativo
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Grupo</label>
            <div class="col-md-6">
                <select ng-model="user.group" class="form-control" ng-change="register()">
                    <option value="">Selecione</option>
                    <option ng-repeat="group in groupList" value="{{ group.key }}">{{group.name}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" ng-model="user.name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Email</label>
            <div class="col-md-6">
                <input type="email" ng-model="user.email" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Username</label>
            <div class="col-md-6">
                <input type="text" ng-model="user.username" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" ng-model="user.password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" ng-model="user.password_confirmation" class="form-control">
            </div>
        </div>
        <div class="panel panel-default" ng-show="registerLink">
            <div class="panel-heading">Companhia</div>
            <div class="panel-body">
                <div ng-if="!registerForm">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nome</label>
                        <div class="col-md-6">
                            <select ui-select2 ng-model="user.corporate_register_id" class="select2">
                                <option value>Selecione</option>
                                <option ng-repeat="register in registers" value="{{ register.id }}">{{register.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div ng-if="registerForm">
                    <div class="form-group">
                        <label class="col-md-4 control-label">
                            Nome:
                        </label>
                        <div class="col-md-6">
                            <input type="text" ng-model="user.corporate_register.name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">
                            Código:
                        </label>
                        <div class="col-md-6">
                            <input type="text" ng-model="user.corporate_register.code" class="form-control disabled">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer text-center"><div class="panel-heading">seu usuário(Login) estará ligado a corporação aqui criada[grupo:empresa] ou selecionada[grupo:funcionário]</div></div>
        </div>
        <my-actions module="module"></my-actions>
    </form>
</div>