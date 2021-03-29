<?php 

if(isset($_POST["submit"])){
    
   
    $username = $_POST["uid"];
    $password = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $password) !== false) {
        header("location: ../loginpage.php?error=emptylogininput");
        exit();
    }

    loginUser($conn, $username, $password);
}
else {
    header("location: ../loginpage.php?error=none");
    exit();
}

