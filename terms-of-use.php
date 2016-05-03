<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "Terms Of Use";

$title = "Terms of Use - Nigerian Seminars and Trainings ";
$meta_description = "The use of the site and the services available on it indicates that you accept these terms and conditions set forth here";
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
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table style="width:100%">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px;text-align: center"><h1 style="font-size:24px; padding:5px;">Terms of Use</h1></td>
</tr>
<tr>
<td style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</div>

<div id="subpage">
<div id="subpage_content_ad">
<p><br />
The  website Nigerian Seminars and Trainings.com is owned and operated by Kaiste  Ventures and is made available for use on the following terms and conditions. The  use of the site and the services available on it indicates that you accept  these terms and conditions set forth here.<br /><br />
<h3 style="font-weight: bold;font-size: 13px">Data Protection</h3>
Our  use of any personal information supplied by users of this site is governed by  our privacy policy. Please click here to view our <a href="privacy-policy" title="Privacy Policy">Privacy Policy</a>.<br /><br />
<h3 style="font-weight: bold;font-size: 13px">Use of the Site</h3>
The  information and services available on the site are provided for the sole  purpose of individuals and businesses looking for potential suppliers of  business services and suppliers looking for potential customers. Users may use,  print and download information from the site for these purposes only and for no  other personal or commercial purpose. You may not otherwise copy, display,  transmit or distribute any material from the site.<br />
All  copyright, database rights and other intellectual property rights in the site  and the material available on the site belong to Kaiste Ventures and its third  party suppliers. Use of the site does not give users any proprietary rights in  such materials.<br /><br />
<h3 style="font-weight: bold;font-size: 13px">Service Availability</h3>
We  try to ensure continuous availability of the site and all the services  available on it but accept no responsibility for the consequences of  interruptions or delays, however caused. We may, additionally, alter the design  and specification of the site at any time.<br /><br />
<strong style="font-weight: bold;font-size: 13px">Limitation of Liability</strong>
Our  liability, and the liability of our third party suppliers, for any loss or  damage suffered by you as the result of your use of this site is limited to  your actual direct damages and, except in the case of fraud, excludes any loss  of future earnings, profit or prospects or any consequential or speculative loss.  As required by law, this exclusion does not extend to death or personal injury  caused by our negligence.<br /><br />
<strong>Listings</strong><br/>
Listings  contained in the indexes of training and suppliers on the site are provided by  prospective suppliers and are not reviewed by us. We accept no responsibility  or liability for the contents of listings and expect users and prospective  customers of listed suppliers to carry out such verification procedures as are  customary and prudent in the circumstances.<br />
Listings  and other information provided on the site are intended to assist in  identifying suppliers of business services which may be suitable for your  requirements. We do not guarantee the suitability of any supplier for your  particular needs in any particular case or for any particular purposes. You  should carry out your own verification and obtain independent advice where  appropriate before entering into any contractual or other arrangement which may  result in loss or damage.<br /><br />
<strong>Placing of Listings</strong><br/>
Listing  information placed on nigerianseminarsandtrainings.com must be for genuine  suppliers and services and not for other products or services including, but  not limited to, affiliate schemes, pyramid selling schemes or any other so  called 'business opportunity'.<br />
Listings  may not contain gratuitous use of keywords. Gratuitous means deliberately  repeating keywords, with the intention of influencing position in search  results.<br />
Testimonials  included in your Listing must be genuine comments received as feedback from  your customers.<br /><br />
<strong>Offensive Listings</strong><br/>
If  we believe that a listing is offensive, in any way illegal or in breach of  these terms and conditions we may at our discretion either amend the listing or  remove it from nigerianseminarsandtrainings.com without liability to you and  will inform you accordingly.<br /><br />
<strong>Content and Links</strong><br/>
If  your Listing links to another site you are responsible for maintaining the  links and for the content of your advertisement and the linked site. We may  remove from nigerianseminarsandtrainings.com any Listing which contains content  or links to a site which, in our opinion, is defamatory, illegal or  objectionable or will bring nigerianseminarsandtrainings.com into disrepute.  You will indemnify us from and against any claims or liability arising from  content or links contained in your advertisements.<br /><br />
<strong>Responses to Enquiries</strong><br/>
You  agree to deal fairly and professionally with individuals who may respond to a  Listing or who are referred, and not do anything which may bring nigerianseminarsandtrainings.com  into disrepute. You will indemnify us from and against any claim brought  against nigerianseminarsandtrainings.com by any person arising from your breach  of this obligation or any other of these terms and conditions or any claim that  you have failed to comply with any applicable law or regulation or are in  breach of any contract.<br />
We  do not guarantee that any response to your Listing will result in a successful  commercial relationship. It is your responsibility to carry out such checks as  are necessary to ensure that leads are creditworthy and otherwise able to  honour any contractual commitments they may enter into with you.<br /><br />
<strong>Governing Law</strong><br/>
These  terms and conditions shall be interpreted in accordance with the laws of the Federal Republic of Nigeria  and  all disputes shall be decided by Nigerian courts.
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

<?php include ("tools/footer_new.php");?>

</body>
</html>