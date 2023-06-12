<?php

namespace core\models;

use core\classes\EasyPDO;

class Orders
{
    public static function save_orders($order_data, $products_data): void
    {
        $db = new EasyPDO();
        //guarda os dados da encomenda
        $params = [
            ':ClientUUID' => $_SESSION['client'],
            ':OrderCode' => $order_data['OrderCode'],
            ':Status' => $order_data['Status'],
            ':Message' => $order_data['Message'],
            ':City' => $order_data['City'],
            ':Address' => $order_data['Address'],            
            ':Email' => $order_data['Email'],
            ':Telephone' => $order_data['Telephone'],            
        ];

        $db->insert("INSERT INTO orders VALUES (0, :ClientUUID, :OrderCode, :Status, :Message, :City, :Address, :Email, :Telephone, NOW(), NOW())", $params);

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

            $db->insert("INSERT INTO order_product VALUES (0,:OrderID, :ProductName, :PriceUnit, :Quantity, NOW())", $params);
        }
    }

    public static function get_orders(string $uuid): array
    {
        $params = [
            ':uuid' => $uuid
        ];

        $db = new EasyPDO();

        $result = $db->select(
            "SELECT OrderID, Status, OrderCode, CreatedAt 
                               FROM orders 
                               WHERE ClientUUID = :uuid 
                               ORDER BY CreatedAt DESC",
            $params
        );

        return $result;
    }

    public static function verify_order_client(int $order_id, string $client_uuid): bool
    {
        $params = [
            ':order_id' => $order_id,
            ':client_uuid' => $client_uuid
        ];

        $db = new EasyPDO();

        $result = $db->select(
            "SELECT OrderID FROM orders 
                               WHERE OrderID = :order_id AND ClientUUID = :client_uuid",
            $params
        );

        return (count($result) == 0) ? false : true;
    }

    public static function get_order_details(int $order_id, string $client_uuid): array
    {
        $params = [
            ':order_id' => $order_id,
            ':client_uuid' => $client_uuid
        ];

        $db = new EasyPDO();

        $order_data = $db->select("SELECT * FROM orders WHERE OrderID = :order_id AND ClientUUID = :client_uuid", $params)[0];

        $db  = null;
        $db = new EasyPDO();

        $params = [
            ':order_id' => $order_id
        ];

        $order_products = $db->select("SELECT * FROM order_product WHERE OrderID = :order_id", $params);

        //devolve ao controlador os dados da encomenda
        return [
            'order_data' => $order_data,
            'order_products' => $order_products
        ];
    }

    public static function check_payment_status(string $order_code): bool
    {
        $params = [
            ':order_code' => $order_code
        ];

        $db = new EasyPDO();

        $result = $db->select("SELECT * FROM orders WHERE OrderCode = :order_code AND Status = 'PENDENTE'", $params);

        if (count($result) == 0) {
            return false;
        }

        $db = null;
        $db = new EasyPDO();

        $db->update("UPDATE orders SET Status = 'EM PROCESSO' WHERE OrderCode = :order_code", $params);

        return true;
    }
}
