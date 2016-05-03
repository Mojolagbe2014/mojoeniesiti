<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
$paged = "";
	if(connection());
	if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: '.SITE_URL.'login');
	exit;
}
	
$advert = "Add Event";


if(isset($_GET['evID'])){
	$result = MysqlSelectQuery("select * from events WHERE event_id = '".$_GET['evID']."'");
	
	$rows_event= SqlArrays($result);
		
	$type = CAL_GREGORIAN;
	$month = trim(stripslashes(strip_tags(@$_GET['month'])));
	$year = trim(stripslashes(strip_tags(@$_GET['year'])));
	if(!@$_GET['month'] || !is_numeric(@$_GET['month'])) $month = date('n');
	if(!@$_GET['year'] || !is_numeric(@$_GET['year'])) $year = date('Y');
	
	$day_count = cal_days_in_month($type, $month, $year);
	$last_month = $month - 1;
	$next_month = $month + 1;
	
	$last_year = $year - 1;
	$next_year = $year + 1;

	if($month == 12): 
		$change_year = $year; 
		$change_month  = $last_month;
	elseif($month == 1): 
		$change_year = $last_year;
		$change_month  = '12'; 
	else:
		$change_year = $year; 
		$change_month  = $last_month;
	endif;
		
	if($month == 1): 
		$change_year_next = $year; 
		$change_month_next  = $next_month;
	elseif($month == 12): 
		$change_year_next = $next_year;
		$change_month_next  = '1'; 
	else: 
		$change_year_next = $year; 
		$change_month_next  = $next_month;
	endif;
	$title =  "<a href='events_stat?hitID=".$_GET['evID']."&month=". $change_month ."&year=". $change_year ."'>Prev</a>&nbsp;&nbsp;<strong><span>Activity statistics " . date('F',  mktime(0,0,0,$month,1)) . "&nbsp;" . $year .
	 "</span></strong>&nbsp;&nbsp;<a href='events_stat?hitID=".$_GET['evID']."&month=". $change_month_next ."&year=". $change_year_next ."'>Next</a>";
}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23693392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Posted event: Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	
	<!--	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->
    <?php include("../scripts/headers_new.php");?>
   
	<link rel="stylesheet" type="text/css" href="../js/stat/jquery.jqplot.min.css" />
<script class="include" type="text/javascript" src="../js/stat/jquery.min.js"></script>
<script type="text/javascript" src="../js/stat/jquery.jqplot.min.js"></script>

   <script type="text/javascript" class="code">
 
$(document).ready(function(){
    // Enable plugins like highlighter and cursor by default.
    // Otherwise, must specify show: true option for those plugins.
    $.jqplot.config.enablePlugins = true;

 // var line2=[['2008-08-12 ',4], ['2008-09-13 ',6.5], ['2008-10-14 ',5.7], ['2008-11-15 ',9], ['2008-12-16 ',8.2]]
 
  var line1=[<?php
			   $sum = 0;
			 for($i = 1; $i <= $day_count; $i++){
				 $day = $i;
				 $getDate = $year."-".$month."-".$day;
				 $realDate = date("Y-m-d", strtotime($getDate));
				 $today = date("Y-m-d");
				 $result2 = MysqlSelectQuery("select * from event_views_stats where event_id='".$_GET['evID']."' and date_view ='$realDate'");
				 $rows = SqlArrays($result2);
				 $recNo = NUM_ROWS($result2);
				if($realDate <= $today && $recNo == 0){
					  $hit = 0;
					 }
					 else{
						 $hit = $rows['views'];
					 }
				
				 $sum+=$rows['views']; echo "['".$realDate."',".$hit."],";
			 }
			 ?>]
 
  var plot1 = $.jqplot('chart', [line1], {
       // title:'',
        axes:{
            xaxis:{
                renderer:$.jqplot.DateAxisRenderer, 
                rendererOptions:{
                    tickRenderer:$.jqplot.CanvasAxisTickRenderer
                },
                tickOptions:{ 
                    fontSize:'10pt', 
                    fontFamily:'Tahoma', 
                    angle:-40
                }
            },
            yaxis:{
                rendererOptions:{
                    tickRenderer:$.jqplot.CanvasAxisTickRenderer},
                    tickOptions:{
                        fontSize:'10pt', 
                        fontFamily:'Tahoma', 
                     
                    }
            }
        },
       	  series: [
                {
                    color: 'rgba(198,88,88,.6)',
                    negativeColor: 'rgba(100,50,50,.6)',
                    showMarker: true,
                    showLine: true,
                    fill: false,
                    fillAndStroke: true,
                    markerOptions: {
                        style: 'filledCircle',
                        size: 8
                    },
                    rendererOptions: {
                        smooth: true
                    }
                },
                {
                    color: 'rgba(44, 190, 160, 0.7)',
                    showMarker: true,
                    rendererOptions: {
                        smooth: true,
                    },
                    markerOptions: {
                        style: 'filledSquare',
                        size: 8
                    },
                }
            ],
        highlighter: { show: true,
			sizeAdjust: 7.5
			},
            seriesDefaults: { 
                shadowAlpha: 0.1,
                shadowDepth: 2,
                fillToZero: false
            },
      cursor: {
        show: false
      }
    });

});
</script>
    
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header_new.php");?>

<div id="main">
	
	<div id="content">
    
     <?php include('userstools/menu.php');?>
     
		<div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; min-height:80px; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:16px; padding:5px;">Views Stat for: <br /><strong><?php echo $rows_event['event_title'];?></strong></h2></td>

    </tr>
  
</table>
</form>
</div>			
<div id="tab_slider">
				<div id="subpage">
                
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper" class="rounded"> 

				<div class="Advert-plot" id="chart" style="width: 700px; height: 400px;"></div>

		    </div>
						</div>
						
					</div>
				</div>
                
                </div>
                <!-- end subpage -->
					
		</div>
		
		<?php include("../tools/side-menu_new.php");?>
	</div>
	<div id="content_bottom"></div>
	 <!-- Additional plugins go here -->

    <!-- to render rotated axis ticks, include both the canvasText and canvasAxisTick renderers -->
    <script class="include" language="javascript" type="text/javascript" src="../js/stat/plugins/jqplot.highlighter.min.js"></script>
    <script language="javascript" type="text/javascript" src="../js/stat/plugins/jqplot.canvasTextRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="../js/stat/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="../js/stat/plugins/jqplot.dateAxisRenderer.min.js"></script>
    <script language="javascript" type="text/javascript" src="../js/stat/plugins/jqplot.cursor.min.js"></script>

<!-- End additional plugins -->     
	
	<div class="clearfix"></div>
</div>

	<?php //include("../tools/footer_new.php");?>
</div>
</div>
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