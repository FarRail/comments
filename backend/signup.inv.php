<?php
if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uname"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once "dbh.inv.php";
    require_once "functions.inv.php";

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidUname($username) !== false){
        header("location: ../signup.php?error=invaliduname"); 
        exit(); 
    }

    if (invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail"); 
        exit(); 
    }

    if (pwdMatch($pwd, $pwdrepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch"); 
        exit(); 
    }

    if (uidExists($conn, $username, $email) !== false){
        header("location: ../signup.php?error=credentialstaken"); 
        exit(); 
    }
    
    createUser($conn, $name, $email, $username, $pwd);
}
else {
    header("location: ../signup.php");
    exit();
}
?>
