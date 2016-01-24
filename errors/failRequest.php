<?php
ini_set('display_errors',1);
require('messages.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo get_response_message(); ?></title>
    <meta charset="utf-8">
    <link href="/favicon.png" rel="shortcut icon" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bs.style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-weight: 100;
            color: #000;
            background: #eFeFeF;
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="container">
        <div class="content-large alert-warning" style="margin-top: 15%">
            <header>
                <h1><?php echo http_response_code(); ?></h1>
                <h3><?php echo get_response_message(); ?></h3>
            </header>
            <article>
                <img src="/images/logomarca-mrc4.png" class="image-logo">
            </article>
        </div>
    </section>
    </body>
</html>