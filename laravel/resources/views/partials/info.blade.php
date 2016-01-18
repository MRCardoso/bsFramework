<div class="list-welcome">
    <div id="child">
        <a ng-href="./#!/" title="Logomarca" class="image-mrc">
            <img src="/images/logomarca-mrc4.png" width="50" height="40" alt="image" class="image-logo">
        </a>
        <div class="pull-right">
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
    <div class="clear"></div>
</div>
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