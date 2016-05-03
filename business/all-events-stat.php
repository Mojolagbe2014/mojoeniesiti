<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
$paged = "";
	if(connection());
	if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}
	
$advert = "Add Event";

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


	<title>All Events Statistics: Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	
	<!--	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->
    <?php include("../scripts/headers_new.php");?>
   
	<link rel="stylesheet" type="text/css" href="../js/stat/jquery.jqplot.min.css" />
<script class="include" type="text/javascript" src="../js/stat/jquery.min.js"></script>
<script type="text/javascript" src="../js/stat/jquery.jqplot.min.js"></script>
<style>

</style>
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header_new.php");?>

<div id="main">
	
	<div id="content">
    
     <?php include("menu.php");?>
     
		<div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; min-height:80px; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;" >
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Posted Events Statistics</h2></td>

    </tr>
  
</table>
</form>
</div>			
<div id="tab_slider">
				<div id="subpage">
                
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper" class="rounded"> 

				<div  class='eventviews'>
 <?php
     print "
	 
        <table border='0' class='listTable' style='width:100%;'>
			<tr>
				<th width='48%' style='text-align:left;'>Event Name</th> <th width='11%'>Views/Today</th> <th width='10%'>Last 7 Days</th> <th width='10%'>Current Month</th> <th width='10%'>Current Year</th> <th width='11%'>Total Views</th>
			</tr>
     ";
	 
	 $serialNo = 0; // Serial number of the events
	 
	//Fetch each event from event table by the business name
	$eventsResult = MysqlSelectQuery("select * from events where user_id = '".$_SESSION['user_id']."' and SortDate >= CURDATE() "); //Premium Businesses

	$dailyTotal = 0;
	$weeklyTotal = 0;
	$monthlyTotal = 0;
	$yearlyTotal = 0;
	$GrandTotalViews = 0;
	
	while($eventRows = mysqli_fetch_array($eventsResult)){
		//Fetch the number_of_views from event_views_stat table 
		$viewsResultDay = MysqlSelectQuery("SELECT * FROM event_views_stats WHERE event_id = '".$eventRows['event_id']."' AND date_view = CURDATE() ");
		$viewsRowsDay = SqlArrays($viewsResultDay);
		$dailyViews = $viewsRowsDay['views']; //Views counts of each event
		if($dailyViews=="" || $dailyViews==NULL) $dailyViews = 0; //Replace empty views with 0
		
		
		$viewsResultWeek = MysqlSelectQuery("SELECT SUM(views) FROM event_views_stats WHERE event_id = '".$eventRows['event_id']."' AND date_view BETWEEN DATE_SUB(CURDATE(),INTERVAL 7 DAY) AND CURDATE()"); //> CURRENT_DATE - INTERVAL 7 DAY;
		$viewsRowsWeek = SqlArrays($viewsResultWeek);
		$weeklyViews = $viewsRowsWeek[0]; //Weekly Views counts of each event
		if($weeklyViews=="" || $weeklyViews==NULL) $weeklyViews = 0; //Replace empty views with 0
			
		$viewsResultMonth = MysqlSelectQuery("SELECT SUM(views) FROM event_views_stats WHERE event_id = '".$eventRows['event_id']."' AND MONTH(date_view) = MONTH(CURRENT_DATE) AND YEAR(date_view) = YEAR(CURDATE())");
		$viewsRowsMonth = SqlArrays($viewsResultMonth);
		$monthlyViews = $viewsRowsMonth[0]; //Monthly Views counts of each event
		if($monthlyViews=="" || $monthlyViews==NULL) $monthlyViews = 0; //Replace empty views with 0
			
		$viewsResultYear = MysqlSelectQuery("SELECT SUM(views) FROM event_views_stats WHERE event_id = '".$eventRows['event_id']."' AND YEAR(date_view) = YEAR(CURDATE())");
		$viewsRowsYear = SqlArrays($viewsResultYear);
		$yearlyViews = $viewsRowsYear[0]; //Yearly Views counts of each event
		if($yearlyViews=="" || $yearlyViews==NULL) $yearlyViews = 0; //Replace empty views with 0
			
		$viewsResultTotal = MysqlSelectQuery("SELECT SUM(views) FROM event_views_stats WHERE event_id = '".$eventRows['event_id']."' ");
		$viewsRowsTotal = SqlArrays($viewsResultTotal);
		$totalViews = $viewsRowsTotal[0]; //Yearly Views counts of each event
		if($totalViews=="" || $totalViews==NULL) $totalViews = 0; //Replace empty views with 0
			
		$serialNo +=1; //Increment the serial number
		$dailyTotal +=  $dailyViews;
		$weeklyTotal +=  $weeklyViews;
		$monthlyTotal +=  $monthlyViews;
		$yearlyTotal +=  $yearlyViews;
		$GrandTotalViews += $totalViews;
		print "
			  <tr style='text-align:center;'>
				<td style='text-align:left'>{$eventRows['event_title']}</td> <td>{$dailyViews}</td> <td>$weeklyViews</td> <td>$monthlyViews</td> <td>$yearlyViews</td> <td>$totalViews</td>
			</tr>
		";
	 }
	 echo "<tr style='text-align:center;'>
			<td style='text-align:right'>Total Views:</td> <td>{$dailyTotal}</td> <td>$weeklyTotal</td> <td>$monthlyTotal</td> <td>$yearlyTotal</td> <td>$GrandTotalViews</td>
			</tr>";
	 echo "</table>"; //viewevent?detail=
 ?>
 
    </div>

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
	
	<div class="clearfix"></div>
</div>

	<?php include("../tools/footer_new.php");?>
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