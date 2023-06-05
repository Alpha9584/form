<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db.php';
    $user_or_email = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM accounts WHERE username = '$user_or_email' OR email = '$user_or_email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row["password"])) {
            $_SESSION["id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $alert_message = "success";
        } else {
            $error_msg = "Invalid username/email or password.";
        }
    } else {
        $error_msg = "Invalid username/email or password.";
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login - Geek Forum</title>
    
</head>
<body>
    
    <div class="login-container">
        <h1>Login</h1>
        <?php
        if (isset($error_msg)) {
            echo "<p class='error-msg'>$error_msg</p>";
        }
        ?>
        <form method="post" action="login.php">
            <label for="username">Username or Email</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register instead</a>.</p>
    </div>

    <script>
    <?php
    if (isset($alert_message) && $alert_message == "success") {
        echo "window.parent.location.href = 'index.php';";
    }
    ?>
    </script>
</body>
</html>
