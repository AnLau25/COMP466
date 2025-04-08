<?php
    include('connect.php');

    /*Change XML file address to upload a diferent one*/
    $xmlFile = 'eml_quiz3.xml';

    $xmlContent = file_get_contents($xmlFile);
    if ($xmlContent === false) {
        die(json_encode(["status" => "error", "message" => "Failed to read XML file"]));
    }


    $query = "INSERT INTO xml_storage (filename, xml_content) VALUES (?, ?)";
    $stmt = mysqli_prepare($database, $query);

    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($database)]));
    }

    /*Change the file name here. Please note that the name is only qualitative, and the queries are executed via the primary key.*/
    $filename = 'Quiz 3';

    mysqli_stmt_bind_param($stmt, "ss", $filename, $xmlContent);
    if (!mysqli_stmt_execute($stmt)) {
        die(json_encode(["status" => "error", "message" => "Query failed: " . mysqli_stmt_error($stmt)]));
    }
    mysqli_stmt_close($stmt);
    mysqli_close($database);

    echo json_encode(["status" => "success", "message" => "Q3 Stored"]);
?>
<!--Fua larevisvis escuby-->
