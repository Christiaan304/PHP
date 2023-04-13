<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    die();
}

require_once("functions.php");
require_once("EasyPDO.php");
require_once("config.php");
use EasyPDO\EasyPDO;
$bd = new EasyPDO();

$_userID = aes_decrypt($_POST['UserID']);

if ($_userID == -1 || $_userID == false) {
    header("Location: ../edit.php");
    die();
}

$_params = [
    ':id' => $_userID,
    ':userName' => $_POST['inputUser'],
    ':userEmail' => $_POST['inputEmail']
];

$bd->update("UPDATE users SET 
             UserName = AES_ENCRYPT(:userName, UNHEX(SHA2('". KEY ."', 512))),
             UserEmail = AES_ENCRYPT(:userEmail, UNHEX(SHA2('". KEY ."', 512)))
             WHERE UserID = :id", 
             $_params);

header("Location: ../pages/mostrar_usuarios.php?edt");
