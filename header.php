<link rel="stylesheet" href="backend/style.css">

<?php
session_start(); #because header is everywhere, you're now logged in everywhere in the website (if you are logged in)
?>
<section class="h">
    <?php
    if (isset($_SESSION["useruid"])) {
        echo '<div><a href="SQL.php"><p class="h">Main Page</p></a></div>';
        echo '<div><a href="comments.php"><p class="h">Comments</p></a></div>';
        echo '<div><a href="board.php"><p class="h">Comment board</p></a></div>';
        echo '<div><a href="backend/logout.inv.php"><p class="h">Log out</p></a></div>';
    } else {
        echo '<div><a href="login.php"><p class="h">Login</p></a></div>';
        echo '<div><a href="signup.php"><p class="h">Sign up</p></a></div>';
    }
    ?>
</section>