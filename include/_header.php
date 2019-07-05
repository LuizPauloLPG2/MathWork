<?php session_start(); ?>
<?php require_once("../config/_db.php") ?>
<?php require_once("../config/_config.php") ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="../lib/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../lib/jquery-confirm-v3.3.4/css/jquery-confirm.css" rel="stylesheet">
    <link href="../lib/datatable-responsive/datatable.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css" />

    <link href="../css/index.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MELINA SYSTEM</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light border">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="m-2 btn btn-danger" href="../src/">LOJA DE PEÇAS</a>
                <?php if (isset($_SESSION['tipo_usuario']) && $_SESSION['tipo_usuario'] == 'A') { ?>
                    <a class="m-2 btn btn-danger" href="company.php">EMPRESA</a>
                    <a class="m-2 btn btn-danger" href="report.php">RELATÓRIO DE COMPRAS</a>
                <?php } ?>
            </div>
            <?php if (isset($_SESSION['id_usuario'])) { ?>
                <strong>Olá <?php echo $_SESSION['nome_usuario']; ?></strong>
                <a class="m-2 btn btn-danger" id="button_logout" href="#">SAIR</a>
            <?php } else { ?>
                <a class="m-2 btn btn-danger" href="login.php">LOGIN</a>
            <?php } ?>
            <? php ?>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>