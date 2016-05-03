<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$msg = '';
if(connection()){
	$today = date("Y-m-d");
	$month = date("F Y");
	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE startDate like '%$month%' and status = 1 and premium = 0 and organiser != 'LONDON CORPORATE TRAINING' ORDER BY RAND() limit 0, 10");
}
//  Copyright 2009 Google Inc. All Rights Reserved.
  /*$GA_ACCOUNT = "MO-38908551-1";
  $GA_PIXEL = "ga.php";

  function googleAnalyticsGetImageUrl() {
    global $GA_ACCOUNT, $GA_PIXEL;
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);

    $referer = @$_SERVER['HTTP_REFERER'];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];

    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);

    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }

    $url .= "&guid=ON";

    return $url;
  }*/
?>
<!DOCTYPE html>
<html lang="en">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<meta name="keywords" content="seminars in nigeria, training in lagos, sales training in nigeria, operations management training in nigeria, training in nigeria, seminars in lagos, project management, training in Abuja, marketing training in nigeria, training programme, courses" />
<title>Nigerian Seminars and Trainings.com - training, courses | Mobile </title>
<meta name="dcterms.title" content="Nigerian Seminars and Trainings.com - training, courses | Mobile" />
<meta name="author" content="Kaiste Ventures"/>
<meta name="abstract" content="Nigerian seminars and trainings.com Mobile site"/>
<meta name="description" content="Get info on conferences, training seminars, workshops and Short Courses Nigeria, Africa, Asia, North/South America and Oceania on your mobile device."/>
<meta name="dcterms.rights" content="2010 - 2015" />
<meta name="copyright" content="Nigerian seminars and trainings.com Mobile site"/>
<meta name="revisit-After" content="1 days"/>
<meta name="distribution" content="global"/>
<meta name="robots" content="index, follow"/>
<meta property="og:image" content="<?php echo SITE_URL;?>images/facebookIMG.png"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>
<meta property="fb:page_id" content="129925353726417" />
<link rel="canonical" href="http://m.nigerianseminarsandtrainings.com"/>
<!-- Template stylesheet -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/> 
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>
</head>

<body>
<!-- Jquery and plugins -->

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-23693392-1', 'auto');
  ga('send', 'pageview');

</script>

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

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" alt="Alexa tracker" /></noscript>
<!-- End Alexa Certify Javascript -->




	<!-- Begin page wrapper -->
	<div id="wrapper">
            <header>
		<div id="top_bar">
			<div class="inner">
                            <a href="./" title="nigerian seminars and training mobile logo">
                                <img src="images/logo2.png" alt="nigerian seminars and training mobile logo"/>
				</a>
			</div>
                        <div class="home">
				<a href="./" title="nigerian seminars and training mobile ">
                                    <img src="images/icon_home.png" alt="nigerian seminars and training mobile" width="40" height="40"/>
				</a>
			</div>
		</div>
            </header>
      <div id="top_bar2">
        <nav class="inner2">
		  <a href="events" style="float:left" title="nigerian seminars and training events"><u><img src="images/events_p.png" width="68" height="21" alt="nigerian seminars and training mobile" /></u></a>
            <a href="subscribe" style="float:right" title="nigerian seminars and training jobs"><u><img src="images/jobs.png"  alt="nigerian seminars and training mobile" /></u></a>
         </nav>
        </div>
		
		<div id="content_wrapper">
			<div class="inner">
                        <div class="ads">
 
			</div>
				<div id="content" class="rounded">
                <h1 class="title">Upcoming Events</h1>
                <ul class="list_data">
               <?php 
					$today = date("Y-m-d");
					$month = date("F Y");
	$result_pre = MysqlSelectQuery("SELECT * FROM `events` WHERE SortDate >= '$today' and status = 1 and premium > 0 ORDER BY  premium desc, RAND() ");
	if(NUM_ROWS($result_pre) > 0){
					while($rows_pre = SqlArrays($result_pre)){
						if ($rows_pre['premium'] == 1){
							$star = '<div class="star2"></div>';
							$clock_icon = '<div class="calendar_time"></div>';
							$bg_class ='#FFF9EA';
							$listing_diff = '';
							$start_h1 = '<h2>';
							$end_h1 = '</h2>';
						}
						else{
							$star = '<div class="star1"></div>';
							$bg_class ='';
							$clock_icon ='<div class="icon_clock"></div>';
							$listing_diff ='';
							$start_h1 = '';
							$end_h1 = '';
						}
						?>
				<li class="premium">
				    <a href="event-detail?detail=<?php echo $rows_pre['event_id']."&amp;value=".str_replace($title_link,'-',$rows_pre['event_title']);?>" title="<?php echo $rows_pre['event_title'];?>">
				    	<span class="header"><?php echo $rows_pre['event_title'];?></span><br/>
                        <span class="description"><span style="color:#990; font-weight: bold;">Provider: </span><?php echo $rows_pre['organiser'];?></span><br />
				    	<span class="description"><span style="color:#990; font-weight: bold;">Date: </span><?php echo $rows_pre['startDate']." - ".$rows_pre['endDate'];?></span><span class="description" style="color:#09F">(Click on event title for details)</span>
				    </a>
				    <br class="clear"/>
				</li>
                <?php
					}
					
	}
					while($rows = SqlArrays($result)){
						$star = '<div class="star1"></div>';
							$bg_class ='';
							$clock_icon ='<div class="icon_clock"></div>';
							$listing_diff ='';
							$start_h1 = '';
							$end_h1 = '';
                  ?>
                    <li class="normal">
                        <a href="event-detail?detail=<?php echo $rows['event_id']."&amp;value=".str_replace($title_link,"-",$rows['event_title']);?>" title="<?php echo $rows['event_title'];?>">
				    	<span class="header"><?php echo $rows['event_title'];?></span><br/>
                        <span class="description"><span style="color:#990; font-weight: bold;">Provider: </span><?php echo $rows['organiser'];?></span><br />
				    	<span class="description"><span style="color:#990; font-weight: bold;">Date: </span><?php echo $rows['startDate']." - ".$rows['endDate'];?></span>
                        <span class="description" style="color:#09F">(Click on event title for details )</span>
				    </a>
				    <br class="clear"/>
				</li>
                <?php
					}
					?>
                    <li><a href="events" style="color:#060" title="view more events"><strong>View More</strong></a></li>
                </ul>
                
                <div class="search">
                <h2 class="title">Search Events</h2>
		      <form action="search" id="search_form" name="search_form" method="get">
		        <p>
		          <input type="text" id="query" name="query" title="Search" class="search"/><input type="submit" class="button_dark" value="Search"/>
	            </p>
	          </form>
              
	        </div>
                       <div class="ads">
 
			</div>
            <br class="clear"/>
                    </div>
                </div>
                    <footer>
            <ul class="links">
                <li><a href="categories" title="Browse events by categories"><span class="title">Browse events by categories</span></a></li>
          	<li><a href="training-p" title="Find Training Providers"><span class="title">Find Training Providers</span></a></li>
                <li><a href="managers" title='Find Event Managers'><span class="title">Find Event Managers</span></a></li>
                <li><a href="suppliers" title='Find Equipment Suppliers'><span class="title">Find Equipment Suppliers</span></a></li>
            </ul>
                  <div class="clear"></div>
			</div>
		</div>
		<div id="footer">
        <p>&copy; copyright Nigerian Seminars and Trainings.com</p>
        <p><a href="https://www.nigerianseminarsandtrainings.com?full" style="color:#090" title="visit full site">Visit Full Site</a></p>
      </div>
      <?php
?>
</footer>
                <?php
				//include("script/footer_menu.php");
				?>
            
	</div>
	<!-- End page wrapper -->
	
</body>
