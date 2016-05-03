<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
if(connection());
$id = explode("-",$_POST['id']);
$result = MysqlSelectQuery("select * from advertimp where AdvertID='".$id[1]."' and date_Imp='".date("Y-m-d")."'");
if(NUM_ROWS($result) > 0){
	MysqlQuery("update advertimp set Imp = Imp+1 where AdvertID='".$id[1]."' and date_Imp='".date("Y-m-d")."'");
	echo "Yes";
}
else{
	MysqlQuery("insert into advertimp(AdvertID,Imp,date_Imp) VALUES ('".$id[1]."','1','".date("Y-m-d")."')");
	echo "Yes";
}
?>