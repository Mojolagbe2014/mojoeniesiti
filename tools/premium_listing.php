<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");

if(isset($_POST['business_name'])){
	
	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode'])){
		echo 'security';
	}
	else{
	$result = MysqlQuery("insert into payment (business_name,contact_person,email,business_type, plan,teller_no,amount_deposited,date_posted,payment_type,payment_date) values('".$_POST['business_name']."','".$_POST['contact_person']."','".$_POST['email']."','".$_POST['type']."','".$_POST['plan']."','".$_POST['teller']."','".$_POST['deposited']."','".$_POST['date_deposit']."','Bank Deposit','".date("Y-m-d")."')");
	
	//query was successful
	if($result) 
	{	
		// Add Email Address
		$Email_message = '';
$to = 'info@nigerianseminarsandtrainings.com';
$subject = "Premium Listing Payment";
$Email_message .= "Business Name: (".$_POST['business_name'].")";
$Email_message .= "\n";
$Email_message .= "Contact Person: (".$_POST['contact_person'].")";
$Email_message .= "\n";
$Email_message .= "Email: (".$_POST['email'].")";
$Email_message .= "\n";
$Email_message .= "Amount: (".$_POST['deposited'].")";
$Email_message .= "\n";
$Email_message .= "Payment Date: (".$_POST['date_deposit'].")";
$Email_message .= "\n";
$headers = "From: Premium Listing <no_reply@nigerianseminarsandtrainings.com>";
	if(mail($to, $subject, $Email_message, $headers)) {
		echo 'correct';
			}	
		}
	}

}
?>