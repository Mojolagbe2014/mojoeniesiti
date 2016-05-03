<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "Advertise";
$random = random(8);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
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
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Your Premium Listing status is now confirmed. Sign in now</title>
<meta name="description" content="Give your business and events a boost - Upgrade to premium listing to enjoy all the benefits it offers."/>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<?php include("scripts/headers_s.php");?>

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
			
		
<h3 class="categoryHeader">Premium Listing</h3>
				<div id="subpage">
					
					<div id="subpage_content">
						 <?php //echo $message;?>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
                           <span class="premium-msg">
                           <p style="color:#000; font-size:14px">Thank you, your subscription will be activated within 24 hrs after your payment has been verrified.</p>
                           <p style="color:#FFF; font-size:14px">You will also recieve a mail from us confirming your subscription status and login  details</p>
                           </span>
						     
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                    </div>
                <div id="sub_links"><div id="sub_links2_middle"><?php 
 echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div></div><!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu.php");?>
	</div>
	
    <div class="clearfix"></div>
</div>
	
    </div>
</div>
</div>
<?php include ("tools/footer.php");?>
</body>
</html>