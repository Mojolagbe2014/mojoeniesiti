<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "quoteFull";
if(isset($_GET['quoteID'])){
$result = MysqlSelectQuery("SELECT * FROM `dailyquote` WHERE status=1 and quote_id='".$_GET['quoteID']."'");
$rows = SqlArrays($result);
}
?>
<?php 
$image="";
if($rows['quoteImage']==""){
$image='<img src="'.SITE_URL.'images/quoteLogo.png" width="102" height="108" alt="nigerianseminarsand trainings" class="leftImage" />';
$imgFB = 'images/quoteLogo.png';
}
else{
$image='<img src="'.SITE_URL.'admin/quoteImages/'.$rows['quoteImage'].'" width="102" height="108" alt="nigerianseminarsand trainings" class="leftImage" />';
$imgFB = 'admin/quoteImages/'.$rows['quoteImage'];
}
//this gets the characters 0 to the period and stores it in $newFile
$newFile = trim(WordTruncate($rows['quote'], 50)); //Use seven words as file name
$newFile = str_replace(" ", "000", $newFile);
//Remove special Characters
$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
//Replace spaces with dash/hyphen
$newFile = str_replace("000", "-", $newFile);
$newFile = str_replace("--", "-", $newFile);
//Covert d name to lowercase
$fileNameAsLink = strtolower($rows['quote_id']."-".$newFile);
$newFile = strtolower($rows['quote_id']."-".$newFile);//.".php"
//Redirect to the new quote file page
header("HTTP/1.1 301 Moved Permanently");
header("Location:".SITE_URL.'quotespg/'.$newFile);
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta property="og:image" content="<?php echo SITE_URL.$imgFB;?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="250"/>
<meta property="og:image:height" content="250"/>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo substr($rows['quote'],0,80)."... - ".$rows['authur'];?></title>
<meta name="description" content="<?php echo substr($rows['quote'],0,100);?> - <?php echo $rows['authur'];?> Quotes"/>

<meta name="dcterms.description" content="<?php echo substr($rows['quote'],0,100);?> - <?php echo $rows['authur'];?> Quotes" />
<meta property="og:title" content="<?php echo substr($rows['quote'],0,80)."... - ".$rows['authur'];?>" />
<meta property="og:description" content="<?php echo substr($rows['quote'],0,100);?> - <?php echo $rows['authur'];?> Quotes" />
<meta property="twitter:title" content="<?php echo substr($rows['quote'],0,80)."... - ".$rows['authur'];?>" />
<meta property="twitter:description" content="<?php echo substr($rows['quote'],0,100);?> - <?php echo $rows['authur'];?> Quotes" />
<?php include("scripts/headers_new.php");?>
<style>
.leftImage{
width:120px;
height:120px;
float:left;
}
.img {
-moz-box-shadow: 0 0 30px 5px #999;
-webkit-box-shadow: 0 0 30px 5px #999;
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

<table >
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;">Quote of the day - <?php echo date("F j, Y",strtotime($rows['day_of_quote']));?></h2></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</div>
<div id="contact-wrapper" class="rounded" style="margin-top:8px;"> 
<div id="subpage_content">
<div  style="color:#03C; margin:10px; font-style:normal; font-weight:normal; font-size:18px">
<div style="float:left; padding-top:15px; padding-left:10px">
<?php echo $image?>
</div>
<blockquote class="blockQuote" style="margin-top:0px;"><img src="<?php echo SITE_URL;?>images/quote-icon.png" width="44" height="33" alt="Block Quote Image" />&nbsp;<?php echo $rows['quote']?>&nbsp;<img src="<?php echo SITE_URL;?>images/quote-icon2.png" width="44" height="33" alt="nigerianseminars" /><br /><br />
<b style="color: #000; font-size:18px; font-style:italic"><?php echo $rows['authur']?></b>
</blockquote>
</div>
<div style="float:left;"> 
<div class="fb-like" data-href="<?php echo SITE_URL.'quote/full/'.$rows['quote_id'].'/'.str_replace($title_link,"-",substr($rows['quote'],0,70));?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
<div class="fb-share-button" data-href="<?php echo SITE_URL.'quote/full/'.$rows['quote_id'].'/'.str_replace($title_link,"-",substr($rows['quote'],0,70));?>" data-type="button_count"></div>
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
<div style="float:right"><a href="<?php echo SITE_URL;?>quoteArchive" title="Veiw Quote Archive">Veiw Quote Archive</a></div><br />                     
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
<!-- end subpage -->
</div>

<?php include("tools/side-menu_new.php");?>
</div>
</div>

<div class="clearfix"></div>

</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>