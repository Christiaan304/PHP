<?php

namespace core\classes;

class Store
{
    public static function Layout(array $structures, array $data = null)
    {
        //verifica se $structure é um array
        if (!is_array($structures)) {
            throw new \Exception("O parâmetro deve ser um array");
        }

        //variáveis
        if (!empty($data) && is_array($data)) {
            extract($data);
        }

        //apresenta as views da aplicação
        foreach ($structures as $structure) {
            include_once("../core/views/$structure.php");
        }
    }

    public static function Layout_Admin(array $structures, array $data = null)
    {
        //verifica se $structure é um array
        if (!is_array($structures)) {
            throw new \Exception("O parâmetro deve ser um array");
        }

        //variáveis
        if (!empty($data) && is_array($data)) {
            extract($data);
        }

        //apresenta as views da aplicação
        foreach ($structures as $structure) {
            include_once("../../core/views/$structure.php");
        }
    }

    public static function LoggedClient(): bool
    {
        return isset($_SESSION['client']);
    }

    public static function LoggedAdmin(): bool
    {
        return isset($_SESSION['admin']);
    }
}
