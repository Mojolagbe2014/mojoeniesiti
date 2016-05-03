<?php 
include("../scripts/config.php");

connection();
	
if(isset($_GET['commentID'])){


$update_query="delete from comment where comment_id='".$_GET['commentID']."'";

$result=mysql_query($update_query) or die(mysql_error());
if($result){
$reply_query="delete from comment_reply where comment_id='".$_GET['commentID']."'";

mysql_query($reply_query) or die(mysql_error());

echo'yes';

}
}
	



	
	










?>