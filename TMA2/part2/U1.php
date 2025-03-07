<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 

    $id = 1; 
    $query = "SELECT xml_content FROM xml_storage WHERE id = ?";
    $stmt = mysqli_prepare($database, $query);

    if (!$stmt) {
        die(json_encode(["status" => "error", "message" => "Failed to prepare statement: " . mysqli_error($database)]));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $xmlContent);
    mysqli_stmt_fetch($stmt);

    $xml = simplexml_load_string($xmlContent);
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
                    <a href="#hero">
                        <h1><span>Learning</span> made<span> fun</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                    <li><a href="#u1" data-after="Unit1">See Unit 1</a></li>
                        <li><a href="#u2" data-after="unit2">See Unit 2</a></li>
                        <li><a href="#u3" data-after="unit3">See Unit 3</a></li>
                        <li><a href="#quiz" data-after="quiz">Quiz yourself</a></li>
                        <li><a href="/tma1.htm#q2" data-after="quiz">&lt; Go back to cover page</a></li>
                        <form action="logout.php" method="post">
                            <button type="submit" class="cta">LOG OUT</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Header -->
    
    <?php

        function parseElement($element)
        {
            $html = "";
            foreach ($element->children() as $child) {
                $tag = $child->getName();
                switch ($tag) {
                    case 'title':
                        $html .= "<h2>" . trim($child) . "</h2>";
                        break;
                    case 'subtitle':
                    case 'paragraph':
                    case 'list-paragraph':
                        $html .= "<p>" . trim($child) . "</p>";
                        break;
                    case 'list':
                        $html .= "<ul>" . parseElement($child) . "</ul>";
                        break;
                    case 'item':
                        $html .= "<li>" . trim($child) . "</li>";
                        break;
                    case 'img':
                        $html .= "<img src='" . trim($child) . "' alt='Image'>";
                        break;
                    default:
                        $html .= parseElement($child);
                        break;
                }
            }
            return $html;
        }

        $htmlOutput = "<html><head><title>XML Parsed</title></head><body>";
        $htmlOutput .= parseElement($xml);
        $htmlOutput .= "</body></html>";

        echo $htmlOutput;
    ?>

    
</body>
</html>