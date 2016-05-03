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

$_SESSION['email_add'] = $user_name;
$_SESSION['email'] = $user_name;
//business query
$sql= MysqlSelectQuery("SELECT * FROM businessinfo WHERE email='".$user_name."'");
$num_rows=NUM_ROWS($sql);
$rowsBiz =SqlArrays($sql);


//subscribers query
$sqlSubscribers=MysqlSelectQuery("SELECT * FROM subscribers WHERE email='".$user_name."' AND confirm = 1");
$unconfirmedUser =MysqlSelectQuery("SELECT * FROM subscribers WHERE email='".$user_name."'");
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
	if($rowsBiz['status'] == 0){
		echo 'Inactive';
	}else{
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
					echo 'Account Expired';
					$_SESSION['login_business'] = false;
						}
					else{
						$_SESSION['login_business'] = true;
						$_SESSION['premium'] = true;
						MysqlQuery("update user_login set last_login_date='".date('Y-m-d h:m:s')."' where email='".$_POST['user_email']."'");
						echo "Premium Login";
					}
			
			}// end premium check	
			
					else{//not premium business
					$_SESSION['login_business'] = true;
				echo "Regular Business";
					}
					
				
				}// end compare the passwords	
				else{
					echo "Invalid Login";
				}
			}
			else{
	 		 echo "Regular Business Email Sent";
			}
		}// end email exist check
		
		//email not in user_login table, so lets insert it.
}
else if($num_rows_subscribers > 0){	//checking if email exist in subscribers table
    if(!empty($rows_subscribers['password'])){//check if password is empty
        // password not empty compare
        if(strcmp($rows_subscribers['password'],$pass)==0){
            $_SESSION['login_subcriber'] = true;
            $_SESSION['name'] = $rows_subscribers['fname']." ".$rows_subscribers['lname'];
            $_SESSION['user_id']= $rows_subscribers['subscriber_id'];
            //add selected event to calendar
            if(!empty($_POST['addToCal'])){
                //decode encoded get val
                $event = base64_decode($_POST['addToCal']);
                // query the db
                $result = MysqlSelectQuery("select * from my_events where event_id='".$event."' and subscriber_id = {$_SESSION['user_id']}");
                if((NUM_ROWS($result) == 0)){
                    MysqlInsertQuery("insert into my_events (subscriber_id, event_id, date_added) values('{$_SESSION['user_id']}','".$event."','".date('Y-m-d')."')");
                }
            }

            echo "Subscriber Login";
        }
        else{ echo "Invalid Login"; }//end password comparism

    }
    else{ echo "Subscriber Email Sent"; }//end password is empty check

}//end email exist check
elseif(NUM_ROWS($unconfirmedUser) >0){ echo 'Unconfirmed User';}
else{ echo "Not Found"; }