<div class="{{css_class.save}}" ng-controller="UserController" ng-init="findOne()">
    <div ng-if="blockPage.status==200">
        <table class="{{css_class.table}}">
            <tr>
                <th>Corporação</th>
                <td>{{ user.corporate_register.name }}</td>
            </tr>
            <tr>
                <th>Nome</th>
                <td>{{ user.name }}</td>
            </tr>
            <tr>
                <th>Group</th>
                <td>{{ groups[user.group].name }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><a href="mailto:{{user.email}}">{{ user.email }}</a></td>
            </tr>
            <tr>
                <th>Usuário</th>
                <td>{{ user.username }}</td>
            </tr>
            <tr>
                <th>Alterações</th>
                <td>
                    <generic-field module="{type:'changes', resource:user}"></generic-field>
                </td>
            </tr>
        </table>
        <div class="clear"><br></div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" ng-if="user.group=='company'">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#clientCollapse" ng-click="$event.preventDefault()" data-toggle="collapse" data-parent="#accordion">
                            Funcionários
                        </a>
                    </h4>
                </div>
                <div id="clientCollapse" class="panel-collapse collapse">
                    <div class="panel-body">
                        <input type="text" class="form-control" ng-model="filterEmployee" placeholder="filtre por um funcionário...">
                        <div class="list-group">
                            <div dir-paginate="employee in employees | orderBy: '-id' | filter:filterEmployee | itemsPerPage: 5" current-page="currentPage" class="list-group-item">
                                <strong>{{ employee.name}}</strong> - {{ employee.email}}
                            </div>
                        </div>
                        <div ng-include="'footer.blade.php' | myUrl"></div>
                    </div>
                </div>
            </div>
        </div>
        <my-actions module="module"></my-actions>
    </div>
</div>