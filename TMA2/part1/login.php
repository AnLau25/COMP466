<?php
    include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
</head>

<body>
    <!-- Header -->
    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="#hero">
                        <h1><span>The</span> bookmark <span>page</span></h1>
                    </a>
                </div>
            </div>
    </section>
    <!-- End Header -->

    <section id="log-in">
        <div class="hero container">
            <div class="login-container">
                <p>Help us dentify you, so we can get your bookmarks!</p>
                <form action="index.php" method="post">
                    <label class="input-label">Username:
                        <input class="cta" name="usr" type="text" placeholder="Type in your username"
                            size="30" required />
                    </label>
                    <label class="input-label">Password:
                        <input class="cta" name="pswrd" type="text" placeholder="Type in your password"
                            size="30" maxlength="50" required />
                    </label>
                    <p class="section-subtitle">New arround here? No wories, sign up <a href="./signin.php" class="abi">here</a>!</p>
                    <button type="submit" id="newLink" class="cta">LOG-IN</button>
                </form>

            </div>
    </section>

</body>

</html>