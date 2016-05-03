<?php
session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here
require_once("config.php");
require_once("functions.php");
if(connection());

//get the posted values
$user_name=htmlspecialchars($_POST['user_email'],ENT_QUOTES);
$pass=md5($_POST['password']);

//now validating the username and password
$sql="SELECT email, password,user_id FROM user_login WHERE email='".$user_name."' and password ='".$pass."'";
$result=mysql_query($sql);
$rows_login=mysql_fetch_array($result);

//if username exists
if(mysql_num_rows($result)>0)
{
	
	//compare the password
	if(strcmp($rows_login['password'],$pass)==0)
	{
		echo "yes";
		$sql2="SELECT business_name, business_id, premium, user_id, email FROM businessinfo WHERE user_id='".$rows_login['user_id']."'";
$result2=mysql_query($sql2);
$row=mysql_fetch_array($result2);

		switch($row['premium']){
			case 3:
			$_SESSION['space'] = 2;
			break;
			case 2:
			$_SESSION['space'] = 1;
			break;
		}
		//now set the session from here if needed
		$_SESSION['u_name']=$row['business_name']; 
		$_SESSION['biz_id']=$row['user_id']; 
		$_SESSION['biz_email']=$row['email']; 
		$_SESSION['loggedin'] = 1;
	}
	else
		echo "no"; 
}
else
	echo "no"; //Invalid Login


?>