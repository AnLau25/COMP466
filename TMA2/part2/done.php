<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        die(json_encode(["status" => "error", "message" => "User not logged in."]));
    }

    $username = $_SESSION['username']; 
    error_log("Username from session: " . $username);

    $username = $database->real_escape_string($username);

    if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
        error_log("Invalid or missing ID: " . ($_GET['id'] ?? 'NULL'));
        die(json_encode(["status" => "error", "message" => "Invalid or missing ID."]));
    }

    $id = intval($_GET['id']);
    error_log("Lesson ID: " . $id);

    $sql = "SELECT record_status FROM progress_record WHERE user_name = ? AND lesson = ?";
    $stmt = mysqli_prepare($database, $sql);

    if (!$stmt) {
        error_log("SQL Error: " . mysqli_error($database));
        die(json_encode(["status" => "error", "message" => "Database error."]));
    }

    mysqli_stmt_bind_param($stmt, "si", $username, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $record_status);

    if (mysqli_stmt_fetch($stmt)) {
        error_log("Record Status: " . $record_status);
    } else {
        error_log("No record found for user: $username and lesson: $id");
    }

    mysqli_stmt_close($stmt);

    if ($record_status == 'reading') {
        $update_sql = "UPDATE progress_record SET record_status = 'tested' WHERE user_name = ? AND lesson = ?";
        $update_stmt = mysqli_prepare($database, $update_sql);

        if (!$update_stmt) {
            error_log("Update SQL Error: " . mysqli_error($database));
            die(json_encode(["status" => "error", "message" => "Database error while updating."]));
        }

        mysqli_stmt_bind_param($update_stmt, "si", $username, $id);
        mysqli_stmt_execute($update_stmt);

        if (mysqli_stmt_affected_rows($update_stmt) > 0) {
            error_log("Update successful for user: $username, lesson: $id");
        } else {
            error_log("Update failed or no change for user: $username, lesson: $id");
        }

        mysqli_stmt_close($update_stmt);
    }

    echo json_encode(["status" => "success", "message" => "Process completed."]);
?>
