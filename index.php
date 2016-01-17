<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <title>Sistema de gerenciamento</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="/favicon.png" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bs.style.css">
        <style>
            .list-libraries{
                list-style: none;
            }
            .list-libraries li{
                display: inline-block;
                margin-right: 0.6%;
            }
            .box{
                -webkit-border-radius: 50%;
                -moz-border-radius: 50%;
                border-radius: 50%;
                width: 220px;
                height: 220px;
                -webkit-box-shadow: inset 0 0 200px #333333;
                -moz-box-shadow: inset 0 0 200px #333333;
                box-shadow: inset 0 0 200px #333333;
                -webkit-transition: all 1s linear;
                -o-transition: all 1s linear;
                -moz-transition: all 1s linear;
                -ms-transition: all 1s linear;
                -kthtml-transition: all 1s linear;
                transition: all 1s linear;
                /*opacity: 0.3;*/
            }
            .box:hover{
                -webkit-box-shadow: inset 0 0 10px #333333;
                -moz-box-shadow: inset 0 0 10px #333333;
                box-shadow: inset 0 0 10px #333333;
                -webkit-transition: all 1s linear;
                -o-transition: all 1s linear;
                -moz-transition: all 1s linear;
                -ms-transition: all 1s linear;
                -kthtml-transition: all 1s linear;
                transition: all 1s linear;
            }
            .content{
                padding: 1.5%;
                margin: 10% 25%;
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
                border: 1px solid #E6DAFF;
                background: #FAFAFA;
                box-shadow: inset 0 0 10px #000;
            }
            .image-laravel{
                background: #E9EdE9 url('/images/laravel.png') no-repeat center;
                background-size: 80%;
            }
            .image-yii{
                background: #E9EdE9 url('/images/yii.png') no-repeat center;
                background-size: 80%;
            }
            .text-center{
                text-align: center;
            }
            .header-title{
                color: #A9A0AD;
                text-shadow: 0 2px 2px #000;
                font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif;
            }
            .indent{
                text-indent: 40px
            }
        </style>
    </head>
    <body>

        <div ng-include="'menu.html'"></div>
        <div ng-view></div>
        <script language="JavaScript" src="/libs/jquery/dist/jquery.min.js"></script>
        <script language="Javascript" src="/libs/angular/angular.js"></script>
        <script language="JavaScript" src="libs/angular-route/angular-route.js"></script>
        <script language="JavaScript" src="libs/angular-resource/angular-resource.js"></script>
        <script language="JavaScript" src="/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script language="JavaScript" src="modules/controllers/bs.feedback.js"></script>
        <script language="JavaScript" src="modules/bs.main.js"></script>
        <script language="JavaScript" src="bs.app.js"></script>
        <script language="JavaScript" src="bs.routes.js"></script>
    </body>
</html>
