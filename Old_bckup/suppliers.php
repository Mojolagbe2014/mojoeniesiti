<?php

session_start();

require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());



$advert = "";



$recordperpage =  15;



	$pagenum = 1;



	if(isset($_GET['page'])){



	$pagenum = $_GET['page'];



	}



	$offset = ($pagenum - 1) * $recordperpage;



$result = MysqlSelectQuery("select * from businessinfo where business_type = 'Suppliers' and status=1 order by premium desc, business_name limit $offset , $recordperpage");



$advert = "Suppliers";



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



<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/> 



	<title>Find Suppliers: Nigerian Seminars and Trainings <?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?></title>

<meta name="description" content="Find suppliers of conference and training equipments like projectors, flip charts, magnetic boards and other training related services in Nigeria.<?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?>"/>

    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="3 Days">


	

	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />



<?php include("scripts/headers.php");?>

	







</head>







<body>

<!-- Start Alexa Certify Javascript -->

<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>

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



	



	<div id="content">



		<div id="content_left">



			



		
<h3 class="categoryHeader">Suppliers of training equipments in  Nigeria and around the world</h3>


  <div id="subpage">



					



					<div id="subpage_content">



				


						<div style="background-color:#F5FAFA">	
		<?php
		$i = 0;
		$check_website ="";
		$web = '';
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rows['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			switch($rows['premium']){
				case 3:
							$star = '<div class="star2"></div>';
							$bg_class ='#FFF9EA';
							$listing_diff = '';
							$view = '<a href="'.SITE_URL.'/suppliers/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="_blank"><img src="'.SITE_URL.'images/more_info.png" alt="Visit Site" /></a>';
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
							break;
						case 2:
							$star = '<div class="star3"></div>';
							$bg_class ='#EDF4FC';
							$listing_diff = '';
							$view = '<a href="'.SITE_URL.'/suppliers/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="_blank"><img src="'.SITE_URL.'images/more_info.png" alt="Visit Site" /></a>';
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
							break;
						break;
						case 1:
						$star = '<div class="star1"></div>';
							$bg_class ='#F5F5F5';
							$listing_diff = '';
							$view = '';
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
						break;
						default:
						$star = '<div class="star1"></div>';
							$bg_class ='';
							$listing_diff = '';
							$view = '';
							//$web = '';
							$start_tag = '';
							$end_tag = '';
							
			}
								?>
						    <table  bgcolor="<?php echo $bg_class;?>" class="listing_table_event">
						      <tr>
						        <td width="4%" rowspan="3" align="center" valign="middle"><?php echo $star;?></td>
						        <td colspan="3"><?php echo $start_tag;?><a href="<?php echo SITE_URL;?>suppliers/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" target="_blank" style="font-weight:normal; font-size:14px"><?php echo $rows['business_name'];?></a><?php echo $end_tag;?></td>
						        <td width="17%" align="right"><?php echo $view;?></td>
					          </tr>
						      <tr>
						        <td colspan="3"><strong>Contact:</strong> <?php echo $rows['address'];?></td>
						        <td align="right"><?php echo $listing_diff;?></td>
					          </tr>
						      <tr>
						        <td colspan="4"><span style="color:#06C; font-style:italic;">(Click on business name for more information)</span></td>
					          </tr>
						     
						      
					        </table>
                            <?php
							$i++;
								}
								?>
                                 <div id="paging1">
                                <?php
								
								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Suppliers' and status =1",$recordperpage,$pagenum,"suppliers?get");
								?>
                                </div>
                                 <div id="paging2">
                                  <?php
								PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Suppliers' and status =1",$recordperpage,$pagenum,"suppliers?get");
								?>
                                 </div>

                                

			  </div>





                </div>



                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->



 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



 <div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>

 

       <?php include("tools/categories.php");?>

        

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

	<div class="clearfix"></div>

</div>



</div>

<?php include ("tools/footer.php");?>

</body>





</html>