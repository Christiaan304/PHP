<?php
    //sessão
    session_start();

    //conexão 
    require_once 'db-connection.php';

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
        $login = clear(ucwords(strtolower($_POST['login'])));
        $email = clear(strtolower($_POST['email']));
        $password = clear(sha1($_POST['password']));

        $sql = "INSERT INTO users (name, login, email, password) VALUES ('$name', '$login', '$email', '$password')";

        if(mysqli_query($connect, $sql))
        {
            $_SESSION['menssage'] = "Cadastrado com sucesso";
            header('Location: ../login.php');
        }
        else
        {
            $_SESSION['menssage'] = "Erro ao cadastrar";
            header('Location: ../login.php');
        }
    }
?>