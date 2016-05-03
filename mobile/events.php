<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$paged = "";
$category_query = "";
$title = "";
$pageInnerTitle = "";
$today = date("Y-m-d");
$dtds3=date("F");
$advert = "All Events";
$pg = "";
if(connection()){
	$recordperpage = 10;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	$pg = ' -pg'.$_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
	if(isset($_GET['category'])){
		$result = MysqlSelectQuery("select * from events WHERE category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'  ORDER BY premium desc, SortDate limit $offset, $recordperpage");
		
		$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
		$category_query = "WHERE category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'";
		$rows_cat = SqlArrays($categories);
		$title = $rows_cat['meta_title']." - Mobile".$pg;
		$meta_content = $rows_cat['meta_description']." - Mobile".$pg;
		$strip = str_replace(" / ","-",$rows_cat['category_name']);
		$final = str_replace(" ","-",$strip);
		$pageInnerTitle = 'Showing result for <span style="color:#060">'.$rows_cat['category_name'].'</span>';
		$paged = "events?category=".$_GET['category']."&value=$final";
		$advert = $rows_cat['category_name'];
	}
	else{
	if(isset($_GET['page'])){
		$meta_content = 'Search, find and register for conferences, training seminars, workshops and Short Courses Nigeria, Africa, Asia, America mobile.'." Page ".$_GET['page'];
		}
		else{
			$meta_content = 'Search, find and register for conferences, training seminars, workshops and Short Courses Nigeria, Africa, Asia, America mobile.';
		}
	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and SortDate >= '$today' ORDER BY premium desc, SortDate limit $offset, $recordperpage");
	$category_query = "WHERE status = 1 and SortDate >= '$today'";
	$pageInnerTitle = 'Latest Events';
	$title = "Latest Events ".$pg;
	$paged = "events?split";
	$advert = "All Events";
	}
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

    $referer = $_SERVER["HTTP_REFERER"];
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
<html xmlns="http://www.w3.org/1999/xhtml">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
 
<!-- Website Title --> 
<title><?php echo $title;?></title>

<!-- Meta data for SEO -->
<meta name="description" content="<?php echo $meta_content;?>"/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" alt="Alexa" /></noscript>
<!-- End Alexa Certify Javascript -->
</head>
<body>

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
		<?php include("script/header_file.php"); ?>
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                <h1 class="title"><?php echo $pageInnerTitle;?></h1>
                 <?php
				if(NUM_ROWS($result) > 0){
							?>
                <ul class="list_data">
                  <?php 
					while($rows = SqlArrays($result)){
							if ($rows['premium'] == 1){
							$status = 'premium';
							
						}
						else{
							$status = 'normal';
							
						}
						?>
				<li class="<?php echo $status;?>">
				    <a href="event-detail?detail=<?php echo $rows['event_id']."&amp;value=".str_replace($title_link,"-",$rows['event_title']);?>">
				    	<span class="header"><?php echo $rows['event_title'];?></span><br/>
                        <span class="description"><span style="color:#990; font-weight: bold;">Provider: </span><?php echo $rows['organiser'];?></span><br />
				    	<span class="description"><span style="color:#990; font-weight: bold;">Date: </span><?php echo $rows['startDate']." - ".$rows['endDate'];?></span>
				    </a>
				    <br class="clear"/>
				</li>
                <?php
					}
					?>
                   
                </ul>
               
            <br class="clear"/> <?php
				include("script/pagination.php");
				Pagination("SELECT COUNT(event_id) AS numrows FROM events $category_query",$recordperpage,$pagenum,$paged);
				}
				 else{
   echo '<div class="alert_info">
					<p>
						<img src="images/icon_info.png" alt="success" class="middle"/>
						No events found for the selected category
					</p>
				</div>';
   }
				?>
                
                </div>
                <?php
				include("script/footer_menu.php");
				?>
             
	</div>
	<!-- End page wrapper -->
	
</body>

</html>