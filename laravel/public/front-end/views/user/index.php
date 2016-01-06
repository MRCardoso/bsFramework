<div ng-controller="UserController" ng-init="find()">
    <table class="{{ css_class.table }}">
        <thead>
        <tr>
            <th>Corporação</th>
            <th>Grupo</th>
            <th>usuário</th>
            <th>nome</th>
            <th>E-mail</th>
            <th>status</th>
            <th width="8%">Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr dir-paginate="user in users | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
            <td>{{user.corporate_register.name}}</td>
            <td>{{groups[user.group].name}}</td>
            <td>{{ user.corporate_register_id}} {{user.username}}</td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>
                <generic-field module="{type:'status', resource:user, text:statusText}"></generic-field>
            </td>
            <td>
                <table-btn module="{id:user.id,name:moduleName, resource:user}"></table-btn>
            </td>
        </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>