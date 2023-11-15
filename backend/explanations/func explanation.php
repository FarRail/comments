<?php
function emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat){
     # this returns the TRUE or FALSE statement
    $result = null;
    if (empty($name) || empty($email) ||empty($username) ||empty($pwd) ||empty($pwdrepeat)){ # "||" is the same as"or"
        $result = true; # true means something is empty
    }
    else {
        $result = false;
    }
    return $result;
}

function emptyInputLogin($username, $pwd){
    $result = null;
    if (empty($username) || empty($pwd)){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUname ($username){
    $result = null;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result = null;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { ## both filters are built in functions to check if the emails inputted are valid or not
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdrepeat){
    $result = null;
    if ($pwd !== $pwdrepeat) { ## both filters are built in functions to check if the emails inputted are valid or not
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function unameExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUname = ? OR usersEmail = ?;"; #its asking for either the username OR the email
    $stmt = mysqli_stmt_init($conn); #init is initialization
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    #param is parameters and you put prepared statement, what data you're submitting (s is string and for every string you type s), put the values you need
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);

    #everything we're getting for the server is from $stmt as our prepared statement
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)) { #assoc means that its gonna associate the name and data there as an array
        return $row; #its gonna get returned as a name in the array that uses the name of the column in the db
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd){ 
    $sql = "INSERT INTO users (usersName, usersEmail, usersUname, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn); #init is initialization
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    #this function is to make sure if a hacker were to get the pw, php will change it again to make it more secure
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();
}

function loginUser ($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username); #because its just asking for one value which is the username or email, just add one of them and it'll all be good (because of the previous code in uidExists)

    if ($uidExists == false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    elseif ($checkPwd === true){
        session_start(); #session is information we can grab onto from anywhere in the website so long as its running
        $_SESSION["userid"] = $uidExists["usersID"];
        $_SESSION["useruid"] = $uidExists["usersUname"];
        header("location: ../login.php");
        exit();
    }
}
?>