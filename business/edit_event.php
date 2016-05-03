<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
require_once("../app/classes/Helper.php");
use nigerianseminarsandtrainings\app\classes\Helper;
$helper = new Helper();
$message = '';
	if(connection());
	if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}
$advert = "Add Event";

$errors = array();

$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

$currentUser = "<strong>Event edited by:</strong><br/> ".(isset($_SESSION['email']) && $_SESSION['email']!='' ? $_SESSION['email'] : '')." <br/>";
$visitorInfo =  "<div><b>Visitor IP address:</b><br/>" . $ip . "<br/>";
$visitorInfo .= "<b>Browser (User Agent) Info:</b><br/>" . $browser . "<br/></div>";
$editedBy = $currentUser.$visitorInfo;

if(isset($_GET['val'])) $id=$_GET['val'];
if(isset($_POST['update'])){
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$add_event[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$add_event[$key] = NULL;
		else
			$add_event[$key] = $val;
	}
        $oldBrochure = $_POST['oldBrochure'];
        $oldBrochureLink = "../event-brochures/".$oldBrochure;
        $eventBrochure = basename($_FILES["brochure"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", trimStringToFullWord(20, stripslashes(strip_tags(filter_input(INPUT_POST, 'title')))))).".".pathinfo(basename($_FILES["brochure"]["name"]),PATHINFO_EXTENSION): "";
        $brochureLink = "../event-brochures/".$eventBrochure;
        if($eventBrochure !=""){ 
            $brochFileType = pathinfo($eventBrochure, PATHINFO_EXTENSION);
            if(file_exists($brochureLink)) $errors[] = "Brochure already exists";
            if ($_FILES["brochure"]["size"] > 200000) $errors[] = "Brochure file is too large. It must be less than 200KB";
            if($brochFileType != "pdf" && $brochFileType != "doc" && $brochFileType != "docx") $errors[] = "Sorry, only MS-Word Documents and PDF files are allowed.";
        }
	if($add_event['name'] == "")$errors[] = "Please enter event title";
	if($add_event['title'] == "")$errors[] = "Please enter event title";
	if($add_event['description'] == "")$errors[] = "Please enter event description";
	if($add_event['venue'] == "")$errors[] = "Please enter event venue";
	if($add_event['category'] == "")$errors[] = "Please select event category";
	if($add_event['start_date'] == "")$errors[] = "Please select the start date";
	if($add_event['end_date'] == "")$errors[] = "Please select end date";
	if($add_event['website'] == "")$errors[] = "Please enter event website";
	if(!isValidURL($add_event['website']))$errors[] = "Please enter a valid url";
	if(count($errors) > 0){
		$message = ErrorCall($errors);
	}
	else{
		if($eventBrochure !=""){ 
                    move_uploaded_file($_FILES["brochure"]["tmp_name"], $brochureLink); 
                    if($oldBrochure !="" && file_exists($oldBrochureLink)) unlink ($oldBrochureLink);
                }
                else{ $eventBrochure = $oldBrochure;}
		$date = date("F j, Y");
		$StartDate = $add_event['start_date'];
		$Start_Date = date("j F Y",strtotime($add_event['start_date']));
		$End_Date = date("j F Y",strtotime($add_event['end_date']));
        if($_SESSION['user_id'] != 0){
            $result = MysqlselectQuery("select * from businessinfo where user_id='".$_SESSION['user_id']."'");
            $businessDetail = SqlArrays($result);

            $NewStartDate = date("Y-m-d", strtotime($StartDate));
            if(MysqlQuery("update events set name='".$add_event['name']."',email='".$businessDetail['email']."',phone='".$add_event['phone']."',event_title='".$add_event['title']."',venue='".
                $add_event['venue']."',description='".$add_event['description']."',category='".$add_event['category']."',startDate='".$add_event['start_date']."',endDate='".$add_event['end_date']."',website='".
                $add_event['website']."',cost='".$add_event['cost']."',organiser='".$businessDetail['business_name']."',facilitator='".$add_event['facilitator']."',country='".$_POST['country']."',state='".
                @$_POST['state']."',SortDate='$NewStartDate' ,tags='".addslashes($_POST['tags'])."',deals='".$_POST['deal']."', currency='".$_POST['currency']."',comment='".
                $_POST['comment']."',second_currency='".$_POST['second_currency']."',second_cost='".$_POST['second_cost']."',second_comment='".$_POST['second_comment']."',third_currency='".
                $_POST['third_currency']."',third_cost='".$_POST['third_cost']."',third_comment='".$_POST['third_comment']."',fourth_currency='".
                $_POST['fourth_currency']."',fourth_cost='".$_POST['fourth_cost']."',fourth_comment='".$_POST['fourth_comment']."',vat='".$_POST['vat']."',brochure='".$eventBrochure."', last_changed = '".time()."', changed_by = '".$editedBy."', division ='".$_POST['division']."' where event_id='".$_GET['val']."' and user_id='".$_SESSION['user_id']."'")){
                $message = '<div class="alert notification spacer-b30 alert-success">Event updated successfully</div>';
            }
        }
    }
	
}
$result = MysqlSelectQuery("select * from events where event_id = '$id' and user_id='".$_SESSION['user_id']."'");
	$rows = SqlArrays($result);
	
	$resultCategory = MysqlSelectQuery("select * from categories where category_id = '".$rows['category']."'");
	$rowsCategory = SqlArrays($resultCategory);
	
	$resultCountry = MysqlSelectQuery("select * from countries where id = '".$rows['country']."'");
	$rowsCountries = SqlArrays($resultCountry);
	
	$resultState = MysqlSelectQuery("select * from states where id_state = '".$rows['state']."'");
	$rowsState = SqlArrays($resultState);
        
        $resLagosDivions = MysqlSelectQuery("SELECT * FROM lagos_divisions WHERE id = '".$rows['division']."' ");
        $rowsLagosDivions = SqlArrays($resLagosDivions);
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


<title>Edit event: Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>


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
$(this).datepicker( "option", "minDate", selectedDate );
}
});

$("#end_date").datepicker({
defaultDate: "+1w",
changeMonth: false,
numberOfMonths: 1,
prevText: '<i class="fa fa-chevron-left"></i>',
nextText: '<i class="fa fa-chevron-right"></i>',			
onClose: function( selectedDate ) {
$(this).datepicker( "option", "maxDate", selectedDate );
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
$.post("<?php echo SITE_URL;?>tools/countries.php",{country:$('form#eventForm1 #region').val()}, function(data) {
$('form#eventForm1 #country').html(data)



});
}
function Get_States(){
if($('form#eventForm1 #country').val() == 38){
$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:$('form#eventForm1 #country').val()}, function(data) {
$('form#eventForm1 #state').html(data)

});
}
}
function getLagosDivisions(){
if($('form#eventForm1 #state').val() == 25){
$.post("<?php echo SITE_URL;?>tools/countries.php",{LagosDivisons:'True'}, function(data) {
$('form#eventForm1 #division').html(data)
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
<style>
.formTable td{
padding:5px;
font-size:12px;
}
</style>

</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header_new.php");?>

<div id="main">

<div id="content">
<?php include("menu.php");?>
<div id="content_left">

<div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">

<tr>
<td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-calendar"></i>&nbsp; Edit event</h2></td>
<td width="21%" style="padding-left:8px">&nbsp;</td>
</tr>

</table>
</form>
</div>			


<div id="tab_slider">
<div id="subpage">

<div id="subpage_content">
<?php 
if($rows['user_id'] != $_SESSION['user_id']) {
?>
<div id="contact-wrapper" class="rounded">
<div id="contact-wrapper-inner" class="rounded" style="background-color:#FFDDE6; color:#C20110;">

<table width="100%" >
<tr>
<td height="44" align="left" style="font-size:16px">Error! page not available, <a href="<?php echo SITE_URL;?>user/posted_events">click here</a> to go back</td>
</tr>
</table>
</div>
</div>
<?php
}
else{
?>

<div id="contact-wrapper" class="rounded">
<div id="contact-wrapper-inner" class="rounded smart-forms">
<?php echo $message;?>
<form action="" method="post" id="eventForm1" class="formTable" enctype="multipart/form-data">
<table width="100%">
<tr>
<td align="left">Name:</td>
<td><label class="field prepend-icon">
<input name="name" type="text" class="gui-input" placeholder="Name (person making the entry)" id="name" value="<?php echo $rows['name'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  </td>
</tr>
<tr>
<td width="21%" align="left"><span class="contact-left">Event Title: <span style="color:#F00"> * </span></span></td>
<td width="30%">
<label class="field prepend-icon">
<input name="title" type="text" class="gui-input" id="title" value="<?php echo $rows['event_title'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i>
</label>  
</td>
</tr>
<tr>
<td align="left"><span class="contact-left">Phone No: </span></td>
<td>
<label class="field prepend-icon">
<input name="phone" type="text" class="gui-input" value="<?php echo $rows['phone'];?>" id="phone" size="40" />
<label class="field-icon"><i class="fa fa-user"></i></label>  
</td>
</tr>
<tr align="left">
<td colspan="3" valign="top"><span class="contact-left">Event Description: <span style="color:#F00"> * </span></span></td>
</tr>
<tr align="left">
<td colspan="3" valign="top">
<label for="description" class="field prepend-icon">
<textarea name="description" id="description" style="width: 100%; height: 100px;" class="gui-textarea"><?php echo $rows['description'];?></textarea>
<script type="text/javascript">
CKEDITOR.replace( 'description' );
</script>
<label for="description" class="field-icon"><i class="fa fa-comment"></i>
</label>  
</td>
</tr>
<tr>
<td align="left"><span class="contact-left">Facilitator(s): <span style="color:#F00"> * </span></span></td>
<td >
<label for="facilitator" class="field prepend-icon">
<textarea name="facilitator" id="facilitator" class="gui-textarea"  placeholder="Facilitator/s" ><?php echo $rows['facilitator'];?></textarea>
<label for="facilitator" class="field-icon"><i class="fa fa-anchor"></i>
</label>  
</td>
</tr>
<tr>
<td align="left" valign="top"><span class="contact-left">Event Venue: <span style="color:#F00"> * </span></span></td>
<td>
<label for="venue" class="field prepend-icon">
<textarea name="venue" id="venue" style="width: 350px; height: 100px;" class="gui-textarea"><?php echo $rows['venue'];?></textarea>
<label for="venue" class="field-icon"><i class="fa fa-home"></i>
</label>  
</td>
</tr>
<tr>
<td align="left">Event Category: <span style="color:#F00"> * </span></td>
<td>
<label class="field select">
<select name="category" id="category" >
<option value="<?php echo $rows['category'];?>" selected="selected"><?php echo $rowsCategory['category_name'];?></option>
<?php 
if(connection());
$result_cat = MysqlSelectQuery("select * from categories order by category_name");?>
<?php while ($rows_cat = SqlArrays($result_cat)){
if ($rows['category'] == $rows_cat['category_id']);
?>
<option value="<?php echo $rows_cat['category_id'];?>"><?php echo $rows_cat['category_name'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td align="left">Region <span style="color:#F00"> * </span></td>
<td>
<label class="field select">
<select name="region" id="region"  onchange="Get_Countries()">
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
<td align="left">Country <span style="color:#F00"> * </span></td>
<td>
<label class="field select">
<select name="country" id="country"  onchange="Get_States()">
<option value="<?php echo $rowsCountries['id'];?>" selected="selected"><?php echo $rowsCountries['countries'];?></option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr >
<td align="left">State</td>
<td>
<label class="field select">
<select name="state" id="state" onchange="getLagosDivisions()" >
<option value="<?php echo $rowsState['id_state'];?>" selected="selected"><?php echo $rowsState['name'];?></option>
</select>
<i class="arrow double"></i>
</label>
(For Nigeria only)
</td>
</tr>
<tr>
<td align="left">Lagos Division:</td>
<td>
<label class="field select">
<select name="division" id="division"  >
<option value="<?php echo $rowsLagosDivions['id'];?>" selected="selected"><?php echo $rowsLagosDivions['name'];?></option>
</select>
<i class="arrow double"></i>
</label>
(For Lagos State only)
</td>
</tr>
<tr>
<td>First payment option</td>
</tr>
<tr id="fee">
<td width="25%">
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="currency" id="currency" required>
<option value="<?php echo $rows['currency'];?>" selected="selected"><?php echo $rows['currency'];?></option>
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
<td id="price" width="25%">
<label class="field prepend-icon" >
<input name="cost" type="number" class="gui-input" value="<?php echo $rows['cost'];?>" />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment" width="50%">
<label class="field prepend-icon" >
<input name="comment" type="text" class="gui-input" value="<?php echo $rows['comment'];?>"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr>
<td>Second payment option</td>
</tr>
<tr id="fee">
<td style="width: 25%">
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="second_currency" id="currency">
<option value="<?php echo $rows['second_currency'];?>" selected="selected"><?php echo $rows['second_currency'];?></option>
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
<td id="price" style="width: 25%">
<label class="field prepend-icon" >
<input name="second_cost" type="number" class="gui-input" value="<?php echo $rows['second_cost'];?>"   />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment" style="width: 50%">
<label class="field prepend-icon" >
<input name="second_comment" type="text" class="gui-input" value="<?php echo $rows['second_comment'];?>"   />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr>
<td>Third payment option</td>
</tr>
<tr id="fee">
<td>
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="third_currency" id="currency">
<option value="<?php echo $rows['third_currency'];?>" selected="selected"><?php echo $rows['third_currency'];?></option>
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
<input name="third_cost" type="number" class="gui-input" value="<?php echo $rows['third_cost'];?>"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment">
<label class="field prepend-icon" >
<input name="third_comment" type="text" class="gui-input" value="<?php echo $rows['third_comment'];?>"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr>
<td>Fourth payment option</td>
</tr>
<tr id="fee">
<td>
<div id="currency" style="width: 150px; margin-right: -18px;">
<label class="field select">
<select name="fourth_currency" id="currency">
<option value="<?php echo $rows['fourth_currency'];?>" selected="selected"><?php echo $rows['fourth_currency'];?></option>
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
<input name="fourth_cost" type="number" class="gui-input" value="<?php echo $rows['fourth_cost'];?>"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
<td id="comment">
<label class="field prepend-icon" >
<input name="fourth_comment" type="text" class="gui-input" value="<?php echo $rows['fourth_comment'];?>"  />
<span class="field-icon">  <i class="fa fa-money"></i></span>
</label>
</td>
</tr>
<tr class="pay-option">
<td>Apply Value Added Tax (VAT):</td>

<td>
<label class="field select">
<select name="vat" id="vat">
<option <?php echo ($rows['vat']=='yes') ? 'selected="selected"': ''; ?> value="yes">YES</option>
<option <?php echo ($rows['vat']=='no') ? 'selected="selected"': ''; ?> value="no">NO</option>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td align="left"><span class="contact-left">Start Date: <span style="color:#F00"> * </span></span></td>
<td>
<label class="field prepend-icon">
<input name="start_date" type="text" class="gui-input" placeholder="Select Start Date" id="start_date"   value="<?php echo $rows['startDate'];?>" readonly />
<label class="field-icon"><i class="fa fa-calendar"></i></label>  
</label>
</td>
</tr>
<tr>
<td align="left"><span class="contact-left">End Date: <span style="color:#F00"> * </span></span></td>
<td>
<label class="field prepend-icon">
<input name="end_date" type="text" class="gui-input" placeholder="Select End Date" id="end_date"   value="<?php echo $rows['endDate'];?>" readonly />
<label class="field-icon"><i class="fa fa-calendar"></i></label>  
</label>
</td>
</tr>
<tr class="pay-option">
<td>Course Brochure (optional):</td>

<td>
<label class="field prepend-icon">
<input name="brochure" id="brochure" class="gui-input" id="brochure" type="file" size="40" />
<input name="oldBrochure" id="oldBrochure" type="hidden" value="<?php echo $rows['brochure']; ?>" />
<span class="field-icon"><i class="fa fa-file"></i></span>  
</label>
    <p><em style="color:red;"><?php echo ($rows['brochure'] !='') ? 'Current Brochure: <a href="'.SITE_URL.'event-brochures/'.$rows['brochure'].'">Download/View</a>' : '';?></em></p>
</td>
</tr>
<tr>
<td align="left"><span class="contact-left">Event  url: <span style="color:#F00"> * </span></span></td>
<td>
<span class="contact-left">
<label class="field prepend-icon">
<input name="website" type="text" class="gui-input" value="<?php echo $rows['website'];?>" id="website" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
</span>
</td>
</tr>
<tr>
<td align="left">Tags</td>
<td>
<span class="contact-left">
<label class="field prepend-icon">
<input name="tags" type="text" class="gui-input" value="<?php echo $rows['tags'];?>" id="tags" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
</span>
</td>
</tr>
<tr>
<td align="left">Deal / Discounts / Offers</td>
<td><textarea name="deal" id="deal" class="gui-textarea"  placeholder="Deal / Discounts / Offers" ><?php echo $rows['deals'];?></textarea></td>
</tr>
<tr>
<td align="left"></td>
<td>
<button type="submit" class="button btn-primary" name="update">Submit</button> 
</td>
</tr>
</table>
</form>
<div id="listingAJAX"></div>
</div>
</div>
<?php
}
?>
</div>
</div>

</div>
<!-- end subpage -->

</div>

<?php include("../tools/side-menu_new.php");?>
</div>


<div class="clearfix"></div>
</div>
<?php include('../tools/footers_new.php');?>
</div>
</div>
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