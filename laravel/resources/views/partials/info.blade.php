<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a ng-href="./#!/" class="navbar-brand">
                <span class="glyphicon glyphicon-home"></span>
            </a>
        </div>
        <div class="navbar-right">
            <a ng-href="{{url('/#!/signup')}}" id="signup" class="btn mrc-btn signup">
                <span id="signup-txt"></span>
                <span class="glyphicon glyphicon-share"></span>
            </a>
            <a href="{{ url('/signin') }}" id="signin" accesskey="I" class="btn mrc-btn signin">
                <span id="signin-txt"></span>
                <span class="glyphicon glyphicon-log-in"></span>
            </a>
        </div>
    </div>
</nav>
<script type="text/javascript">
    $(document).ready(function ()
    {
        $("#signup").on('mouseenter', function ()
        {
            $(this).children('span[id=signup-txt]').text("Criar conta");
        }).on('mouseleave', function () {
            $(this).children('span[id=signup-txt]').text("");
        });
        $("#signin").on('mouseenter', function ()
        {
            $(this).children('span[id=signin-txt]').text("Acessar");
        }).on('mouseleave', function () {
            $(this).children('span[id=signin-txt]').text("");
        });
        var size = Math.round(window.innerWidth/9);
        var styless = { width: size+'px', height: size+'px' };
        $('.box').css(styless);
        $(window).resize(function ()
        {
            var size = Math.round(window.innerWidth/9);
            var styless = { width: size+'px', height: size+'px' };
            $('.box').css(styless);
        });
    });
</script>