<?php

namespace core\controllers;

use core\classes\Functions;
use core\classes\Store;
use core\models\Products;
use core\models\Clients;
use core\models\Orders;

class Carrinho
{
    public function carrinho(): void
    {
        //verifica se existe um carrinho na sessão
        if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
            $data = [
                'cart' => null,
                'title' => 'Carrinho'
            ];
        } else {
            /*
            busca no banco de dados os dados dos produtos que existem no carrinho
            cria um ciclo que constroi a estrutura dos dados para o carrinho
            */
            $UUIDs = [];
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                array_push($UUIDs, $product_id);
            }
            $UUIDs = implode(',', $UUIDs);

            $products = new Products();
            $result = $products->get_product_by_uuid($UUIDs);

            //vídeo 33, 11:40 
            $data = [];
            foreach ($_SESSION['cart'] as $product_id => $quantity_tmp) {
                foreach ($result as $product) {
                    if ($product->ProductUUID == $product_id) {
                        //coloca o produto na coleção
                        array_push($data, [
                            'id' => $product->ProductUUID,
                            'image' => $product->Path,
                            'title' => $product->ProductName,
                            'quantity' => $quantity_tmp,
                            'price' => $product->Price * $quantity,
                        ]);

                        break;
                    }
                }
            }

            //calcular o total
            $total = 0;
            foreach ($data as $item) {
                $total += $item['price'];
            }

            array_push($data, $total);

            /*
            echo '<pre>';
            print_r($data);
            exit;
            */

            $data = [
                'title' => 'Carrinho',
                'cart' => $data
            ];
        }

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'carrinho',
            'layouts/footer'
        ],   $data);
    }

    public function add_to_cart()
    {
        //busca o  id do produto na querystring
        if (!isset($_GET['id'])) {
            echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '';
            exit;
        }

        //define o id do produto
        $product_id = $_GET['id'];

        $products = new Products();
        $result = $products->verify_stock($product_id);
        if (!$result) {
            echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : '';
            exit;
        }

        //adiciona a variavel de sessão no carrinho
        $cart = [];

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }

        //adiciona o produto ao carrinho
        if (!key_exists($product_id, $cart)) {
            //adciona o novo produto ao carrinho
            $cart[$product_id] = 1;
        } else {
            //se já existir o produto no carrinho, incrementa a quantidade
            $cart[$product_id]++;
        }

        //atualiza os dados do carrinho na sessão
        $_SESSION['cart'] = $cart;

        //resposta, devolve o numero de itens no carrinho
        $total_items = 0;
        foreach ($cart as $quantity) {
            $total_items += $quantity;
        }

        echo $total_items;
    }

    public function remove_product()
    {
        $product_id = $_GET['id'];
        $cart = $_SESSION['cart'];
        unset($cart[$product_id]);
        $_SESSION['cart'] = $cart;

        Functions::redirect('carrinho');
    }

    public function clear_cart(): void
    {
        unset($_SESSION['cart']);
        Functions::redirect('carrinho');
        exit;
    }

    public  function other_data()
    {
        //recebe os dados via ajax(axios)
        $post = json_decode(file_get_contents('php://input'), true);
        $_SESSION['other_data'] = [
            'email' => $post['email'],
            'phone' => $post['phone'],
            'address' => $post['address'],
            'city' => $post['city'],
        ];
    }

    public function checkout()
    {
        //verifica se o usuario esta logado
        if (!array_key_exists('client', $_SESSION)) {
            //coloca um referer temporario na sessão
            $_SESSION['referrer'] = true;

            Functions::redirect('login');
            exit;
        }

        Functions::redirect('summary');
    }

    public function summary()
    {
        //verifica se o usuario esta logado
        if (!isset($_SESSION['client'])) {
            Functions::redirect('loja');
            exit;
        }

        //verifica se pode avançar para a gravação do pedido no banco de dados
        if (empty($_SESSION['cart'])) {
            Functions::redirect('loja');
            exit;
        }

        //informações do carrinho
        $UUIDs = [];
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            array_push($UUIDs, $product_id);
        }
        $UUIDs = implode(',', $UUIDs);

        $products = new Products();
        $result = $products->get_product_by_uuid($UUIDs);

        //vídeo 33, 11:40 
        $data_tmp = [];
        foreach ($_SESSION['cart'] as $product_id => $quantity_tmp) {
            foreach ($result as $product) {
                if ($product->ProductUUID == $product_id) {
                    //coloca o produto na coleção
                    array_push($data_tmp, [
                        'id' => $product->ProductUUID,
                        'image' => $product->Path,
                        'title' => $product->ProductName,
                        'quantity' => $quantity_tmp,
                        'price' => $product->Price * $quantity,
                    ]);

                    break;
                }
            }
        }

        //calcular o total
        $total = 0;
        foreach ($data_tmp as $item) {
            $total += $item['price'];
        }

        array_push($data_tmp, $total);

        //coloca o preço total na sessão
        $_SESSION['total'] = $total;

        //preparar os dados para a view
        $data = [];
        $data['title'] = 'Resumo da Encomenda';
        $data['cart'] = $data_tmp;

        //gerar o codigo da encomenda
        if (!isset($_SESSION['codigo_encomenda'])) {
            $_SESSION['codigo_encomenda'] = Functions::codigo_encomenda();
        }

        //buscar informações do cliente
        $client_data = Clients::get_client_data($_SESSION['client']);
        $data['client'] = $client_data;

        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'encomenda_summary',
            'layouts/footer'
        ],   $data);
    }

    public function agradecimento()
    {
        //verifica se o usuario esta logado
        if (!isset($_SESSION['client'])) {
            Functions::redirect('loja');
            exit;
        }

        //verifica se pode avançar para a gravação do pedido no banco de dados
        if (empty($_SESSION['cart'])) {
            Functions::redirect('loja');
            exit;
        }

        //envia o email para cliente com os dados da encomenda e pagamento
        $data_encomenda = [];
        //busca os dados dos produtos do carrinho
        $UUIDs = [];
        foreach ($_SESSION['cart'] as $product_id => $quantity) {
            array_push($UUIDs, $product_id);
        }
        $UUIDs = implode(',', $UUIDs);

        $products = new Products();
        $produtos_da_encomenda = $products->get_product_by_uuid($UUIDs);

        //estrutura dos dados do carrinho
        $string_product = [];

        foreach ($produtos_da_encomenda as $result) {
            //2 x produto - R$ preço/unidade
            //quantidade
            $quantity = $_SESSION['cart'][$result->ProductUUID];
            //string do produto
            $string_product[] = "$quantity x $result->ProductName - R$ " . number_format($result->Price, 2, ',', '.') . ' /unidade';
        }

        //define a lista de produtos para enviar pelo email
        $data_encomenda['products_list'] = $string_product;
        //preço total da encomenda
        $data_encomenda['total'] = 'R$ ' . number_format($_SESSION['total'], 2, ',', '.');
        //dados do pagamento
        $data_encomenda['payment_data'] = [
            'numero_conta' => '152757',
            'codigo_encomenda' => $_SESSION['codigo_encomenda'],
            'tota_pagar' => 'R$ ' . number_format($_SESSION['total'], 2, ',', '.'),
        ];

        //envia o email para o cliente com os dados da encomenda
        Functions::send_email_encomenda($_SESSION['client_Email'], $data_encomenda);

        //----------------------------------------
        //salvar a encomenda no banco de dados
        $order_data = [];
        $order_data['ClientUUID'] = $_SESSION['client'];
        //endereço
        if (isset($_SESSION['other_data']['address']) && !empty($_SESSION['other_data']['address'])) {
            //considera o endereço alternativo do cliente
            $order_data['Address'] = $_SESSION['other_data']['address'];
            $order_data['City'] = $_SESSION['other_data']['city'];
            $order_data['Email'] = $_SESSION['other_data']['email'];
            $order_data['Telephone'] = $_SESSION['other_data']['phone'];
        } else {
            //considera o endereço do cliente cadastrado no banco de dados
            $client_data = Clients::get_client_data($_SESSION['client']);
            $order_data['Address'] = $client_data->Address;
            $order_data['City'] = $client_data->City;
            $order_data['Email'] = $client_data->Email;
            $order_data['Telephone'] = $client_data->Phone;
        }

        //codigo da encomenda
        $order_data['OrderCode'] = $_SESSION['codigo_encomenda'];
        //status da encomenda
        $order_data['Status'] = 'PENDENTE';
        $order_data['Message'] = '';

        //dados dos produtos da encomenda
        $products_data = [];
        foreach ($produtos_da_encomenda as $product) {
            $products_data[] = [
                'ProductName' => $product->ProductName,
                'PriceUnit' => $product->Price,
                'Quantity' => $_SESSION['cart'][$product->ProductUUID]
            ];
        }

        Orders::save_orders($order_data, $products_data);

        $codigo_encomenda = $_SESSION['codigo_encomenda'];
        $total = $_SESSION['total'];

        //limpar os dados da encomenda que estão no carrinho
        $keys = [
            'cart',
            'total',
            'codigo_encomenda',
            'other_data',
        ];

        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }

        $data = [
            'title' => 'Obrigado',
            'codigo_encomenda' => $codigo_encomenda,
            'total' => $total,
        ];

        //apresenta a pagina de agradecimento
        Store::Layout([
            'layouts/header',
            'layouts/navbar',
            'agradecimento',
            'layouts/footer'
        ],   $data);
    }
}
