<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());
if(isset($_GET['fullarticle'])){
$result = MysqlSelectQuery("SELECT * FROM `articles` where article_id=".$_GET['fullarticle']);
if(NUM_ROWS($result) > 0){
$rows = SqlArrays($result);
//MysqlQuery("update uploads set no_down=no_down + 1 where id='".$_GET['file']."'");

header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"".stripslashes($rows['filename'])."\"");
		$file = file_get_contents("../articles-pdf/".stripslashes($rows['filename']));
		echo $file;
	}
}
?>