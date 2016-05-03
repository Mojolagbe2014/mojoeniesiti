<?php
error_reporting(0);
#error_reporting(E_ALL ^ E_NOTICE);

$CONF = $TMPL = array();
$CONF['host'] = 'localhost';
$CONF['user'] = 'root';
$CONF['pass'] = '';
$CONF['name'] = 'weather';
$CONF['apikey'] = 'bdf64aee6975e85715301dd62b92dca4';
$CONF['url'] = 'http://localhost/nigerianseminars/weather_script'; #<-- Enter the Installation URL (e.g: http://example.com/folder);

$action = array('admin'			=> 'admin',
				'user'			=> 'user',
				'privacy'       => 'page',
				'disclaimer'	=> 'page',
				'contact'       => 'page',
				'tos'			=> 'page'
				);
?>