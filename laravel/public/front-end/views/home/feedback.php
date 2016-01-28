<div ng-controller="FeedbackController" ng-init="find()">
    <table class="{{ css_class.table }} {{ css_class.responsive}}" ng-if="blockPage.status==200">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>mail</th>
            <th>message</th>
            <th>type</th>
            <th>application</th>
            <th>in home</th>
            <th>Created</th>
        </tr>
        </thead>
        <tbody>
        <tr  dir-paginate="feedback in feedbacks | orderBy: '-id' | filter:filter | itemsPerPage: limit" current-page="currentPage">
            <td>{{ feedback.id }}</td>
            <td>{{ feedback.name }}</td>
            <td>{{ feedback.email }}</td>
            <td>{{ feedback.message }}</td>
            <td>
                <span class="label label-{{ labelType[feedback.type] }}">
                    {{ feedback.type }}
                </span>
            </td>
            <td>
                <span class="label label-{{ labelApp[feedback.application] }}">
                    {{ feedback.application }}
                </span>
            </td>
            <td>
                <span class="label label-{{ labelView[feedback.view_home].label }}"
                      tooltip="{{ labelView[feedback.view_home].text}}" tooltip-placement="top" tooltip-trigger="mouseenter">
                    <span class="glyphicon glyphicon-{{ labelView[feedback.view_home].icon }}-circle"></span>
                </span>
            </td>
            <td>
                <span class="label mrc-btn-light">
                    {{ feedback.created_at | myDateFormat:'dd/MM/yyyy HH:mm:ss'}}
                </span>
            </td>
        </tr>
        </tbody>
    </table>
    <div ng-include="'footer.blade.php' | myUrl"></div>
</div>