<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 

    $id = 3; 
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
    <title>Unit 3: XML &amp; Ajax</title>
</head>
<body>
<!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="/index.php">
                        <h1><span>Learning</span> made<span> fun</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                    <li><a href="/part2/U1.php" data-after="Unit1">See Unit 1</a></li>
                        <li><a href="/part2/U2.php" data-after="unit2">See Unit 2</a></li>
                        <li><a href="/part2/U3.php" data-after="unit3">See Unit 3</a></li>
                        <li><a href="../tma2.htm#q2" data-after="quiz">&lt; Go back to cover page</a></li>
                        <form action="logout.php" method="post">
                            <button type="submit" class="cta">LOG OUT</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<!-- End Header -->

    <section id="u3">
        <?php
            include 'lessonParser.php';
            $htmlContent = xml_lesson_parse($xml);
            echo $htmlContent;
        ?>
    </section>
</body>
</html>
