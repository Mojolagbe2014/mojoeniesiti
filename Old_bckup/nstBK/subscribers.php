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
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Subscribe: Nigerian Seminars and Trainings </title>
<meta name="description" content="Subscribe to Nigerian Seminars and Trainings to get the latest news and updates on events and learning opportunities around the world."/>
 
    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="3 Days">
	<!--	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->

	<?php include("scripts/headers_new.php");?>
  <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/js/additional-methods.js"></script>

<script type="text/javascript">

function Get_Countries(){
		$.post("<?php echo SITE_URL;?>tools/countries.php",{country:$('#region').val()}, function(data) {
				$('#country').html(data)
		});
	}
function Get_States(){
	if($('#country').val() == 'Nigeria'){
		$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:38}, function(data) {
				$('#state').html(data)	
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
				state: {
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



<div id="main">
	
	<div id="content">
    
     <?php include("tools/categories_new.php");?>
    
		<div id="content_left">
	<div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0" style="width:100%;">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Subscribe to our event notification / newsletters</h2> <p style="font-size:12px; margin-bottom:5px;">Fill this form to subscribe to our newsletter to get regular updates on events and breaking news as we post them on the website. A confirmation message will be sent to the email address you provided. Please visit your inbox to activate your subscription.</p></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
<div id="tab_slider">
				<div id="subpage">
					
				 <div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
						
						
                          <?php echo $message;?>
						   
						    <form action="" method="post" id="subscriberForm">
						      <table width="100%" border="0" class="event_detail">
						        <tr>
						         
						          <td colspan="3">
                                    
                                    <label class="field prepend-icon">
						            <input name="email_sub" type="text" class="gui-input" placeholder="Email Address" id="email_sub" value="<?php echo $_SESSION['email_sub'];?>" size="40" /><label class="field-icon"><i class="fa fa-suitcase"></i></label>  
                                    </label>
                                    </td>
					            </tr>
						        <tr>
						          <td align="right"> <label class="field prepend-icon">
						            <input name="fname" type="text" class="gui-input" placeholder="Firstname" id="fname" value="<?php echo $_SESSION['fname'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
                                    </label></td>
						          <td colspan="3">
                                    
                                    
                                   <label class="field prepend-icon">
						            <input name="lname" type="text" class="gui-input" placeholder="Lastname" id="lname" value="<?php echo $_SESSION['lname'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
                                    </label>
                                    
                                    </td>
					            </tr>
						       
						        <tr>
						          <td align="right"><label class="field prepend-icon">
						            <input name="username" type="text" class="gui-input" placeholder="Username" id="username" value="<?php echo $_SESSION['username'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
                                    </label></td>
						          <td colspan="3"> 
                                   <label class="field prepend-icon">
						            <input name="password" type="password" class="gui-input" placeholder="Password" id="password" value="" size="40" />
                                    <label class="field-icon"><i class="fa fa-lock"></i></label>  
                                    </label>
                                  </td>
					            </tr>
						       
						        <tr>
						         
						          <td width="46%">
                                  <div class="option-group field">
                                <label for="female" class="option block">
                                    <input type="radio" name="sex" id="female" value="female">
                                    <span class="radio"></span> Female 
                                </label>
                                
                                                          
                               
                                
                            </div>
                            <td width="50%"> 
                             <div class="option-group field">
                            <label for="male" class="option block spacer-t10">
                                    <input type="radio" name="sex" id="male" value="male">
                                    <span class="radio"></span> Male 
                                </label>
                                </div>
                                </td>
                                
                                    <td width="4%"></td>
						        
					            </tr>
						        <tr>
						         
						          <td colspan="3">
						            <label class="field prepend-icon">
						            <input name="phone" type="text" class="gui-input" placeholder="Telephone" id="phone" value="<?php echo $_SESSION['phone'];?>" size="40" /><label class="field-icon"><i class="fa fa-phone"></i></label>  
                                    </label>
                                    </td>
					            </tr>
						        <tr>
						          
						          <td colspan="3"> <label class="field prepend-icon">
						            <input name="organization" type="text" class="gui-input" placeholder="Organization" id="organization" value="<?php echo $_SESSION['organization'];?>" size="40" /><label class="field-icon"><i class="fa fa-building-o"></i></label>  
                                    </label></td>
					            </tr>
						        <tr>
						          
						          <td colspan="3"> <label class="field prepend-icon">
						            <input name="designation" type="text" class="gui-input" placeholder="Designation" id="designation" value="<?php echo $_SESSION['designation'];?>" size="40" /><label class="field-icon"><i class="fa fa-asterisk"></i></label>  
                                    </label></td>
					            </tr>
						        <tr>
						        
						          <td colspan="3"> <label class="field prepend-icon">
						            <input name="address" type="text" class="gui-input" placeholder="Address" id="address" value="<?php echo $_SESSION['address'];?>" size="40" /><label class="field-icon"><i class="fa fa-home"></i></label>  
                                    </label></td>
					            </tr>
						        <tr>
						          
						          <td colspan="3"> <label class="field prepend-icon">
						            <input name="city" type="text" class="gui-input" placeholder="City" id="city" value="<?php echo $_SESSION['city'];?>" size="40" /><label class="field-icon"><i class="fa fa-building-o"></i></label>  
                                    </label></td>
					            </tr>
						        <tr>
						        
						          <td colspan="3">
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
						         
						          <td colspan="3"><span class="contact-left">
						            <label class="field select">
						            <select name="state" id="state"  >
                                    <option value="">Select State (For Nigeria only)</option>
					                </select>
                                     <i class="arrow double"></i>
                                    </label>
						          </span></td>
					            </tr>
						        <tr>
						         
						          <td colspan="3"><label class="field select">
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
                            <label for="securitycode" class="button captcode">
                            	<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>
                        </td>
						         
					            </tr>
						       
						        <tr>
						         
						          <td align="center">
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