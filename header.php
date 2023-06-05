<script src="header.js" defer></script>
<base href="/form/">
<link rel="stylesheet" href="header.css">

<header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="topic.php">Topics</a></li>
                <?php
                if (isset($_SESSION["username"])) {
                    echo "<li><a href='create_post.php'>Post</a></li>";
                    echo "<li><a href='profile.php'>{$_SESSION["username"]}</a></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";
                } else {
                    echo "<li><a href='#' id='loginBtn'>Login</a></li>";
                    echo "<li><a href='#' id='registerBtn'>Register</a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>
    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <iframe src="login.php"></iframe>
        </div>
    </div>

    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <iframe src="register.php"></iframe>
        </div>
    </div>