<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$msg = '';
if(connection()){
	$today = date("Y-m-d");
	$month = date("F Y");
	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE startDate like '%$month%' and status = 1 ORDER BY  RAND() limit 0, 10");
}
//$GetAdverts = new Adverts;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
 
<!-- Website Title --> 
<title>Full Admin - Mobile</title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="Alexa" /></noscript>
<!-- End Alexa Certify Javascript -->
</head>
<body>

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
		<?php include("script/header_file.php"); ?>
		
		<br/><br/>
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                
                <h1 class="title">Upcoming Events</h1>
                <ul class="list_data">
                 <?php 
					while($rows = SqlArrays($result)){
						?>
				<li>
				    <a href="event_detail?detail=<?php echo $rows['event_id']."&value=".$rows['event_title'];?>">
				    	<span class="header"><?php echo $rows['event_title'];?></span><br/>
                        <span class="description"><strong style="color:#990">Provider: </strong><?php echo $rows['organiser'];?></span><br />
				    	<span class="description"><strong style="color:#990">Date: </strong><?php echo $rows['startDate']." - ".$rows['endDate'];?></span>
				    </a>
				    <br class="clear"/>
				</li>
                <?php
					}
					?>
                    <li><a href="events" style="color:#060"><strong>View More</strong></a></li>
                </ul>
                <div class="search">
                <h1 class="title">Search Events</h1>
		      <form action="http://www.gallyapp.com/tf_themes/fulladmin/mobile/index.html" id="search_form" name="search_form" method="get">
		        <p>
		          <input type="text" id="q" name="q" title="Search" class="search"/><input type="submit" class="button_dark" value="Search"/>
	            </p>
	          </form>
	        </div>
            <br class="clear"/>
                </div>
                <?php
				include("script/footer_menu.php");
				?>
             
	</div>
	<!-- End page wrapper -->
	
</body>

</html>