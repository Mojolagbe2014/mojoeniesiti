 <?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "Error Page"; $timeStamp = " [".time()."] "; 
$title = "Payment Response Page - Nigerian Seminars and Trainings";
$description = "payment cancel";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<title> <?php echo $title; ?> </title>
<meta name="description" content="<?php echo $description; ?>"/>
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div id="subpage">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Transaction Response</h2></td>
</tr>
<tr>
<td align="center" style="font-size:11px">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="subpage_content">
<div>
<br/><br/>

 <div class="alert alert-danger"><p><strong>Your transaction was not successful<br/> Reason: '
    .Payment cancelled
   </strong></p></div>';

</div>
</div>
</div><!-- end subpage -->
</div>
<div id="sidebar" style="text-align: center;">
<!-- Begin Addynamo Code -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- InnerpageScyscraper -->
<ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px" data-ad-client="ca-pub-8065984041001502" data-ad-slot="9730644677"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>    
<!-- End Addynamo Code -->
</div>
</div>
<div id="content_bottom"></div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>
</div>
</div>
</div>

</body>
</html>
