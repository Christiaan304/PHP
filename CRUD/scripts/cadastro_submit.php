<?php
//verifica se a solicitação foi POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

//verifica se a checkbox foi marcada
if (empty($_POST['checkbox'])) {
    header('Location: ../pages/cadastro.php?err');
    exit;
}

//verificações e validações dos campos vindos pelo post
require_once('functions.php');

//validação do usuário
//o usuário não pode ter mais que 12 caracteres
$user_name = clear($_POST['inputUser']);
$regex = "/^[a-zA-Z0-9\_]{3,12}$/";
if (!preg_match($regex, $user_name)) {
    header('Location: ../pages/cadastro.php?usr');
    exit;
}

//validação do email
$user_email = clear($_POST['inputEmail']);
$regex = "/^[a-z0-9\.\-\_]{4,}@[a-z0-9]{4,}\.(com|com.br)$/";
if (!preg_match($regex, $user_email)) {
    header('Location: ../pages/cadastro.php?emil');
    exit;
}

//validação da senha
//a senha deve conter no mínimo 10 caracteres e no máximo 24
$password = $_POST['inputPassword'];
$regex = "/^.{10,24}$/";
if (!preg_match($regex, $password)) {
    header('Location: ../pages/cadastro.php?psswrd');
    exit;
}

//==============================================
//conexão e inserção dos dados no banco de dados
require_once('EasyPDO.php');
require_once('config.php');

use EasyPDO\EasyPDO;

$bd = new EasyPDO();

$params = [
    ':user_name' => $user_name,
    ':password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]),
    ':user_email' => $user_email
];

$bd->insert(
    "INSERT INTO users (UserName, UserPassword, UserEmail) VALUES (
              AES_ENCRYPT(:user_name, UNHEX(SHA2('" . KEY . "', 512))), 
              :password, 
              AES_ENCRYPT(:user_email, UNHEX(SHA2('" . KEY . "', 512)))
              )",
    $params
);

header("Location: ../index.php?sccss");
