<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true){
//redirect back to login page if login session is not set
header("location:".SITE_URL."login");
exit;
}
$errors = array();
$message = '';
reset ($business);
while (list ($key, $val) = each ($business)) {
if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
}

$advert = "Add Business Info";
require_once("../scripts/insertions.php");	
$random = random(8);

if(isset($_POST['update_bizinfo'])){

reset ($_POST);
while (list ($key, $val) = each ($_POST)) {
if ($val == "") $val = "NULL";
$business[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
if ($val == "NULL")
$business[$key] = NULL;
else
$business[$key] = $val;
}
$check = MysqlSelectQuery("select user_id,email from user_login where email= '".$_POST['email']."'");
$num = NUM_ROWS($check);
$rows_edit = SqlArrays($check);

$checkBizForEmail = MysqlSelectQuery("select email from businessinfo where email = '".$_POST['email']."'");
$numBiz = NUM_ROWS($checkBizForEmail);


if($business['business_name'] == "")$errors[] = "Enter your business name";
if($business['buz_type'] == "")$errors[] = "Enter your business type";
if($business['email'] == "")$errors[] = "Enter your email address";
if(!smcf_validate_email($business['email']))$errors[] = "Enter a valid email address";
if($business['description'] == "")$errors[] = "Enter your business description";
if($business['address'] == "")$errors[] = "Enter your business address";
if($business['contact_person'] == "")$errors[] = "Enter contact person";
if(($rows_edit['user_id']!=$_SESSION['user_id']) && ($num != 0)) $errors[] = "Email you entered already exist";
if(($rows_edit['user_id']!=$_SESSION['user_id']) && ($numBiz != 0))$errors[] = "Email you entered already exist";

if(count($errors) > 0){
$message = ErrorCall($errors);
}
else{
if(MysqlQuery("update businessinfo set business_name='".addslashes($business['business_name'])."',email='".$business['email']."',description='".addslashes($business['description'])."',address='".addslashes($business['address'])."',size='".$business['size']."',capacity='".$business['capacity']."',contact_person='".addslashes($business['contact_person'])."',telephone='".$business['telephone']."',website='".$business['website']."',business_type='".$business['buz_type']."', price='".$business['price']."',specialization='".$business['category']."',country='".$_POST['country']."',state='".@$_POST['state']."',division='".@$_POST['division']."' where user_id='".$_SESSION['user_id']."'"))
{

MysqlQuery("update user_login set email='".addslashes($business['email'])."' where user_id='".$_SESSION['user_id']."'") ;
$message = '<div class="alert notification spacer-b30 alert-success">Business information updated successfully</div>'; 

}
}

}

?>

<?php

if(isset($_SESSION['user_id'])){
$result = MysqlSelectQuery("select * from businessinfo where user_id='".$_SESSION['user_id']."'");
$rows_edit = SqlArrays($result);
}
$resultCategory = MysqlSelectQuery("select * from categories where category_id = '".$rows_edit['specialization']."'");
$rowsCategory = SqlArrays($resultCategory);

$resultCountry = MysqlSelectQuery("select * from countries where id = '".$rows_edit['country']."'");
$rowsCountries = SqlArrays($resultCountry);

$resultState = MysqlSelectQuery("select * from states where id_state = '".$rows_edit['state']."'");
$rowsState = SqlArrays($resultState);


?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<style>





</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


<title>Edit profile information : Nigerian Seminars and Trainings</title>
<meta name="description" content=""/>



<?php include("../scripts/headers_new.php");?>


<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/js/additional-methods.js"></script>
<script type="text/javascript" src="../nstlogin/scripts/ckeditor/ckeditor.js"></script>
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
$('form#business_form #state').removeAttr('disabled');
if($('form#business_form #state').val()==25) $('form#business_form #division').removeAttr('disabled');
$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:$('#country').val()}, function(data) {
$('#state').html(data)

});
}else {
$('form#business_form #state').attr('disabled','disabled');
$('form#business_form #division').attr('disabled','disabled');
}
}
function getLagosDivions(){
var state = $('form#business_form #state');
var division  = $('form#business_form #division');
if(state.val() == 25){
division.removeAttr('disabled');
//state.className = 'input';
}
else{
division.val('');
division.attr('disabled','disabled');
//state.className = '';
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

$( "#business_form1" ).validate({

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

</script>
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
</head>

<body>
<!-- Start Alexa Certify Javascript -->

<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>

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
<div id="main_content">
<?php include("../tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("menu.php");?>
<div id="content_left">
<div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">

<tr>
<td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-edit"></i>&nbsp; Edit Business Information</h2></td>
<td width="21%" style="padding-left:8px">&nbsp;</td>
</tr>

</table>
</form>
</div>

<div id="tab_slider">
<div id="subpage">

<div id="subpage_content">

<div id="contact-wrapper-inner" class="rounded smart-forms">

<?php echo $message;?>

<form action="" method="post" id="business_form" >
<table width="100%" border="0" class="formTable">
<tr>
<td width="21%" align="left">Busiess Name: <span style="color:#F00"> * </span></td>
<td colspan="2"> <label class="field prepend-icon">
<input name="business_name" type="text" class="gui-input" placeholder="Business Name" id="name" value="<?php echo $rows_edit['business_name'];?>" /><label class="field-icon"><i class="fa fa-suitcase"></i></label>  
</label>

</td>
</tr>
<tr>
<td align="left">Business Type: <span style="color:#F00"> * </span></td>
<td colspan="2">

<label class="field select">
<select name="buz_type" id="buz_type" >
<option selected="selected"><?php echo $rows_edit['business_type'];?></option>
<option value="Training">Training Provider</option>
<option value="Managers">Event Managers</option>
<option value="Suppliers">Event Equipment Supplier</option>
<option value="Venue">Venue Provider</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td align="left">Email: <span style="color:#F00"> * </span></td>
<td width="38%">
<label class="field prepend-icon">
<input name="email" type="email" class="gui-input" placeholder="Email" id="email" value="<?php echo $rows_edit['email'];?>" size="40" /><label class="field-icon"><i class="fa fa-envelope"></i></label>  
</label>

</td>
<td width="41%"> <span id="msgbox" style="display:none"></span></td>
</tr>
<tr align="left">
<td colspan="3"><strong><span class="contact-left">Business Description</span></strong></td>
</tr>
<tr align="left">
<td colspan="3"><span class="contact-left">
<textarea name="description" rows="7" id="description" style="width: 350px;"><?php echo $rows_edit['description'];?></textarea>
</span>
<script type="text/javascript">
CKEDITOR.replace( 'description' );
</script></td>
</tr>
<tr>
<td align="left"><span class="contact-left">Address: <span style="color:#F00"> * </span></span></td>
<td colspan="2">
<label class="field prepend-icon">
<input name="address" type="text" class="gui-input" placeholder="Address" id="address" value="<?php echo $rows_edit['address'];?>" size="40" /><label class="field-icon"><i class="fa fa-home"></i></label>  
</label>

</td>
</tr>
<tr>
<td align="left"><span class="contact-left">Region: <span style="color:#F00"> *</span></span></td>
<td colspan="2">
<label class="field select">
<select name="region" id="region" class="input" onchange="Get_Countries()">
<option value="">--- Select ---</option>
<option <?php echo $rowsCountries['continent']=='1' ? 'selected="selected"': '';?> value="1">Africa</option>
<option <?php echo $rowsCountries['continent']=='2' ? 'selected="selected"': '';?> value="2">Asia</option>
<option <?php echo $rowsCountries['continent']=='3' ? 'selected="selected"': '';?> value="3">Europe</option>
<option <?php echo $rowsCountries['continent']=='4' ? 'selected="selected"': '';?> value="4">N. America</option>
<option <?php echo $rowsCountries['continent']=='5' ? 'selected="selected"': '';?> value="5">Oceania</option>
<option <?php echo $rowsCountries['continent']=='6' ? 'selected="selected"': '';?> value="6">S. America</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td align="left">Country:</td>
<td colspan="2"><div id="changeCountry"><label class="field select">
<select name="country" id="country" class="input" onchange="Get_States()">
<option value="<?php echo $rowsCountries['id'];?>" selected="selected"><?php echo $rowsCountries['countries'];?></option>
<?php 
if(connection());
$result_country = MysqlSelectQuery("select * from countries");?>
<?php while ($rows_country = SqlArrays($result_country)){?>
<option value="<?php echo $rows_country['id'];?>"><?php echo $rows_country['countries'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</div></td>
</tr>
<tr>
<td align="left">State:</td>
<td colspan="2"><div id="changeState">
<label class="field select">
<select name="state" id="state" class="input" onchange="getLagosDivions()" <?php if($rowsCountries['id'] != 38) echo 'disabled="disabled"';?>>
<option value="<?php echo $rowsState['id_state'];?>" selected="selected"><?php echo $rowsState['name'];?></option>
<?php 
if(connection());
$result_state = MysqlSelectQuery("select * from states");?>
<?php while ($rows_state = SqlArrays($result_state)){?>
<option value="<?php echo $rows_state['id_state'];?>"><?php echo $rows_state['name'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</div>
(For Nigeria only)</td>
</tr>
<tr>
<td align="left">Lagos Division:</td>
<td colspan="5">
<label class="field select">
<select name="division" id="division" class="input" <?php if($rowsCountries['id'] != 38 || $rows_edit['division']=="" || $rows_edit['state']!=25) echo 'disabled="disabled"';?>>
<?php echo getLagosDivisions($rows_edit['division']); ?>
</select>
<i class="arrow double"></i>
</label>
(For Lagos State only)
</td>
</tr>
<tr>
<td align="left">Specialization: </td>
<td colspan="2">
<label class="field select">
<select name="category" id="category" class="input">
<option value="<?php echo $rowsCategory['category_id'];?>" selected="selected"><?php echo $rowsCategory['category_name'];?></option>
<?php 
if(connection());
$result_cat = MysqlSelectQuery("select * from categories order by category_name");?>
<?php while ($rows_cat = SqlArrays($result_cat)){
//if ($rows['category'] == $rows_cat['category_id']);
//$selected = 'selected="selected"';
?>
<option value="<?php echo $rows_cat['category_id'];?>"><?php echo $rows_cat['category_name'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
<span class="contact-left">(for training providers only)</span></td>
</tr>
<tr>
<td align="left"><span class="contact-left">Size:</span></td>
<td colspan="2"><span class="contact-left">
<label class="field prepend-icon">
<input name="size" type="text" class="gui-input" placeholder="Size: (For venue providers (i.e hall size))" id="size" value="<?php echo $rows_edit['size'];?>" size="40" />
<label for="size" class="field-icon">  <i class="fa fa-money"></i></label>
</label>

(for venue providers only)</span></td>
</tr>
<tr>
<td align="left"><span class="contact-left">Capacity</span></td>
<td colspan="2"><span class="contact-left">
<label class="field prepend-icon">
<input name="capacity" type="text" class="gui-input" placeholder="Capacity: (Venue providers only)" id="capacity" value="<?php echo $rows_edit['capacity'];?>" size="40" />
<label for="cost" class="field-icon">  <i class="fa fa-money"></i></label>
</label>

(for venue providers only)</span></td>
</tr>
<tr>
<td align="left"><span class="contact-left">Contact Person: <span style="color:#F00"> * </span></span></td>
<td colspan="2"><span class="contact-left">
<label class="field prepend-icon">
<input name="contact_person" type="text" class="gui-input" placeholder="Contact Person:" id="contact_person" value="<?php echo $rows_edit['contact_person'];?>" size="40" />
<label for="contact_person" class="field-icon">  <i class="fa fa-user"></i></label>
</label>


</span></td>
</tr>
<tr>
<td align="left"><span class="contact-left">Telephone: <span style="color:#F00"> * </span></span></td>
<td colspan="2"><span class="contact-left">
<label class="field prepend-icon">
<input name="telephone" type="text" class="gui-input" placeholder="Telephone:" id="telephone" value="<?php echo $rows_edit['telephone'];?>" size="40" />
<label for="telephone" class="field-icon">  <i class="fa fa-phone"></i></label>
</label>

</span></td>
</tr>
<tr>
<td align="left"><span class="contact-left">Website:</span></td>
<td colspan="2"><span class="contact-left">
<label class="field prepend-icon">
<input name="website" type="text" class="gui-input" placeholder="Website:" id="website" value="<?php echo $rows_edit['website'];?>" size="40" />
<label for="cost" class="field-icon">  <i class="fa fa-globe"></i></label>
</label>

</span></td>
</tr>
<tr>
<td align="left">&nbsp;</td>
<td colspan="2"><button type="submit" class="button btn-primary" name="update_bizinfo">Update</button> </td>
</tr>
</table>
</form>
</div>
<div id="contact-info">

</div>
</div>
</div>
</div><!-- end subpage -->
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->

<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>


</div>

</div>

<?php include("../tools/side-menu_new.php");?>
<div class="clearfix"></div>
</div>

<div class="clearfix"></div>
</div>



</div>

</div>
<?php include('../tools/footer_new.php');?>
<script>
$(document).ready(function() {
$("#hamburger").click(function(e) {
$("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
$("#main-menu").toggleClass("mobile-hide");
});
$(".mobile-show > a").click(function(e) {
e.preventDefault();
$(this).parent().children("ul").toggle();
});

});
</script>
</body>
</html>