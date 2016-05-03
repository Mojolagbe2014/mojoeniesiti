<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$id = "";
if(isset($_GET['detail'])) {$id = $_GET['detail'];}
else{
header("HTTP/1.1 301 Moved Permanently");
	
header("location: all_vacancies");
}
if(connection()){
	$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
	
	$result = MysqlSelectQuery("select * from vacancies where job_id = '$id' limit $offset, $recordperpage");
	$rows = SqlArrays($result);
}
$advert = "Vacancy Detail";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo substr($rows['title'],0,65)."-".$rows['job_id'];?> - Nigerian Seminars and Trainings</title>



<meta name="description" content="<?php echo substr(strip_tags($rows['description']),0,130)."-".$rows['job_id'];?>"/>


<meta name="dcterms.description" content="<?php echo substr(strip_tags($rows['description']),0,130)."-".$rows['job_id'];?>" />

<meta property="og:title" content="<?php echo substr($rows['title'],0,65)."-".$rows['job_id'];?>" />

<meta property="og:description" content="<?php echo substr(strip_tags($rows['description']),0,130)."-".$rows['job_id'];?>" />

<meta property="twitter:title" content="<?php echo substr($rows['title'],0,65)."-".$rows['job_id'];?>" />

<meta property="twitter:description" content="<?php echo substr(strip_tags($rows['description']),0,130)."-".$rows['job_id'];?>" />

	<?php include("scripts/headers_new.php");?>
	
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
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><?php echo stripslashes($rows['title']);?></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	
				<div id="sub_links">
                <h3 class="categoryHeader">Full job detail</h3>
                <div id="contact-wrapper" class="rounded"> 
				<div class="video_box">
					<table width="100%" id="listTable">
                    <?php 
					
					switch($rows['type']){
							case 1:
							$type = "Fulltime";
							break;
							case 2:
							$type = "Partime";
							break;
							case 3:
							$type = "Contract";
							break;
						}
						//if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
						?>
  
  <tr>
    <td width="17%"><span style="color:#090; font-size:11px"><strong>Company:</strong></span></td>
    <td colspan="3"><span style="color:#090; font-size:11px"><a href="#" style="color:#666;"><?php echo $rows['company_name'];?></a></span></td>
    </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Work Experience:</strong></span></td>
    <td width="27%"><span style="color:#090; font-size:11px"><a href="#"><?php echo $rows['experience']." Year(s)";?></a></span></td>
    <td width="28%" align="right"><span style="color:#090; font-size:11px"><strong>Posted</strong></span></td>
    <td width="28%" style="color:#666;"><?php echo time_ago($rows['posted_date']);?></td>
  </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Vacancy Type:</strong></span></td>
    <td style="color:#666;"><?php echo $type;?></td>
    <td colspan="2" align="right" style="color:#666;">  
</td>
    </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Location:</strong></span></td>
    <td colspan="3" style="color:#666;"><?php echo $rows['city'].", ".$rows['country'];?></td>
    </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Contact Person:</strong></span></td>
    <td><span style="color:#666;"><?php echo $rows['contact_person'];?></span></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span style="color:#090; font-size:11px"><strong>Email:</strong></span></td>
    <td><span style="color:#666;"><?php echo $rows['email'];?></span></td>
    <td align="right"><span style="color:#090; font-size:11px"><strong>Tel:</strong></span></td>
    <td><span style="color:#666;"><?php echo ($rows['telephone']);?></span></td>
  </tr>
  <tr>
    <td colspan="4"><span style="color:#090; font-size:11px"><strong>Job Description:</strong></span></td>
    </tr>
  <tr bgcolor="#F7F7F7">
    <td colspan="4"><div class="description" style="font-size:13px; text-align:justify;"><?php echo stripslashes($rows['description']);?>
    
    </div></td>
  </tr>
  <tr>
    <td colspan="4">  <div class="fb-like" data-href="http://nigerianseminarsandtrainings.com/vacancy_detail?detail=<?php echo $rows['job_id'];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
    <div class="fb-share-button" data-href="http://nigerianseminarsandtrainings.com/vacancy_detail?detail=<?php echo $rows['job_id'];?>" data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>
 <!-- Place this tag where you want the su badge to render -->
<su:badge layout="1" location="http://nigerianseminarsandtrainings.com/vacancy_detail?detail=<?php echo $rows['job_id'];?>"></su:badge>

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
</div>
		    </div>
                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
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