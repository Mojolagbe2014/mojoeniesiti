<?php 
session_start(); require_once("scripts/config.php"); require_once("scripts/functions.php");
if(isset($_GET['author'])) { $author  = str_replace("-"," ",$_GET['author']); }
$recordperpage = 10; $pagenum = 1; $thisPage = "";
if(isset($_GET['page'])){ $thisPage = " -Pg".$_GET['page']; $pagenum = $_GET['page']; } 
$offset = ($pagenum - 1) * $recordperpage;
$thisAuthor = $_GET['author'] ? str_replace("-", " ", $_GET['author']) : "";
$result = MysqlSelectQuery("SELECT * FROM `articles` where status=1 and author like '%".$author."%' ORDER BY articleDate desc limit $offset, $recordperpage");
$rowName = SqlArrays($result); $advert = "Articles";
$title = trimStringToFullWord(60, stripslashes(strip_tags("Articles by $thisAuthor $thisPage - Nigerian Seminars and Trainings")));
$meta = trimStringToFullWord(150, stripslashes(strip_tags("Search, find and download professional, academic and general purpose articles by $thisAuthor $thisPage")));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title> <?php echo $title; ?> </title>
<meta name="description" content="<?php echo $meta; ?>"/>
<meta name="keywords" content="articles, write-ups, journals, reports, educational reprots, reports about Nigeira" />
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta; ?>" />
<?php include("scripts/headers_new.php");?>
<style type="text/css"> .article_bg { background-image: url(images/article_bg.png); background-repeat: no-repeat; overflow: hidden; } .shadow{ -webkit-box-shadow: 0px 0px 2px 0px rgba(50, 50, 50, 0.57); -moz-box-shadow:    0px 0px 2px 0px rgba(50, 50, 50, 0.57); box-shadow:         0px 0px 2px 0px rgba(50, 50, 50, 0.57);} .articleImg{display:block;padding:3px;background-color:#F8F8F8;}</style>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;">Articles by <?php echo $author ;?></h2></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="sub_links">
<div id="contact-wrapper" class="rounded "> 
<div class="video_box">
<?php if(NUM_ROWS($result) > 0){  ?>
<table style="width:100%;" id="listTable">
<?php $i = 1; while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<tr>
<td style="vertical-align:top; width:5%;"> <?php if($rows['articleImage']==""){?>
<img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.png" width="50" height="50" alt="nigerianseminarsandtrainings" class="articleImg shadow" />
<?php ;} else{?>
<img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['articleImage'];?>" width="50"  height="50" alt="Articles nigerian seminars and training" class="articleImg shadow"/>
<?php ;}?>
</td>
<td style="width:72%;"><p><a href="<?php echo SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" style="font-size:14px; font-weight:normal;" ><?php echo $rows['article_title'];?></a></p>
<div style="font-size:12px; text-align:justify"><?php echo substr(strip_tags(stripslashes($rows['article_description'])),0,300);?> <a href="<?php echo SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" style="font-size:10px; color:#999;" target="_blank">[Read more]</a></div>
</td>
<td style="vertical-align:top; width:23%;"><strong>Posted:</strong> <img src="<?php echo SITE_URL;?>images/icon_clock.png" width="10" height="10" alt="Articles nigerian seminars and training" /> <?php echo time_ago($rows['articleDate']);?></td>
</tr>
<?php $i++; } ?>
</table>
<?php if(connection()){ ?>
<div id="paging1">
<?php Paging("SELECT COUNT(article_id) AS numrows FROM articles where status=1 and author like '%".$author."%' ",$recordperpage,$pagenum,SITE_URL."author/$author"); ?>
</div>
<div id="paging2">
<?php PagingMobile("SELECT COUNT(article_id) AS numrows FROM articles where status=1 and author like '%".$author."%' ",$recordperpage,$pagenum,SITE_URL."author/$author"); ?>
</div>
<?php } } else{ echo errorMsg("Found no article(s) for the selected author"); } ?>
</div>
</div>
<div class="sub_links2_middle"><div class="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
</div>
<div class="clearfix"></div>
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