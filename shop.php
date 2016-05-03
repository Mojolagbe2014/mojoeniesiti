<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$message = '';
$advert = "Articles";
?>
<!DOCTYPE html >



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Nigerian Seminars and Trainings - e-Store – Online training shop</title>

<meta name="description" content="Find training equipment, management books, marketing books, project management books, cameras, projectors, flip-charts, microphone"/>

 <meta name="dcterms.description" content="Find training equipment, management books, marketing books, project management books, cameras, projectors, flip-charts, microphone" />

<meta property="og:title" content="Nigerian Seminars and Trainings - e-Store – Online training shop" />

<meta property="og:description" content="Find training equipment, management books, marketing books, project management books, cameras, projectors, flip-charts, microphone" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - e-Store – Online training shop" />

<meta property="twitter:description" content="Find training equipment, management books, marketing books, project management books, cameras, projectors, flip-charts, microphone" />


	<?php include("scripts/headers_new.php");?>
 <link rel="stylesheet" type="text/css"  href="css/pricing-tabled-light.css">

 
 <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
 
<?php include('tools/analytics.php');?>

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
    <td style="padding-left:8px"><h1 style="font-size:28px; padding:5px;"><i class="fa fa-shopping-cart"></i>&nbsp e-Store - Buy books and training equipments</h1></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
				<div id="sub_links">
 
				<div id="subpage">
                
                 <div id="contact-wrapper" class="rounded"> 
                 
                     <div id="subpage_content_ad">
                         <iframe src="http://astore.amazon.com/nigerseminand-20" width="728px" height="900px" frameborder="0" scrolling="no"></iframe>
                         
                     </div>

			

					<div id="latest_content_items">

					

						<!-- Section 1 Featured -->

						<!-- End Featured 1 -->

				

					</div><!-- end latest_content_items -->

				</div>
                </div>

               

					


            <div class="sub_links2_middle"><div class="sub_links2_middle">


 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

<div class="clearfix"></div>

 
</div>
</div>

               

</div>

</div>

			

		<?php include("tools/side-menu_new.php");?>

	</div>
    <div class="clearfix"></div>
</div>

<div class="clearfix"></div>
</div>
	
<?php include ("tools/footer_new.php");?>
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