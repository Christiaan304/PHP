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

    if(isset($_POST['btn-edit']))
    {
        $name = clear(ucwords(strtolower($_POST['name'])));   
        $surname = clear(ucwords(strtolower($_POST['surname'])));
        $email = clear(strtolower($_POST['email']));
        $age = clear($_POST['age']);
        $id = clear($_POST['id']);

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