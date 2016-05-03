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
$pg = "";


	$recordperpage = 60;

	$pagenum = 1;

	if(isset($_GET['page'])){
	$pg = " - Pg-".$_GET['page'];
	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;
	if(isset($_GET['category'])){

		//$query = " and category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'";
		
		$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
		
		$rows_cat = SqlArrays($categories);
		
		$strip = str_replace($title_link,"-",strtolower($rows_cat['category_name']));
		 
		//header("HTTP/1.1 301 Moved Permanently");
	
		header("location: ".SITE_URL."category/".$strip, true, 301);


		/*
		if(isset($_GET['page'])){
		$title = $rows_cat['meta_title'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		$meta_description = $rows_cat['meta_description'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		
		//$meta_description = $rows_cat['meta_description']."-Pg-".$_GET['page']."-of-".$rows_cat['category_id'];
		
		}
		else{
			$title = $rows_cat['meta_title'];
			$meta_description = $rows_cat['meta_description'];
		}

		$advert = $rows_cat['category_name'];

		$strip = str_replace(" / ","-",$rows_cat['category_name']);

		$final = str_replace(" ","-",$strip);

		$pageInnerTitle = 'Conferences, trainings seminars in <span style="color:#060">'.$rows_cat['category_name'].'</span> Category';

		$paged = SITE_URL."events/categories/".$_GET['category']."/$final/";
		$pastLink = '?ctid='.$_GET['category'].'&ct='.$final;
		$pastEvent = "View past events in ".$rows_cat['category_name'];*/
	}
	else if(isset($_GET['countryid']) && isset($_GET['location'])){
		
		$resultCT = MysqlSelectQuery("SELECT * FROM `countries` WHERE id = '".$_GET['countryid']."'");
		$rowsCT = SqlArrays($resultCT);
		
		$strip = str_replace($title_link,"-",$rowsCT['countries']);

		$final = strtolower(str_replace("--","-",$strip));
		
		header("location: ".SITE_URL.$final, true, 301);
		
		/*$query = "and country=".$_GET['countryid']." and status = 1 and SortDate >= '$today'";
		$location = $_GET['location'];
		$pageInnerTitle = "Training / Conferences in ".$location;
		$paged = SITE_URL."events/countries/".$_GET['countryid']."/".$_GET['location']."/";
		$pastLink = '?ctry='.$_GET['countryid'].'&l='.$location;
		$pastEvent = "View past events in ".$location;
		if(isset($_GET['page'])){

		$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location.$pg;
		$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;
		
		}

		else{

			$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location.$pg;
			$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;

			}*/

	}
	else if(isset($_GET['stateid']) && isset($_GET['location'])){
		$result = MysqlSelectQuery("SELECT * FROM `states` WHERE id_state = '".$_GET['stateid']."'");
		$rows = SqlArrays($result);
		header("Location: ".SITE_URL.strtolower(str_replace($title_link,"-",$rows['name'])), true, 301);
exit();
		
		/*$query = " and state=".$_GET['stateid']." and status = 1 and SortDate >= '$today'";
		if($_GET['location'] == 'Abuja') $location = $_GET['location']." - FCT "; 
		else
		$location = $_GET['location']." State";
		$pageInnerTitle = "Training / Conferences in ".$_GET['location']." State, Nigeria";
		$paged = SITE_URL."events/state/".$_GET['stateid']."/".$_GET['location']."/";
		$pastLink = '?st='.$_GET['stateid'].'&l='.$_GET['location'];
		$pastEvent = "View past events in ".$location;
		if(isset($_GET['page'])){

		$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location." Page ".$_GET['page'];
		$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;

		}

		else{

			$meta_description = 'Conferences | seminars | courses | workshops | summits | conventions | training in '.$location;
			$title = "Events in ".$location." - Nigerian Seminars and Trainings".$pg;

			}*/

	}
	else if (isset($_GET['category_list'])){
		$pageInnerTitle = 'Upcoming conferences, training seminars in different categories';
	
	$advert = "All Events";
	
	

			$meta_description = 'Upcoming conferences, training seminars in administrative, secretarial, financial, accounting, general management in Nigeria'.$pg;
			$title = "Upcoming conferences, training seminars in administrative, secretarial, project management - Nigerian Seminars and Trainings".$pg;

	}
	else if (isset($_GET['state_list'])){
		$pageInnerTitle = 'Upcoming conferences, training seminars in different Nigerian states';
	
	$advert = "All Events";
	
	

			$meta_description = 'Upcoming conferences, training seminars in Lagos, Abuja, Port-harcourt, Owerri, Kano, Kaduna and other part of Nigeria'.$pg;
			$title = "Upcoming conferences, training seminars in Lagos, Abuja, Port-harcourt, Owerri - Nigerian Seminars and Trainings".$pg;

	}
	
	else{
	$pageInnerTitle = 'Upcoming conferences, training seminars in different countries around the world';
	
	$advert = "All Events";
	
	

			$meta_description = 'Current and upcoming conferences | training seminars | workshops | exhibitions | in different countries around the world.'.$pg;
			$title = "Upcoming conferences | training | seminars | courses | workshops around the world - Nigerian Seminars and Trainings".$pg;

	
	}
	

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_description;?>" />

<meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />

<meta name="dcterms.description" content="<?php echo $meta_description;?>" />

<meta property="og:title" content="<?php echo $title;?>" />

<meta property="og:description" content="<?php echo $meta_description;?>" />

<meta property="twitter:title" content="<?php echo $title;?>" />

<meta property="twitter:description" content="<?php echo $meta_description;?>" />

<?php include("scripts/headers_new.php");?>

</head>

<body>

<?php include("tools/header_new.php");?>

<div id="main">

	

	<div id="content">
    
     <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">

           
<div class="event_table_inner">
<table>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px; text-align:center;"><h2 style="font-size:25px; padding:5px;"><?php echo $pageInnerTitle;?></h2></td>
    </tr>
  <tr>
    <td style="font-size:11px;">&nbsp;</td>
    </tr>
</table>
</div>

				<div class="video_box">
                	<!--<p> <strong>Training Providers in </strong></p>	-->
                    <?php 
					if (isset($_GET['countries'])){
						
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
						

						echo '<li><a href="'.SITE_URL.$final.'">'.$rows['countries'].'</a></li>';

						}

					//if ($count && !$isEndOfColumn && --$count === $total_item) {

    					echo "</ul></div>";

						//}
						}
						else if (isset($_GET['state_list'])){
						
					$today = date("Y-m-d");
                    $state = MysqlSelectQuery("select * from states order by name");

					$total_item = NUM_ROWS($state);

					$colSize = 13;

		 			$column = 0; // init a column counter
					
					for($count=0; $count< $total_item; $count++) {

					$rows = SqlArrays($state);

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

						$strip = str_replace($title_link,"-",$rows['name']);
						$final = strtolower(str_replace("--","-",$strip));

							echo '<li><a href="'.SITE_URL.$final.'" style="font-size:14px;" >'.$rows['name'].'</a></li>';

						}

    					echo "</ul>
						</div>";

						}
					else if(isset($_GET['category_list'])){
						?>
						<!-- Category Links -->
                        <div class="link_box">
                            <ul>
                                <li><a href="<?php echo SITE_URL;?>administrative-and-secretarial" title="Administrative and Secretarial">Administrative and Secretarial</a></li>
                                <li><a href="<?php echo SITE_URL;?>agriculture-and-rural-development" title="Agriculture and Rural Development.">Agriculture and Rural Development.</a></li>
                                <li><a href="<?php echo SITE_URL;?>aviation-and-maritime" title="Aviation and Maritime">Aviation and Maritime</a></li>
                                <li><a href="<?php echo SITE_URL;?>banking-and-insurance" title="Banking and Insurance">Banking and Insurance</a></li>
                                <li><a href="<?php echo SITE_URL;?>conferences-agm-seminars" title="Conferences AGM Seminars">Conferences AGM Seminars</a></li>
                                <li><a href="<?php echo SITE_URL;?>corporate-governance" title="Corporate Governance">Corporate Governance</a></li>
                                <li><a href="<?php echo SITE_URL;?>customer-service-and-support" title="Customer Service and Support">Customer Service and Support</a></li>
                                <li><a href="<?php echo SITE_URL;?>e-learning" title="E-Learning">E-Learning </a></li>
                                <li><a href="<?php echo SITE_URL;?>economic-management" title="Economic Management">Economic Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>education" title="Education">Education</a></li>
                                <li><a href="<?php echo SITE_URL;?>engineering-and-technical-skills" title="Engineering and Technical Skills">Engineering and Technical Skills</a></li>
                                <li><a href="<?php echo SITE_URL;?>entrepreneurship-and-business-development" title="Entrepreneurship and Business Development">Entrepreneurship and Business Development</a></li>
                                <li><a href="<?php echo SITE_URL;?>executive-education" title="Executive Education">Executive Education</a></li>
                                <li><a href="<?php echo SITE_URL;?>finance-and-accounting" title="Finance and Accounting">Finance and Accounting</a></li>
                                </ul>
                                </div>
                                <div class="link_box">
                                <ul>
                                <li><a href="<?php echo SITE_URL;?>general-management" title="General Management">General Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>health-and-hse" title="Health and HSE">Health and HSE</a></li>
                                <li><a href="<?php echo SITE_URL;?>human-resource-management" title="Human Resource Management">Human Resource Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>information-and-communications-technology" title="Information and Communications Technology">Information and Communications Technology</a></li>
                                <li><a href="<?php echo SITE_URL;?>internal-audit-and-fraud" title="Internal Audit, Fraud">Internal Audit, Fraud </a></li>
                                <li><a href="<?php echo SITE_URL;?>leadership-and-self-development" title="Leadership and Self Development">Leadership and Self Development</a></li>
                                <li><a href="<?php echo SITE_URL;?>legal-and-legislative" title="Legal and Legislative">Legal and Legislative</a></li>
                                <li><a href="<?php echo SITE_URL;?>logistics-and-supply-chain-management" title="Logistics and Supply Chain Management">Logistics and Supply Chain Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>management-consultancy" title="Management Consultancy">Management Consultancy</a></li>
                                <li><a href="<?php echo SITE_URL;?>marketing-and-sales-management" title="Marketing and Sales Mgt">Marketing and Sales Mgt</a></li>
                                <li><a href="<?php echo SITE_URL;?>media-and-communication" title="Media and Communication">Media and Communication</a></li>
                                <li><a href="<?php echo SITE_URL;?>oil-and-gas-energy-and-power" title="Oil and Gas Energy and Power">Oil and Gas Energy and Power</a></li> 			</ul>
                                </div>
                                <div class="link_box">
                                	<ul>
                                <li><a href="<?php echo SITE_URL;?>operations-management" title="Operations Management">Operations Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>pre-retirement-and-new-beginnings" title="Pre-Retirement and New Beginnings">Pre-Retirement and New Beginnings</a></li>
                                <li><a href="<?php echo SITE_URL;?>project-management" title="Project Management">Project Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>public-administration" title="Public Administration">Public Administration</a></li>
                               
                                <li><a href="<?php echo SITE_URL;?>real-estate-management" title="Real Estate Management">Real Estate Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>research-methodology-and-analytics" title="Research Methodology and Analytics">Research Methodology and Analytics</a></li>
                                <li><a href="<?php echo SITE_URL;?>risk-management" title="Risk Management">Risk Management </a></li>
                                <li><a href="<?php echo SITE_URL;?>security-and-crime-prevention" title="Security and Crime Prevention">Security and Crime Prevention</a></li>
                                <li><a href="<?php echo SITE_URL;?>strategic-management" title="Strategic Management">Strategic Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>telecommunications" title="Telecommunications">Telecommunications</a></li>
                                <li><a href="<?php echo SITE_URL;?>time-and-self-management" title="Time and Self Management">Time and Self Management</a></li>
                                <li><a href="<?php echo SITE_URL;?>vocational-education-and-training" title="Vocational Education and Training">Vocational Education and Training</a></li>
                               
                            </ul>
                            </div>
					
				  <?php } ?>
                 
	
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
    </div>

<?php include ("tools/footer_new.php");?>

</body>

</html>