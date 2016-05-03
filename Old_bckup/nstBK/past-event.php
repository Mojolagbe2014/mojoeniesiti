<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");

$paged = "";

$category_query = "";

$title = "";

$pageInnerTitle = "";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "";

if(connection()){

	$recordperpage = 60;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;
	if(isset($_GET['ctid'])){

		$query = " and category = '".$_GET['ctid']."' and status = 1 and SortDate < '$today'";

		$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['ctid']."'");

		$rows_cat = SqlArrays($categories);
		if(isset($_GET['page'])){
		$title = "Past ".substr($rows_cat['meta_title'],0,65).", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		$meta_content = "Past ". $rows_cat['meta_description'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		
		//$meta_content = $rows_cat['meta_description']."-Pg-".$_GET['page']."-of-".$rows_cat['category_id'];
		}
		else{
			$title = "Past ".substr($rows_cat['meta_title'],0,69);
			$meta_content = "Past ".$rows_cat['meta_description'];
		}

		$advert = $rows_cat['category_name'];

		$strip = str_replace(" / ","-",$rows_cat['category_name']);

		$final = str_replace(" ","-",$strip);

		$pageInnerTitle = 'Showing result for past events in '.$rows_cat['category_name'];

		$paged = 'past-event?ctid='.$_GET['ctid'].'&ct='.$final;

	}
	else if(isset($_GET['ctry']) && isset($_GET['l'])){
		$query = "and country=".$_GET['ctry']." and status = 1 and SortDate < '$today'";
		$location = $_GET['l'];
		$pageInnerTitle = "Past Training / Conferences in ".$location;
		$paged = 'past-event?ctry='.$_GET['ctry'].'&l='.$location;
		if(isset($_GET['page'])){

		$meta_content = 'Past conferences, trainings seminars, workshops, exhibitions in '.$location." Page ".$_GET['page'];
		$title = "Past conferences, training seminars in ".$location." Pg-".$_GET['page'];

		}
		else{

			$meta_content = 'Past conferences, trainings seminars, workshops,  exhibitions in '.$location;
			$title = "Past conferences, training seminars in ".$location;

			}
	}
		else if(isset($_GET['business'])){
			$business_id = explode(',',$_GET['business']);
			$business_name = MysqlSelectQuery("SELECT business_name FROM `businessinfo` WHERE business_id='".$business_id[0]."'");
			$business_name = SqlArrays($business_name);
			$name = $business_name['business_name'];
			
		$query = "and organiser like '%".$name."%' and status = 1 and SortDate < '$today'";
		
		$pageInnerTitle = "Past Training / Conferences by ".$name;
		$paged = 'past-event?business='.$_GET['business'];
		if(isset($_GET['page'])){
			
		$meta_content = 'Past conferences, trainings seminars, workshops, exhibitions by '.$name." Page-".$_GET['page'];
		$title = "Past conferences, training seminars by ".$name." Pg-".$_GET['page'];

			}
			
		else{

			$meta_content = 'Past conferences, trainings seminars, workshops,  exhibitions by '.$name;
			$title = "Past conferences, training seminars by ".$name;

			}

	}
	else if(isset($_GET['st']) && isset($_GET['l'])){
		$query = " and state=".$_GET['st']." and status = 1 and SortDate < '$today'";
		if($_GET['l'] == 'Abuja') $location = $_GET['l']." FCT, Nigeria"; 
		else
		$location = $_GET['l']." State, Nigeria";
		$pageInnerTitle = "Past Training / Conferences in ".$location;
		$paged = 'past-event?st='.$_GET['st'].'&l='.$_GET['l'];
		if(isset($_GET['page'])){

		$meta_content = 'Past conferences, trainings seminars, workshops, exhibitions in '.$location." Page ".$_GET['page'];
		$title = "Past conferences, training seminars in ".$location." Pg-".$_GET['page'];

		}

		else{

			$meta_content = 'Past conferences, trainings seminars, workshops,  exhibitions in '.$location;
			$title = "Past conferences, training seminars in ".$location;

			}

	}
	else{
	$pageInnerTitle = 'View All Past Events';
	
	$advert = "All Past Events";
	
	if(isset($_GET['page'])){

		$meta_content = 'Past conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania'." Page ".$_GET['page'];
		$title = "All Past conferences, training seminars in Nigeria and around the world Pg-".$_GET['page'];

		}

		else{

			
			$meta_content = 'Record of past conferences, trainings seminars, workshops,  exhibitions in Nigeria, Africa, Asia, North/South America and Oceania.';
			$title = "All Past conferences, training seminars in Nigeria and around the world";
		}
	$query = "and SortDate < '$today'";
	$paged = "past-event?all";
	}

$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query ORDER BY  premium asc, SortDate limit $offset, $recordperpage");
}
?>

<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_content;?>"/>

	
<meta name="keywords" content="past Conferences, past training seminars, past workshops, past training, past conference seminars, past seminar trainings, events" />

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
				  <?php include("tools/searchResultPast.php");?>
				  <?php

		if(NUM_ROWS($result) > 0){

                     Paging("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged);
		}

				?>	 
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
    </div>

<?php include ("tools/footer_new.php");?>
</body>

</html>