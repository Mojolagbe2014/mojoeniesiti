<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
require_once("app/classes/Helper.php");
use nigerianseminarsandtrainings\app\classes\Helper;
$helper = new Helper();
$message = '';
reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
if(!isset($_SESSION['login_business'])){
$_SESSION['CurrentActionUrl'] = SITE_URL."add-event";
}
$advert = "Add Event";
require_once("scripts/insertions.php");	
if(isset($_GET['type']) && $_GET['type'] == 'success'){
	$message ='<div class="alert notification alert-success">Your event has been uploaded, Your event will be displayed after it has been review and activated</div>'; 
}
$_SESSION["email"] = $_SESSION["email_add"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Add Event - Nigerian Seminars and Trainings</title>
<meta name="description" content="Add your events - conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
<meta name="dcterms.description" content="Add your events - conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)." />
<meta property="og:title" content="Nigerian Seminars and Trainings - Add Event" />
<meta property="og:description" content="Add your events - conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)." />
<meta property="twitter:title" content="Nigerian Seminars and Trainings - Add Event" />
<meta property="twitter:description" content="Add your events - conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)." />
<!--<link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->
<?php include("scripts/headers_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-monthpicker.min.js"></script>
<script type="text/javascript">
<?php 
if(!isset($_SESSION['login_business'])){?>
$(document).ready(function(e) {
$("#eventForm input, #eventForm select , #eventForm textarea, #eventForm button").attr('disabled',true);
});	
$(document).ready(function() {	
//$('a[name=currency]').click(function(e) {
//Cancel the link behavior
//e.preventDefault();
//Get the A tag
var id = $('#Login_pop_event');
//Get the screen height and width
var maskHeight = $(document).height();
var maskWidth = $(window).width();
//Set heigth and width to mask to fill up the whole screen
$('#mask').css({'width':maskWidth,'height':maskHeight});
//transition effect		
$('#mask').fadeIn(1000);	
$('#mask').fadeTo("slow",0.8);
$('#amount').val('200');
//Get the window height and width
var winH = $(window).height();
var winW = $(window).width();
//Set the popup window to center
$(id).css('top',  winH/2-$(id).height()/2);
$(id).css('left', winW/2-$(id).width()/2);
//transition effect
$(id).fadeIn(2000); 
//});
//if close button is clicked
$('.window_currency #Close').click(function (e) {
//Cancel the link behavior
e.preventDefault();
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
<?php } ?>

/* @reload captcha
------------------------------------------- */			   
//script for the search calender
$(function() {
$("form#eventForm #website").keyup(function(){ if (($(this).val().indexOf("http://") < 0) && $(this).val().indexOf("https://") < 0){ $(this).val("http://"+$(this).val()); } });
$("#start_date").datepicker({
defaultDate: "+1w",
changeMonth: false,
numberOfMonths: 1,
prevText: '<i class="fa fa-chevron-left"></i>',
nextText: '<i class="fa fa-chevron-right"></i>',
onClose: function( selectedDate ) {
$( "#end_date" ).datepicker( "option", "minDate", selectedDate );
}
});
$("#end_date").datepicker({
defaultDate: "+1w",
changeMonth: false,
numberOfMonths: 1,
prevText: '<i class="fa fa-chevron-left"></i>',
nextText: '<i class="fa fa-chevron-right"></i>',			
onClose: function( selectedDate ) {
$( "#end_date" ).datepicker( "option", "maxDate", selectedDate );
}
});
function reloadCaptcha(){
$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
}
$('.captcode').click(function(e){
e.preventDefault();
reloadCaptcha();
});
});
function Get_Countries(){
$.post("<?php echo SITE_URL;?>tools/countries.php",{country:$('form#eventForm #region').val()}, function(data) {
$('form#eventForm #country').html(data)
});
}
function Get_States(){
if($('form#eventForm #country').val() == 38){
$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:$('form#eventForm #country').val()}, function(data) {
$('form#eventForm #state').html(data)
});
}
}
function getLagosDivisions(){
if($('form#eventForm #state').val() == 25){
$.post("<?php echo SITE_URL;?>tools/countries.php",{LagosDivisons:'True'}, function(data) {
$('form#eventForm #division').html(data)
});
}
}
</script>
<script type="text/javascript">
$(function() {
/* @custom validation method (smartCaptcha) 
------------------------------------------------------------------ */
$.validator.methods.smartCaptcha = function(value, element, param) {
return value == param;
};
$( "#eventForm" ).validate({
/* @validation states + elements 
------------------------------------------- */
errorClass: "state-error",
validClass: "state-success",
errorElement: "em",
/* @validation rules 
------------------------------------------ */
rules: {
name: {
required: true
},
email: {
required: true,
email:true
},
title: {
required: true,
minlength: 10
},
phone: {
required: true,
},
venue: {
required: true,
minlength: 10
},
website: {
required: true,
url: true
},								
description:  {
required: true,
minlength: 150
},			
securitycode:{
required:true
},
start_date: {
required: true,
},
end_date: {
required: true
},
organizer: {
required: true
},
category: {
required: true
},
region: {
required: true
},	
country: {
required: true
},

currency: {
requried: true;
}
},
/* @validation error messages 
---------------------------------------------- */
messages:{
name: {
required: 'Enter name of the person making this entry'
},
title: {
required: 'Please enter title of event',
minlength:'Event must contain 10 charaters and above'
},
venue: {
required: 'Enter venue of this event',
minlength:'Venue must contain 10 charaters and above'
},
phone: {
required: 'Please enter your telephone number',
},
email: {
required: 'Enter email address',
email: 'Enter a VALID email address'
},					
website: {
required: 'Please enter url of this event',
url: "Please enter a valid url (e.g http://www.yoursite.com)"
},								
description:  {
required: 'Please enter description of this event',
minlength: 'Minimum charater entery is 150'
},			
securitycode:{
required:'please enter security code'
},
start_date: {
required: 'Please select start date',
},
end_date: {
required: 'Please select end date'
},
organizer: {
required: 'Enter organizers name'
},
category: {
required: 'Please select a category'
},
region: {
required: 'Please selecta a region'
},	
country: {
required: 'Please select a country'
},
state: {
required: 'Please select a state'
}																		
},
/* @validation highlighting + error placement  
---------------------------------------------------- */	
highlight: function(element, errorClass, validClass) {
$(element).closest('.field').addClass(errorClass).removeClass(validClass);
},
unhighlight: function(element, errorClass, validClass) {
$(element).closest('.field').removeClass(errorClass).addClass(validClass);
},
errorPlacement: function(error, element) {
if (element.is(":radio") || element.is(":checkbox")) {
element.closest('.option-group').after(error);
} else {
error.insertAfter(element.parent());
}
}
});		
});				
</script>
<style type="text/css">
#mask {
position:absolute;
left:0;
top:0;
z-index:9000;
background-color:#000;
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
</style>
</head>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div id="subpage">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table >
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;">Upload Your Event (Free)</h1></td>
</tr>
<tr>
<td style="font-size:11px"><h2>&nbsp;</h2><h3 style="font-weight:normal; font-size:10px;">&nbsp;</h3></td>
</tr>
</table>
</form>
</div>
<div id="mask"></div>
<div id="Login_pop_event" style="float:left; text-align:center;" class="window_currency boxContent smart-forms">
<div class="alert notification alert-error" >
<strong>You must be logged in a business to add an event, 
<a href="login" title="login page">Click here</a> to login.</strong>
<br /> <br />Dont have an account? <br /><br />
<a href="<?php echo SITE_URL;?>upload-business-info" class="button btn-primary" title="subscribers page">
<i class="fa fa-institution"></i> Create a Business Account
</a>
</div>
</div>
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px; margin-bottom:10px; text-align:center;"> 
<?php echo $message;
if(!isset($_SESSION['login_business'])){?>
<div class="alert notification alert-error" >
<strong>You must be logged in as a business to add an event, <a href="login" title="login page">Click here</a> to login.</strong>
<br /> <br />Dont have an account? <br /><br />
<a href="<?php echo SITE_URL;?>upload-business-info" class="button btn-primary" title="subscribers page">
<i class="fa fa-institution"></i> Create a Business Account
</a>
</div>
<?php 
$_SESSION['action_url'] = $_SERVER["REQUEST_URI"];
} ?>
    <form method="post" id="eventForm" enctype="multipart/form-data">
<table class="event_detail">
<tr>
<td colspan="2"> 
<label class="field prepend-icon">
<input name="entrant_name" type="text" class="gui-input" placeholder="Name (person making the entry)" id="name" value="<?php echo $_SESSION['name'];?>" size="40" required="required" /><span class="field-icon"><i class="fa fa-user"></i></span>  
</label>
</td>
<td>
<label class="field prepend-icon">
<input name="email" type="email" class="gui-input" placeholder="Email" id="email" value="<?php echo $_SESSION['email'];?>" size="40" required="required" /><span class="field-icon"><i class="fa fa-envelope"></i></span>  
</label>
</td>
</tr>
<tr>
<td colspan="3">
<label class="field prepend-icon">
<input name="phone" type="text" class="gui-input" placeholder="Telephone" id="phone" value="<?php echo $_SESSION['phone'];?>"/>
<span class="field-icon"><i class="fa fa-phone"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="3">
<label class="field prepend-icon">
<input name="title" type="text" class="gui-input" placeholder="Event Title" id="title" value="<?php echo $_SESSION['title'];?>" />
<span class="field-icon"><i class="fa fa-asterisk"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="3">
<label for="description" class="field prepend-icon">
<textarea name="description" id="description" class="gui-textarea"  placeholder="Event Description" ><?php echo $_SESSION['description'];?></textarea>
<span class="field-icon"><i class="fa fa-comment"></i></span> 
<span class="input-hint"> 
Enter detailed description of your event here
</span>
</label>
</td>
</tr>
<tr>
<td colspan="3">
<label for="venue" class="field prepend-icon">
<textarea name="venue" id="venue" class="gui-textarea"  placeholder="Venue" ><?php echo $_SESSION['venue'];?></textarea>
<span class="field-icon"><i class="fa fa-home"></i></span>  
<span class="input-hint"> 
Enter the location of the event here
</span>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field select">
<select name="category" id="category" >
<?php 
if(connection());
$result = MysqlSelectQuery("select * from categories order by category_name");?>
<option value="">Select Category</option>
<?php while ($rows = SqlArrays($result)){?>
<option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</td>
<td>
<label class="field select">
<select name="region" id="region"  onchange="Get_Countries()">
<option value="">Select Region</option>
<option value="1">Africa</option>
<option value="2">Asia</option>
<option value="3">Europe</option>
<option value="4">N. America</option>
<option value="5">Oceania</option>
<option value="6">S. America</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<div id="changeCountry">
<label class="field select">
<select name="country" id="country"  onchange="Get_States()">
<option value="">Select Country</option>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
<td>
<div id="changeState">
<label class="field select">
    <select name="state" id="state" onchange="getLagosDivisions()">
<option value="">Select State (For Nigeria only)</option>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
</tr>
<tr>
<td colspan="5">
<label class="field select">
<select name="division" id="division">
<option value="">-- Select a division (Lagos State Only) --</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr id="fee">
<td>
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="currency" id="currency" required>
<option value="">Select Currency</option>
<?php 
foreach ($helper->currencies() as $key => $value)
{?>
<option value="<?php echo $key;?>"><?php echo $key;?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
<td id="price">
<label class="field prepend-icon" >
<input name="cost" type="number" class="gui-input" placeholder="Attendance Fee" id="cost" value="<?php echo $_SESSION['cost'];?>" size="40" required />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment">
<label class="field prepend-icon" >
<input name="comment" type="text" class="gui-input" placeholder="Comment About Fee" size="40"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr class="pay-option">
<td colspan="3">Second Payment option if any</td>
</tr>
<tr id="fee">
<td>
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="second_currency" id="currency">
<option value="">Select Currency</option>
<?php 
foreach ($helper->currencies() as $key => $value)
{?>
<option value="<?php echo $key;?>"><?php echo $key;?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
<td id="price">
<label class="field prepend-icon" >
<input name="second_cost" type="number" class="gui-input" placeholder="Attendance Fee" id="cost" size="40"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment">
<label class="field prepend-icon" >
<input name="second_comment" type="text" class="gui-input" placeholder="Comment About Fee" size="40"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr class="pay-option">
<td colspan="3">Third Payment option if any</td>
</tr>
<tr id="fee">
<td>
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="third_currency" id="currency">
<option value="">Select Currency</option>
<?php 
foreach ($helper->currencies() as $key => $value)
{?>
<option value="<?php echo $key;?>"><?php echo $key;?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
<td id="price">
<label class="field prepend-icon" >
<input name="third_cost" type="number" class="gui-input" placeholder="Attendance Fee" id="cost" size="40" />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment">
<label class="field prepend-icon" >
<input name="third_comment" type="text" class="gui-input" placeholder="Comment About Fee" size="40"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr class="pay-option">
<td colspan="3">Fourth Payment option if any</td>
</tr>
<tr id="fee">
<td>
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="fourth_currency" id="currency">
<option value="">Select Currency</option>
<?php 
foreach ($helper->currencies() as $key => $value)
{?>
<option value="<?php echo $key;?>"><?php echo $key;?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
<td id="price">
<label class="field prepend-icon" >
<input name="fourth_cost" type="number" class="gui-input" placeholder="Attendance Fee" id="cost" size="40"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment">
<label class="field prepend-icon" >
<input name="fourth_comment" type="text" class="gui-input" placeholder="Comment About Fee" size="40"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr class="pay-option">
<td colspan="3">Apply Value Added Tax (VAT):</td>
</tr>
<tr>
<td colspan="5">
<label class="field select">
<select name="vat" id="vat">
<option value="no">NO</option>
<option value="yes">YES</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<?php if(isset($_SESSION['login_subcriber'])){?>
<tr>
<td colspan="3">
<label class="field">
<input name="organizer" type="text" class="gui-input" placeholder="Event Orgainiser" id="organizer" value="<?php echo $_SESSION['organizer'];?>" size="40" />
</label>
</td>
</tr>
<?php
}
?>
<tr>
<td colspan="3">
<label for="facilitator" class="field prepend-icon">
<textarea name="facilitator" id="facilitator" class="gui-textarea"  placeholder="Facilitator/s" ><?php echo $_SESSION['facilitator'];?></textarea>
<span class="field-icon"><i class="fa fa-anchor"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="start_date" type="text" class="gui-input" placeholder="Select Start Date" id="start_date"   value="<?php echo $_SESSION['start_date'];?>" readonly />
<span class="field-icon"><i class="fa fa-calendar"></i></span>  
</label>
</td>
<td>
<label class="field prepend-icon">
<input name="end_date" type="text" class="gui-input" placeholder="Select End Date" id="end_date"   value="<?php echo $_SESSION['end_date'];?>" readonly />
<span class="field-icon"><i class="fa fa-calendar"></i></span>  
</label>
</td>
</tr>
<tr class="pay-option">
<td colspan="3">Course Brochure (optional):</td>
</tr>
<tr>
<td colspan="3">
<label class="field prepend-icon">
<input name="brochure" class="gui-input" id="brochure" type="file" size="40" />
<span class="field-icon"><i class="fa fa-file"></i></span>  
</label>
</td>
</tr>
<tr>
<td colspan="3">
<label class="field prepend-icon">
<input name="website" class="gui-input" placeholder="Website" id="website" type="url" value="<?php echo $_SESSION['website'];?>" size="40" />
<span class="field-icon"><i class="fa fa-globe"></i></span>  
</label>
</td>
</tr>
<tr>
<td colspan="3">
<label class="field prepend-icon">
<input name="tags" type="text" class="gui-input" placeholder="Tags (enter set of keywords separated by a comma (,))" id="tags" value="<?php echo $_SESSION['tags'];?>" size="40" />
<span class="field-icon"><i class="fa fa-arrows"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="3" >
<textarea name="deal" id="deal" class="gui-textarea"  placeholder="Deals / Discounts / Offers"></textarea>
</td>
</tr>
<tr>
<td colspan="3" style="text-align:center">
<div class="smart-widget sm-left sml-120">
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
<td colspan="3" style="text-align:center">
<button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:14px; background-color:#435A65; color:#FFF;" name="submit_event">Submit</button> 
</td>
</tr>
</table>
</form>
<?php 
/*}
else{
echo '<div class="alert notification alert-error">You must be logged in to upload and event, <a href="login">Click here</a> to login. <br /> Dont have an account? <a href="biz_info">Click here</a>to register as a business or <a href="subscribers">Click here</a> to register as a subscriber</div>';
}*/
?>
</div>
</div>
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
</div>
<!-- end subpage -->
<?php //include("tools/categories.php");?>	
<?php include("tools/side-menu_new.php");?>	
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>
</body>

</html>