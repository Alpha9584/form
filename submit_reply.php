<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["username"]) && isset($_POST["reply"]) && isset($_POST["user_id"]) && isset($_POST["post_id"]) && isset($_POST["original"])) {
        $username = $_SESSION["username"];
        $idp = $_POST["post_id"];
        $id = $_POST["user_id"];
        $reply_content = $_POST["reply"];
        echo "<script>alert('{$id}')</script>";
        $sql = "INSERT INTO posts (under, id, username,content) VALUES ('$idp','$id','$username','$reply_content')";
        $result = $conn->query($sql);
        header("Location: post.php?idp=".$_POST["original"]);
    } else {
        echo "Error: Invalid submission.";
    }
} else {
    header("Location: index.php");
}
?>
