<div class="content content-medium content-top" ng-controller="UserController" ng-init="findOne()">
    <div class="breadcrumb">
        <h4 class="text-center">Criar conta</h4>
    </div>
    <form class="form-horizontal" ng-submit="save()">
        <div class="form-group">
            <label for="" class="col-md-4 control-label">Name</label>
            <div class="col-md-6">
                <input type="text" ng-model="user.name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-md-4 control-label">Email</label>
            <div class="col-md-6">
                <input type="email" ng-model="user.email" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" ng-model="user.password" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="col-md-4 control-label">Confirm Password</label>
            <div class="col-md-6">
                <input type="password" ng-model="user.password_confirmation" class="form-control">
            </div>
        </div>
        <div class="button-group">
            <a ng-href="/#!/" class="btn btn-default">Voltar</a>
            <button class="btn mrc-btn-light">Criar</button>
        </div>
    </form>
</div>