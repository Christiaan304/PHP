<?php

//coleção das rotas
$routes = [
    'index' => 'admin@index',
    'admin_login' => 'admin@admin_login',
    'login_submit_admin' => 'admin@login_submit_admin',
    'admin_logout' => 'admin@admin_logout',

    'client_list' => 'admin@client_list',
    'client_details' => 'admin@client_details',
    'order_list' => 'admin@order_list',
    'client_order_history' => 'admin@client_order_history',
    'order_details' => 'admin@order_details',
    'alter_order_status' => 'admin@alter_order_status',
    'pdf_order' => 'admin@pdf_order',
    'send_pdf' => 'admin@send_pdf',
];

$action = 'index';

//verifica se existe a ação na query string
if (isset($_GET['a'])) {

    //verifica se a ação existe nas rotas
    if (!key_exists($_GET['a'], $routes)) {
        $action = 'index';
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
