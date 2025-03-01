<?php
    $database = mysqli_connect("localhost", "root", "", "bookmarks", 33);
    if ($database->connect_error) {
        die("Error en la conexión: ".$database->connect_error);
    }
    echo "";
?>