<?php
    //sessão
    session_start();

    //conexão 
    require_once 'db-connect.php';

    //função para evitar ataque xss
    function clear($input)
    {
        global $connect;
        // sql
        $var = mysqli_escape_string($connect, $input);
        // xss  
        $var = htmlspecialchars($var);
        return $var;
    }

    if(isset($_POST['btn-register']))
    {
        $name = clear(ucwords(strtolower($_POST['name'])));   
        $surname = clear(ucwords(strtolower($_POST['surname'])));
        $email = clear(strtolower($_POST['email']));
        $age = clear($_POST['age']);

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