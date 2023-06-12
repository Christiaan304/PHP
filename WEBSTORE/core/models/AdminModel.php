<?php

namespace core\models;

use core\classes\EasyPDO;
use core\classes\Functions;

class AdminModel
{
    public static function login_validation(string $admin, string $password)
    {
        $db = new EasyPDO();

        $params = [
            'admin' => $admin,
        ];

        $result = $db->select("SELECT AdminID, AdminUser, AdminPassword FROM admins WHERE AdminUser = :admin", $params);

        if (count($result) != 1) {
            //não foi encontrado o admin com o nome informado
            return  false;
        } else {
            if (!password_verify($password, $result[0]->AdminPassword)) {
                //existe o admin mas a senha informada não confe
                return false;
            } else {
                return $result[0];
            }
        }
    }

    public static function get_client_list()
    {
        $db = new EasyPDO();

        return $db->select("SELECT clients.UUID, clients.Name, clients.Email, clients.Phone, clients.Active, clients.DeletedAt, 
                            COUNT(orders.OrderID) AS Total_Orders
                            FROM clients 
                            LEFT JOIN orders 
                            ON clients.UUID = orders.ClientUUID
                            GROUP BY clients.UUID");
    }

    public static function get_client_details(string $uuid)
    {
        $params = [
            ':uuid' => $uuid
        ];

        $db = new EasyPDO();

        $result = $db->select("SELECT * FROM clients WHERE UUID = :uuid", $params)[0];

        return $result;
    }

    public  static function get_client_order_history(string $uuid)
    {
        $params = [
            ':uuid' => $uuid
        ];

        $db = new EasyPDO();

        return $db->select("SELECT * FROM orders WHERE ClientUUID = :uuid", $params);
    }

    public static function total_orders_client(string $uuid)
    {
        $params = [
            ':uuid' => $uuid
        ];

        $db = new EasyPDO();

        return $db->select("SELECT COUNT(*) AS Total FROM orders WHERE ClientUUID = :uuid", $params)[0]->Total;
    }

    public static function get_orders_list($filter, $client_id)
    {
        $db = new EasyPDO();

        $sql = "SELECT orders.*, clients.Name FROM orders LEFT JOIN clients ON clients.UUID = orders.ClientUUID WHERE 1";

        if ($filter != '') {
            $sql .= " AND orders.Status = '$filter'";
        }
        if ($client_id != null) {
            $sql .= " AND orders.ClientUUID = '$client_id'";
        }

        $sql .= " ORDER BY orders.CreatedAt DESC";

        return $db->select($sql);
    }

    public static function get_order_details($id)
    {
        $params = [
            ':id' => $id
        ];

        //dados da encomenda
        $db = new EasyPDO();
        $order_data = $db->select(
            "SELECT clients.Name, clients.AddressNumber, orders.* 
                                   FROM clients, orders
                                   WHERE orders.OrderID = :id 
                                   AND clients.UUID = orders.ClientUUID",
            $params
        );

        //dados dos produtos
        $db = null;
        $db = new EasyPDO();
        $order_product = $db->select("SELECT * FROM order_product WHERE OrderID = :id", $params);

        return [
            'order' => $order_data[0],
            'products' => $order_product
        ];
    }

    public static function total_orders_pending()
    {
        $db = new EasyPDO();

        $result = $db->select("SELECT COUNT(Status) AS Total FROM orders WHERE Status = 'PENDENTE'");

        return $result[0]->Total;
    }

    public static function total_orders_processing()
    {
        $db = new EasyPDO();

        $result = $db->select("SELECT COUNT(Status) AS Total FROM orders WHERE Status = 'EM PROCESSO'");

        return $result[0]->Total;
    }

    public static function alter_order_status($order_id, $order_status)
    {
        $params = [
            ':id' => $order_id,
            ':status' => $order_status
        ];

        $db = new EasyPDO();

        $db->update("UPDATE orders SET Status = :status WHERE OrderID = :id", $params);
    }
}
