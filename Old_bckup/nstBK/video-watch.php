<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(isset($_GET['id']) && $_GET['id']!=""){
	if(connection())
	$result = MysqlSelectQuery("select * from videos where id='".$_GET['id']."'");
	if(NUM_ROWS($result) == 0){
	header("HTTP/1.1 301 Moved Permanently");
		
		header("location:".SITE_URL);
	}
	else{
	MysqlQuery("update videos set views=views + 1 where id='".$_GET['id']."'");
	$rows = SqlArrays($result);
	}
}
$advert = "Watch Videos";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title><?php echo $rows['video_title'];?> - Nigerian Seminars and Trainings </title>
<meta name="description" content="Watch conferences, seminars and training videos, documentaries, and other event videos live on Nigerian Seminars and Trainings, Video Id = <?php echo $rows['id'];?> "/>


	<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   
	<?php include("scripts/headers_new.php");?>
    
    
    <script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "e446ce80-aeac-4f49-8e56-45d77e901435"}); </script>

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
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p><?php echo $rows['video_title'];?></p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	
				<div id="subpage">
					
				  <div id="contact-wrapper-inner" class="rounded" style="margin-top:8px;">
				
                   
                     <table width="100%" id="listTable">
                      
                       <tr>
                         <td width="9%">Posted:</td>
                         <td width="91%"><span style="color:#900; margin-bottom:9px"><?php echo time_ago($rows['posted_date']);?></span></td>
                       </tr>
                       <tr>
                         <td>Views:</td>
                         <td><?php echo $rows['views'];?></td>
                       </tr>
                       <tr>
                         <td colspan="2"><center><iframe style="margin-top:10px" class="youtube-player" type="text/html" width="640" height="385" src="https://www.youtube.com/embed/<?php echo $rows['video_id'];?>" frameborder="0">
</iframe></center></td>
                       </tr>
                       <tr>
                         <td colspan="2">Video Description</td>
                       </tr>
                       <tr>
                         <td colspan="2"><div class="description" style="font-size:13px; text-align:justify;"><?php echo $rows['description'];?></div></td>
                       </tr>
                       <tr>
                         <td colspan="2"><div class="fb-like" data-href="http://nigerianseminarsandtrainings.com/video_watch?id=<?php echo $rows['id'];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
    <div class="fb-share-button" data-href="http://nigerianseminarsandtrainings.com/video_watch?id=<?php echo $rows['id'];?>" data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>
 <!-- Place this tag where you want the su badge to render -->
<su:badge layout="1" location="http://nigerianseminarsandtrainings.com/video_watch?id=<?php echo $rows['id'];?>"></su:badge>

<!-- Place this snippet wherever appropriate -->
<script type="text/javascript">
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>
<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></td>
                       </tr>
                     </table>
                     <p>&nbsp;</p>
				  </div>
						 
					

                </div>
                <!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>

</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>