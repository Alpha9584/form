<?php
    require "db.php";
    if (!isset($_SESSION["username"])){
        header("Location: login.php");
        exit;
    }
    $user = $_SESSION["username"] ;
    $sql = "SELECT * FROM accounts WHERE username = '$user'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $email=$row["email"];
    $pic = $row["profile_pic"];
    $pass = $row["password"];

?>

<?php
    $alert_message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $alert_message = "";
        $puser = $_POST["username"];
        $pemail = $_POST["email"];
        $ppassword = $_POST["password"];
        $pconfirm_password = $_POST["confirm-password"];
        $target_dir = "photos/";
        $target_file = $target_dir . basename($_FILES["profile-pic"]["name"]);
        echo "<script>alert('".$target_file."')</script>";

        if($pemail == $email && empty($ppassword) && $target_dir == $target_file && $puser==$user){
            echo "<script>alert('No changes made')</script>";
        }
        if(!password_verify($pconfirm_password,$pass)){
            echo "<script>alert('Password does not match')</script>";
        }
        else{
            if (!empty($_FILES["profile-pic"]["name"])) {
                $filename = $_FILES["profile-pic"]["name"];
                $filename_parts = explode(".", $filename);
                $imageFileType = strtolower(end($filename_parts));
                $uploadOk = 0;
            
                $check = getimagesize($_FILES["profile-pic"]["tmp_name"]);
                if ($check !== false) {
                    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                        $new_image = $target_file;
                        move_uploaded_file($_FILES["profile-pic"]["tmp_name"], $target_file);
                        $uploadOk = 1;
                    } else {
                        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                    }
                } else {
                    echo "<script>alert('File is not an image.');</script>";
                }
            
                if ($uploadOk == 0) {
                    $new_image = $pic;
                }
            } else {
                $new_image = $pic;
            }
            
            
            if (empty($ppassword)) {
                $ppassword = $pass;
            } else {
                $ppassword = password_hash($ppassword, PASSWORD_DEFAULT);
            }
            
            if (empty($alert_message)) {
                $q = "UPDATE accounts SET username='$puser', email='$pemail', profile_pic='$new_image', password='$ppassword' WHERE username='$user'";
                if ($conn->query($q) === TRUE) {
                    echo "<script>alert('Record updated successfully')</script>";
                    $_SESSION["username"] = $puser;
                    header("Location: profile.php");
                    exit;
                } else {
                    echo "<script>alert('Error updating record: " . $conn->error."')</script>";
                }
            }
            
    }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <title>Profile</title>
</head>
<body>
    <?php require 'header.php';?>

    <main>
        <section class="profile">
            <h1>Profile</h1>
            <form enctype="multipart/form-data" method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $user ?>">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?>">

                <label for="profile-pic">Profile Picture</label>
                <div class="picture-container">
                <img id="profile-pic-preview" src="<?php echo $pic ?>" alt="Profile Picture Preview">
                </div>
                <input type="file" id="profile-pic" name="profile-pic">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password">

                <button type="submit">Save Changes</button>
                <script>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    echo $alert_message;
                }
                ?>
                </script>
            </form>

        </section>
    </main>
    <footer>
        <p>&copy; 2023 Geek Forum. All rights reserved.</p>
    </footer>
</body>
</html>
