<div class="loading" ng-show="loading"></div>
<div class="wrap">
    <div class="content-scroll">
        @if( Auth::user() != NULL )
            @include('partials.menu')
            <div class="container" ng-show="!loading">
                <!---load the breadcrumb-->
                <div ng-include="'header.php' | myUrl"></div>
                <!--load the page error-->
                <div ng-include="'error.php' | myUrl"></div>
                <div class="template-head display-none" ng-hide="save" ng-show="blockPage.status==200">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn">
                                <i tooltip="Página @{{ currentPage }} de @{{ Math.ceil(totalItems/limit) }} Total @{{ totalItems }}"
                                   tooltip-placement="top" tooltip-trigger="mouseenter">
                                    @{{ currentPage }} - @{{ Math.ceil(totalItems/limit) }} de @{{ totalItems }}
                                </i>
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
</div>
<div class="footer" ng-show="!loading">
    <div class="container">
        <div class="pull-right">
            <a href="/yii/" style="text-decoration: none" tooltip="acesso este sistema pelo Yii"
               tooltip-placement="top" tooltip-trigger="mouseenter">
                {!!
                    Html::image('public/images/yii.png','',['class'=> 'image-logo'])
                !!}
            </a>
            <a href="/" style="text-decoration: none" tooltip="Volte a raiz do sistema"
               tooltip-placement="top" tooltip-trigger="mouseenter">
                {!!
                    Html::image('public/images/logomarca-mrc4.png','',['class'=> 'image-logo'])
                !!}
            </a>

        </div>
        <div class="text-center">
            <?php echo  "<strong>&copy; MRC - ".date('Y')." @developed with Laravel Artisan on your version ".$app->version()."</strong>"; ?>
        </div>
    </div>
</div>