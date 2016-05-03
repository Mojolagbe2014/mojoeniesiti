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
	$newFile = 'urlConfigCategory.txt';
	
	//load title / description file admin 
	$metaFile = '../nstlogin/scripts/category_meta_title_description_training.txt';
	
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
	
	// set the offset for the pagination
	$offset = ($pagenum - 1) * $recordperpage;
	
 if(isset($val) && isset($url_category)){
	 
	 	$resultCT = MysqlSelectQuery("SELECT * FROM `categories` WHERE category_id = '".$val."'");
		$rowsCT = SqlArrays($resultCT);
	 
	 	$query = "and specialization=".$val;
		$category = $rowsCT['category_name'];
		$pageInnerTitle = "Training providers in ".$category;
		$paged = SITE_URL."training-provider/".$url_category;
	
		
		//get file content
		$file_content = file($metaFile);
		
		//remove => from string that was returned
		$meta_content = explode('=>',str_replace('[category]',$category." Category",$file_content[0]));
		
	
		$meta = $meta_content[1];
		$title = $meta_content[0];
	
	}
	

$result = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium=3 $query order by rand() limit $offset , $recordperpage");
$num = NUM_ROWS($result);

?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('../tools/analytics.php');?>


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

   <?php include("../scripts/headers_new.php");?>

</head>

<body>


  <?php include("../tools/header_new.php");?>
  
  
  <div id="main">

	<div id="content">
    
    <div class="category_content responsiveCategoryMain">
    <?php
	//if(isset($_GET['countryid']) && $_GET['countryid'] == 38){
	?>
     <div class="sneak_peak2_category">
         <div class="button_class_category">Training Providers by Category</div>
         
       
         
         </div>
     <div class="state_filter">
  
     <ul>
     <?php
	 $cat =  MysqlSelectQuery("select * from categories order by category_name");
	  while($rowscat = SqlArrays($cat)){
		  $strip = str_replace($title_link,"-",$rowscat['category_name']);

						$final = strtolower(str_replace("--","-",$strip));
	  ?>
      <li><a href="<?php echo SITE_URL.'training-provider/'.$final;?>" title="<?php echo $rowscat['category_name'];?>"><?php echo $rowscat['category_name'];?></a></li>
      <?php
	  }
	  ?>
   <!--   <li><a href="#" class="event_location">Event in Nigeria</a></li>
      <li><a href="#" class="event_location">Event by Countries</a></li>-->
     	 </ul>
       
     </div>
     <?php
//	}
	 ?>

       <div id="advert-space_2" style="text-align:center; padding-top:15px;">
       <?php echo $GetAdverts -> SkyScrapper("Page Skyscapper Left","Index");?>
       </div>
         
      <ul>
       <li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>nigeria" title="Events in Nigeria">Events in Nigeria</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>events/countries" title="Events by Countries">Events by Countries</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>training-provider/nigeria" title="Training Providers in  Nigeria">Training Providers in Nigeria</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" title="Training Providers by Category">Training Providers by Category</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>training-providers/countries" title="Training Providers by Countries">Training Providers by Countries</a></h6></li>
      </ul>
</div>
    
    <?php //include("../tools/categories_new.php");?>
		<div id="content_left">
			
           <div class="event_table_inner event_bg">


<table style="width:100%;">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:20px; padding:5px;"><?php echo $pageInnerTitle;?></h2></td>
    </tr>
  <tr>
    <td  style="font-size:11px">&nbsp;</td>
    </tr>
</table>

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

					

						$strip = str_replace(" / ","-",$rows['countries']);

						$final = str_replace(" ","-",$strip);

						$num = MysqlSelectQuery("select category from events where country='".$rows['id']."' and status = 1 and SortDate >= '$today'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'training-providers/countries/'.$rows['id'].'/'.$final.'" title="'.$rows['countries'].'">'.$rows['countries'].'</a></li>';

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

						$final = str_replace($title_link,"-",$strip);

						$num = MysqlSelectQuery("select specialization from businessinfo where business_type='Training' and specialization='".$rows['category_id']."'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'trainingCategory/spe?category='.$rows['category_id'].'-'.$final.'" title="'.$rows['category_name'].'">'.$rows['category_name'].'</a></li>';

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
						    
                            
                            <div class="<?php echo $bg_class;?>" onClick="javascript:url_location('<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>')">
                             <div style="height:300px; overflow:hidden; padding:4px;">
                             <div class="respond" >
                       		 	<div class="testImg" style="background-image:url(<?php echo SITE_URL.$biz_logo;?>); background-repeat:no-repeat;background-position:center;">
                       		 </div>
                        </div>
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" title="<?php echo $rows['business_name'];?>" > <span class="spanTitle" style="display:block; padding:3px;" ><?php echo $rows['business_name'];?></span></a>  
                            
                             
                     
<div class="trainingProviders" style="width:100%;">
                    
                      
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description" ><?php echo substr(stripslashes(strip_tags($rows['description'])),0,150).'...';?> </div>
                       
            
                       </div>
                      
                       <div class="trainingProviders">
                       	<span class="provider">Contact:&nbsp;</span>
                        <span class="provider_name">
                        <span style="color:#000;" >
						<?php echo $rows['address'];?>
                        </span>
                        </span>
                       
                       </div> 
                   </div>
                   
                      <div class="view_button"> 
                        <a class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:10px; background-color:#435A65; color:#FFF;" title="View more training providers">View More</a>
                        
                        </div>
                    
                       <div class="clearfix"></div>
                       </div>
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
		$resultNonPremium = MysqlSelectQuery("select * from businessinfo where business_type='Training' $query and status =1 and premium != 1 order by business_name limit $offset , $recordperpage");

$num = NUM_ROWS($resultNonPremium);

		while($rowsNonPremium = SqlArrays($resultNonPremium)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rowsNonPremium['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rowsNonPremium['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
		
							$image = '<img src="images/star.png" alt="business logo"/>';
							$star = '<div class="star1"></div>';
							$bg_class ='eventListing';
							$listing_diff = '';
							
						
			?>
						    
                            
                            <div class="<?php echo $bg_class;?>" onClick="javascript:url_location('<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>')">
                             <div style="height:300px; overflow:hidden; padding:4px;">
                            
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>" title="<?php echo $rowsNonPremium['business_name'];?>" > <span class="spanTitle" style="display:block; padding:3px;" ><?php echo $rowsNonPremium['business_name'];?></span></a>  
                            
                             
                     
<div class="trainingProviders" style="width:100%;">
                    
                      
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description" ><?php echo substr(stripslashes(strip_tags($rowsNonPremium['description'])),0,150).'...';?> </div>
                       
            
                       </div>
                     
                       <div class="trainingProviders">
                       	<span class="provider">Contact:&nbsp;</span>
                        <span class="provider_name">
                        <span style="color:#000;" >
						<?php echo $rowsNonPremium['address'];?>
                        </span>
                        </span>
                       
                       </div> 
                   </div>
                   
                      <div class="view_button"> 
                        <a class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:10px; background-color:#435A65; color:#FFF;" title="View more training providers" >View More</a>
                        
                        </div>
                    
                       <div class="clearfix"></div>
                       </div>
                            <?php
							$i++;
								}
								if($num > 0){
									?>
                                    <div style="width:100%; float:left;">
                                    <div id="paging1">
                                    <?php
								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $query ",$recordperpage,$pagenum,$paged."?cat");
                                ?>
                                </div>
                                <div id="paging2">
                                <?php
								PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $query ",$recordperpage,$pagenum,$paged."?cat");
								?>
                                </div>
                                </div>
                                <?php
								}
								
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
		
		<?php include("../tools/side-menu_new.php");?>
</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>
</div>
<?php include ("../tools/footer_new.php");?>

</body>
</html>