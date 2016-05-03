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
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<!-- Start Alexa Certify Javascript -->

<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>

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
			
		<div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;"><p>Quote of the day - <?php echo date("F j, Y",strtotime($rows['day_of_quote']));?></p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				 <div id="contact-wrapper" class="rounded" style="margin-top:8px;"> 
					
					<div id="subpage_content">
                   
                    <span  style="color:#03C; margin:10px; font-style:normal; font-weight:normal; font-size:18px">
                   <div style="float:left; padding-top:15px; padding-left:10px">
            <?php echo $image?>
                   
                   </div>
                     <blockquote class="blockQuote" style="margin-top:0px;"><img src="<?php echo SITE_URL;?>images/quote-icon.png" width="44" height="33" />&nbsp;<?php echo $rows['quote']?>&nbsp;<img src="<?php echo SITE_URL;?>images/quote-icon2.png" width="44" height="33" alt="nigerianseminars" /><br /><br />
                      <b style="color: #000; font-size:18px; font-style:italic"><?php echo $rows['authur']?></b>
                    </blockquote>
                    </span>
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
    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
 </div>
                    <p align="justify" > 
                    <div style="float:right"><a href="<?php echo SITE_URL;?>quoteArchive">Veiw Quote Archive</a></div><br />                     
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

	
  
  
</div>
<?php include ("tools/footer_new.php");?>


</body>

</html>