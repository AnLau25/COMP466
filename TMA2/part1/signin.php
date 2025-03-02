<?php
include('connection.php');
if (!$database) {
    die("No systems: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $username = trim($_POST['usr']);
    $password = trim($_POST['pswrd1']);
    $verificator = trim($_POST['pswrd2']);

    if ($password !== $verificator) {
        echo '<script>
                alert("Signup failed. Passwords do not match!");
                window.location.href = "signin.php";
              </script>';
        exit();
    }

    // Check if username already exists
    $check_sql = "SELECT user_name FROM users WHERE user_name = ?";
    $check_stmt = mysqli_prepare($database, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "s", $username);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);

    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        echo '<script>
                alert("Signup failed. Username already taken. Please choose another one.");
                window.location.href = "signin.php";
              </script>';
        mysqli_stmt_close($check_stmt);
        exit();
    }
    mysqli_stmt_close($check_stmt);

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert the new user
    $sql = "INSERT INTO users (user_name, user_pswrd) VALUES (?, ?)";
    $stmt = mysqli_prepare($database, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>
                alert("Signin successful! Please log in.");
                window.location.href = "login.php";
              </script>';
    } else {
        echo '<script>
                alert("Signin failed. Please try again.");
                window.location.href = "signin.php";
              </script>';
    }

    // Close statement
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

</body>

</html>