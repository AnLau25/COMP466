<?php
    include('connection.php');
    
    if (isset($_POST['submit'])) {
        $username = trim($_POST['usr']);
        $password = trim($_POST['pswrd']);

        // Using prepared statements to prevent SQL injection
        $sql = "SELECT user_pswrd FROM users WHERE user_name = ?";
        $stmt = mysqli_prepare($database, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Verify the hashed password
            if (password_verify($password, $row['user_pswrd'])) {
                session_start();
                $_SESSION['username'] = $username;
                header("Location: index.php");
                exit();
            } else {
                echo '<script>
                        alert("Login failed. Invalid username or password!");
                        window.location.href = "login.php";
                      </script>';
            }
        } else {
            echo '<script>
                    alert("Login failed. Invalid username or password!");
                    window.location.href = "login.php";
                  </script>';
        }

        mysqli_stmt_close($stmt);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>
    <link rel="stylesheet" type="text/css" href="/shared/styles.css" />
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
                <p>Help us dentify you, so we can get your bookmarks!</p>
                <form method="post">
                    <label class="input-label">Username:
                        <input class="cta" name="usr" type="text" placeholder="Type in your username"
                            size="30" required />
                    </label>
                    <label class="input-label">Password:
                        <input class="cta" name="pswrd" type="password"  placeholder="Type in your password"
                            size="30" maxlength="50" required />
                    </label>
                    <p class="section-subtitle">New arround here? No wories, sign up <a href="./signin.php" class="abi">here</a>!</p>
                    <button type="submit" name="submit" class="cta">LOG-IN</button>
                </form>

            </div>
    </section>

</body>

</html>