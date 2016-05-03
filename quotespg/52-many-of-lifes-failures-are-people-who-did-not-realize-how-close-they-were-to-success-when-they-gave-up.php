<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$advert = "Quotes";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta property="og:image" content="http://localhost/nigerianseminars/images/quoteLogo.png"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="250"/>
<meta property="og:image:height" content="250"/>
<?php include('../tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="http://localhost/nigerianseminars/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Many of life’s failures are people who did not realize ho</title>
<meta name="description" content="Many of life’s failures are people who did not realize how close they were to success when they ga - Thomas A. Edison Quotes"/>
<meta name="dcterms.description" content="Many of life’s failures are people who did not realize how close they were to success when they ga - Thomas A. Edison Quotes" />
<meta property="og:title" content="Many of life’s failures are people who did not realize ho... - Thomas A. Edison" />
<meta property="og:description" content="Many of life’s failures are people who did not realize how close they were to success when they ga - Thomas A. Edison Quotes" />
<meta property="twitter:title" content="Many of life’s failures are people who did not realize ho... - Thomas A. Edison" />
<meta property="twitter:description" content="Many of life’s failures are people who did not realize how close they were to success when they ga - Thomas A. Edison Quotes" />
<?php include("../scripts/headers_new.php");?>
<style> .leftImage{ width:120px; height:120px; float:left; } .img { -moz-box-shadow: 0 0 30px 5px #999; -webkit-box-shadow: 0 0 30px 5px #999; }</style>
</head>
<body>
<?php include("../tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("../tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table >
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;">Quote of the day - January 16, 2014</h2></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</div>
<div id="contact-wrapper" class="rounded" style="margin-top:8px;margin-bottom:5px"> 
<div id="subpage_content">
<div  style="color:#03C; margin:10px; font-style:normal; font-weight:normal; font-size:18px">
<div style="float:left; padding-top:15px; padding-left:10px"><img src="http://localhost/nigerianseminars/images/quoteLogo.png" width="100" height="100" alt="nigerian seminars logo" class="articleImg shadow" /></div>
<blockquote class="blockQuote" style="margin-top:0px;"><img src="http://localhost/nigerianseminars/images/quote-icon.png" width="44" height="33" alt="Block Quote Image" />&nbsp;Many of life’s failures are people who did not realize how close they were to success when they gave up.&nbsp;<img src="http://localhost/nigerianseminars/images/quote-icon2.png" width="44" height="33" alt="nigerianseminars" /><br /><br />
<b style="color: #000; font-size:18px; font-style:italic">Thomas A. Edison</b>
</blockquote>
</div>
<div style="float:left;"> 
<div class="fb-like" data-href="http://localhost/nigerianseminars/quotespg/52-many-of-lifes-failures-are-people-who-did-not-realize-how-close-they-were-to-success-when-they-gave-up" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
<div class="fb-share-button" data-href="http://localhost/nigerianseminars/quotespg/52-many-of-lifes-failures-are-people-who-did-not-realize-how-close-they-were-to-success-when-they-gave-up" data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>
<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
po.src = 'https://apis.google.com/js/platform.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" title="Tweeter Share">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
<div style="float:right"><a href="http://localhost/nigerianseminars/quoteArchive" title="Veiw Quote Archive">View Quote Archive</a></div><br />                     
</div>
<div id="latest_content_items">
<!-- Section 1 Featured -->
<!-- End Featured 1 -->
</div><!-- end latest_content_items -->
</div>
<div id="sub_links2_middle">
<?php 
echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div>
<div class="video_box" style="margin-top:20px">
<?php
$result = MysqlSelectQuery("SELECT * FROM `dailyquote` WHERE status=1 ORDER BY RAND() limit 3");
if(NUM_ROWS($result) > 0){
?>
 <h3>Related Quotes</h3>
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
<span style="float:right;">Posted: <img src="<?php echo SITE_URL; ?>images/icon_clock.png" width="10" height="10" alt="clock image" /> <?php echo time_ago($rows['day_of_quote']);?></span>
<br />    <br /></td>
</tr>
<?php
$i++;
}
?>
</table>
<?php } ?>
</div>
<!-- end subpage -->
</div>
<?php include("../tools/side-menu_new.php");?>
</div>
</div>
<div class="clearfix"></div>
</div>
<?php include ("../tools/footer_new.php");?>

</body>
</html>