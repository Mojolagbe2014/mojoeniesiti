<?php

session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");
if(connection());


$title = "View upcoming conferences and training seminars by categories";

$meta_content = "Current and upcoming conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania by categories";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "Country Events";


	$pageInnerTitle = 'Categories';


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

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_content;?>"/>
	

	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />

	
<?php include("scripts/headers.php");?>

	

</head>



<body>
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


<?php include("tools/header2.php");?>

<div id="main">

	<div id="content_bar">

		<div id="content_nav">

			<ul id="main_content_slider">

				<li><a href="#" class="activeSlide">Events by Categories</a></li>

			</ul>

		</div>

		<div id="search2">
        
			<form action="<?php echo SITE_URL;?>content_search" method="get" id="search_site">
            <table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="query" type="text" id="query" onfocus="if(this.value == 'Search Site...') this.value='';" onblur="if(this.value == '') this.value='Search Site...' ;" value="Search Site..." /></td>
    <td align="right" valign="middle"><input type="submit" class="button" value="" /><input name="search" type="hidden" value="1" /></td>
  </tr>
</table>
           
	  </form>
		</div>

	</div>

	<div id="content">

		<div id="content_left">

				<div class="sub_links">

                <h4 class="categoryHeader"><?php echo $pageInnerTitle;?></h4>

                <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
				  
                  <?php include("tools/categories2.php");?>
       

</div>

		    </div>

                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

<div class="clearfix"></div>

</div>
 <div align="left" style=" border:#0C0; margin-bottom:20px;"><?php include("calendar.php");?></div>
		
        

</div>



			</div><!-- end subpage -->

					

		</div>

		
<?php include("tools/side-menu.php");?>
		

	</div>

	<div id="content_bottom"></div>

	<div class="clearfix"></div>

</div>

	

	

	

</div>

</div>
<?php include ("tools/footer.php");?>
</body>

</html>