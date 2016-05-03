<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$message = "";
$random = random(8);
$Email_message="";
if(isset($_POST['submit'])){
$name = $_POST['contactname'];
$email = $_POST['email'];
$comments = $_POST['comment'];
$phone = $_POST['phone'];
$company = $_POST['company'];

if($name == "") {$message = errorMsg("Please enter your name");}
else if($email == "") {$message = errorMsg("Please enter your email");}
else if(!smcf_validate_email($email)){$message = errorMsg("Please enter a valid email address");}
else if($comments == "") {$message = errorMsg("Please enter your message");}
else if($_POST['verify'] != $_POST['verifyHidden']) {$message = errorMsg("Please enter a correct verification answer");}
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
	$sData = file_get_contents($sURL);
	
	return json_decode($sData);
}

 $res = getCoordinatesFromAddress("18b james ademosu close, off oluyeba street, ketu, Lagos, Nigeria");
$lat = $res->results[0]->geometry->location->lat;
$long = $res->results[0]->geometry->location->lng;

$advert = "Contact us";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>contact Us: Nigerian Seminars and Trainings</title>
<meta name="description" content="Fill this form to contact us for enquiries, comments, suggestions or just to tell us how you feel about our services."/>
	<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<?php include("scripts/headers.php");?>
<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery-1.4.2.min.js"></script> 
     <script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&sensor=true"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.gmap-1.0.3-min.js"></script>


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





<?php include("tools/header2.php");?>

<div id="main">
  <div id="content">
  
<div id="content_left">
<h3 class="categoryHeader">Contact Us</h3>
         

				<div id="sub_links">

                

             

			

		



				<div id="subpage">

					

					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">  
							<div id="contact-wrapper-inner" class="rounded">
                            <?php echo $message;?>
                            <p>Please fill and submit the form here to send in your comments, enquiries or suggestions. We will respond to your email as quickly as possible!</p>
                           
							     <form method="post" action="contact-us" id="login-form_contact">  
							         <div class="contact-left">  
							             <label for="name"><strong>Name:</strong></label><br />
							             <input type="text" name="contactname" id="contactname" value="" style="width: 75%;" />  
							         </div>  
							   <div class="contact-left">  
							             <label for="name"><strong>Company:</strong></label><br /> 
							             <input type="text" name="company" id="company" value="" style="width: 75%;" />  
						           </div>
							         <div class="contact-left">  
							             <label for="phone"><strong>Email:</strong></label><br /> 
							             <input type="text" name="email" id="email" value="" style="width: 75%;" />  
							         </div>  
							   <div class="contact-left">  
							             <label for="phone"><strong>Phone Number:</strong></label><br />  
							             <input type="text" name="phone" id="phone" value="" style="width: 75%;" />  
						           </div>
			           <div class="contact-left">  
							             <label for="comment"><strong>Message:</strong></label> <br />
	             <textarea name="comment" id="comment" style="width: 75%; height: 100px;"></textarea>  
							         </div>  
						           <div class="contact-left"> 
                                   <table width="548">
                                   <tr>
                                   <td width="93">
                                    <label for="name"><strong>Verification:</strong></label>
                                   </td>
                                   <td width="212"> <input name="verify" type="text" class="input"  id="verify" size="30" /></td>
                                   <td width="58"> <span class="verification" style="float:right;"><?php echo $random;?></span>
						             <input name="verifyHidden" type="hidden" value="<?php echo $random;?>" />  </td>
                                   </tr>
                                   </table> 
						              
						             
							         </div>
							         <div class="contact-left" style="margin-top: 10px;">
							         	<button name="submit">Send Message</button>
							         </div> 
							     </form>
                                 <hr />
							     <div id="contact_info">
	 
                                    <h4><strong>Nigerian Seminars and Trainings </strong></h4>
                                    <p><font color="green"><strong>Powered by: Kaiste Ventures</strong></font></p>
                                    
				     	   <p>18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria<br />
                                     
                             <span>Contact Numbers: <BR /></span>+234-8099909400,<br />+234-8099909402,<br />+234-8036297552, <BR /> +234-8189810988, <BR /> +234-8094413786, <BR /> +234-8163288051, <BR /> +234-8115598129 <BR />
                                        
                                          <br />
                                      <span>Email:</span> - info@nigerianseminarsandtrainings.com, admin@nigerianseminarsandtrainings.com
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
						 </div>
						 
						 <div id="contact-info">
						 
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


<div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>
 
       <?php include("tools/categories.php");?>
 
</div>
</div>

<div class="divider"></div>

               <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
               
                
<div class="clearfix"></div>


</div>
</div>

			

		<?php include("tools/side-menu.php");?>


	</div>
</div>

	

	<div class="clearfix"></div>


</div>

	
  
  
</div>
<?php include ("tools/footer.php");?>
</body>

</html>