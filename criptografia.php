<?php
    $password = "1234561";
    $hash = '$2y$10$zITQXJKJqeaUWFWAjy/avuPcYqHGOMtVqmy.QFeve4xjQrmPHiPMe';

    $newPassword = base64_encode($password);
    echo "<p>sua senha é: ". base64_decode($newPassword) . "</p>";
    echo "<p>base64: ". $newPassword . "</p>";

    echo "<p>MD5: ". md5($password) . "</p>";
    echo "<p>SHA1: ". sha1($password) . "</p>";
    
    if(password_verify($password, $hash))
    {
        echo "<p>valid</p>";
    }
    else
    {
        echo 'invalid';
    }
?>