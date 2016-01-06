<div class="input-group" ng-if="$parent.permission(module.resource,'interface')">
    <a ng-href="./#!/{{module.name}}/{{ module.id }}" class="remove-link label label-warning">
        <span class="glyphicon glyphicon-eye-open"></span>
    </a>
    <a ng-href="./#!/{{module.name}}/{{ module.id }}/edit" class="remove-link label label-primary">
        <span class="glyphicon glyphicon-edit"></span>
    </a>
    <a ng-href role="button" ng-click="$parent.$parent.delete(module.id)" class="remove-link label label-danger">
        <span class="glyphicon glyphicon-remove"></span>
    </a>
</div>