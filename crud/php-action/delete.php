<?php
    //sessão
    session_start();

    //conexão 
    require_once 'db-connect.php';

    if(isset($_POST['btn-delete']))
    {
        $id = mysqli_escape_string($connect, $_POST['id']);
        $sql = "DELETE FROM client WHERE id = '$id'";

        if(mysqli_query($connect, $sql))
        {
            $_SESSION['menssage'] = "Deletado com sucesso";
            header('Location: ../index.php');
        }
        else
        {
            $_SESSION['menssage'] = "Erro ao deletar";
            header('Location: ../index.php');
        }
    }
?>