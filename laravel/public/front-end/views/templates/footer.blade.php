<div class="template-foot" ng-if="totalItems > limit">
    <div class="text-right">
        <dir-pagination-controls boundary-links="true" on-page-change="changePage(newPageNumber)"></dir-pagination-controls>
    </div>
</div>
<div class="template-foot" ng-if="totalItems == 0 && (filter != null && filter != '')">
    <span class="glyphicon glyphicon-info-sign"></span>
    Nenhum resultado encontrado para <strong>'@{{filter}}'</strong>
</div>