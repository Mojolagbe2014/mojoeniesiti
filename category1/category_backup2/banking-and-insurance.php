<?php
session_start();
require_once("../scripts/config.php");

require_once("../scripts/functions.php");

$paged = "";

$category_query = "";

$title = "";

$pg = "";

$pageInnerTitle = "";

$pastLink ="";

$pastEvent ="";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "";

$keyword = "";

	$recordperpage = 60;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];
	
	$pg = " Pg ".$_GET['page'];

	}

	
	//request the url
	$url = $_SERVER['REQUEST_URI'];
	
	//remove forward slashes from the url 
	$CategoryVal = explode('/',$url);
	
	//get the last string from the url
	if(isset($_GET['page'])){
	$urlVal = explode('?',end($CategoryVal));
	$url_category = $urlVal[0];
	}
	else{
	$url_category = end($CategoryVal);
	}
	
	//check if the string has the .php extension, add it if it does not have
	if(!strpos($url_category,'.php'))
		$searchVar = $url_category.".php";
		else
		$searchVar = $url_category;
		
	//file where to the countries ids exists
	$newFile = 'urlConfig.txt';
	
	//read the file content
	$Content = file($newFile);
	
	//looping through the file content array
	foreach($Content as $Contents){
	//removing the => from each like of the array
	$FileContent = explode("=>",$Contents);
	
	//return the id if there is a match and assign it to $val
	if($searchVar == $FileContent[0])
	$val = $FileContent[1];
	}
	

	$offset = ($pagenum - 1) * $recordperpage;
	
	$_GET['category'] = $val;
	
	if(isset($_GET['category'])){

		$query = " and category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'";

		$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");

		$rows_cat = SqlArrays($categories);
		if(isset($_GET['page'])){
		$title = $rows_cat['meta_title'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		$meta_content = $rows_cat['meta_description'].", Cat. ".$rows_cat['category_id']." Pg ".$_GET['page'];
		$keyword = $rows_cat['keyword']." Pg ".$_GET['page'];
		}
		else{
			$title = $rows_cat['meta_title'];
			$meta_content = $rows_cat['meta_description'];
			$keyword = $rows_cat['keyword'];
		}

		$advert = $rows_cat['category_name'];

		$pageInnerTitle = $rows_cat['category_name'].' conferences, training, seminars and workshops in Nigeria, Africa, Asia, North/South America, Europe and Oceania';
		
		 $path_parts = pathinfo($_SERVER['PHP_SELF']);

		$paged = $path_parts['filename']."?get";
		
		
		$strip = str_replace(" / ","-",$rows_cat['category_name']);

		$final = str_replace(" ","-",$strip);
		
		$pastLink = '?ct='.$final.'&amp;ctid='.stripslashes($_GET['category']);
		

		$pastEvent = "View past events in ".$rows_cat['category_name']." Category";
	}
	
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query and premium = 0 ORDER BY SortDate limit $offset, $recordperpage");

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('../tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Banking and Insurance - Nigerian Seminars and Trainings <?php echo $pg;?></title>

<meta name="description" content="Banking and insurance training in Nigeria | banking / bankers conferences, seminars, courses, training in Nigeria, Africa, Asia, North / South America, Europe <?php echo $pg;?>"/>

<meta name="keywords" content="Banking and Insurance Training Seminars, Workshops, Conferences "/>

<meta name="dcterms.description" content="Banking and insurance training in Nigeria | banking / bankers conferences, seminars, courses, training in Nigeria, Africa, Asia, North / South America, Europe"/>

<meta property="og:title" content="Banking and Insurance - Nigerian Seminars and Trainings"/>

<meta property="og:description" content="Banking and insurance training in Nigeria | banking / bankers conferences, seminars, courses, training in Nigeria, Africa, Asia, North / South America, Europe"/>

<meta property="twitter:title" content="Banking and Insurance - Nigerian Seminars and Trainings"/>

<meta property="twitter:description" content="Banking and insurance training in Nigeria | banking / bankers conferences, seminars, courses, training in Nigeria, Africa, Asia, North / South America, Europe"/>



	
<?php include("../scripts/headers_new.php");?>

	

</head>

<body>


<?php include("../tools/header_new.php");?>

<div id="main">

	

	<div id="content">
    
     <?php include("../tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">

           
<div class="event_table_inner ">

<form action="../search_venuproviders" method="get" id="searchform" autocomplete="off">
<table style="width:100%;" >
  
  <tr>
    <td style="padding-left:8px; text-align:center;"><h2 style="font-size:19px; padding:5px;"><?php echo $pageInnerTitle;?></h2></td>
    </tr>
 
</table>
</form>
</div>
              
<?php include("../tools/search_box.php");?>
				<div class="video_box">
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

					

						$strip = str_replace(" / ","-",$rows['countries']);

						$final = str_replace(" ","-",$strip);

						$num = MysqlSelectQuery("select category from events where country='".$rows['id']."' and status = 1 and SortDate >= '$today'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'events/countries/'.$rows['id'].'/'.$final.'">'.$rows['countries'].'</a></li>';

						}

					//if ($count && !$isEndOfColumn && --$count === $total_item) {

    					echo "</ul></div>";

						//}

					?>
                    <?php
					 }
					else{
					?>
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
                      <div itemscope itemtype="http://schema.org/EducationEvent" class="eventListing" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rowsPremium['event_id'].'/'.str_replace($title_link,"-",$rowsPremium['event_title']);?>')">
                       		<div class="eventListingInner">
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
                    
                      <span itemprop="location" style="text-align:center; display:block;">
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
					
				  include("../tools/searchResult.php");
				  
				  ?>
                 
				  <?php

		if(NUM_ROWS($result) > 0){
			?>
             <div style="float:left; width:100%;"> 
             <div id="paging1">
<?php 
					  Paging("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged);
					  
					 ?>
                     </div>
                     <div id="paging2">
<?php
                     PagingMobile("SELECT COUNT(event_id) AS numrows FROM events WHERE status = 1 $query ",$recordperpage,$pagenum,$paged);
					 ?>
                     </div>
                   </div>
                     <?php
		}

				?>	 
 <div class="button_class_right"><a href="<?php echo SITE_URL;?>past-event<?php echo $pastLink;?>"  class="cssButton_roundedLow cssButton_aqua_22" ><i class="fa fa-backward"></i>&nbsp;<?php echo $pastEvent;?></a></div>
 <?php
					}
					?>
</div>

		 
                           <div id="sub_links2_middle">
                           <!-- Begin BidVertiser code -->
<div class="respond">
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
 </div>

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