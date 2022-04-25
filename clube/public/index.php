<?php
    // INICIA DO SISTEMA DE SESSÕES
    session_start();

    // DEFINIR UMA CONSTANTE DE CONTROLE
    define('CONTROLE', true);

    // SCRIPTS NECESSÁRIOS
    require_once '../libs/config.php';
    require_once '../libs/EasyPDO.php';
    require_once '../libs/functions.php';

    // SISTEMA DE ROTAS
    require_once 'route.php';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./script/bootstrap.bundle.min.js" defer></script>
    <link rel="stylesheet" href="./style/bootstrap.min.css">
    <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
    <title>Clube</title>
</head>

<body>
    
</body>

</html>