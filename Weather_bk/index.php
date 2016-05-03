<?php
require_once('Weather/includes/config.php');
require_once('Weather/includes/skins.php');
require_once('Weather/includes/functions.php');

mysql_connect($conf['host'], $conf['user'], $conf['pass']);
mysql_query('SET NAMES utf8');
mysql_select_db($conf['name']);
	
if(isset($_GET['a']) && isset($action[$_GET['a']])) {
	$page_name = $action[$_GET['a']];
	} else {
	$page_name = 'welcome'; 
	}
require_once("Weather/sources/{$page_name}.php");

$TMPL['content'] = PageMain();

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) { 
	$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', 
	mysql_real_escape_string($_COOKIE['username']), 
	mysql_real_escape_string($_COOKIE['password']));
		if(mysql_fetch_row(mysql_query($query))) {
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

$resultSettings = mysql_fetch_row(mysql_query(getSettings($querySettings)));
$TMPL['footer'] = $resultSettings[0];

$skin = new skin('wrapper');
echo $skin->make();


?>