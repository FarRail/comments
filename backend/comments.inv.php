<?php
if (isset($_POST["comSubmit"])) {
    session_start();
    $cuid = $_SESSION['useruid'];
    $date = date("j, F Y");
    $time = date("H:i:s");
    $message = $_POST['message'];

    require_once "dbh.inv.php";
    require_once "functions.inv.php";

    if (emptyInputComments($message) !== false) {
        header("location: ../comments.php?error=emptyinput");
        exit();
    }

    setComments($conn, $cuid, $date, $time, $message);
    
} else {
    header("location: comments.php");
    exit();
}
