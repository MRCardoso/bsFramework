<div ng-controller="CompanyController" ng-init="find()">
    <table class="{{ css_class.table }}">
        <thead>
        <tr>
            <th>Usuário</th>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Status</th>
            <th width="8%">Ações</th>
        </tr>
        </thead>
        <tbody>
            <tr dir-paginate="company in companies | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
                <td>{{company.user.name}}</td>
                <td>{{company.name}}</td>
                <td>{{company.cnpj | registry}}</td>
                <td>{{company.address}}</td>
                <td>{{company.phone | phone }}</td>
                <td>{{company.email}}</td>
                <td>
                    <generic-field module="{type:'status', resource:company, text:statusText}"></generic-field>
                </td>
                <td>
                    <table-btn module="{id:company.id,name:moduleName, resource:company}"></table-btn>
                </td>
            </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>
