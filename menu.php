<?php $version = exec('sudo git describe --abbrev=0 --tags'); ?>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" ng-href="/#!/">
                <img src="images/logomarca-mrc4.png" width="40" height="30">
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a ng-href="/#!/about">Sobre</a>
                </li>
                <li>
                    <a ng-href="/#!/feedback">FeedBack</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="https://github.com/MRCardoso/bsFramework/releases/tag/<?php echo $version; ?>" role="button" target="_blank">
                        <?php echo "Versão {$version}";?>
                    </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>