<?php
    require 'db.php';
    $sql = "SELECT * FROM topics";
    $topics = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics Page</title>
    <base href="/form/">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Roboto+Slab:400,700" rel="stylesheet">
    <link rel="stylesheet" href="topic.css">
    <style></style>
</head>
<body>
    <?php require "header.php"?>
    <main class="container">
        <h1>Topics</h1>
        <section class="topics">
            <ul class="topic-list">
            <?php if ($topics->num_rows > 0):?>
            <?php while ($topic = $topics->fetch_assoc()):?>
                <li class="topic-item">
                    <a href="topic_posts/<?php echo $topic['id']; ?>" class="topic-title">
                        <h2><?php echo htmlspecialchars($topic['title']); ?></h2>
                    </a>
                    <p class="topic-description"><?php echo htmlspecialchars($topic['description']); ?></p>
                </li>
            <?php endwhile;?>
            <?php else: ?>
                <p>No topics found.</p>
            <?php endif;?>
            </ul>
        </section>
    </main>
    <?php include("footer.php"); ?>

</body>
</html>
