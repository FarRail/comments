<?php
// # isset() is like if something is set in the url and the data you wanna take is there, then its the proper method
// # header can send people back apparently. "location:" is where you set the place you want them to go back to. "../" is to go out of the current folder
// # require is basically a way to link the file to this one
if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uname"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    // # functions are going to be taken from the files below #
    require_once "dbh.inv.php";
    require_once "functions.inv.php";

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat) !== false){
        header("location: signup.php?error=emptyinput"); # the "?error=emptyinput" is basically to output why its an error to the signup page
        exit(); # this stops the script from running
    }

    if (invalidUname($username) !== false){
        header("location: ../signup.php?error=invaliduname"); 
        exit(); 
    }

    if (invalidEmail($email) !== false){
        header("location: ../signup.php?error=invalidemail"); 
        exit(); 
    }

    if (pwdMatch($pwd, $pwdrepeat) !== false){ # pwd is checked to see if it matches with pwdrepeat
        header("location: ../signup.php?error=passwordsdontmatch"); 
        exit(); 
    }

    if (uidExists($conn, $username, $email) !== false){ # connects to the database and check if the username is already used or not
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