<?php
function emptyInputSignup($name, $email, $username, $pwd, $pwdrepeat){
    $result = null;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdrepeat)){
        $result = true;
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

function emptyInputComments($message){
    $result = null;
    if (empty($message)){
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
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdrepeat){
    $result = null;
    if ($pwd !== $pwdrepeat) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUname = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $username, $pwd){ 
    $sql = "INSERT INTO users (usersName, usersEmail, usersUname, usersPwd) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn); 
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();
}

function loginUser ($conn, $username, $pwd){
    $uidExists = uidExists($conn, $username, $username);

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
        session_start();
        $_SESSION["userid"] = $uidExists["usersID"];
        $_SESSION["useruid"] = $uidExists["usersUname"];
        header("location: ../SQL.php");
        exit();
    }
}

function setComments ($conn, $cuid, $date, $time, $message){ 
    $sql2 = "INSERT INTO comments (uid, date, time, message) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn); 
    if (!mysqli_stmt_prepare($stmt, $sql2)) {
        header("location: ../comments.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssss", $cuid, $date, $time, $message);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../board.php");
    exit();
}

function getComments($conn){
    $sql2 = "SELECT * FROM comments";
    $result = $conn->query($sql2);
    while ($row = $result->fetch_assoc()){
        echo '<div class="comms">';
            echo "<p class='user'>By ".$row['uid']."</p>";
            echo "<p class='comT'>".$row['date']." at ".$row['time']."</p><br>";
            echo $row['message'];
        echo "</div>";
    }
}
?>
