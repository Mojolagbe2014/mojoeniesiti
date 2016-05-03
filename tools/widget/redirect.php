<?php
session_start();
require("../../scripts/config.php");
require("../../scripts/functions.php");
if(isset($_POST['submit'])){
	$joinMonth = $_POST['month']." ".$_POST['year'];
	 $buildQuery = 'category='.$_POST['category'].'&month='.$joinMonth.'&provider=&country='.$_POST['country'].'&state='.$_POST['state'];
	 header("location: ../../search?".$buildQuery);
}

?>
