<?php
session_start();

//session_destroy();
require_once("scripts/config.php");
require_once("scripts/functions.php");

$id = "";
if(isset($_GET['fullarticle'])) $id = $_GET['fullarticle'];
if(connection());
	
	$result = MysqlSelectQuery("SELECT * FROM `articles` where article_id=".$_GET['fullarticle']);
	if(NUM_ROWS($result) == 0) {
            header("HTTP/1.0 404 Not Found");
            header("location:" .SITE_URL."404error");
        }
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
	//this gets the characters 0 to the period and stores it in $newFile
	$newFile = substr(trim($rows['article_title']), 0, 45);	
	$newFile = str_replace(" ", "000", $newFile);
	//Remove special Characters
	$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
	//Replace spaces with dash/hyphen
	$newFile = str_replace("000", "-", $newFile);
	$newFile = str_replace("--", "-", $newFile);
	//Covert d name to lowercase
	$newFile = strtolower($rows['article_id']."-".$newFile);//.".php"
	//Redirect to the new article file page
	header("HTTP/1.1 301 Moved Permanently");
	header("Location:".SITE_URL.'articlespg/'.$newFile);

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
<meta name="description" content="<?php echo substr(strip_tags($rows['article_description']),0,130)."-".$rows['article_id'];?> "/>
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
	$('.window_currency #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		//$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			
	$('.close button').click(function () {
		$('#mask').fadeOut('slow');
		//$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
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
.close {
	text-decoration:none; cursor:pointer; width:20px;
}
.close button { cursor:pointer; width:20px }
-->
</style>
	
</head>

<body>

 <?php include("tools/header_new.php");?>

 <div id="main">
    
    <div id="content">
    
  <?php include("tools/categories_new.php");?>
      <div id="content_left">
        <div id="sub_links">
        
       <div class="event_table_inner " style="margin-bottom:8px;">

<table style="width:100%;" >
  
  <tr>
    <td style="padding-left:8px; width:11%; text-align:center;">
      <div class="imageFloat"> <?php if($rows['articleImage']==""){?>
                      <img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.jpg" width="100"  height="100" alt="nigerian seminars article logo" class="articleImg shadow"/>
                      <?php ;}
					 
					 else{?>
                     <img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['articleImage'];?>" width="100"  height="100"  alt="nigerian seminars article logo" class="articleImg shadow"/>
                     <?php ;}?>
                     </div>
                     </td>
    <td style="text-align:center;">
      
      <h2 style="font-size:22px; text-align:center;">
       <?php echo $rows['article_title'];?>
        </h2>
      
     <br />
      
      <div class="event_provider">
      <a href="<?php echo SITE_URL;?>authorPage?id=<?php echo $rows['article_id'];?>" title="Authors Page">
        <p style="color:#000;"> Author:&nbsp;&nbsp;<?php echo ucwords($rows['author']);?> </p>
        </a>
      </div>
      <!--social media-->
      
      
      
      <!--end social media-->
    </td>
    </tr>
  </table>

<div class="clearfix"></div>
</div>

          <div id="contact-wrapper" class="rounded"> 
          
          
            <div class="video_box">
             
              <table  id="listTable">
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
                    <li><a href="http://www.nigerianseminarsandtrainings.com/add-event" target="_blank" title="Free course listing">Free course listing</a></li>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/upload-business-info.php" target="_blank" title="Free business listing">Free business listing</a></li>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/premium-listing.php" target="_blank" title="Premium course/business listing">Premium course/business listing (paid service)</a></li>
                    <li><a href="http://www.nigerianseminarsandtrainings.com/advertise.php" target="_blank" title="Banner advert placement">Banner advert placement (paid service)</a></li>
                    <li>Free training search - we help prospective trainees search for courses /training providers free.</li>
                    </ul><br />
                    <p>The nigerianseminarsandtraining.com&quot;Administrator&quot; is the profile for general support staff at  Nigerian Seminars and Trainings.</p>
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
                  <td style="text-align:left;">
                   <a href="<?php echo SITE_URL."author/".str_replace(" ","-",ucwords($rows['author']));?>" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;" title="More articles by <?php echo ucwords($rows['author']);?>" > More articles by <?php echo ucwords($rows['author']);?></a>
                  </td>
                  <td style="text-align:left;"> <a href="#author-contact" class="cssButton_roundedLow cssButton_aqua author" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;">Contact Author</a></td>
                  <td style="width:30%; text-align:right;">
                
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
                  
                  <a href="<?php echo $link;?>" target="_blank"  class="cssButton_roundedLow cssButton_aqua <?php echo $name;?>" onClick="GetAction('<?php echo $ArticleUrl ;?>')" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;" title="Download full article">Download full article &nbsp;<img src="<?php echo SITE_URL;?>images/pdf-icon.png" width="20" height="20" style="vertical-align:middle;" alt="pdf icon"/></a>
                
                  </td>
                </tr>
                <tr>
                  <td style="text-align:left;">
               
                  
  </td>
                </tr>
                
                
              </table>
              
              <div class="tags">

                      
                       <div> 
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
                       </div>
                      
</div>
              
               <div class="tags">

                      
                       <div> 
                       <p style="float:left; margin-right:8px;"><strong>Tags</strong></p> <?php echo tags($rows['tags'],'articletagsearch');?>
                        <div class="clearfix"></div>
                       </div>
                      
</div>
                  
                  </div>
<!--prompt for download-->
  <div id="Login_pop" style="float:left;" class="window_currency boxContent smart-forms">
      <div class="alert notification alert-error">
     	<a href=''  class="close"><button>X</button></a><br/>
        <p>You must be logged in to download this quarterly guide, 
        <a href="<?php echo SITE_URL.'login';?>" >Click here</a> to login. <br /> 
        Dont have an account? <a href="<?php echo SITE_URL.'biz-info';?>">Click here</a>
        to register as a business or <a href="<?php echo SITE_URL.'subscribers';?>">Click here</a> 
        to register as a subscriber</p>
       </div>
      <br />
      </div>
     <!-- end prompt-->
   <div class="respond">
  </div>
          </div>
          
           <div id="mask"></div>      
    <div id="author-contact" style="float:left;" class="window boxContent"> 
    <form id="formProvider" name="form1" method="post" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;">Contact <?php echo ucwords($rows['author']);?></strong>
                   
                    </div>
                    <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgbox">
                            
                                                              
                        </div>
<table class="contact_provider_table">
<tr>
 
<td style="width:85%;">
   <label class="field">
                                    <input type="text" name="subject" id="subject" class="gui-input" placeholder="Subject" required >
                                </label>
</td></tr>
<tr>
 
<td>  <label class="field prepend-icon">
                                    <input type="text" name="name" id="name" class="gui-input" placeholder="Name" required>
                                    <span class="field-icon"><i class="fa fa-user"></i></span>  
                                </label></td></tr>
<tr>

<td><label class="field prepend-icon">
                                    <input type="email" name="email" id="email" class="gui-input" placeholder="Email" required>
                                    <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                                </label>
</td></tr>
<tr>

  <td>  <label class="field prepend-icon">
                                    <input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone" type="number" required >
                                    <span class="field-icon"><i class="fa fa-phone-square"></i></span>  
                                </label></td>
</tr>

<tr>

  <td> <label class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="message" required ></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
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
                            <span class="button captcode">
                            	<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha anti-spam image">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </span>
                        </div>
               </td>
</tr>
<tr>
  <td style="text-align:center;" >
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