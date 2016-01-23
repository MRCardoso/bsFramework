<div class="container" ng-controller="FeedBackController">
    <div class="content-large">
        <div class="breadcrumb">
            <h4>
                Envie seu feedback
            </h4>
        </div>
        <div class="alert alert-danger" ng-show="errors != undefined">
            <div ng-repeat="error in errors">
                <div class="text-left">
                    {{ error[0] }}
                </div>
            </div>
        </div>
        <div class="alert alert-success alert-dismissible" role="alert" ng-show="success != undefined">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ success.message }}
        </div>
        <hr>
        <form ng-submit="save()" class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-md-4">Aplicação</label>
                <div class="col-md-6">
                    <select ng-model="feedback.application" class="form-control">
                        <option value="both">Ambos</option>
                        <option value="laravel">Laravel</option>
                        <option value="yii">Yii</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Tipo</label>
                <div class="col-md-6">
                    <select ng-model="feedback.type" class="form-control">
                        <option value="bug">Bug no sistema</option>
                        <option value="sujestion">Sujestão</option>
                        <option value="comment">comentário</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Nome</label>
                <div class="col-md-6">
                    <input type="text" ng-model="feedback.name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">E-mail</label>
                <div class="col-md-6">
                    <input type="text" ng-model="feedback.email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Mensegem</label>
                <div class="col-md-6">
                    <textarea ng-model="feedback.message" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 text-right">
                    <input type="checkbox" ng-model="feedback.view_home" id="view_home">
                    <label for="view_home" class="control-label">Deseja que sua mensage apareça em nossa home?</label>
                </div>
            </div>
            <hr>
            <div class="input-group pull-right">
                <button class="btn btn-success" id="btn-send">Enviar</button>
            </div>
            <div class="clear"></div>
        </form>
    </div>
</div>