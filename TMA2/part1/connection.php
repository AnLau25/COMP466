<?php
    $hostname = "sql204.infinityfree.com";
    $username = "if0_38668808";
    $password = "TPtwDTdJALbwB";
    $dbname = "if0_38668808_bookmarks";
    
    $database = mysqli_connect( $hostname, $username, $password, $dbname);
    if ($database->connect_error) {
        die("Error en la conexión: ".$database->connect_error);
    }
    echo "";
?>