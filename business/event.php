<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
require_once("../app/classes/Helper.php");
use nigerianseminarsandtrainings\app\classes\Helper;
$helper = new Helper();
$message = '';
if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}
$errors = array();

reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}

$advert = "Add Event";
$_SESSION["email"] = $_SESSION["email_add"];

$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

$currentUser = "<strong>Event added by:</strong><br/> ".(isset($_SESSION['email']) && $_SESSION['email']!='' ? $_SESSION['email'] : '')." <br/>";
$visitorInfo =  "<div><b>Visitor IP address:</b><br/>" . $ip . "<br/>";
$visitorInfo .= "<b>Browser (User Agent) Info:</b><br/>" . $browser . "<br/></div>";
$addedBy = $currentUser.$visitorInfo;

if(isset($_POST['submit_event'])){
	
	$result = MysqlselectQuery("select * from businessinfo where business_name LIKE '".$_SESSION['name']."' ");
	$business_email = SqlArrays($result);
	
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$add_event[$key] = addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
        $eventBrochure = basename($_FILES["brochure"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", trimStringToFullWord(20, stripslashes(strip_tags(filter_input(INPUT_POST, 'title')))))).".".pathinfo(basename($_FILES["brochure"]["name"]),PATHINFO_EXTENSION): "";
        $brochureLink = "../event-brochures/".$eventBrochure;
        if($eventBrochure !=""){ 
            $brochFileType = pathinfo($eventBrochure, PATHINFO_EXTENSION);
            if(file_exists($brochureLink)) $errors[] = "Brochure already exists";
            if ($_FILES["brochure"]["size"] > 200000) $errors[] = "Brochure file is too large. It must be less than 200KB";
            if($brochFileType != "pdf" && $brochFileType != "doc" && $brochFileType != "docx") $errors[] = "Sorry, only MS-Word Documents and PDF files are allowed.";
        }
	if($_SESSION['name'] == "") $errors[] = "Enter your name of person making this entry";
	if($_SESSION['email'] == "") $errors[] = "Enter your email address";
	if(!smcf_validate_email($_SESSION['email'])) $errors[] = "Enter a valid email address";
	if($_SESSION['title'] == "") $errors[] = "Enter event title";
	if($_SESSION['description'] == "") $errors[] = "Enter event description";
	if($_SESSION['venue'] == "") $errors[] = "Enter event venue";
	if($_SESSION['category'] == "") $errors[] = "Select event category";
	if($_SESSION['country'] == "") $errors[] = "Select country";
	if($_POST['country'] == "38" && $_POST['state'] == "") $errors[] = "Select state in Nigeria";
        if($_POST['state'] == "25" && $_POST['division'] == "") $errors[] = "Select a Lagos division";
	if($_SESSION['start_date'] == "")$errors[] = "Select the start date";
	if($_SESSION['end_date'] == "") $errors[] = "Select end date";
	if($_SESSION['website'] == "") $errors[] = "Enter event website";
	if(!isValidURL($_SESSION['website'])) $errors[] = "Enter a valid url";
	if(count($errors) > 0){
		$message = ErrorCall($errors);
	}
	else{

		//$date = date("F j, Y");
            if($eventBrochure !=""){ move_uploaded_file($_FILES["brochure"]["tmp_name"], $brochureLink); }
		$date = date("Y-m-d");
		$StartDate = $_SESSION['start_date'];

		$NewStartDate = date("Y-m-d", strtotime($StartDate));
		
		$Start_Date = date("j F Y",strtotime($_SESSION['start_date']));
		$End_Date = date("j F Y",strtotime($_SESSION['end_date']));
		
		if(isset($_POST['premium'])) $val = $_POST['premium']; else $val = '';
		
	if(MysqlQuery("insert into events (name,email,phone,event_title,venue,description,facilitator,category,startDate,endDate,website,cost,organiser,posted_date,SortDate,country,state,user_id,makePremium,tags,deals,currency,comment,second_currency,second_cost,second_comment,third_currency,third_cost,third_comment,fourth_currency,fourth_cost,fourth_comment, vat, brochure, last_changed, changed_by, division)
										  values('".addslashes($_SESSION['name'])."','".$business_email['email']."','".$_SESSION['phone']."','".
											addslashes($_SESSION['title'])."','".addslashes($_SESSION['venue'])."','".addslashes($_SESSION['description'])."','".
											addslashes($_SESSION['facilitator'])."','".$_SESSION['category']."','".$Start_Date."','".$End_Date."','".
											$_SESSION['website']."','".$_SESSION['cost']."','".$business_email['business_name']."','$date','$NewStartDate','".
											$_POST['country']."','".$_POST['state']."','".$_SESSION['user_id']."','".$val."','".addslashes($_SESSION['tags'])."','".
											addslashes($_POST['deal'])."','".addslashes($_SESSION['currency'])."','".addslashes($_SESSION['comment'])."','".
											$_SESSION['second_currency']."','".$_SESSION['second_cost']."', '".$_SESSION['second_comment']."','".$_SESSION['third_currency']."','".
											$_SESSION['third_cost']."','".$_SESSION['third_comment']."','".$_SESSION['fourth_currency']."','".$_SESSION['fourth_cost']."','".
											$_SESSION['fourth_comment']."','".$_SESSION['vat']."','".$eventBrochure."', '".time()."', '".$addedBy."','".$_SESSION['division']."')")){
											
		AdminNotificationMail($_SESSION['title'],$business_email['business_name'],$date);
		reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	
	//unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['title']);
	unset($_SESSION['venue']);
	unset($_SESSION['description']);
	unset($_SESSION['facilitaotr']);
	unset($_SESSION['website']);
	unset($_SESSION['cost']);
	unset($_SESSION['organizer']);
        unset($_SESSION['vat']);
        unset($_SESSION['division']);
	header("location: event?stat=success");
			}
		}
	}

if(isset($_GET['stat'])){
	$message = '<div class="alert notification spacer-b30 alert-success">Event added successfully</div>';
}

?>
<!DOCTYPE html>

<html lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


<title>Add Event - Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>

<!--	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->
<?php include("../scripts/headers_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/js/additional-methods.js"></script>

<script type="text/javascript" src="../nstlogin/scripts/ckeditor/ckeditor.js"></script>


<script type="text/javascript">

/* @reload captcha
------------------------------------------- */			   


//script for the search calender
$(function() {
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
$("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
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
<?php include("../tools/header_new.php");?>

<div id="main">

<div id="content">
<?php include('menu.php');?>
<div id="content_left">
<div class="event_table_inner" style="float:left; width:97%; min-height:80px; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">

<tr>
<td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-calendar"></i>&nbsp; Add new event</h2></td>
<td width="21%" style="padding-left:8px">&nbsp;</td>
</tr>

</table>
</form>
</div>			
<div id="tab_slider">
<div id="subpage">

<div id="subpage_content">

<div id="contact-wrapper" class="rounded">
<div id="contact-wrapper-inner" class="rounded smart-forms">
<?php echo $message;?>
<form action="" method="post" id="eventForm"  enctype="multipart/form-data">
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
<script type="text/javascript">
CKEDITOR.replace( 'description' );
</script>
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
<td colspan="3" align="center">
<button type="submit" class="button btn-primary" name="submit_event">Submit</button> 
</td>
</tr>
</table>
</form>
<div id="listingAJAX"></div>
</div>
</div>

</div>
</div>

</div>
<!-- end subpage -->

</div>

<?php include("../tools/side-menu_new.php");?>
</div>



<div class="clearfix"></div>
</div>

<?php include("../tools/footer_new.php");?>
</div>
</div>
<script>
$(document).ready(function() {
$("form#eventForm #website").keyup(function(){ if (($(this).val().indexOf("http://") < 0) && $(this).val().indexOf("https://") < 0){ $(this).val("http://"+$(this).val()); } });
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