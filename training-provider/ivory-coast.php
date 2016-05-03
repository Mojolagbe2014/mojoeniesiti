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
	$CountryVal = explode('/',$url);
	
	//get the last string from the url
	if(isset($_GET['page'])){
		$urlVal = explode('?',end($CountryVal));
	$url_country = $urlVal[0];
	}
	else{
	$url_country = end($CountryVal);
	}
	
	//check if the string has the .php extension, add it if it does not have
	if(!strpos($url_country,'.php'))
		$searchVar = $url_country.".php";
		else
		$searchVar = $url_country;
		
	//file where to the countries ids exists
	$newFile = 'urlConfigCountries.txt';
	
	//load title / description file admin 
	$metaFile = '../nstlogin/scripts/countries_meta_title_description_training.txt';
	
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
	
 if(isset($val) && isset($url_country)){
	 
	 	$resultCT = MysqlSelectQuery("SELECT * FROM `countries` WHERE id = '".$val."'");
		$rowsCT = SqlArrays($resultCT);
	 
	 	$query = "and country=".$val;
		$location = $rowsCT['countries'];
		$pageInnerTitle = "Training providers in ".$location;
		$paged = SITE_URL."training-provider/".$url_country;
	
		
		//get file content
		$file_content = file($metaFile);
		
		//remove => from string that was returned
		$meta_content = explode('=>',str_replace('[country]',$location,$file_content[0]));
		
	
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
  <?php include("../tools/header_new.php");?>
  
  
  <div id="main">

	<div id="content">
    
    <div class="category_content responsiveCategoryMain">
      <div id="advert-space" style="text-align:center; padding-top:15px;">
      <!-- States in Nigeria get deleted here  -->
       <?php echo $GetAdverts -> SkyScrapper("Page Skyscapper Left",$advert);?>
       </div>
         <br/><br/>
      <ul>
            <li><a href="<?php echo SITE_URL;?>countries/nigeria" class="event_location">Events in Nigeria</a></li>
      <li><a href="<?php echo SITE_URL;?>events/countries" class="event_location">Events by Countries</a></li>
       <li><a href="<?php echo SITE_URL;?>training-provider/nigeria" class="event_location">Training Providers in  Nigeria</a></li>
         <li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" class="event_location">Training Providers by Category</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries" class="event_location">Training Providers by Countries</a></li>
      </ul>
</div>
    
    <?php //include("../tools/categories_new.php");?>
		<div id="content_left">
			
           <div class="event_table_inner event_bg">

<form action="../search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:28px; padding:5px;"><p><?php echo $pageInnerTitle;?></p></h2></td>
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

					

						$strip = str_replace(" / ","-",$rows['countries']);

						$final = str_replace(" ","-",$strip);

						$num = MysqlSelectQuery("select category from events where country='".$rows['id']."' and status = 1 and SortDate >= '$today'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'training-providers/countries/'.$rows['id'].'/'.$final.'">'.$rows['countries'].'</a></li>';

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
						

						echo '<li><a href="'.SITE_URL.'trainingCategory/spe?category='.$rows['category_id'].'-'.$final.'">'.$rows['category_name'].'</a></li>';

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
						    
                            
                            <div itemscope itemtype="http://schema.org/Organization" class="<?php echo $bg_class;?>" onClick="javascript:url_location('<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>')">
                             <div style="height:300px; overflow:hidden; padding:4px;">
                             <div class="respond" >
                       		 	<div class="testImg" style="background-image:url(<?php echo SITE_URL.$biz_logo;?>); background-repeat:no-repeat;background-position:center;">
                       		 </div>
                        </div>
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" > <span class="spanTitle" style="display:block; padding:3px;" itemprop="name"><?php echo $rows['business_name'];?></span></a>  
                            
                             
                     
<div class="trainingProviders" style="width:100%;">
                    
                      
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description" ><?php echo substr(stripslashes(strip_tags($rows['description'])),0,150).'...';?> </div>
                       
            
                       </div>
                       <?php //echo $image;?>
                       
                       <!--<img src="<?php //echo SITE_URL.$biz_logo;?>" alt="business logo" width="30" height="30"/>-->
                     
                       
                       <div class="trainingProviders">
                       	<span class="provider">Contact:&nbsp;</span>
                        <span class="provider_name">
                        <span style="color:#000;" itemprop="address">
						<?php echo $rows['address'];?>
                        </span>
                        </span>
                       
                       </div> 
                   </div>
                   
                      <div class="view_button"> 
                        <a class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:10px; background-color:#435A65; color:#FFF;">View More</a>
                        
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
						    
                            
                            <div itemscope itemtype="http://schema.org/Organization" class="<?php echo $bg_class;?>" onClick="javascript:url_location('<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>')">
                             <div style="height:300px; overflow:hidden; padding:4px;">
                            
                            <a href="<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>" > <span class="spanTitle" style="display:block; padding:3px;" itemprop="name"><?php echo $rowsNonPremium['business_name'];?></span></a>  
                            
                             
                     
<div class="trainingProviders" style="width:100%;">
                    
                      
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description" ><?php echo substr(stripslashes(strip_tags($rowsNonPremium['description'])),0,150).'...';?> </div>
                       
            
                       </div>
                       <?php //echo $image;?>
                       
                       <!--<img src="<?php //echo SITE_URL.$biz_logo;?>" alt="business logo" width="30" height="30"/>-->
                     
                       
                       <div class="trainingProviders">
                       	<span class="provider">Contact:&nbsp;</span>
                        <span class="provider_name">
                        <span style="color:#000;" itemprop="address">
						<?php echo $rowsNonPremium['address'];?>
                        </span>
                        </span>
                       
                       </div> 
                   </div>
                   
                      <div class="view_button"> 
                        <a class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:10px; background-color:#435A65; color:#FFF;">View More</a>
                        
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
								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $query ",$recordperpage,$pagenum,$paged."?loc");
                                ?>
                                </div>
                                <div id="paging2">
                                <?php
								PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $query ",$recordperpage,$pagenum,$paged."?loc");
								?>
                                </div>
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
		
		<?php include("../tools/side-menu_new.php");?>
</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>
</div>
<?php include ("../tools/footer_new.php");?>
</body>
</html>