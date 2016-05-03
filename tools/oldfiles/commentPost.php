<?php 
session_start();
include("../scripts/config.php");
include("../scripts/functions.php");
connection ();


$art_id=$_POST['article_id'];
$comment=addslashes($_POST['comment']);
$time=date("Y-m-d h:m:s");
 
$query_comment="insert into comment(article_id,comment,subscriber_id,comment_time) 
VALUES ('$art_id','$comment','{$_SESSION['user_id']}','$time')";

$result = mysql_query($query_comment) or die(mysql_error());

if($result){
	
	
	?>
	 <?php $query_display="select * from comment,subscribers,articles where comment.article_id='".$_POST['article_id']."' and subscribers.subscriber_id=comment.subscriber_id and articles.article_id=comment.article_id order by comment_id desc ";
				
				$result=mysql_query($query_display) or die (mysql_error());
				$rows=mysql_fetch_array($result)
				
				?>
            
            
          <div class="commentBox" id="CommentFeed-<?php echo $rows['comment_id'];?>">
           <img src="<?php echo SITE_URL;?>images/avartar_comment.jpg" width="60" height="60" />
           <div class="commentBody">
           
              <p class="usercomment"><?php echo $rows['username'];?> <span>Posted: <?php echo time_ago($rows['comment_time']);?></span><span style="float:right;"><?php if($rows['subscriber_id'] == $_SESSION['user_id'] ){?><a href="javascript:void(0)" onclick="DeleteComment(<?php  echo $rows['comment_id'];?>)"><img src="<?php echo SITE_URL;?>images/close_icon.gif" width="12" height="13" alt="delete"/></a><?php } ?></span></p>
              
              <?php echo $rows['comment'];?>
              <span class="commentOptions"><a href="javascript:void()" onclick="ShowReplies(<?php  echo $rows['comment_id'];?>)">Replies (<?php echo CountReplies($rows['comment_id'],$rows['article_id']);?>) </a> &nbsp; | &nbsp; <a href="javascript:void()" onclick="ShowReplyBox(<?php  echo $rows['comment_id'];?>)">Reply comment</a></span>
              <div style="display:;" id="Replies-<?php echo $rows['comment_id'];?>">
            
                <?php $query_Reply="select * from comment_reply,subscribers where ARTICLE_ID='".$rows['article_id']."' and subscribers.subscriber_id=comment_reply.subscriber_id and comment_reply.comment_id='".$rows['comment_id']."' order by comment_id desc ";
				
				$resultReply=mysql_query($query_Reply) or die (mysql_error());
				
				while($rowsReply=mysql_fetch_array($resultReply)){?>
                <div class="replyFeeds" id="replyFeed-<?php echo $rowsReply['reply_id'];?>"><img src="<?php echo SITE_URL;?>images/avartar_comment.jpg" width="30" height="30" />
                  
                  <div class="replyBody">
                <p class="usercomment"><?php echo $rowsReply['username'];?></p>
                <?php echo $rowsReply['reply'];?>
                <span class="commentOptions"><?php if($rowsReply['subscriber_id'] == @$_SESSION['user_id'] ){?><a href="javascript:void(0);" onclick="DeleteReply(<?php echo $rowsReply['reply_id'];?>)">Delete</a><?php } ?></span>
                </div>
                </div>
                <?php } ?>
                <div id="appendReply<?php  echo $rows['comment_id'];?>" ></div> 
                </div> 
                <div>
               <form id="replycommentPostForm<?php  echo $rows['comment_id'];?>" action="" method="post" class="replyBox" >
                     <table width="100%" style="float:left" >
                       <tr>
                         <td width="8%" align="right"><img src="<?php echo SITE_URL;?>images/avartar_comment.jpg" width="40" height="40"  /></td>
                         <td width="92%" align="right"><textarea name="comment" cols="60"  id="replyMsg<?php echo $rows['comment_id'];?>" class="commentTextBoxSmall"></textarea></td>
                       </tr>
                       <tr><td><input name="articleID" id="articleID<?php  echo $rows['comment_id'];?>" type="hidden" value="<?php echo $rows['article_id'];?>" />
                       <input name="commentID" id="commentID<?php echo $rows['comment_id'];?>" type="hidden" value="<?php echo $rows['comment_id'];?>" />
                       </td><td align="right"> <?php 
 if(isset($_SESSION['email'])) $user_id=$_SESSION['email'];
 
  
  if(isset($user_id)){?>
                      <input  id="replyButton<?php echo $rows['comment_id'];?>" name="addcomment" type="button" value="Reply2" onclick="ReplyPost(<?php  echo $rows['comment_id'];?>)" />
                      
                      
                      <?php }
   
   else{?>
                      
                      <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><input  id="show" name="addcomment" type="button" value="Reply" /></a>
                      
 
  <?php }?></td></tr></table>
         </form>
         </div>
              </div>
              

          </div>
          <?php
		  
		  $to = 'info@nigerianseminarsandtrainings.com';
$subject = "New comment";
$Email_message .= "A new comment has just been posted for <br />"."<a href=".SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);" target="_blank">".$rows['article_title']."</a>";
$Email_message .= "<br />By: ".$rows['username']."<br /> Comment: ".$rows['comment'];

$headers = "From: Nigerian Seminars and Training <info@nigerianseminarsandtrainings.com> \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

	if(mail($to, $subject, $Email_message, $headers)) echo '';
	
}
?>