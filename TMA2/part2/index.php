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
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
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

    <!-- Hero Section  -->
    <section id="hero">
        <div class="hero container">
            <div class="text-block">
                <h1>Hi there, <span><?php echo htmlspecialchars($username); ?>!</span></h1>
                <h2>This is your progress:</h2>
                
        </div>
    </section>
    <!-- End Hero Section  -->


</body>
<!-- It hurts me more than u (could use timer, we'll see)
<script>
    window.addEventListener('beforeunload', function (e) {
        fetch('logout.php', {
            method: 'POST',
            keepalive: true
        });
    });
</script>
-->
</html>