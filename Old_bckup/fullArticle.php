<?php
session_start();

//session_destroy();
require_once("scripts/config.php");
require_once("scripts/functions.php");

$id = "";
if(isset($_GET['fullarticle'])) $id = $_GET['fullarticle'];
if(connection());
	
	$result = MysqlSelectQuery("SELECT * FROM `articles` where article_id=".$_GET['fullarticle']);
	if(NUM_ROWS($result) == 0) header("location:" .SITE_URL."404error");
	$rows = SqlArrays($result);
$advert = "Article";


?>





<?php 
 $image="";
 if($rows['articleImage']==""){
	 $image='<img src="'.SITE_URL.'images/nigerianseminars_logo.jpg" width="100" height="100" alt="alt="nigerian seminars article logo"  />';
	  $imgFB = 'images/nigerianseminars_logo.jpg';
	 }
 else{
	 
	  $image='<img src="'.SITE_URL.'nstlogin/articles_images/'.$rows['articleImage'].'" width="100" height="100" alt="nigerianseminarsand trainings />';
	  $imgFB = 'nstlogin/articles_images/'.$rows['articleImage'];
	 }
 
 ?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta property="og:image" content="<?php echo SITE_URL.$imgFB;?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="250"/>
<meta property="og:image:height" content="250"/>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23693392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL_S;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title><?php echo substr($rows['article_title'],0,69);?></title>
<meta name="description" content="<?php echo substr(strip_tags($rows['article_description']),0,130)."(Artid:".$rows['article_id'].")";?>"/>
	<?php //echo SITE_URL;?>
	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />
	<?php include("scripts/headers_new.php");?>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $("#show").click(function(){
    $("#wrappers").toggle( 'slow');
  });
  
 
});
</script>

<script>

$(document).ready(function(){
  $("#help").click(function(){
    $("#helpForm").toggle( 'slow');
  });
  
 
});

</script>
<style>
.shadow{
	-webkit-box-shadow: 0px 0px 2px 0px rgba(50, 50, 50, 0.57);
	-moz-box-shadow:    0px 0px 2px 0px rgba(50, 50, 50, 0.57);
	box-shadow:         0px 0px 2px 0px rgba(50, 50, 50, 0.57);
}
.articleImg{
	display:block;
	padding:3px;
	background-color:#F8F8F8;
}

</style>
	
</head>

<body>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->




<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-2fH5lI6K2ceJA"
});
</script>



<script>

 

</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast" alt=""/>
</div>
</noscript>
<!-- End Quantcast tag -->
 <?php include("tools/header_new.php");?>
 
 
 
  <div id="main">
    
    <div id="content">
    
  <?php include("tools/categories_new.php");?>
      <div id="content_left">
        <div id="sub_links">
        
       <div class="event_table_inner" style="margin-bottom:8px;">

<form action="" method="post">
<table width="100%" border="0">
  
  <tr>
    <td width="11%" align="center" style="padding-left:8px">
      <div class="imageFloat"> <?php if($rows['articleImage']==""){?>
                      <img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.jpg" width="100"  height="100" alt="nigerian seminars article logo" class="articleImg shadow"/>
                      <?php ;}
					 
					 else{?>
                     <img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['articleImage'];?>" width="100"  height="100"  alt="nigerian seminars article logo" class="articleImg shadow"/>
                     <?php ;}?>
                     </div>
                     </td>
    <td align="center">
      
      <h2 style="font-size:18px; text-align:center; color:#000;">
       <p> <?php echo $rows['article_title'];?></p>
        </h2>
      
      <span class="span_detail">Author:</span>
      
      <span class="event_provider">
      <a href="<?php echo SITE_URL;?>authorPage?id=<?php echo $rows['article_id'];?>">
        <strong><?php echo ucwords($rows['author']);?></strong>
        </a>
      
      <!--social media-->
      
      
      
      <!--end social media-->
    </td>
    </tr>
  </table>
</form>
<div class="clearfix"></div>
</div>

          <div id="contact-wrapper" class="rounded"> 
          
          
            <div class="video_box">
             
              <table width="100%" id="listTable">
              <tr>
                  <td colspan="4"><div class="description" style="font-size:13px; text-align:justify;"><?php echo stripslashes($rows['article_description']);?>
                  <br /><br />
                  <div>
                  <div class="articleaboutAuthor"><b>About the Author </b>- <span style="color:#000"><?php echo ucwords($rows['author']);?></span></div><br />
                  <div> 
            <div >
              <div style=" width:100%">
            <?php
            
            if($rows['author']=="nstloginistrator"){
            ?>
            <div>
            <p>Our service offerings include the following:</p><br />
                  <ul>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/add_event" target="_blank">Free course listing</a></li>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/biz_info" target="_blank">Free business listing</a></li>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/premium-listing.php" target="_blank">Premium course/business listing (paid service)</a></li>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/advertise.php" target="_blank">Banner advert placement (paid service)</a></li>
                    <li>Free training search - we help prospective trainees search for courses /training providers free.</li>
                    </ul><br />
                    <p>The nigerianseminarsandtraining.com&quot;Administrator&quot; is the profile for general
                  support staff
                  at  nigerianseminarsand training.</p>
                    </div>
           
            
            
            
            
            
            <?php ; }
			
			else{?>
           <div style=" text-align:justify;  font-size:12px"><?php echo $rows['author_detail'];?></div>
            
             
<?php ;} ?></div>
            </div>
          </div>
          </div>
                   <div > 
                  <br />
                  
                  </td>
                </tr>
               
                 <tr>
                  <td colspan="3" align="left">
                  
                  </td>
                  <td width="30%" align="right">
                  <span style="color:#090; font-size:11px">
                <?php  
                  if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
			$link = SITE_URL.'download_article/'.$rows['article_id'].'/'.$rows['filename'];
			$name = '';
			}
			else{
			$link = '#Login_pop';
			$name = 'name="prompt"';
			//$_SESSION['action_url'] = SITE_URL.'download_article/'.$rows['article_id'].'/'.$rows['filename'];
			}
            ?>
                  
                  <a href="<?php echo $link;?>" target="_blank" <?php echo $name;?> >Download full article &nbsp;<img src="<?php echo SITE_URL;?>images/pdf-icon.png" width="20" height="20" style="vertical-align:middle;" alt="pdf icon"/></a>
                  </span>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" align="left"><script type="text/javascript">
                      
                    
                      
				$(document).ready(function(){
					var fullname;
					
					$('#comment-login').submit(function(){
						$('#msgComment').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL;?>tools/commentLogin.php",{email:$('#email').val(),password:$('#password').val()} ,function(msg){
					if(msg == 'valid'){
						window.location = $('#url').val();
					}
					else if(msg == 'user exist'){
						$('#light').fadeOut("slow");
						$('#light_update').fadeIn("slow");
						$('#useremail').val($('#email').val());
						GetSubscriberName($('#email').val());
						
					}
					else{
						$('#msgComment').removeClass().addClass('error').text('Invalid login!');	
						//alert(msg);
						
					}
					
					});
						
						return false;
					})
				});
				function GetSubscriberName(Subemail){
					var result;
					$(document).ready(function(){
				$.post("<?php echo SITE_URL;?>tools/getSubName.php",{email:Subemail},function(msg){
						$('#fname').text(msg);	
						
						});						
				
					});
					
					
				}
				
				
				$(document).ready(function(){
					
					$('#comment_update').submit(function(){
						$('#msgCommentUpdate').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL;?>tools/commentUpdate.php",{username:$('#username').val(),password:$('#updatepassword').val(),email:$('#useremail').val()} ,function(msg){
					if(msg == 'yes'){
						window.location = $('#url').val();
					}
					else if(msg == 'invalid'){
						$('#msgCommentUpdate').removeClass().addClass('error').html('Error! username and password field cannot be empty!').show();
					}
					else{
						alert(msg);
					}
					
					
					});
						
						return false;
					})
				});
				
				$(document).ready(function(){
					
					$('#commentPostForm').submit(function(){
					var commentMsg = document.getElementById('commentMsg');
				if(commentMsg.value == ""){
						alert('Please enter a comment to post!');
						return false;
					}
						$('#msgCommentUpdate').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL;?>tools/commentPost.php",{comment:$('#commentMsg').val(),article_id:$('#articleID').val()} ,function(msg){
					$('.append').hide().prepend(msg).fadeIn(6000);
					//alert(msg);
					});
		
						
						return false;
					})
				});
				
	function ShowReplyBox(val){
    $("#replycommentPostForm"+val).toggle('slow');
	}
	
	function ShowReplies(val){
    $("#Replies-"+val).toggle('slow');
	}
	
	function ReplyPost(val){
		
		$(document).ready(function(){
					
	$.post("<?php echo SITE_URL;?>tools/replyPost.php",{reply:$('#replyMsg'+val).val(),article_id:$('#articleID'+val).val(),commentID:$('#commentID'+val).val()} ,function(msg){
																																													   					 $("#Replies-"+val).show('slow');
					$('#appendReply'+val).hide().append(msg).fadeIn(6000);
					$('#replyMsg'+val).val("");
					
					
					//alert(msg);
					});
				
				});
	}
	function DeleteReply(val){
		if(confirm("are you sure you want to delete this reply?")){
			
			$(document).ready(function(){
					
	$.post("<?php echo SITE_URL;?>tools/replyDelete.php?replyID="+val,function(msg){
				if(msg == 'yes'){
					$('#replyFeed-'+val).fadeOut("slow");
				}
					//alert(msg);
					});
				
				});
			
		}
	}
	
	function DeleteComment(val){
		if(confirm("are you sure you want to delete this Comment?")){
			
			$(document).ready(function(){
					
	$.post("<?php echo SITE_URL;?>tools/CommentDelete.php?commentID="+val,function(msg){
				if(msg == 'yes'){
					$('#CommentFeed-'+val).fadeOut("slow");
				}
				else{
					alert(msg);
				}
					
					});
				
				});
			
		}
	}

				</script> 
                <!--upade account form section--><!--end of update account form section-->
                    <div id="fade" class="black_overlay"></div>
                    
                    
  </td>
                </tr>
                
                
              </table>
              
              <div class="tags">

                      
                       <span> 
                       <p style="float:left; margin-right:8px;"><strong>Share this article: </strong></p> 
                       
                       <div style="float:left;"> 
                  <div class="fb-like" data-href="http://www.nigerianseminarsandtrainings.com/<?php echo 'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
                  
    <div class="fb-share-button" data-href="http://www.nigerianseminarsandtrainings.com/<?php echo 'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>

<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
 </div>
                       
                        <div class="clearfix"></div>
                       </span>
                      
</div>
              
               <div class="tags">

                      
                       <span> 
                       <p style="float:left; margin-right:8px;"><strong>Tags</strong></p> <?php echo tags($rows['tags'],'articletagsearch');?>
                        <div class="clearfix"></div>
                       </span>
                      
</div>
                  
                  </div>
  </div>
          </div>

          <!-- Begin BidVertiser code -->
            <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
  
        <div class="fb-comments" data-href="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" data-width="720px" data-numposts="5" data-colorscheme="light"></div>
       
       
          <div id="sub_links2_middle"><div id="sub_links2_middle"><!-- Begin BidVertiser code -->
           
  <div class="clearfix"></div>
  </div>
            <div id="sub_links">
            
  <!--<div class="divider"></div>-->
              <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
  <div class="clearfix"></div>
  </div>
          </div><!-- end subpage -->
        </div>	
      </div>
      
      <?php include("tools/side-menu_new.php");?>
    </div>
    
    <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
  </div>

<?php include ("tools/footer_new.php");?>
</body>
</html>