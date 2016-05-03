<?php



require_once("scripts/config.php");



require_once("scripts/functions.php");



$paged = "";



$category_query = "";



$title = "";



$pageInnerTitle = "";



$today = date("Y-m-d");



$dtds3=date("F");



$advert = "Country Events";



if(connection()){



	$recordperpage = 25;



	$pagenum = 1;



	if(isset($_GET['page'])){



	$pagenum = $_GET['page'];



	}



	$offset = ($pagenum - 1) * $recordperpage;



	if(isset($_GET['id'])){



		$result = MysqlSelectQuery("select * from events WHERE country = '".$_GET['id']."' and status = 1 and SortDate >= '$today'  ORDER BY premium desc, SortDate limit $offset, $recordperpage");



		$countries = MysqlSelectQuery("select * from countries where id = '".$_GET['id']."'");



		$country_query = "WHERE country = '".$_GET['id']."' and status = 1 and SortDate >= '$today'";



		$rows_cat = SqlArrays($countries);

		

		

		if(isset($_GET['page'])){

			

		$title = "Current and upcoming conferences, training seminars in ".$rows_cat['countries']." Page ".$_GET['page'];

		$meta_content = "Find latest, educational, professional, technical and state-of-the-heart corporate Seminars, Tranings and Conferences in  ".$rows_cat['countries']." Page ".$_GET['page'];

		

		//$meta_content = $rows_cat['meta_description']."-Pg-".$_GET['page']."-of-".$rows_cat['category_id'];

		}

		else{

			$title = substr('Current and upcoming conferences, training seminars in  '.$rows_cat['countries'],0,69);

			$meta_content = 'Current and upcoming conferences, training seminars in  '. $rows_cat['countries'];

		}



		



		$strip = str_replace(" / ","-",$rows_cat['countries']);



		$final = str_replace(" ","-",$strip);



		$pageInnerTitle = 'Showing result for Events in <span style="color:#060">'.$rows_cat['countries'].'</span>';



	    

		//$paged = SITE_URL."events/categories/".$_GET['category']."/$final/";



		

		$paged = SITE_URL."events/countries/".$_GET['id']."/$final/";

		

		



		$advert = $rows_cat['countries'];





	}



	else{



	if(isset($_GET['page'])){



		$meta_content = 'Current and upcoming conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania'." Page ".$_GET['page'];



		}



		else{



			$meta_content = 'Current and upcoming conferences, trainings seminars, workshops,  exhibitions in Nigeria, Africa, Asia, North/South America and Oceania.';



		}



	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and SortDate >= '$today' ORDER BY premium desc, SortDate limit $offset, $recordperpage");



	$country_query = "WHERE status = 1 and SortDate >= '$today'";



	$pageInnerTitle = 'Latest Events';



	if(isset($_GET['page'])){

		

		$title = "Current and upcoming conferences, training seminars in Nigeria Page-".$_GET['page'];

	}

else{

	$title = "Current and upcoming conferences, training seminars in Nigeria";

}



	$paged = SITE_URL."country_events/";



	$advert = "Country Events";



	}



}







?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"



	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">







<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">



<head>



<?php include('tools/analytics.php');?>





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





<?php include("tools/header2.php");?>



<div id="main">



	<div id="content_bar">



		<div id="content_nav">



			<ul id="main_content_slider">



				<li><a href="#" class="activeSlide">Events Listings</a></li>



			</ul>



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



                     Pages_rewrite("SELECT COUNT(country) AS numrows FROM events where country = '".$_GET['id']."'",$recordperpage,$pagenum,$paged);

		}



				?>	 



</div>



		    </div>



                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->



 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



 <div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>

 

        <div align="left" style=" border:#0C0; margin-bottom:20px;"><?php include("calendar.php");?></div>

        

         <div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>

     

      <a href="<?php echo SITE_URL;?>location" title="Click to view Events by Location" style="float:left"><img src="<?php echo SITE_URL;?>images/locationimage.jpg" width="360" height="90" alt="Event by location" /></a>

        <a href="<?php echo SITE_URL;?>category" title="Click to view Events by Categories" style="float:right"><img src="<?php echo SITE_URL;?>images/cat-image.gif" width="345" height="90" alt="Event by category" /></a>	



<div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>



</div>

</div>



<div class="divider"></div>



               <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>



<div class="clearfix"></div>





</div>



		



			



		<?php include("tools/side-menu.php");?>





	</div>

</div>
	<div id="content_bottom"></div>
	<div class="clearfix"></div>
	<?php include ("tools/footer.php");?> 
</div>
</div>

</body>
</html>