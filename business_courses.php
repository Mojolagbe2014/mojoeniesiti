<?php
session_start(); require_once("scripts/config.php"); require_once("scripts/functions.php");
$paged = ""; $pageSuffix  = ""; $title = ""; $pageInnerTitle = ""; $pastLink =""; $pastEvent =""; $today = date("Y-m-d"); $dtds3=date("F"); $advert = "";
if(isset($_GET['courses'])){
    $business_id = explode(',',$_GET['courses']);
    $business_name = MysqlSelectQuery("SELECT * FROM `businessinfo` left join logos using (user_id) WHERE business_id='".$business_id[0]."'");
    $business_name = SqlArrays($business_name);
    $name = $business_name['business_name'];
    if($business_name['logos'] == '') $logo = ''; else $logo = '<img src="'.SITE_URL.'premium/logos/thumbs/'.$business_name['logos'].'" alt="business logo" width="70" height="70" style="margin-left:auto; margin-right:auto;" class="articleImg shadow"/>';
}
$recordperpage = 20; $pagenum = 1;
if(isset($_GET['page'])){ $pageSuffix = "".$_GET['page']; $pagenum = $_GET['page']; }
$offset = ($pagenum - 1) * $recordperpage; $query = "and SortDate >= '$today'";
$paged = SITE_URL."courses/business/".$_GET['courses']."/"; $pastEvent = "View past events by ".$name;
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE organiser like'%".$name."%' and status = 1 $query ORDER BY  premium desc, SortDate limit $offset, $recordperpage");
$total_event = NUM_ROWS($result);
$title = trimStringToFullWord(64, stripslashes(strip_tags("Training by ".$name." ".$pageSuffix." - Nigerian Seminars and Trainings")));
$meta = trimStringToFullWord(150, stripslashes(strip_tags("All upcoming training, seminars and workshops by ".$name." -".$pageSuffix)));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta; ?>"/>
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta; ?>" /><?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="sub_links">
<div class="event_table_inner">
<form action="" method="post">
<table width="100%" border="0" class="smart-forms" style="padding:9px;">
<tr>
<td width="13%" align="left" style="padding-left:8px">
<?php echo $logo;?>
<?php if(!empty($business_name['cmd_accr_number'])){ echo '<img src="'.SITE_URL.'images/accreditation.png" style="margin-top: 5px;" />'; } ?>
</td>
<td width="87%" align="center" ><h2 style="font-size:25px; text-align:center; margin-bottom:8px;"><p>Upcoming training, seminars and workshops by <?php echo $name;?>
</p>
</h2></td>
</tr>
</table>
</form>
</div>
<?php include("tools/search_box.php");?>
<div class="video_box">
<?php include("tools/searchResult.php");?>
<?php if(NUM_ROWS($result) > 0){ ?>
<div style="float:left; width:100%;"> 
<div id="paging1">
<?php Pages_rewrite("SELECT COUNT(event_id) AS numrows FROM events WHERE organiser like'%".$name."%' and status = 1 $query ",$recordperpage,$pagenum,$paged); ?>
</div>
<div id="paging2">
<?php Pages_rewrite_mobile("SELECT COUNT(event_id) AS numrows FROM events WHERE organiser like'%".$name."%' and status = 1 $query ",$recordperpage,$pagenum,$paged); ?>
</div>
</div>
<?php } ?>	 
<div><a href="<?php echo SITE_URL;?>past-event?business=<?php echo $_GET['courses'];?>" class="button_class_right cssButton_roundedLow cssButton_aqua_22" ><i class="fa fa-backward"></i>&nbsp;<?php echo $pastEvent;?></a></div>
</div>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
</div>               
<div class="clearfix"></div>
</div>
</div><!-- end subpage -->
<?php include("tools/side-menu_new.php");?>	
</div>	
<div class="clearfix"></div>
</div></div>
<?php include ("tools/footer_new.php");?>

</body>
</html>