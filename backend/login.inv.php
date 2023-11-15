<?php
if (isset($_POST["submit"])){
    $username = $_POST["uname"];
    $pwd = $_POST["pwd"];

    require_once "dbh.inv.php";
    require_once "functions.inv.php";

    if (emptyInputLogin($username, $pwd) !== false){
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
    header("location: ../SQL.php");
    exit();
}

else {
    header("location: ../login.php");
    exit();
}
?>
