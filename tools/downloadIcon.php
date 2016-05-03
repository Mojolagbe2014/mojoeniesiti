<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());
if(isset($_GET['file'])){

$ext = substr(strrchr($_GET['file'], "."), 1);

header("Content-Type: icon/ico");
		header("Cache-Control: no-cache");
		header("Accept-Ranges: none");
		header("Content-Disposition: attachment; filename=\"".$_GET['file']."\"");
		$file = file_get_contents("../favicon/gen/".$_GET['file']);
		echo $file;
	}

?>