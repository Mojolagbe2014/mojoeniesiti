<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$message = "";
$Email_message="";
if(isset($_POST['submit'])){
$name = $_POST['contactname'];
$email = $_POST['email'];
$comments = $_POST['comment'];
$phone = $_POST['phone'];
$company = $_POST['company'];

$errors = array();

if($name == "") {$errors[] = "Please enter your name";}
if($email == "") {$errors[] = "Please enter your email";}
if(!smcf_validate_email($email)){$errors[] = "Please enter a valid email address";}
if($comments == "") {$errors[] = "Please enter your message";}
if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode'])){$errors[] = "Invalid security code";}
			if(count($errors) > 0){
				$message = '<div class="alert notification alert-error">
				<strong>Please attend to the following:</strong>
				<ul>';
				foreach($errors as $error){
					$message .= '<li><en>'.$error.'</em></li>';
				}
				$message .='</ul></div>';
			}
else{
// Add Email Address
$to = 'info@nigerianseminarsandtrainings.com';
$subject = "New message from: $name";
$Email_message .= "$name ($email) \n";
$Email_message .= "company: ($company)";
$Email_message .= "\n";
$Email_message .= "Phone: ($phone)";
$Email_message .= "\n";
$Email_message .= "Email: ($email)";
$Email_message .= "\n";
$Email_message .= "$comments";
$Email_message .= "\n";
$headers = "From: no_reply <no_reply@nigerianseminarsandtrainings.com>";
	if(mail($to, $subject, $Email_message, $headers)) header("Location: contact-us?confirm=true");
	}	
}
if(isset($_GET['confirm']) && $_GET['confirm'] == "true"){
	$message = successMsg("Thank you, we will get back to you as soon as possible");
}

$opt = array (
	'address' => urlencode("18b james ademosu close, off oluyeba street, ketu, Lagos, Nigeria"),
	'sensor'  => 'false'
);

// now simply call the function
//$geolocation = getLatLng($opt);
function getCoordinatesFromAddress( $sQuery)
{
	$sURL = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($sQuery).'&sensor=false';
	@$sData = file_get_contents($sURL);
	
	return json_decode($sData);
}

 $res = getCoordinatesFromAddress("18b james ademosu close, off oluyeba street, ketu, Lagos, Nigeria");
@$lat = $res->results[0]->geometry->location->lat;
@$long = $res->results[0]->geometry->location->lng;

$advert = "Contact us";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Nigerian Seminars and Trainings - Contact Us</title>
<meta name="description" content="Fill this form to contact us for enquiries, comments, suggestions or just to tell us how you feel about our services."/>
    
     <meta name="dcterms.description" content="Fill this form to contact us for enquiries, comments, suggestions or just to tell us how you feel about our services." />

<meta property="og:title" content="Nigerian Seminars and Trainings - Contact Us" />

<meta property="og:description" content="Fill this form to contact us for enquiries, comments, suggestions or just to tell us how you feel about our services." />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Contact Us" />

<meta property="twitter:description" content="Fill this form to contact us for enquiries, comments, suggestions or just to tell us how you feel about our services." />

	<?php include("scripts/headers_new.php");?>
    
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script> 
     <script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&amp;sensor=true"></script>
<script type="text/javascript" src="js/jquery.gmap-1.0.3-min.js"></script>

<?php include('tools/analytics.php');?>

<script type="text/javascript">

//script for the search calender
		$(function() {
		
				/* @reload captcha
				------------------------------------------- */		
		function reloadCaptcha(){
					$("#captcha_contact").attr("src","tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});
		});

</script>
 <script type="text/javascript">
	
		$(function() {
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
						
				$( "#login_form_contact" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
							
						rules: {
								contactname: {
										required: true
								},
								email: {
										required: true,
										email:true
								},						
								comment:  {
										required: true
								},			
								securitycode:{
										required:true
								}
							
						},
						
						/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
								contactname: {
										required: 'Enter your name'
								},
								email: {
										required: 'Enter your email address',
										email:'Enter a valid email address'
								},				
								description:  {
										required: 'Enter your message'
										
								},			
								securitycode:{
										required:'Enter security code'
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
    <style>
.contact_bg{
	background-image: url(images/contactbg.png);
	background-repeat: no-repeat;
	background-position: center center;	
}
	</style>
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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->





<?php include("tools/header_new.php");?>



<div id="main">
  <div id="content">
  
   <?php include("tools/categories_new.php");?>

<div id="content_left" >
<!--<h3 class="categoryHeader">Contact Us</h3>-->
         <div class="event_table_inner contact_bg">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table >
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:28px; padding:5px;">Contact Us</h2></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				<div id="sub_links">

				<div id="subpage">

					<div id="contact-wrapper" class="rounded smart-forms"> 
						
						
                            <?php echo $message;?>
                            <p style="font-size:12px; margin-bottom:5px; padding:7px; line-height:20px;">Please fill and submit the form here to send in your comments, enquiries or suggestions. We will respond to your email as quickly as possible!</p>
                           
							     <form method="post" action="contact-us" id="login_form_contact" style="width:650px; display:block; margin-left:auto; margin-right:auto;">  
                                       <div class="section">
                        <label class="field prepend-icon">
                            <input type="text" name="contactname" id="contactname" class="gui-input" placeholder="Name">
                            <span class="field-icon"><i class="fa fa-user"></i> </span>  
                        </label>
                    </div><!-- end section -->     
         
                                   <div class="section">
                        <label class="field prepend-icon">
                            <input type="text" name="company" id="company" class="gui-input" placeholder="Company">
                            <span class="field-icon"><i class="fa fa-building-o"></i> </span>  
                        </label>
                    </div><!-- end section -->
                                
                                     <div class="section">
                        <label class="field prepend-icon">
                            <input type="text" name="email" id="email" class="gui-input" placeholder="Email">
                            <span class="field-icon"><i class="fa fa-envelope"></i> </span> 
                        </label>
                    </div><!-- end section -->
                                     
                                     <div class="section">
                        <label class="field prepend-icon">
                            <input type="text" name="phone" id="phone" class="gui-input" placeholder="Telephone">
                            <span class="field-icon"><i class="fa fa-phone"></i> </span> 
                        </label>
                    </div><!-- end section -->
                           <div class="section">
                                     <label class="field prepend-icon">
						            <textarea name="comment" id="comment" class="gui-textarea"  placeholder="Message" ></textarea>
                                  
<span class="field-icon"><i class="fa fa-comment"></i>
                                     </span> 
                                    <span class="input-hint"> 
                            	Enter detailed your enquiries here
                            </span>
                                   </label>
                                   </div>
                                     
						          <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode_contact" class="gui-input sfcode" placeholder="Enter code:">
                            </label>
                           <span class="button captcode">
                            	<img src="tools/captcha.php" id="captcha_contact" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </span>
                        </div>
                        
							         <div class="contact-left" style="margin-top: 10px;">
							         	  <button type="submit" class="button btn-primary" name="submit">Submit</button>
							         </div> 
							     </form>
                              
				      <div id="contact_info" style="padding:8px; font-size:12px; line-height:30px;">
	 
                        <h2><strong>Nigerian Seminars and Trainings </strong> - <span style="font-size:12px; color:#090;"><strong>Powered by: Kaiste Ventures</strong></span></h2>
                                    
			     	    <p><i class="fa fa-map-marker" style="color:#009900;"></i> <strong style="color:#009900;">Address:</strong> 18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria<br />
                                     
                          <span style="color:#009900;"><i class="fa fa-phone"></i> Contact Numbers: </span> +234-012915640 ,+234-8099909402 , +234-8099909400<br />
                                   <span style="color:#009900;"><i class="fa fa-envelope"></i> Email:</span> - <a href="mailto:admin&#64;nigerianseminarsandtrainings.com">admin</a>
                                   <br />
                                    <span style="color:#009900;"><i class="fa fa-building"></i> Office Hours:</span> - 8:am - 1pm, 2pm - 5pm ( Mon - Fri )
	     	            </p>
							     	
							     	
				        </div>
                                 <script type="text/javascript">
$(function() {
    $("#contact_map").gMap
	({ controls: false,
	   scrollwheel: false,
	   markers: [{ latitude:	<?php echo $lat;?>,
                   longitude: <?php echo $long;?>,
				    html: "18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi-Ketu, Lagos, Nigeria",
                              popup: true }],
	   zoom: 15   
	});
});
</script>
                                 <div id="contact_map" style="height: 220px; width:100%;">
							     	
							     	
							     </div>
						
						
					</div>

			

					<div id="latest_content_items">

					

						<!-- Section 1 Featured -->

						<!-- End Featured 1 -->

				

					</div><!-- end latest_content_items -->

				</div>
<!-- end subpage -->

            <div class="sub_links2_middle"><div class="sub_links2_middle">


 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



<div class="clearfix"></div>


<!--<div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>-->
 
       <?php //include("tools/categories.php");?>
 
</div>
</div>


               <?php //echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
               
                
<div class="clearfix"></div>


</div>
</div>

			

		<?php include("tools/side-menu_new.php");?>


	</div>
    <div class="clearfix"></div>
</div>

	
</div>
	


<?php include ("tools/footer_new.php");?>
</body>

</html>