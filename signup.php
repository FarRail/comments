<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="backend/style.css">
</head>

<body>
    <?php include_once "header.php";
    ?>

    <section class="Ielm">
        <h2>Sign up</h2>
        <form action="backend/signup.inv.php" method="post">
            <!-- placeholder is that invisible thing inside the textbox -->
            <input type="text" name="name" placeholder=" Enter Fullname"><br>
            <input type="text" name="email" placeholder=" Enter Email"><br>
            <input type="text" name="uname" placeholder=" Enter Username"><br>
            <input type="password" name="pwd" placeholder=" Enter Password"><br>
            <input type="password" name="pwdrepeat" placeholder=" Re-enter Password"><br>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </section>

    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<br>Fill everything up!!!!";
        }

        if ($_GET["error"] == "invalidemail") {
            echo "<br>Your email is invalid!";
        }

        if ($_GET["error"] == "passwordsdontmatch") {
            echo "<br>Your passwords don't match!";
        }

        if ($_GET["error"] == "usernametaken") {
            echo "<br>That username is taken!";
        }

        if ($_GET["error"] == "stmtfailed") {
            echo "<br>Something went wrong. please try again!";
        }

        if ($_GET["error"] == "none") {
            echo "<br>Success!";
        }
    }
    ?>
</body>

</html>