<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lessons";
    $port = 33;
    
    $database = mysqli_connect( $hostname, $username, $password, $dbname, $port);
    if ($database->connect_error) {
        die("Error en la conexión: ".$database->connect_error);
    }
    echo "";


/*

*/

?>
