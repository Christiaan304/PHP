<?php
    if(!isset($_POST['editar']))
    {
        die(':(');
    }

    require_once 'connectionDB.php';
    require_once 'cypher.php';

    $id = htmlspecialchars(aes_decrypt($_POST['id']));
    if($id == -1 || $id == false)
    {
        die(':(');
    }

    $nome = ucwords(strtolower(htmlspecialchars($_POST['nome'])));
    $telefone = htmlspecialchars($_POST['telefone']);

    $sql = "UPDATE dados SET nome = '$nome', telefone = '$telefone' WHERE id = $id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    header('Location: ../public/index.php');

