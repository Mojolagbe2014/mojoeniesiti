<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
$result = MysqlSelectQuery("select * from videos order by id desc limit $offset , $recordperpage");
$advert = "All Videos";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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

	<title>Watch training videos - Nigerian Seminars and Trainings</title>
<meta name="description" content="Watch seminars and training videos, tutorials, documentaries and other educational events videos live on Nigerian Seminars and Trainings"/>

    
	<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
    <link rel="stylesheet" href="<?php echo SITE_URL;?>css/cmxform.css" type="text/css" media="screen" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
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
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Watch Training Videos</h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	
				<div id="subpage">
                
					
				   <div id="contact-wrapper-inner" class="rounded" style="margin-top:8px;">
                  <?php
					if(NUM_ROWS($result) > 0){
					$i = 0;
					while($rows = SqlArrays($result)){
						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
					?>
                   <table width="100%" border="0" id="listTable_home">
  <tr>
    <td width="20%" rowspan="2"><p><a href="video-watch?id=<?php echo $rows['id'];?>"><img src="http://img.youtube.com/vi/<?php echo $rows['video_id'];?>/2.jpg" class="youTube" alt="nigerian seminars and training youtube "/></a></p>      
</td>
    <td colspan="2" valign="top"><p style="color:#090; font-size:11px"><a href="video-watch?id=<?php echo $rows['id'];?>"><?php echo $rows['video_title'];?></a></p></td>
    </tr>
  <tr>
    <td colspan="2" valign="top"><?php echo substr($rows['description'],0,150);?></td>
    </tr>
  

                     <tr bgcolor="">
    <td align="right">Posted:</td>
    <td width="61%"><img src="images/icon_clock.png" width="10" height="10" alt="CLOCK"  /> <?php echo time_ago($rows['posted_date']);?></td>
    <td width="19%">&nbsp;</td>
  </tr>
                    </table>
					<?php
$i++;
						}
						Paging("SELECT COUNT(id) AS numrows FROM videos ",$recordperpage,$pagenum,"videos_all?get");
					}
					else {
						echo errorMsg("No Training videos Found");
					}
					?>
			  </div>
						 
					

                </div>
                <!-- end subpage -->
					<?php //include("tools/categories.php");?>
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>
<?php include ("tools/footer_new.php");?>
</div>
</body>
</html>