<?php
    include('connection.php');
    session_start();

    $response = ['success' => false, 'message' => 'Invalid username or password.'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST['usr']);
        $password = trim($_POST['pswrd']);

        $sql = "SELECT user_pswrd FROM users WHERE user_name = ?";
        $stmt = mysqli_prepare($database, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['user_pswrd'])) {
                $_SESSION['username'] = $username;
                $response = ['success' => true];
            } else {
                $response['message'] = "Invalid username or password.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>
