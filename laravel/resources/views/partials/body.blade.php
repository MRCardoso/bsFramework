<div class="wrap">
    @if( Auth::user() != NULL )
        @include('partials.menu')
        <div class="container">
            <!---load the breadcrumb-->
            <div ng-include="'header.php' | myUrl"></div>
            <!--load the page error-->
            <div ng-include="'error.php' | myUrl"></div>
            <div class="template-head display-none" ng-hide="save">
                <div class="input-group">
                    <span class="input-group-btn">
                        <span class="btn btn-default">
                            <i data-ng-bind="'Página' + ' ' + currentPage + ' de ' + Math.ceil(totalItems/limit)"></i>
                            <i data-ng-bind="'Total' + ' ' + totalItems"></i>
                        </span>
                    </span>
                    <input type="text" ng-model="filter" class="form-control" ng-change="listen()">
                    <span class="input-group-btn" ng-if="viewCreate">
                        <a href="./#!/@{{ moduleName }}/create" class="btn mrc-btn-light">
                            <span class="glyphicon glyphicon-plus"></span> Novo
                        </a>
                    </span>
                </div>
            </div>
            <div ng-view></div>
        </div>
        <script language="JavaScript">
            user["initPath"] = "home";
            @foreach( auth()->user()->getAttributes() as $line => $row)
                user['{{ $line }}'] = '{{ $row }}';
            @endforeach
            @foreach( getModules() as $line => $module)
                modules['{{$line}}'] = '{{$module['name']}}';
            @endforeach
        </script>
    @else
        @include('partials.info')
        <div ng-view></div>
    @endif
    <script language="JavaScript">
        angular.module('main').service('Token',function ()
        {
            this.getToken = function () { return '{{csrf_token()}}'; };
        });
        @foreach( labelText() as $label => $rowData)
            var list = {};
            @foreach( $rowData as $key => $property)
                list['{{ $key }}'] = {
                'name': "{{ $property["name"] }}",
                'class': '{{ $property["class"] }}',
                'key': '{{ $key }}'
            };
            @endforeach
            labels['{{ $label }}'] = list;
        @endforeach
    </script>
</div>
<div class="footer">
    <div class="container">
        <div class="pull-right">
            <a href="/" style="text-decoration: none">
                {!!
                    Html::image('public/images/logomarca-mrc4.png','',[
                        'class'=> 'image-logo',
                        'title'=>'Volte a raiz do sistema',
                        'data-toggle'=>'tooltip'
                    ])
                !!}
            </a>
            <a href="/yii/" style="text-decoration: none">
                {!!
                    Html::image('public/images/yii.png','',[
                        'class'=> 'image-logo',
                        'title'=>'acesso este sistema pelo Laravel',
                        'data-toggle'=>'tooltip'
                    ])
                !!}
            </a>
        </div>
        <div class="text-center">
            <?php echo  "<strong>&copy; MRC - ".date('Y')." @developed with Laravel Artisan on your version ".$app->version()."</strong>"; ?>
        </div>
    </div>
</div>