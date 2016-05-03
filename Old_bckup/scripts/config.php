<?php
define("DB_NAME","nst1_seminars");
define("USER","nst1_nigsemtra");
define("PASSWORD","Karobuto2013");
define("SERVER","localhost");
define("SITE_URL","http://www.nigerianseminarsandtrainings.com/");
if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
    {
        function undo_magic_quotes_gpc(&$array)
        {
            foreach($array as &$value)
            {
                if(is_array($value))
                {
                    undo_magic_quotes_gpc($value);
                }
                else
                {
                    $value = stripslashes($value);
                }
            }
        }
    
        undo_magic_quotes_gpc($_POST);
        undo_magic_quotes_gpc($_GET);
        undo_magic_quotes_gpc($_COOKIE);
    } 
function connection (){
	try{
	$sql_connection = mysql_connect(SERVER,USER,PASSWORD) or die (mysql_error()." Could not connect to the server");
	mysql_set_charset('utf8',$sql_connection);
	$db = mysql_select_db(DB_NAME) or die ("Unable to select database <br/>".mysql_error());
	if($sql_connection && $db){
		$response = true; }
		else {
			$response = false;
		}
	return $response;
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
}
?>