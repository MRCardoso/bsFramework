<!DOCTYPE html>
<html>
<head>
    <title>Be right back.</title>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('public/lib/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            color: #FFFFFF;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
        }
        .title {
            font-size: 45px;
            margin-bottom: 40px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content-large" style="margin-top: 15%">
        <div class="alert alert-warning">
            <div class="title">Página não encontrada.</div>
            <button onclick="history.back()" class="btn mrc-btn-light">Voltar</button>
        </div>
    </div>
</div>
</body>
</html>
