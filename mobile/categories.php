<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$today = date("Y-m-d");
$advert = "All Events";
if(connection());
	$recordperpage = 10;
	$pagenum = 1;
	$pg = "";
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	$pg = ' -pg'.$_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
	
	$result = MysqlSelectQuery("select * from categories order by category_name limit $offset, $recordperpage");
	
	//  Copyright 2009 Google Inc. All Rights Reserved.
/*  $GA_ACCOUNT = "MO-38908551-1";
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
<!DOCTYPE html >
<html lang="en">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
 
<!-- Website Title --> 
<title>Browse events by categories <?php echo $pg;?></title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
</head>

<body>
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

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
		<?php include("script/header_file.php"); ?>
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                <h1 class="title">Browse events by categories</h1>
                <ul class="list_data">
                 <?php 
					while($rows = SqlArrays($result)){
						$result_cat = MysqlSelectQuery("select * from events WHERE category = '".$rows['category_id']."' and status = 1 ");
						$num = NUM_ROWS($result_cat);
						$strip = str_replace(" / ","-",$rows['category_name']);
						$final = str_replace(" ","-",$strip);
						?>
                                <li>
                                    <a href="events?category=<?php echo $rows['category_id']."&value=".$final;?>" title="events category">
				    	<span class="header"><?php echo $rows['category_name']." - ( ".$num." )";?></span>
				    </a>
				    <br class="clear"/>
				</li>
                <?php
					}
					?>
                   
                </ul>
               
            <br class="clear"/> <?php
				include("script/pagination.php");
				Pagination("SELECT COUNT(category_id) AS numrows FROM categories ",$recordperpage,$pagenum,"categories?split")
				?>
                </div>
                <?php
				include("script/footer_menu.php");
				?>
             
	</div>
	<!-- End page wrapper -->
</body>
</html>