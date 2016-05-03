<?php
session_start(); require_once("scripts/config.php"); require_once("scripts/functions.php");
$paged = ""; $category_query = ""; $title = ""; $pageInnerTitle = ""; $pastLink =""; $pastEvent ="";
$today = date("Y-m-d"); $dtds3=date("F"); $advert = "All Events"; $pg = ""; $recordperpage = 30; $pagenum = 1;
if(isset($_GET['page'])){ 
    $pg = " - Pg-".$_GET['page']; $pagenum = $_GET['page']; 
    header("HTTP/1.0 404 Not Found");
    exit();
}
$url = $_SERVER['REQUEST_URI']; $stateVal = explode('/',$url);
if(isset($_GET['year'])){ $urlVal = explode('?',end($stateVal)); $urlSate = $urlVal[0]; }
else{ $urlSate = end($stateVal); }
$val  = str_replace("-"," ",$urlSate);

$offset = ($pagenum - 1) * $recordperpage;
 if(isset($val) && isset($urlSate) ){
    $resultState = MysqlSelectQuery("SELECT * FROM `states` WHERE name = 'lagos'");
    $rowsState = SqlArrays($resultState);
    $resultStatDiv = MysqlSelectQuery("SELECT * FROM `lagos_divisions` WHERE name = '".$val."'");
    $rowStateDivs = SqlArrays($resultStatDiv);
    $query = " AND state=25 AND division = '".$rowStateDivs['id']."' AND SortDate >= '$today'";
    $location = $rowStateDivs['name'].", Lagos State"; 
    $pageInnerTitle = "Conferences, training, seminars and workshops in ".$location.", Nigeria";
    //$paged = SITE_URL."state/".$urlSate;
    $pastLink = '?l='.$rowStateDivs['name'].'&amp;st='.$rowStateDivs['id'];
    $pastEvent = "View past events in ".$location;
    $eventYear = filter_input(INPUT_GET, 'year') ? " ".filter_input(INPUT_GET, 'year') : "";
    $meta_description = trimStringToFullWord(150, stripslashes(strip_tags(preg_replace('/\s+/', ' ',$rowsState['meta_description'])." ($location) $eventYear ")));
    $title = trimStringToFullWord(60, stripslashes(strip_tags("Training in ".$location. ", Nigeria $eventYear - Nigeria Seminars and Trainings")));
}
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query and premium = 0 ORDER BY  SortDate limit $offset, $recordperpage");
?>
<!DOCTYPE html>
<html lang="en">
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
<table style="height:100px;width:100%;border:0px;">
<tr>
<td style="padding-left:8px; text-align:center"><h1 style="font-size:23px; padding:5px;"><?php echo $pageInnerTitle;?></h1></td>
</tr>
</table>
</div>
<?php include 'tools/tabbed_events.php';?>
    <?php //echo yearMonthHandler($thisYearMonth, $tabsIdHolder); ?>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
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
function EventLoader(val,load){
if(load == 'true'){
var stateId = <?php echo $rowsState['id_state'];?>;
var divId = <?php echo $rowStateDivs['id'];?>;
$.ajax({
url:'<?php echo SITE_URL;?>tools/LoadEvents.php',
data:'month='+val+'&state='+stateId+'&stateDivision='+divId,
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