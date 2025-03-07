<?php
include('connect.php');


$sql = "SELECT user_name, user_pswrd FROM users";
$result = mysqli_query($database, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $username = $row['user_name'];
    // Assuming the current passwords are plaintext
    $plaintextPassword = $row['user_pswrd']; 

    // Hash the plaintext password
    $hashedPassword = password_hash($plaintextPassword, PASSWORD_BCRYPT); 

    // Test if the hashed password matches the plaintext password
    if (password_verify($plaintextPassword, $hashedPassword)) {
        echo "Password for user '$username' verified<br>";
    } else {
        echo "Failed for user '$username'.<br>";
    }

    // Update the database with the hashed password
    $updateSql = "UPDATE users SET user_pswrd = ? WHERE user_name = ?";
    $stmt = mysqli_prepare($database, $updateSql);
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $username);
    mysqli_stmt_execute($stmt);
}

echo "Passwords updated to hash";
?>
