<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

$id = "";

if(isset($_GET['id'])) 
	$id = $_GET['id'];
else if (isset($_GET['detail']))
	$id = $_GET['detail'];
else{
	header("HTTP/1.1 301 Moved Permanently");

	header( "location: ".SITE_URL );
}
	
	       
$url ="";

//if(connection()){
	
	 
	CatchViews($id);
	
	$result = MysqlSelectQuery("select * from events where event_id = '$id' ");
	
	$rows = SqlArrays($result);

	if(NUM_ROWS($result) == 0 || $rows['status'] == 0){
		
	 header("location: ".SITE_URL."all-event" , true, 301);
		exit();
	 }
	 
	
	$cost = $rows['cost'];
	$phone = $rows['phone'];
	
	$truePattern = '/events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);
	$RecievedPattern = $_SERVER['REQUEST_URI'];
	$redir = 'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);
	
	//compare the two urls
	if(strcmp($truePattern,$RecievedPattern) !== 0){
		
	header("HTTP/1.1 301 Moved Permanently");
	
	header("location: ".SITE_URL.$redir);
	
	}
	// if the url is a get variable redirect to the re-written
	else if(isset($_GET['id'])){
		
		header("HTTP/1.1 301 Moved Permanently");
	
		header("location: ".SITE_URL.$redir);
	}

	 $business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".addslashes($rows['organiser'])."%' and premium >= 2");
	$biz_name = SqlArrays($business);
	if($biz_name['logos'] == '') $logo = ''; else $logo = '<img src="'.SITE_URL.'premium/logos/thumbs/'.$biz_name['logos'].'" alt="business logo" width="70" height="70" class="articleImg shadow"/>';
	$number = NUM_ROWS($result);
	$url = $rows['website'];

	 $cat =  MysqlSelectQuery("select * from categories where category_id = '".$rows['category']."'");

	 $rows_cat = SqlArrays($cat);
	 

//}

function GetPhone(){
	global $phone;
	return $phone;
}

function GetPrice(){
	global $cost;
	return $cost;
}

$advert = "Event Detail";

if (!strstr($url, "http://") == $url) {$url ="http://".$rows['website']; }


$description = substr(strip_tags(stripslashes(str_replace('"',"'",$rows['description']))),0,130)."-".$rows['event_id'];;

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php if(($number > 0 )&& ($rows['status'] == 1)) echo $rows['event_title']." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!';?></title>

<meta name="description" content="<?php if(($number > 0 )&& ($rows['status'] == 1)) echo substr(strip_tags(stripslashes(str_replace('"',"'",$rows['description']))),0,130)." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!'; ?>"/>


<meta name="dcterms.description" content="<?php if(($number > 0 )&& ($rows['status'] == 1)) echo substr(strip_tags(stripslashes(str_replace('"',"'",$rows['description']))),0,130)." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!'; ?>" />

<meta property="og:title" content="<?php if(($number > 0 )&& ($rows['status'] == 1)) echo $rows['event_title']." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!';?>" />

<meta property="og:description" content="<?php if(($number > 0 )&& ($rows['status'] == 1)) echo substr(strip_tags(stripslashes(str_replace('"',"'",$rows['description']))),0,130)." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!'; ?>" />

<meta property="twitter:title" content="<?php if(($number > 0 )&& ($rows['status'] == 1)) echo $rows['event_title']." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!';?>" />

<meta property="twitter:description" content="<?php if(($number > 0 )&& ($rows['status'] == 1)) echo substr(strip_tags(stripslashes(str_replace('"',"'",$rows['description']))),0,130)." -".$rows['event_id']; else echo 'Training has not been activated or has been removed!'; ?>" />
    
	<!--<link rel="stylesheet" href="<?php //echo SITE_URL;?>style.css" type="text/css" media="screen" />-->
    
   <!--<link rel="stylesheet" type="text/css"  href="<?php //echo SITE_URL;?>css/all-css.css" />-->


	<?php include("scripts/headers_new.php");?>
	    
<?php include('tools/analytics.php');?>


<style type="text/css">
<!--
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
  width:200px;
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
.innerHeadingProp{
	color:#FFC;
	padding-left:100px;
}
.innerHeadingProp p{
	font-size:16px;
	float:left;
	margin-left:10px;
}
.subscribe_notification {
	padding: 10px;
	height: 200px;
	width:500px;
	background-color: #FFF;
	float: left;
	display: none;
	background-image: url(<?php echo SITE_URL;?>images/school.png);
	background-repeat: repeat;
}
.subscribe_notification span {
	
	padding: 5px;
	font-size: 24px;
	text-align: center;
	float: left;
	text-shadow: 1px 1px 1px rgba(150, 150, 150, 1);
}
.subscribe_notification span img {
	vertical-align: middle;
	padding-right: 5px;
	float: left;
}
-->
</style>
</head>

<body>

<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



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


<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<?php include("tools/header_new.php");?>

<?php //include("tools/search_box.php");?>

 <div id="main">
    

	<div id="content">
    <?php include("tools/categories_new.php");?>

		<div id="content_left">

<?php
if(($number > 0 )&& ($rows['status'] == 1)){
	?>
				<div class="sub_links vevent">
               
<div class="event_table_inner">
<form action="" method="post">
<table width="100%" border="0" class="smart-forms" style="padding:9px;">
  
  <tr>
    <td width="13%" align="left" style="padding-left:8px">
      <?php echo $logo;?>     </td>
    <td width="87%" align="center" ><h2 style="font-size:25px; text-align:center; margin-bottom:8px;"><p class="summary"><?php echo $rows['event_title'];?></p></h2>
     <br />
     <div class="innerHeadingProp">
     <p class="duration"><?php echo dateDiff($rows['startDate'], $rows['endDate']);?> &nbsp;&nbsp; | &nbsp;&nbsp; </p>
                       
                
                       <p ><?php echo date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate']));?> &nbsp;&nbsp; | &nbsp;&nbsp; </p>
                         <span style="display:none;" class="dtstart" content="<?php echo date('Y-m-d h:m:s',strtotime($rows['startDate']));?>"><?php echo date('M d',strtotime($rows['startDate']));?></span>
                         
                      
                       
                       <p class="location"><?php echo GetEventLocation($rows['event_id']);?></p>
                       </div>
   
    </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="text-align:center;" >
    <br />
    <div class="respond">
    <a href="#contact-wrapper2" name="modal" class="button" style="font-size:12px;">Book Now</a>
    </div></td>
  </tr>
  </table>
</form>
</div>





 
                <div class="eventDetail">
                 <div class="trainingProviders">
                <p ><strong>Provider:</strong></p>
                  <div class="respond">
                       <span style="font-weight:bold;"><?php echo $rows['organiser'];?>
					 </span>
                       </div> 
					 
                       </div>
                       
                <div class="trainingProviders">
                <p><strong>Attendance Fee:</strong></p>
                  <div class="respond">
                       <span style="height:auto;"> <?php echo $rows['cost']?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#currency" name="currency" style="text-align:center; font-size:10px;">(Convert Currency)</a>
					 </span>
                       </div> 
					 
                       </div>
				
                       <div class="trainingProviders" style="margin-right:0px; padding-right:0px;">
                 <p ><strong>Venue:</strong></p>
                       <span itemprop="location" ><?php echo $rows['venue']?></span>
                       </div>
                        <div class="trainingProviders">
                       <p ><strong>Event Description:</strong></p>
                       <span itemprop="description"><?php 
					   $str = stripslashes($rows['description']);
					   echo preg_replace('/<iframe.*?\/iframe>/i','', $str);?></span>
                      
</div> 
<?php if(!empty($rows['facilitator'])){?>
<div class="trainingProviders">
                       <p ><strong>Facilitator(s):</strong></p>
                       <span itemprop="performer" ><?php echo $rows['facilitator'];?></span>
                      
</div>
<?php } ?>
<?php if( $rows['videoID'] != ''){;?>
                <div class="respond">
<div class="trainingProviders">
                       <p ><strong>Watch Video Preview:</strong></p>
                       <span><center><iframe style="margin-top:10px" class="youtube-player" type="text/html" width="640" height="385" src="http://www.youtube.com/embed/<?php echo $rows['videoID'];?>" frameborder="0">
</iframe></center></span>
                      
</div>
 </div>
					   <?php
		}
	?>
<div class="infoBox" style="width:100%">
                 <?php
				 if($rows['premium'] == 1){
				 ?>
                 <div class="respond">
                       <div class="innerHeading smart-forms" style="font-size:12px; width:23.0216%;">
                     
                        <a id="Phone_btn" onclick="showPhone()" class="button btn-primary" style="font-size:12px; ">Click to call Provider</a></div>
                        </div>
                        <?php
				 }
				 ?>
                 
                 <div class="respond">
                        <div class="innerHeading smart-forms" style=" margin-top:8px; margin-right:0px; width:18.705%;">
                <?php if($rows['website'] != ''){
					?>
                <a href="<?php echo $url;?>" target="_blank" class="button" rel="nofollow" onclick="trackOutboundLink('<?php echo $url ;?>')" style="font-size:12px;">Visit Website</a>
				<?php }
				?>
                </div>
                
                </div>
                <div class="respond">
                
                <div class="innerHeading smart-forms" style=" margin-top:8px; margin-left:20px; width:28.0576%;">
                <?php if(($rows['premium'] > 0) && ($rows['premium'] !=8) && ($rows['user_id'] != 0)){ if($rows['website'] != ''){?>
                
                <a href="<?php echo SITE_URL;?>courses/business/<?php echo $biz_name['business_id'].'-'.str_replace($title_link,"-",$rows['organiser']);?>" target="_blank" class="button" style="font-size:12px;">More courses from provider</a>
                
				<?php }}?>
                </div>
                </div>
                <div class="respond">
                
            <div class="innerHeading smart-forms" style="float:right; margin-right:0px; margin-top:8px; width:19.4245%;">
                        <a href="#contact-wrapper2" name="modal" class="button btn-primary" style="font-size:12px;">Contact Provider</a></div>
                        </div>
                        <div class="reveal_res">
            <div class="innerHeading smart-forms">
                        <a href="#contact-wrapper2" name="modal" class="button btn-primary" style="font-size:12px;">Contact Provider</a></div>
                        </div>
</div>


                       <div class="clearfix"></div>
                       </div>
                       <div class="respond">
                       <div class="tags">

                      
                       <span> 
                       <p style="float:left; margin-right:8px;"><strong>Share this event: </strong></p> 
                       
                       <div style="float:left;"> 
                  <div class="fb-like" data-href="<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
                  
    <div class="fb-share-button" data-href="<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>" data-type="button_count"></div>
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
</div>
                       <?php if(!empty($rows['tags'])){?>
                       <div class="respond">
<div class="tags">
                       <span>
                         <p style="float:left; margin-right:8px; margin-bottom:0px;"><strong>Tags:</strong></p>
					   <?php echo tags($rows['tags'],'all-event-tag-search');?>
                        <div class="clearfix"></div>
                       </span>
                      
</div>
</div>
 
<?php 

} ?>



    </div>
    <?php
	}
	else{
	?>
     <h4 style="font-size:20px; color:#F30;">Sorry! The training you requested has not been activated or no longer exists</h4>
     <?php
	}
	?>
    
      <div id="mask"></div>
    <div id="currency" style="float:left;" class="window_currency boxContent">
       <div id="currency-widget"></div>
      </div>
      
    <div id="contact-wrapper2" style="float:left;" class="window boxContent"> 
    
    <form id="formProvider" name="form1" method="post" action="" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;">Contact Training Provider</strong>
                   
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

  <td>  <label class="field">
                                    <input type="text" name="address" id="address" class="gui-input" placeholder="Address">
                                    
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
    <input name="course" type="hidden" value="<?php echo $rows['event_title'];?>" id="course" /> <button class="button" id="closeBox"> Close </button></td>
  </tr>
</table> 
</form>


<div class="subscribe_notification boxContent smart-forms" id="subscribe" >
<span><img src="<?php echo SITE_URL;?>images/contact.png" width="90" height="98">Want to stay up-to-date with news & updates from Nigerian Seminars and Trainings?<br /><br />
 <a href="<?php echo SITE_URL;?>subscribers" class="button btn-primary" style="font-size:12px;">Subscribe Here!</a>
 <br />
 <a href="#" style="font-size:11px;" onClick="javascript:CloseSub();">close</a>
</span>


</div>

<div class="clearfix"></div>


</div>
			<div class="respond">
                    
                     <div class="sub_links2_middle">

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
 
 <br />

</div>
</div>


      <!-- end subpage -->

		<div class="clearfix"></div>			

		</div>
        
		

	    <?php include("tools/side-menu_new.php");?>
	</div>	
     <div class="clearfix"></div>
</div>
    <div class="clearfix"></div>
</div>


<?php include ("tools/footer_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.currency.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.currency.localization.en_US.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#currency-widget').currency();
});
</script>

<script>

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
	$('a[name=modal]').click(function(e) {
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
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
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
	
	
	$('a[name=currency]').click(function(e) {
      		//Cancel the link behavior
		e.preventDefault();
		$('#price').text('<?php echo GetPrice();?>')
		$('#price_container').show();
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
	$('.currency-footer #closeBoxCurr').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
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

function Close(){
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
}

function showPhone(){
	var Phone = document.getElementById('Phone_btn');
	Phone.style.backgroundColor='white';
	Phone.style.color='black';
	Phone.innerHTML = '<?php if(GetPhone() != '') echo GetPhone(); else echo 'NIL';?>';
}

	$(document).ready(function()
{
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
		$.post("<?php echo SITE_URL;?>tools/send.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),address:$('#address').val(),title:$('#course').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
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
			  $('#address').val("");
			   $('#securitycode').val("");
			   $('#subject').val("");
			   
			});
			setInterval(function(){$('#formProvider').fadeOut('slow', function(){
			$('#subscribe').fadeIn('slow');
			})},1000);
			
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
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
});
function CloseSub(){
	$('#mask').fadeOut('slow');
	$('#contact-wrapper2').fadeOut('slow');
}
</script>
</body>


</html>