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



	$recordperpage = 60;

	$pagenum = 1;
	$pagesuffix ="";

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];
	$pagesuffix = 'P G'.$pagenum;
	}

	$offset = ($pagenum - 1) * $recordperpage;
	
	if(isset($_GET['tag'])){
	
	$query = "WHERE status = 1 and tags like '%".addslashes(str_replace('-',' ',$_GET['tag']))."%'";
	
	$result = MysqlSelectQuery("select * from events $query order by premium desc, SortDate desc limit $offset , $recordperpage");
	}
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?><?php echo $pagesuffix;?></title>

<meta name="description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>"/>

<meta name="dcterms.description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>" />

<meta property="og:title" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?><?php echo $pagesuffix;?>" />

<meta property="og:description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>" />

<meta property="twitter:title" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?><?php echo $pagesuffix;?>" />

<meta property="twitter:description" content="Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?> on Nigerian Seminars and Trainings  <?php echo $pagesuffix;?>" />


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


<table style="width:100%;">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h3 style="font-size:21px; padding:5px;">Conferences, training, seminars about <?php echo ucwords(str_replace('-',' ',$_GET['tag']));?></h3></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>       
                    
                    
                    <?php include("tools/search_box.php");?>

           
				<div class="video_box">
				  <?php include("tools/searchResult.php");?>
                 
				  <?php

		if(NUM_ROWS($result) > 0){
			?>
            <div style="float:left; width:100%;"> 
             <div id="paging1">
       <?php

                    Paging("SELECT COUNT(event_id) AS numrows FROM events $query ",$recordperpage,$pagenum,"all_event_tag_search?tag=".$_GET['tag']);
                     ?>
                     </div>
                     </div>
                       <!--<div id="paging1">
       <?php

                     ?>
                     </div>-->
                     <?php
		}

				?>	 
 <div class="button_class_right"><a href="<?php echo SITE_URL;?>past-event<?php echo $pastLink;?>" title="past events"><?php echo $pastEvent;?></a></div>
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