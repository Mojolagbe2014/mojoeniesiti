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

$advert = "All Event";

if(connection());

	$recordperpage = 30;

	$pagenum = 1;

	if(isset($_GET['page'])){
		$pageSuffix = "PG ".$_GET['page'];
	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	$query = "and SortDate >= '$today'";
	$paged = SITE_URL."all-event/";
	$pastEvent = "View past events";
	
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query and premium = 0 ORDER BY SortDate limit $offset, $recordperpage");

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Nigerian Seminars and Trainings - All Events <?php echo $pageSuffix;?></title>

<meta name="description" content="All upcoming conferences, training, seminars, courses and workshops in Nigeria, Africa, Asia, Europe, North / South America <?php echo $pageSuffix;?>" />

<meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />

<meta name="dcterms.description" content="All upcoming conferences, training, seminars, courses and workshops in Nigeria, Africa, Asia, Europe, North / South America <?php echo $pageSuffix;?>" />

<meta property="og:title" content="Nigerian Seminars and Trainings - All Events <?php echo $pageSuffix;?>" />

<meta property="og:description" content="All upcoming conferences, training, seminars, courses and workshops in Nigeria, Africa, Asia, Europe, North / South America <?php echo $pageSuffix;?>" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - All Events<?php echo $pageSuffix;?>" />

<meta property="twitter:description" content="All upcoming conferences, training, seminars, courses and workshops in Nigeria, Africa, Asia, Europe, North / South America <?php echo $pageSuffix;?>" />

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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif"  height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<?php include("tools/header_new.php");?>



<div id="main">

	

	<div id="content">
    
     
      <?php include("tools/categories_new.php");?>
       

		<div id="content_left">

				<div class="sub_links">

                 
                    
                   <div class="event_table_inner event_bg">

<form>
<table>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;">All Upcoming Conferences, Training, Seminars, Courses and Workshops</h2></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

               <?php include("tools/search_box.php");?>

				<div class="video_box">
                
                    <?php
					if(!isset($_GET['page']) or $_GET['page'] == 1){
		$resultPremium = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and premium = 1 $query ORDER BY  rand(), SortDate limit 0, 30");
					while($rowsPremium = SqlArrays($resultPremium)){
						
			if ($rowsPremium['premium'] == 1){
								$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rowsPremium['organiser']."%'");
						$biz_name = SqlArrays($business);
							if($biz_name['logos'] == '') $logo = 'images/star2.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
							$star = '<img src="'.SITE_URL.$logo.'" alt="business logo" width="50" height="50"/>';

							$clock_icon = '<div class="calendar_time"></div>';

							$bg_class = '';

							$listing_diff = '';

							$start_h1 = '<h2>';

							$end_h1 = '</h2>';
							
							$pre_link = '<a href="'.SITE_URL.'tprovider/'.$biz_name['business_id'].'/'.str_replace($title_link,"-",$biz_name['business_name']).'" target="_blank" style="color:#333; font-weight:normal;">'.$rowsPremium['organiser'].'</a>';

						}

						else{

							$star = '<div class="star1" style="float:right; margin-right:35px;"></div>';

							$bg_class ='#F7F7F7';

							$clock_icon ='<div class="icon_clock"></div>';

							$listing_diff ='';

							$start_h1 = '';

							$end_h1 = '';
							$pre_link = $rowsPremium['organiser'];

						}

			?>
                       <div class="eventListing vevent" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rowsPremium['event_id'].'/'.str_replace($title_link,"-",$rowsPremium['event_title']);?>')">
                        <a href="<?php echo SITE_URL.'events/'.$rowsPremium['event_id'].'/'.str_replace($title_link,"-",$rowsPremium['event_title']);?>" class="url" style="background-color:#E3EBEE; display:block; padding:3px;" ><h2 style="font-size:16px;"> <span class="spanTitle summary" itemprop="name"><?php echo $rowsPremium['event_title'];?></span></h2></a>
                        
                        <span class="spanTitle" style="text-align:center; font-size:14px; color:#000000;margin-top:10px;" ><?php echo $rowsPremium['organiser'];?></span>
                        
                       <div class="innerHeadingPropEvent">
     <p ><?php echo dateDiff($rowsPremium['startDate'], $rowsPremium['endDate']);?> &nbsp;&nbsp; | &nbsp;&nbsp; </p>
                       
                
                       <p ><?php echo date('M d',strtotime($rowsPremium['startDate']))." - ".date('d M, Y',strtotime($rowsPremium['endDate']));?> &nbsp;&nbsp; | &nbsp;&nbsp; </p>
                         <span style="display:none;" class="dtstart" content="<?php echo date('Y-m-d h:m:s',strtotime($rowsPremium['startDate']));?>"><?php echo date('Y-m-d h:m:s',strtotime($rowsPremium['startDate']));?></span>
                         
                      
                       
                       <p class="location"><?php echo GetEventLocation($rowsPremium['event_id']);?></p>
                       </div>
                        
                       
                       
                       <div class="respond">
                       <?php //echo $image;?>
                       <div class="testImg" style="background-image:url(<?php echo SITE_URL.$logo;?>); background-repeat:no-repeat;">
                      <!-- <img src="images/no_icon.gif" alt="business logo" width="50" height="50"/>-->
                       </div>
                </div>
                        <div class="trainingProviders" style="width:100%;">
                      <!-- <span class="provider">Provider:</span>-->			 <h2>
                        <span class="provider_name" >
                        <span style="color:#000;" class="description"><?php echo substr(stripslashes(strip_tags($rowsPremium['description'])),0,220).'...';?> <em style="color:#F00;"><img src="<?php echo SITE_URL;?>images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right;"></em></span>
                        </span>
                       </h2>
                       </div> 
                       
                       <div class="clearfix"></div>
                       
                       </div>
  <?php

						}
					}
				
					?>
                    



				  <?php include("tools/searchResult.php");?>
                 
				  <?php

		if(NUM_ROWS($result) > 0){
			?>
             <div id="paging1">
<?php
                     Pages_rewrite("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged);
					 ?>
                     </div>
                     <div id="paging2">
<?php
                     Pages_rewrite_mobile("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged);
					 ?>
                     </div>
                     <?php
		}

				?>	 
 <div class="button_class_right smart-forms" ><a href="<?php echo SITE_URL;?>past-event<?php echo $pastLink;?>" class="button" ><?php echo $pastEvent;?></a></div>
</div>



                           <div id="sub_links2_middle">
                           <!-- Begin BidVertiser code -->
<div class="respond">
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
 </div>

 </div>               
        
<div class="clearfix"></div>

</div>
  <div class="clearfix"></div>

			</div><!-- end subpage -->

			<?php include("tools/side-menu_new.php");?>	

		</div>	
        <div class="clearfix"></div>
	</div>
</div>





<?php include ("tools/footer_new.php");?>
</body>

</html>