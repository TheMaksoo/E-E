<?php

if(isset($_POST["reset-request-submit"])){


    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "http://192.168.178.206:8081/create-new-password.php?selector=". $selector . "&validator=" . bin2hex($token);
    
    $expires = date("U") + 1800;

    require_once 'dbh.inc.php';


    $userEmail = $_POST["email"];

    $sql1 = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql1)) {
        echo "There was an error1!";
        exit();
    }
    else { 
        mysqli_stmt_bind_param($statement, "s", $userEmail);
        mysqli_stmt_execute($statement);
    }

    $sql2 = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $sql2)) {
        echo "There was an error2!";
        exit();
    }
    else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT); 
        mysqli_stmt_bind_param($statement, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($statement);
    }

    mysqli_stmt_close($statement);
    mysqli_close($conn);

    $to = $userEmail;

    $subject = 'Your password reset for Earnings and Expenses';
    $message = '<p> We recieved a password reset request. Click on the link to reter your password. if you didnt make this request please ignore this email.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="'. $url . '">' . $url .'</a></p>';

    $headers = "From: Earnings and Expenses <EarningsandExpenses@gmail.com\r\n";
    $headers .= "Reply-To: EarningsandExpenses@gmail.com\r\n"; 
    $headers .= "Content-type: text/html\r\n";

    
    mail($to, $subject, $message ,$headers);

    header("location: ../reset-password.php?reset=succes");

}
else { 
    header("Location: ../loginpage.php");
}

