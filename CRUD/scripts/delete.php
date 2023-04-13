<?php

if (!isset($_GET['id'])) {
    header("Location: ../pages/pagina.php");
    exit;
}

require_once("EasyPDO.php");
require_once("functions.php");
use EasyPDO\EasyPDO;
$bd = new EasyPDO();

$_userID = aes_decrypt($_GET['id']);

$_params = [
    ':id' => $_userID
];

$bd->delete("DELETE FROM users WHERE UserID = :id", $_params);

header('Location: ../pages/mostrar_usuarios.php?dlt');
