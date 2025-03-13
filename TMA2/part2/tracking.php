<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 

    $username = $database->real_escape_string($username);

    $sql = "SELECT lesson, user_name, record_status, xml_storage.filename, xml_storage.id 
            FROM progress_record 
            JOIN xml_storage ON progress_record.lesson = xml_storage.id
            WHERE progress_record.user_name='$username'
            ORDER BY lesson DESC";

    $result = $database->query($sql);

    if ($result->num_rows == 0) {
        echo '<li>Get Started: <a class="abi" href="/part2/unit.php?id=1">Unit 1</a></li>';
    } else {
        while ($row = $result->fetch_assoc()) {
            if ($row['record_status'] == 'reading') {
                echo '<li>In progress: <a href="../part2/unit.php?id='.$row['id'].'" class="abi">' . $row['filename'] . '</a></li>';
            }
            elseif ($row['record_status'] == 'tested') {
                echo '<li>Completed: <a href="../part2/unit.php?id='.$row['id'].'" class="abi">' . $row['filename'] . '</a></li>';
            }
        }
    }
?>
