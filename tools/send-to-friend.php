<?php
session_start();
//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

$name = $_POST['sender_name'];

$email = $_POST['sender_email'];

$message = $_POST['message'];

$to =  $_POST['to'];

$subject = "Training Recommendation from :".$name;

$result = MysqlSelectQuery("select * from events where event_id = '".$_POST['eventID']."'");

$rows = SqlArrays($result);

//remove commas
$getReciepent = explode(",",$to);

	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode'])){
			echo 'Security';
		}
	else{
		foreach($getReciepent as $reciepient){
		// prepare email header
		$headers ="From: ".$name."<".$email."> \r\n";
		$headers .= "Reply-To: ".$email." \r\n";
		$headers .= "Cc:info@nigerianseminarsandtrainings.com \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
					'X-Mailer: PHP/' . phpversion();
		// prepare message
		$msg = '<p>Hello, your friend '.$name.' recommended a training for you</p>';
		$msg .=	'<p>Course Title: <strong>'.$rows['event_title'].'</strong></p>';
		$msg .=	'<p>Date: '.date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate'])).'</p>';
		$msg .=	'<p>Training Provider: '.$rows['organiser'].'</p>';
		$msg .=	'<p>Please <a href="#">click here</a> for more datail';
		   	$reciever = $reciepient;
			mail($reciever, $subject, $msg, $headers);
		}
		echo 'Sent';
	}

?>