<?php
    include('connection.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        exit("Unauthorized access");
    }

    $username = $_SESSION['username']; 

    $link_id = isset($_POST['link_id']) ? intval($_POST['link_id']) : 0;
    $link_name = isset($_POST['link_name']) ? $database->real_escape_string($_POST['link_name']) : '';
    $link_adr = isset($_POST['link_adr']) ? $database->real_escape_string($_POST['link_adr']) : '';

    if ($link_id > 0 && !empty($link_name) && !empty($link_adr)) {
        $sql = "UPDATE links SET link_name='$link_name', link_adr='$link_adr' WHERE link_id=$link_id AND user_name = '" . $username . "'";
        if ($database->query($sql) === TRUE) {
            echo "Link updated successfully!";
        } else {
            echo "Error updating link.";
        }
    } else {
        echo "Invalid input.";
    }

    $database->close();
?>