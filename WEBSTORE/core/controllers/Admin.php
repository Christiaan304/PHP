<?php

namespace core\controllers;

use core\classes\Functions;
use core\classes\Store;
use core\classes\PDF;
use core\models\AdminModel;

class Admin
{
    public function index()
    {
        //verifica se existe um admin logado
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se há encomendas pendentes
        $get_orders_pending = AdminModel::total_orders_pending();
        //verifica se há encomendas em processamento
        $get_orders_processing = AdminModel::total_orders_processing();

        $data = [
            'title' => 'Admin',
            'get_orders_pending' => $get_orders_pending,
            'get_orders_processing' => $get_orders_processing,
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/layouts/navbar',
            'admin/home',
            'admin/layouts/footer'
        ],   $data);
    }

    public function admin_login()
    {
        if (Store::LoggedAdmin()) {
            Functions::redirect('index', true);
            exit;
        }

        $data = [
            'title' => 'Admin Login',
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/login_admin',
            'admin/layouts/footer'
        ],   $data);
    }

    public  function login_submit_admin(): void
    {
        //verifica se já existe um usuário logado
        if (Store::LoggedAdmin()) {
            Functions::redirect('index', true);
            exit;
        }

        //verifica se houve um no formulário do admin
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Functions::redirect('admin_login', true);
            exit;
        }

        //validação dos inputs
        if (empty($_POST['inputAdmin']) || empty($_POST['inputPasswordAdmin']) || !Functions::validate_admin_user($_POST['inputAdmin'])) {
            $_SESSION['error'] = 'Login inválido';
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se o login é válido
        $result = AdminModel::login_validation($_POST['inputAdmin'], $_POST['inputPasswordAdmin']);

        if (is_bool($result)) {
            //login inválido
            $_SESSION['error'] = 'Login inválido';
            Functions::redirect('admin_login', true);
            exit;
        } else {
            //login válido, coloca o dado na sessão
            $_SESSION['admin'] = $result->AdminUser;
            $_SESSION['admin_id'] = $result->AdminId;
            Functions::redirect('index', true);
            exit;
        }
    }

    public function admin_logout(): void
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('index');
            exit;
        }

        session_unset();
        session_destroy();
        Functions::redirect('index');
        exit;
    }

    public function client_list()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        $data = [
            'title' => 'Lista de clientes',
            'client_list' => AdminModel::get_client_list(),
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/layouts/navbar',
            'admin/client_list',
            'admin/layouts/footer'
        ],   $data);
    }

    public  function client_details()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        if (!isset($_GET['id'])) {
            Functions::redirect('home', true);
            exit;
        }

        $client_id = Functions::aes_decrypt($_GET['id']);

        //verifica se o id é válido
        if (empty($client_id)) {
            Functions::redirect('home', true);
            exit;
        }

        $data = [
            'title' => 'Detalhes do cliente',
            'client_details' => AdminModel::get_client_details($client_id),
            'total_orders' => AdminModel::total_orders_client($client_id)
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/layouts/navbar',
            'admin/client_details',
            'admin/layouts/footer'
        ],   $data);
    }

    public function client_order_history()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se existe o id na query string
        if (!isset($_GET['id'])) {
            Functions::redirect('home', true);
            exit();
        }

        $client_id = Functions::aes_decrypt($_GET['id']);
        $client_order_history = AdminModel::get_client_order_history($client_id);

        //verifica se o id é válido
        if (empty($client_id)) {
            Functions::redirect('home', true);
            exit;
        }

        $data = [
            'title' => 'Detalhes da encomenda',
            'client_order_history' => $client_order_history,
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/layouts/navbar',
            'admin/client_order_history',
            'admin/layouts/footer'
        ],   $data);
    }

    public function order_list()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se existe um filtro na query string
        $filter_status = [
            'pending' => 'PENDENTE',
            'processing' => 'EM PROCESSO',
            'canceled' => 'CANCELADO',
            'sent' => 'ENVIADO',
            'completed' => 'CONCLUIDO'
        ];

        $filter = '';
        if (isset($_GET['status'])) {
            if (array_key_exists($_GET['status'], $filter_status)) {
                $filter = $filter_status[$_GET['status']];
            }
        }

        //busca o id do cliente na query string
        $client_id = null;
        if (isset($_GET['id'])) {
            $client_id = Functions::aes_decrypt($_GET['id']);
            if (empty($client_id)) {
                Functions::redirect('home', true);
                exit;
            }
        }

        //carrega a lista de encomendas
        $order_list = AdminModel::get_orders_list($filter, $client_id);

        //Functions::show_data($order_list);

        $data = [
            'title' => 'Order list',
            'order_list' => $order_list,
            'filter' => $filter
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/layouts/navbar',
            'admin/order_list',
            'admin/layouts/footer'
        ],   $data);
    }

    public function order_details()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se existe o id da encomenda na query string
        if (!isset($_GET['order_id'])) {
            Functions::redirect('home', true);
            exit();
        }

        $order_id = Functions::aes_decrypt($_GET['order_id']);

        if (empty($order_id)) {
            Functions::redirect('home', true);
            exit;
        }

        $order_details = AdminModel::get_order_details($order_id)['order'];
        $order_products = AdminModel::get_order_details($order_id)['products'];

        $data = [
            'title' => 'Detalhes da encomenda',
            'order_details' => $order_details,
            'order_products' => $order_products,
        ];

        Store::Layout_Admin([
            'admin/layouts/header',
            'admin/layouts/navbar',
            'admin/order_details',
            'admin/layouts/footer'
        ],   $data);
    }

    public function alter_order_status()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se existe o id da encomenda na query string
        if (!isset($_GET['order_id'])) {
            Functions::redirect('home', true);
            exit();
        }

        $order_id = Functions::aes_decrypt($_GET['order_id']);

        if (empty($order_id)) {
            Functions::redirect('home', true);
            exit;
        }

        //verifica se existe o status na query string e se é válido
        if (!isset($_GET['order_status']) || !in_array($_GET['order_status'], STATUS, true)) {
            Functions::redirect('home', true);
            exit();
        }

        $order_status = $_GET['order_status'];

        //atualizar o status da encomenda no banco de dados
        AdminModel::alter_order_status($order_id, $order_status);

        //executar operações baseadas no novo status da encomenda
        switch ($order_status) {
            case 'PENDENTE':

                break;

            case 'EM PROCESSO':

                break;

            case 'CANCELADA':

                break;

            case 'CONCLUÍDA':

                break;

            case 'ENVIADA':

                break;
        }

        Functions::redirect('order_details&order_id=' . $_GET['order_id'], true);
    }

    public function pdf_order()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se existe o id da encomenda na query string
        if (!isset($_GET['order_id'])) {
            Functions::redirect('home', true);
            exit();
        }

        $order_id = Functions::aes_decrypt($_GET['order_id']);

        if (empty($order_id)) {
            Functions::redirect('home', true);
            exit;
        }

        //buscar todos os dados da encomenda
        $order_details = AdminModel::get_order_details($order_id);

        //Functions::show_data($order_details);

        //cria o PDF com os detalhes da encomenda
        $pdf = new PDF();
        $pdf->set_template(getcwd() . '\\assets\\pdf_templates\\template.pdf');
        $pdf->font_weight('Bold');

        //order date
        $pdf->position_and_size(226, 202, 160, 20);
        $pdf->write_text(date('d/m/Y H:i', strtotime($order_details['order']->CreatedAt)));

        //order code
        $pdf->position_and_size(546, 202, 160, 20);
        $pdf->write_text($order_details['order']->OrderCode);

        //client details
        $pdf->font_weight('Courier New');

        $pdf->position_and_size(66, 260, 660, 20);
        $pdf->write_text("Nome: {$order_details['order']->Name}");

        $pdf->position_and_size(66, 281, 660, 20);
        $pdf->write_text("Endereço: {$order_details['order']->Address}, {$order_details['order']->AddressNumber} - {$order_details['order']->City}, RJ");

        $pdf->position_and_size(66, 302, 360, 20);
        $pdf->write_text("Email: {$order_details['order']->Email}");

        $pdf->position_and_size(460, 302, 160, 20);
        $pdf->write_text("Tel.: {$order_details['order']->Telephone}");

        //order list
        $y = 380;
        $total = 0;
        foreach ($order_details['products'] as $product) {
            $pdf->position_and_size(60, $y, 500, 18);
            $pdf->font_size(16);
            $price = number_format($product->Quantity * $product->PriceUnit, 2, ',', '.');
            $total += $product->Quantity * $product->PriceUnit;
            $pdf->write_text("{$product->Quantity} x {$product->ProductName} = R$ " . str_pad($price, 12, '.', STR_PAD_LEFT));
            $y += 20;
        }

        $pdf->position_and_size(58, 850, 676, 29);
        $pdf->font_weight('Bold');
        $pdf->foreground_color('white');
        $pdf->font_size(23);
        $pdf->write_text("Total: R$ {$total}");

        $pdf->output_pdf();
    }

    public function send_pdf()
    {
        if (!Store::LoggedAdmin()) {
            Functions::redirect('admin_login', true);
            exit;
        }

        //verifica se existe o id da encomenda na query string
        if (!isset($_GET['order_id'])) {
            Functions::redirect('home', true);
            exit();
        }

        $order_id = Functions::aes_decrypt($_GET['order_id']);

        if (empty($order_id)) {
            Functions::redirect('home', true);
            exit;
        }

        //buscar todos os dados da encomenda
        $order_details = AdminModel::get_order_details($order_id);

        //Functions::show_data($order_details);

        //cria o PDF com os detalhes da encomenda
        $pdf = new PDF();
        $pdf->set_template(getcwd() . '\\assets\\pdf_templates\\template.pdf');
        $pdf->font_weight('Bold');

        //order date
        $pdf->position_and_size(226, 202, 160, 20);
        $pdf->write_text(date('d/m/Y H:i', strtotime($order_details['order']->CreatedAt)));

        //order code
        $pdf->position_and_size(546, 202, 160, 20);
        $pdf->write_text($order_details['order']->OrderCode);

        //client details
        $pdf->font_weight('Courier New');

        $pdf->position_and_size(66, 260, 660, 20);
        $pdf->write_text("Nome: {$order_details['order']->Name}");

        $pdf->position_and_size(66, 281, 660, 20);
        $pdf->write_text("Endereço: {$order_details['order']->Address}, {$order_details['order']->AddressNumber} - {$order_details['order']->City}, RJ");

        $pdf->position_and_size(66, 302, 360, 20);
        $pdf->write_text("Email: {$order_details['order']->Email}");

        $pdf->position_and_size(460, 302, 160, 20);
        $pdf->write_text("Tel.: {$order_details['order']->Telephone}");

        //order list
        $y = 380;
        $total = 0;
        foreach ($order_details['products'] as $product) {
            $pdf->position_and_size(60, $y, 500, 18);
            $pdf->font_size(16);
            $price = number_format($product->Quantity * $product->PriceUnit, 2, ',', '.');
            $total += $product->Quantity * $product->PriceUnit;
            $pdf->write_text("{$product->Quantity} x {$product->ProductName} = R$ " . str_pad($price, 12, '.', STR_PAD_LEFT));
            $y += 20;
        }

        $pdf->position_and_size(58, 850, 676, 29);
        $pdf->font_weight('Bold');
        $pdf->foreground_color('white');
        $pdf->font_size(23);
        $pdf->write_text("Total: R$ {$total}");

        //permissões do pdf
        $pdf->set_pdf_permissions();

        //criar o pdf na pasta temporária
        $pdf_name = $order_details['order']->OrderCode . '_' . date('YmdHis') . '.pdf';
        $pdf->save_pdf($pdf_name);

        //envia o email com o pdf em anexo
        Functions::send_email_order_pdf($order_details['order']->Email, $pdf_name);

        unlink(TEMP_FOLDER_PATH . $pdf_name);

        Functions::redirect('index', true);
    }
}
