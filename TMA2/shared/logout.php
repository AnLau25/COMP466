<?php
    if (!isset($_POST['folder'])) {
        die(json_encode(["status" => "error", "message" => "Invalid or missing folder."]));
    }    

    $folder = htmlspecialchars($_POST['folder'], ENT_QUOTES, 'UTF-8'); 

    session_start();
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/'); 

    header("Location: ../$folder/login.php");
    exit();
?>
