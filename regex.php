<?php
    $string = "contact@blackmail.net";
    $pattern = "/^[a-z0-9.\-\_]+@[a-z0-9.\-\_]+\.(com|br|com.br|net)$/";

    if(preg_match($pattern, $string))
    {
        echo "<p>Válido</p>";
        echo $string;
    }
    else
    {
        echo "Inválido";
    }
?>