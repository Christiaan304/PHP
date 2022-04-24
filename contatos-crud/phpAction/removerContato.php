<?php  
    if(!isset($_GET['id']))
    {
        die(':(');
    }

    require_once 'connectionDB.php';
    require_once 'cypher.php';

    $id = $_GET['id'];
    $id = aes_decrypt($id);

    $sql = "DELETE FROM dados WHERE id = $id";
    $conn->exec($sql);
    header('Location: ../public/index.php');