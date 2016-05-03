<?php 
session_start();
include("../scripts/config.php");

connection();
	
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	$hashPassword = md5($password);
	
	
if( $username != '' && $password !=''){


$update_query="update subscribers set username='$username' , password='$hashPassword' where email='".$_POST['email']."'";

$result=mysql_query($update_query) or die(mysql_error());

echo'yes';

}
	
	else{
		echo 'invalid';
	}
	



	
	










?>