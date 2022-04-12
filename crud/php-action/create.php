<?php
    //sessão
    session_start();

    //conexão 
    require_once 'db-connect.php';

    if(isset($_POST['btn-register']))
    {
        $name = mysqli_escape_string($connect, ucwords(strtolower($_POST['name'])));   
        $surname = mysqli_escape_string($connect, ucwords(strtolower($_POST['surname'])));
        $email = mysqli_escape_string($connect, strtolower($_POST['email']));
        $age = mysqli_escape_string($connect, $_POST['age']);

        $sql = "INSERT INTO client (name, surname, email, age) VALUES ('$name', '$surname', '$email', '$age')";

        if(mysqli_query($connect, $sql))
        {
            $_SESSION['menssage'] = "Cadastrado com sucesso";
            header('Location: ../index.php');
        }
        else
        {
            $_SESSION['menssage'] = "Erro ao cadastrar";
            header('Location: ../index.php');
        }
    }
?>