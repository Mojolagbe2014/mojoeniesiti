<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$msg = '';
if(connection());
$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
$result = MysqlSelectQuery("select * from businessinfo where business_type = 'Suppliers' and status=1 order by premium desc, business_name limit $offset , $recordperpage");

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


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
 
<!-- Website Title --> 
<title>Suppliers</title>

<!-- Meta data for SEO -->
<meta name="description" content="Find Suppliers | training equipment | conference , like projectors, magnetic boards and other training related services in Nigeria. mobile <?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?>"/>
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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" alt="Alexa Tracker" /></noscript>
<!-- End Alexa Certify Javascript -->

</head>
<body>

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
		<?php include("script/header_file.php"); ?>
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                
                <h1 class="title"><strong>Suppliers of training equipment in Nigeria and around the world</strong></h1>
                <ul class="list_data">
                <?php
                $i = 0;
		$check_website ="";
		$web = '';
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rows['website'] == "") $check_website = ''; else $check_website = $rows['website'];
			switch($rows['premium']){
				case 3:
							$star = '<div class="star2"></div>';
							$bg_class ='#FFF9EA';
							$listing_diff = '';
							$view = '<a href="https://www.nigerianseminarsandtrainings.com/tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="_blank"><img src="'.SITE_URL.'images/more_info.png" alt="Visit Site" /></a>';
							//$web = $check_website;
							$start_h1 = '<h2 style="font-size:12px; color:#000;">';
							$end_h1 = '</h2>';
							
							break;
						case 2:
							$star = '<div class="star3"></div>';
							$bg_class ='#EDF4FC';
							$listing_diff = '';
							$view = '<a href="https://www.nigerianseminarsandtrainings.com/tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="_blank"><img src="'.SITE_URL.'images/more_info.png" alt="Visit Site" /></a>';
							//$web = $check_website;
							$start_h1 = '<h2 style="font-size:12px; color:#000;">';
							$end_h1 = '</h2>';
							
							break;
						break;
						case 1:
						$star = '<div class="star1"></div>';
							$bg_class ='#F5F5F5';
							$listing_diff = '';
							$view = '';
							//$web = $check_website;
							$start_h1 = '<h2 style="font-size:12px; color:#000;">';
							$end_h1 = '</h2>';
							
						break;
						default:
						$star = '';
							$bg_class ='';
							$listing_diff = '';
							$view = '';
							//$web = '';
							$start_h1 = '';
							$end_h1 = '';
							
			}
        ?>
					
			  <li>
				      
				    	<span class="header"><?php echo $start_h1;?><strong><?php echo strtoupper($rows['business_name']);?></strong><?php echo $end_h1;?></span><br/>
                       <span class="description"><?php echo substr(stripslashes(strip_tags($rows['description'])),0,200);?></span><br />
				    	<span class="description"><strong style="color:#990">Contact: </strong><?php echo $rows['address'];?></span><br />
                                        <p class="description"><strong style="color:#990">Website: </strong><?php echo $check_website; ?> | <span style="color:#09F"><a href="contact_business?provider=<?php echo str_replace($title_link,"-",$rows['business_name']);?>&tpBID=<?php echo $rows['business_id'];?>&email=<?php echo $rows['email'];?>">Click to contact business</a></span></p>
                        </li>
		
			  
                
                <?php
					}
					?>
                    <?php
				include("script/pagination.php");
				
				Pagination("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type='Suppliers' and status =1 ",$recordperpage,$pagenum,"suppliers?split")
				?>
                
                </ul>
                 <div class="search">
                <h1 class="title">Search Events</h1>
		      <form action="search" id="search_form" name="search_form" method="get">
		        <p>
		          <input type="text" id="query" name="query" title="Search" class="search"/><input type="submit" class="button_dark" value="Search"/>
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