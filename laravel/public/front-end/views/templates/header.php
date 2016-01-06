<div ng-class="{'border content content-large': save}" ng-if="moduleName != ''">
    <ul class="breadcrumb">
        <li><a ng-href="./#!/">Home</a></li>
        <li>
            <a ng-href="./#!/{{moduleName}}" data-ng-show="save">
                <span data-ng-bind="moduleLabel"></span>
            </a>
            <span data-ng-bind="moduleLabel" data-ng-show="!save"></span>
        </li>
        <li data-ng-show="save">{{TITLE_SAVE}}</li>
    </ul>
</div>