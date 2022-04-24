<?php
    // video: https://www.youtube.com/watch?v=fAJJxIDZTto&list=PLXik_5Br-zO9Z8l3CE8zaIBkVWjHOboeL&index=114

    define('AES_KEY', 's;}$Zgx?/eIPL6$:w.;Q@=MvqnM{H@6g');
    define('AES_IV', 'Ic4@:+uet6Y>}vGr');

    function aes_encrypt($value)
    {
        return bin2hex(openssl_encrypt($value, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
    }

    function aes_decrypt($hash)
    {
        // verifica se a hash é valida
        if(strlen($hash) % 2 != 0)
        {
            return -1;
        }

        return openssl_decrypt(hex2bin($hash), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
    }