<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$pg = "";
if(connection()){
    $recordperpage = 10;
    $pagenum = 1;
    if(isset($_GET['page'])){
        $pagenum = $_GET['page'];
        $pg = "-pg".$_GET['page'];
    }
    $offset = ($pagenum - 1) * $recordperpage;
    $result = MysqlSelectQuery("SELECT * FROM `faq` where status=1 ORDER BY faq_id desc limit $offset, $recordperpage");
}
$advert = "FAQ";
$title = "Frequently Asked Questions (FAQ) $pg - Nigerian Seminars and Trainings";
$meta_description = "Get answers to most the questions you have about Nigerian Seminars and Trainings $pg";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="Get answers to most the questions you have about Nigerian Seminars and Trainings<?php  echo $pg;?>"/>
<meta name="keywords" content="questions, answers, frequently asked questions, FAQ" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<?php include("scripts/headers_new.php");?>
<link rel="stylesheet" type="text/css" href="css/accordion.css" />
<style type="text/css">
.article_bg{
background-image: url(images/ArticleBG.png);
background-repeat: no-repeat;
background-position: center center;	
}
.shadow{
-webkit-box-shadow: 0px 0px 2px 0px rgba(50, 50, 50, 0.57);
-moz-box-shadow:    0px 0px 2px 0px rgba(50, 50, 50, 0.57);
box-shadow:         0px 0px 2px 0px rgba(50, 50, 50, 0.57);
}
.articleImg{
display:block;
padding:3px;
background-color:#F8F8F8;
}
.faq_content p{
line-height:20px;
font-style:normal;
}
.faq_content ul{
margin-left:10px;

}
.faq_content ul li{
list-style-position:inside;
padding-left:5px;
margin-bottom:3px;
text-shadow: 1px 1px 1px rgba(255,255,255,0.8);
font-size:12px;
}
</style>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
    <table style="width:100%">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px;text-align: center"><h1 style="font-size:28px; padding:5px;">Frequently Asked Questions (FAQ)</h1></td>
</tr>
<tr>
    <td style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</div>
<div id="sub_links">
<div id="contact-wrapper" style="border:none;"> 
<div class="video_box">
<?php if(NUM_ROWS($result) > 0){ ?>
<div class="ac-container">
<?php
$i = 1;
while($rows = SqlArrays($result)){
    if($i == 1)  $checked = 'checked';
    else    $checked = "";
?>
<section>
<input id="ac-<?php echo $i;?>" name="accordion-1" type="radio" <?php echo $checked;?> />
<h3 style="font-weight:normal"><label for="ac-<?php echo $i;?>"><?php echo stripslashes($rows['question']);?></label></h3>
<article class="ac-small">
<h4>&nbsp;</h4>
<blockquote style="max-height:180px; height:auto; overflow:auto;" class="faq_content">
<?php echo stripslashes($rows['answer']);?>
</blockquote>
</article>
</section>
<?php
$i ++;
}
?>
</div>
<?php if(connection()){ ?>

<div id="paging1">
<?php Paging("SELECT COUNT(faq_id) AS numrows FROM faq where status=1 ",$recordperpage,$pagenum,SITE_URL."faq?get"); ?>
<div class="clearfix"></div>
</div>
<div id="paging2">
<?php PagingMobile("SELECT COUNT(faq_id) AS numrows FROM faq where status=1 ",$recordperpage,$pagenum,SITE_URL."faq?get"); ?>
</div>

<?php } } else{ echo errorMsg("found no article(s) "); } ?>
</div>
</div>
<div class="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
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