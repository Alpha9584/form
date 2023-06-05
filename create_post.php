<?php
    require_once("db.php");

    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }


    $sql = "SELECT id, title FROM topics";
    $result = $conn->query($sql);
    $topics = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $topics[] = $row;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_SESSION["username"];
        $id = $_SESSION["id"];
        $title = trim($_POST["title"]);
        $content = trim($_POST["content"]);
        $topic_id = $_POST["topic_id"];

        if (!empty($title) && !empty($content)) {
            $sql = "INSERT INTO posts (id, username, title, content, id_topic) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssi", $id,$user, $title, $content, $topic_id);
            if ($stmt->execute()) {
                header("Location: topic_posts/".$topic_id);
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="create.css">
</head>
<body>
    <?php include("header.php"); ?>

    <main>
        <h1 class='title'>Create a new post</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="topic_id">Select Topic:</label>
            <select name="topic_id" id="topic_id" required>
                <option value="">--Select a topic--</option>
                <?php foreach($topics as $topic): ?>
                    <option value="<?php echo $topic['id']; ?>"><?php echo $topic['title']; ?></option>
                <?php endforeach; ?>
            </select>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
            <label for="content">Content:</label>
            <textarea name="content" id="content" rows="10" required></textarea>
            <button class="sub" type="submit">Submit Post</button>
        </form>
    </main>

    <?php include("footer.php"); ?>
</body>
</html>
