<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());

$advert = "Country Events";


if(isset($_GET['continent'])){
	switch($_GET['continent']){
		case "Africa":
		$id = 1;
		break;
		case "Asia":
		$id = 2;
		break;
		case "Europe":
		$id = 3;
		break;
		case "N. America":
		$id = 4;
		break;
		case "Oceania":
		$id = 5;
		break;
		case "S. America":
		$id = 6;
		break;
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

	<title>View upcoming conferences and training seminars in <?php echo $_GET['continent'];?></title>

<meta name="description" content="Current and upcoming conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania in <?php echo $_GET['continent'];?>"/>
	

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

				<li><a href="#" class="activeSlide">Training, Seminars and Conferences in <?php echo $_GET['continent'];?></a></li>

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
				  <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
				  <?php



                    $countries = MysqlSelectQuery("select * from countries where continent='$id' order by countries asc");



					$total_item = NUM_ROWS($countries);



					$colSize = 19;



		 			$column = 0; // init a column counter				



					for($count=0; $count < $total_item; $count++) {



					$rows = SqlArrays($countries);



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



						$strip = str_replace(" / ","-",$rows['countries']);



						$final = str_replace(" ","-",$strip);



						$num = MysqlSelectQuery("select event_id from events where country='".$rows['id']."' and status = 1");



						$totalCat = NUM_ROWS($num);



						echo '<li><a href="'.SITE_URL.'events/countries/'.$rows['id'].'/'.$final.'">'.$rows['countries'].'<span style="color:#F00"> ('.$totalCat.')</span></a></li>';	

				

						}



    					echo "</ul></div>";



					?>
				  

</div>

		    </div>

                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	 <div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
     
     <?php include("tools/categories.php");?>
     
      <div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>
      
     <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

	
 </div>               
        
<div class="clearfix"></div>

</div>

	  </div><!-- end subpage -->

			<?php include("tools/side-menu.php");?>		

		</div>
	<div class="clearfix"></div>

</div>

</div>

</div>
<?php include ("tools/footer.php");?>

</body>
</html>