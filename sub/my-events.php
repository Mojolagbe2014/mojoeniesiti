<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';

if(!isset($_SESSION['login_subcriber']) && ($_SESSION['login_subcriber'] != true)){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}
	
$result = MysqlSelectQuery("select * from events a, my_events b WHERE b.subscriber_id = '".$_SESSION['user_id']."' and a.event_id = b.event_id ");

$advert = "Training Providers";

	
?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>My Events | Nigerian Seminars and Trainings</title>
<meta name="description" content="" />
<meta property="og:image" content=""/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>

	<link rel="stylesheet" href="<?php echo SITE_URL;?>css/cmxform.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
    
   <?php include("../scripts/headers_new.php");?>
 <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-1.4.2.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.prettyphoto.js"></script> 


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

	
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


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

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<?php include("../tools/header_new.php");?>
<div id="main">
	
	<div id="content">
	<?php include("menu.php");?>
	  <div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-calendar"></i>&nbsp; My Events</h2></td>
    <td width="21%" style="padding-left:8px">&nbsp;</td>
    </tr>
  
</table>
</form>
</div>
				<div id="subpage">
               
					
					<div id="subpage_content">
						<?php echo $message;?>
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">

                <?php

				if(NUM_ROWS($result) > 0){

							?>

					<table width="100%" id="listTable">

                    <?php 

					$i = 1;

					while($rows = SqlArrays($result)){
						?>

  <tr>

    <td width="5%"><img src="<?php echo SITE_URL;?>images/star.png" width="22" height="23" /></td>

    <td width="75%"><p><a href="<?php echo SITE_URL."events/".$rows['event_id']."/".str_replace($title_link,"-",substr($rows['event_title'],0,150));?>" target="_blank"><?php echo $rows['event_title'];?></a></p>


      <p ><strong style="color:#090; font-size:11px">Duration: </strong><?php echo dateDiff($rows['startDate'], $rows['endDate']);?></p>
      
      </td>

    <td width="20%"><img src="../images/icon_clock.png" width="10" height="10" /> <?php echo date('F j, Y', strtotime($rows['startDate']));?><br /></td>

  </tr>

  <?php

  $i++;

					}

					?>

  

   </table>

   <?php

   if(connection()){

                   // Paging("SELECT COUNT(event_id) AS numrows FROM events where user_id='".$_SESSION['user_id']."'",$recordperpage,$pagenum,"posted_events?events");

   }

				}

   else{

   echo '<div class="alert notification alert-error">You have not posted any event(s) yet!</div>';

   }

					 ?>

</div>

		    </div>
						</div>
						
					</div>
				</div>
                    
                    
		  </div>
		</div><!-- end subpage -->
					<?php include("../tools/side-menu_new.php");?>
		</div>
		<div class="clearfix"></div>
		
	</div>

	<div class="clearfix"></div>
</div>
	
	
	
</div>

</div>
<?php include ("../tools/footers_new.php");?>
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