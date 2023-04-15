<?php
define("AES_KEY", 'j|OE^EPg#?"ZQD2f"NQ7~JcW*<sA_)y>');
define("AES_IV", 'oMrRN_KO*ky>4-yt');

function aes_encrypt($value) :string
{
    return bin2hex(openssl_encrypt($value, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
}

function aes_decrypt($hash)
{
    if (strlen($hash) % 2 != 0) {
        return -1;
    }

    return openssl_decrypt(hex2bin($hash), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
}

function clear(string $value) :string
{
    $trim = trim($value);
    $result = htmlspecialchars($trim);
    return $result;
}
