<?php
    include('connection.php');
    session_start();
    
    if (!isset($_SESSION['username'])) {
        exit();
    }

    $username = $_SESSION['username']; 
    
    $link_id = isset($_GET['link_id']) ? intval($_GET['link_id']) : 0;
    
    $sql = "SELECT link_id, link_name, link_adr FROM links WHERE link_id = $link_id AND user_name = '" . $username . "'";
    $result = $database->query($sql);
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode([]);
    }
    
    $database->close();
?>