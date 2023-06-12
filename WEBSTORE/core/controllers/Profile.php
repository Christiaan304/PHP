<?php

namespace core\controllers;

use core\classes\Functions;
use core\classes\Store;
use core\models\Clients;
use core\models\Orders;

class Profile
{
    public function profile(): void
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        $client_profile = Clients::get_client_data($_SESSION['client']);

        $client_profile_data = [
            'Nome' => $client_profile->Name,
            'Email' => $client_profile->Email,
            'Endereço' => $client_profile->Address,
            'Numero' => $client_profile->AddressNumber,
            'Cidade' => $client_profile->City,
            'Telefone' => $client_profile->Phone,
        ];

        $data = [
            'title' => 'Perfil',
            'client_profile' => $client_profile_data,
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'profile_links',
            'profile',
            'layouts/footer'
        ],   $data);
    }

    public function change_personal_data(): void
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        $data = [
            'title' => 'Alterar dados pessoais',
            'personal_data' => Clients::get_client_data($_SESSION['client'])
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'profile_links',
            'change_personal_data',
            'layouts/footer'
        ],   $data);
    }

    public function change_personal_data_submit(): void
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        //verifica se houve um post
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Functions::redirect('index');
            exit;
        }

        //validar dados
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $address_number = trim($_POST['address_number']);
        $city = trim($_POST['city']);
        $phone = trim($_POST['phone']);

        if (in_array('', [$name, $email, $address, $address_number, $city])) {
            $_SESSION['error'] = 'Preencha todos os campos!';
            $this->change_personal_data();
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'E-mail inválido!';
            $this->change_personal_data();
            exit;
        }

        //verifica se já existe um usuário com esse email
        if (Clients::exist_email_other_account($_SESSION['client'], $email)) {
            $_SESSION['error'] = 'E-mail já cadastrado';
            $this->change_personal_data();
            exit;
        }

        //atualizar os dados do cliente no banco de dados
        Clients::update_client_data($_SESSION['client'], $name, $email, $address, $address_number, $city, $phone);

        //atualiza os dados da sessão
        $_SESSION['client_Email'] = $email;

        Functions::redirect('profile');
    }

    public function change_password(): void
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        $data = [
            'title' => 'Alterar senha',
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'profile_links',
            'change_password',
            'layouts/footer'
        ],   $data);
    }

    public function change_password_submit(): void
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        //verifica se houve um post
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Functions::redirect('index');
            exit;
        }

        //validar dados
        $password = $_POST['password'];
        $new_password = $_POST['new_password'];
        $new_password_confirm = $_POST['new_password_confirm'];

        if (in_array('', [$password, $new_password, $new_password_confirm])) {
            $_SESSION['error'] = 'Preencha todos os campos!';
            $this->change_password();
            exit;
        }

        //verifica se a senha atual está correta
        if (!Clients::verify_password($_SESSION['client'], $password)) {
            $_SESSION['error'] = 'Senha atual incorreta';
            $this->change_password();
            exit;
        }

        //verifica se a nova senha é igual a confirmação
        if ($new_password !== $new_password_confirm) {
            $_SESSION['error'] = 'As senhas não coincidem!';
            $this->change_password();
            exit;
        }

        //atualiza a senha do cliente no banco de dados
        Clients::update_password($_SESSION['client'], $new_password);
        $_SESSION['success'] = 'Senha alterada com sucesso!';

        Functions::redirect('profile');
    }

    public function order_history(): void
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        $data = [
            'title' => 'Histórico de encomendas',
            'order_history' => Orders::get_orders($_SESSION['client']),
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'profile_links',
            'order_history',
            'layouts/footer'
        ],   $data);
    }

    public function order_details()
    {
        //verifica se existe um usuário logado
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        //verifica se veio pelo get o id da encomenda, se o comprimento do id é igual a 32
        if (!isset($_GET['order_id']) || strlen($_GET['order_id']) !== 32) {
            Functions::redirect('index');
            exit;
        }

        $order_id = Functions::aes_decrypt($_GET['order_id']);
        if (!$order_id) {
            Functions::redirect('index');
            exit;
        }

        //verifica se a encomenda pertence ao cliente
        if (!Orders::verify_order_client($order_id, $_SESSION['client'])) {
            Functions::redirect('index');
            exit;
        }

        //busca os dados da encomenda e a lista dos produtos da encomenda
        $order_details = Orders::get_order_details($order_id, $_SESSION['client']);

        //calcular o valor total da encomenda
        $total = 0;
        foreach ($order_details['order_products'] as $product) {
            $total += ($product->PriceUnit * $product->Quantity);
        }

        $data = [
            'title' => 'Detalhes da encomenda',
            'order_data' => $order_details['order_data'],
            'order_products' => $order_details['order_products'],
            'total' => number_format($total, 2, ',', '.')
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'profile_links',
            'order_details',
            'layouts/footer'
        ],   $data);
    }
}
