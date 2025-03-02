<?php
    include('connection.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        echo json_encode(["status" => "error", "message" => "Unauthorized. Please log in."]);
        exit();
    }

    $username = $_SESSION['username'];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newLink'])) {
        $link = trim($_POST['link']);
        $linkname = trim($_POST['name']);

        $check_sql = "SELECT link_name FROM links WHERE user_name = ? AND link_adr = ?";
        $check_stmt = mysqli_prepare($database, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "ss", $username, $link);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $existing_linkname);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            mysqli_stmt_fetch($check_stmt);
            echo json_encode(["status" => "error", "message" => "This URL is already saved as '$existing_linkname'."]);
            mysqli_stmt_close($check_stmt);
            exit();
        }
        mysqli_stmt_close($check_stmt);

        $sql = "INSERT INTO links (link_adr, link_name, user_name) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($database, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $link, $linkname, $username);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Website bookmarked successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Bookmark failed. Please try again."]);
        }

        mysqli_stmt_close($stmt);
    }
?>
