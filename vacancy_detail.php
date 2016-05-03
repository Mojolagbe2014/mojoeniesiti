<?php
require_once("scripts/config.php"); require_once("scripts/functions.php"); $id = "";
if(isset($_GET['detail'])) {$id = $_GET['detail'];}
else{ header("HTTP/1.1 301 Moved Permanently"); header("location: all_vacancies"); }
if(connection()){ $recordperpage =  20; $pagenum = 1;
    if(isset($_GET['page'])){ $pagenum = $_GET['page']; } $offset = ($pagenum - 1) * $recordperpage;
    $result = MysqlSelectQuery("select * from vacancies where job_id = '$id' limit $offset, $recordperpage");
    $rows = SqlArrays($result);
}
$advert = "Vacancy Detail";
$title = trimStringToFullWord(60, stripslashes(strip_tags(substr($rows['title'],0,65)." [".$rows['job_id']."] - Nigerian Seminars and Trainings")));
$meta = trimStringToFullWord(150, stripslashes(strip_tags(preg_replace('/\s+/', ' ',$rows['description'])."-".$rows['job_id'])));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta; ?>"/>
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta; ?>" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;"><?php echo stripslashes($rows['title']);?></h1></td>
</tr>
<tr>
<td style="font-size:11px"><h2>&nbsp;<h2></td>
</tr>
</table>
</form>
</div>
<div id="sub_links">
<h3 class="categoryHeader">Full job detail</h3>
<div id="contact-wrapper" class="rounded"> 
<div class="video_box">
<table style="width:100%;" id="listTable">
<?php switch($rows['type']){ case 1: $type = "Fulltime"; break; case 2: $type = "Partime"; break; case 3: $type = "Contract"; break; } ?>
<tr>
<td style="width:17%;"><span style="color:#090; font-size:11px"><strong>Company:</strong></span></td>
<td ><span style="color:#090; font-size:11px"><a href="#" style="color:#666;"><?php echo $rows['company_name'];?></a></span></td>
<td >&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="color:#090; font-size:11px"><strong>Work Experience:</strong></span></td>
<td style="width:27%;"><span style="color:#090; font-size:11px"><a href="#"><?php echo $rows['experience']." Year(s)";?></a></span></td>
<td style="width:28%; text-align:right;"><span style="color:#090; font-size:11px"><strong>Posted</strong></span></td>
<td style="color:#666; width:28%;"><?php echo time_ago($rows['posted_date']);?></td>
</tr>
<tr>
<td><span style="color:#090; font-size:11px"><strong>Vacancy Type:</strong></span></td>
<td style="color:#666;"><?php echo $type;?></td>
<td style="color:#666;">  
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="color:#090; font-size:11px"><strong>Location:</strong></span></td>
<td style="color:#666;"><?php echo $rows['city'].", ".$rows['country'];?></td>
<td >&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="color:#090; font-size:11px"><strong>Contact Person:</strong></span></td>
<td><span style="color:#666;"><?php echo $rows['contact_person'];?></span></td>
<td >&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td><span style="color:#090; font-size:11px"><strong>Email:</strong></span></td>
<td><span style="color:#666;"><?php echo $rows['email'];?></span></td>
<td style="text-align:right;"><span style="color:#090; font-size:11px"><strong>Tel:</strong></span></td>
<td><span style="color:#666;"><?php echo ($rows['telephone']);?></span></td>
</tr>
<tr>
<td colspan="4" ><span style="color:#090; font-size:11px"><strong>Job Description:</strong></span></td>
</tr>
<tr style="background-color:#F7F7F7; width:100%;">
<td colspan="4">
<div class="description" style="font-size:13px; text-align:justify;">
<?php echo stripslashes($rows['description']);?>
</div>
</td>
</tr>
<tr>
	<td>
		<a href="<?php echo SITE_URL?>apply" style="border:1px solid;border-radius:5px;cursor:pointer;display:inline-block;font-family:'PT Sans',Arial,'Trebuchet MS',sans-serif;padding:10px 15px;position:relative;left:500%">Apply Now</a>
	</td>
</tr>
<tr>
<td colspan="4" >  <div class="fb-like" data-href="http://nigerianseminarsandtrainings.com/vacancy_detail?detail=<?php echo $rows['job_id'];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
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
<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" title="twitter share">Tweet</a>
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
<?php include ("tools/footer_new.php");?>

</body>
</html>