<?php
    // root password: !owaVn@KunE1jme].    
    $hostname = 'localhost';
    $dbname = 'contatos';
    $username = 'userContatos'; // criar um usuário específico para utilizar o banco de dados
    $password = 'Qo2aNebo6AD2RoDe2uJ2ci2i8u2a2a';

    try
    {
        $conn = new PDO("mysql:host=$hostname; dbname=$dbname; charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
    