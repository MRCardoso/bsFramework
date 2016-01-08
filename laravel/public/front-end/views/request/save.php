<div class="{{ css_class.save }}" ng-controller="RequestController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <div class="alert alert-warning alert-dismissible display-none" role="alert"
            ng-class="{'display-show': clients.length == 0 || requests.length == 0 || products.length == 0}">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Atenção!</strong>
            Para efetuar este pedido você precisa cadastrar
            <strong>clientes</strong>, <strong>entregadores</strong> e <strong>produtos</strong>.
        </div>
        <div class="breadcrumb alert alert-dismissible" role="alert">
            Pedido: <strong>{{ request.description || "não informado"}}</strong>,<br>
            valor total: {{ totalValue | currency }}
        </div>
        <form ng-submit="save()" class="form-horizontal">
            <tabset justified="true">
                <tab heading="Entrega">
                    <br>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Cliente:
                        </label>
                        <div class="col-md-6">
                            <select ng-model="request.client_id" class="form-control">
                                <option value="">Selecione</option>
                                <option ng-repeat="client in clients" value="{{ client.id }}" ng-selected="request.client_id==client.id">
                                    {{ client.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Entregador:
                        </label>
                        <div class="col-md-6">
                            <select ng-model="request.deliveryman_id" class="form-control">
                                <option value="">Selecione</option>
                                <option ng-repeat="deliveryman in deliverymen" value="{{ deliveryman.id }}" ng-selected="deliveryman.id==request.deliveryman_id">
                                    {{ deliveryman.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Produto:
                        </label>
                        <div class="col-md-6">
                            <select ng-model="request.product_id" class="form-control" ng-change="productInfo()">
                                <option value="">Selecione</option>
                                <option ng-repeat="product in products" value="{{ product.id }}" ng-selected="request.product_id==product.id">
                                   {{ product.name }} - {{ sizeText[product.size].name }} ({{ product.cost | currency}})
                                </option>
                            </select>
                        </div>
                    </div>
                </tab>
                <tab heading="Produto">
                    <br>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Situação:
                        </label>
                        <div class="col-md-6">
                            <select ng-model="request.situation" class="form-control">
                                <option value="">Selecione</option>
                                <option ng-repeat="situation in situations" ng-selected="($index+1)==request.situation" value="{{ $index+1 }}">{{ situation }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Data Pedido:
                        </label>
                        <div class="col-md-6">
                            <input type="text" ng-model="request.request_date" class="form-control date" mask="39/19/9999">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Descrição:
                        </label>
                        <div class="col-md-6">
                            <input type="text" ng-model="request.description" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Observação:
                        </label>
                        <div class="col-md-6">
                            <textarea ng-model="request.observation" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </tab>
                <tab heading="Valores">
                    <br>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Quantidade:
                        </label>
                        <div class="col-md-6">
                            <input type="text" data-ng-model="request.quantity" ng-keyup="calculateValue()" class="form-control" mask="d?" repeat="10">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Preço:
                        </label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-usd"></span>
                                </div>
                                <input type="text" ng-model="request.price" ng-keyup="calculateValue()" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Frete:
                        </label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-usd"></span>
                                </div>
                                <input type="text" ng-model="request.freight" ng-keyup="calculateValue()" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Desconto:
                        </label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-usd"></span>
                                </div>
                                <input type="text" ng-model="request.discount" ng-keyup="calculateValue()" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                            </div>
                        </div>
                    </div>
                </tab>
            </tabset>
            <my-actions module="module"></my-actions>
        </form>
    </div>
</div>