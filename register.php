<?php
$alert_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db.php';
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $check_sql = "SELECT * FROM accounts WHERE username = '$user' OR email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        $alert_message = "alert('Username or Email already exists. Please try logging in instead.');";
    } else {
        $sql = "INSERT INTO accounts (username, email, password) VALUES ('$user', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $alert_message = "alert('New user registered successfully.'); window.location.href = 'login.php';";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <title>Register - Geek Forum</title>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        <form action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login instead</a>.</p>

    </div>
    <script src="register.js"></script>
    <script>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $alert_message;
    }
    ?>
    </script>
</body>
</html>
