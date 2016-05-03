<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$advert = "'this-news-advert-name'";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta property="og:image" content="'news-fb-icon'"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="250"/>
<meta property="og:image:height" content="250"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="'site-url'images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>'this-news-page-title'</title>
<meta name="description" content="'meta-description'"/>
<meta name="dcterms.description" content="'meta-description'" />
<meta property="og:title" content="'this-news-page-title'" />
<meta property="og:description" content="'meta-description'" />
<meta property="twitter:title" content="'this-news-page-title'" />
<meta property="twitter:description" content="'meta-description'" />
<?php include("../scripts/headers_new.php");?>
<?php include('../tools/analytics.php');?>
</head>
<body>
<?php include("../tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("../tools/categories_new.php");?>
<div id="content_left">
<div id="sub_links">
<div class="event_table_inner">
<table style="width:100%;" >
<tr>
<td style="padding-left:8px; width:11%; text-align:center;">
<div style="float:left; width:120px">'this-news-image'</div>     
</td>
<td style="width:77%; text-align:center;"><h1 style="font-size:23px; text-align:center;">'this-news-title'</h1>
<h2 style="font-weight:normal;font-size:12px;"><span class="span_detail">Posted:</span>
'this-news-posted-date'</h2>
</td>
</tr>
</table>
<div class="clearfix"></div>
</div>
<div id="contact-wrapper" class="rounded"  style="margin-top:8px;"> 
<div class="video_box">
<table style="width:100%;" id="listTable">
<tr>
<td style="color:#333; text-align:justify; line-height:20px"><div class="description" style="font-size:13px;">'this-news-description'</div>
</td>
</tr>
</table>  
<div class="tags">
<div> 
<p style="float:left; margin-right:8px;"><strong>Share this news:</strong></p> 
<div style="float:left;"> 
<div class="fb-like" data-href="'this-news-page-link'" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
<div class="fb-share-button" data-href="'this-news-page-link'" data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>
<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/platform.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<div class="clearfix"></div>
</div>
</div>
<div class="event_social">
<div class="tags">
<h3 style="font-weight: normal;">
<span>
<strong style="float:left; margin-right:8px;">Tags: </strong>'this-news-tags'
</span>
</h3>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<div class="fb-comments" data-href="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" data-width="720px" data-numposts="5" data-colorscheme="light"></div>
<div id="sub_links2_middle">
<!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
<?php $result = MysqlSelectQuery("SELECT * FROM news ORDER BY RAND() DESC LIMIT 3 "); if(NUM_ROWS($result) > 0){ ?>
<div style="margin-top:20px">
<h3>Related News</h3>
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
</div>
<?php } ?>
</div>
<!-- end subpage -->
</div>	
</div>
<?php include("../tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("../tools/footer_new.php");?>

</body>
</html>