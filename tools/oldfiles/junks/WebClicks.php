<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
if(connection());

$name = explode("-",$_POST['name']);
	$result = MysqlSelectQuery("select * from businessinfo where business_name like '%".$name[1]."%'");
	$rows = SqlArrays($result);
	if(MysqlQuery("update businessinfo set webClicks=webClicks+1 where business_id='".$rows['business_id']."'")){
	echo "yes";
	}

?>