<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($subscribers);
	while (list ($key, $val) = each ($subscribers)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Subscribers";
require_once("scripts/insertions.php");	
if(isset($_GET['type']) && $_GET['type'] == 'success'){
	$message ='<div class="alert notification alert-success">Thank your for subscribing to our newsletter, a confirmation email has been sent to your mailbox, please check you spam box if you don\'t get it in your Inbox.</div>'; 
}
if(isset($_GET['auth']) && $_GET['auth'] == 'subscriber' && isset($_GET['return']) && !empty($_GET['return'])){
	$_SESSION['SubRedirectPath'] = $_GET['return'];
	$event = $_GET['event'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Subscribe - Nigerian Seminars and Trainings </title>
<meta name="description" content="Subscribe to Nigerian Seminars and Trainings to get the latest news and updates on events and learning opportunities around the world."/>
<?php include("scripts/headers_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-monthpicker.min.js"></script>
<script type="text/javascript">

function Get_Countries(){
		$.post("<?php echo SITE_URL;?>tools/countries.php",{country:$('form#subscriberForm #region').val()}, function(data) {
				$('form#subscriberForm #country').html(data)
		});
	}
function Get_States(){
	if($('form#subscriberForm #country').val() == 'Nigeria'){
		$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:38}, function(data) {
				$('form#subscriberForm #state').html(data)	
		});
		}
}


</script>
 <script type="text/javascript">
	
		$(function() {
			
			function reloadCaptcha(){
					$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
	});
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
						
				$( "#subscriberForm" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
							
						rules:{
				fname: {
				required:true,
				minlength: 2
				},
				lname: {
				required:true,
				minlength: 2
				},
				country: {
				required:true,
				},
				category: {
				required:true,
				},

				
				email_sub:{
					required: true,
					email:true
				},
				phone:{
					required: true,
				},
				securitycode:{
					required: true,
				},
				username:{
					required: true,
				},
				password:{
					required: true,
					minlength: 6,
					maxlength: 16
				
				},
				sex:{
					required: true,
				}
			},
						
						/* @validation error messages 
						---------------------------------------------- */
						messages:{
								fname: {
				required:'Please enter your first name',
				minlength: 'Your firstname must contain a minimum of 2 characters'
				},
				lname: {
				required:'Please enter your lastname',
				minlength: 'Your first name must contain a minimum of 2 characters'
				},
				country: {
				required:'Select country',
				},
				category: {
				required:'Selec category',
				},
				state: {
				required:'Select State',
				},
				email_sub:{
					required: true,
					email:true
				},
				phone:{
					required: 'Enter your telephone number',

				},
			
				securitycode:{
					required: 'Enter security code',
				},
				username:{
					required: 'Enter a username',
				},
				password:{
					required: 'Enter password',
					minlenght:'Password must be 6 characters and above'
				},
				sex:{
					required: 'Select your sex',
				},
				email_sub:{
					required: 'Enter an email address',
					email:'Enter a valid email address'
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
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;">Subscribe to our event notification / newsletters</h1> <h2 style="font-size:12px; margin-bottom:5px;">Fill this form to subscribe to our newsletter to get regular updates on events and breaking news as we post them on the website. A confirmation message will be sent to the email address you provided. Please visit your inbox to activate your subscription.</h2></td>
</tr>
<tr>
    <td style="font-size:11px"><h3>&nbsp;</h3></td>
</tr>
</table>
</div>
<div id="tab_slider">
<div id="subpage">
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
<?php echo $message;
if(isset($_POST['continue'])){
$_SESSION['email_sub'] = $_POST['subemail'];
$_SESSION['fname'] = $_POST['firstname'];
$_SESSION['lname'] = $_POST['lastname'];
}
?>
<form method="post" id="subscriberForm">
<table class="event_detail">
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="email_sub" type="text" class="gui-input" placeholder="Email Address" id="email_sub" value="<?php echo $_SESSION['email_sub'];?>" style="width:100%;" /><span class="field-icon"><i class="fa fa-suitcase"></i></span>  
</label>
</td>
</tr>
<tr>
<td style="text-align:right;"> <label class="field prepend-icon">
<input name="fname" type="text" class="gui-input" placeholder="Firstname" id="fname" value="<?php echo $_SESSION['fname'];?>" size="40" /><span class="field-icon"><i class="fa fa-user"></i></span>  
</label></td>
<td>
<label class="field prepend-icon">
<input name="lname" type="text" class="gui-input" placeholder="Lastname" id="lname" value="<?php echo $_SESSION['lname'];?>" size="40" /><span class="field-icon"><i class="fa fa-user"></i></span>  
</label>
</td>
</tr>

<tr>
<td style="text-align:right;"><label class="field prepend-icon">
<input name="username" type="text" class="gui-input" placeholder="Username" id="username" value="<?php echo $_SESSION['username'];?>" size="40" /><span class="field-icon"><i class="fa fa-user"></i></span>  
</label></td>
<td> 
<label class="field prepend-icon">
<input name="password" type="password" class="gui-input" placeholder="Password" id="password" value="" size="40" />
<span class="field-icon"><i class="fa fa-lock"></i></span>  
</label>
</td>
</tr>
<tr>
<td style="width:46%;">
<div class="option-group field">
<label for="female" class="option block">
<input type="radio" name="sex" id="female" value="female">
<span class="radio"></span> Female 
</label>
</div>
</td>
<td style="width:50%;"> 
<div class="option-group field">
<label for="male" class="option block spacer-t10">
<input type="radio" name="sex" id="male" value="male">
<span class="radio"></span> Male 
</label>
</div>
</td>
</tr>
<tr>
<td colspan="2">
<label class="field prepend-icon">
<input name="phone" type="text" class="gui-input" placeholder="Telephone" id="phone" value="<?php echo $_SESSION['phone'];?>" size="40" /><span class="field-icon"><i class="fa fa-phone"></i></span>  
</label>
</td>
</tr>
<tr>
<td  colspan="2"> <label class="field prepend-icon">
<input name="organization" type="text" class="gui-input" placeholder="Organization" id="organization" value="<?php echo $_SESSION['organization'];?>" size="40" /><span class="field-icon"><i class="fa fa-building-o"></i></span>  
</label></td>
</tr>
<tr>
<td colspan="2"> <label class="field prepend-icon">
<input name="designation" type="text" class="gui-input" placeholder="Designation" id="designation" value="<?php echo $_SESSION['designation'];?>" size="40" /><span class="field-icon"><i class="fa fa-asterisk"></i></span>  
</label></td>
</tr>
<tr>
<td colspan="2"> <label class="field prepend-icon">
<input name="address" type="text" class="gui-input" placeholder="Address" id="address" value="<?php echo $_SESSION['address'];?>" size="40" /><span class="field-icon"><i class="fa fa-home"></i></span>  
</label></td>
</tr>
<tr>
<td colspan="2"> <label class="field prepend-icon">
<input name="city" type="text" class="gui-input" placeholder="City" id="city" value="<?php echo $_SESSION['city'];?>" size="40" /><span class="field-icon"><i class="fa fa-building-o"></i></span>  
</label></td>
</tr>
<tr>
<td colspan="2">
<label class="field select">
<select name="country" id="country" onChange="Get_States()">
<option value="">Select Country </option>
<?php if(connection());
$result = MysqlSelectQuery("select * from countries order by countries");?>
<?php while ($rows = SqlArrays($result)){?>
<option value="<?php echo $rows['countries'];?>"><?php echo $rows['countries'];?></option>
<?php
}
?>
</select>
<i class="arrow double"></i>
</label>
</td>
</tr>
<tr>
<td  colspan="2"><span class="contact-left">
<label class="field select">
<select name="state" id="state"  >
<option value="">Select State (For Nigeria only)</option>
</select>
<i class="arrow double"></i>
</label>
</span></td>
</tr>
<tr>
<td colspan="2"><label class="field select">
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
</label></td>
</tr>
<tr>
<td colspan="2">
<div class="smart-widget sm-left sml-120">
<label class="field">
<input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
</label>
<span class="button captcode">
<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha">
<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
</span>
</div>
</td>

</tr>

<tr>
<td style="text-align:center;" colspan="2">
<input name="addToCal" type="hidden" value="<?php echo @$event;?>">
<button type="submit" class="button btn-primary" name="submit_subscriber">Submit</button> 
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
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
</div>
<?php //include("tools/categories.php");?>	
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