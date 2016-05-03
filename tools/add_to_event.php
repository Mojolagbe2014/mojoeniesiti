<?php
session_start();
require("../scripts/config.php");
require("../scripts/functions.php");
if(isset($_SESSION['login_subcriber'])){
	$result = MysqlSelectQuery("select * from my_events where event_id={$_POST['event_id']} and subscriber_id = {$_SESSION['user_id']}");
	if((NUM_ROWS($result) == 0)){
		MysqlInsertQuery("insert into my_events (subscriber_id, event_id, date_added) values('{$_SESSION['user_id']}','{$_POST['event_id']}','".date('Y-m-d')."')");
		echo 'done';
	}
}
	else{
		echo "redirect";
}
?>