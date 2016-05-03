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
$advert = "archive";


if(isset($_GET['page'])){
			
		$title = "Visit our archive for past news / updates Page ".$_GET['page'];
		$meta_content = "Read past news, updates from Nigerian Seminars and Trainings Page ".$_GET['page'];
		
		
		}
		else{
			$title = 'Visit our archive for past news / updates ';
			$meta_content = 'Read past news, updates from Nigerian Seminars and Trainings';
		}


?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
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
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



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
			<div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:22px; padding:5px; color:#000;"><p>News / Updates</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
		
				<div id="subpage">
				
				  <div id="subpage_content">
					 <div id="contact-wrapper" class="rounded" style="margin-top:8px;"> 

				<div class="video_box">
						
		<?php
		if(NUM_ROWS($result) > 0){
		$i = 0;
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
								?>
	          <table class="listing_table_event">
					        <tr>
					          <td><h4><a href="<?php echo SITE_URL."news/".$rows['News_id']."/".str_replace($title_link,"-",substr($rows['newsTitle'],0,150))."/";?> " style="color: #0066FF; text-decoration:none;"><?php echo $rows['newsTitle'];?></a></h4><strong>Date:</strong> <?php echo $rows['posted_date'];?></td>
				            </tr>
					        <tr>
					          <td><?php echo substr (strip_tags($rows['description']),0,250);?>
                              </td>
					        </tr>
				          </table>
                          <?php
							$i++;
								}
								?>
                                 <div id="paging1">
       <?php

                    Paging("SELECT COUNT(News_id) AS numrows FROM news ",$recordperpage,$pagenum,"archive?get");
                     ?>
                     </div>
                       <div id="paging1">
       <?php

                    PagingMobile("SELECT COUNT(News_id) AS numrows FROM news ",$recordperpage,$pagenum,"archive?get");
                     ?>
                     </div>
                     <?php
								
		}
		else{
			echo errorMsg("No training vacancy found!");
		}
								?>
 			 
					
</div>
                </div>
                </div>
                </div>
                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

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