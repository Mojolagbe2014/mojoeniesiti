<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

$paged = "";

$category_query = "";

$title = "";

$pageInnerTitle = "";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "Calendar Events";

if(connection()){

	$recordperpage = 25;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	if(isset($_GET['sortdate'])){

		$result = MysqlSelectQuery("select * from events WHERE SortDate = '".$_GET['sortdate']."' and status = 1   ORDER BY premium desc, SortDate limit $offset, $recordperpage");

		if(isset($_GET['page'])){
			
		$title = "Upcoming training seminars, conferences for ".date("l F d, Y", strtotime($_GET['sortdate']))." Page ".$_GET['page'];
		$meta_content = "Find latest, educational, professional, technical and state-of-the-heart corporate Seminars, Tranings and Conferences for ".date("l F d, Y", strtotime($_GET['sortdate']))." Page ".$_GET['page'];
		
		//$meta_content = $rows_cat['meta_description']."-Pg-".$_GET['page']."-of-".$rows_cat['category_id'];
		}
		else{
			$title = substr('Upcoming training seminars, conferences for '.date("l F d, Y", strtotime($_GET['sortdate'])),0,69);
			$meta_content = 'Find latest, educational, professional, technical and state-of-the-heart corporate Seminars, Tranings and Conferences  for  '.date("l F d, Y", strtotime($_GET['sortdate']));
		}
		
		$pageInnerTitle = 'Showing result for Events on <span style="color:#060">'.date("l F d, Y", strtotime($_GET['sortdate'])).'</span>';


	}

	else{

	if(isset($_GET['page'])){

		$meta_content = 'Current and upcoming conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania for '.date("l F d, Y", strtotime($_GET['sortdate']))." Page ".$_GET['page'];

		}

		else{

			$meta_content = 'Current and upcoming conferences, trainings seminars, workshops,  exhibitions in Nigeria, Africa, Asia, North/South America and Oceania for '.date("l F d, Y", strtotime($_GET['sortdate']));

		}

	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and SortDate >= '$today' ORDER BY premium desc, SortDate limit $offset, $recordperpage");

	$country_query = "WHERE status = 1 and SortDate = '$today'";

	$pageInnerTitle = 'Latest Events';

	if(isset($_GET['page'])){
		
		$title = "Upcoming training seminars, conferences for ".date("l F d, Y", strtotime($_GET['sortdate']))." Page-".$_GET['page'];
	}
else{
	$title = "Upcoming training seminars, conferences for ".date("l F d, Y", strtotime($_GET['sortdate']));
}
	}

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



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

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_content;?>"/>

	

	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />

	
<?php include("scripts/headers.php");?>

	

</head>



<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<?php include("tools/header2.php");?>

<div id="main">

	<div id="content_bar">

		<div id="content_nav">

			

		</div>

		<div id="search2">
        
			<form action="<?php echo SITE_URL;?>content_search" method="get" id="search_site">
            <table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="query" type="text" id="query" onfocus="if(this.value == 'Search Site...') this.value='';" onblur="if(this.value == '') this.value='Search Site...' ;" value="Search Site..." /></td>
    <td align="right" valign="middle"><input type="submit" class="button" value="" /><input name="search" type="hidden" value="1" /></td>
  </tr>
</table>
           
	  </form>
		</div>

	</div>

	<div id="content">

		<div id="content_left">

				<div class="sub_links">

                <h4 class="categoryHeader"><?php echo $pageInnerTitle;?></h4>

                <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
				  <?php include("tools/searchResult.php");?>
				  <?php

		if(NUM_ROWS($result) > 0 ){

                     Paging("SELECT COUNT(sortdate) AS numrows FROM events where sortdate = '".$_GET['sortdate']."'",$recordperpage,$pagenum,"calendar_events?sortdate=".$_GET['sortdate']);
		}

				?>	 

</div>

		    </div>

                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

 <div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>
 
        <div align="left"><?php include("calendar.php");?></div>
        
         <div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>
     
      <a href="<?php echo SITE_URL;?>location" title="Click to view Events by Location" style="float:left"><img src="images/locationimage.jpg" width="360" height="90" alt="Event by location" /></a>
        <a href="<?php echo SITE_URL;?>category" title="Click to view Events by Categories" style="float:right"><img src="images/cat-image.gif" width="345" height="90" alt="Event by category" /></a>	
 <div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>
     
     </div>   
        
<div class="divider"></div>

               <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

<div class="clearfix"></div>

</div>



			</div><!-- end subpage -->

					

	
<?php include("tools/side-menu.php");?>

</div>
	<div id="content_bottom"></div>

	<div class="clearfix"></div>

</div>

	<?php include ("tools/footer.php");?>

</div>

</div>

</body>

</html>