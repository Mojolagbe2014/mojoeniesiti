<?php 
include("../scripts/config.php");

connection();
	
if(isset($_GET['replyID'])){


$update_query="delete from comment_reply where reply_id='".$_GET['replyID']."'";

$result=mysql_query($update_query) or die(mysql_error());

echo'yes';

}
	



	
	










?>