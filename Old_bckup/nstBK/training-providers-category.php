<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if($_SERVER['REQUEST_URI'] == "/training-providersTraining"){
	header("location: training-providers");
}
$advert ="";
$pg = "";

function GetCatName($id){
	$result = MysqlSelectQuery("select * from categories where category_id='$id'");
	$rows = SqlArrays($result);
	return $rows['category_name'];
}

$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	$pg = " - Pg-".$_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
	$countryQuery ="";
		$location = "";
		
	if(isset($_GET['countryid']) && isset($_GET['location'])){
		
		$resultCT = MysqlSelectQuery("SELECT * FROM `countries` WHERE id = '".$_GET['countryid']."'");
		$rowsCT = SqlArrays($resultCT);
		
		$strip = str_replace($title_link,"-",$rowsCT['countries']);

		$final = strtolower(str_replace("--","-",$strip));
		
		header("location: ".SITE_URL."training-provider/countries/".$final, true, 301);
		
		/*$countryQuery = "and country=".$_GET['countryid'];
		$location = "Training providers in ".$_GET['location'];
		$paging =$_GET['location'];
		$title = "Training providers in ".$_GET['location']." - Nigerian Seminars and Trainings".$pg;
		$meta = "Find training providers | training institutions | consultants | professional associations / bodies in ".$location.$pg;*/
	}
	
	else if(isset($_GET['stateid']) && isset($_GET['location'])){
		header("Location: ".SITE_URL."state/".strtolower($_GET['location']), true, 301);
exit();
		/*$countryQuery = "and state=".$_GET['stateid'];
		
		if($_GET['location'] == 'Abuja') $stateSelector = " - FCT "; 
		else
		$stateSelector = " State";
		
		$location = "Training providers in ".$_GET['location'].$stateSelector.", Nigeria";
		$paging =$_GET['location'];
		
		$title = "Training providers in ".$_GET['location'].$stateSelector." - Nigerian Seminars and Trainings".$pg;
		
		$meta = "Find training providers | training institutions |consultants | professional associations / bodies in ".$_GET['location'].$stateSelector.$pg;*/
		
	}
	
	else if(isset($_GET['category'])){
		
		$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
		
		$rows_cat = SqlArrays($categories);
		
		$strip = str_replace($title_link,"-",$rows_cat['category_name']);

		$final = strtolower(str_replace("--","-",$strip));
	
		header("location: ".SITE_URL."training-provider/categories/".$final, true, 301);
		
		/*$getID = explode("-",$_GET['category']);
		$countryQuery = "and specialization=".$getID[0];
		$location = "Training providers in ".GetCatName($getID[0])." Category";
		$paging = "spe?category=".$_GET['category'];
		$title = "Training providers in ".GetCatName($getID[0])." Category - Nigerian Seminars and Trainings".$pg;
		$meta = "Find training providers | training institutions |consultants | professional associations / bodies in ".GetCatName($getID[0])."  Category".$pg;*/
		
	}
	else{
		if (isset($_GET['categories'])){
			$title = "Training providers and professional bodies by category - Nigerian Seminars and Trainings";
			$meta="Training providers, training institutions, management development centres, colleges and institutions by category".$pg;
			$location = "Training providers by category";
		}
		else{
$view = '';
$paging = SITE_URL."training-providers?get";
$title = "Training providers and professional bodies around the world - Nigerian Seminars and Trainings".$pg;
$meta="Training providers, training institutions, management development centres, colleges and institutions around the world".$pg;
$location = "Training providers around the world";
		}
	}
$result = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium=3 $countryQuery order by rand() limit $offset , $recordperpage");
$num = NUM_ROWS($result);
$advert = "Training Providers";

?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $meta;?>"/>
 <meta name="keywords" content="training providers, training houses in nigeria, professional institutes, associations, management consultants,facilitators, training bodies ">
 
       <meta name="keywords" content="training providers, training houses, in nigeria, professional institutes, consultants, associations, management consultants,facilitators, training bodies ">

<meta name="dcterms.description" content="<?php echo $meta;?>" />

<meta property="og:title" content="<?php echo $title;?>" />

<meta property="og:description" content="<?php echo $meta;?>" />

<meta property="twitter:title" content="<?php echo $title;?>" />

<meta property="twitter:description" content="<?php echo $meta;?>" />

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
<div id="main_content">
  <?php include("tools/header_new.php");?>
  
  
  <div id="main">

	<div id="content">
    
    <div class="category_content responsiveCategoryMain">
    <?php
	if(isset($_GET['countryid']) && $_GET['countryid'] == 38){
	?>
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
      <li><a href="<?php echo SITE_URL.'training-providers/state/'.$rowsState['id_state'].'/'.$stripState;?>"><?php echo $rowsState['name'];?></a></li>
      <?php
	  }
	  ?>
   <!--   <li><a href="#" class="event_location">Event in Nigeria</a></li>
      <li><a href="#" class="event_location">Event by Countries</a></li>-->
     	 </ul>
       
     </div>
     <?php
	}
	 ?>

       <div class="sneak_peak2_category">
         <div class="button_class_category">Event Categories</div>
        
         </div>
         
      <ul>
             <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/administrative-and-secretarial">Administrative and Secretarial</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/agriculture-and-rural-development">Agriculture and Rural Development.</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/aviation-and-maritime">Aviation and Maritime</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/banking-and-insurance">Banking and Insurance</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/conferences-agm-seminars">Conferences AGM Seminars</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/corporate-governance">Corporate Governance</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/customer-service-and-support">Customer Service and Support</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/e-learning">E-Learning </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/economic-management">Economic Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/education">Education</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/engineering-and-technical-skills">Engineering and Technical Skills</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/entrepreneurship-and-business-development">Entrepreneurship and Business Development</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/executive-education">Executive Education</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/finance-and-accounting">Finance and Accounting</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/general-management">General Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/health-and-hse">Health and HSE</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/human-resource-management">Human Resource Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/information-and-communications-technology">Information and Communications Technology</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/internal-audit-fraud">Internal Audit, Fraud </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/leadership-and-self-development">Leadership and Self Development</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/legal-and-legislative">Legal and Legislative</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/logistics-and-supply-chain-management">Logistics and Supply Chain Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/management-consultancy">Management Consultancy</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/marketing-and-sales-management">Marketing and Sales Mgt</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/media-and-communication">Media and Communication</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/oil-and-gas-energy-and-power">Oil and Gas Energy and Power</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/operations-management">Operations Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/pre-retirement-and-new-beginnings">Pre-Retirement and New Beginnings</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/project-management">Project Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/public-administration">Public Administration</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/real-estate-management">Real Estate Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/research-methodology-and-analytics">Research Methodology and Analytics</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/risk-management">Risk Management </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/security-and-crime-prevention">Security and Crime Prevention</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/strategic-management">Strategic Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/telecommunications">Telecommunications</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/time-and-self-management">Time and Self Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/vocational-education-and-training">Vocational Education and Training</a></h2></li>
            
            <li><a href="<?php echo SITE_URL;?>events/countries/38/Nigeria" class="event_location">Events in Nigeria</a></li>
      <li><a href="<?php echo SITE_URL;?>events/countries" class="event_location">Events by Countries</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries/38/Nigeria" class="event_location">Training Providers in  Nigeria</a></li>
         <li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" class="event_location">Training Providers by Category</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries" class="event_location">Training Providers by Countries</a></li>
      </ul>
</div>
    
    <?php //include("tools/categories_new.php");?>
		<div id="content_left">
			
           <div class="event_table_inner event_bg">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:28px; padding:5px;"><p><?php echo $location;?></p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
		
				<div id="subpage">
					
					<div id="subpage_content">
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
						

						echo '<li><a href="'.SITE_URL.'training-provider/countries/'.$final.'">'.$rows['countries'].'</a></li>';

						}

					//if ($count && !$isEndOfColumn && --$count === $total_item) {

    					echo "</ul></div>";

						//}

					?>
                    <?php }
					else if(isset($_GET['categories'])){
						$today = date("Y-m-d");
                    $categories = MysqlSelectQuery("select * from categories order by category_name");

					$total_item = NUM_ROWS($categories);

					$colSize = 13;

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

					

						$strip = str_replace(" / ","-",$rows['category_name']);

						$final = strtolower(str_replace($title_link,"-",$strip));

						$num = MysqlSelectQuery("select specialization from businessinfo where business_type='Training' and specialization='".$rows['category_id']."'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'training-provider/categories/'.$final.'">'.$rows['category_name'].'</a></li>';

						}

					//if ($count && !$isEndOfColumn && --$count === $total_item) {

    					echo "</ul></div>";

						//}

					}
					else{ ?>
					<div >
                    <?php
		$i = 0;
		$check_website ="";
		$web = '';
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rows['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
			$logo = MysqlSelectQuery("select * from logos where user_id ='".$rows['user_id']."' and user_id !=0");
						$biz_logo = SqlArrays($logo);
						$logoNum = NUM_ROWS($logo);
						
							if($logoNum > 0)
							{
								$biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
								$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="30" height="30"/>';
							 }
							 else{ 
							$image = '<img src="images/star.png" alt="business logo"/>';
							}
							
							
			
			switch($rows['premium']){
				case 3:
							$star = '<div class="star2"></div>';
							$bg_class ='eventListing';
							$listing_diff = '';
							$view = '<div style="display:block;"><img src="images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>';
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; font-weight:normal;">';
							$end_tag = '</h2>';
							
							break;
			}
								?>
						    
                            
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" class="eventListing"> <span class="spanTitle" style="background-color:#E3EBEE; display:block; padding:3px;"><?php echo $rows['business_name'];?></span>
                       <div class="trainingProviders" >
                       <span class="span"><?php echo substr(strip_tags(stripslashes($rows['description'])),0,160)."...";?></span>
                      
</div>
                       <?php //echo $image;?>
                       
                       <!--<img src="<?php //echo SITE_URL.$biz_logo;?>" alt="business logo" width="30" height="30"/>-->
                       
                        <div class="testImg" style="background-image:url(<?php echo SITE_URL.$biz_logo;?>); background-repeat:no-repeat;">
                        
                        </div>
                       
                       <div class="trainingProviders">
                       	<span class="provider">Contact:&nbsp;</span>
                        <span class="provider_name" style="width: 86.8852%;">
                        <span style="color:#000;">
						<?php echo $rows['address'];?>
                        </span>
                        </span>
                       
                       </div> 
                   
                     <div class="ViewBox"><img src="<?php echo SITE_URL;?>images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>
                    
                       <div class="clearfix"></div>
                       </a>
                            <?php
							$i++;
								}
					?>
                                </div>
                                <div >
                    <?php
		$i = 0;
		$check_website ="";
		$web = '';
		$resultNonPremium = MysqlSelectQuery("select * from businessinfo where business_type='Training' $countryQuery and status =1 and premium != 1 order by business_name limit $offset , $recordperpage");

$num = NUM_ROWS($resultNonPremium);

		while($rowsNonPremium = SqlArrays($resultNonPremium)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rowsNonPremium['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rowsNonPremium['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
		
							$image = '<img src="images/star.png" alt="business logo"/>';
							$star = '<div class="star1"></div>';
							$bg_class ='eventListing_odd';
							$listing_diff = '';
							
						
			?>
						    
                            
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>" class="<?php echo $bg_class;?>"> <span class="spanTitle" style="background-color:#E3EBEE; display:block; padding:3px;"><?php echo $rowsNonPremium['business_name'];?></span>
                       <div class="trainingProviders">
                       <span class="span"><?php echo substr(strip_tags(stripslashes($rowsNonPremium['description'])),0,160)."...";?></span>
                      
</div>
                      
                       
                        <div class="trainingProviders">
                       <span class="provider">Contact</span>
                        <span class="provider_name"><span style="color:#000"><?php echo $rowsNonPremium['address'];?></span></span>
                      
                       </div> 
                      <div class="ViewBox"><img src="<?php echo SITE_URL;?>images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>
                       <div class="clearfix"></div>
                       </a>
                            <?php
							$i++;
								}
								if($num > 0){
									?>
                                    <div id="paging1">
                                    <?php
								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $countryQuery ",$recordperpage,$pagenum,$paging);
                                ?>
                                </div>
                                <div id="paging2">
                                <?php
								PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $countryQuery ",$recordperpage,$pagenum,$paging);
								?>
                                </div>
                                <?php
								}
								/*else{
									//echo errorMsg("found no training provider(s)");
								}*/
								?>
                                </div>
                                <?php 
					}
					?>
                                
			  </div>
						 

                </div>
                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
		
					
		</div>
		
		<?php include("tools/side-menu_new.php");?>
</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>
</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>