<?php
session_start();
require_once("config.php");
require_once("functions.php");
if(connection());
if(MysqlQuery("delete from events where event_id='".$_GET['delete']."'")){
	echo 1;
}
?>