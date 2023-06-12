<?php

namespace core\controllers;

use core\classes\Functions;
use core\classes\PDF;
use core\classes\Store;
use core\models\Clients;
use core\models\Products;

class Main
{
    public function index(): void
    {
        $data = [
            'title' => 'Página Inicial',
            'name' => APP_NAME,
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'inicio',
            'layouts/footer'
        ],  $data);
    }

    public function loja(): void
    {
        $products = new Products();

        //analiza a categoria para mostrar os produtos
        $c = 'todos';
        if (isset($_GET['c'])) {
            $c = $_GET['c'];
        }

        $data = [
            'title' => 'Loja',
            'name' => APP_NAME,
            'products' => $products->products_list_visible($c),
            'categories' => $products->products_list_category(),
        ];

        //echo '<pre>';
        //echo print_r($products->products_list_visible($c));
        //exit;

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'loja',
            'layouts/footer'
        ],   $data);
    }

    public  function cadastro(): void
    {
        //verifica se já existe um usuário logado
        if (Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        $data = [
            'title' => 'Cadastro',
            'name' => APP_NAME,
        ];

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'cadastro',
            'layouts/footer'
        ],    $data);
    }

    public  function login(): void
    {
        //verifica se já existe um usuário logado
        if (Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        $data = [
            'title' => 'Login',
            'name' => APP_NAME,
        ];

        Store::Layout([
            'layouts/header',
            'login',
            'layouts/footer'
        ],    $data);
    }

    public  function login_submit(): void
    {
        //verifica se já existe um usuário logado
        if (Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        //verifica se houve um submit de um formulário
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Functions::redirect('index');
            exit;
        }

        //validação dos inputs
        if (empty($_POST['inputEmail']) || empty($_POST['inputPassword']) || !Functions::email_sanitize($_POST['inputEmail'])) {
            $_SESSION['error'] = 'Login inválido 1';
            Functions::redirect('login');
            exit;
        }

        //verifica se o login é válido
        $result = Clients::login_validation($_POST['inputEmail'], $_POST['inputPassword']);

        if (is_bool($result)) {
            //login inválido
            $_SESSION['error'] = 'Login inválido 2';
            Functions::redirect('login');
            exit;
        } else {
            //login válido, coloca os dados na sessão
            $_SESSION['client'] = $result->UUID;
            $_SESSION['client_UserName'] = $result->UserName;
            $_SESSION['client_Email'] = $result->Email;

            if (array_key_exists('referrer', $_SESSION)) {
                unset($_SESSION['referrer']);
                Functions::redirect('summary');
                exit;
            }

            Functions::redirect('loja');
            exit;
        }
    }

    public function logout(): void
    {
        if (!Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        session_unset();
        session_destroy();
        Functions::redirect('index');
        exit;
    }

    public function cadastro_submit(): void
    {
        //verifica se já existe um usuário logado
        if (Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        //verifica se houve um submit de um formulário
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            Functions::redirect('index');
            exit;
        }

        //verificação dos inputs

        //validação numero do  telefone
        if (!Functions::verify_phone($_POST['inputPhone'])) {
            $_SESSION['error'] = 'Número de telefone inválido';
            Functions::redirect('cadastro');
            exit;
        }

        //verifica se as senhas são iguais
        if ($_POST['inputPassword'] !== $_POST['inputPasswordConfirm']) {
            $_SESSION['error'] = 'As senhas não são iguais';
            Functions::redirect('cadastro');
            exit;
        }

        //validação do email
        if (!Functions::email_sanitize($_POST['inputEmail'])) {
            $_SESSION['error'] = 'Email inválido';
            Functions::redirect('cadastro');
            exit;
        }

        //verifica se existe um usuário com o mesmo email
        if (Clients::exist_email($_POST['inputEmail'])) {
            $_SESSION['error'] = 'Email já cadastrado';
            Functions::redirect('cadastro');
            exit;
        }

        //insere os dados no banco de dados e devolve o purl
        $purl = Clients::insert_user();

        $result = Functions::send_email_verify($_POST['inputEmail'], $purl);

        if ($result) {
            $data = [
                'title' => 'Enviado',
            ];

            //apresenta o layout de cadastro com sucesso
            Store::Layout([
                'layouts/header',
                'cadastro_success',
            ],  $data);

            exit;
        } else {
            $_SESSION['error'] = 'Erro ao enviar email de verificação, verifique se o email está correto';
            Functions::redirect('cadastro');
            exit;
        }
    }

    public function email_confirmation()
    {
        //verifica se já existe um usuário logado
        if (Store::LoggedClient()) {
            Functions::redirect('index');
            exit;
        }

        //verifica se o purl existe na query string e se é válido
        if (!isset($_GET['purl']) || !Functions::verify_purl($_GET['purl'])) {
            Functions::redirect('index');
            exit;
        }

        if (Clients::email_confirmation($_GET['purl'])) {
            $_SESSION['success'] = 'Email confirmado';
            Functions::redirect('login');
            exit;
        } else {
            Functions::redirect('index');
            exit;
        }
    }

    public function pdf()
    {
        $pdf = new PDF();
        $pdf->set_template(getcwd() . '\\assets\\pdf_templates\\template.pdf');

        $pdf->position_and_size(24,144,600,18);
        $pdf->text_align('center');
        $pdf->font_family('Courier New');
        $pdf->font_size('small');
        $pdf->write_text('lorem ipsum dolor sit amet, consectetur adipiscing elit');

        $pdf->font_weight('bold');
        $pdf->position_and_size(24,170,600,18);
        $pdf->write_text('ego non dico cvm cacatoribvs');
        $pdf->output_pdf();
    }
}