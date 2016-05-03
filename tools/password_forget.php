<?php
session_start();
//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());

//get the posted values
$user_name=htmlspecialchars($_POST['email'],ENT_QUOTES);

//business imfo query
$sql= MysqlSelectQuery("SELECT * FROM businessinfo WHERE email='".$user_name."'");
$num_rows=NUM_ROWS($sql);
$rowsBiz =SqlArrays($sql);

//subscribers query
	$sqlSubscribers=MysqlSelectQuery("SELECT * FROM subscribers WHERE email='".$user_name."'");
	$num_rows_subscribers=NUM_ROWS($sqlSubscribers);
	$rows_subscribers =SqlArrays($sqlSubscribers);
	
	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['security'])){
		echo 'Security';
	}
	else{

if($num_rows > 0){//checking if email exist in businessinfo table

	//checking if email exist in user_login table
	$sqlLogin = MysqlSelectQuery("SELECT * FROM user_login WHERE email='".$user_name."'");
	$num_rows_login=NUM_ROWS($sqlLogin);
	$rows_login=SqlArrays($sqlLogin);
	
	// email exist
	if($num_rows_login > 0){
		//generate password
			$randomPass = random(8);
			//encrypt password
			$hashedPassword = md5($randomPass);
			//update the password column with generated password
			MysqlQuery("update user_login set password ='".$hashedPassword."' where email='".$rowsBiz['email']."'");
		
		//Prepare email
			$to = $rowsBiz['email'];
			$subject = 'Password Reset';
			$message = '
	  <p>Your password has been reset, please find your new login details below:</p>
	   <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Email</strong>: <em>'.$rowsBiz['email'].'</em></div>
	  
	  <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Password</strong>: <em>'.$randomPass.'</em></div>
	  <p>Thank you.</p>
	   <p>Nigerian Seminars and Trainings Team.</p>
	  ';
	  // send the mail
	 SendNewsEmails($to,$subject,$message,"","");
	  
		echo "Sent";
		
		}// end email exist check
		
	else{
		
		//email not in user_login table, send an email with generated password and create a login record
		
		//generate password
			$randomPass = random(8);
			//encrypt password
			$hashedPassword = md5($randomPass);
			//insert a new login record
			$result = MysqlInsertQuery("Insert into user_login (email,password) values ('".$rowsBiz['email']."','".$hashedPassword."')");
			//retrieve the last inserted id
			$id = mysqli_insert_id($sql_connection);
			//update business info table with the new user id.
			MysqlInsertQuery("update businessinfo set user_id='".$id."' where email='".$rowsBiz['email']."'");
		//Prepare email
			$to = $rowsBiz['email'];
			$subject = 'Password Reset';
			$message = '
	  <p>Your password has been reset, please find your new login details below:</p>
	   <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Email</strong>: <em>'.$rowsBiz['email'].'</em></div>
	  
	  <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Password</strong>: <em>'.$randomPass.'</em></div>
	  <p>Thank you.</p>
	   <p>Nigerian Seminars and Trainings Team.</p>
	  ';
	  // send the mail
	SendNewsEmails($to,$subject,$message,"","");
		
	  echo "Sent";
		}
	
}
else if($num_rows_subscribers > 0){	//checking if email exist in subscribers table

	//send an email with generated password and update the password field.
		
		//generate password
			$randomPass = random(8);
			//encrypt password
			$hashedPassword = md5($randomPass);
			//update business info table with the new user id.
			MysqlQuery("update subscribers set password='".$hashedPassword."' where email='".$rows_subscribers['email']."'");
		//Prepare email
			$to = $rows_subscribers['email'];
			$subject = 'Password Reset';
			$message = '
	  <p>Your password has been reset, please find your new login details below:</p>
	   <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Email</strong>: <em>'.$rows_subscribers['email'].'</em></div>
	  
	  <div style="padding-left:20px; padding-bottom:10px;"><img src="'.SITE_URL.'images/spade.gif" alt=""/>&nbsp;&nbsp;&nbsp;<strong>Password</strong>: <em>'.$randomPass.'</em></div>
	  <p>Thank you.</p>
	   <p>Nigerian Seminars and Trainings Team.</p>
	  ';
	  // send the mail
	 SendNewsEmails($to,$subject,$message,"","");
		 echo "Sent";
	}//end email exist check
	else{
		echo "Not Found";
	}
}
?>