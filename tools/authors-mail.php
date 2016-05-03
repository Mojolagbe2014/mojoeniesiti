<?php
session_start();
//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

if(connection());
$course = "";
$title = $_POST['subject'];

$name = $_POST['name'];

$email = $_POST['email'];

$phone=$_POST['phone'];


$message = $_POST['message'];

$to_email =  str_replace('&#64;','@',$_POST['to']);

// Add Email Address
$headers ="From: ".$name."<".$email."> \r\n";
$headers .= "Reply-To: ".$email." \r\n";
$headers .= "Cc:info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

if($_SESSION['smartCheck']['securitycode']!= md5($_POST['security'])){
		echo 'Security';
	}
	else{



$to = $to_email;
$subject = $title;
$msg = $course." Name: ".$name."<br>"."Email: ".$email."<br />"."Phone: ".$phone."<br />".$message.'<br /><br /><br />You are receiving this message courtesy of <a href="http://www.nigerianseminarsandtrainings.com">Nigerian Seminars and Trainings.com</a><br>
<br>Our service offerings:<br><ul><li><a href="http://www.nigerianseminarsandtrainings.com/add_event">Free course listing</a></li>
           <li> <a href="http://www.nigerianseminarsandtrainings.com/biz_info">Free business listing</a></li>
		   <li><a href="http://www.nigerianseminarsandtrainings.com/premium-listing">Premium course/business listing</a> (paid service)</li>
		   <li><a href="http://www.nigerianseminarsandtrainings.com/advertise">Banner advert placement</a> (paid service)</li>
		   <li>Free training search - we help prospective trainees search for courses / training providers free.</li></ul>
		   <br><p>Take advantage of any of our free or paid services. You’d be glad you did!<br>
		   For enquiries, please contact:<a href="mailto:admin@nigerianseminarsandtrainings.com">admin@nigerianseminarsandtrainings.com</a></p>';

	if(mail($to, $subject, $msg, $headers)){
		echo "yes";
	}
	else{
		echo "no";
	}

	}

?>