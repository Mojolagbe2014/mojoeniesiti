<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());
if(isset($_GET['guide'])){
$result = MysqlSelectQuery("SELECT * FROM `quarterly_guide` where name='".str_replace("-",' ',$_GET['guide'])."'");
if(NUM_ROWS($result) > 0){
$prefix = '_Conferences_and_Training_Guide.pdf';
$rows = SqlArrays($result);
$fileName = str_replace(" ","_",$rows['name']).$prefix;

header("Content-Type: application/pdf");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"".$fileName."\"");
		$file = file_get_contents("../QuarterlyGuide/".$fileName);
		echo $file;
	}
}
?>