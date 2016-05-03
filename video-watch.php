<?php
require_once("scripts/config.php"); require_once("scripts/functions.php");
if(isset($_GET['id']) && $_GET['id']!=""){
    if(connection())
    $result = MysqlSelectQuery("select * from videos where id='".$_GET['id']."'");
    if(NUM_ROWS($result) == 0){ header("HTTP/1.1 301 Moved Permanently"); header("location:".SITE_URL); }
    else{ MysqlQuery("update videos set views=views + 1 where id='".$_GET['id']."'"); $rows = SqlArrays($result); }
}
$advert = "Watch Videos";
$title = trimStringToFullWord(60, stripslashes(strip_tags($rows['video_title']." - Nigerian Seminars and Trainings")));
$meta = trimStringToFullWord(150, stripslashes(strip_tags("Video Id = ".$rows['id'].". Watch conferences, seminars and training videos, documentaries, and other event videos live on Nigerian Seminars and Trainings")));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta; ?>"/>
<meta name="dcterms.description" content="<?php echo $meta; ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta; ?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta; ?>" />
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
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
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;"><?php echo $rows['video_title'];?></h1></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="subpage">
<div id="contact-wrapper-inner" class="rounded" style="margin-top:8px;">
<table style="width:100%;"id="listTable">
<tr>
<td style="width:9%;">Posted:</td>
<td style="width:91%;"><span style="color:#900; margin-bottom:9px"><?php echo time_ago($rows['posted_date']);?></span></td>
</tr>
<tr>
<td>Views:</td>
<td><?php echo $rows['views'];?></td>
</tr>
<tr>
<td ><center><iframe style="margin-top:10px" class="youtube-player" type="text/html" width="640" height="385" src="https://www.youtube.com/embed/<?php echo $rows['video_id'];?>" frameborder="0">
</iframe></center></td>
</tr>
<tr>
<td>Video Description</td>
</tr>
<tr>
<td ><div class="description" style="font-size:13px; text-align:justify;"><?php echo $rows['description'];?></div></td>
</tr>
<tr>
<td ><div class="fb-like" data-href="http://nigerianseminarsandtrainings.com/video_watch?id=<?php echo $rows['id'];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
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
<?php include ("tools/footer_new.php");?>

</body>
</html>