<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-menu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a ng-href="./#!/" class="navbar-brand">
                <span class="glyphicon glyphicon-home"></span>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-menu">
            <div class="nav navbar-nav navbar-right">
                <a ng-href="{{url('/#!/signup')}}" id="signup" class="btn mrc-btn signup">
                    Criar conta
                    <span class="glyphicon glyphicon-share"></span>
                </a>
                <a href="{{ url('/signin') }}" id="signin" accesskey="I" class="btn mrc-btn signin">
                    Acessar
                    <span class="glyphicon glyphicon-log-in"></span>
                </a>
            </div>
        </div>
    </div>
</nav>