<?php
require_once("scripts/config.php"); require_once("scripts/functions.php"); if(connection());
$recordperpage =  20; $pagenum = 1; $thisPage=""; 
if(isset($_GET['page'])){ $thisPage = " -Pg".$_GET['page']; $pagenum = $_GET['page']; } $offset = ($pagenum - 1) * $recordperpage; $advert = "archive";
$thisTag = $_GET['tag'] ? $_GET['tag'] : "";

$title = trimStringToFullWord(60, stripslashes(strip_tags("News about $thisTag $thisPage - Nigerian Seminars and Trainings"))); 
$meta = trimStringToFullWord(150, stripslashes(strip_tags("Find all instances and places in news where you will find the word / phrase: $thisTag $thisPage")));
if(isset($_GET['tag'])){ $query = "WHERE tags like '%".$_GET['tag']."%'"; $result = MysqlSelectQuery("select * from news $query order by news_id desc limit $offset , $recordperpage"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $meta;?>"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta name="dcterms.description" content="<?php echo $meta;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta;?>" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table style="width:100%; border:0px;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;"><p>News about <?php echo ucwords($_GET['tag']);?></p></h1></td>
</tr>
<tr>
<td align="center" style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</form>
</div>
<div id="subpage">
<div id="contact-wrapper" class="rounded" style="margin-top:8px; padding-top:8px;">
<?php if(NUM_ROWS($result) > 0){ $i = 0; while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<table bgcolor="<?php //echo $bg;?>" class="listing_table_event">
<tr>
<td><h3><a href="<?php echo SITE_URL."news/".$rows['News_id']."/".str_replace($title_link,"-",substr($rows['newsTitle'],0,150))."/";?> " style="color: #0066FF; text-decoration:none;"><?php echo $rows['newsTitle'];?></a></h3><strong>Date:</strong> <?php echo $rows['posted_date'];?></td>
</tr>
<tr>
<td><?php echo substr (strip_tags($rows['description']),0,250);?><br />
</td>
</tr>
</table>
<?php $i++; } Paging("SELECT COUNT(News_id) AS numrows FROM news $query ",$recordperpage,$pagenum,"newstagSearch?get"); } else{ echo errorMsg("Nothing found!"); } ?>
</div>
</div>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
</div>
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>