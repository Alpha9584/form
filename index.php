<?php
    require 'db.php';
    if (isset($_SESSION["username"])){
        $logged = 1;
        $user = $_SESSION["username"] ;
        $sql = "SELECT * FROM accounts WHERE username = '$user'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $email=$row["email"];
        $date=$row["date"];
        $dateTime = DateTime::createFromFormat("Y-m-d", $date);
        $formattedDate = $dateTime->format("d F Y");
    }
    else $logged = 0;

    $sql_posts = "SELECT * FROM posts where title is not NULL";
    $sql_recent = "SELECT * FROM posts where title is not NULL ORDER BY created_at DESC";
    $result_recent = $conn->query($sql_recent);
    $result_posts = $conn->query($sql_posts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Geek Forum</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <main>
        <article class="post">
        <?php if ($result_posts->num_rows > 0):?>
            <?php $i=0;?>
            <?php while ($post = $result_posts->fetch_assoc() and $i++<10): ?>
                <header class="post-header">
                    <h2 class="post-title"><a href="post/<?php echo htmlspecialchars($post['idp'])?>"><?php echo htmlspecialchars($post['title']); ?></a></h2>
                    <p class="post-meta">Posted by <a href="user/<?php echo htmlspecialchars($post['id'])?>"><?php echo htmlspecialchars($post['username']);?></a> on <time datetime="2023-03-25"><?php echo htmlspecialchars($post['created_at']); ?></time></p>
                </header>
                <br>
            <?php endwhile; ?>
            <?php else: ?>
                <p>No posts available.</p>
            <?php endif; ?>
        </article>

    <aside class="sidebar">
        <?php if($logged==1):?>
        <section class="sidebar-section">
            <h2 class="sidebar-title">User Information</h2>
            <div class="sidebar-content">
                <p>Username: <?php echo htmlspecialchars($user) ?></p>
                <p>Member since: <?php echo htmlspecialchars($formattedDate)?></p>
            </div>
        </section>
        <?php endif?>
        <section class="sidebar-section">
            <h2 class="sidebar-title">Recent Posts</h2>
            <ul class="sidebar-list">
            <?php $i=0?>
            <?php while ($post = $result_recent->fetch_assoc() and $i++<3): ?>
                <li><a href="post/<?php echo htmlspecialchars($post['idp'])?>"><?php echo htmlspecialchars($post['title']); ?></a></li>
            <?php endwhile;?>
            </ul>
        </section>
        <section class="sidebar-section">
            <h2 class="sidebar-title">Topics</h2>
            <ul class="sidebar-list">
                <?php
                    $tops = "SELECT * FROM TOPICS";
                    $tops = $conn -> query($tops);
                    while ($top = $tops->fetch_assoc()):
                ?>
                <li><a href="topic_posts/<?php echo htmlspecialchars($top["id"])?>"><?php echo htmlspecialchars($top["title"])?></a></li>
                <?php endwhile;?>
            </ul>
        </section>
    </aside>

    </main>
    <?php include("footer.php"); ?>
</body>
</html>
