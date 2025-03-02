<?php
   include('connection.php');
   session_start();

   if (!isset($_SESSION['username'])) {
       header("Location: login.php");
       exit();
   }

   $username = $_SESSION['username']; 

   $link_id = isset($_POST['link_id']) ? intval($_POST['link_id']) : 0;

    if ($link_id > 0) {
        $sql = "UPDATE links SET link_click = link_click + 1 WHERE link_id = ? AND user_name = ?";
        $stmt = $database->prepare($sql);
        $stmt->bind_param("is", $link_id, $_SESSION['username']);
        
        if ($stmt->execute()) {
            echo "Click count updated";
        } else {
            echo "Failed to update click count";
        }
        $stmt->close();
    }

    $database->close();
?>
   