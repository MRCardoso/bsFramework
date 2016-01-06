<div ng-controller="ProductController" ng-init="find()">
    <table class="{{ css_class.table }}">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Tamanho</th>
                <th>Status</th>
                <th width="8%">Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr dir-paginate="product in products | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
                <td>{{product.user.name}}</td>
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td>{{product.cost | currency}}</td>
                <td>
                    <generic-field module="{type:'size',resource:product,text:sizeText}"></generic-field>
                </td>
                <td>
                    <generic-field module="{type:'status',resource:product,text:statusText}"></generic-field>
                </td>
                <td>
                    <table-btn module="{id:product.id,name:moduleName,resource:product}"></table-btn>
                </td>
            </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>