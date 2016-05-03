<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$paged = ""; $pageSuffix  = ""; $title = ""; $pageInnerTitle = ""; $pastLink =""; $pastEvent =""; $today = date("Y-m-d"); $dtds3=date("F"); $advert = "All Events";
if(connection());
$recordperpage = 30;
$pagenum = 1;
if(isset($_GET['page'])){ $pageSuffix = "PG ".$_GET['page']; $pagenum = $_GET['page']; }
$offset = ($pagenum - 1) * $recordperpage; $query = "and SortDate >= '$today'"; $paged = SITE_URL."all-event/";
$pastEvent = "View past events";	
//regular listing of events	
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 $query and premium = 0 ORDER BY SortDate limit $offset, $recordperpage");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>All Upcoming Events - Nigerian Seminars and Trainings</title>
<meta name="description" content="Find all upcoming training in Nigeria |seminars in Nigeria |workshops |conferences in Nigeria | Africa | Asia | North/South America and Europe <?php echo $pageSuffix;?>" />
<meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />
<meta name="dcterms.description" content="Find all upcoming training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe <?php echo $pageSuffix;?>" />
<meta property="og:title" content="All Upcoming Events - Nigerian Seminars and Trainings" />
<meta property="og:description" content="Find all upcoming training in Nigeria |seminars in Nigeria |workshops |conferences in Nigeria | Africa | Asia | North/South America and Europe <?php echo $pageSuffix;?>" />
<meta property="twitter:title" content="All Upcoming Events - Nigerian Seminars and Trainings" />
<meta property="twitter:description" content="Find all upcoming training in Nigeria |seminars in Nigeria |workshops |conferences in Nigeria | Africa | Asia | North/South America and Europe <?php echo $pageSuffix;?>" />
<?php include("scripts/headers_new.php");?>
<style> #tabs a { padding-left:1em; padding-right:1em; } </style>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="sub_links">
<div class="event_table_inner">
<form>
<table>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:23px; padding:5px; font-weight: normal;"><strong style="font-weight: normal;"><u style="text-decoration:none">All upcoming conferences, training, seminars, courses and workshops in Nigeria, Africa, Asia, North/South America, Europe and Oceania</u></strong></h2></td>
</tr>
<tr>
<td style="font-size:11px"><h3><em>&nbsp;</em></h3></td>
</tr>
</table>
</form>
</div>
<?php include 'tools/tabbed_events.php';?>
    <?php //echo yearMonthHandler($thisYearMonth, $tabsIdHolder); ?>
<div id="sub_links2_middle">
<!-- Begin BidVertiser code -->
<div class="respond">
<?php echo $GetAdverts->LandScapeAds("Page Banner 2", $advert); ?>
</div>
</div>               
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div><!-- end subpage -->
<?php include("tools/side-menu_new.php");?>	
</div>	
<div class="clearfix"></div>
</div>
</div>
<script type="text/javascript">function url_location(a){window.location=a}</script>
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
            $.ajax({ 
                url:'<?php echo SITE_URL; ?>tools/LoadEvents.php', 
                data:'month='+val, 
                beforeSend: function(){ Preloader(); }, 
                success: function(data){ 
                    $('#tab1').empty().fadeIn('slow').html(data); 
                }, 
                error: function(data){ 
                    $('#tab1').empty().fadeIn('slow').html(data.responseText); 
                } 
            });
        }
        else{ 
            $('#tab1').empty().html('<div style="display: block; padding: 1%; text-align: center; font-size: 18px;"><h4 style="font-size: 18px; font-weight:normal">Please click on any of the tabs to load events</h4></div>'); 
        }
    }
    function Preloader(){ 
        $('#tab1').empty().html('<span class="preloader"><img src="<?php echo SITE_URL;?>images/preloader2.gif" alt="Loading"/> <em>Loading events...</em></span>'); 
    }
</script>
</body>
</html>