<?php
session_start();
require_once("../scripts/config.php");

require_once("../scripts/functions.php");

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


	$recordperpage = 30;

	$pagenum = 1;

	if(isset($_GET['page'])){
	$pg = " - Pg-".$_GET['page'];
	$pagenum = $_GET['page'];

	}
	$url = $_SERVER['REQUEST_URI'];
	$stateVal = explode('/',$url);
	$urlSate = (isset($_GET['get']) ? $_GET['get'] : end($stateVal));
	$val  = str_replace("-"," ",$urlSate);

	$offset = ($pagenum - 1) * $recordperpage;
 if(isset($val) && isset($urlSate) ){
	 	
		$resultState = MysqlSelectQuery("SELECT * FROM `states` WHERE name = '".$val."'");
		$rowsState = SqlArrays($resultState);
		
		$query = " and state=".$rowsState['id_state']." and status = 1 and SortDate >= '$today'";
		if($rowsState['name'] == 'Abuja') $location = $rowsState['name']." - FCT "; 
		else
		$location = $rowsState['name']." State";
		$pageInnerTitle = "Conferences, training, seminars and workshops in ".$location.", Nigeria";
		$paged = SITE_URL."state/".$urlSate;
		$pastLink = '?l='.$rowsState['name'].'&amp;st='.$rowsState['id_state'];
		$pastEvent = "View past events in ".$location;
		$meta_description = $rowsState['meta_description'].$pg;
		$title = $rowsState['meta_title'].$pg;
	}
	

$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query and premium = 0 ORDER BY  SortDate limit $offset, $recordperpage");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('../tools/analytics.php');?>


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

	

	<!--<link rel="stylesheet" href="<?php //echo SITE_URL;?>style.css" type="text/css" media="screen" />-->

	
<?php include("../scripts/headers_new.php");?>

	

</head>



<body>

<?php include("../tools/header_new.php");?>



<div id="main">

	

	<div id="content">
    
     <?php include("../tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">

           
<div class="event_table_inner event_bg">


<table width="100%" border="0" style="height:100px;">
 
  <tr>
    <td style="padding-left:8px" align="center"><h2 style="font-size:25px; padding:5px;"><?php echo $pageInnerTitle;?></h2></td>
    </tr>
 
</table>

</div>
              <?php include("../tools/search_box.php");?>

				<div class="video_box">
                	<?php
					if(!isset($_GET['page']) or $_GET['page'] == 1){
		$resultPremium = MysqlSelectQuery("SELECT * FROM `events` WHERE premium = 1 $query ORDER BY  rand(), SortDate limit 0, 30");
					while($rowsPremium = SqlArrays($resultPremium)){
						
			if ($rowsPremium['premium'] == 1){
								$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rowsPremium['organiser']."%'");
						$biz_name = SqlArrays($business);
							if($biz_name['logos'] == '') $logo = 'images/star2.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
							$star = '<img src="'.SITE_URL.$logo.'" alt="business logo" width="50" height="50"/>';

							$clock_icon = '<div class="calendar_time"></div>';

							$bg_class = '';

							$listing_diff = '';

							$start_h1 = '<h2>';

							$end_h1 = '</h2>';
							
							$pre_link = '<a href="'.SITE_URL.'tprovider/'.$biz_name['business_id'].'/'.str_replace($title_link,"-",$biz_name['business_name']).'" target="_blank" style="color:#333; font-weight:normal;">'.$rowsPremium['organiser'].'</a>';

						}

						else{

							$star = '<div class="star1" style="float:right; margin-right:35px;"></div>';

							$bg_class ='#F7F7F7';

							$clock_icon ='<div class="icon_clock"></div>';

							$listing_diff ='';

							$start_h1 = '';

							$end_h1 = '';
							$pre_link = $rowsPremium['organiser'];

						}

			?>
                      <div itemscope itemtype="http://schema.org/EducationEvent" class="eventListing <?php echo ($rowsPremium['deals'] != '') ? 'deals' : '' ?>" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rowsPremium['event_id'].'/'.str_replace($title_link,"-",$rowsPremium['event_title']);?>')">
                       		<div class="eventListing <?php echo ($rowsPremium['deals'] != '') ? 'deals' : '' ?>Inner">
                      			<a href="<?php echo SITE_URL.'events/'.$rowsPremium['event_id'].'/'.str_replace($title_link,"-",$rowsPremium['event_title']);?>" itemprop="url" style="display:block; padding:3px;" title="<?php echo $rowsPremium['event_title'];?>">
                                	<span class="spanTitle" itemprop="name" ><?php echo $rowsPremium['event_title'];?></span>
                                 </a> 
                      <div class="innerHeadingPropEvent">
     <p itemprop="doorTime" ><?php echo dateDiff($rowsPremium['startDate'], $rowsPremium['endDate']);?>, 
                       <?php echo date('M d',strtotime($rowsPremium['startDate']))." - ".date('d M, Y',strtotime($rowsPremium['endDate']));?> &nbsp;</p>
                         <span style="display:none;" itemprop="startDate" content="<?php echo date('Y-m-d h:m:s',strtotime($rowsPremium['startDate']));?>"><?php echo date('Y-m-d h:m:s',strtotime($rowsPremium['startDate']));?>
                         </span>
                 
                        <div class="clearfix"></div>   
                       </div>  
                    
                       <span style="text-align:center;" itemprop="location">
                       
                      
					   <?php echo GetEventLocation($rowsPremium['event_id']);?>
                     </span>
                         
                         
                        <div class="respond">
                       <div class="testImg" style="background-image:url(<?php echo SITE_URL.$logo;?>); background-repeat:no-repeat; background-position:center;">
                       </div>
                </div>
                       
                      
<p style="text-align:center; font-size:14px; color: #105773; margin:5px 0 5px 0;" >
	<?php echo $rowsPremium['organiser'];?>
</p>

                        <div class="trainingProviders" style="width:100%;">
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description" itemprop="description" ><?php echo substr(stripslashes(strip_tags($rowsPremium['description'])),0,150).'...';?> </div>

                       </div> 
                     </div>
                        <div class="view_button"> 
                        <a class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:10px; background-color:#435A65; color:#FFF;" title="View More">View More</a></div>
                       <div class="clearfix"></div>   
                       </div>
  <?php

						}
					}
				
					?>
                    
                  
				  <?php include("../tools/searchResult.php");?>
                 
				  <?php

		if(NUM_ROWS($result) > 0){
			?>
             <div style="float:left; width:100%;"> 
             <div id="paging1">
<?php
                      Paging("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged."?get=".$urlSate);
					 ?>
                     </div>
                     <div id="paging2">
<?php
                    PagingMobile("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged."?get=".$urlSate);
					 ?>
                     </div>
                     </div>
    
  <div ><a href="<?php echo SITE_URL;?>past-event<?php echo $pastLink;?>" class="button_class_right cssButton_roundedLow cssButton_aqua_22" ><i class="fa fa-backward"></i>&nbsp;<?php echo $pastEvent;?></a></div>
  
  
 <?php
					}
					?>
</div>

		 
                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

      <div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
      
     <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

	
 </div>               
        
<div class="clearfix"></div>

</div>

			</div><!-- end subpage -->

			<?php include("../tools/side-menu_new.php");?>	

		</div>
        <div class="clearfix"></div>
	</div>
    </div>

<?php include ("../tools/footer_new.php");?>

</body>

</html>