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



	$recordperpage = 60;

	$pagenum = 1;
	$pagesuffix ="";

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];
	$pagesuffix = 'P G'.$pagenum;
	}

	$offset = ($pagenum - 1) * $recordperpage;
	
	if(isset($_GET['tag'])){
	
	$query = "WHERE status = 1 and tags like '%".addslashes(str_replace('-',' ',$_GET['tag']))."%'";
	
	$result = MysqlSelectQuery("select * from events $query order by premium desc, SortDate desc limit $offset , $recordperpage");
	}
?>
<!DOCTYPE html >



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?><?php echo $pagesuffix;?></title>

<meta name="description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>"/>

<meta name="dcterms.description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>" />

<meta property="og:title" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?><?php echo $pagesuffix;?>" />

<meta property="og:description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>" />

<meta property="twitter:title" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?><?php echo $pagesuffix;?>" />

<meta property="twitter:description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>" />

	

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
             
             <div class="event_table_inner" style="border:solid 1px #066; background-color:#FFFFFF;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:21px; padding:5px;"><p>Conferences, training, seminars about <em style="color:#006600;"><?php echo ucwords(str_replace('-',' ',$_GET['tag']));?></p></h2></td>
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

                    Paging("SELECT COUNT(event_id) AS numrows FROM events $query ",$recordperpage,$pagenum,"all_event_tag_search?tag=".$_GET['tag']);
                     ?>
                     </div>
                       <!--<div id="paging1">
       <?php

                    //PagingMobile("SELECT COUNT(event_id) AS numrows FROM events $query ",$recordperpage,$pagenum,"all_event_tag_search?tag=".$_GET['tag']);
                     ?>
                     </div>-->
                     <?php
		}

				?>	 
 <div class="button_class_right"><a href="<?php echo SITE_URL;?>past_event<?php echo $pastLink;?>"><?php echo $pastEvent;?></a></div>
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



	

<?php include ("tools/footer_new.php");?>
</body>

</html>