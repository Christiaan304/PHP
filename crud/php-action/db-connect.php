<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    $connect = mysqli_connect($hostname, $username, $password, $database);
    //mysqli_set_charset($connect, "utf8");

    if(mysqli_connect_error())
    {
        echo "Connection error: ". mysqli_connect_error();
    }
?>