<div class="button-group" style="z-index: 1000000">
    <div ng-if="!module.btnAction">
        <a ng-href="./#!/{{module.name}}" class="btn btn-default">
            Voltar
        </a>
        <a ng-href="./#!/{{module.name}}/{{module.id}}/edit" class="btn btn-primary" ng-if="module.hasPermission.interface">
            Editar
        </a>
        <a ng-href role="button" ng-click="$parent.$parent.$parent.delete(module.id)" class="btn btn-danger">
            Remover
        </a>
        <a ng-href="./#!/{{module.name}}/create" class="btn mrc-btn-light" ng-if="module.hasPermission.newButton">
            Criar
        </a>
    </div>
    <div ng-if="module.btnAction">
        <a ng-href="./#!/{{module.name}}" class="btn btn-default">Cancelar</a>
        <button class="btn mrc-btn" id="btn-save">Salvar</button>
    </div>
</div>