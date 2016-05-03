<?php
session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

if(isset($_POST['submit_login'])){
	if(($_POST['email'] == '') || ($_POST['password'] == '')){
		$_SESSION['login_msg'] = '<div class="alert notification alert-error spacer-b30" id="msgbox">Please enter your email or password</div>';
		header('location:'.SITE_URL.'login');
	}
	else{

//get the posted values
$user_name=htmlspecialchars($_POST['email'],ENT_QUOTES);
$pass=md5($_POST['password']);

$_SESSION['email_add'] = $user_name;

//business query
$sql= MysqlSelectQuery("SELECT * FROM businessinfo WHERE email='".$user_name."'");
$num_rows=NUM_ROWS($sql);
$rowsBiz =SqlArrays($sql);


//subscribers query
	$sqlSubscribers=MysqlSelectQuery("SELECT * FROM subscribers WHERE email='".$user_name."'");
	$num_rows_subscribers=NUM_ROWS($sqlSubscribers);
	$rows_subscribers =SqlArrays($sqlSubscribers);
	

if($num_rows > 0){//checking if email exist in businessinfo table

	//checking if email exist in user_login table
	$sqlLogin = MysqlSelectQuery("SELECT * FROM user_login WHERE email='".$user_name."'");
	$num_rows_login=NUM_ROWS($sqlLogin);
	$rows_login=SqlArrays($sqlLogin);
	
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
			
			$_SESSION['name'] = $rowsBiz['business_name'];
			$_SESSION['user_id']=$rowsBiz['user_id'];
			
			
		//check if the business is a premium business
			if($rowsBiz['premium'] > 1 && $rowsBiz['premium'] <= 3){
				//is premium, check for expiration
				if($rows_login['expire_status'] == 1 ){
					//account has expired
					$_SESSION['login_msg'] = '<div class="alert notification alert-error spacer-b30" id="msgbox">Sorry your premium account has expired</div>';
					$_SESSION['login_business'] = false;
					
					header('location:'.SITE_URL.'login');
						}
					else{
						$_SESSION['login_business'] = true;
						$_SESSION['premium'] = true;
						
						MysqlQuery("update user_login set last_login_date='".date('Y-m-d h:m:s')."' where email='".$user_name."'");
						
						header('location:'.SITE_URL.'premium/profile');
					}
			
			}// end premium check	
			
					else{//not premium business
					$_SESSION['login_business'] = true;
				header('location:'.SITE_URL.'business/profile');
					}
					
				
				}// end compare the passwords	
				else{
					$_SESSION['login_msg'] = '<div class="alert notification alert-error spacer-b30" id="msgbox">Invalid Login</div>';
					header('location:'.SITE_URL.'login');
				}
		}// end email exist check
		
		//email not in user_login table, so lets insert it.
		else{
			
	$_SESSION['login_msg'] =   '<div class="alert notification alert-info confirmation spacer-b30" id="msgbox"><p>This Account currently does not have a login password, would you like to generate a login password for this account? </p><span><a href="javascript:void(0)" onclick="BusinessEmail()">Yes</a> <a href="javascript:void(0)" style="background:#F00;" onclick="NoEmail()">No</a><div class=\'clear\'></div></span></div>';
	  header('location:'.SITE_URL.'login');
		}
	
}
else if($num_rows_subscribers > 0){	//checking if email exist in subscribers table
		//check if password is empty
		if(!empty($rows_subscribers['password'])){
			// password not empty compare
			if(strcmp($rows_subscribers['password'],$pass)==0){
			$_SESSION['login_subcriber'] = true;
			$_SESSION['name'] = $rows_subscribers['fname']." ".$rows_subscribers['lname'];
			$_SESSION['user_id']= $rows_subscribers['subscriber_id'];
			
				
				header('location:'.SITE_URL.'sub/profile');
				
			}//end password comparism
			else{
				$_SESSION['login_msg'] = '<div class="alert notification alert-error spacer-b30" id="msgbox">Invalid Login sub</div>';
				header('location:'.SITE_URL.'login');
			}
			
		}//end password is empty check
		else{		
	 		$_SESSION['login_msg'] =  '<div class="alert notification alert-info confirmation spacer-b30" id="msgbox"><p>This Account currently does not have a login password, would you like to generate a login password for this account? </p><span><a href="javascript:void(0)" onclick="SubscriberEmail()">Yes</a> <a href="javascript:void(0)" style="background:#F00;" onclick="NoEmail()">No</a><div class=\'clear\'></div></span></div>';
	  header('location:'.SITE_URL.'login');
			
		}
		
	}//end email exist check
	else{
		$_SESSION['login_msg'] =  '<div class="alert notification alert-info spacer-b30" id="msgbox"><div class="options"><p style="text-align:left; padding-left:5px;">This Account currently does not exist in out database, what will you like to do?</p><ul><li><a href="'.SITE_URL.'biz_info">Upload your business information ?</a></li><li><a href="'.SITE_URL.'premium-listing">Subscribe to our premium listing ?</a></li><li><a href="'.SITE_URL.'subscribers">Register as a subscriber ?</a></li></ul></div></div>';
	  header('location:'.SITE_URL.'login');
		}
	}
}
?>