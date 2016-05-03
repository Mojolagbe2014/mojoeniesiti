<?php 
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
connection ();


$art_id=$_POST['article_id'];
$reply=addslashes($_POST['reply']);
$comment_id = $_POST['commentID'];
$time=date("Y-m-d h:m:s");
 
$query_comment="insert into comment_reply(article_id,comment_id,subscriber_id,comment_time,reply) 
VALUES ('$art_id','$comment_id','{$_SESSION['user_id']}','$time','$reply')";

$result = mysql_query($query_comment) or die(mysql_error());
$id  = mysql_insert_id();
if($result){
	?>
 <?php 
 $query_Reply="select * from comment_reply,subscribers where ARTICLE_ID='".$_POST['article_id']."' and subscribers.subscriber_id=comment_reply.subscriber_id and reply_id = '$id' ";
				
				$resultReply=mysql_query($query_Reply) or die (mysql_error());
				
				$rowsReply=mysql_fetch_array($resultReply);?>
                
                <div class="replyFeeds" id="replyFeed-<?php echo $id;?>"><img src="<?php echo SITE_URL;?>images/avartar_comment.jpg" width="30" height="30" />
                  
                   <div class="replyBody">
                <p class="usercomment"><?php echo $rowsReply['username'];?></p>
                <?php echo $_POST['reply'];?>
                <span class="commentOptions"><?php if($rowsReply['subscriber_id'] == @$_SESSION['user_id'] ){?><a href="javascript:void(0);" onclick="DeleteReply(<?php echo $id;?>)">Delete</a><?php } ?></span>
                </div>
                </div>
      <?php
			
}
?>
