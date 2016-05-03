<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

if(connection());

$recordperpage =  10;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

$result = MysqlSelectQuery("select * from businessinfo where business_type='Venue' and status =1 order by premium desc, business_name limit $offset , $recordperpage");

$advert = "Venue";

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



	<title>Find Venues: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?></title>

<meta name="description" content="Find event venues in Nigeria, training venues in Nigeria, hall for hire in Nigeria, venues / hall for conferences, venues for hire in Nigeria<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>"/>

    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="3 Days">


	<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />

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

			

		

				<div id="subpage">

					

				  <div id="subpage_content">
 <h4 class="categoryHeader">Event venues in Nigeria</h4>
					

						

		<?php

		$i = 0;

		$check_website ="";

		$web = '';

		while($rows = SqlArrays($result)){

			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}

			if($rows['website'] == "") $check_website = 'No Website'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
			$logo = MysqlSelectQuery("select * from logos where user_id ='".$rows['user_id']."' and user_id !=0");
						$biz_logo = SqlArrays($logo);
						$logoNum = NUM_ROWS($logo);
						
							if($logoNum > 0)
							{
								$biz_logo = 'user/logos/thumbs/'.$biz_logo['logos'];
								$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="50" height="50"/>';
							 }
							 else{ 
							$image = '<div class="star1"></div>';
							}

			switch($rows['premium']){

				case 3:

							$star = '<div class="star2"></div>';

							$bg_class ='#FFF9EA';

							$listing_diff = '';

							$view = '<a href="'.SITE_URL.'/tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="_blank"><img src="'.SITE_URL.'images/more_info.png" alt="Visit Site" /></a>';

							$web = $check_website;

							$start_h1 = '<h2 style="font-size:12px; color:#000;">';

							$end_h1 = '</h2>';

							

							break;

						case 2:

							$star = '<div class="star3"></div>';

							$bg_class ='#FFF0F0';

							$listing_diff = '';

							$view = '<a href="'.SITE_URL.'/tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="_blank"><img src="'.SITE_URL.'images/more_info.png" alt="Visit Site" /></a>';

							$web = $check_website;

							$start_h1 = '<h2 style="font-size:12px; color:#000;">';

							$end_h1 = '</h2>';

							

							break;

						break;

						case 1:

						$star = '<div class="star1"></div>';

							$bg_class ='#F5F5F5';

							$listing_diff = '';

							$view = '';

							$web = $check_website;

							$start_h1 = '<h2 style="font-size:12px; color:#000;">';

							$end_h1 = '</h2>';

							

						break;

						default:

						$star = '<div class="star1"></div>';

							$bg_class ='';

							$listing_diff = '';

							$view = '';

							$web = '';

							$start_h1 = '';

							$end_h1 = '';

							

			}

								?>

					      <table bgcolor="<?php echo $bg_class;?>" class="listing_table_event">

					        <tr>

					          <td width="4%" rowspan="3" valign="middle"><?php echo $image;?></td>

					          <td colspan="5"><?php echo $start_h1;?><a href="<?php echo SITE_URL;?>venues/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" target="_blank" style="font-weight:normal; font-size:14px"><?php echo $rows['business_name'];?></a><?php echo $end_h1;?></td>

				            </tr>

					        <tr>

					          <td width="9%"><strong style="font-size:11px">Address:</strong></td>
					          <td colspan="4"><?php echo $rows['address'];?></td>

				            </tr>

						    

					        <tr>

					          <td colspan="5"><span style="color:#06C; font-style:italic; padding-bottom:7px;">(Click on business name for more information)</span></td>
				            </tr>
						   

						      

				          </table>

                          <?php

							$i++;

								}

								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Venue' and status =1",$recordperpage,$pagenum,"venues?get");

								?>

			  </div>

						 

					<div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

 <div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>

 

        <?php include("tools/categories.php");?>

        

         <div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>

   <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

               </div>



                </div>

                <!-- end subpage -->

					

		</div>

		

		<?php include("tools/side-menu.php");?>

	</div>

	

	<div class="clearfix"></div>

</div>

	

	

	

</div>

</div>
<?php include ("tools/footer.php");?>
</body>

</html>