<?php
    include('connection.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        echo "Unauthorized access!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['link_id'])) {
        $link_id = intval($_POST['link_id']);
        $username = $_SESSION['username'];

        $stmt = $database->prepare("DELETE FROM links WHERE link_id = ? AND user_name = ?");
        $stmt->bind_param("is", $link_id, $username);
        
        if ($stmt->execute()) {
            echo "Link deleted successfully!";
        } else {
            echo "Error deleting link!";
        }

        $stmt->close();
        $database->close();
    } else {
        echo "Invalid request!";
    }
?>
