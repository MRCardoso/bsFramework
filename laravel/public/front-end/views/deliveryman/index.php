<div ng-controller="DeliverymanController" ng-init="find()">
    <table class="{{ css_class.table }} {{ css_class.responsive }}">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>name</th>
                <th>CPF</th>
                <th>RG</th>
                <th>Celular</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr dir-paginate="deliveryman in deliverymen | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
                <td>{{deliveryman.company.name}}</td>
                <td>{{deliveryman.name}}</td>
                <td>{{deliveryman.cpf | registry}}</td>
                <td>{{deliveryman.rg}}</td>
                <td>{{deliveryman.cellphone | phone}}</td>
                <td>
                    <generic-field module="{type:'status',resource:deliveryman,text:statusText}"></generic-field>
                </td>
                <td>
                    <table-btn module="{id:deliveryman.id,name:moduleName,resource:deliveryman}"></table-btn>
                </td>
            </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>