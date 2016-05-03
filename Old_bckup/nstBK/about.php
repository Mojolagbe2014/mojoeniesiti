<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "About Us";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Nigerian Seminars and Trainings - About</title>
<meta name="description" content="This page presents information about Nigerian Seminars and Trainings; our vision, our mission, what we do, and how we go about doing it."/>

 <meta name="dcterms.description" content="This page presents information about Nigerian Seminars and Trainings; our vision, our mission, what we do, and how we go about doing it." />

<meta property="og:title" content="Nigerian Seminars and Trainings - About" />

<meta property="og:description" content="This page presents information about Nigerian Seminars and Trainings; our vision, our mission, what we do, and how we go about doing it." />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - About" />

<meta property="twitter:description" content="This page presents information about Nigerian Seminars and Trainings; our vision, our mission, what we do, and how we go about doing it." />
	

	<?php include("scripts/headers_new.php");?>
	
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
       

<div id="content_left" >
<!--<h3 class="categoryHeader">Contact Us</h3>-->
         <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>About Us</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
				<div id="contact-wrapper" class="rounded" style="margin-top:8px; padding:7px;">  
					
					<div id="subpage_content">
                    <p>Nigerian seminars and trainings.com is the most comprehensive source of information on conferences, workshops, seminars, training and other learning opportunities in Nigeria today. Our global reach extends to over one hundred and thirty three (133) countries with very strong presence in United States, United Kingdom, India, Indonesia, Netherlands, Liberia, Estonia, Kenya, Gambia and Brazil to mention a few.</p>
                    <p>We provide easy, up-to-date and by-the-click access to information on upcoming conferences, seminars and training to intending trainees / conference attendees in the comfort of their living rooms/offices anywhere in the world. We also provide information (and web links) on training providers, venue providers, training equipment suppliers etc.</p>
                    <p align="justify" class="P_TAG">We do not, and shall not evaluate, endorse or  recommend any business (All adverts are at the instance of the advertisers). We  will not engage in comparisons, surveys, or polls. Our business shall be  limited to the provision of information and necessary links
<p>Our data is based on information  available in the public domain and is constantly being updated by research and  uploads/contribution by stakeholders </p>
<p>Our  service offerings include the following:</p>
<ul class="formart">
  <li><a href="add_event" target="_blank">Free course listing</a></li>
  <li><a href="biz_info" target="_blank">Free business listing</a></li>
  <li><a href="<?php echo SITE_URL;?>premium-listing" target="_blank">Premium course/business listing (paid  service)</a></li>
  <li><a href="<?php echo SITE_URL;?>advertise" target="_blank">Banner advert placement (paid  service)</a></li>
  <li>Free training search - we help  prospective trainees search for courses / training providers free. </li>
</ul>
<p align="justify" class="P_TAG">
                     
		      </div>
			
					<div id="latest_content_items">
					
						<!-- Section 1 Featured -->
						<!-- End Featured 1 -->
				
					</div><!-- end latest_content_items -->
				</div>
                           <div id="sub_links2_middle">
						   <?php 
 echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

<div class="clearfix"></div>
</div>
<!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
    <div class="clearfix"></div>
</div>
	
    </div>
</div>
</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>