<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
if(connection());
$id = explode("-",$_POST['id']);
$result = MysqlSelectQuery("select * from adverthits where AdvertID='".$id[1]."' and date_hit='".date("Y-m-d")."'");
if(NUM_ROWS($result) > 0){
	MysqlQuery("update adverthits set hits = hits+1 where AdvertID='".$id[1]."' and date_hit='".date("Y-m-d")."'");
	echo "Yes";
}
else{
	MysqlQuery("insert into adverthits(AdvertID,hits,date_hit) VALUES ('".$id[1]."','1','".date("Y-m-d")."')");
	echo "Yes";
}
?>