<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");

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
	if(isset($_GET['year'])){
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

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_content;?>" />

<meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />

<meta name="dcterms.description" content="<?php echo $meta_content;?>" />

<meta property="og:title" content="<?php echo $title;?>" />

<meta property="og:description" content="<?php echo $meta_content;?>" />

<meta property="twitter:title" content="<?php echo $title;?>" />

<meta property="twitter:description" content="<?php echo $meta_content;?>" />

	

	<!--<link rel="stylesheet" href="<?php //echo SITE_URL;?>style.css" type="text/css" media="screen" />-->

	
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

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<?php include("tools/header_new.php");?>

<?php include("tools/search_box.php");?>

<div id="main">

	

	<div id="content">
    
     <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">

           
<div class="event_table_inner" style="border:solid 1px #066; background-color:#FFFFFF;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px" align="center"><h3 style="font-size:19px; padding:5px;"><?php echo $pageInnerTitle;?></h3></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
              

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
                    <?php }else{ ?>
				  <?php include("tools/searchResult.php");?>
                 
				  <?php

		if(NUM_ROWS($result) > 0){
			?>
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
                     <?php
		}

				?>	 
 <div class="button_class_right"><a href="<?php echo SITE_URL;?>past-event<?php echo $pastLink;?>"><?php echo $pastEvent;?></a></div>
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

			<?php include("tools/side-menu_new.php");?>	

		</div>
        <div class="clearfix"></div>
	</div>
    </div>

<?php include ("tools/footer_new.php");?>
 <script type="text/javascript">
     $(document).ready(function(){
        EventLoader('<?php echo date("Y-m");?>','<?php echo @$loadEvent;?>');
         $('#tabs li a').click(function(){
             if($(this).parents("li:first").attr('id') != "current"){
                 $('#current').removeClass('current');
                 $('#current').attr('id',"");
                 var ID = $(this).attr('id');
                 EventLoader(ID,'true');
             }
             return false;
         });
     });
     function EventLoader(val,load){
      if(load == 'true'){
          var id = <?php echo $_GET['category'];?>
        $.ajax({
            url:'<?php echo SITE_URL;?>tools/LoadEvents.php',
            data:'month='+val+'&category='+id,
            beforeSend: function(){
               Preloader()
            },
            success: function(data){
                $('#tab1').empty().fadeIn('slow').html(data);
            },
            error: function(data){
                $('#tab1').empty().fadeIn('slow').html(data.responseText);
            }
           })
        }else{
           $('#tab1').empty().html('<div style="display: block; padding: 1%; text-align: center; font-size: 18px;">Please click on any of the tabs to load events</div>'); 
        }
     }
     function Preloader(){
         $('#tab1').empty().html('<span class="preloader"><img src="<?php echo SITE_URL;?>images/preloader2.gif" /> Loading events...</span>'); 
     }
 </script>
 
</body>
</html>