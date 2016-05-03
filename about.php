<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "About Us";

$title = "About - Nigerian Seminars and Trainings";
$meta_description = "This page presents information about Nigerian Seminars and Trainings; our vision, our mission, what we do, and how we go about doing it.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_description;?>"/>
<meta name="keywords" content="<?php echo $meta_description;?>" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left" >
<!--<h3 class="categoryHeader">Contact Us</h3>-->
<div class="event_table_inner">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px;text-align: center"><h1 style="font-size:24px; padding:5px;">About Us</h1></td>
</tr>
<tr>
    <td style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</div>
<div id="contact-wrapper" class="rounded" style="margin-top:8px; padding:7px;">  
<div id="subpage_content" >
    <p style="font-size:13px; text-align:justify;"><h3 style="font-weight:normal;font-size:13px;">Welcome to  Nigerian seminars and trainings.com – Nigeria&rsquo;s one-stop training marketplace. </h3><br/>
Nigerian  seminars and trainings provides free, easy, up-to-date and by-the-click access  to information on upcoming training, seminars, workshops, management and  professional short courses and conferences to intending trainees / conference  attendees in the comfort of their living rooms/offices anywhere in Nigeria, Africa, Asia, North/South America, Europe and Oceania.  We also provide information and access to training providers, venue providers,  training equipment suppliers etc.<br><br>
Our global reach  extends to over one hundred and thirty three (133) countries with very strong  presence in Nigeria, United States, United Kingdom, India, Indonesia,  Netherlands, Liberia, Estonia, South Africa, Kenya, Ghana, Liberia, Gambia,  United Arab Emirates and Brazil to mention a few. <br><br>
We do not, and  shall not evaluate, endorse or recommend any business (All adverts are at the  instance of the advertisers). We will not engage in comparisons, surveys, or  polls. Our business shall be limited to the provision of information and  necessary links <br><br>
Our data is  based on information available in the public domain and is constantly being  updated by research and uploads/contribution by stakeholders <br><br>
Nigerian  seminars and trainings is owned and managed by Kaiste Ventures Limited (RC  1222226), a company duly registered under the Nigerian Company and Allied  Matters Act 1990.
Our service offerings include the following:
<ul class="formart">
<li><a href="<?php echo SITE_URL;?>add-event" target="_blank" title="Free course listing">Free course listing</a></li>
<li><a href="<?php echo SITE_URL;?>upload-business-info" target="_blank" title="Free business listing">Free business listing</a></li>
<li><a href="<?php echo SITE_URL;?>premium-listing" target="_blank" title="Premium course/business listing (paid  service)">Premium course/business listing (paid  service)</a></li>
<li><a href="<?php echo SITE_URL;?>advertise" target="_blank" title="Banner advert placement (paid  service)">Banner advert placement (paid  service)</a></li>
<li>Free training search - we help  prospective trainees search for courses / training providers free.</li>
</ul>
<p style="font-size:13px;">Please feel free  to relax and browse through the site by using the various tools we have  provided. You may simply scroll up and down the pages or use the search options  to search for events according to categories, location or date. <br><br>
Do you have  questions or suggestions for us? Please use the &ldquo;contact us&rdquo; button to drop us  a line. For most common issues, you may find the answers in our <a href="<?php echo SITE_URL;?>faq" title="Frequently Asked Questions">FAQ</a> page. <br><br>
For advertising  or premium listing subscription enquiries (training providers and other  businesses), please visit our &ldquo;<a href="advertise" title="advertise page">advertise</a>&rdquo; and / or &ldquo;<a href="<?php echo SITE_URL;?>premium-listing" title="Premium course/business listing (paid  service)">premium listing</a>&rdquo; pages.</p>
Once again, you are welcome to Nigerian seminars and trainings.
</div>
<div id="latest_content_items">
<!-- Section 1 Featured -->
<!-- End Featured 1 -->
</div><!-- end latest_content_items -->
</div>
<div id="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div>
<!-- end subpage -->
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>