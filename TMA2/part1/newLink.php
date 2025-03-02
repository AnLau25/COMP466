<?php
    include('connection.php');
    session_start();
    if (!$database) {
        die("No systems: " . mysqli_connect_error());
    }

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 

    if (isset($_POST['submit'])) {
        $link = trim($_POST['link']);
        $linkname = trim($_POST['name']);

        $check_sql = "SELECT link_name, link_adr FROM links WHERE user_name = ? AND link_adr = ?";
        $check_stmt = mysqli_prepare($database, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "ss", $username, $link);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $link_name, $link_adr);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            mysqli_stmt_fetch($check_stmt);
            echo '<script>
                    alert("This URL is already saved as \'' . $link_name . '\'.");
                    window.location.href = "index.php";
                </script>';
            mysqli_stmt_close($check_stmt);
            exit();
        }
        mysqli_stmt_close($check_stmt);

        // Insert the new user
        $sql = "INSERT INTO links (link_adr, link_name, user_name) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($database, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $link, $linkname, $username);

        if (mysqli_stmt_execute($stmt)) {
            echo '<script>
                    alert("Website Bookmarked successfully!");
                    window.location.href = "index.php/#create";
                </script>';
        } else {
            echo '<script>
                    alert("Bookmark failed. Please try again.");
                    window.location.href = "index.php/#create";
                </script>';
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
?>
