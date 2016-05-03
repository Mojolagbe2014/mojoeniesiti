<?php
require_once("scripts/config.php"); require_once("scripts/functions.php");
if(connection()){ $recordperpage = 10; $pagenum = 1; if(isset($_GET['page'])){ $pagenum = $_GET['page']; } $offset = ($pagenum - 1) * $recordperpage; }
$advert = "Articles"; $result =''; $pg =""; $thisTag ="";
if(isset($_GET['tag'])){$thisTag = $_GET['tag']; $query = "AND tags like '%".$_GET['tag']."%'"; $result = MysqlSelectQuery("SELECT * FROM `dailyquote` WHERE status=1 $query ORDER BY day_of_quote desc limit $offset, $recordperpage"); }
if(isset($_GET['page'])) { $pg = "-Pg".$_GET['page'];}
$title = $thisTag." Quotes $pg  - Nigerian Seminars and Tranings";
$meta = "Find all instances and places in quote(s) where you will find the word / phrase: ".$thisTag." $pg ";
$keywords = $thisTag;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="keywords" content="<?php echo $keywords; ?>"/>
<meta name="description" content="<?php echo $meta; ?>"/>
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta; ?>" />
<?php include("scripts/headers_new.php");?>
<style> .black_overlay{display:none;position:absolute;top:0;left:0;width:100%;height:100%;background-color:#000;z-index:1001;-moz-opacity:.7;opacity:.70;filter:alpha(opacity=70)}.white_content{display:none;position:fixed;top:9%;left:27%;width:30%;height:45%;padding:16px;border:4px solid #090;background-color:white;z-index:1002} </style>  
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:22px; padding:5px; color:#000;">Quote(s) about <?php if(isset($_GET['tag'])) {echo ucwords($_GET['tag']);} ?></h1></td>
</tr>
<tr>
<td style="font-size:11px"><h2>&nbsp;</h2><h3>&nbsp;</h3></td>
</tr>
</table>
</div>
<div id="sub_links">
<div id="contact-wrapper" class="rounded"> 
<div class="video_box">
<?php if($result != ''){ if(NUM_ROWS($result) > 0){ ?>
<table id="listTable" style="padding-bottom:5px; padding-top:5px">
<?php $i = 1; while($rows = SqlArrays($result)){ if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";} ?>
<tr>
<td style="vertical-align:top; width:5%;"><img src="images/star.png" width="22" height="23" /></td>
<td style="width:72%;" ><p></p>
<div style="font-size:12px; text-align:center" ><a href="<?php echo SITE_URL.'quote/full/'.$rows['quote_id'].'/'.str_replace($title_link,"-",substr($rows['quote'],0,70));?>" title="<?php echo substr(stripslashes($rows['quote']),0,300);?>" ><?php echo substr(stripslashes($rows['quote']),0,300);?></a><br /> </div>
<div style="float:right"><span style="font-weight:normal; color:#090;"><i style="text-indent:inherit; font-weight:bold"><?php  echo $rows['authur'];?></i></span></div><br /><br />
<!-- <a  href = "javascript:ShowlightBox('<?php //echo substr(stripslashes(str_replace("'","",$rows['quote'])),0,300);?>', '<?php //echo $rows['authur'];?>')" >EMAIL</a>&nbsp;&nbsp;&nbsp;&nbsp;--> <div style="padding-bottom:7px; padding-top:8px;" ><div style=" padding-top:9px; padding-bottom:9px; font-size:12px" ><span style="font-weight:900"><?php if(!empty($rows['tags'])){ echo'Tags:';}?></span><?php  echo tags($rows['tags'],'quotearchivetagsearch');?></div>
<div  class="fb-like" data-href="<?php echo SITE_URL;?>quoteFull?quoteID=<?php echo $rows['quote_id'];?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div></div>
</td>
<td style="vertical-align:top; width:23%;"><strong>Posted:</strong> <img src="images/icon_clock.png" width="10" height="10" alt="clock image" /> <?php echo time_ago($rows['day_of_quote']);?></td>
</tr>
<?php $i++; } ?>
</table>
<?php
if(connection()){ Paging("SELECT COUNT(quote_id) AS numrows FROM dailyquote where status = 1 $query ",$recordperpage,$pagenum,SITE_URL."quotearchivetagsearch?get"); } } 
else{ echo errorMsg("found no quote(s) for the selected category"); }} ?>
</div>
</div>
<div class="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
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