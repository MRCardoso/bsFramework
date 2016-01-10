<div class="{{css_class.save}}" ng-controller="RequestController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#clientCollapse" ng-click="$event.preventDefault()" data-toggle="collapse" data-parent="#accordion">
                            Cliente
                        </a>
                    </h4>
                </div>
                <div id="clientCollapse" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table class="{{css_class.table}}">
                            <tr>
                                <th class="text-right">Nome</th>
                                <td>{{ request.client.name }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Telefone</th>
                                <td>{{ request.client.phone}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Endereço</th>
                                <td>
                                    {{ request.client.address}}
                                    <span ng-show="request.client.number!=null">Nº {{request.client.number}}</span>
                                    <span ng-show="request.client.reference!=null">- {{ request.client.reference }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="collapsed" ng-click="$event.preventDefault()" data-toggle="collapse" data-parent="#accordion" href="#productCollapse">
                            Produtos
                        </a>
                    </h4>
                </div>
                <div id="productCollapse" class="panel-collapse collapse" role="tabpanel">
                    <div class="panel-body">
                        <div class="list-group">
                            <div class="list-group-item" ng-repeat="product in request.products">
                                {{ product.pivot.quantity }} - {{ product.name }}, custo R$ {{ product.pivot.price }}
                                <div class="pull-right">
                                    <generic-field module="{type:'size', resource: product, text:sizeText}"></generic-field>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" ng-click="$event.preventDefault()" data-toggle="collapse" data-parent="#accordion" href="#deliverymanCollapse" aria-expanded="false" aria-controls="deliverymanCollapse">
                            Entregador
                        </a>
                    </h4>
                </div>
                <div id="deliverymanCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <table class="{{css_class.table}}">
                            <tr>
                                <th class="text-right">Nome</th>
                                <td>{{ request.deliveryman.name }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">CPF</th>
                                <td>{{ request.deliveryman.cpf | registry }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">RG</th>
                                <td>{{ request.deliveryman.rg}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Celular</th>
                                <td>{{ request.deliveryman.cellphone | phone}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" ng-click="$event.preventDefault()" data-toggle="collapse" data-parent="#accordion" href="#requestCollapse" aria-expanded="false" aria-controls="requestCollapse">
                            Pedido
                        </a>
                    </h4>
                </div>
                <div id="requestCollapse" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        <table class="{{css_class.table}}">
                            <tr>
                                <th class="text-right">Usuário</th>
                                <td>{{ request.user.name }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Descrição</th>
                                <td>{{ request.description}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Observação</th>
                                <td>{{ request.observation}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Data do pedido</th>
                                <td>{{ request.request_date}}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Valor Total</th>
                                <td>{{ total = getValues(request) | currency:'' }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">Encargos</th>
                                <td>
                                    <strong>Desconto:</strong> {{ request.discount || '0,00' }}
                                    <strong>Frete:</strong> {{ request.freight || '0,00'}}
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right">Situação</th>
                                <td>
                                    <generic-field module="{type:'situation', resource:request, text:situationText}"></generic-field>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-right">Alterações</th>
                                <td>
                                    <generic-field module="{type:'changes', resource:request}"></generic-field>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <my-actions module="module"></my-actions>
    </div>
</div>