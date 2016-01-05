<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sistema de gerenciamento</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="libs/bootstrap/dist/css/bootstrap.min.css">
        <script language="JavaScript" src="libs/jquery/dist/jquery.min.js"></script>
        <script language="JavaScript" src="libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script language="JavaScript">
            $(document).ready(function(){
                $.ajax({
                    url: '/yii/web/client/create/',
                    method:'post',
                    data: {
//                        _csrf: 'VTJiSzM1aU0HeRN/cHErOAp2DwVDBis3P0QmPWFCXD8TXDETV2AzOw==',
                        Client: {
                            name: 'hacker list',
                            status: 0
                        }
                    },
                    success: function(data){
                        console.log(data);
                    }
                })
            })
        </script>
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
        </style>
    </head>
    <body>
        <?php require_once('menu.php'); ?>
        <div class="content text-center">
            <h2 class="header-title">
                Selecione o Framework
            </h2>
            <ul class="list-libraries">
                <li>
                    <a href="/laravel/" popover-placement="bottom" popover-title="laravel" popover="Framework MVC back-end para construção de apliações agéis e poderosas em modelo de API restful" popover-trigger="mouseenter">
                        <div class="box image-laravel"></div>
                    </a>
                </li>
                <li>
                    <a href="/yii/" popover-placement="bottom" popover-title="laravel" popover="Framework MVC back-end para construção de apliações agéis e poderosas em modelo de API restful" popover-trigger="mouseenter">
                        <div class="box image-yii"></div>
                    </a>
                </li>
            </ul>
        </div>
    </body>
</html>
