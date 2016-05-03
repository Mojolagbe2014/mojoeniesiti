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

	<title>Human Resource Management - Nigerian Seminars and Trainings <?php echo $pg;?></title>

<meta name="description" content="Find human resource management |HR| personnel management conferences, seminars, courses and training in Nigeria, Africa, Asia, North / South America, Europe <?php echo $pg;?>"/>

<meta name="keywords" content="Human Resource Management Training Seminars, Workshops, Conferences "/>

<meta name="dcterms.description" content="Find human resource management |HR| personnel management conferences, seminars, courses and training in Nigeria, Africa, Asia, North / South America, Europe"/>

<meta property="og:title" content="Human Resource Management - Nigerian Seminars and Trainings"/>

<meta property="og:description" content="Find human resource management |HR| personnel management conferences, seminars, courses and training in Nigeria, Africa, Asia, North / South America, Europe"/>

<meta property="twitter:title" content="Human Resource Management - Nigerian Seminars and Trainings"/>

<meta property="twitter:description" content="Find human resource management |HR| personnel management conferences, seminars, courses and training in Nigeria, Africa, Asia, North / South America, Europe"/>



	
<?php include("scripts/headers_new.php");?>

	

</head>

<body>


<?php include("tools/header_new.php");?>

<div id="main">

	

	<div id="content">
    
     <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">

           
<div class="event_table_inner ">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table style="width:100%;" >
  
  <tr>
    <td style="padding-left:8px; text-align:center;"><h1 style="font-size:19px; padding:5px;"><?php echo $pageInnerTitle;?></h1></td>
    </tr>
 
</table>
</form>
</div>
              
<?php //include("tools/search_box.php");?>
                                    
				<?php include 'tools/tabbed_events.php';?>

		 
                           <div id="sub_links2_middle">
                           <!-- Begin BidVertiser code -->
<div class="respond">
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
 </div>

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
  <script>
   $(document).ready(function() {
        $("#hamburger").click(function(e) {
        $("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
        $("#main-menu").toggleClass("mobile-hide");
    });
    $(".mobile-show > a").click(function(e) {
        e.preventDefault();
        $(this).parent().children("ul").toggle();
    });

  });
</script>
</body>
</html>