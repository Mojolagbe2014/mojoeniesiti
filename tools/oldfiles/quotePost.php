<?php



include("../scripts/config.php");
include("../scripts/functions.php");
connection ();





$quote=addslashes($_POST['quote']);
$time=date("Y-m-d ");
$authur=$_POST['authur'];
$year=$_POST['year'];

$status = "";
if($quote&&$time&&$authur&&$year){
 
$query_comment="insert into dailyquote(quote_id,quote,day_of_quote,authur,year,status) 
VALUES (null,'$quote','$time','$authur','$year','$status')";

$result = mysql_query($query_comment) or die(mysql_error());

echo'yes';

}

?>