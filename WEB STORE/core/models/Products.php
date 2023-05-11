<?php

namespace core\models;

use core\classes\EasyPDO;

class Products
{
    public function products_list_visible(string $category): array
    {
        $db = new EasyPDO();

        //busca a lista de categorias
        $categories = $this->products_list_category();

        $sql = "SELECT ProductUUID, Category, ProductName, Description, Price, Path, Quantity, Visible
                FROM products WHERE Visible = 1";

        if (in_array($category, $categories)) {
            $sql .= " AND Category = '$category'";
        }

        $prodcts = $db->select($sql);
        return $prodcts;
    }

    public function products_list_category(): array
    {
        //devolve a lista de categorias existentes no banco de dados
        $db = new EasyPDO();

        $results = $db->select("SELECT DISTINCT Category FROM products ORDER BY Category");
        $category = [];

        foreach ($results as $result) {
            array_push($category, $result->Category);
        }

        return $category;
    }

    public function verify_stock($uuid): bool
    {
        $db = new EasyPDO();

        $params = [
            ':uuid' => $uuid
        ];

        $result = $db->select(
            "SELECT Quantity 
                                FROM products 
                                WHERE ProductUUID = :uuid AND Visible = 1 AND Quantity > 0",
            $params
        );

        return count($result) != 0 ? true : false;
    }

    public function get_product_by_uuid($UUIDs): array
    {
        $db = new EasyPDO();

        /*
        A sua consulta SQL está quase correta, mas há um problema na maneira como a variável $ids é usada na consulta. Quando você passa uma string separada por vírgulas como parâmetro para a cláusula IN(), 
        o SQL trata essa string como um único valor. Por isso, a consulta só retornará resultados para o primeiro ID na lista.
        Para corrigir isso, você precisa dividir a string em uma lista de IDs e, em seguida, usar a cláusula IN() com essa lista. Você pode fazer isso usando a função explode() do PHP.
        */

        // divide a string em uma lista de UUIDs
        $UUID_list = explode(",", $UUIDs);

        $result = $db->select("SELECT ProductUUID, Category, ProductName, Price, Path, Quantity, Visible
                                FROM products WHERE ProductUUID 
                                IN ('" . implode("','", $UUID_list) . "')");

        /*
        a função implode() é usada para juntar a lista de IDs de volta em uma string separada por vírgulas, mas agora cada ID está entre aspas simples. 
        Isso garante que o SQL trate cada ID como um valor separado na cláusula IN().
        */

        return  $result;
    }
}
