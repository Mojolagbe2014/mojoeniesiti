<?php
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
if($_GET['url'] != ''){
$_SESSION['CurrentActionUrl'] = $_GET['url'];
}
?>