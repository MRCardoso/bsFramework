<div ng-controller="ClientController" ng-init="find()">
    <table class="{{css_class.table}}">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Aniversário</th>
                <th>Endereço</th>
                <th>Status</th>
                <th width="8%">Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr dir-paginate="client in clients | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
                <td>{{ client.name }}</td>
                <td>{{ client.phone | phone}}</td>
                <td>{{ client.birthday | date:'dd/MM/yyyy' }}</td>
                <td>{{ client.address }} {{ client.number }}</td>
                <td>
                    <generic-field module="{type:'status', resource:client, text:statusText}"></generic-field>
                </td>
                <td>
                    <table-btn module="{id:client.id,name:moduleName, resource:client}"></table-btn>
                </td>
            </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>