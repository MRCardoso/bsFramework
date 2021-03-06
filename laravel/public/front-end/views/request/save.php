<div class="{{ css_class.save }}" ng-controller="RequestController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <div class="breadcrumb alert alert-dismissible" role="alert">
            Pedido: <strong>{{ request.description || "não informado"}}</strong>,<br>
            valor total: {{ totalValue | currency }}
        </div>
        <form ng-submit="save()" class="form-horizontal">
            <tabset justified="true" id="lrt">
                <tab heading="Passo 1" active="tab.pass1">
                    <div class="form-group">
                        <label class="col-md-3 control-label">
                            Data Pedido:
                        </label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" ng-model="request.request_date" class="form-control date" mask="39/19/9999">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </div>
                            </div>
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
                    <div class="button-group" style="z-index: 1000000">
                        <a ng-href="./#!/request" class="btn btn-default">Cancelar</a>
                        <a ng-href role="button" ng-click="runTab(2)" class="btn btn-primary">Próximo</a>
                    </div>
                </tab>
                <tab heading="Passo 2" active="tab.pass2">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Frete</th>
                            <th>Desconto</th>
                            <th>Produto</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" ng-model="request.freight" ng-keyup="calculateValue()" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                            </td>
                            <td>
                                <input type="text" ng-model="request.discount" ng-keyup="calculateValue()" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                            </td>
                            <td>
                                <a ng-href role="button" class="btn mrc-btn-light" data-toggle="modal" data-target="#addProduct"
                                   tooltip="Adicionar produto"
                                   tooltip-placement="top" tooltip-trigger="mouseenter">
                                    Adicionar
                                </a>
                            </td>
                        </tr>
                        <tr ng-repeat="list in request.products" ng-init="productIds.push(+list.pivot.product_id)">
                            <td colspan="3">
                                {{ list.pivot.quantity }} - {{ list.name }}, {{ sizeText[list.size].name }}, custo R$ {{ list.pivot.price }}
                                <div class="pull-right">
                                    <a ng-href role="button" ng-click="dropProduct($index)" class="remove-link label label-danger">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="button-group" style="z-index: 1000000">
                        <a ng-href role="button" ng-click="runTab(1)" class="btn btn-default">Anterior</a>
                        <a ng-href role="button" ng-click="runTab(3)" class="btn btn-primary">Próximo</a>
                    </div>
                </tab>
                <tab heading="Passo 3" active="tab.pass3">
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
                            Situação:
                        </label>
                        <div class="col-md-6">
                            <select ng-model="request.situation" class="form-control">
                                <option value="">Selecione</option>
                                <option ng-repeat="situation in situations" ng-selected="($index+1)==request.situation" value="{{ $index+1 }}">{{ situation }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="button-group" style="z-index: 1000000">
                        <a ng-href role="button" ng-click="runTab(2)" class="btn btn-default">Anterior</a>
                        <button class="btn mrc-btn" id="btn-save">Salvar</button>
                    </div>
                </tab>
            </tabset>
        </form>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Produto</h4>
                </div>
                <div class="modal-body">
                    <div class="form-horizontal">
                        <div class="alert alert-warning alert-dismissible" role="alert"
                             ng-show="messageProduct!=''">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Atenção!</strong>
                            {{ messageProduct }}
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                Produto:
                            </label>
                            <div class="col-md-6">
                                <select ng-model="product_request.product_id" class="form-control" ng-change="productInfo()">
                                    <option value="">Selecione</option>
                                    <option ng-repeat="product in productList" value="{{ product.id }}" ng-selected="request.product_id==product.id"
                                        ng-if="productIds.indexOf(product.id) == -1">
                                        {{ product.name }} - {{ sizeText[product.size].name }} ({{ product.cost | currency}})
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">
                                Quantidade:
                            </label>
                            <div class="col-md-6">
                                <input type="text" ng-keyup="calculateValue()" data-ng-model="product_request.quantity" class="form-control" mask="d?" repeat="10">
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
                                    <input type="text" ng-keyup="calculateValue()" ng-model="product_request.price" class="form-control" mask="9?9?9?9?9?9?9?9?9,99">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" ng-click="addProduct()" class="btn mrc-btn">Adicionar</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>