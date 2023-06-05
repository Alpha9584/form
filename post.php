<?php
        require 'db.php';
        $idp = isset($_GET['idp']) ? $_GET['idp'] : null;
        $sql = "SELECT * FROM posts WHERE idp = '$idp'";
        $comm = "SELECT * FROM posts WHERE under = '$idp'";
        $sql = $conn->query($sql);
        $comm = $conn->query($comm);
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Post Page</title>
        <base href="/form/">
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700|Roboto+Slab:400,700" rel="stylesheet">
        <link rel="stylesheet" href="post.css">
        <script src="post.js" defer></script>

    </head>
    <body>
        <?php require 'header.php';?>
        <main>
            <article class="post">
                <?php if ($sql->num_rows > 0):?>
                <?php $post = $sql->fetch_assoc();?>
                <?php 
                $user_profile_pic_sql = "SELECT profile_pic FROM accounts WHERE username = '{$post['username']}'";
                $user_profile_pic_result = $conn->query($user_profile_pic_sql);
                $user_profile_pic = "";
                if ($user_profile_pic_result->num_rows > 0) {
                    $user_profile_pic_data = $user_profile_pic_result->fetch_assoc();
                    $user_profile_pic = $user_profile_pic_data['profile_pic'];
                }
                ?>
            <div class="post-header">
                <div class="user-info">
                    <img src="<?php echo $user_profile_pic;?>" alt="Profile Picture" class="profile-pic">
                    <h2><?php echo "<a href='user/{$post['id']}' class='user-link'>".htmlspecialchars($post['username'])."</a>";?></h2>
                </div>
                <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                <p><?php echo htmlspecialchars($post['content']);?></p>
                <div class="buttons">
                    <button id="likeBtn" class="likeBtn">Like</button>
                    <button id="dislikeBtn" class="dislikeBtn">Dislike</button>
                </div>
            </div>
            </article>
            <section class="comments">
                <h2>Comments</h2>

            <?php if ($comm->num_rows > 0):?>
                <?php while ($comment = $comm->fetch_assoc()):?>
                <div class="comment">
                <?php
                $user_profile_pic_sql = "SELECT profile_pic FROM accounts WHERE username = '{$comment['username']}'";
                $user_profile_pic_result = $conn->query($user_profile_pic_sql);
                $user_profile_pic = "";
                if ($user_profile_pic_result->num_rows > 0) {
                    $user_profile_pic_data = $user_profile_pic_result->fetch_assoc();
                    $user_profile_pic = $user_profile_pic_data['profile_pic'];
                }
                ?>
                <div class="post-header">
                    <div class="user-info">
                        <img src="<?php echo $user_profile_pic;?>" alt="Profile Picture" class="profile-pic">
                        <h3><?php echo "<a href='user/{$comment['id']}' class='user-link'>".htmlspecialchars($comment['username'])."</a>";?></h3>
                    </div>
                    <p><?php echo htmlspecialchars($comment['content']);?></p>
                    <div class="buttons">
                        <button id="likeBtn" class="likeBtn">Like</button>
                        <button id="dislikeBtn" class="dislikeBtn">Dislike</button>
                    </div>
                </div>

                    <?php $reply_sql = "SELECT * FROM posts WHERE under = '{$comment['idp']}'";?>
                    <?php $reply_result = $conn->query($reply_sql);?>
                    <?php if ($reply_result->num_rows > 0):?>
                    <div class="replies">
                        <?php while ($single_reply = $reply_result->fetch_assoc()):?>
                        <div class="reply">
                            <?php
                            $user_profile_pic_sql = "SELECT profile_pic FROM accounts WHERE username = '{$single_reply['username']}'";
                            $user_profile_pic_result = $conn->query($user_profile_pic_sql);
                            $user_profile_pic = "";
                            if ($user_profile_pic_result->num_rows > 0) {
                                $user_profile_pic_data = $user_profile_pic_result->fetch_assoc();
                                $user_profile_pic = $user_profile_pic_data['profile_pic'];
                            }
                            ?>
                            <div class="post-header">
                                <div class="user-info">
                                    <img src="<?php echo $user_profile_pic;?>" alt="Profile Picture" class="profile-pic">
                                    <h3><?php echo "<a href='user/{$single_reply['id']}' class='user-link'>".htmlspecialchars($single_reply['username'])."</a>";?></h3>
                                </div>
                                <p><?php echo htmlspecialchars($single_reply['content']);?></p>
                                <div class="buttons">
                                    <button id="likeBtn" class="likeBtn">Like</button>
                                    <button id="dislikeBtn" class="dislikeBtn">Dislike</button>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;?>
                    </div>
                    <?php endif;?>
                    <section>
                        <?php if (isset($_SESSION["username"])): ?>
                        <?php
                            $username = $_SESSION["username"];
                            $sql = "SELECT * FROM accounts WHERE username = '$username'";
                            $sql = $conn->query($sql);
                            $sql = $sql->fetch_assoc();
                        ?>
                        <div class="reply-form-container">
                            <form action="submit_reply.php" method="post" class="reply-form">
                                <input type="hidden" name="original" value="<?php echo $idp; ?>">
                                <input type="hidden" name="post_id" value="<?php echo $comment['idp']; ?>">
                                <input type="hidden" name="username" value="<?php echo $sql['username']; ?>">
                                <input type="hidden" name="user_id" value="<?php echo $sql['id']; ?>">
                                <textarea name="reply" placeholder="Write your reply here..." required></textarea>
                                <button type="submit">Submit Reply</button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </section>
                </div>
            <?php endwhile;?>   
            <?php endif;?>
            <section>
            <?php if (isset($_SESSION["username"])): ?>
            <?php
                $username = $_SESSION["username"];
                $sql = "SELECT * FROM accounts WHERE username = '$username'";
                $sql = $conn->query($sql);
                $sql = $sql->fetch_assoc();
            ?>
            <div class="reply-form-container">
                <form action="submit_reply.php" method="post" class="reply-form">
                    <input type="hidden" name="post_id" value="<?php echo $idp; ?>">
                    <input type="hidden" name="username" value="<?php echo $sql['username']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $sql['id']; ?>">
                    <input type="hidden" name="original" value ="<?php echo $idp; ?>">
                    <textarea name="reply" placeholder="Write your reply here..." required></textarea>
                    <button type="submit">Submit Reply</button>
                </form>
            </div>
            <?php endif; ?>
            </section>
            <?php else:?>
            <p>Error 404 Post not found!</p>
            <?php endif;?>
        </main>

        <?php require 'footer.php';?>
    </body>
    </html>