<?php
    include('connect.php');

    $xmlFile = 'C:/Users/User/Documents/A_UNI/YOff/Atha/COMP466/TMA2/part2/eml_U3.xml';

    $xmlContent = file_get_contents($xmlFile);
    if ($xmlContent === false) {
        die(json_encode(["status" => "error", "message" => "Failed to read XML file"]));
    }


    $query = "INSERT INTO xml_storage (filename, status, xml_content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($database, $query);

    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($database)]));
    }

    $filename = 'eml_U1';
    $status = 'unread';

    mysqli_stmt_bind_param($stmt, "sss", $filename, $status, $xmlContent);
    if (!mysqli_stmt_execute($stmt)) {
        die(json_encode(["status" => "error", "message" => "Query failed: " . mysqli_stmt_error($stmt)]));
    }
    mysqli_stmt_close($stmt);
    mysqli_close($database);

    echo json_encode(["status" => "success", "message" => "Stored"]);
?>
