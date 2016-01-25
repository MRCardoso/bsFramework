<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-laravel-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a ng-href="./#!/" class="navbar-brand">
                <span class="glyphicon glyphicon-home"></span>
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-laravel-menu">
            <ul class="nav navbar-nav menu-action">
                @foreach( getModules() as $line => $module)
                    {{--@if( $module["name"] == "usuario" && (Auth::user()->group != "admin") )--}}
                        {{--@continue--}}
                    {{--@endif--}}
                    {{--<script> modules['{{$line}}'] = '{{$module['name']}}'; </script>--}}
                    <li id="{{$line}}">
                        <a ng-href="./#!/{{$line}}" ng-click="changeClass('{{$line}}')">
                            <span class="glyphicon glyphicon-{{$module["icon"]}}"></span> {{$module['name']}}
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a data-ng-href role="button" class="dropdown-toggle profile-container" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false">
                        {{--<img ng-src="{{showImages(Auth::user->name)}}" class="profile-image">--}}
                        {{ Auth::user()->name }}
                        <span class="glyphicon glyphicon-dashboard"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a ng-href="./#!/user/{{Auth::user()->id}}" accesskey=">">
                                <span class="glyphicon glyphicon-education"></span>
                                meus dados
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a ng-href="{{ url('/logout') }}">
                                <span class="glyphicon glyphicon-log-out"></span>
                                sair
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>