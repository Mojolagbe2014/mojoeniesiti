<?php
//error_reporting(0);
#error_reporting(E_ALL ^ E_NOTICE);

$conf = $TMPL = array();
$conf['host'] = 'localhost';
$conf['user'] = 'nst1_nigsemtra';
$conf['pass'] = 'Karobuto2013';
$conf['name'] = 'nst1_seminars';

$action = array('admin'			=> 'admin',
				'user'			=> 'user',
				'privacy'       => 'page',
				'disclaimer'	=> 'page',
				'contact'       => 'page',
				'tos'			=> 'page'
				);
				
/* if(get_magic_quotes_gpc()) {
	function strips($v) {return is_array($v)?array_map('strips',$v):stripslashes($v);}
	$_GET = strips($_GET);
} */
?>