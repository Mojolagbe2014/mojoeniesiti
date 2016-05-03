<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($video);
	while (list ($key, $val) = each ($video)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Add Video";
require_once("scripts/insertions.php");	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Nigerian Seminars and Trainings - Add Videos</title>
<meta name="description" content="Add / Upload your training or tutorial video to our video collection for general viewing and downloads."/>

<meta name="dcterms.description" content="Add / Upload your training or tutorial video to our video collection for general viewing and downloads." />

<meta property="og:title" content="Nigerian Seminars and Trainings - Add Videos" />

<meta property="og:description" content="Add / Upload your training or tutorial video to our video collection for general viewing and downloads." />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Add Videos" />

<meta property="twitter:description" content="Add / Upload your training or tutorial video to our video collection for general viewing and downloads." />
	
	<!--<link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->
    
	<?php include("scripts/headers_new.php");?>
    
 

 <script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactform2").validate({
			rules:{
				video_title: {
				required:true,
				minlength: 2
				},
				video_id: {
				required:true,
				},
				email:{
					required: true,
					email:true
				},
				description:{
					required: true,
					minlength: 2
				},
				posted_by:{
					required: true,
					minlength: 2
				},
				website:{
					url:true
				},
				verify:{
					required: true,
				},
			}
						
		});
	});

	</script>
    <script type="text/javascript">
function _close(){
$("#video_youtube").css("background-color","#E4E4E4"); 
$("#video_youtube").fadeOut("slow");
}
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


<?php include("tools/header_new.php");?>

<div id="main">
	
	<div id="content">
    
    <?php include("tools/categories_new.php");?>
       
		<div id="content_left">
        
        <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Upload Training Videos</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	
				<div id="subpage">
					
					<div id="subpage_content">
						 
						<div id="contact-wrapper" class="rounded"> 
                        <div id="video_youtube" class="rounded">
                        <span class="close"><a href="javascript: _close()"><img src="images/close_icon.gif" width="12" height="13" style="float:right" title="close" /></a></span>
                          <p>Let your targetted audience watch your videos live here by simply uploading your training video here.
                          Please click on the button below to get started.                        </p>
                        </div> 
                        <?php echo $message;?>
						  <div id="contact-wrapper-inner" class="rounded">
                            <p>
                              <script type="text/javascript" src="https://nigerianseminarsandtrainings.appspot.com/js/ytd-embed.js"></script>
                              <script type="text/javascript">
var ytdInitFunction = function() {
  var ytd = new Ytd();
  ytd.setAssignmentId("1001");
  ytd.setCallToAction("callToActionId-1001");
  var containerWidth = 700;
  var containerHeight = 600;
  ytd.setYtdContainer("ytdContainer-1001", containerWidth, containerHeight);
  ytd.ready();
};
if (window.addEventListener) {
  window.addEventListener("load", ytdInitFunction, false);
} else if (window.attachEvent) {
  window.attachEvent("onload", ytdInitFunction);
}
                            </script>
                              
                            <a id="callToActionId-1001" href="javascript:void(0);"><img src="images/upload.png" width="200" height="30" /></a></p>
                           
                            <div id="ytdContainer-1001"></div>
						  </div>
						 </div>
						 
						 <div id="contact-info">
						 
						 </div>
					</div>
                    </div> 
                    <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	
     </div>
				</div><!-- end subpage -->
                
			<?php include("tools/side-menu_new.php");?>
            <div class="clearfix"></div>
		</div>
		
		
	</div>


<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>