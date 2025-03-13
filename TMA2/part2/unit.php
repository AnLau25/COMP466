<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 
    
    if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
        die(json_encode(["status" => "error", "message" => "Invalid or missing ID."]));
    }

    $id = intval($_GET['id']); 

    // Retrieve XML content
    $query = "SELECT xml_content FROM xml_storage WHERE id = ?";
    $stmt = mysqli_prepare($database, $query);

    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($database)]));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $xmlContent);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (!$xmlContent) {
        die("Error: No XML data found.");
    }

    $xml = simplexml_load_string($xmlContent);
    if ($xml === false) {
        die("Error: Failed to parse XML. Please check its structure.");
    }

    $sql = "SELECT record_status FROM progress_record WHERE user_name = ? AND lesson = ?";
    $stmt = mysqli_prepare($database, $sql);
    mysqli_stmt_bind_param($stmt, "si", $username, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) == 0) {
        $insert_sql = "INSERT INTO progress_record (user_name, lesson) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($database, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "si", $username, $id);
        mysqli_stmt_execute($insert_stmt);
        mysqli_stmt_close($insert_stmt);
    }

    mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
    <title>Unit 1: HTML5 &amp; CSS</title>
</head>
<body>
<!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="/part2/index.php">
                        <h1><span>Learning</span> made<span> fun</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <!--Ricky, if this works Ricky-->
                        <li><a href="/part2/index.php" data-after="home">Home Page</a></li>
                        <li><a href="/part2/unit.php?id=1" data-after="unit1">See Unit 1</a></li>
                        <li><a href="/part2/unit.php?id=2" data-after="unit2">See Unit 2</a></li>
                        <li><a href="/part2/unit.php?id=3" data-after="unit3">See Unit 3</a></li>
                        <li><a href="../tma2.htm#q2" data-after="main">&lt; Go back to cover page</a></li>
                        <form action="logout.php" method="post">
                            <button type="submit" class="cta">LOG OUT</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<!-- End Header -->

    <section id="u1">
        <div class="section-container">
            <?php
                include 'lessonParser.php';
                $htmlContent = xml_lesson_parse($xml);
                echo $htmlContent;

                echo '<br></br>';

                switch ($id) {
                    case 1:
                        echo '<a href="/part2/quiz.php?quiz=4&id='.$id.'" type="button" class="cta">Test your knowledge</a>';
                        break;
                    case 2:
                        echo '<a href="/part2/quiz.php?quiz=5&id='.$id.'" type="button" class="cta">Test your knowledge</a>';
                        break;
                    case 3:
                        echo '<a href="/part2/quiz.php?quiz=6&id='.$id.'" type="button" class="cta">Test your knowledge</a>';
                        break;
                    default:
                        echo "Invalid ID.";
                        break;
                }
            ?>        
        </div>
    </section>
</body>
</html>
