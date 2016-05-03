<?php
session_start();

//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());

if(isset($_POST['Acctype']) && $_POST['Acctype'] == 'Business'){
	//business query
$sql= MysqlSelectQuery("SELECT * FROM businessinfo WHERE email='".$_SESSION['email_add']."'");
$num_rows=NUM_ROWS($sql);
$rowsBiz =SqlArrays($sql);

	//generate password
			$randomPass = random(8);
			//encrypt password
			$hashedPassword = md5($randomPass);
			$result_new = MysqlInsertQuery("Insert into user_login (email,password) values ('".$rowsBiz['email']."','".$hashedPassword."')");
			$id = mysqli_insert_id($sql_connection);
			MysqlQuery("update businessinfo set user_id='".$id."' where email='".$rowsBiz['email']."'");
			//Prepare email
			$to = $rowsBiz['email'];
			$subject = 'Login Information';
			$message = '<span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Welcome!</span>
	  <br />
	  <p>Your password has been set, please find your login details below:</p>
	   <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Email</strong>: <em>'.$rowsBiz['email'].'</em></div>
	  
	  <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Password</strong>: <em>'.$randomPass.'</em></div>
	  <p><strong>NB:</strong> Please login with the information provided above to update your business information.</p>'
	  ;
	  // send the mail
	  SendNewsEmails($to,$subject,$message,"","");
	   echo "Regular Business Email Sent";
	   session_destroy();
}
if(isset($_POST['Acctype']) && $_POST['Acctype'] == 'Subscriber'){
	//subscribers query
	$sqlSubscribers=MysqlSelectQuery("SELECT * FROM subscribers WHERE email='".$_SESSION['email_add']."'");
	$num_rows_subscribers=NUM_ROWS($sqlSubscribers);
	$rows_subscribers =SqlArrays($sqlSubscribers);
	
	//generate password
			$randomPass = random(8);
			//encrypt password
			$hashedPassword = md5($randomPass);
			//update subscriber with generated password
			MysqlQuery("Update subscribers set password='".$hashedPassword."' where email='".$rows_subscribers['email']."'");
			//Prepare email
			$to = $rows_subscribers['email'];
			$subject = 'Login Information';
			$message = '<span style="font-family:Trebuchet MS, Verdana, Arial; font-size:17px; font-weight:bold;">Welcome!</span>
	 						 <br />
	  						<p>Your password has been set, please find your login details below:</p>
	   							<div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;				<strong>Email</strong>: <em>'.$rows_subscribers['email'].'</em></div>
	  
	  							<div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Password</strong>: <em>'.$randomPass.'</em></div>
	  						<p><strong>NB:</strong> Please login with the information provided above to update your business information.</p>'
	  ;
	 			 // send the mail
	  			SendNewsEmails($to,$subject,$message,"","");
				
	 		echo "Subscriber Email Sent";
			session_destroy();
}
?>