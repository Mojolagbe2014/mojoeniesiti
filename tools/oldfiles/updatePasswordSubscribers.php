<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
connection ();

$result = MysqlSelectQuery("select email from subcribers where email='".$_POST['email']."'");

if(NUM_ROWS($result) > 0){
	$password = md5($_POST['password']);
   if(MysqlQuery("update subcribers set password = '$password' where email ='".$_POST['email']."'")) echo 'done';
}

?>