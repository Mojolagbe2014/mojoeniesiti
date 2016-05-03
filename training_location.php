<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());

$advert = "Country Events";

$title = "View upcoming conferences and training seminars by locations";

$meta_content = "Current and upcoming conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania by locations";

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

$pageInnerTitle = 'Locations';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Training providers and professional bodies in <?php echo $_GET['continent'];?></title>

<meta name="description" content="Training providers, training institutions, management development centres, colleges and institutions in <?php echo $_GET['continent'];?>"/>
	

	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />

	
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


<?php include("tools/header_new.php");?>

<div id="main">
	
	<div id="content">
    
    <?php include("tools/categories_new.php");?>
       
		<div id="content_left">
        
        <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Terms of Use</h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

	<div id="content">

		<div id="content_left">

				<div class="sub_links">
				  <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
	<?php



                    $countries = MysqlSelectQuery("select * from countries where continent='$id' order by countries asc");



					$total_item = NUM_ROWS($countries);



					$colSize = 17;



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



						$num = MysqlSelectQuery("select business_id from businessinfo where country='".$rows['id']."' and status = 1");



						$totalCat = NUM_ROWS($num);



						echo '<li><a href="'.SITE_URL.'training_providers/countries/'.$rows['id'].'/'.$final.'">'.$rows['countries'].'<span style="color:#F00"> ('.$totalCat.')</span></a></li>';	

				

						}



    					echo "</ul></div>";



					?>


</div>

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

</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>