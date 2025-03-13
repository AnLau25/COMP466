<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>
    <link rel="stylesheet" type="text/css" href="../shared/styles.css"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="theyWouldntLetMeInlineStyle">
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
                <p>Let'sget you set up so you can start booking!</p>
                <form method="post">
                    <label class="input-label">Username:
                        <input class="cta" name="usr" type="text" placeholder="Type in your username"
                            size="30" required />
                    </label>
                    <label class="input-label">Password:
                        <input class="cta" name="pswrd1" type="password"  placeholder="Type in your password"
                            size="30" maxlength="50" required />
                    </label>
                    <label class="input-label">Password verification:
                        <input class="cta" name="pswrd2" type="password"  placeholder="Type in your password"
                            size="30" maxlength="50" required />
                    </label>
                    <p class="section-subtitle">Already got an account? <a href="./login.php" class="abi">LOGIN</a>!</p>
                    <button type="submit" name="submit" class="cta">SIGNIN</button>
                </form>

            </div>
    </section>
    <script>
        $(document).ready(function() {
            $("form").on("submit", function(event) {
                event.preventDefault();
                
                var formData = $(this).serialize(); 

                $.ajax({
                    type: "POST",
                    url: "signin_process.php",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            alert(response.message);
                            window.location.href = "login.php"; 
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>

</body>

</html>