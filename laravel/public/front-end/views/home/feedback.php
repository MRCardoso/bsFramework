<div ng-controller="FeedbackController" ng-init="find()">
    <div class="list-group" style="margin-bottom: 0">
        <div class="list-group-item" dir-paginate="feedback in feedbacks | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
            <div class="pull-left">
                <strong>{{ feedback.name }} ({{ feedback.email }})</strong>
                <p>{{ feedback.message }}</p>
                <a ng-href role="button" data-toggle="modal" data-target="#data-feed"
                   ng-click="getData(feedback)">
                    details
                </a>
            </div>
            <div class="text-right">
                <span class="label label-{{ labelApp[feedback.application] }}"
                      tooltip="Application" tooltip-placement="top" tooltip-trigger="mouseenter">
                    {{ feedback.application }}
                </span>
                <span class="label label-{{ labelType[feedback.type] }}"
                      tooltip="Type" tooltip-placement="top" tooltip-trigger="mouseenter">
                    {{ feedback.type }}
                </span>
                <span class="label label-{{ labelView[feedback.view_home].label }}"
                      tooltip="In Home {{ labelView[feedback.view_home].text}}" tooltip-placement="top" tooltip-trigger="mouseenter">
                    <span class="glyphicon glyphicon-{{ labelView[feedback.view_home].icon }}-circle"></span>
                </span>
            </div>
            <div class="text-right">
                <span class="label mrc-btn-light"tooltip="created at" tooltip-placement="top" tooltip-trigger="mouseenter">
                    {{ feedback.created_at | myDateFormat:'dd/MM/yyyy HH:mm:ss'}}
                </span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div ng-include="'footer.blade.php' | myUrl"></div>
    <div class="modal fade" id="data-feed" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>
                        <strong>IP</strong>
                        {{ dataList.ip_address }}
                    </p>
                    <p>
                        <strong>UserAgent</strong>
                        {{ dataList.user_agent }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>