<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    $connect = mysqli_connect($hostname, $username, $password, $database);

    if(mysqli_connect_error())
    {
        echo "Connection error: ". mysqli_connect_error();
    }