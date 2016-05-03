<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");

$paged = "";

$category_query = "";

$title = "";

$pageInnerTitle = "";

$pastLink ="";

$pastEvent ="";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "";
$pg = "";


	$recordperpage = 60;

	$pagenum = 1;

	if(isset($_GET['page'])){
	$pg = " - Pg-".$_GET['page'];
	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;
	if(isset($_GET['category'])){

		//$query = " and category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'";
		
		$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
		
		$rows_cat = SqlArrays($categories);
		
		$strip = str_replace($title_link,"-",strtolower($rows_cat['category_name']));
		 
		//header("HTTP/1.1 301 Moved Permanently");
	
		header("location: ".SITE_URL."category/".$strip, true, 301);


		/*
		if(isset($_GET['page'])){
		$title = $rows_cat['meta_title'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		$meta_description = $rows_cat['meta_description'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		
		//$meta_description = $rows_cat['meta_description']."-Pg-".$_GET['page']."-of-".$rows_cat['category_id'];
		
		}
		else{
			$title = $rows_cat['meta_title'];
			$meta_description = $rows_cat['meta_description'];
		}

		$advert = $rows_cat['category_name'];

		$strip = str_replace(" / ","-",$rows_cat['category_name']);

		$final = str_replace(" ","-",$strip);

		$pageInnerTitle = 'Conferences, trainings seminars in <span style="color:#060">'.$rows_cat['category_name'].'</span> Category';

		$paged = SITE_URL."events/categories/".$_GET['category']."/$final/";
		$pastLink = '?ctid='.$_GET['category'].'&ct='.$final;
		$pastEvent = "View past events in ".$rows_cat['category_name'];*/
	}
	else if(isset($_GET['countryid']) && isset($_GET['location'])){
		
		$resultCT = MysqlSelectQuery("SELECT * FROM `countries` WHERE id = '".$_GET['countryid']."'");
		$rowsCT = SqlArrays($resultCT);
		
		$strip = str_replace($title_link,"-",$rowsCT['countries']);

		$final = strtolower(str_replace("--","-",$strip));
		
		header("location: ".SITE_URL."countries/".$final, true, 301);
		
		/*$query = "and country=".$_GET['countryid']." and status = 1 and SortDate >= '$today'";
		$location = $_GET['location'];
		$pageInnerTitle = "Training / Conferences in ".$location;
		$paged = SITE_URL."events/countries/".$_GET['countryid']."/".$_GET['location']."/";
		$pastLink = '?ctry='.$_GET['countryid'].'&l='.$location;
		$pastEvent = "View past events in ".$location;
		if(isset($_GET['page'])){

		$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location.$pg;
		$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;
		
		}

		else{

			$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location.$pg;
			$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;

			}*/

	}
	else if(isset($_GET['stateid']) && isset($_GET['location'])){
		
		header("Location: ".SITE_URL."state/".strtolower($_GET['location']), true, 301);
exit();
		
		/*$query = " and state=".$_GET['stateid']." and status = 1 and SortDate >= '$today'";
		if($_GET['location'] == 'Abuja') $location = $_GET['location']." - FCT "; 
		else
		$location = $_GET['location']." State";
		$pageInnerTitle = "Training / Conferences in ".$_GET['location']." State, Nigeria";
		$paged = SITE_URL."events/state/".$_GET['stateid']."/".$_GET['location']."/";
		$pastLink = '?st='.$_GET['stateid'].'&l='.$_GET['location'];
		$pastEvent = "View past events in ".$location;
		if(isset($_GET['page'])){

		$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location." Page ".$_GET['page'];
		$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;

		}

		else{

			$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location;
			$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;

			}*/

	}
	else{
	$pageInnerTitle = 'Upcoming conferences, training seminars in different countries around the world';
	
	$advert = "All Events";
	
	

			$meta_description = 'Current and upcoming conferences | training seminars | workshops | exhibitions | in different countries around the world.'.$pg;
			$title = "Upcoming conferences | training | seminars | courses | workshops around the world - Nigerian Seminars and Trainings".$pg;


	$query = "and SortDate >= '$today'";
	$paged = SITE_URL."all_event/";
	$pastEvent = "View past events";
	
	}
	

$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query ORDER BY  premium desc, SortDate limit $offset, $recordperpage");

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_description;?>" />

<meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />

<meta name="dcterms.description" content="<?php echo $meta_description;?>" />

<meta property="og:title" content="<?php echo $title;?>" />

<meta property="og:description" content="<?php echo $meta_description;?>" />

<meta property="twitter:title" content="<?php echo $title;?>" />

<meta property="twitter:description" content="<?php echo $meta_description;?>" />

	

	<!--<link rel="stylesheet" href="<?php //echo SITE_URL;?>style.css" type="text/css" media="screen" />-->

	
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

           
<div class="event_table_inner event_bg">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px" align="center"><h2 style="font-size:25px; padding:5px;"><p><?php echo $pageInnerTitle;?></p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
              

				<div class="video_box">
                	<!--<p> <strong>Training Providers in </strong></p>	-->
                    <?php if (isset($_GET['countries'])){?>
                      <?php
					$today = date("Y-m-d");
                    $categories = MysqlSelectQuery("select * from countries order by countries");

					$total_item = NUM_ROWS($categories);

					$colSize = 66;

		 			$column = 0; // init a column counter

					

					for($count=0; $count< $total_item; $count++) {

					$rows = SqlArrays($categories);

					 

    				$isStartOfNewColum = 0 === ($count % $colSize); // modulo

    				$isEndOfColumn = ($count && $isStartOfNewColum);

    				$isStartOfNewColum && $column++; // update column counter



					if ($isEndOfColumn) {

		

       					 echo "</ul></div>";

   					 }

					  if ($isStartOfNewColum) {

       					 echo'<div class="link_box">

						 <ul>';

    					}

					

						$strip = str_replace($title_link,"-",$rows['countries']);
						$final = strtolower(str_replace("--","-",$strip));

						$num = MysqlSelectQuery("select category from events where country='".$rows['id']."' and status = 1 and SortDate >= '$today'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'countries/'.$final.'">'.$rows['countries'].'</a></li>';

						}

					//if ($count && !$isEndOfColumn && --$count === $total_item) {

    					echo "</ul></div>";

						//}

					?>
                    <?php }else{ ?>
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
 <?php
					}
					?>
</div>

		 
                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

      <div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
      
     <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

	
 </div>               
        
<div class="clearfix"></div>

</div>

			</div><!-- end subpage -->

			<?php include("tools/side-menu_new.php");?>	

		</div>
        <div class="clearfix"></div>
	</div>
    </div>

<?php include ("tools/footer_new.php");?>
</body>

</html>