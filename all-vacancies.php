<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$recordperpage =  20;
$pagenum = 1;
if(isset($_GET['page'])){
    $pagenum = $_GET['page'];
}
$offset = ($pagenum - 1) * $recordperpage;
$result = MysqlSelectQuery("select * from vacancies where status = 1 order by job_id desc limit $offset , $recordperpage");
$advert = "All Vacancies";
$title = "All Vacancies - Nigerian Seminars and Trainings";
$meta_description = "Latest training vacancies and training facilitation opportunities in Nigeria and around the world.";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_description;?>"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta name="keywords" content="<?php echo $title; ?>" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<?php include("scripts/headers_new.php");?>
<?php include('tools/analytics.php');?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="sub_links">
<div class="event_table_inner">
<table style="width:100%">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px;text-align: center"><h1 style="font-size:24px; padding:5px;">Latest Training/Facilitation Vacancies</h1></td>
</tr>
<tr>
    <td style="font-size:11px"><h2>&nbsp;</h2><h3>&nbsp;</h3></td>
</tr>
</table>
</div>
<div id="subpage">
<div id="contact-wrapper" class="rounded" style="margin-top:8px; padding-top:8px;">
<?php
if(NUM_ROWS($result) > 0){
$i = 0;
while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<table class="listing_table_event">
<tr>
<td colspan="2"><a href="<?php echo SITE_URL;?>vacancy/full/<?php echo $rows['job_id'];?>/<?php echo str_replace($title_link,"-",$rows['title']);?>" title="<?php echo $rows['title'];?>"><?php echo $rows['title'];?></a></td>
<td style="width:18%;">&nbsp;</td>
<td style="width:5%;"><img src="images/star.png" width="22" height="23" alt="start image"/></td>
</tr>
<tr>
<td colspan="2" style="font-size:11px; width:10%;"><?php echo substr(strip_tags($rows['description']),"0",200)."...";?></td>
<td><span style="color:#090; width:67%;"><img src="images/icon_clock.png" width="10" height="10" alt="clock image" /> <?php echo time_ago($rows['posted_date']);?></span></td>
<td></td>
</tr>
<tr>
<td style="font-size:11px; width:10%;"><strong>Company:</strong></td>
<td style="color:#090; width:67%;"><?php echo $rows['company_name'];?></td>
<td></td><td></td>
</tr>
<tr>
<td style="font-size:11px;"><strong>Location:</strong></td>
<td><img src="images/icon.gif" width="7" height="8" alt="location image" /> <?php echo $rows['city']." , ".$rows['country'];?></td>
<td><a href="<?php echo SITE_URL;?>vacancy/full/<?php echo $rows['job_id'];?>/<?php echo str_replace($title_link,"-",$rows['title']);?>" title="Full Detail">Full Detail</a></td>
<td><a href="<?php echo SITE_URL;?>apply">Apply</a></td>
</tr>
</table>
<?php $i++; } ?>
<div id="paging1">
<?php Paging("SELECT COUNT(job_id) AS numrows FROM vacancies where status = 1",$recordperpage,$pagenum,"all_vacancies?get"); ?>
</div>
<div id="paging2">
<?php PagingMobile("SELECT COUNT(job_id) AS numrows FROM vacancies where status = 1",$recordperpage,$pagenum,"all_vacancies?get"); ?>
</div>
<?php	 } else{ echo errorMsg("No training vacancy found!"); } ?>
</div>
</div>
<div id="sub_links2_middle">
<div class="respond">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
</div>
</div>               
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div><!-- end subpage -->
<?php include("tools/side-menu_new.php");?>	
</div>	
<div class="clearfix"></div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php include ("tools/footers_new.php");?>
</body>
</html>