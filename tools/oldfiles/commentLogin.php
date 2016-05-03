<?php
session_start();
include("../scripts/config.php");
connection ();
        if(isset($_POST['email'])){
	$email=$_POST['email'];
$password=$_POST['password'];
$hashPassword = md5($password);

if($email && $password){

$query5="select * from subscribers where email='$email'";

$result=mysql_query($query5);

$num_rows=mysql_num_rows($result);
if($num_rows>0){
	
	$rows=mysql_fetch_array($result);
	if($rows['password'] == ''){
		$_SESSION['user_id']=$rows['subscriber_id'];
		$_SESSION['email']=$rows['email'];
		$_SESSION['fullname'] = $rows['fname']." ".$rows['lname'];
	echo "user exist";
	}
	else if(!empty($rows['password']) && $rows['password'] == $hashPassword){
 
	$_SESSION['email']=$rows['email'];
	$_SESSION['user_id']=$rows['subscriber_id'];
	$_SESSION['fullname'] = $rows['fname']." ".$rows['lname'];
	$_SESSION['username']=$rows['username'];
	
	
	
	echo "valid";
	}
	
	else{
		echo "invalid";
	}
	
	
}
		else{
			echo "invalid";
		}
	}
}
?>