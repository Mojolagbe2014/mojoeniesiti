<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");

$paged = "";

$pageSuffix  = "";

$title = "";

$pageInnerTitle = "";

$pastLink ="";

$pastEvent ="";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "";

if(isset($_GET['courses'])){
	$business_id = explode(',',$_GET['courses']);
	//$name = str_replace('-',' ',$_GET['courses']);
	$business_name = MysqlSelectQuery("SELECT * FROM `businessinfo` left join logos using (user_id) WHERE business_id='".$business_id[0]."'");
	$business_name = SqlArrays($business_name);
	$name = $business_name['business_name'];
	
	if($business_name['logos'] == '') $logo = ''; else $logo = '<img src="'.SITE_URL.'premium/logos/thumbs/'.$business_name['logos'].'" alt="business logo" width="70" height="70" class="articleImg shadow"/>';
}

	$recordperpage = 20;

	$pagenum = 1;

	if(isset($_GET['page'])){
		$pageSuffix = "PG ".$_GET['page'];
	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	$query = "and SortDate >= '$today'";
	$paged = SITE_URL."courses/business/".$_GET['courses']."/";
	$pastEvent = "View past events by ".$name;
	
	
	
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE organiser like'%".$name."%' and status = 1 $query ORDER BY  premium desc, SortDate limit $offset, $recordperpage");

$total_event = NUM_ROWS($result);

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Upcoming events by <?php echo $name." -".$pageSuffix;?></title>

<meta name="description" content="Search all upcoming conferences, training , seminars and workshops by <?php echo $name." -".$pageSuffix;?>" />

<meta name="dcterms.description" content="Search all upcoming conferences, training , seminars and workshops by <?php echo $name." -".$pageSuffix;?>" />

<meta property="og:title" content="Upcoming events by <?php echo $name." -".$pageSuffix;?>" />

<meta property="og:description" content="Search all upcoming conferences, training , seminars and workshops by <?php echo $name." -".$pageSuffix;?>" />

<meta property="twitter:title" content="Upcoming events by <?php echo $name." -".$pageSuffix;?>" />

<meta property="twitter:description" content="Search all upcoming conferences, training , seminars and workshops by <?php echo $name." -".$pageSuffix;?>" />

	<!--<link rel="stylesheet" type="text/css"  href="css/all-css.css" />-->
    
<?php include("scripts/headers_new.php");?>

	

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

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<?php include("tools/header_new.php");?>

<?php include("tools/search_box.php");?>

<div id="main">

	

	<div id="content">
    
    <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">
                
                <div class="event_table_inner">
<form action="" method="post">
<table width="100%" border="0" class="smart-forms" style="padding:9px;">
  
  <tr>
    <td width="13%" align="left" style="padding-left:8px">
      <?php echo $logo;?>     </td>
    <td width="87%" align="center" ><h2 style="font-size:25px; text-align:center; margin-bottom:8px;"><p>Current and upcoming events by <?php echo $name;?>
    </p>
    </h2></td>
  </tr>
  </table>
</form>
</div>

                
				<div class="video_box">
				  <?php include("tools/searchResult.php");?>
                 
				  <?php

		if(NUM_ROWS($result) > 0){
			?>
             <div id="paging1">
<?php
                     Pages_rewrite("SELECT COUNT(event_id) AS numrows FROM events WHERE organiser like'%".$name."%' and status = 1 $query ",$recordperpage,$pagenum,$paged);
					 ?>
                     </div>
                     <div id="paging2">
<?php
                     Pages_rewrite_mobile("SELECT COUNT(event_id) AS numrows FROM events WHERE organiser like'%".$name."%' and status = 1 $query ",$recordperpage,$pagenum,$paged);
					 ?>
                     </div>
                     <?php
		}

				?>	 
 <div class="button_class_right"><a href="<?php echo SITE_URL;?>past_event?business=<?php echo $_GET['courses'];?>"><?php echo $pastEvent;?></a></div>
</div>



                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

 </div>               
        
<div class="clearfix"></div>

</div>

			</div><!-- end subpage -->

			<?php include("tools/side-menu_new.php");?>	

		</div>	
        <div class="clearfix"></div>
	</div>






<?php include ("tools/footer_new.php");?>
</body>

</html>