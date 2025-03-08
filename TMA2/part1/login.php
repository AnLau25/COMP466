<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="theyWouldntLetMeInlineStyle">

    <section id="header">
        <div class="header container">
            <div class="nav-bar">
                <div class="brand">
                    <a href="#hero">
                        <h1><span>The</span> bookmark <span>page</span></h1>
                    </a>
                </div>
                <div class="nav-list">
                    <ul>
                        <li><a href="../tma2.htm#q1" data-after="main">&lt; Go back to cover page</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="log-in">
        <div class="hero container">
            <div class="login-container">
                <p>Help us identify you, so we can get your bookmarks!</p>
                <form id="loginForm">
                    <label class="input-label">Username:
                        <input class="cta" name="usr" type="text" placeholder="Type in your username" size="30" required />
                    </label>
                    <label class="input-label">Password:
                        <input class="cta" name="pswrd" type="password" placeholder="Type in your password" size="30" maxlength="50" required />
                    </label>
                    <p class="section-subtitle">New around here? No worries, sign up <a href="./signin.php" class="abi">HERE</a>!</p>
                    <button type="submit" class="cta">LOGIN</button>
                </form>
                <p id="loginMessage"></p> 
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault(); 

                $.ajax({
                    type: "POST",
                    url: "login_process.php",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            window.location.href = "index.php"; 
                        } else {
                            $("#loginMessage").text(response.message).css("color", "red");
                        }
                    }
                });
            });
        });
    </script>

</body>
</html>
