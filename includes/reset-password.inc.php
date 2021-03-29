<?php 

if(isset($_POST["reset-password-submit"])){

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["rpwd"];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../loginpage.php?newpwd=empty");
        exit();
    }
    else if ($password != $passwordRepeat) { 
        header("Location: ../loginpage.php?newpwd='pwdnotsame'");
        exit();
    }

    $currentDate = date("U");

    require 'dbh.inc.php';

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql)) {
        echo "There was an error!";
        exit();
    }
    else { 
        mysqli_stmt_bind_param($statement, "s", $selector);
        mysqli_stmt_execute($statement);
        
        $result = mysqli_stmt_get_result($statement);
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "You need to re-submit your reset request.";
            exit();
        }
        else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            }
            elseif ($tokenCheck === true) {
                
                $tokenEmail = $row['PwdResetEmail'];

                $sql = "SELECT * FROM users WHERE emailUsers=?;";

                $statement = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($statement, $sql)) {
                    echo "There was an error!";
                    exit();
                }
                else { 
                    mysqli_stmt_bind_param($statement, "s", $tokenEmail);
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);
                    if (!$row = mysqli_fetch_assoc($result)) {
                        echo "There an error!";
                        exit();
                    }
                    else {
                        $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?;";
                        $statement = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($statement, $sql)) {
                            echo "There was an error!";
                            exit();
                        }
                        else { 
                            $newpwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($statement, "ss",$newpwdHash, $tokenEmail );
                            mysqli_stmt_execute($statement);

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                            $statement = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($statement, $sql)) {
                                echo "There was an error!";
                                exit();
                            }
                            else { 
                                mysqli_stmt_bind_param($statement, "s", $tokenEmail);
                                mysqli_stmt_execute($statement);
                            }
                        }
                    }

                }

            }
        }
    }

}
else {
    header("location: ../loginpage.php");
    exit();
}