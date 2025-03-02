<?php
    include('connection.php');

    if (!$database) {
        die(json_encode(["status" => "error", "message" => "No systems: " . mysqli_connect_error()]));
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['usr']);
        $password = trim($_POST['pswrd1']);
        $verificator = trim($_POST['pswrd2']);

        if ($password !== $verificator) {
            echo json_encode(["status" => "error", "message" => "Signup failed. Passwords do not match!"]);
            exit();
        }

        $check_sql = "SELECT user_name FROM users WHERE user_name = ?";
        $check_stmt = mysqli_prepare($database, $check_sql);
        mysqli_stmt_bind_param($check_stmt, "s", $username);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_store_result($check_stmt);

        if (mysqli_stmt_num_rows($check_stmt) > 0) {
            echo json_encode(["status" => "error", "message" => "Signup failed. Username already taken. Please choose another one."]);
            mysqli_stmt_close($check_stmt);
            exit();
        }
        mysqli_stmt_close($check_stmt);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (user_name, user_pswrd) VALUES (?, ?)";
        $stmt = mysqli_prepare($database, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);

        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["status" => "success", "message" => "Signin successful! Redirecting to login..."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Signin failed. Please try again."]);
        }

        mysqli_stmt_close($stmt);
    }
?>
