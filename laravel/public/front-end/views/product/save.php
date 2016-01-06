<div class="{{css_class.save}}" ng-controller="ProductController" ng-init="findOne()">
    <form ng-submit="save()" class="form-horizontal" ng-if="blockPage.status==200">
        <div class="form-group">
            <label class="col-md-3 control-label">
                Status:
            </label>
            <div class="col-md-6">
                <label class="radio-inline">
                    <input type="radio" value="1" ng-model="product.status">Ativo
                </label>
                <label class="radio-inline">
                    <input type="radio" value="0" ng-model="product.status">Inativo
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Nome:
            </label>
            <div class="col-md-6">
                <input type="text" ng-model="product.name" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Descrição:
            </label>
            <div class="col-md-6">
                <textarea ng-model="product.description" class="form-control" style="resize: none" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Tamanho:
            </label>
            <div class="col-md-6">
                <select class="form-control" ng-model="product.size">
                    <option value>Selecione</option>
                    <option ng-repeat="size in sizes" ng-selected="product.size==($index+1)" value="{{$index+1}}">{{size}}</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">
                Preço:
            </label>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" ng-model="product.cost" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-usd"></span>
                    </div>
                </div>
            </div>
        </div>
        <my-actions module="module"></my-actions>
    </form>
</div>