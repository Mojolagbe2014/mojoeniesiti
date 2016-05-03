<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$id = "";
if(isset($_GET['detail'])) $id = $_GET['detail'];
$url ="";

	if(connection());
	$result = MysqlSelectQuery("select * from events where event_id = '$id'");
	
	
	$rows = SqlArrays($result);
	$url = $rows['website'];
	 $cat =  MysqlSelectQuery("select * from categories where category_id = '".$rows['category']."'");
	 $rows_cat = SqlArrays($cat);

$advert = "Event Detail";
if (!strstr($url, "http://") == $url) {$url ="http://".$rows['website']; }

//  Copyright 2009 Google Inc. All Rights Reserved.
 /* $GA_ACCOUNT = "MO-38908551-1";
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
<html lang="en">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
  <meta http-equiv="content-language" content="en">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
 
<!-- Website Title --> 
<title><?php if(NUM_ROWS($result) > 0){echo substr($rows['event_title'],0,65)."(EVID:".$rows['event_id'].")";}else{echo 'Sorry! The training you requested no longer exists or the has been removed!'; }?></title>

<!-- Meta data for SEO -->
<meta name="description" content="<?php echo substr(strip_tags($rows['description']),0,130)."(EVID:".$rows['event_id'].")";?>"/>
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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="Alexa" /></noscript>
<!-- End Alexa Certify Javascript -->
</head>
<body>

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
<?php include("script/header_file.php"); ?>
		
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                <h1 class="title">Event Detail</h1> 
				<?php 		
					if(NUM_ROWS($result) > 0){
						?>
                <table width="100%" id="listTable">
                   
  <tr>
    <td colspan="5"><p><?php echo $rows['event_title'];?></p>
    </td>
    </tr>
  <tr>
    <td width="11%"><span style="color:#090; font-size:11px"><strong>Provider:</strong></span></td>
    <td colspan="4"><span style="color:#666; font-size:11px"><?php echo $rows['organiser'];?></span></td>
    </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Duration:</strong></span></td>
    <td colspan="4"><span style="color:#090; font-size:11px"><a href="#"><?php echo dateDiff($rows['startDate'], $rows['endDate']);?></a></span></td>
    </tr>
  <tr>
    <td valign="top"><span style="color:#090; font-size:11px"><strong>Category:</strong></span></td>
    <td colspan="4" valign="top" style="color:#666;"><?php echo $rows_cat['category_name'];?></td>
    </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Venue:</strong></span></td>
    <td colspan="4" style="color:#666;"><?php echo $rows['venue'];?></td>
    </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Date:</strong></span></td>
    <td colspan="4"><span style="color:#666;"><?php echo $rows['startDate'];?> <strong>to</strong> <?php echo $rows['endDate'];?></span></td>
    </tr>
  <tr>
    <td><strong><span style="font-size: 11px; color: #090">Attendance  Fee:</span></strong></td>
    <td colspan="4"><span style="color:#666;"><?php echo $rows['cost'];?></span></td>
    </tr>
  <tr>
    <td colspan="5"><span style="color:#090; font-size:11px"><strong>Event Description:</strong></span></td>
    </tr>
  <tr bgcolor="#F7F7F7">
      <td colspan="5" style="color:#666;"><div style="background-color:#FFF; line-height:20px" class="description"><?php echo $rows['description'];?></div></td>
  </tr>
  <tr>
    <td colspan="2" style="color:#666;"> <span class='st_sharethis' displayText='ShareThis'></span><span class='st_fblike_vcount' displayText='Facebook Like'></span>
      <span class='st_plusone_vcount' displayText='Google +1'></span>
      <span class='st_fbrec_vcount' displayText='Facebook Recommend'></span>
      <?php if(($rows['premium'] > 0) && ($rows['premium'] !=8) ){ if($rows['website'] != ''){?><?php if($rows['website'] != ''){?>
      <a href="<?php echo $url;?>" target="_blank" rel="nofollow"><img src="images/visit.png" alt="visit" /></a>      <?php }}}?></td>
    <td width="48%" style="color:#666;"><a href="javascript:void();" onclick="ContactBiz(<?php echo $rows['event_id'];?>,'<?php echo $rows['email'];?>')" ><img src="images/visit_bus.png" alt="visit" /></a></td>
    <td width="18%" style="color:#666;">&nbsp;</td>
    <td width="18%" style="color:#666;">&nbsp;</td>
    </tr>
                  </table>
                  <script>
				  function ContactBiz(id,email){
					  window.location="contact_business?evID="+id+"&email="+email;
				  }
				  </script>
                  <?php
					}
					else{
						?>
                         <h4 style="font-size:20px; color:#F30;">Sorry! The training you requested no longer exists or has been removed!</h4>
                        <?php
					}
					?>
                  <div class="search">
                <h2 class="title">Search Events</h2>
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