<?php

namespace core\controllers;

use core\models\Orders;

class Gateway
{
    public static function pay()
    {
        //verifica se o codigo da encomenda veio indicado
        (!isset($_GET['order_code'])) ? header('Location: loja') : $order_code = $_GET['order_code'];

        //verifica se existe um codigo de pagamento ativo (PENDENTE)
        $result = Orders::check_payment_status($order_code);
    }
}
