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
	 $image='<img src="'.SITE_URL.'images/nigerianseminars_logo.png" width="100" height="100" alt="alt="nigerian seminars article logo"  />';
	  $imgFB = 'images/nigerianseminars_logo.png';
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

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title><?php echo $rows['article_title'];?></title>
<meta name="description" content="<?php echo substr(strip_tags($rows['article_description']),0,130)."-".$rows['article_id'];?> - Nigerian Seminars and Trainings"/>
	<?php //echo SITE_URL;?>
	<!--<link rel="stylesheet" href="<?php //echo SITE_URL;?>style.css" type="text/css" media="screen" />-->
	<?php include("scripts/headers_new.php");?>
    
    <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
    
<script>
 // over lay pop up controler
$(document).ready(function() {	


		//capcha reloader
		function reloadCaptcha(){
					$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});

	//select all the a tag with name equal to modal
	$('.author').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		//$('#msgbox').fadeOut('slow');
		$('.window').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
	
	$("#formProvider").submit(function()
	{
		if($('#subject').val() == ''){
			alert("Please enter subject");
			
			return false;
		}
		if($('#name').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if ($('#email').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#comment').val() == ''){
			alert("Please enter your message");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass('alert-error alert-success').addClass('alert-info').html('Sending message....').show();
		//check the username exists or not from ajax
		$.post("<?php echo SITE_URL;?>tools/authors-mail.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your message has been sent!').removeClass('alert-info').addClass('alert-success').fadeTo(900,1);
			  $('#name').val("");
			  $('#email').val("");
			  $('#comment').val("");
			  $('#title').val("");
			  $('#phone').val("");
			  
			});
			//setInterval(function(){$('#contact-wrapper2').fadeOut('slow')},3000);
		  }
		  else if(data=='Security'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Invalid Security Code!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Error sending message!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	
	
});
    
 // over lay pop up controler
$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('.prompt').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#maskLog').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#maskLog').fadeIn(1000);	
		$('#maskLog').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window_currency .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//$('#msgbox').fadeOut('slow');
		$('#maskLog').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#maskLog').click(function () {
		$(this).fadeOut('slow');
		//$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#maskLog').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
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

.eventDetail .trainingProviders span li {
	margin-left: 5px;
	padding-left: 5px;
	list-style-position: inside;
}
.eventDetail .trainingProviders img{
	float:none;
}
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
  
.window {
  position:fixed;
  left:0;
  top:0;
  width:500px; 
  z-index:9999;
  padding:20px;
  display:none;
}
.window_currency {
  position:fixed;
  left:0;
  top:0;
  width:auto;
  z-index:9999;
  padding:20px;
  display:none;
}
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}
.form_content{
	background-color:#FFF;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	display: block;
	float: left;
}
-->
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
      
      <h2 style="font-size:22px; text-align:center;">
       <p> <?php echo $rows['article_title'];?></p>
        </h2>
      
     <br />
      
      <span class="event_provider">
      <a href="<?php echo SITE_URL;?>authorPage?id=<?php echo $rows['article_id'];?>">
        <p style="color:#FFF; color:#FFC;"> Author:&nbsp;&nbsp;<?php echo ucwords($rows['author']);?> </p>
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
               
                 <tr class="smart-forms">
                  <td colspan="2" align="left" >
                   <a href="<?php echo SITE_URL."author/".str_replace(" ","-",ucwords($rows['author']));?>" class="button btn-primary" style="font-size:12px; color:#FFF;"> More articles by <?php echo ucwords($rows['author']);?></a>
                  </td>
                  <td align="left" > <a href="#author-contact" class="button btn-primary author" style="font-size:12px; color:#FFF;">Contact Author</a></td>
                  <td width="30%" align="right">
                
                <?php  
                  if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
			$link = SITE_URL.'download_article/'.$rows['article_id'].'/'.stripslashes($rows['filename']);
			$name = '';
			$ArticleUrl = "";
			}
			else{
			$link = '#Login_pop';
			$name = 'prompt';
			$ArticleUrl = SITE_URL.'download_article/'.$rows['article_id'].'/'.$rows['filename'];
			}
            ?>
                  
                  <a href="<?php echo $link;?>" target="_blank"  class="button btn-primary <?php echo $name;?>" onClick="GetAction('<?php echo $ArticleUrl ;?>')" style="font-size:12px; color:#FFF;" >Download full article &nbsp;<img src="<?php echo SITE_URL;?>images/pdf-icon.png" width="20" height="20" style="vertical-align:middle;" alt="pdf icon"/></a>
                
                  </td>
                </tr>
                <tr>
                  <td colspan="4" align="left">
               
                    
                    
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
          
           <div id="mask"></div>      
    <div id="author-contact" style="float:left;" class="window boxContent"> 
    
    <form id="formProvider" name="form1" method="post" action="" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;">Contact <?php echo ucwords($rows['author']);?></strong>
                   
                    </div>
                    <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgbox">
                            
                                                              
                        </div>
<table class="contact_provider_table">
<tr>
 
<td width="85%">
   <label class="field">
                                    <input type="text" name="subject" id="subject" class="gui-input" placeholder="Subject" required >
                                </label>
</td></tr>
<tr>
 
<td>  <label class="field prepend-icon">
                                    <input type="text" name="name" id="name" class="gui-input" placeholder="Name" required>
                                    <label for="firstname" class="field-icon"><i class="fa fa-user"></i></label>  
                                </label></td></tr>
<tr>

<td><label class="field prepend-icon">
                                    <input type="email" name="email" id="email" class="gui-input" placeholder="Email" required>
                                    <label for="email" class="field-icon"><i class="fa fa-envelope"></i></label>  
                                </label>
</td></tr>
<tr>

  <td>  <label class="field prepend-icon">
                                    <input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone" type="number" required >
                                    <label for="mobile" class="field-icon"><i class="fa fa-phone-square"></i></label>  
                                </label></td>
</tr>

<tr>

  <td> <label class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="message" required ></textarea>
                            <label for="comment" class="field-icon"><i class="fa fa-comments"></i></label>
                            <span class="input-hint"> 
                            	<strong>Hint: </strong>Enter your enquiry / booking in this box. The training provider will contact you.</span>   
                        </label>
               </td>
</tr>
<tr>

  <td> <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
                            </label>
                            <label for="securitycode" class="button captcode">
                            	<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>
               </td>
</tr>
<tr>
  <td colspan="2" align="center" >
    <button class="button btn-primary" type="submit"> Send </button>
    <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',$rows['email']);?>" id="to" />
    <input name="course" type="hidden" value="<?php //echo $rows['event_title'];?>" id="course" /> <button class="button" type="button" id="closeBox"> Close </button></td>
  </tr>
</table> 
</form>
<div class="clearfix"></div>
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