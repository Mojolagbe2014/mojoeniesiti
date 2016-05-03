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

$extractState = "";
$statePrefix = '';

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "All Event";

	$recordperpage = 60;

	$pagenum = 1;

	if(isset($_GET['page'])){
		$pageSuffix = "PG ".$_GET['page'];
	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;
	
	if(isset($_GET['state'])){
		//extract ID
		$extract = explode(".",$_GET['state']);
		$request = MysqlSelectQuery("select * from states where id_state='".$extract[0]."'");
		$row = SqlArrays($request);
		/*$allowed = "/[^a-z\\040\\.\\-\/]/i";
  		$extractState =  preg_replace($allowed,"",$_GET['state']);*/
  
		//$arr = SqlArrays($request);
		//extract and merge states
		//$rmv_str = array('.','-');
		//$extractState = str_replace($rmv_str,' ',$extractState);
		if ($row['name'] == 'Abuja') $newState = $row['name'].' FCT, Nigeria';
		else
		$newState = $row['name'].' State, Nigeria';
		//if($arr['name'] == $extractState)
		$query = "and SortDate >= '$today' and state = '".$extract[0]."'";
		//else
		//header('location: 404error');
	}
else{
	$query = "and SortDate >= '$today' and country = 38 ";
	$paged = SITE_URL."all_event/";
	$pastEvent = "View past events";
	$newState = 'Nigeria';
}
	
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query ORDER BY  premium desc, SortDate limit $offset, $recordperpage");

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

	<title>Training / Conferences in <?php echo $newState;?>: Nigerian Seminars and Trainings<?php echo $pageSuffix;?></title>

<meta name="description" content="Upcoming conferences, training in <?php echo $newState;?>, seminars in Nigeria and workshops in Nigeria, Africa, Asia, North/South America and Oceania.<?php echo $pageSuffix;?> " />

	

	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />

	
<?php include("scripts/headers_new.php");?>
  <link rel="stylesheet" href="css/nanoscroller.css">
  
  <style>
  #maintest {
	background: #bba;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border-top: 1px rgba(255,255,255,.6) solid;
	height: 100px;
	width: 500px;
	margin: auto;
}
  </style>
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


<?php include("tools/headers_new.php");?>

<?php include("tools/search_box.php");?>

<div id="main">

	

	<div id="content">
    
     <div class="category_content responsiveCategoryMain">
     <div class="sneak_peak2_category">
         <div class="button_class_category">Filter by states in Nigeria</div>
         
       
         
         </div>
     <div class="state_filter">
  
     <ul>
      <?php
	 $state =  MysqlSelectQuery("select * from states");
	  while($rowsState = SqlArrays($state)){
		  $stripState = str_replace(" ","-",$rowsState['name']);
	  ?>
      <li><a href="<?php echo SITE_URL.'nigeria?state='.$rowsState['id_state'].'.'.$stripState;?>"><?php echo $rowsState['name'];?></a></li>
      <?php
	  }
	  ?>
   <!--   <li><a href="#" class="event_location">Event in Nigeria</a></li>
      <li><a href="#" class="event_location">Event by Countries</a></li>-->
     	 </ul>
       
     </div>

       <div class="sneak_peak2_category">
         <div class="button_class_category">Event Categories</div>
        
         </div>
       <ul>
      <?php
	 $cat =  MysqlSelectQuery("select * from categories order by category_name");
	  while($rowsCat = SqlArrays($cat)){
		  $strip = str_replace(" / ","-",$rowsCat['category_name']);

						$final = str_replace(" ","-",$strip);
	  ?>
      <li><a href="<?php echo SITE_URL.'events/categories/'.$rowsCat['category_id'].'/'.$final ;?>"><?php echo $rowsCat['category_name'];?></a></li>
      <?php
	  }
	  ?>
   <!--   <li><a href="#" class="event_location">Event in Nigeria</a></li>
      <li><a href="#" class="event_location">Event by Countries</a></li>-->
      </ul>
</div>
     
      <?php //include("tools/categories_new.php");?>
       

		<div id="content_left">

				<div class="sub_links">

                 
                    
                    <div class="event_table_inner" style="border:solid 1px #066; background-color:#FFFFFF;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px" align="center"><h2 style="font-size:21px; padding:5px;">Conferences, Training, Seminars, Courses and Workshops in <?php echo $newState;?></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
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
 <div class="button_class_right"><a href="<?php echo SITE_URL;?>past_event<?php echo $pastLink;?>"><?php echo $pastEvent;?></a></div>
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