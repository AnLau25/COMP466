<?php
    include('connect.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $username = $_SESSION['username']; 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Learning Website</title>
    <script type="text/javascript" async
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/3.2.0/es5/tex-mml-chtml.js">
        </script>
    <link rel="stylesheet" type="text/css" href="../shared/styles.css" />
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
                        <!--Ricky, if this works Ricky-->
                        <li><a href="../part2/index.php" data-after="home">Home Page</a></li>
                        <li><a href="../part2/unit.php?id=1" data-after="unit1">See Unit 1</a></li>
                        <li><a href="../part2/unit.php?id=2" data-after="unit2">See Unit 2</a></li>
                        <li><a href="../part2/unit.php?id=3" data-after="unit3">See Unit 3</a></li>
                        <li><a href="../tma2.htm#q2" data-after="main">&lt; Go back to cover page</a></li>
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

    <!-- Hero Section  -->
    <section id="hero">
        <div class="hero container">
            <div class="text-block">
                <h1>Hi there, <span><?php echo htmlspecialchars($username); ?>!</span></h1>
                <h2 >Pick up where you left up:</h2>
                <ul id="lessonList"></ul>
            </div>
        </div>
    </section>
    <!-- End Hero Section  -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            loadlessons();

            function loadlessons() {
                let lessonList = document.getElementById("lessonList");
                let xhr = new XMLHttpRequest();
                xhr.open("GET", "tracking.php", true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        lessonList.innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            }
        });
    </script>

</body>
<!-- It hurts me more than u (could use timer, we'll see)-->
    <script src="../shared/sessClosing.js"></script>
</html>