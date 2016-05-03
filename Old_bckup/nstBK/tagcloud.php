<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$sql = MysqlSelectQuery("select tags from events where tags != '' order by rand() limit 0, 10 ");
$tags = '';
while($rows = SqlArrays($sql)){
	$tags .= $rows['tags'];
}
echo tags($tags,'testing');
