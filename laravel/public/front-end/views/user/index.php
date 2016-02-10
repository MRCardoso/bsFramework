<div ng-controller="UserController" ng-init="find()">
    <table class="{{ css_class.table }} {{ css_class.responsive }}">
        <thead>
        <tr>
            <th ng-if="auth.group=='admin'">Corporação</th>
            <th>Gravatar</th>
            <th>nome</th>
            <th>E-mail</th>
            <th>Grupo</th>
            <th>usuário</th>
            <th>status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <tr dir-paginate="user in users | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">

            <td ng-if="auth.group=='admin'">{{user.corporate_register.name}}</td>
            <td><img ng-src="http://www.gravatar.com/avatar/{{user.email | gravatar}}?s=25"></td>
            <td>{{user.name}}</td>
            <td>{{user.email}}</td>
            <td>{{groups[user.group].name}}</td>
            <td>{{user.username}}</td>
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