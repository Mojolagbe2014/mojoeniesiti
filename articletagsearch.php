<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection()){ $recordperpage = 10; $pagenum = 1; if(isset($_GET['page'])){ $pagenum = $_GET['page']; } $offset = ($pagenum - 1) * $recordperpage; }
$advert = "Articles"; $pg = "";
if(isset($_GET['tag'])){ $query = "WHERE tags like '%".$_GET['tag']."%'"; $result = MysqlSelectQuery("select * from articles $query order by article_id desc limit $offset , $recordperpage"); }


if(isset($_GET['page'])) { $pg = "-Pg".$_GET['page'];}
$title = "Articles about ".$_GET['tag']." $pg  - Nigerian Seminars and Tranings";
$meta = "Find all instances and places in article(s) where you will find the word / phrase: ".$_GET['tag']." $pg ";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta; ?>"/>
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="v" />
<meta property="twitter:description" content="<?php echo $meta; ?>" />
<?php include("scripts/headers_new.php");?>
</head>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div id="sub_links">
<h1 class="categoryHeader"> Article(s) about <?php echo $_GET['tag']?> </h1>
<div id="contact-wrapper" class="rounded"> 
<div class="video_box">
<?php if(NUM_ROWS($result) > 0){ ?>
<table style="width:100%" id="listTable">
<?php $i = 1; while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<tr>
<td style="width:5%;vertical-align: text-top"> <?php if($rows['articleImage']==""){?>
<img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.png" width="50" height="50" alt="nigerianseminarsandtrainings" />
<?php ;} else{?>
<img src="<?php echo SITE_URL;?>admin/articles_images/<?php echo $rows['articleImage'];?>" width="50"  height="50" alt="article-image"/>
<?php ;}?>
</td>
<td style="width:71.8%"><h2><a href="<?php echo SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" ><?php echo $rows['article_title'];?></a></h2>
<div style="font-size:12px; text-align:justify"><?php echo trimStringToFullWord(300, stripslashes(strip_tags($rows['article_description'])));?> <a href="<?php echo SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" style="font-size:10px; color:#999;" target="_blank">[Read more]</a></div>
</td>
<td style="width:23%;vertical-align: text-top"><strong>Posted:</strong> <img src="images/icon_clock.png" width="10" height="10" alt="clock" /> <?php echo time_ago($rows['articleDate']);?></td>
<td><h3>&nbsp;</h3></td>
</tr>
<?php $i++; } ?>
</table>
<?php
$thisTag = $_GET['tag'] ? $_GET['tag'] : "";
if(connection()){Paging("SELECT COUNT(article_id) AS numrows FROM articles  $query ",$recordperpage,$pagenum,SITE_URL."articletagsearch?tag=$thisTag");
}}else{echo errorMsg("found no event(s) for the selected category");} ?>
</div>
</div>
<div class="sub_links2_middle"><div class="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
</div>
<div class="divider"></div>
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
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