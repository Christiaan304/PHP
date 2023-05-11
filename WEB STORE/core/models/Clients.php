<?php

namespace core\models;

use core\classes\EasyPDO;
use core\classes\Functions;

class Clients
{
    public static function insert_user(): string
    {
        $db = new EasyPDO();

        $purl = Functions::purl_generator();
        $uuid = Functions::uuid_generator();

        $params = [
            ':user_name' => trim($_POST['inputUserName']),
            ':name' => mb_convert_case(trim($_POST['inputName']), MB_CASE_TITLE),
            ':email' => $_POST['inputEmail'],
            ':password' => password_hash($_POST['inputPassword'], PASSWORD_BCRYPT, ['cost' => 12]),
            ':address' => trim($_POST['inputAddress']),
            ':address_number' => trim($_POST['inputAddressNumber']),
            ':city' => trim($_POST['inputCity']),
            ':phone' => trim($_POST['inputPhone']),
        ];

        //insere os dados criptografados no banco de dados        
        //$db->insert(
        //    "INSERT INTO clients (UUID, UserName, Name, Email, Password, Address, AddressNumber, City, Phone, PURL) 
        //    VALUES ('$uuid',
        //            AES_ENCRYPT(:user_name, UNHEX(SHA2('" . KEY_AES . "', 512))),
        //            AES_ENCRYPT(:name, UNHEX(SHA2('" . KEY_AES . "', 512))),
        //            AES_ENCRYPT(:email, UNHEX(SHA2('" . KEY_AES . "', 512))),
        //            :password,
        //            AES_ENCRYPT(:address, UNHEX(SHA2('" . KEY_AES . "', 512))),
        //            :address_number, 
        //            :city, 
        //            AES_ENCRYPT(:phone, UNHEX(SHA2('" . KEY_AES . "', 512))),
        //            '$purl')",
        //   $params
        //);

        $db->insert(
            "INSERT INTO clients (UUID, UserName, Name, Email, Password, Address, AddressNumber, City, Phone, PURL) 
            VALUES ('$uuid', :user_name, :name, :email, :password, :address, :address_number, :city, :phone, '$purl')",
            $params
        );

        return $purl;
    }

    public static function get_client_data(string $uuid)
    {
        $params = [
            ':uuid' => $uuid
        ];

        $db = new EasyPDO();

        $result = $db->select("SELECT Name, Email, Address, AddressNumber, City, Phone
                                FROM clients WHERE UUID = :uuid", 
                                $params)[0];

        return $result;
    }

    public static function exist_email(string $email): bool
    {
        $db = new EasyPDO();

        $params_email = [
            ':email' => $email,
        ];

        //$result = $db->select(
        //    "SELECT 
        //    AES_DECRYPT(Email, UNHEX(SHA2('" . KEY_AES . "', 512)))
        //    FROM clients 
        //    WHERE AES_DECRYPT(Email, UNHEX(SHA2('" . KEY_AES . "', 512))) = :email",
        //    $params_email
        //);

        $result = $db->select(
            "SELECT Email FROM clients WHERE Email = :email",
            $params_email
        );

        //verifica se o email já existe
        return (count($result) !== 0) ? true : false;
    }

    public static function email_confirmation(string $purl): bool
    {
        $db = new EasyPDO();

        $params = [
            ':purl' => $purl
        ];

        $results = $db->select("SELECT ClientID, UUID FROM clients WHERE PURL = :purl", $params);

        //verifica se foi encontrado o cliente
        if (count($results) != 1) {
            return false;
        }

        //foi encontrado o cliente com o purl e uuid informado
        $clientID = $results[0]->ClientID;
        $uuid = $results[0]->UUID;

        $db = null;
        $db = new EasyPDO();

        //atualiza o status do cliente para ativo
        $params = [
            ':clientID' => $clientID,
            ':uuid' => $uuid
        ];

        $db->update("UPDATE clients
                     SET Active = 1, PURL = NULL
                     WHERE ClientID = :clientID AND UUID = :uuid", $params);

        return true;
    }

    public static function login_validation(string $email, string $password): bool|object
    {
        $db = new EasyPDO();

        $params = [
            ':email' => $email,
        ];

        $result = $db->select(
            "SELECT UUID, UserName, Email, Password 
             FROM clients
             WHERE Email = :email
             AND Active = 1
             AND DeletedAt IS NULL",
             $params
        );

        if (count($result) != 1) {
            //não foi encontrado o cliente com o email informado
            return  false;
        } else {
            if (!password_verify($password, $result[0]->Password)) {
                //existe o cliente mas a senha informada não confe
                return false;
            } else {
                return $result[0];
            }
        }
    }
}
