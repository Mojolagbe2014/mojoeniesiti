<?php
require_once('weather_script/includes/config.php');
require_once('weather_script/includes/skins.php');
require_once('weather_script/includes/functions.php');

$db = @mysqli_connect($CONF['host'], $CONF['user'], $CONF['pass'], $CONF['name']);
mysqli_query($db, 'SET NAMES utf8');

if(!$db) {	
	echo "Failed to connect to MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error();
}
	
if(isset($_GET['a']) && isset($action[$_GET['a']])) {
	$page_name = $action[$_GET['a']];
} else {
	$page_name = 'welcome'; 
}
require_once("weather_script/sources/{$page_name}.php");

$TMPL['content'] = PageMain();

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) { 
	$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', 
	mysqli_real_escape_string($db, $_COOKIE['username']), 
	mysqli_real_escape_string($db, $_COOKIE['password']));
		if(mysqli_fetch_row(mysqli_query($db, $query))) {
		$TMPL['userStatus'] =  'My Account';
		$TMPL['welcomeStatus'] = 'Hello <strong>'.$_COOKIE['username'].'</strong>';
		} else {
		$TMPL['userStatus'] = 'Log In / Register';
		$TMPL['welcomeStatus'] = 'Hello <strong>Visitor</strong>.';
		}
	} else { 
	$TMPL['userStatus'] = 'Log In &nbsp; Register';
	$TMPL['welcomeStatus'] = 'Hello <strong>Visitor</strong>.';
}

$resultSettings = mysqli_fetch_row(mysqli_query($db, getSettings($querySettings)));
$TMPL['footer'] = $resultSettings[0];
$TMPL['url'] = $CONF['url'];
$TMPL['year'] = date('Y');

$skin = new skin('wrapper');
echo $skin->make();

mysqli_close($db);
?>