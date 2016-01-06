<div class="{{css_class.save}}" ng-controller="ProductController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <table class="{{css_class.table}}">
            <tr>
                <th>Usuário</th>
                <td>{{ product.user.name}}</td>
            </tr>
            <tr>
                <th>Nome</th>
                <td>{{ product.name}}</td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td>{{ product.description}}</td>
            </tr>
            <tr>
                <th>Tamanho</th>
                <td>
                <span class="label label-{{sizeText[product.size].class}}"
                      tooltip="Status : {{sizeText[product.size].name}}" tooltip-placement="top" tooltip-trigger="mouseenter">
                    <span class="glyphicon glyphicon-{{status[product.size].icon}}-circle"></span>
                    <span data-ng-bind="sizeText[product.size].name"></span>
                </span>
                </td>
            </tr>
            <tr>
                <th>Preço</th>
                <td>{{ product.cost }}</td>
            </tr>
            <tr>
                <td>
                    <div class="text-right">
                        <strong>Status:</strong>
                    <span class="label label-{{statusText[product.status].class}}"
                          tooltip="Status : {{statusText[product.status].name}}" tooltip-placement="top" tooltip-trigger="mouseenter">
                        <span class="glyphicon glyphicon-{{status[product.status].icon}}-circle"></span>
                        <span data-ng-bind="statusText[product.status].name"></span>
                    </span>
                    </div>
                </td>
                <td>
                    <strong>Criado em:</strong>
                    <span data-ng-bind="product.created_at | myDateFormat:'dd/MM/yyyy HH:mm:ss'"></span>
                </td>
            </tr>
        </table>
        <div class="clear"><br></div>
        <my-actions module="module"></my-actions>
    </div>
</div>