<div class="text-center">
    <div class="image-home"></div>
    <div class="content">
        <ul class="list-libraries">
            <li ng-repeat="data in dataModule">
                <div role="button" popover-placement="top" popover-title="{{ data.name }}"
                   popover="{{ data.text }}" popover-trigger="mouseenter">
                    <div class="box image-{{ data.module }}"></div>
                </div>
            </li>
        </ul>
    </div>
</div>