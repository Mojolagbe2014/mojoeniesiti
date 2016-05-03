<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
connection ();

$result = MysqlSelectQuery("select email from user_login where email='".$_POST['email']."'");

if(NUM_ROWS($result) > 0){
      $to = $_POST['email'];
$subject = "Password Reset for your premium account";
$Email_message .= "Please click on the link below to reset your password \n";
$Email_message .= "<a href='http://www.nigerianseminarsandtrainings.com/reset_password?user=".$_POST['email']."&path=email&token=".md5('email')."&type=reset&u=".md5('reset')."'>http://www.nigerianseminarsandtrainings.com/reset_password?user=".$_POST['email']."&path=email&token=".md5('email')."&type=reset&u=".md5('reset')."</a>";

$headers = "From: Nigerian Seminars and Training <info@nigerianseminarsandtrainings.com> \r\n";
$headers .= "Reply-To: info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

	if(mail($to, $subject, $Email_message, $headers)) echo "done";
}
else{
	echo "invalid";
}

?>