<?php

    use EasyPDO\EasyPDO;

    defined('CONTROLE') or die(':(');

    $route = null;

    if(!verifySession() && $_SERVER['REQUEST_METHOD'] != 'POST')
    {
        $route = 'login';
    }
    elseif(!verifySession() && $_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $route = 'loginSubmit';
    }
    else
    {
        $route = 'logado';
    }

    // APRESENTAR OS LAYOUTS
    switch ($route)
    {
        
        case 'login':              
            require_once '../views/login.php';              
        break;

        case 'loginSubmit':

            // TENTATIVA DE LOGIN
            $bd = new EasyPDO();
            $parameters = [
                ':user' => $_POST['user']
            ];
            $result = $bd->select("SELECT id, name, password FROM users WHERE name = :user", $parameters);
            
            if(count($result) == 0)
            {
                $error = 'Login inválido(1)';
                require_once '../views/login.php'; 
                return;
            }

            // print_r($result[0]);
            $user = $result[0];
            
            // VERIFICA A SENHA
            if(password_verify($_POST['password'], $user['password']))
            {
                // LOGIN COM  SUCESSO
                $_SESSION['user'] = $user['name'];
                header('Location: index.php');
                return;
            }
            else
            {
                $error = 'Login inválido(2)';
                require_once '../views/login.php';
                return;
            }

        break;     

        case 'logado':
            $bd = new EasyPDO();
            $users = $bd->select("
                SELECT
                name,
                AES_DECRYPT(fullName, UNHEX(SHA2('" .AES_KEY. "', 512))) fullName
                FROM users
            ");

            require_once '../views/seeUses.php';
        break;
    }