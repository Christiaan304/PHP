<?php  
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        die(':(');
    }

    require_once '../phpAction/connectionDB.php';

    $sql = "INSERT INTO dados (nome, telefone) VALUES(:nome, :telefone)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);

    
    $nome = ucwords(strtolower(htmlspecialchars($_POST['nome'])));  
    $telefone = htmlspecialchars($_POST['telefone']);
    $stmt->execute();

    header('Location: ../public/index.php');