<?php
error_reporting();
/*define("DB_NAME","nst1_seminars");
define("USER","nst1_nigsemtra");
define("PASSWORD","Karobuto2013");
define("SERVER","localhost");
define("SITE_URL","http://www.nigerianseminarsandtrainings.com/");*/
define("DB_NAME","nigerianseminars2");
define("USER","root");
define("PASSWORD","");
define("SERVER","localhost");

$protocol = 'http://';

if(isset($_SERVER['HTTPS'])) {$protocol = 'https://';}

define("SITE_URL",$protocol."localhost/nigerianseminars/");
//define("SITE_URL",$protocol."localhost/nigerianseminars/");
//open database connection
$sql_connection = new MySQLi(SERVER,USER,PASSWORD,DB_NAME);
// set the db character set
$sql_connection->set_charset("utf8");
//test for connection error
if($sql_connection -> connect_error){
		
		trigger_error('Database connection failed: '  . $sql_connection->connect_error, E_USER_ERROR);
		
}
		
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
		
	global $sql_connection;
	
	if($sql_connection -> connect_error){
		
		trigger_error('Database connection failed: '  . $sql_connection->connect_error, E_USER_ERROR);
		
		$response = false; 
		
		}
		else {
			
			$response = true;
		}
	return $response;
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	
}
?>