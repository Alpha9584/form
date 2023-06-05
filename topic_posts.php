<?php
    require 'db.php';
    $id_topic = isset($_GET['id_topic']) ? (int)$_GET['id_topic'] : 0;

    if ($id_topic === 0) {
        echo "Invalid topic ID.";
        exit();
    }
    
    $topic_sql = "SELECT * FROM topics WHERE id = {$id_topic}";
    $topic_result = $conn->query($topic_sql);
    $topic = $topic_result->fetch_assoc();
    
    $posts_sql = "SELECT * FROM posts WHERE id_topic = {$id_topic} ORDER BY created_at DESC";
    $posts_result = $conn->query($posts_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/form/">
    <link rel="stylesheet" href="style.css">
    <title>Geek Forum</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <h2 class="title">Topic: <?php echo htmlspecialchars($topic['title'])?></h2>
    <?php if ($posts_result->num_rows > 0):
        while ($post = $posts_result->fetch_assoc()):?>
            <article class='post'>
                <header class="post-header">
                    <h2 class="post-title"><a href="post/<?php echo htmlspecialchars($post['idp'])?>"><?php echo htmlspecialchars($post['title'])?></a></h2>
                    <p class="post-meta">Posted by: <a href="user/<?php echo htmlspecialchars($post['id'])?>"><?php echo htmlspecialchars($post['username'])?></a> on <?php echo htmlspecialchars($post['created_at'])?></p>
                </header>
                <p class="post-content"><?php echo htmlspecialchars($post['content'])?></p>
            </article>
        <?php endwhile; else: ?>
        <p>No posts found for this topic.</p>
    <?php endif;?>
</body>
<?php include("footer.php"); ?>
</html>