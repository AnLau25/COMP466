<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 
    
    if (!isset($_GET['quiz']) || !filter_var($_GET['quiz'], FILTER_VALIDATE_INT)) {
        die(json_encode(["status" => "error", "message" => "Invalid or missing ID."]));
    }

    $id = intval($_GET['quiz']); 
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
            <div class="form-container">
                <form method="POST" id="quiz-form">
                    <?php
                        include 'quizParser.php';
                        $htmlContent = xml_quiz_parse($xml);
                        echo $htmlContent;
                    ?> 
                    <br>
                    <div class="grading">
                        <br>
                        <input class="cta" type="submit" id="updater" value="Submit">
                        <div id="qNum-item">
                            <h2>Score: <span id="qScr-txt"> -%</span></h2>
                        </div>
                        <div id="qNum-item">
                            <h2>Questions: <span id="qNum-txt"> -/40</span></h2>
                        </div>
                    </div>
                </form>
            </div>       
        </div>
    </section>
    <script src="/part2/grading.js"></script>
    <script>
        document.getElementById('updater').addEventListener('click', function() {
            fetch('done.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            })
            .then(() => {
                console.log('PHP script executed.');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
