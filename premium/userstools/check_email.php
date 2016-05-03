<?php
session_start();

//Connect to database from here
require_once("../../scripts/config.php");
require_once("../../scripts/functions.php");
if(connection());

$result = MysqlSelectQuery("select * from user_login where email='".$_POST['user_email']."'");
$rows = SqlArrays($result);

$checkBizForEmail = MysqlSelectQuery("select email from businessinfo where email = '".$business['email']."'");
	$numBiz = NUM_ROWS($checkBizForEmail);

if((NUM_ROWS($result) != 0) && ($rows['user_id'] != $_SESSION['user_id'])){
	echo "no";
}
else if(($rows['user_id']!=$_SESSION['user_id']) && ($numBiz != 0)){
	echo "no";
}
//else if(NUM_ROWS($result) == 0){echo "yes";}
else{
	echo "yes";
}

?>