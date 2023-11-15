<link rel="stylesheet" href="backend/style.css">
<?php 
    include_once "header.php";
?>

<section class="Ielm">
    <h2>log in</h2>
    <form action="backend/login.inv.php" method="post">
        <input type="text" name="uname" placeholder=" Enter Username/Email"><br>
        <input type="password" name="pwd" placeholder=" Enter Password"><br>
        <button type="submit" name="submit">Login</button>
    </form>
</section>

<?php
if (isset($_GET["error"])){
    if ($_GET["error"] == "emptyinput") {
    echo "<br>Fill everything up!!!!";
    }
    if($_GET["error"] == "wronglogin") {
        echo "<br>Your input was is invalid! Try again.";
    }
}
?>