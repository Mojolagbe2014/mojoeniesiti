<?php
session_start();
//  Developed by Roshan Bhattarai 
//  Visit http://roshanbh.com.np for this script and more.
//  This notice MUST stay intact for legal use

//Connect to database from here
require_once("config.php");
require_once("functions.php");
if(connection());

$result = MysqlSelectQuery("select * from user_login where email='".$_POST['user_email']."'");
$rows = SqlArrays($result);
if((NUM_ROWS($result) == 1)&& ($rows['user_id'] == $_SESSION['biz_id'])){
	echo "yes";
}
else if(NUM_ROWS($result) == 0){echo "yes";}
else{
	echo "no";
}

?>