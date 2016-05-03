<?php
header("HTTP/1.1 301 Moved Permanently");

header( "location: upload-business-info");
/*session_start();

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
*/?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Nigerian Seminars and Trainings - Upload Business Info</title>
<meta name="description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)"/>

<meta name="dcterms.description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)" />

<meta property="og:title" content="Nigerian Seminars and Trainings - Upload Business Info" />

<meta property="og:description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Upload Business Info" />

<meta property="twitter:description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)" />
	    
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	<?php include("scripts/headers_new.php");?>
   <script type="text/javascript" src="<?php echo SITE_URL_S;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL_S;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery.validate.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL_S;?>css/smartforms/js/js/additional-methods.js"></script>
     
     <script type="text/javascript">

	   
				

//script for the search calender
		$(function() {
		
				/* @reload captcha
				------------------------------------------- */		
		function reloadCaptcha(){
					$("#captcha").attr("src","<?php echo SITE_URL_S;?>tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});
		});

function Get_Countries(){
		$.post("<?php echo SITE_URL;?>tools/countries.php",{country:$('#region').val()}, function(data) {
				$('#country').html(data)
		});
	}
function Get_States(){
	if($('#country').val() == 38){
		$.post("<?php echo SITE_URL;?>tools/countries.php",{GetState:$('#country').val()}, function(data) {
				$('#state').html(data)
			
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
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Upload Business Information</p></h2> </td>
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
						
						     <form action="" method="post" id="business_form" >
						       <table width="100%" border="0" class="event_detail">
						         <tr>
						           <td colspan="2">
                                   <label class="field prepend-icon">
						            <input name="business_name" type="text" class="gui-input" placeholder="Business Name" id="name" value="<?php echo $_SESSION['business_name'];?>" /><label class="field-icon"><i class="fa fa-suitcase"></i></label>  
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
						             <option value="Suppliers">Event Equipment Supplier</option>
                                      <option value="Venue">Venue Provider</option>
						            </select>
                                    <i class="arrow double"></i>
                                    </label>
                                   </td>
						           <td><label class="field prepend-icon">
						            <input name="email" type="email" class="gui-input" placeholder="Email" id="email" value="<?php echo $_SESSION['email'];?>" size="40" /><label class="field-icon"><i class="fa fa-envelope"></i></label>  
                                   </label></td>
					             </tr>
						         
						         <tr>
						           <td>
                                   <label class="field prepend-icon">
						            <input name="password" type="password" class="gui-input" placeholder="Password" id="password" value="" size="40" /><label class="field-icon"><i class="fa fa-lock"></i></label>  
                                    </label>
                                   </td>
						           <td><label class="field prepend-icon">
						            <input name="confirm_password" type="password" class="gui-input" placeholder="Confirm Password" id="confirm_password" value="" size="40" /><label class="field-icon"><i class="fa fa-lock"></i></label>  
                                    </label></td>
					             </tr>
						        
						         <tr>
						           <td colspan="2"><label for="description" class="field prepend-icon">
						            <textarea name="description" id="description" class="gui-textarea"  placeholder="Business Description" ><?php echo $_SESSION['description'];?></textarea>
                                  
<label for="description" class="field-icon"><i class="fa fa-comment"></i>
                                    </label>  
                                    <span class="input-hint"> 
                            	Enter detailed description of your busines here
                            </span>
                                   </label></td>
					             </tr>
						         <tr>
						           <td colspan="2"> <label class="field prepend-icon">
						            <input name="address" type="text" class="gui-input" placeholder="Address" id="address" value="<?php echo $_SESSION['address'];?>" size="40" /><label class="field-icon"><i class="fa fa-home"></i></label>  
                                   </label></td>
					             </tr>
						         <tr>
						           <td><label class="field select">
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
						           <td><div id="changeCountry">
                                   <label class="field select">
						            <select name="country" id="country"  onchange="Get_States()">
                                    <option value="">Select Country</option>
					                </select>
                                     <i class="arrow double"></i>
                                   </label></div></td>
					             </tr>
						        
						         <tr>
						           <td>
						          <label class="field select">
						            <select name="state" id="state"  >
                                    <option value="">Select State (For Nigeria only)</option>
					                </select>
                                     <i class="arrow double"></i>
                                   </label></td>
						           <td> <label class="field select">
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
						           <td colspan="2"><label class="field prepend-icon">
						            <input name="size" type="text" class="gui-input" placeholder="Size: (For venue providers (i.e hall size))" id="size" value="<?php echo $_SESSION['size'];?>" size="40" />
                                  <label for="size" class="field-icon">  <i class="fa fa-money"></i></label>
                                   </label></td>
					             </tr>
						         <tr>
						           <td colspan="2"><label class="field prepend-icon">
						            <input name="capacity" type="text" class="gui-input" placeholder="Capacity: (Venue providers only)" id="capacity" value="<?php echo $_SESSION['capacity'];?>" size="40" />
                                  <label for="cost" class="field-icon">  <i class="fa fa-money"></i></label>
                                   </label></td>
					             </tr>
						         <tr>
						           <td width="41%" colspan="2" align="right">
                                   <label class="field prepend-icon">
						            <input name="price" type="text" class="gui-input" placeholder="Price: (Venue providers only)" id="price" value="<?php echo $_SESSION['price'];?>" size="40" />
                                  <label for="price" class="field-icon">  <i class="fa fa-money"></i></label>
                                    </label>
                                   </td>
                                 </tr>
                                   <tr>
                                   <td colspan="2">
                                   <label class="field prepend-icon">
						            <input name="contact_person" type="text" class="gui-input" placeholder="Contact Person:" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" size="40" />
                                  <label for="contact_person" class="field-icon">  <i class="fa fa-user"></i></label>
                                    </label>
                                   </td>
                                   </tr>
                                   <tr>
                                     <td colspan="2"> <label class="field prepend-icon">
						            <input name="designation" type="text" class="gui-input" placeholder="Designation of person entering this event" id="designation" value="<?php echo $_SESSION['designation'];?>" size="40" />
                                  <label for="contact_person" class="field-icon">  <i class="fa fa-user"></i></label>
                                    </label></td>
                                   </tr>
                                   <tr>
                                   <td colspan="2">
                                  <label class="field prepend-icon">
						            <input name="telephone" type="text" class="gui-input" placeholder="Telephone:" id="telephone" value="<?php echo $_SESSION['telephone'];?>" size="40" />
                                  <label for="telephone" class="field-icon">  <i class="fa fa-phone"></i></label>
                                    </label></td>
					             </tr>
						         <tr>
						           <td colspan="2"><label class="field prepend-icon">
						            <input name="website" type="text" class="gui-input" placeholder="Website:" id="website" value="<?php echo $_SESSION['website'];?>" size="40" />
                                  <label for="cost" class="field-icon">  <i class="fa fa-globe"></i></label>
                                    </label>
                                   </td>
					             </tr>
						         <tr>
						           <td colspan="2"> 
                                                                      <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code:">
                            </label>
                            <label for="securitycode" class="button captcode">
                            	<img src="<?php echo SITE_URL_S;?>tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>  
                        </td>
					             </tr>
						         <tr>
						           <td colspan="2"></td>
					             </tr>
						         <tr>
						           <td colspan="2" align="center">
                                   
                                   <button type="submit" class="button btn-primary" name="submit_bizinfo">Upload</button>
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