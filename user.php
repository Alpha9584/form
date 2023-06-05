<?php
    require 'db.php';
    $profile_id = isset($_GET['idu']) ? $_GET['idu'] : null;

    $sql = "SELECT * FROM accounts WHERE id = '$profile_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    $posts_sql = "SELECT * FROM posts WHERE id = '$profile_id'";
    $posts_result = $conn -> query($posts_sql);

    $conn->close();
?>

    <?php if($user): ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Profile</title>
            <base href="/form/">
            <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Roboto+Slab:400,700" rel="stylesheet">
            <link rel="stylesheet" href="user.css">
        </head>
        <body>

            <?php require 'header.php';?>
            <main>
                <section class="profile">
                    <h1>User Profile</h1>
                    <div class="picture-container">
                        <img src="<?php echo htmlspecialchars($user['profile_pic'])?>" alt="User profile picture">
                    </div>
                    <h2><?php echo htmlspecialchars($user['username'])?></h2>
                </section>
                <section class="user-posts">
                    <h2>User Posts</h2>
                    <?php if ($posts_result->num_rows > 0): ?>
                        <?php while ($post = $posts_result->fetch_assoc()): ?>
                            <div class="post">
                                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p><?php echo htmlspecialchars($post['content']); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No posts found for this user.</p>
                    <?php endif; ?>
                </section>
            </main>

            <?php include("footer.php"); ?>

        </body>

        </html>
    <?php else:?>
        <h1>User not found</h1>
    <?php endif;?>