<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

if (!isset($_POST['checkbox'])) {
    header('Location: ../pages/cadastro.php?err');
    exit;
}

$_user = htmlspecialchars(trim($_POST['inputUser']));
$_password = $_POST['inputPassword'];
$_email = htmlspecialchars(trim($_POST['inputEmail']));

$_regex = '/[\/\;\:\!\#\$\%\&\'\*\"\,\+\-\=\?\^\`\{\|\}\~\[\]\<\>\(\)]/';
if (!preg_match($_regex, $_email)) {
    if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../pages/cadastro.php?emil');
        exit;
    }
} else {
    header('Location: ../pages/cadastro.php?emil');
    exit;
}

require_once('EasyPDO.php');
require_once('config.php');

use EasyPDO\EasyPDO;

$_bd = new EasyPDO();

$_params = [
    ':userName' => $_user,
    ':password' => password_hash($_password, PASSWORD_BCRYPT, ['cost' => 12]),
    ':email' => $_email
];

$_bd->insert(
    "INSERT INTO users (UserName, UserPassword, UserEmail) VALUES (
              AES_ENCRYPT(:userName, UNHEX(SHA2('" . KEY . "', 512))), 
              :password, 
              AES_ENCRYPT(:email, UNHEX(SHA2('" . KEY . "', 512)))
              )",
    $_params
);

header("Location: ../index.php?sccss");
