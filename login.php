<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
if(isset($_SESSION['login_business']) && $_SESSION['login_business'] == true){
if(isset($_SESSION['premium'])){
header("location: ".SITE_URL."premium/profile");
exit;
}
else{
header("location: ".SITE_URL."business/profile");
exit;
}
}
else if(isset($_SESSION['login_subcriber'])){
header("location: ".SITE_URL."sub/profile");
exit;
}
function RedirectPath($location){
if(isset($_SESSION['CurrentActionUrl'])){
$url = $_SESSION['CurrentActionUrl'];
}
else{
switch($location){
case "subscriber":
$url = SITE_URL."sub/profile";
break;
case "premium":
$url = SITE_URL."premium/profile";
break;
case "business":
$url = SITE_URL."business/profile";
}
}
return $url;
}
$advert = "Advertise";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="https://www.nigerianseminarsandtrainings.com/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Secure Members Login - Nigerian Seminars and Trainings</title>
<meta name="description" content="Login to Nigerian Seminars and Trainings to manage your business and events listing"/>
<meta name="keywords" content="login " />
<?php include("scripts/headers_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/additional-methods.js"></script>
<style>
.black_overlay{
display: none;
position: absolute;
top: 0%;
left: 0%;
width: 100%;
height: 100%;
background-color:#000;
z-index:1001;
-moz-opacity: 0.3;
opacity:.30;
filter: alpha(opacity=30);
}
.white_content {
display: none;
position: fixed;
top: 10%;
left: 35%;
width: 25%;
height: 30%;
padding: 16px;
border: 4px solid  #090;
background-color: white;
z-index:1002;
}
.validating{
background-color:#FFF2C1;
color:#FC0;
}
.error{
background-color:#FFC4C4;
color:#F00;
}
.ok{
background-color:#C6FFE2;
color:#0C0;
}
#msgComment{
display:block;
padding:5px;
width:100%;
text-align:center;
margin-bottom:3px;
}
.forgotTable tr td{
padding:3px;
}
.headerForm {
font-size: 14px;
font-weight: bold;
}
.confirmation{
background-color:#FFE9D2;
display:block;
padding:2px;

border:1px solid #F90;
}
.confirmation p{
color:#F60;
font-weight:bold;
text-align: center;
}
.confirmation span{
display:block;
padding:5px;
width:300px;
margin: 5px auto 5px auto;
}
.confirmation .clear{
clear:both;
}
.confirmation a{
display:block;
padding:3px;
width:100px;
float:left;
margin-right:20px;
text-align: center;
color: #FFF;
background-color: #009300;
font-weight: bold;
text-decoration: none;
border-radius:5px;
}
.confirmation .options{
background:#FCC;
text-align:left;
}
.confirmation .options ul{
display:block;
}
.confirmation .options ul li{
display:block;
list-style:none;
padding:2px;
}
.confirmation .options ul li a{
display:block;
width: auto;
float: none;
background-color: #FCC;
color: #060;
text-align:left;
font-weight: normal;
}
.notification ul{
display:block;
margin-left:20px;
}
.notification  ul li{
display:block;
list-style:disc;
padding:2px;
}
.notification  ul li a{
display:block;
width: auto;
float: none;
color: #060;
text-align:left;
font-weight: normal;
text-decoration:none;
font-size:12px;
}
.notification  ul li a:hover{
text-decoration:underline;
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
width:350px; 
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
</style>
<script>
function changeText(){
$("#msgbox").html('Please login to continue').removeClass('alert-error alert-info alert-success').addClass('alert-warning').show()
}
$(document).ready(function() {	
//select all the a tag with name equal to modal
$('.modal').click(function(e) {
//Cancel the link behavior
e.preventDefault();
//Get the A tag
var id = $(this).attr('href');
$('#btn').hide();
$('#fpass').html('<i class="fa fa-info-circle "></i>&nbsp;&nbsp;Forgot Password?');
$('.contact_provider_table').show();
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
$('#msgComment').hide();
$('#mask').fadeOut('slow');
$('.window').fadeOut('slow');
});		
//if close button is clicked
$('.window #closeBox2').click(function (e) {
//Cancel the link behavior
e.preventDefault();
//$('#msgbox').fadeOut('slow');
$('#msgComment').hide();
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
});  
</script>
<script type="text/javascript">
$(document).ready(function(){
/****************Reload captcha*********************/			
function reloadCaptcha(){
$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
}
$('.captcode').click(function(e){
e.preventDefault();
reloadCaptcha();
});
/****************Submit forgot password form*********************/		
$('#forgotPassword').submit(function(){
$('#msgComment').removeClass().removeClass('alert-success alert-error alert-info').addClass('alert-warning').html('Processing...').show();								
$.post("<?php echo SITE_URL;?>tools/password_forget.php",{email:$('#emailForgot').val(),security:$('#securitycode').val()} ,function(msg){
if(msg == 'Sent'){
$('#msgComment').removeClass('alert-success alert-error alert-warning').addClass('alert-info').text("A new password has been to your email")
$('#fpass').html('<i class="fa fa-info-circle "></i>&nbsp;&nbsp;Password Sent!');
$('#emailForgot').val('');
$('#securitycode').val('');
$('.contact_provider_table').hide();
$('#btn').show();
}
if(msg == 'Security'){
$('#msgComment').removeClass('alert-success alert-info alert-warning').addClass('alert-error').text("Invalid Verification Code")
$('#emailForgot').val('');
$('#securitycode').val('')
}
else if(msg == 'Not Found'){
$('#msgComment').removeClass('alert-success alert-warning alert-info').addClass('alert-error').text("Sorry there no account associated with this email!");
$('#emailForgot').val('');
$('#securitycode').val('')
}
/*else {
alert(msg)
}*/
});
return false;
})
});
</script>
<script type="text/javascript">
$(document).ready(function()
{
$("#loginform").submit(function()
{
var GetEmail = $('#email').val();
if($('#email').val() == ''){
alert("Please enter your email");
return false;
}
else if ($('#password').val() == ''){
alert("Please enter your password");
return false;
}
else{
//remove all the class add the messagebox classes and start fading
$("#msgbox").removeClass('alert-success alert-error alert-info confirmation').addClass('alert-warning').text('Authenticating....').fadeIn(1000);
//check the username exists or not from ajax
$.post("<?php echo SITE_URL;?>tools/login_new.php",{ user_email:$('#email').val(),password:$('#password').val(),addToCal:$('#add_to_cal').val()} ,function(data)
{
if(data=='Premium Login') //if correct login detail
{
$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('Login successful, Redirecting.....').removeClass('alert-error alert-info alert-warning').addClass('alert-success').fadeTo(900,1,
function()
{ 
//redirect to secure page
document.location='<?php echo RedirectPath('premium');?>';
});
});
}
else if(data=='Regular Business') //if correct login detail
{
$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('Login successful, Redirecting.....').removeClass('alert-error alert-info alert-warning').addClass('alert-success').fadeTo(900,1,
function()
{ 
//redirect to secure page
document.location='<?php echo RedirectPath('business');?>';
});
});
}
else if(data=='Account Expired'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('Sorry your premium account has expired! <a href=\'premium-listing-renew\'>Click here to renew</a>').removeClass('alert-success alert-info alert-warning').addClass('alert-error').fadeTo(900,1);
});
}
else if(data=='Regular Business Email Sent'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('<p>This Account currently does not have a login password, would you like to generate a login password for this account? </p><span><a href="javascript:void(0)" onclick="BusinessEmail()">Yes</a> <a href="javascript:void(0)" style="background:#F00;" onclick="NoEmail()">No</a><div class=\'clear\'></div></span>').removeClass('alert-success alert-error alert-warning').addClass('alert-info confirmation').fadeTo(900,1);
});
/* $("#msgbox").fadeOut('slow');
$("#emailMessage").fadeIn('slow');*/
}
else if(data=='Inactive'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
$(this).html('Sorry! your business is still under review, you will only be able to login once review is complete.').removeClass('alert-success alert-info alert-warning').addClass('alert-error').fadeTo(900,1);
});
}
else if(data=='Subscriber Login') //if correct login detail
{
$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('Login successful, Redirecting.....').removeClass('alert-error alert-info alert-warning').addClass('alert-success').fadeTo(900,1,
function()
{ 
//redirect to secure page
document.location='<?php echo (isset($_GET['return'] ) && !empty($_GET['return'])) ? $_GET['return'] : RedirectPath('subscriber');?>';
});
});
}
else if(data=='Subscriber Email Sent'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('<p>This Account currently does not have a login password, would you like to generate a login password for this account? </p><span><a href="javascript:void(0)" onclick="SubscriberEmail()">Yes</a> <a href="javascript:void(0)" style="background:#F00;" onclick="NoEmail()">No</a><div class=\'clear\'></div></span>').removeClass('alert-success alert-error alert-warning').addClass('alert-info confirmation').fadeTo(900,1);
});
}
else if(data == 'Unconfirmed User'){
$("#msgbox").fadeTo(200,0.1,function(){ 
    $(this).html('<div class="options"><p style="text-align:left; padding-left:5px;">This Account has not been confirmed. Please go to your email address and confirm your subscription. Thanks</p></div>').removeClass('alert-success alert-info alert-warning').addClass('alert-error').fadeTo(900,1);
});
}
else if(data=='Not Found'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('<div class="options"><p style="text-align:left; padding-left:5px;">This Account currently does not exist in out database, what will you like to do?</p><ul><li><a href="<?php echo SITE_URL;?>upload-business-info">Upload your business information ?</a></li><li><a href="<?php echo SITE_URL;?>premium-listing">Subscribe to our premium listing ?</a></li><li><a href="<?php echo SITE_URL;?>subscribers">Register as a subscriber ?</a></li></ul></div>').removeClass('alert-success alert-info alert-warning').addClass('alert-error').fadeTo(900,1);
});
}
else 
{
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('Login Failed!').removeClass('alert-success alert-info alert-warning').addClass('alert-error').fadeTo(900,1);
});		
}
// alert(data);
});
return false; //not to post the  form physically
}
});
/*//now call the ajax also focus move from 
$("#password").blur(function()
{
$("#login-form").trigger('submit');
});*/
//$("#yes").click(function())
});
/*$(document).ready(function(){
$("#yes").click(function(){
alert('test');
return false;
});
});
*/function BusinessEmail(){
$("#msgbox").removeClass('alert-success alert-error alert-info confirmation').addClass('alert-warning').text('Processing....').fadeIn(1000);
$.post("<?php echo SITE_URL;?>tools/login_email.php",{ Acctype:'Business'} ,function(data){
if(data=='Regular Business Email Sent'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('<p style="color:#000;">A login password has been sent to your email address</p>').addClass('alert-info').fadeTo(900,1);
});	
}
});
return false;
}
function SubscriberEmail(){
$("#msgbox").removeClass('alert-success alert-error alert-info confirmation').addClass('alert-warning').text('Processing....').fadeIn(1000);
$.post("<?php echo SITE_URL;?>tools/login_email.php",{ Acctype:'Subscriber'} ,function(data){
if(data=='Subscriber Email Sent'){
$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
{ 
//add message and change the class of the box and start fading
$(this).html('<p style="color:#000;">A login password has been sent to your email address</p>').addClass('alert-info').fadeTo(900,1);
});	
}																																		   });
return false;
}
function NoEmail(){
window.location='./';
}
</script>
</head>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;"><i class="fa fa-lock"></i>&nbsp;Sign In</h1> </td>
</tr>
<tr>
<td style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</div>
<div id="subpage">
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
<div class="login">
<form method="post" id="loginform">
<div class="form-body theme-green">
<!-- end section -->
<div class="spacer-t30 spacer-b30">
<div class="tagline"><h3 style="font-weight:normal;font-size: 12px"><span> Login </span></h3></div><!-- .tagline -->
</div>
<div class="section">
<?php if(isset($_SESSION['login_msg'])){ echo $_SESSION['login_msg'];}
else{
?>
<div class="alert notification spacer-b30" style="display:none" id="msgbox"></div>
<?php } ?>
<label for="email" class="field prepend-icon">
<input type="text" name="email" id="email" class="gui-input" placeholder="Enter email address">
<span class="field-icon"><i class="fa fa-envelope"></i></span>  
</label>
</div><!-- end section -->                    
<div class="section">
<label for="password" class="field prepend-icon">
<input type="password" name="password" id="password" class="gui-input" placeholder="Enter password">
<span class="field-icon"><i class="fa fa-lock"></i></span>  
</label>
<input name="add_to_cal" type="hidden" id="add_to_cal" value="<?php echo (isset($_GET['event'])) ? $_GET['event'] : '' ;?>">
</div><!-- end section -->  
<?php
/*if(isset($_GET['auth']) && $_GET['auth'] == 'subscriber' && isset($_GET['return']) && !empty($_GET['return'])){
echo '<script>changeText();</script>';
}*/
?>
<div class="section">
<table>
<tr>
<td colspan="3" style=" text-align:left;"><label class="switch switch-green block">
<input type="checkbox" name="remember" id="remember" checked>
<span data-on="YES" data-off="NO"></span> 
<span> Keep me logged in ?</span>
</label>
</td>
<td style="text-align:left; width:85px;"><button type="submit" class="button btn-primary" name="submit" style="background-color:#066; color:#FFF; font-size:10px;">Login</button></td>
<td style="width:197px;"></td>
</tr>
<tr>
<td colspan="3" style=" text-align:right;"></td>
<td style="text-align:center;">&nbsp;</td>
<td style=" text-align:left;">&nbsp;</td>
</tr>
<tr>
<td style="width:172px;"><a href="#login_forgot" class="button btn-primary modal">Forgot password?</a></td>
<td  style=" text-align:left; width:150px;"><button type="submit" class="button btn-primary" name="submit">Create  account</button></td>
<td colspan="2" style=" text-align:left;">&nbsp;</td>
</tr>
</table>
</div>
<!-- end section -->                                                           
<!-- end section -->
</div><!-- end .form-body section -->
<!-- end .form-footer section -->
</form>           
</div>
<div id="mask"></div>
<div id="login_forgot" style="float:left;" class="window boxContent"> 
<form id="forgotPassword" name="form1" method="post" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;width:332px;">
<strong style="color:#006600;width:100%;" id="fpass"><i class="fa fa-info-circle "></i>&nbsp;&nbsp;Forgot Password?</strong>
</div>
<div class="alert notification spacer-b30" style="display:none;width:100%;" id="msgComment"></div>
<table class="contact_provider_table" style="width:332px;">
<tr>
<td style="color:#009900; font-size:12px; text-align:center; width:85%;">Please provide your email so we can reset your password.</td>
</tr>
<tr>
<td style="width:85%;">
<label class="field">
<input type="text" name="emailForgot" id="emailForgot" class="gui-input" placeholder="Email" required >
</label>
</td></tr>
<tr>
<td>
<div class="smart-widget sm-left sml-120">
<label class="field">
<input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
</label>
<span class="button captcode">
<img src="tools/captcha.php" id="captcha" alt="Captcha anti-spam security">
<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
</span>
</div>
</td>
</tr>
<tr>
<td style="text-align:center;">
<button class="button btn-primary fpassword" type="submit"> Send </button>
<button class="button" id="closeBox"> Close </button></td>
</tr>
</table> 
<p style="text-align:center; display:none;" id="btn"><button class="button" id="closeBox2"> Close </button></p>
</form>
<div class="clearfix"></div>
</div>
<div id="contact-info">
</div>
</div>
<div id="latest_content_items">
<!-- Section 1 Featured -->
<!-- End Featured 1 -->
</div><!-- end latest_content_items -->
</div>
<div id="sub_links"><div id="sub_links2_middle">
<?php //include("tools/categories.php");?>
<?php 
echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div></div><!-- end subpage -->
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
<?php unset($_SESSION['login_msg']);?>
</html>