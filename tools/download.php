<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());
if(isset($_GET['id'])){
$result = MysqlSelectQuery("select * from newsletters where news_art_ID = '".$_GET['id']."'");
if(NUM_ROWS($result) > 0){
$rows = SqlArrays($result);
//MysqlQuery("update uploads set no_down=no_down + 1 where id='".$_GET['file']."'");

header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"".$rows['file']."\"");
		$file = file_get_contents("../e-books/".$rows['file']);
		echo $file;
	}
}
?>