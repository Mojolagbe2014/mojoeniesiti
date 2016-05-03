<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection()){
$recordperpage = 10;
$pagenum = 1;
if(isset($_GET['page'])){
$pagenum = $_GET['page'];
}
$offset = ($pagenum - 1) * $recordperpage;
$result = MysqlSelectQuery("SELECT * FROM `dailyquote` WHERE status=1 ORDER BY quote_id desc limit $offset, $recordperpage");
}
$advert = "Quotes";
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Quote Archive: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?></title>
<meta name="description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>"/>
<meta name="dcterms.description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />
<meta property="og:title" content="Quote Archive: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />
<meta property="og:description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />
<meta property="twitter:title" content="Quote Archive: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />
<meta property="twitter:description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />
<link rel="stylesheet" type="text/css"  href="css/min-all-css.css" />
<?php //include("scripts/headers_new.php");?>
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
<td style="padding-left:8px"><h1 style="font-size:22px; padding:5px; ">Quotes Archive</h1></td>
</tr>
<tr>
    <td style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</div>
<div id="sub_links">
<div id="contact-wrapper" class="rounded"> 
<div class="video_box">
<?php
if(NUM_ROWS($result) > 0){
?>
<table id="listTable" style="padding-bottom:5px; padding-top:5px;width:100%;">
<?php
$i = 1;
while($rows = SqlArrays($result)){
if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
?>
<tr class="adjust">
<td style="vertical-align:top;">
<br />
<div style="font-size:12px; text-align:center;" >
<?php
//this gets title stores it in $newFile
$newFile = trim(WordTruncate($rows['quote'], 50)); //Use seven words as file name
$newFile = str_replace(" ", "000", $newFile);
//Remove special Characters
$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
//Replace spaces with dash/hyphen
$newFile = str_replace("000", "-", $newFile);
$newFile = str_replace("--", "-", $newFile);
//Covert d name to lowercase
$newFile = strtolower($rows['quote_id']."-".$newFile);//.".php"
?>
    <h3 style="font-weight:normal; font-size:18px;"><a href="<?php echo SITE_URL.'quotespg/'.$newFile;?>" style="font-weight:normal; font-size:18px;" title="<?php echo substr(stripslashes($rows['quote']),0,300);?>">" <?php echo substr(stripslashes($rows['quote']),0,300);?> "</a></h3>
<br />
<span style="font-weight:normal; color:#666;">
<?php  echo $rows['authur'];?>
</span><br /><br />
</div>
<div style="padding-top:3px; padding-bottom:9px; font-size:12px" class="tags"  >
<div>
<div style="border:none; background-color:#FFFFFF;"> <strong style="float:left;"><?php if(!empty($rows['tags'])){ echo'Tags: ';}?>&nbsp;&nbsp;</strong> <?php echo tags($rows['tags'],'quotearchivetagsearch');?> <div class="clearfix"></div></div>
</div>
</div>
<div class="fb-like" data-href="<?php echo SITE_URL.'quotespg/'.$newFile;?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
<span style="float:right;">Posted: <img src="images/icon_clock.png" width="10" height="10" alt="clock image" /> <?php echo time_ago($rows['day_of_quote']);?></span>
<br />    <br /></td>
</tr>
<?php
$i++;
}
?>
</table>
<?php
if(connection()){
Paging("SELECT COUNT(quote_id) AS numrows FROM dailyquote ",$recordperpage,$pagenum,SITE_URL."quoteArchive?get");
}
}
else{
echo errorMsg("found no event(s) for the selected category");
}
?>
</div>
</div>
<div class="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include("tools/side-menu_new.php");?>
</div>
</div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>