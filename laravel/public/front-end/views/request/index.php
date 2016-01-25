<div ng-controller="RequestController" ng-init="find()">
    <table class="{{ css_class.table }} {{ css_class.responsive }}">
        <thead>
            <tr>
                <th>Entregador</th>
                <th>Cliente</th>
                <th>Produto</th>
                <th>Descrição</th>
                <th>Valor Total</th>
                <th>Data do pedido</th>
                <th>Situação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr dir-paginate="request in requests | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
                <td>{{request.deliveryman.name}}</td>
                <td>{{request.client.name}}</td>
                <td>{{request.product.name}}</td>
                <td>{{request.description}}</td>
                <td>{{total = getValues(request) | currency:''}}</td>
                <td>{{request.request_date| date:'dd/MM/yy'}}</td>
                <td>
                    <generic-field module="{type:'situation',resource:request,text:situationText}"></generic-field>
                </td>
                <td>
                    <table-btn module="{id:request.id,name:moduleName,resource:request}"></table-btn>
                </td>
            </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>