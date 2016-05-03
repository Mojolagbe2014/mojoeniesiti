<?php
session_start();
if(!isset($_SESSION['SESSION'])) require( "../scripts/sessions.php");
require("../scripts/config.php");
require("../scripts/functions.php");
if(connection());
$result = MysqlSelectQuery("select email from subscribers where email='".$_POST['email']."'");
if(NUM_ROWS($result) > 0){
	echo '<span style="color:#F00"><img src="images/adminicons/delete.png" width="24" height="23" style="vertical-align:middle" /> This email already exists!</span>';
}
else{
   echo '<img src="images/adminicons/sucicon2.png" width="24" height="23" />';
}
?>