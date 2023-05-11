<?php

namespace core\models;

use core\classes\EasyPDO;

class Orders
{
    public static function save_orders($order_data, $products_data)
    {
        $db = new EasyPDO();
        //guarda os dados da encomenda
        $params = [
            ':ClientUUID' => $_SESSION['client'],
            ':Address' => $order_data['Address'],
            ':City' => $order_data['City'],
            ':Email' => $order_data['Email'],
            ':Telephone' => $order_data['Telephone'],
            ':OrderCode' => $order_data['OrderCode'],
            ':Status' => $order_data['Status'],
            ':Message' => $order_data['Message'],
        ];


        $db->insert("INSERT INTO orders VALUES (0, :ClientUUID, :OrderCode, :Status, :Message, :City, :Address, :Email, :Telephone, NOW())", $params);

        $db = null;
        $db = new EasyPDO();

        //busca o id da encomenda
        $OrderID = $db->select("SELECT MAX(OrderID) AS OrderID FROM orders")[0]->OrderID;

        $db = null;
        $db = new EasyPDO();

        //guardar os dados dos produtos
        foreach ($products_data as $product) {
            $params = [
                ':OrderID' => $OrderID,
                ':ProductName' => $product['ProductName'],
                ':PriceUnit' => $product['PriceUnit'],
                ':Quantity' => $product['Quantity']
            ];

            $db = null;
            $db = new EasyPDO();

            $db->insert("INSERT INTO order_product VALUES (0, :OrderID, :ProductName, :PriceUnit, :Quantity, NOW())", $params);
        }
    }
}
