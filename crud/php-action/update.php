<?php
    //sessão
    session_start();

    //conexão 
    require_once 'db-connect.php';

    if(isset($_POST['btn-edit']))
    {
        $name = mysqli_escape_string($connect, ucwords(strtolower($_POST['name'])));   
        $surname = mysqli_escape_string($connect, ucwords(strtolower($_POST['surname'])));
        $email = mysqli_escape_string($connect, strtolower($_POST['email']));
        $age = mysqli_escape_string($connect, $_POST['age']);
        $id = mysqli_escape_string($connect, $_POST['id']);

        $sql = "UPDATE client SET name = '$name', surname = '$surname', email = '$email', age = '$age' WHERE id = '$id'";

        if(mysqli_query($connect, $sql))
        {
            $_SESSION['menssage'] = "Atualizado com sucesso";
            header('Location: ../index.php');
        }
        else
        {
            $_SESSION['menssage'] = "Erro ao atualizar";
            header('Location: ../index.php');
        }
    }
?>