<?php

//coleção das rotas
$routes = [
    'inicio' => 'main@index',
    'loja' => 'main@loja',

    'carrinho' => 'carrinho@carrinho',
    'add_to_cart' => 'carrinho@add_to_cart',
    'clear_cart' => 'carrinho@clear_cart',
    'remove_product' => 'carrinho@remove_product',
    'checkout' => 'carrinho@checkout',
    'summary' => 'carrinho@summary',
    'payment' => 'carrinho@payment',
    'other_data' => 'carrinho@other_data',
    'agradecimento' => 'carrinho@agradecimento',

    'cadastro' => 'main@cadastro',
    'cadastro_submit' => 'main@cadastro_submit',
    'email_confirmation' => 'main@email_confirmation',

    'login' => 'main@login',
    'login_submit' => 'main@login_submit',
    'logout' => 'main@logout',

    'profile' => 'profile@profile',
    'change_personal_data' => 'profile@change_personal_data',
    'change_personal_data_submit' => 'profile@change_personal_data_submit',
    'change_password' => 'profile@change_password',
    'change_password_submit' => 'profile@change_password_submit',
    'order_history' => 'profile@order_history',
    'order_details' => 'profile@order_details',

    'pdf' => 'main@pdf',
];

$action = 'inicio';

//verifica se existe a ação na query string
if (isset($_GET['a'])) {

    //verifica se a ação existe nas rotas
    if (!key_exists($_GET['a'], $routes)) {
        $action = 'inicio';
    } else {
        $action = $_GET['a'];
    }
}

//trata a definição da rota
$parts = explode('@', $routes[$action]);
$controller = 'core\\controllers\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctr = new $controller();
$ctr->$method();
