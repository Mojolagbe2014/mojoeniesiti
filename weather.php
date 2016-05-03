<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
if(filter_input(INPUT_GET, 'f')!=NULL){ $f = filter_input(INPUT_GET, 'f');}
$city = filter_input(INPUT_GET, 'city') ? "for ".ucwords(filter_input(INPUT_GET, 'city'))." " : "";
$titleExr = $city.$f;
$advert = "Weather Page";
$title = trimStringToFullWord(60, stripslashes(strip_tags("Weather Update $titleExr - Nigerian Seminars and Trainings")));
$meta_description = trimStringToFullWord(160, stripslashes(strip_tags("Weather information $titleExr. Get weather update on any location in Nigeria, Africa, Asia, North/South America and Oceania ")));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_description;?>"/>
<meta name="keywords" content="weather, report, city" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<meta name="google-site-verification" content="QgoBcQh1N6hNfArQ2NtHztZVCMWbAdHIfDzP7tC05Vw" />
<?php include("scripts/headers_new.php");?>  
<link href="<?php echo SITE_URL;?>weather_script/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>weather_script/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>weather_script/js/jquery.tipsy.js"></script>
<script src="<?php echo SITE_URL;?>weather_script/js/jquery-ui-1.8.13.custom.min.js"></script>
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
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<div id="content_left" style="width:75%;">
<div class="event_table_inner">
<table style="width:100%">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px;text-align: center"><h1 style="font-size:24px; padding:5px; text-align:center;">Weather Report</h1></td>
</tr>
<tr>
    <td style="font-size:11px"><h2>&nbsp;</h2><h3>&nbsp;</h3></td>
</tr>
</table>
</div>
<div id="contact-wrapper" class="rounded" style="margin-top:8px; padding:7px;">  
<div id="subpage_content">
<?php include('weather_script/index.php');?>    
</div>
</div>
<div id="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert); ?>
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