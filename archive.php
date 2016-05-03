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
$result = MysqlSelectQuery("select * from news order by news_id desc limit $offset , $recordperpage");
$advert = "News";
if(isset($_GET['page'])){
$title = "News and Updates Archive (".$_GET['page'].") - Nigerian Seminars and Trainings ";
$meta_content = "Read past news, recent developments, new features, updates from Nigerian Seminars and Trainings Page ".$_GET['page'];
}
else{
$title = "News and Updates Archive - Nigerian Seminars and Trainings ";
$meta_content = 'Read past news, recent developments, new features, updates from Nigerian Seminars and Trainings';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $meta_content;?>"/>
<meta name="keywords" content="news in Nigeria, updates, training news, education news, conference news, semianr news" />
<meta name="dcterms.description" content="<?php echo $meta_content;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta_content;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta_content;?>" />
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
<table >
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:28px; padding:5px;">News / Updates</h1></td>
</tr>
<tr>
    <td style="font-size:11px"><h2>&nbsp;</h2><h3>&nbsp;</h3></td>
</tr>
</table>
</form>
</div>
<div id="subpage">
<div id="subpage_content">
<div id="contact-wrapper" class="rounded" style="margin-top:8px;"> 
<div class="video_box">
<?php if(NUM_ROWS($result) > 0){ ?>
<table style="width:100%;" id="listTable">
<?php $i = 1; while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<tr>
<td style="vertical-align:top; width:5%;"> <?php if($rows['image']==""){?>
<img src="<?php echo SITE_URL;?>images/news_image_BIG.png" width="70" height="70" alt="nigerianseminarsandtrainings" class="articleImg shadow" />
<?php ;}
else{?>
<img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['image'];?>" width="70"  height="70" alt="Articles nigerian seminars and training" class="articleImg shadow"/>
<?php ;}?>
</td>
<?php
//this gets the characters 0 to the period and stores it in $newFile
$newFile = trim(WordTruncate($rows['newsTitle'], 50));
$newFile = str_replace(" ", "000", $newFile);
//Remove special Characters
$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
//Replace spaces with dash/hyphen
$newFile = str_replace("000", "-", $newFile);
$newFile = str_replace("--", "-", $newFile);
//Covert d name to lowercase
$newFile = strtolower($rows['News_id']."-".$newFile);//.".php"
?>
<td style="width:72%;"><p><a href="<?php echo SITE_URL.'newspg/'.$newFile;?>" style="font-size:14px; font-weight:normal;" ><?php echo $rows['newsTitle'];?></a></p>
<div style="font-size:12px; text-align:justify"><?php echo substr(strip_tags(stripslashes($rows['description'])),0,300);?> <a href="<?php echo SITE_URL.'newspg/'.$newFile;?>" style="font-size:10px; color:#999;" target="_blank">[Read more]</a></div>
</td>
<td style="vertical-align:top; width:23%;"><strong>Posted:</strong> <img src="<?php echo SITE_URL;?>images/icon_clock.png" width="10" height="10" alt="Articles nigerian seminars and training" /> <?php echo time_ago($rows['posted_date']);?></td>
</tr>
<?php $i++; } ?>
</table>
<?php if(connection()){ ?>
<div id="paging1">
<?php Paging("SELECT COUNT(News_id) AS numrows FROM news ",$recordperpage,$pagenum,"archive?get"); ?>
<div class="clearfix"></div>
</div>
<div id="paging2">
<?php PagingMobile("SELECT COUNT(News_id) AS numrows FROM news ",$recordperpage,$pagenum,"archive?get"); ?>
</div>
<?php } } else{ echo errorMsg("found no article(s) "); } ?>
</div>
</div>
</div>
</div>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
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