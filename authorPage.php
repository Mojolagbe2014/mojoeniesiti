<?php
session_start(); require_once("scripts/config.php"); require_once("scripts/functions.php");
$id = $_GET['id']; if(connection());
$result = MysqlSelectQuery("SELECT * FROM `articles` where article_id=".$_GET['id']);
if(NUM_ROWS($result) == 0) header("location:" .SITE_URL."404error"); $rows = SqlArrays($result); $advert = "Article";
$thisAuthor = ucwords($rows['author']);
if($thisAuthor == "GTC") { $thisAuthor = "Global Training Consulting (GTC)"; }
$title = trimStringToFullWord(60, stripslashes(strip_tags("Author $id: ".$rows['author']." - Nigerian Seminars and Trainings")));
$meta = trimStringToFullWord(150, stripslashes(strip_tags("This article was contributed / posted by ".$thisAuthor." - $id")));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta; ?>" />
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta; ?>" />
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

</script>
<style> .shadow{-webkit-box-shadow:0 0 2px 0 rgba(50,50,50,0.57);-moz-box-shadow:0 0 2px 0 rgba(50,50,50,0.57);box-shadow:0 0 2px 0 rgba(50,50,50,0.57)}.articleImg{display:block;padding:3px;background-color:#f8f8f8}.eventDetail .trainingProviders span li{margin-left:5px;padding-left:5px;list-style-position:inside}.eventDetail .trainingProviders img{float:none}#mask{position:absolute;left:0;top:0;z-index:9000;background-color:#000;display:none}.window{position:fixed;left:0;top:0;width:500px;z-index:9999;padding:20px;display:none}.window_currency{position:fixed;left:0;top:0;width:200px;z-index:9999;padding:20px;display:none}.boxContent{-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px;background-color:#666;padding:8px}.form_content{background-color:#FFF;-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px;display:block;float:left} </style>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div id="sub_links">
<div class="event_table_inner" style="margin-bottom:8px;">
<table>
<tr>
<td style="padding-left:8px; width:11%; text-align:center;">
<div class="imageFloat"> <?php if($rows['image']==""){?>
<img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.jpg" width="100"  height="100" alt="nigerian seminars article logo" class="articleImg shadow"/>
<?php ;} else{?>
<img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['image'];?>" width="100"  height="100"  alt="nigerian seminars article logo" class="articleImg shadow"/>
<?php } ?>
</div>
</td>
<td style="text-align:center;">
<div class="event_provider">
<p style="font-size:28px;"><?php echo ucwords($rows['author']);?></p>
</div>
</td>
</tr>
</table>
<div class="clearfix"></div>
</div>
<div id="contact-wrapper" class="rounded"> 
<div class="video_box" style=" min-height:300px"><div style="margin:10px">
<?php if($rows['author']=="administrator"){ ?>
<img src="<?php echo SITE_URL;?>images/avartar_comment.jpg/<?php echo $rows['image'];?>" width="60" height="60" alt="nigerianseminarsand training.com" />
<table style="font-size:13px" >
<tr>
<td style="width:169%; vertical-align:top;"  rowspan="3"><img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.jpg" width="105" height="100" alt="nigerianseminarsand training.com" /></td>
<td style="font-size:16px; font-weight:bold; color:#666; padding-bottom:2px"></td>
</tr>
<tr>
<td style="padding-bottom:10px; font-size:18px; font-weight:bold">Administrator</td>
</tr>
<tr>
<td style=" text-align:justify"><p>Our service offerings include the following:</p><br />
<ul>
<li><a href="http://www.nigerianseminarsandtrainings.com/add_event" target="_blank">Free course listing</a></li>
<li><a href="http://www.nigerianseminarsandtrainings.com/biz_info" target="_blank">Free business listing</a></li>
<li><a href="http://www.nigerianseminarsandtrainings.com/premium-listing.php" target="_blank">Premium course/business listing (paid service)</a></li>
<li><a href="http://www.nigerianseminarsandtrainings.com/advertise.php" target="_blank">Banner advert placement (paid service)</a></li>
<li>Free training search - we help prospective trainees search for courses /<br /> training providers free.</li>
</ul></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>The nigerianseminarsand training.com&quot;Administrator&quot; is the profile for general<br /> support staff at  nigerianseminarsand training.</td>
</tr>
</table>
<?php ; } else{?>
<table style="font-size:13px">
<tr>
<td colspan="2" style="vertical-align:top;">&nbsp;</td>
</tr>
<tr>
<td colspan="2" style="vertical-align:top;"><div class="description" style="font-size:13px; text-align:justify;"><?php echo $rows['author_detail'];?></div></td>
</tr>
<tr class="smart-forms">
<td style="width:49%;" >  <a href="<?php echo SITE_URL."author/".str_replace(" ","-",ucwords($rows['author']));?>" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;"> More articles by <?php echo ucwords($rows['author']);?></a></td>
<td style="width:51%; text-align:right;" ><a href="#author-contact" class="cssButton_roundedLow cssButton_aqua author" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;">Contact Author</a></td>
</tr>
</table>
<?php ;} ?>
</div>
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
<input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone"  required >
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
<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha anti-spam security">
<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
</span>
</div>
</td>
</tr>
<tr>
<td style="text-align:center;">
<button class="button btn-primary" type="submit"> Send </button>
<input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',$rows['email']);?>" id="to" />
<input name="course" type="hidden" value="<?php //echo $rows['event_title'];?>" id="course" /> <button class="button" type="button" id="closeBox"> Close </button></td>
</tr>
</table> 
</form>
<div class="clearfix"></div>
</div>
<div id="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
</div>	
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>