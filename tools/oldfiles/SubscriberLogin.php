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

//now validating the username and password
$sql="SELECT * FROM subscribers WHERE email='".$user_name."' and password ='".$pass."'";
$result=mysql_query($sql);
$rows_login=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	
	//compare the password
	if(strcmp($rows_login['password'],$pass)==0)
	{
		echo "yes";
		

		
		//now set the session from here if needed
		$_SESSION['email']=$rows_login['email'];
	$_SESSION['user_id']=$rows_login['subscriber_id'];
	$_SESSION['fullname'] = $rows_login['fname']." ".$rows_login['lname'];
	$_SESSION['username']=$rows_login['username'];
	
	}
	else
		echo "no"; 
}
else
	echo "no"; //Invalid Login


?>