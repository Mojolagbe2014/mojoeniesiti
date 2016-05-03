<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(isset($_GET['status']) && $_GET['status']==true){
	session_destroy();
	header("location:".SITE_URL."login");
}
?>