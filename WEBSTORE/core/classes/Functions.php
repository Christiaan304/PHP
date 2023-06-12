<?php

namespace core\classes;

require_once 'PHPMailer.php';
require_once 'SMTP.php';
require_once 'POP3.php';
require_once 'Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Functions
{
    public static function email_sanitize(string $email)
    {
        $regex = '/^[a-z0-9\.\_]{4,}@[a-z\d]{4,}\.[\w\.]{3,}$/';
        $trim_email = trim($email);
        return preg_match($regex, $trim_email);
    }

    public static function validate_admin_user(string $inputAdmin)
    {
        $regex = '/^admin@[a-z0-9]{5,}\.com$/';
        $trim_input = trim($inputAdmin);
        return preg_match($regex, $trim_input);
    }

    public static function verify_purl(string $purl)
    {
        $regex = '/^[a-f0-9]{32}$/';
        return preg_match($regex, $purl);
    }

    public static function verify_phone(string $phone)
    {
        $regex = '/^\([\d]{2}\)\s[9]?[\d]{4}-[\d]{4}$/';
        return preg_match($regex, trim($phone));
    }

    public  static function purl_generator(): string
    {
        $response = file_get_contents('https://www.uuidtools.com/api/generate/v4/count/1');
        $uuid = json_decode($response);
        return str_replace('-', '', $uuid[0]);
    }

    public static function uuid_generator(): string
    {
        $response = file_get_contents('https://www.uuidtools.com/api/generate/timestamp-first/count/1');
        $uuid = json_decode($response);
        return str_replace('-', '', $uuid[0]);
    }

    public static function codigo_encomenda(): string
    {
        $response = file_get_contents('https://www.uuidtools.com/api/generate/v4/count/1');
        $uuid = json_decode($response);
        return "E" . substr(str_replace('-', '', $uuid[0]), -6) . time();
    }

    public static function send_email_verify(string $email, string $purl): bool
    {
        //link para validar o email
        $purl_link = BASE_URL . "?a=email_confirmation&purl=$purl";

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = MAIL_HOST;                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                  //SMTP username
            $mail->Password   = MAIL_PASSWORD;                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(MAIL_USERNAME, APP_NAME);
            $mail->addAddress($email);               //Name is optional
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient            

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Confirmação de email';
            $mail->Body    = "Clique no link para confirmar o seu cadastro: $purl_link";

            $mail->send();
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    public static function send_email_encomenda(string $email, array $data_encomenda): bool
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = MAIL_HOST;                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                  //SMTP username
            $mail->Password   = MAIL_PASSWORD;                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(MAIL_USERNAME, APP_NAME);
            $mail->addAddress($email);               //Name is optional
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient            

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Confirmação da encomenda - ' . $data_encomenda['payment_data']['codigo_encomenda'];

            //menssagem
            $html = '<p>Confirmação da encomenda</p>';
            $html .= '<p>Dados da encomenda</p>';

            //lista dos produtos
            $html .= '<ul>';
            foreach ($data_encomenda['products_list'] as $product) {
                $html .= "<li>$product</li>";
            }
            $html .= '</ul>';

            //total da encomenda
            $html .= '<p>Total: <strong>R$ ' . $data_encomenda['total'] . '</strong></p>';

            //dados do pagamento
            $html .= '<hr>';
            $html .= '<p>Dados do pagamento</p>';
            $html .= '<p>Número da conta: ' . $data_encomenda['payment_data']['numero_conta'] . '</p>';
            $html .= '<p>Código da encomenda: ' . $data_encomenda['payment_data']['codigo_encomenda'] . '</p>';
            $html .= '<p>Valor: R$ ' . $data_encomenda['total'] . '</p>';
            $html .= '<hr>';

            $mail->Body = $html;

            $mail->send();
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    public static function send_email_order_pdf(string $email, string $pdf_name)
    {
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = MAIL_HOST;                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                  //SMTP username
            $mail->Password   = MAIL_PASSWORD;                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom(MAIL_USERNAME, APP_NAME);
            $mail->addAddress($email);               //Name is optional

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - PDF com detalhes da encomenda';
            $mail->Body    = "Segue em anexo o pdf com os detalhes da sua encomenda.";
            $mail->addAttachment(TEMP_FOLDER_PATH . $pdf_name);

            $mail->send();
            return true;
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    public static function redirect(string $route, bool $admin = false)
    {
        //faz o redirecionamento para a página desejada
        (!$admin) ? header("Location: " . BASE_URL . "?a=$route") : header("Location: " . BASE_URL . "admin/?a=$route");
    }

    public static function show_data($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }

    public static function aes_encrypt(string $data)
    {
        return bin2hex(openssl_encrypt($data, 'aes-256-cbc', KEY, OPENSSL_RAW_DATA, IV));
    }

    public  static function aes_decrypt(string $data)
    {
        return openssl_decrypt(hex2bin($data), 'aes-256-cbc', KEY, OPENSSL_RAW_DATA, IV);
    }
}
