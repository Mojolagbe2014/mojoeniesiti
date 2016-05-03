<?php
session_start();  require_once("scripts/config.php"); require_once("scripts/functions.php");
$paged = ""; $category_query = ""; $title = ""; $pg = ""; $pageInnerTitle = ""; $pastLink =""; $pastEvent =""; $today = date("Y-m-d"); $dtds3=date("F"); $advert = ""; $keyword = ""; $recordperpage = 60; $pagenum = 1;
if(isset($_GET['page'])){ 
    $pagenum = $_GET['page']; $pg = " Pg ".$_GET['page']; 
    header("HTTP/1.0 404 Not Found");
    exit();
}
if(isset($_GET['search'])){ header("HTTP/1.0 404 Not Found"); exit();}

$url = $_SERVER['REQUEST_URI']; $CategoryVal = explode('/',$url);
if(isset($_GET['year'])){ $urlVal = explode('?',end($CategoryVal)); $url_category = $urlVal[0]; }
else{ $url_category = end($CategoryVal); }
if(!strpos($url_category,'.php')) {$searchVar = $url_category.".php";} else {$searchVar = $url_category;}
$newFile = 'urlConfig.txt'; $Content = file($newFile);
foreach($Content as $Contents){ $FileContent = explode("=>",$Contents); if($searchVar == $FileContent[0]) {$val = $FileContent[1];} }
$offset = ($pagenum - 1) * $recordperpage; $_GET['category'] = $val;
	
if(isset($_GET['category'])){
    $query = " and category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'";
    $categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
    $rows_cat = SqlArrays($categories);
    $eventYear = filter_input(INPUT_GET, 'year') ? " - ".filter_input(INPUT_GET, 'year') : "";
    $title = trimStringToFullWord(55, stripslashes(strip_tags($rows_cat['meta_title']))).$eventYear; $meta_content = trimStringToFullWord(150, stripslashes(strip_tags($rows_cat['meta_description']))); $keyword = $rows_cat['keyword']; 
    $advert = $rows_cat['category_name'];
    $pageInnerTitle = $rows_cat['category_name'].' conferences, training, seminars and workshops in Nigeria, Africa, Asia, North/South America, Europe and Oceania';
}
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query and premium = 0 ORDER BY SortDate limit $offset, $recordperpage");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_content; ?>"/>
<meta name="keywords" content="<?php echo $keyword; ?>"/>
<meta name="dcterms.description" content="<?php echo $meta_content; ?>"/>
<meta property="og:title" content="<?php echo $title; ?>"/>
<meta property="og:description" content="<?php echo $meta_content; ?>"/>
<meta property="twitter:title" content="<?php echo $title; ?>"/>
<meta property="twitter:description" content="<?php echo $meta_content; ?>"/>
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
<td style="padding-left:8px; text-align:center;"><h1 style="font-size:23px; font-weight:normal; padding:5px;"><?php echo $pageInnerTitle;?></h1></td>
</tr>
</table>
</form>
</div>
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
        if(sessionStorage.monthEventId == 'undefined' || sessionStorage.monthEventId =='' || sessionStorage.monthEventId ==null){
            <?php if(yearMonthHandler($thisYearMonth, $tabsIdHolder)!=false){ ?>
            EventLoader('<?php echo yearMonthHandler($thisYearMonth, $tabsIdHolder);?>','<?php echo @$loadEvent;?>');
            <?php } else { ?>
                $('.preloader').empty().html('There are no events (uploaded) for the chosen period.');
            <?php } ?>
        } else{
            if($('#'+sessionStorage.monthEventId+'').parents("li:first").attr('id') != "current"){ 
                $('#current').removeClass('current'); 
                $('#current').attr('id',""); 
                $('#'+sessionStorage.monthEventId+'').parents("li:first").addClass('current').attr('id', 'current');
            }
            EventLoader(sessionStorage.monthEventId,'true'); 
            sessionStorage.clear();
        }
        $('#tabs li a').click(function(){ 
            if($(this).parents("li:first").attr('id') != "current"){ 
                $('#current').removeClass('current'); 
                $('#current').attr('id',""); 
                var ID = $(this).attr('id'); 
                if(typeof(Storage) !== "undefined") {
                    sessionStorage.monthEventId = ID;
                    window.location.reload();
                } else {
                    EventLoader(ID,'true'); 
                }
                //EventLoader(ID,'true'); 
            } return false; 
        }); 
    });
function EventLoader(val,load){ if(load == 'true'){ var id = <?php echo $_GET['category'];?>
$.ajax({ url:'<?php echo SITE_URL;?>tools/LoadEvents.php', data:'month='+val+'&category='+id, beforeSend: function(){ Preloader() }, success: function(data){ $('#tab1').empty().fadeIn('slow').html(data); }, error: function(data){ $('#tab1').empty().fadeIn('slow').html(data.responseText); } }) }else{ $('#tab1').empty().html('<div style="display: block; padding: 1%; text-align: center; font-size: 18px;">Please click on any of the tabs to load events</div>'); } }
function Preloader(){ $('#tab1').empty().html('<span class="preloader"><img src="<?php echo SITE_URL;?>images/preloader2.gif" /> Loading events...</span>'); }
</script>

</body>
</html>