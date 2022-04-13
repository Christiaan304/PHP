<?php
    $archive = 'arquivo.txt';
    $sizeArchive = filesize($archive);
    $content = "Lorem ipsum dolor sit amet\r\n";
    
    $openArchive = fopen($archive, 'r');

    while(!feof($openArchive))
    {
        $line = fgets($openArchive, $sizeArchive);
        echo $line."<br></br>";
    }
    //fwrite($openArchive, $content);
    fclose($openArchive); 
?>
    