<?php
session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());

//get the posted values
$user_name=htmlspecialchars($_POST['user_email'],ENT_QUOTES);
$pass=md5($_POST['password']);

//checking if email exist in businessinfo table
$sql= MysqlSelectQuery("SELECT email,premium FROM businessinfo WHERE email='".$user_name."'");
$num_rows=mysql_num_rows($sql);
$rowsBiz =mysql_fetch_array($sql);

if($num_rows > 0){
	//checking if email exist in user_login table
	$sqlLogin = MysqlSelectQuery("SELECT email, password FROM user_login WHERE email='".$user_name."'");
	$num_rows_login=mysql_num_rows($sqlLogin);
	$rows_login=mysql_fetch_array($sqlLogin);
	
	 //add two weeks grace to expiration date
	$dateExp =  strtotime($rows_login['exp_date']."+ 2weeks");
	$expirationDate = date("Y-m-d", $dateExp);
	//expire this account once the grace period is over
	/*if(date('Y-m-d') > $expirationDate){
		MysqlQuery("update user_login set expire_status = 1 WHERE user_id ='".$rows_login['user_id']."'");
			}*/
	// email exist
	if($num_rows_login > 0){
		//compare the passwords
		if(strcmp($rows_login['password'],$pass)==0){
		//check if the business is a premium business
			if($rowsBiz['premium'] > 1 && $rowsBiz['premium'] <= 3){
				//is premium, check for expiration
				if($rows_login['expire_status'] == 1 ){
					//account has expired
					echo 'Account Expired';
						}
					else{
						echo "Premium Login";
					}
			
			}// end premium check	
			
					else{//not premium business
				echo "Regular Business";
					}
					
				
				}// end compare the passwords	
				else{
					echo "Invalid Login";
				}
		}// end email exist check
		
		//email not in user_login table, so lets insert it.
		else{
			//generate password
			$randomPass = random(8);
			//encrypt password
			$hashedPassword = md5($randomPass);
			MysqlQuery("Insert into user_login (email,password) values ('".$rowsBiz['email']."','".$hashedPassword."')");
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
	  //Email($to,$subject,$message);
	  echo "Regular Business Email Sent";
		}
	
}


else {
	//checking if email exist in subscribers table
	$sqlSubscribers=MysqlSelectQuery("SELECT * FROM subscribers WHERE email='".$user_name."'");
	$num_rows_subscribers=mysql_num_rows($sqlSubscribers);
	$rows_subscribers =mysql_fetch_array($sqlSubscribers);
	//email exist
	if($num_rows_subscribers > 0){
		//check if password is empty
		if(!empty($rows_subscribers['password'])){
			// password not empty compare
			if(strcmp($rows_subscribers['password'],$pass)==0){
				
				echo "Subscriber Login";
				
			}//end password comparism
			else{
				echo "Invalid Login";
			}
			
		}//end password is empty check
		else{
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
	  			//Email($to,$subject,$message);
				
	 		echo "Subscriber Email Sent";
			
		}
		
	}//end email exist check
}
?>