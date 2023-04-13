<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    die();
}

session_start();

$_userName = htmlspecialchars($_POST['inputUser']);
$_password = htmlspecialchars($_POST['inputPassword']);

require_once('EasyPDO.php');
require_once('config.php');
use EasyPDO\EasyPDO;
$_bd = new EasyPDO();

$_params = [
    ':userName' => $_userName
];

$_stmt = $_bd->select("SELECT UserPassword FROM users WHERE 
                       UserName = AES_ENCRYPT(:userName, UNHEX(SHA2('". KEY ."', 512)))",
                       $_params)[0];

if (password_verify($_password, $_stmt['UserPassword'])) {
    $_SESSION['user'] = $_userName;
    header('Location: ../pages/pagina.php');
    exit;
} 
else {
    header('Location: ../index.php?err');
}
