<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($business);
while (list ($key, $val) = each ($business)) {
if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
}
if(connection());
$advert = "Add Business Info";
require_once("scripts/insertions.php");	
if(isset($_GET['type']) && $_GET['type'] == 'success'){
$message ='<div class="alert notification alert-success">Your business information has been uploaded, Your business information will be displayed after it has been reviewed and activated</div>'; 
}
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Nigerian Seminars and Trainings - Upload Business Info</title>
<meta name="description" content="Place your business above the line - upload your business information to our extensive database on Nigerian Seminars and Trainings (at no cost)"/>
<meta name="dcterms.description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)" />
<meta property="og:title" content="Nigerian Seminars and Trainings - Upload Business Info" />
<meta property="og:description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)" />
<meta property="twitter:title" content="Nigerian Seminars and Trainings - Upload Business Info" />
<meta property="twitter:description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)" />
<?php include("scripts/headers_new.php");?>
<script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="css/smartforms/js/additional-methods.js"></script>
<script type="text/javascript">
//script for the search calender
$(function() {
/* @reload captcha
------------------------------------------- */		
function reloadCaptcha(){
$("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
}
$('.captcode').click(function(e){
e.preventDefault();
reloadCaptcha();
});
});
function Get_Countries(){
$.post("<?php echo SITE_URL;?>tools/countries.php",{country:$('form#business_form #region').val()}, function(data) {
$('form#business_form #country').html(data)
});
}
function Get_States(){
if($('form#business_form #country').val() == 38){
$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:$('form#business_form #country').val()}, function(data) {
$('form#business_form #state').html(data)

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

$( "#business_form" ).validate({

/* @validation states + elements 
------------------------------------------- */
errorClass: "state-error",
validClass: "state-success",
errorElement: "em",
/* @validation rules 
------------------------------------------ */
rules: {
business_name: {
required: true
},
email: {
required: true,
email:true
},
buz_type: {
required: true,
},
password:{
required: true,
minlength: 6,
maxlength: 16						
},
confirm_password:{
required: true,
minlength: 6,
maxlength: 16,						
equalTo: '#password'
},
phone: {
required: true,
},
address: {
required: true,
minlength: 10
},
description:  {
required: true,
minlength: 150
},			
securitycode:{
required:true
},
specialization: {
required: true
},
region: {
required: true
},	
country: {
required: true
},
contact_person: {
required: true
},
telephone: {
required: true
},																							
},
/* @validation error messages 
---------------------------------------------- */

messages:{
business_name: {
required: 'Enter your business name'
},
email: {
required: 'Enter your email address',
email:'Enter a valid email address'
},
buz_type: {
required: 'Select your business type',

},
password:{
required: 'Enter a password'

},
confirm_assword:{
required: 'Please repeat the above password',
equalTo: 'Password mismatch detected'
},
telephone: {
required: 'Please enter your phone number',
},
address: {
required: 'Please enter your address',
minlength: 'Your address must contain atleast 10 characters'
},
website: {
required: 'Please enter your website',
url: 'Please enter a valid url e.g http://www.yoursite.com'
},								
description:  {
required: 'Enter your business description',
minlength: 'Your description must contain atleast 150 characters'
},			
securitycode:{
required:'Enter security code'
},

specialization: {
required: 'Select specialization'
},
region: {
required: 'Select your region'
},	
country: {
required: 'Select your country'
},
contact_person: {
required: 'Please enter a contact person'
},																						


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
function getLagosDivisions(){
if($('form#business_form #state').val() == 25){
$.post("<?php echo SITE_URL;?>tools/countries.php",{LagosDivisons:'True'}, function(data) {
$('form#business_form #division').html(data)
});
}else $('form#business_form #division').html('<option value="">-- Select a division (Lagos State Only) --</option>');
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
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;">Upload Business Information</h1> </td>
</tr>
<tr>
<td style="font-size:11px; text-align:center">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="tab_slider">
<div id="subpage">
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
<?php echo $message;?>
<form method="post" id="business_form" >
<table class="event_detail">
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="business_name" type="text" class="gui-input" placeholder="Business Name" id="name" value="<?php echo $_SESSION['business_name'];?>" /><span class="field-icon"><i class="fa fa-suitcase"></i></span>  
</label>
</td>
</tr>
<tr>
<td>
<label class="field select">
<select name="buz_type" id="buz_type" >
<option selected="selected" value="">Select Business Type</option>
<option value="Training">Training Provider</option>
<option value="Managers">Event Managers</option>
<option value="Facilitator">Facilitators</option>
<option value="Suppliers">Event Equipment Supplier</option>
<option value="Venue">Venue Provider</option>
</select>
<i class="arrow double"></i>
</label>
</td>
<td>
<label class="field prepend-icon">
<input name="email" class="gui-input" placeholder="Email" id="email" value="<?php echo $_SESSION['email'];?>" size="40" /><span class="field-icon"><i class="fa fa-envelope"></i></span>  
</label>
<p style="color:#F00; font-size:10px;">Use company emails. (e.g. example@yourcompany.com)</p>
</td>
</tr>
<tr>
<td>
<label class="field prepend-icon">
<input name="password" type="password" class="gui-input" placeholder="Password" id="password" value="" size="40" /><span class="field-icon"><i class="fa fa-lock"></i></span>  
</label>
</td>
<td>
<label class="field prepend-icon">
<input name="confirm_password" type="password" class="gui-input" placeholder="Confirm Password" id="confirm_password" value="" size="40" /><span class="field-icon"><i class="fa fa-lock"></i></span>  
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label for="description" class="field prepend-icon">
<textarea name="description" id="description" class="gui-textarea"  placeholder="Business Description" ><?php echo $_SESSION['description'];?>
</textarea>
<span class="field-icon"><i class="fa fa-comment"></i>
</label>
<p style="color:#F00; font-size:10px;">Describe business</p>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="address" type="text" class="gui-input" placeholder="Address" id="address" value="<?php echo $_SESSION['address'];?>" size="40" /><span class="field-icon"><i class="fa fa-home"></i></span>  
</label>

</td>
</tr>
<tr>
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
<td>
<div id="changeCountry">
<label class="field select">
<select name="country" id="country"  onchange="Get_States()">
<option value="">Select Country</option>
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
</tr>
<tr>
<td>
<label class="field select">
<select name="state" id="state" onchange="getLagosDivisions()">
<option value="">Select State (For Nigeria only)</option>
</select>
<i class="arrow double"></i>
</label>
</td>
<td>
<label class="field select">
<select name="division" id="division">
<option value="">-- Select a division (Lagos State Only) --</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td colspan="5"> 
<label class="field select">
<select name="category" id="category" >
<?php 
if(connection());
$result = MysqlSelectQuery("select * from categories order by category_name");?>
<option value="">Select Specialization (training providers only</option>
<?php while ($rows = SqlArrays($result)){?>
<option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="size" type="text" class="gui-input" placeholder="Size: (For venue providers (i.e hall size))" id="size" value="<?php echo $_SESSION['size'];?>" size="40" />
<span class="field-icon"><i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="capacity" type="text" class="gui-input" placeholder="Capacity: (Venue providers only)" id="capacity" value="<?php echo $_SESSION['capacity'];?>" size="40" />
<span class="field-icon"><i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:right; width:41%;">
<label class="field prepend-icon">
<input name="price" type="text" class="gui-input" placeholder="Price: (Venue providers only)" id="price" value="<?php echo $_SESSION['price'];?>" size="40" />
<span class="field-icon"><i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="contact_person" type="text" class="gui-input" placeholder="Contact Person:" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" size="40" />
<span class="field-icon"><i class="fa fa-user"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2"> 
<label class="field prepend-icon">
<input name="designation" type="text" class="gui-input" placeholder="Designation of person entering this event" id="designation" value="<?php echo $_SESSION['designation'];?>" size="40" />
<span class="field-icon"><i class="fa fa-user"></i></span>
</label></td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="telephone" type="text" class="gui-input" placeholder="Telephone:" id="telephone" value="<?php echo $_SESSION['telephone'];?>" size="40" />
<span class="field-icon"><i class="fa fa-phone"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="website" type="text" class="gui-input" placeholder="Website:" id="website" value="<?php echo $_SESSION['website'];?>" size="40" />
<span class="field-icon"><i class="fa fa-globe"></i></span>
</label>
</td>
</tr>
<tr>
<td colspan="2"> 
<div class="smart-widget sm-left sml-120">
<label class="field">
<input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code:">
</label>
<span class="button captcode">
<img src="tools/captcha.php" id="captcha" alt="Captcha">
<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
</span>
</div>  
</td>
</tr>
<tr>
<td colspan="2"></td>
</tr>
<tr>
<td colspan="2" style="text-align:center;">
<button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:14px; background-color:#435A65; color:#FFF;" name="submit_bizinfo">Upload</button>
</td>
</tr>
</table>
</form>
<div id="contact-info">
</div>
</div>
</div>
</div><!-- end subpage -->
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
</div>
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footers_new.php");?>

</body>
</html>