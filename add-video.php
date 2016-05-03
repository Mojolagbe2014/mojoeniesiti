<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
reset ($video);
	while (list ($key, $val) = each ($video)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
	define('SITE_URL_VID',"https://www.nigerianseminarsandtrainings.com/");
$advert = "Add Video";	
$pageTitle = " Add Videos - Nigerian Seminars and Trainings ";
$pageDesc = trimStringToFullWord(150, stripslashes(strip_tags("Add / Upload your training or tutorial video to our video collection for general viewing and downloads.")));
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $pageTitle; ?></title>
<meta name="description" content="<?php echo $pageDesc; ?>"/>
<meta name="dcterms.description" content="<?php echo $pageDesc; ?>" />
<meta property="og:title" content="<?php echo $pageTitle; ?>" />
<meta property="og:description" content="<?php echo $pageDesc; ?>" />
<meta property="twitter:title" content="<?php echo $pageTitle; ?>" />
<meta property="twitter:description" content="<?php echo $pageDesc; ?>" />
<?php if(($_SERVER['SCRIPT_NAME'] == "/fullArticle.php") || ($_SERVER['SCRIPT_NAME']=="/quoteFull.php") || ($_SERVER['SCRIPT_NAME']=="/business_info.php")|| ($_SERVER['SCRIPT_NAME']=="/news.php")){ } else{ ?>
<meta property="og:image" content="<?php echo SITE_URL_VID;?>images/facebookIMG.png"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>
<meta property="og:type" content="website" /> <?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="application-name" content="nigerianseminarsandtrainings.com" />
<meta name="author" content="Kaiste Ventures" />
<meta name="robots" content="All" />
<meta name="robots" content="index, follow" />
<meta name="rating" content="General" />
<meta name="dcterms.contributor" content="Kaiste Ventures" />
<meta name="dcterms.creator" content="Kaiste Ventures" />
<meta name="dcterms.publisher" content="Nigerian Seminars and Trainings" />
<meta name="dcterms.rights" content="2010 - 2014" />
<meta name="language" content="English">
<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-ng"/>
<link rel="stylesheet" type="text/css"  href="<?php echo SITE_URL_VID;?>stylePrint.css" media="print" />
<link rel="publisher" href="https://plus.google.com/+Nigerianseminarsandtrainings" />
<link rel="stylesheet" type="text/css"  href="<?php echo SITE_URL_VID;?>css/all-css.css" />
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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="Alexa site audit image" /></noscript>
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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif"  height="1" width="1" alt="Quantcast site statistics"/>
</div>
</noscript>
<!-- End Quantcast tag -->
<?php
//open the site directoty
if ($handle = opendir('.')) {
$scriptArr = array();
while (false !== ($entry = readdir($handle))) {

if ($entry != "." && $entry != "..") {

$path_parts = pathinfo($entry);

$ext = @$path_parts['extension'];

if($ext == 'php')
$scriptArr [] = $entry;
}
}

closedir($handle);
}

function active($script){
global $scriptArr;
$status = '';
if(str_replace('/','',$_SERVER['SCRIPT_NAME']) == $script.".php"){
if(in_array($script.".php",$scriptArr))
$status = 'class="active"';
}
return $status;
}

?>
<script type="text/javascript">
// JavaScript Document

function makeArray() {
for (i = 0; i<makeArray.arguments.length; i++)
this[i + 1] = makeArray.arguments[i];
}

function renderTime() {
var currentTime = new Date();
var diem = "AM";
var h = currentTime.getHours();
var m = currentTime.getMinutes();
var s = currentTime.getSeconds();
setTimeout('renderTime()',1000);
if (h == 0) {
h = 12;
} else if (h >= 12) { 
h = h - 12;
diem="PM";
}
if (h < 10) {
h = "0" + h;
}
if (m < 10) {
m = "0" + m;
}
if (s < 10) {
s = "0" + s;
}
var months = new makeArray('Jan','Feb','Mar','Apr','May',
'Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var day = currentTime.getDate();
var month = currentTime.getMonth() + 1;
var yy = currentTime.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;
var myClock = document.getElementById('clockDisplay');
myClock.textContent = day + " " + months[month] + ", " + year +" "+ h + ":" + m + ":" + s + " " + diem;
}
//renderTime();

Spry.Widget.TabbedPanels.prototype.getTabGroup = function()
{
if (this.element)
{
var children = this.getElementChildren(this.element);
if (children.length)
return children[1];
}
return null;
};

Spry.Widget.TabbedPanels.prototype.getContentPanelGroup = function()
{
if (this.element)
{
var children = this.getElementChildren(this.element);
if (children.length > 1)
return children[0];
}
return null;
};
</script>
<div id="fb-root"></div>
<script type="text/javascript">
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php
$GetAdverts = new Adverts;?>

<div id="main_content">
<header>
<div id="top_element">
<div id="TopNav">
<div class="topmenu_options">
<div id="scroller">
<p id="tag">Welcome to Nigerian Seminars and Trainings.... Home of conferences, training seminars, workshops, short courses and other learning opportunities in Nigeria and around the world</p>
</div>

<?php if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
?>
<div class="top_login_form">
<form action="<?php echo SITE_URL_VID;?>logout" method="post">
<table style="width:auto; margin-top:-0.8%">
<tr>
<td width=""><input type="submit" style="padding:0px;font-size:10px;background-color:#435a65;color:#FFF; cursor:pointer"  value="Logout" title="Logout" name="submit_login2" style="cursor:pointer"></td>
<td><input type="button" value="Profile" title="Back to Profile" name="subject2" class="inputBox_button" onClick="Account()" style="background-color:#33454E;font-size:10px;padding:0px"></td>
</tr>
</table>
</form>
</div>
<?php
}
else{
?>
<form name="form1" method="post" action="<?php echo SITE_URL_VID;?>login">

<div class="top_login_form">
<div class="btn-control">
<a class="cssButton_roundedLow cssButton_aqua" style="padding:3px; margin:0px; font-size:10px; background-color:#435A65; color:#FFF;" href="<?php echo SITE_URL_VID;?>login">Login</a>
<a class="cssButton_roundedLow cssButton_aqua" style="padding:3px; margin:0px; font-size:10px; background-color:#435A65; color:#FFF;" href="<?php echo SITE_URL_VID;?>subscribers" >Subscribe</a>

<div class="clear"></div>
</div>
</div>
</form>
<?php
}
?>
</div>

<div class="topmenu_options_left" >
<?php
$display = '';
if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])) $display = 'Hello '.$_SESSION['name'];
else $display = '<script type="text/javascript" >renderTime();</script>';
?>
<div class="welcomeNote" id="clockDisplay"><?php echo $display;?></div>

<p id="google_translate_element" style="float:right;padding-top: 5px;">
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-23693392-1'}, 'google_translate_element');
}
var googleTranslateScript = document.createElement('script');
googleTranslateScript.type = 'text/javascript';
googleTranslateScript.async = true;
googleTranslateScript.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild(googleTranslateScript);
</script>
</p>
</div>
<div class="clearfix"></div>    
</div>
<div class="clearfix"></div>
</div>
<div class="top_content">
<div id="slider">
<div class="logoClass" >
<img src="<?php echo SITE_URL_VID;?>images/logo2.png" alt="Nigerian Seminars and Trainings" />
<div class="clearfix"></div>
</div>
<div class="Adbanner">
<?php echo $GetAdverts -> LandScapeAds("Top Banner",$advert);?>
<div class="clearfix"></div>
<!--<div class="triangle-r"></div>-->
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="menu_container">
<div style="width:100%; margin-right:auto; margin-left:auto; height:45px; float:left;">
<nav>
<ul class="orion-menu petrol">
<li><h1 style="font-size:14px"><a href="<?php echo SITE_URL_VID;?>" title="Home Page">Home</a></h1></li>
<li <?php echo active('all-event');?> ><a href="<?php echo SITE_URL_VID;?>all-event" title="All Events">All Events</a></li>
<li <?php echo active('training-providers');?> ><a href="<?php echo SITE_URL_VID;?>training-providers" title="Training Providers">Training Providers</a> </li>
<li <?php echo active('suppliers');?> ><a href="<?php echo SITE_URL_VID;?>suppliers" title="Training equipment suppliers">Equipment Suppliers</a></li>
<li <?php echo active('venue');?> ><a href="<?php echo SITE_URL_VID;?>venues" title="Event venues providers"> Event Venue Providers</a></li>
<li <?php echo active('event-manager');?> ><a href="<?php echo SITE_URL_VID;?>event-managers" title="Event Managers">Event Managers</a></li>
<li <?php echo active('facilitators');?> ><a href="<?php echo SITE_URL_VID;?>facilitators" title="Facilitators">Facilitators</a></li>
<li><a href="http://blog.nigerianseminarsandtrainings.com" target="_blank" rel="nofollow" title="Blog">Blog</a></li>
<li class="search">
<div itemscope itemtype="http://schema.org/WebSite">
<meta itemprop="url" content="https://www.nigerianseminarsandtrainings.com/"/>
<form method="get" action="<?php echo SITE_URL_VID;?>content_search" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">
<meta itemprop="target" content="https://www.nigerianseminarsandtrainings.com/content-search?query={query}"/>
<table style="width:100%">
<tr>
<td><input name="query" type="text" id="query" class="search" placeholder="Google&trade; Custom Search" itemprop="query-input" required /></td>
<td>&nbsp;<button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:6px;font-size:10px;background-color:#435a65;color:#FFF;margin:0">Search</button></td>
</tr>
</table>
</form>
</div>
</li>
</ul>
</nav>
<div>
<div class="clearfix"></div>
</div>
</div>		
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</header>
<?php //include("../tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("../tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Upload Training Videos</h2></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</div>
<div id="subpage">
<div id="subpage_content">
<div id="contact-wrapper" class="rounded"> 
<div id="video_youtube" class="rounded">
<span class="close"><a href="javascript: _close()"><img src="../images/close_icon.gif" width="12" height="13" style="float:right" alt="close image" /></a></span>
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
<a id="callToActionId-1001" href="javascript:void(0);"><img src="../images/upload.png" width="200" height="30" alt="video upload button" /></a></p>
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
<?php include("../tools/side-menu_new.php");?>
<div class="clearfix"></div>
</div>
</div>
<div class="clearfix"></div>
</div>
<?php include ("../tools/footer_new.php");?>
</body>
</html>