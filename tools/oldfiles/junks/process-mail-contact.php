<?php 
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

if(isset($_POST['contactname'])){
$name = $_POST['contactname'];
$email = $_POST['email'];
$comments = $_POST['comment'];
$phone = $_POST['phone'];
$company = $_POST['company'];

$errors = array();

if(!smcf_validate_email($email)){echo "email issue";}
else if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode'])){echo "security code";}
else{
// Add Email Address
$to = 'info@nigerianseminarsandtrainings.com';
$subject = "New message from: $name";
$Email_message = "$name ($email) \n";
$Email_message .= "company: ($company)";
$Email_message .= "\n";
$Email_message .= "Phone: ($phone)";
$Email_message .= "\n";
$Email_message .= "Email: ($email)";
$Email_message .= "\n";
$Email_message .= "$comments";
$Email_message .= "\n";
$headers = "From: no_reply <no_reply@nigerianseminarsandtrainings.com>";
	if(mail($to, $subject, $Email_message, $headers)) echo "success";
	}	
}
?>