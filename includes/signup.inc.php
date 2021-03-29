<?php
if(isset($_POST["submit"])){

    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["uid"];
    $password = $_POST["pwd"];
    $repeatedpassword = $_POST["rpwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $password, $repeatedpassword) !== false) {
        header("location: ../loginpage.php?error=emptyinput");
        exit();
    }
    if (invalidUid($username) !== false) {
        header("location: ../loginpage.php?error=emptyuid");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("location: ../loginpage.php?error=emptyemail");
        exit();
    }  
    if (pwdmatch($password, $repeatedpassword) !== false) {
        header("location: ../loginpage.php?error=emptypasswordsdontmatch");
        exit();
    }
    if (uidExcists($conn, $username, $email) !== false) {
        header("location: ../loginpage.php?error=usernametaken");
        exit();
    }
    
    createUser($conn, $name, $email, $username, $password);
    
}
else {
    header("Location: ../homepage.php");
}
