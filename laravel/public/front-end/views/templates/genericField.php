<td ng-if="module.type=='changes'">
    {{ module.resource.created_at | myDateFormat:'dd/MM/yyyy HH:mm:ss' }} | {{ module.resource.updated_at | myDateFormat:'dd/MM/yyyy HH:mm:ss'}}
</td>
<td ng-if="module.type=='status'">
    <span class="label label-{{module.text[module.resource.status].class}}"
          tooltip="Status : {{module.text[module.resource.status].name}}" tooltip-placement="top" tooltip-trigger="mouseenter">
        <span class="glyphicon glyphicon-{{module.resource[module.resource.status].icon}}-circle"></span>
        <span data-ng-bind="module.text[module.resource.status].name"></span>
    </span>
</td>
<td ng-if="module.type=='situation'">
    <span class="label label-{{module.text[module.resource.situation].class}}"
          tooltip="Situação : {{module.text[module.resource.situation].name}}" tooltip-placement="top" tooltip-trigger="mouseenter">
        {{module.text[module.resource.situation].name}}
    </span>
</td>
<td ng-if="module.type=='size'">
    <span class="label label-{{module.text[module.resource.size].class}}"
          tooltip="Status : {{module.text[module.resource.size].name}}" tooltip-placement="top" tooltip-trigger="mouseenter">
        <span data-ng-bind="module.text[module.resource.size].name"></span>
    </span>
</td>