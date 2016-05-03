<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$id = "";
if(isset($_GET['newsletter_id'])) $id = $_GET['newsletter_id'];
if(connection()){
	$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
	
	$result = MysqlSelectQuery("select * from newsletters where news_art_ID = '$id' limit $offset, $recordperpage");
	if(NUM_ROWS($result) == 0) header("location:" .SITE_URL."404error");
	$rows = SqlArrays($result);
}
$advert = "News";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title><?php echo substr($rows['title'],0,69);?></title>
<meta name="description" content="<?php echo substr(strip_tags($rows['description']),0,130)."(NWID:".$rows['news_art_ID'].")";?>"/>
	
	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />
	<?php include("scripts/headers_new.php");?>
	
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "e446ce80-aeac-4f49-8e56-45d77e901435"}); </script>
    
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-2fH5lI6K2ceJA"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<?php include("tools/header_new.php");?>

<div id="main">

	<div id="content">
    <?php include("tools/categories_new.php");?>
		<div id="content_left">
				<div id="sub_links">
                <div id="contact-wrapper" class="rounded"> 
				<div class="video_box">
                
					<table width="100%" id="listTable">
                  
  <tr>
    <td colspan="4"><p><a href="#"><?php echo $rows['title'];?></a></p>
    </td>
    </tr>
  <tr>
    <td colspan="3"><p style="color:#090; font-size:11px"><a href="<?php echo SITE_URL;?>download/<?php echo $rows['news_art_ID'];?>/<?php echo $rows['file'];?>" target="_blank">Download <img src="<?php echo SITE_URL;?>images/pdf-icon.png" width="20" height="20" style="float:left" /></a></p></td>
    <td width="53%"><span class='st_sharethis_large' displayText='ShareThis'></span>

<span class='st_facebook_large' displayText='Facebook'></span>

<span class='st_googleplus_large' displayText='Google +'></span>

<span class='st_twitter_large' displayText='Tweet'></span>

<span class='st_linkedin_large' displayText='LinkedIn'></span>

<span class='st_pinterest_large' displayText='Pinterest'></span>

<span class='st_email_large' displayText='Email'></span></td>
  </tr>
  <tr bgcolor="#F7F7F7" class="description">
    <td colspan="4" style="color:#666; text-align:justify; line-height:20px"><?php echo stripslashes(str_replace("../images/",SITE_URL."images/",$rows['description']));?></td>
  </tr>
  
                  </table>
</div>
		    </div>
                
                           <div id="sub_links2_middle"><div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
			<?php //include("tools/categories.php");?>
			</div><!-- end subpage -->
				</div>	
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>
</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>