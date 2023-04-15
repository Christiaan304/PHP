<?php
//verifica se a solicitação foi POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

require_once('functions.php');

//verifica se o ID do usuario vem pelo POST e se está criptografado
$userID = aes_decrypt($_POST['UserID']);
if ($userID == -1 || $userID == false) {
    header("Location: ../edit.php");
    exit;
}

//validação do usuário
$user_name = clear($_POST['inputUser']);
$regex = "/^[a-zA-Z0-9\_]{3,12}$/";
if (!preg_match($regex, $user_name)) {
    header('Location: ../pages/edit.php?usr');
    exit;
}

//validação do email
$user_email = clear($_POST['inputEmail']);
$regex = "/^[a-z0-9\.\-\_]{4,}@[a-z0-9]{4,}\.(com|br|com.br)$/";
if (!preg_match($regex, $user_email)) {
    header('Location: ../pages/edit.php?emil');
    exit;
}

//================================
//conexão e inserção dos dados no banco de dados
require_once("EasyPDO.php");
require_once("config.php");
use EasyPDO\EasyPDO;
$bd = new EasyPDO();

$params = [
    ':id' => $userID,
    ':user_name' => $user_name,
    ':user_email' => $user_email
];

$bd->update("UPDATE users SET 
             UserName = AES_ENCRYPT(:user_name, UNHEX(SHA2('". KEY ."', 512))),
             UserEmail = AES_ENCRYPT(:user_email, UNHEX(SHA2('". KEY ."', 512)))
             WHERE UserID = :id", 
             $params);

header("Location: ../pages/mostrar_usuarios.php?edt");
