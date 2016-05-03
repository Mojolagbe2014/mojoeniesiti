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
$result = MysqlSelectQuery("select * from videos order by id desc limit $offset , $recordperpage");
$advert = "All Videos";
$title = "Watch Training Videos - Nigerian Seminars and Trainings";
$meta_description = "Watch seminars and training videos, tutorials, documentaries and other educational events videos live on Nigerian Seminars and Trainings";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_description;?>"/>
<meta name="keywords" content="<?php echo $title; ?>" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/cmxform.css" type="text/css" media="screen" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;">Watch Training Videos</h1></td>
</tr>
<tr>
<td style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</div>
<div id="subpage">
<div id="contact-wrapper-inner" class="rounded" style="margin-top:8px;">
<?php
if(NUM_ROWS($result) > 0){ $i = 0; while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<table style="width:100%;" class="listTable_home">
<tr>
<td style="width:20%;" rowspan="2"><p><a href="video-watch?id=<?php echo $rows['id'];?>" title="<?php echo $rows['video_title'];?>"><img src="http://img.youtube.com/vi/<?php echo $rows['video_id'];?>/2.jpg" class="youTube" alt="nigerian seminars and training youtube "/></a></p>      
</td>
<td style="vertical-align:top"><p style="color:#090; font-size:11px"><a href="video-watch?id=<?php echo $rows['id'];?>" title="<?php echo $rows['video_title'];?>"><?php echo $rows['video_title'];?></a></p></td>
<td></td>
</tr>
<tr>
<td  style="vertical-align:top"><?php echo substr($rows['description'],0,150);?></td><td></td>
</tr>
<tr>
<td style=" text-align:right;">Posted:</td>
<td style="width:61%;"><img src="images/icon_clock.png" width="10" height="10" alt="CLOCK Image"  /> <?php echo time_ago($rows['posted_date']);?></td>
<td></td>
</tr>
</table>
<?php $i++; } Paging("SELECT COUNT(id) AS numrows FROM videos ",$recordperpage,$pagenum,"videos_all?get"); }
else { echo errorMsg("No Training videos Found"); } ?>
</div>
</div>
</div>
<h3>&nbsp;</h3>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>

</div>
</body>
</html>