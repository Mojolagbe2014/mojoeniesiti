<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if($_SERVER['REQUEST_URI'] == "/training_providersTraining"){
	header("location: training_providers");
}
$advert ="";
$pageSuffix  = "";
function GetCatName($id){
	$result = MysqlSelectQuery("select * from categories where category_id='$id'");
	$rows = SqlArrays($result);
	return $rows['category_name'];
}
if(connection());
$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pageSuffix  = " Pg ".$_GET['page'];
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
	
$view = '';
$paging = SITE_URL."training_providers?get";

$result = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium = 3 order by rand() limit $offset , $recordperpage");

$num = NUM_ROWS($result);

$advert = "Training Providers";

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23693392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<title>Training providers | seminar | conference organizers | training companies <?php echo $pageSuffix;?></title>
<meta name="description" content="Training providers | seminar | conference organizers | training companies | professional bodies in Nigeria | , Asia | Europe | North | South America <?php echo $pageSuffix;?>"/>
 <meta name="keywords" content="training providers, training houses, in nigeria, professional institutes, consultants, associations, management consultants,facilitators, training bodies ">
      <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="robots" content="index, follow"/>
    <meta name="Revisit-after" content="3 Days">
    <meta name="search-engines" content="all"/>
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
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
       <div class="event_table_inner" style="border:solid 1px #066; background-color:#FFFFFF;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:21px; padding:5px;">Training providers in Nigeria and around the world</h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
			 
		
				<div id="subpage">
					
					<div id="subpage_content">
					<!--<p> <strong>Training Providers in </strong></p>	-->
                    
                    <div >
                    <?php
		$i = 0;
		$check_website ="";
		$web = '';
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rows['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
			$logo = MysqlSelectQuery("select * from logos where user_id ='".$rows['user_id']."' and user_id !=0");
						$biz_logo = SqlArrays($logo);
						$logoNum = NUM_ROWS($logo);
						
							if($logoNum > 0)
							{
								$biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
								$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="30" height="30"/>';
							 }
							 else{ 
							$image = '<img src="images/star.png" alt="business logo"/>';
							}
							
							
			
			switch($rows['premium']){
				case 3:
							$star = '<div class="star2"></div>';
							$bg_class ='eventListing';
							$listing_diff = '';
							$view = '<div style="display:block;"><div class="ViewBox"> More Info</div></div>';
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
							break;
			}
								?>
						    
                            
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" class="<?php echo $bg_class;?>"> <span class="spanTitle"><?php echo $rows['business_name'];?></span>
                       <div class="trainingProviders">
                       <span class="span"><?php echo substr(strip_tags(stripslashes($rows['description'])),0,160)."...";?></span>
                      
</div>
                       <?php echo $image;?>
                       
                        <div class="trainingProviders">
                       <span class="provider">Contact</span>
                        <span class="provider_name"><span style="color:#000"><?php echo $rows['address'];?></span></span>
                      
                       </div> 
                      <?php echo $view;?>
                       <div class="clearfix"></div>
                       </a>
                            <?php
							$i++;
								}
					?>
                                </div>
                    
					<div >
                    <?php
		$i = 0;
		$check_website ="";
		$web = '';
		$resultNonPremium = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium != 1 order by business_name limit $offset , $recordperpage");

$num = NUM_ROWS($result);

		while($rowsNonPremium = SqlArrays($resultNonPremium)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rowsNonPremium['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rowsNonPremium['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
		
							$image = '<img src="images/star.png" alt="business logo"/>';
							$star = '<div class="star1"></div>';
							$bg_class ='eventListing_odd';
							$listing_diff = '';
							$view = '';
							//$web = '';
							$start_tag = '';
							$end_tag = '';
							$view = '<div style="display:block;"><div class="ViewBox"> More Info</div></div>';
			?>
						    
                            
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>" class="<?php echo $bg_class;?>"> <span class="spanTitle"><?php echo $rowsNonPremium['business_name'];?></span>
                       <div class="trainingProviders">
                       <span class="span"><?php echo substr(strip_tags(stripslashes($rowsNonPremium['description'])),0,160)."...";?></span>
                      
</div>
                       <?php echo $image;?>
                       
                        <div class="trainingProviders">
                       <span class="provider">Contact</span>
                        <span class="provider_name"><span style="color:#000"><?php echo $rowsNonPremium['address'];?></span></span>
                      
                       </div> 
                      <?php echo $view;?>
                       <div class="clearfix"></div>
                       </a>
                            <?php
							$i++;
								}
								//if($num > 0){
									?>
                                    <div id="paging1">
                                    <?php
								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 ",$recordperpage,$pagenum,$paging);
                                ?>
                                </div>
                                <div id="paging2">
                                <?php
								PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 ",$recordperpage,$pagenum,$paging);
								?>
                                </div>
                                <?php
								//}
								/*else{
									//echo errorMsg("found no training provider(s)");
								}*/
								?>
                                </div>
                                
			  </div>
						 
					

                </div>
                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
		              

                <!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu_new.php");?>
</div>
	
	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>

<?php include ("tools/footer_new.php");?>
</body>
</html>