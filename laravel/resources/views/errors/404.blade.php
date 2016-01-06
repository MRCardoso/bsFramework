<!DOCTYPE html>
<html>
<head>
    <title>Be right back.</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('/lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }
        .title {
            font-size: 72px;
            margin-bottom: 40px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">Página não encontrada.</div>
        <button onclick="history.back()" class="btn mrc-btn-light">Voltar</button>
    </div>
</div>
</body>
</html>
