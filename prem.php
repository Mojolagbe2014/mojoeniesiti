<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
if(isset($_SESSION['user_id'])){
    $result = MysqlSelectQuery("select * from businessinfo where user_id='".$_SESSION['user_id']."' ");
    $rows = SqlArrays($result);
}
$advert = "Advertise";
$message = '';
reset ($payments);
while (list ($key, $val) = each ($payments)) {
    if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
    if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
}

if(isset($_POST['submit_payment'])){
    reset ($_POST);
    while (list ($key, $val) = each ($_POST)) {
    if ($val == "") $val = "NULL";
    $payments[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
    if ($val == "NULL")
    $_SESSION[$key] = NULL;
    else
    $_SESSION[$key] = $val;
    }

    if($_SESSION['business_name'] == "")$message = errorMsg("Please enter your business name");
    else if($_SESSION['contact_person'] == "")$message = errorMsg("Please enter contact person");
    else if($_SESSION['email'] == "")$message = errorMsg("Please enter your email address");
    else if(!smcf_validate_email($_SESSION['email']))$message = errorMsg("Please enter a valid email address");
    else if($_SESSION['business_type'] == "")$message = errorMsg("Please enter select business type");
    else if($_SESSION['plan'] == "")$message = errorMsg("Please enter select subscription plan");
    else if($_SESSION['teller_no'] == "")$message = errorMsg("Please enter your teller no");
    else if($_SESSION['amount_deposited'] == "")$message = errorMsg("Please enter the amount deposited");
    else if($_SESSION['date_deposit'] == "")$message = errorMsg("Please enter the date of deposit");
    else{
        MysqlQuery("insert into payment (business_name,contact_person,email,business_type, plan,teller_no,amount_deposited,date_posted,payment_type,payment_date) values('".$_SESSION['business_name']."','".$_SESSION['contact_person']."','".$_SESSION['email']."','".$_SESSION['business_type']."','".$_SESSION['plan']."','".$_SESSION['teller_no']."','".$_SESSION['amount_deposited']."','".$_SESSION['date_deposit']."','Bank Deposit','".date("Y-m-d")."')");
        reset ($payments);
        while (list ($key, $val) = each ($payments)) {
            if (isset($_SESSION[$key])) $_SESSION[$key] = "";
        }
        header("location: premium-confirmation");
    }
}
$title = "Premium Listing - Nigerian Seminars and Trainings";
$meta_description = "Give your business, training and seminars a boost - subscribe to Premium Listing";

//payment 
 	$myamount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
 	$phone = filter_input(INPUT_POST, 'phone', FILTER_VALIDATE_INT);
  $cust_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $customer_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  $business_name = $business_type = filter_input(INPUT_POST, 'business_name', FILTER_SANITIZE_SPECIAL_CHARS);
  $business_type = filter_input(INPUT_POST, 'business_type', FILTER_SANITIZE_SPECIAL_CHARS);
  $plan = filter_input(INPUT_POST, 'plan', FILTER_SANITIZE_SPECIAL_CHARS);
  $pro_email = "info@kaisteventures.com";
  $pro_name = "Kaiste Ventures";
  $txn_ref = "NST".rand(10000, 10000000);
  $cust_id = "898837";
  $currency = 566;
  $product_id = 5791;
  $pay_item_id = 101;
  $pay_item_name = "Advanced Management and Administrative Course for Secretaries and Personal Assistant";
  $company_name =  "Kaiste Ventures Limited";
  $redirect_to  = "https://www.nigerianseminarsandtrainings.com/payment?pid=".base64_encode($product_id)."&amt=".  base64_encode($myamount)."&cust_email=". base64_encode($cust_email) ."&cust_name=". base64_encode($customer_name) ."&pro_email=". base64_encode($pro_email) ."&pro_name=". base64_encode($pro_name) ."&phone=".base64_encode($phone)."&business_name=".  base64_encode($business_name)."&business_type=". base64_encode($business_type) ."&plan=". base64_encode($plan) ."&";
  $site_name = "www.kaisteventures.com";
  $mackey = "27ED7ACA287A0364501B13841B70F72430E9DEA4F55C9278C1E28006EA236BF28B7C11A7F1CCCACA7EC72AB0B692B23A090A54729D75923118B8799A4F100EF1";
  $unsave_hash = $txn_ref.$product_id.$pay_item_id.$myamount.$redirect_to.$mackey;
  $save_hash = hash("sha512", $unsave_hash, false);
  //end payment
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_description;?>"/>
<meta name="keywords" content="<?php echo $meta_description;?>" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />

<?php include("scripts/headers_new.php");?>
<link type="text/css" rel="stylesheet" href="css/currency.green.css">
<link rel="stylesheet" type="text/css"  href="css/pricing-tabled-light.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script>

$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('.modal').click(function(e) {
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
	$('.window .closeBox').click(function (e) {
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
	
	$("#date_deposit").datepicker({
					defaultDate: "+1w",
					changeMonth: false,
					numberOfMonths: 1,
					prevText: '<i class="fa fa-chevron-left"></i>',
					nextText: '<i class="fa fa-chevron-right"></i>',
					onClose: function( selectedDate ) {
						$( "#end_date" ).datepicker( "option", "minDate", selectedDate );
					}
				});
				
				function reloadCaptcha(){
					$("#captcha_premium").attr("src","tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
	});
	
});

function ErrorMsg(msg){
	$("#msgbox").removeClass('alert-success alert-info').addClass('alert-error').html(msg).show();
			$("#msgbox").fadeOut(3000);
			return false;
}

$(document).ready(function()
{
	$(".paypal").click(function(){
			$('#PremiumListing').fadeOut('slow');
			$('#paypal').fadeIn('slow');
		})
	
	
	$("#PremiumListing .btn-primary").click(function()
	{
		var Interval = null;
		
		if($('#name').val() == ''){
		ErrorMsg('Please enter your business name');
			return false;
			
		}
		if(isNaN($('#contact_person').val())){
			ErrorMsg("Please enter a valid contact person's number");
			
			return false;
		}
		else if ($('#email_pre').val() == ''){
			ErrorMsg("Please enter your email");
			
			return false;
		}
		
		else if ($('#buz_type').val() == ''){
			ErrorMsg("Please select business type");
			
			return false;
		}
		
		else if ($('#plan').val() == ''){
			ErrorMsg("Please select plan");
			
			return false;
		}
		else if ($('#teller_no').val() == ''){
			ErrorMsg("Please enter your teller number");
			
			return false;
		}
		else if ($('#amount_deposited').val() == ''){
			ErrorMsg("Please enter amount that was paid");
			
			return false;
		}
		else if ($('#date_deposit').val() == ''){
			ErrorMsg("Please enter payment date");
			
			return false;
		}
		else if ($('#securitycode_premium').val() == ''){
			ErrorMsg("Please enter security code");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass('alert-error alert-success').addClass('alert-info').html('Sending message....').show();
		//check the username exists or not from ajax
		$.post("tools/premium_listing.php",{ business_name:$('#name').val(),email:$('#email_pre').val(),contact_person:$('#contact_person').val(),type:$('#buz_type').val(),plan:$('#plan').val(),teller:$('#teller_no').val(),deposited:$('#amount_deposited').val(),date_deposit:$('#date_deposit').val(),securitycode:$('#securitycode_premium').val()},function(data)
        {
		  if(data=='correct') //if correct login detail
		  {
		  	$("#msgbox").removeClass('alert-error alert-info').addClass('alert-success').fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('<p style="color:#000; font-size:14px">Thank you, your subscription will be activated within 24 hrs or after your payment has been verrified.</p><p style="color:#000; font-size:14px">You will also recieve a mail from us confirming your subscription status and login  details</p>').removeClass('alert-info').addClass('alert-success').fadeTo(900,1);
			  $('#name').val("");
			  $('#email_pre').val("");
			  $('#contact_person').val("");
			  $('#buz_type').val("");
			  $('#phone').val("");
			  $('#plan').val("");
			  $('#teller_no').val("");
			  $('#amount_deposited').val('');
			  $('#date_deposit').val('');
			});
		
			Interval =  setInterval(function(){
			$('#mask').fadeOut('slow');
			$('.window').fadeOut('slow');
			$("#msgbox").fadeOut('slow');
			},3000)
			
		  }
		  else if(data=='security'){
			  ErrorMsg("Invalid security code!");
			  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Error submiting your request!').removeClass('alert-info alert-success').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
          }
				
        });
		clearInterval(Interval);
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
});
$(document).ready(function() {	

	$('a[class=currency]').click(function(e) {
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
		
		$('#amount').val('200');
	
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
function Close(){
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
}
function GetRate(val){
	$('#price_pre').text(val)
		$('#price_premium').show();
}
</script>
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
.window_currency {
  position:fixed;
  left:0;
  top:0;
  width:200px;
  z-index:9999;
  padding:20px;
  display:none;
}
  
.window {
  position:fixed;
  left:0;
  top:0;
  width:500px; 
  z-index:9999;
  padding:20px;
 /* display:none;*/
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
.premium_bg{
	background-image: url(images/premiumbg.png);
	background-repeat: no-repeat;
	background-position: center center;	
}
-->
</style>
</head>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table >
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:25px; padding:5px;">Subscribe to Premium Listing</h1></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</form>
</div>

<div id="subpage">
<div id="subpage_content" >
<p style="padding:10px;font-size:13px;">
<strong style="font-size:14px;">Give your  business and events a boost!</strong> Upgrade to Premium or Value Listing. Upgrading will allow  your business to benefit from the many advantages of a Premium Listing, which  are: -</p>
<ul class="formart" style="padding-left:10px; font-size:13px;">
<li>Your listing can display a  Google Map, which will allow your users to easily find your business</li>
<li>Your listing will be displayed  at the top of the homepage search results page, which provides more exposure to  users and the search engines</li>
<li>Your listing will be  highlighted in the search results page, making it stand out from the  competition</li>
<li>Your listing will be displayed  with special HTML tags (H2 headings) which will provide more exposure to Google  and the other search engines.</li>
<li>Your listing will display your brand image / company logo.</li>
</ul>


<div class="highlights">
<h2 style="font-size:22px;font-weight:normal">Premium Listing Plans</h2></div>
<div class="pricing two green_tab">

<!--price box column-->
<div class="price-col first"> 
	<div class="th">
	<h3 style="font-size:13px;font-weight:normal"><span class="title"><strong>Value Listing</strong>  Plan </span></h3>
	<span class="bottom"></span>
	</div>
	<div class="p-inner">
		<ul class="feature">
		    <li class="odd">Text Listing </li>
		    <!--<li class="odd">Link to website</li>-->
		    <li>Google Map</li>
		    <li class="odd">Image / Logo</li>
		    <li>1 Premium Events</li>
			<li>Self Edit</li>

			<li class="odd price-tag">NGN 66,570 / Yr  <a href="#currency" class="currency" onclick="GetRate('NGN 66,570')" style="padding-left:30px; font-size:14px;">Convert</a></li>

		</ul>
	<span class="call-action">
		<a class="csbutton modal" href="#contact-wrapper4" name="modal">Pay with Interswitch</a>
		<a class="csbutton modal" href="#contact-wrapper2" >Pay with Teller or Paypal</a>
	</span>
	</div>
</div>													

<!--price box column-->
<div class="price-col last">
	<div class="th">
	<h3 style="font-size:13px;font-weight:normal"><span class="title"><strong>Premium Listing</strong>  Plan </span></h3>
	<span class="bottom"></span>
	</div>
	<div class="p-inner">
	<ul class="feature">
	<li class="odd">Text Listing </li>
	<!--<li class="odd">Link to website</li>-->
	<li>Google Map</li>
	<li class="odd">Image / Logo</li>
	<li>2 Premium Events</li>
	<li class="odd">Self Edit</li>
	<li>Quarterly Guide Listing</li>
	<li class="odd">Event listed in subscribers newsletter</li> 
	<li class="price-tag">NGN 100,000 / Yr <a href="#currency" class="currency" onclick="GetRate('NGN 100,000')" style="padding-left:30px; font-size:14px;">Convert</a></li>
	</ul>
	<span class="call-action">
	<a class="csbutton modal" href="#contact-wrapper5" name="modal">Pay with Interswitch</a>
	<a class="csbutton modal" href="#contact-wrapper3" >Pay with Teller or Paypal</a>
	</span>
	</div>
	</div>
</div>
<p style="color:#FF0000; font-size:14px;">N.B: Additional event subscription is <strong>NGN 5,000 per event per month</strong> and is only available for existing premium or value listing subscribers.</p>
<div id="mask"></div>

<div id="currency" style="float:left;" class="window_currency boxContent">
<div id="currency-widget"></div>
</div>
<!--contact-wrapper2 -->
<div id="contact-wrapper2" style="float:left; width:700px;" class="window boxContent">

	<?php //echo $message;?>

	<div class="smart-forms" style="width:100%;">

		<form action="#" method="post" id="PremiumListing">

		<table style="width:100%;" class="premium2">
		<tbody>

		<tr>
		<td ><div class="notification alert-info spacer-t10" style="width:100%; display:none;" id="msgbox"></div></td>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td style="text-align:center;"><strong>Bank Account Information</strong></td>
		<td style="float:right;"><a href="#" class="closeBox">Close</a></td>
		</tr>
		<tr>
		<td style="width:50%;">Account Name:</td>
		<td >KAISTE VENTURES LIMITED</td>
		</tr>
		<tr>
		<td>Bank:</td>
		<td>GTBank</td>
		</tr>
		<tr>
		<td>Account Number:</td>
		<td >0176251728</td>
		</tr>
		<tr>
		<td>Account Sort code (for internet transfer)</td>
		<td>058152638</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td >&nbsp;</td>
		</tr>
		<tr>

		<td><label class="field prepend-icon">
		<input name="business_name" type="text" class="gui-input" placeholder="Business Name" id="name" value="<?php echo $_SESSION['business_name'];?>" required />
		<span id="output_premium"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image" width="20" height="14" style="text-align:center" /></span>
		<span class="field-icon"><i class="fa fa-suitcase"></i>
		</span>  
		</label>          </td>
		<td style="width:100%;"><label class="field prepend-icon">
		<input name="contact_person" type="text" class="gui-input" placeholder="Contact Person's Phone:" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" size="40" required />
		<span class="field-icon"> <i class="fa fa-user"></i></span>
		</label></td>
		</tr>
		<tr>
		<td>
		<label class="field prepend-icon">
		<input name="email" type="email" class="gui-input" placeholder="Email" id="email_pre" value="<?php echo $_SESSION['email'];?>" size="40" required /><span class="field-icon"><i class="fa fa-envelope"></i></span>  
		</label>          
		</td>
		<td><label class="field select">
		<select name="buz_type" id="buz_type" >
		<option selected="selected" value="">Select Business Type</option>
		<option value="Training">Training Provider</option>
		<option value="Managers">Event Managers</option>
		<option value="Suppliers">Event Equipment Supplier</option>
		<option value="Venue">Venue Provider</option>
		</select>
		<i class="arrow double"></i>
		</label> </td>
		</tr>

		<tr>
		<td style="width:auto;">
		<label class="field select">
		<select name="plan" id="plan">
		<option value="<?php echo $_SESSION['plan'];?>" selected="selected">Select Plan</option>
		<option value="Value Listing">Value Listing </option>
		<option value="Premium Listing">Premium Listing </option>    
		</select>
		<i class="arrow double"></i>
		</label>          
		</td>
		<td ><label class="field prepend-icon">
		<input name="teller_no" type="text" class="gui-input" placeholder="Teller Number" id="teller_no" value="<?php echo $_SESSION['teller_no'];?>" size="40" required /><span class="field-icon"><i class="fa fa-bank"></i></span>  
		</label>   </td>

		</tr>

		<tr>
		<td><label class="field prepend-icon">
		<input name="amount_deposited" type="text" class="gui-input" placeholder="Amount Deposited" id="amount_deposited" value="<?php echo $_SESSION['amount_deposited'];?>" size="40" required /><span class="field-icon"><i class="fa fa-money"></i></span>  
		</label></td>
		<td> <label class="field prepend-icon">
		<input name="date_deposit" type="text" class="gui-input" placeholder="Date deposited" id="date_deposit"   value="<?php echo $_SESSION['date_deposit'];?>" readonly />
		<span class="field-icon"><i class="fa fa-calendar"></i></span>  
		</label>          </td>
		</tr>
		<tr>
		<td><div class="smart-widget sm-left sml-120">
		<label class="field">
		<input type="text" name="securitycode" id="securitycode_premium" class="gui-input sfcode" placeholder="Enter code" required>
		</label>
		<span class="button captcode">
		<img src="tools/captcha.php" id="captcha_premium" alt="Captcha anti-spam security">
		<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
		</span>
		</div></td><td></td>
		</tr>
		<tr>
		<td style="width:14%; text-align:center;" ><button type="submit" class="button btn-primary" name="submit_payment">Submit</button> </td>
		</form>
			<td>
				<form action="paypal/order-process.php" method="POST" id="paypal-form">
		    <input type="hidden" name="item_id" value="100"/>
		    <input type="hidden" name="item_name" value="premium listing plan"/>
		    <button type="submit" class="paypal-btn">
		        <input type="image" src="http://www.nigerianseminarsandtrainings.com/images/subscribe-btn.png" name="submit" alt="PayPal – The safer, 
		      easier way to pay online.">
		    </button>
		  </form>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
<!--end contact-wrapper2 -->
</div>
<!-- end latest_content_items -->

<!-- contact wrapper3 -->
<div id="contact-wrapper3" style="float:left; width:700px;" class="window boxContent">

	<?php //echo $message;?>

	<div class="smart-forms" style="width:100%;">

		<form action="#" method="post" id="PremiumListing">

		<table style="width:100%;" class="premium2">
		<tbody>

		<tr>
		<td ><div class="notification alert-info spacer-t10" style="width:100%; display:none;" id="msgbox"></div></td>
		<td>&nbsp;</td>
		</tr>
		<tr>
		<td style="text-align:center;"><strong>Bank Account Information</strong></td>
		<td style="float:right;"><a href="#" class="closeBox">Close</a></td>
		</tr>
		<tr>
		<td style="width:50%;">Account Name:</td>
		<td >KAISTE VENTURES LIMITED</td>
		</tr>
		<tr>
		<td>Bank:</td>
		<td>GTBank</td>
		</tr>
		<tr>
		<td>Account Number:</td>
		<td >0176251728</td>
		</tr>
		<tr>
		<td>Account Sort code (for internet transfer)</td>
		<td>058152638</td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td >&nbsp;</td>
		</tr>
		<tr>

		<td><label class="field prepend-icon">
		<input name="business_name" type="text" class="gui-input" placeholder="Business Name" id="name" value="<?php echo $_SESSION['business_name'];?>" required />
		<span id="output_premium"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image" width="20" height="14" style="text-align:center" /></span>
		<span class="field-icon"><i class="fa fa-suitcase"></i>
		</span>  
		</label>          </td>
		<td style="width:100%;"><label class="field prepend-icon">
		<input name="contact_person" type="text" class="gui-input" placeholder="Contact Person's Phone:" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" size="40" required />
		<span class="field-icon"> <i class="fa fa-user"></i></span>
		</label></td>
		</tr>
		<tr>
		<td>
		<label class="field prepend-icon">
		<input name="email" type="email" class="gui-input" placeholder="Email" id="email_pre" value="<?php echo $_SESSION['email'];?>" size="40" required /><span class="field-icon"><i class="fa fa-envelope"></i></span>  
		</label>          
		</td>
		<td><label class="field select">
		<select name="buz_type" id="buz_type" >
		<option selected="selected" value="">Select Business Type</option>
		<option value="Training">Training Provider</option>
		<option value="Managers">Event Managers</option>
		<option value="Suppliers">Event Equipment Supplier</option>
		<option value="Venue">Venue Provider</option>
		</select>
		<i class="arrow double"></i>
		</label> </td>
		</tr>

		<tr>
		<td style="width:auto;">
		<label class="field select">
		<select name="plan" id="plan">
		<option value="<?php echo $_SESSION['plan'];?>" selected="selected">Select Plan</option>
		<option value="Value Listing">Value Listing </option>
		<option value="Premium Listing">Premium Listing </option>    
		</select>
		<i class="arrow double"></i>
		</label>          
		</td>
		<td ><label class="field prepend-icon">
		<input name="teller_no" type="text" class="gui-input" placeholder="Teller Number" id="teller_no" value="<?php echo $_SESSION['teller_no'];?>" size="40" required /><span class="field-icon"><i class="fa fa-bank"></i></span>  
		</label>   </td>

		</tr>

		<tr>
		<td><label class="field prepend-icon">
		<input name="amount_deposited" type="text" class="gui-input" placeholder="Amount Deposited" id="amount_deposited" value="<?php echo $_SESSION['amount_deposited'];?>" size="40" required /><span class="field-icon"><i class="fa fa-money"></i></span>  
		</label></td>
		<td> <label class="field prepend-icon">
		<input name="date_deposit" type="text" class="gui-input" placeholder="Date deposited" id="date_deposit"   value="<?php echo $_SESSION['date_deposit'];?>" readonly />
		<span class="field-icon"><i class="fa fa-calendar"></i></span>  
		</label>          </td>
		</tr>
		<tr>
		<td><div class="smart-widget sm-left sml-120">
		<label class="field">
		<input type="text" name="securitycode" id="securitycode_premium" class="gui-input sfcode" placeholder="Enter code" required>
		</label>
		<span class="button captcode">
		<img src="tools/captcha.php" id="captcha_premium" alt="Captcha anti-spam security">
		<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
		</span>
		</div></td><td></td>
		</tr>
		<tr>
		<td style="width:14%; text-align:center;" ><button type="submit" class="button btn-primary" name="submit_payment">Submit</button> </td>
		</form>
			<td>
				<form action="paypal/order-process.php" method="POST">
		    <input type="hidden" name="item_id" value="100"/>
		    <input type="hidden" name="item_name" value="premium listing plan"/>
		    <button type="submit" class="paypal-btn">
		        <input type="image" src="http://www.nigerianseminarsandtrainings.com/images/subscribe-btn.png" name="submit" alt="PayPal – The safer, 
		      easier way to pay online.">
		    </button>
		  </form>
			</td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
<!-- end contact wrapper3 -->

</div>
<div class="sub_links2_middle"><div class="sub_links2_middle">
<div id="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
</div>
<div class="clearfix"></div>
<div class="categoryDisplay"><?php //include("tools/categories.php");?></div>
</div>
</div>
<?php //echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>
<script type="text/javascript">

$(document).ready(function(e) {


/*********** script to show the training providers on the search form **************/
//fires up the training providers when the keboard is pressed
$('#name').keyup(function(){
$('#output_premium').fadeIn('slow');
$('#output_premium').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
$.post("<?php echo SITE_URL;?>tools/searchBusiness.php", {query:$(this).val(),type:'Training'}, function(data) {

$('#output_premium').html(data)
});
})
//disappears the training providers when the text box looses focus
$('#name').blur(function(){
$('#output_premium').fadeOut();

})

});

//funtion to retrieve the value from the training providers drop down
function GetProVal(elem){
var bizName = $('#'+elem).attr('data');
var email = $('#'+elem).attr('data-email');

$('#name').val(bizName);

$('#email_pre').val(email);

$('#contact_person').focus();

$('#output_premium').hide();

}
</script>
<script type="text/javascript" src="js/jquery.currency.js"></script>
<script type="text/javascript" src="js/jquery.currency.localization.en_US.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#currency-widget').currency({
localRateProvider: '<?php echo SITE_URL;?>api_currency.php',
loadingImage: '<?php echo SITE_URL;?>images/img/loader.gif',
});
});
</script>

</body>
</html>