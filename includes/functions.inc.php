<?php
$result;

function emptyInputSignup($name, $email, $username, $password, $repeatedpassword) {
    
    if(empty($name) || empty($email) || empty($username) || empty($password) || empty($repeatedpassword)) { 
        $result = true;
    }
    else { 
        $result = false;
    }
    return $result;
}

function invalidUid($username) {


    if (preg_match ("/^[a-zA-Z0-9]^$/", $username)) { 
        $result = true;
    } 
    else { 
        $result = false;
    }
    return $result;
}

function invalidEmail($email) {
 
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
        $result = true;
    }
    else { 
        $result = false;
    }
    return $result;
}

function pwdmatch($password, $repeatedpassword) {
 
    if($password !== $repeatedpassword) { 
        $result = true;
    }
    else { 
        $result = false;
    }
    return $result;
}

function uidExcists($conn, $username, $email) {
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../loginpage.php?error=statementfailed");
        exit();
    }

    mysqli_stmt_bind_param($statement, "ss",$username, $email);
    mysqli_stmt_execute($statement);

    $resultdata = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultdata)) {
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}
function createUser($conn, $name, $email, $username, $password) {
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        header("location: ../loginpage.php?error=statementfailed");
        exit();
    }


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($statement, "ssss",$username, $email, $username, $hashedPassword);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    session_start();

    $uidExcists = uidExcists($conn, $username, $username);

    $_SESSION["userid"] = $uidExcists["usersId"];
    $_SESSION["useruid"] = $uidExcists["usersUid"];
    header("location: ../homepage.php");
} 

function emptyInputLogin($username, $password) {
    
    if(empty($username) || empty($password)) { 
        $result = true;
    }
    else { 
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password) {

    $uidExcists = uidExcists($conn, $username, $username);

    if ($uidExcists == false) {
        header("location: ../loginpage.php?error=wronglogin");
        exit();   
    }

    $passwordhashed = $uidExcists["usersPwd"];
    $checkpassword = password_verify($password, $passwordhashed);
    
    if ($checkpassword == false) {
        header("location: ../loginpage.php?error=wronglogin");
        exit();   
    }
    else if ($checkpassword == true) {
        session_start();
        $_SESSION["userid"] = $uidExcists["usersId"];
        $_SESSION["useruid"] = $uidExcists["usersUid"];
        header("location: ../homepage.php");
        exit();
    }
}