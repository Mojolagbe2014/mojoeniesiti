<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "About Us";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Weather Update: Nigerian Seminars and Trainings.com <?php echo $metaID;?></title>
<meta name="description" content="Get weather update on any location in Nigeria, Africa, Asia, North/South America and Oceania <?php echo $metaID;?>"/>
	<meta name="google-site-verification" content="QgoBcQh1N6hNfArQ2NtHztZVCMWbAdHIfDzP7tC05Vw" />
  
	
	<?php include("scripts/headers_new.php");?>  
    
    <link href="https://www.nigerianseminarsandtrainings.com/Weather/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/Weather/js/jquery.js"></script>
<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/Weather/js/jquery.tipsy.js"></script>
<script src="https://www.nigerianseminarsandtrainings.com/Weather/js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript"> 
$(document).ready(function() {
	$('#search').keypress(function(x){if(x.keyCode==13){q=$(this).val();if(q!=this.defaultValue){document.location='<?php echo SITE_URL;?>weather?city='+q}}});
	$('#search').focus(function(){if($(this).val()==this.defaultValue)$(this).val('')});
	$('#search').blur(function(){if($(this).val()=='')$(this).val(this.defaultValue)});
	
	$('.button, .avatar').tipsy({gravity:'s', fade:1, html: true, opacity: 1});
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
  
  
      <?php //include("tools/categories_new.php");?>
       

<div id="content_left" style="width:75%;">
<!--<h3 class="categoryHeader">Contact Us</h3>-->
         <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Weather Report</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
				<div id="contact-wrapper" class="rounded" style="margin-top:8px; padding:7px;">  
					
					<div id="subpage_content">
                   <?php include('Weather/index.php');?>    
                     
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