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

    $q_id = intval($_GET['quiz']); 
    $query = "SELECT xml_content FROM xml_storage WHERE id = ?";
    $stmt = mysqli_prepare($database, $query);

    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($database)]));
    }

    mysqli_stmt_bind_param($stmt, "i", $q_id);
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

    if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
        die(json_encode(["status" => "error", "message" => "Invalid or missing lesson ID."]));
    }

    $lsn_id = intval($_GET['id']); 
    $sql = "SELECT record_status FROM progress_record WHERE user_name = ? AND lesson = ?";
    $stmt = mysqli_prepare($database, $sql);
    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($database)]));
    }
    
    mysqli_stmt_bind_param($stmt, "si", $username, $lsn_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $record_status);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../shared/styles.css" />
    <title>Unit 1: HTML5 &amp; CSS</title>
</head>
<body>
<!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="../part2/index.php">
                        <h1>Learning <span>made</span> fun</h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <!--Ricky, if this works Ricky-->
                        <li><a href="../part2/index.php" data-after="home">Home Page</a></li>
                        <li><a href="../part2/unit.php?id=1" data-after="unit1">See Unit 1</a></li>
                        <li><a href="../part2/unit.php?id=2" data-after="unit2">See Unit 2</a></li>
                        <li><a href="../part2/unit.php?id=3" data-after="unit3">See Unit 3</a></li>
                        <li><a href="../index.htm#q2" data-after="main">&lt; Go back to cover page</a></li>
                        <form action="../shared/logout.php" method="post">
                            <input type="hidden" name="folder" value="part2">
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
                        <input type="hidden" id="lesson-status" value="<?php echo htmlspecialchars($record_status); ?>">
                        <div id="qNum-item">
                            <h2>Score: <span id="qScr-txt"> -%</span></h2>
                        </div>
                        <div id="qNum-item">
                            <h2>Questions: <span id="qNum-txt"> -/-</span></h2>
                        </div>
                    </div>
                </form>
            </div>       
        </div>
    </section>
    <script src="./grading.js"></script>
    <script>
        document.getElementById('updater').addEventListener('click', function() {
            let lessonStatus = document.getElementById('lesson-status').value;

            if (lessonStatus === "reading"){
                if (!confirm("Are you sure you want to get your answers graded? If you do, this lesson will be concidered completed.")) {
                    event.preventDefault();
                }else{    
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
                }

            }
        
        });
    </script>
</body>
</html>
