<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");

$msg = '';
//if(connection());
	$today = date("Y-m-d");
	$month = date("F Y");
	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE startDate like '%$month%' and status = 1 and premium = 0 ORDER BY RAND() limit 0, 10");

$GetAdverts = new Adverts;

$yesterday=date('Y-m-d',strtotime("-1 days"));

$query="select * from dailyquote where status=1 order by quote_id desc ";
$selected = MysqlSelectQuery($query);
$nums = NUM_ROWS($selected);
if($nums>0){
	$row = SqlArrays($selected);
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta http-equiv="content-language" content="en-us" />-->	
<title>Nigerian Seminars and Trainings - Training | Conferences | Courses</title>
<meta name="application-name" content="Nigerian Seminars and Trainings" />
<meta name="author" content="Kaiste Ventures" />
<meta name="dcterms.audience" content="Global" />
<meta name="robots" content="All" />
<meta name="description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />
<meta name="keywords" content="keyword1,keyword2, O2rgfmM0yFJeSCKH-84b4X52xkk" />
<meta name="keywords" content="Nigerian seminars and trainings,training in nigeria, seminars in nigeria,conferences in nigeria, workshops in nigeria, training providers in nigeria, training equipment suppliers in nigeria, event venues in nigeria, short courses in Nigeria, professional training seminars in nigeria and around the world, management training in nigeria, training and seminars in nigeria, nigeria training courses, nigeria training directory, nigeria training website, Training in Nigeria, seminars in Nigeria, management / professional training courses in Nigeria, Africa, Asia, North/South America, Europe and Oceania" />
<meta name="rating" content="General" />
<meta name="dcterms.title" content="Nigerian Seminars and Trainings - Training | Conferences | Courses" />
<meta name="dcterms.contributor" content="Kaiste Ventures" />
<meta name="dcterms.creator" content="Kaiste Ventures" />
<meta name="dcterms.publisher" content="Nigerian Seminars and Trainings" />
<meta name="dcterms.description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />
<meta name="dcterms.rights" content="2010 - 2014" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Nigerian Seminars and Trainings - Training | Conferences | Courses" />
<meta property="og:description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />
<meta property="twitter:title" content="Nigerian Seminars and Trainings - Training | Conferences | Courses" />
<meta property="twitter:description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />

<meta property="og:image" content="<?php echo SITE_URL;?>images/facebookIMG.png"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>
<meta name="wot-verification" content="7af71a13c2938965066e"/> 
<!--<meta name="google-translate-customization" content="7fc6ab6e53f0eb2a-ddc6d9c4ae6b8748-g0089efb7873bd8d5-24">-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="publisher" href="https://plus.google.com/+Nigerianseminarsandtrainings" />
<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-ng"/>
<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-gb"/>
<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-us"/>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL;?>images/favicon.ico" />


	
    <link rel="stylesheet" type="text/css"  href="<?php echo SITE_URL;?>stylePrint.css" media="print" />
   
    <link rel="stylesheet" type="text/css"  href="css/min-all-css.css" />
    <!--<link type="text/css" href="css/menu/css/orion-menu.css" rel="stylesheet" />-->
   <!-- <link  rel="stylesheet" media="screen and (max-width: 1269px)" href="css/responsive.css" />-->
<?php //include("scripts/headers.php");?>

<style type="text/css">
<!--
.eventDetail .trainingProviders span li {
	margin-left: 5px;
	padding-left: 5px;
	list-style-position: inside;
}
.eventDetail .trainingProviders img{
	float:none;
}
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
  
.window {
  position:fixed;
  left:0;
  top:0;
  width:500px; 
  z-index:9999;
  padding:20px;
  display:none;
}
.window_currency {
  position:fixed;
  left:0;
  top:0;
  width:200px;
  z-index:9999;
  padding:20px;
  display:none;
}
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}
.form_content{
	background-color:#FFF;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	display: block;
	float: left;
}
.innerHeadingProp{
	color:#FFC;
	padding-left:100px;
}
.innerHeadingProp p{
	font-size:16px;
	float:left;
	margin-left:10px;
}
.subscribe_notification {
	padding: 10px;
	height: 200px;
	width:500px;
	background-color: #FFF;
	float: left;
	display: none;
	background-image: url(<?php echo SITE_URL;?>images/school.png);
	background-repeat: repeat;
}
.subscribe_notification span {
	
	padding: 5px;
	font-size: 24px;
	text-align: center;
	float: left;
	text-shadow: 1px 1px 1px rgba(150, 150, 150, 1);
}
.subscribe_notification span img {
	vertical-align: middle;
	padding-right: 5px;
	float: left;
}
-->
</style>

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

</script>
  

<?php include('tools/analytics.php');?>


<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6006487826059';
fb_param.value = '0.00';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>

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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="Alexa" /></noscript>
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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" style="border:none;" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<div id="main_content">
<div id="top_element">
 <div id="TopNav">
<div class="topmenu_options">

<?php if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
?>
<form action="<?php echo SITE_URL;?>logout" method="post">
 <table width="286" border="0" style="width:150px;">
    <tr>
      <td width="57"><input type="submit" value="Logout" name="submit_login2" style="cursor:pointer;"></td>
      <td><input type="button" value="Back to Profile" name="subject2" class="inputBox_button" onClick="Account()" style="background-color:#33454E;"></td>
      </tr>
  </table>
  </form>
<?php
}
else{
?>
<form name="form1" method="post" action="<?php echo SITE_URL;?>login">

<div class="top_login_form">
<div class="btn-control">
<a class="cssButton_roundedLow cssButton_aqua" style="padding:3px; margin:0px; font-size:10px; background-color:#435A65; color:#FFF;" href="<?php echo SITE_URL;?>login">Login</a>
 <a class="cssButton_roundedLow cssButton_aqua" style="padding:3px; margin:0px; font-size:10px; background-color:#435A65; color:#FFF;" href="<?php echo SITE_URL;?>subscribers" >Subscribe</a>
    <!--<input type="submit" value="Login" name="submit_login" style="cursor:pointer;" class="inputBox_button">
    <input type="button" value="Subscribe" name="subject" class="inputBox_button" onClick="Subscriber()">-->
    <div class="clear"></div>
    </div>
</div>
</form>
  <?php
}
?>
<ul>
<li class="resShow"><a href="<?php echo SITE_URL;?>login" rel="nofollow" >Login</a></li>
<?php if(!isset($_SESSION['login_subcriber'])){?>
<li class="hide" ><a href="<?php echo SITE_URL;?>subscribers" rel="nofollow" >Subscribe</a></li>
<?php } ?>
<li style="margin-right:0px;"><a href="<?php echo SITE_URL;?>upload-vacancies" style="background-image:none;" >Add Vacancy</a></li>
<li><a href="http://www.nigerianseminarsandtrainings.com/videos/add-video"  >Add Video</a></li>
<?php  if(!isset($_SESSION['login_business'])){?>
<li><a href="<?php echo SITE_URL;?>upload-business-info" >Add Business</a></li>
<?php } ?>
<li><a href="<?php echo SITE_URL;?>add-event" >Add Event</a></li>
<?php if(!isset($_SESSION['login_subcriber'])){?>
<li class="hide"><a href="<?php echo SITE_URL;?>subscribers" rel="nofollow">Subscribe</a></li>
<?php } ?>
<li class="hide"><a href="<?php echo SITE_URL;?>login" rel="nofollow">Login</a></li>
<li><a href="http://blog.nigerianseminarsandtrainings.com" target="_blank" >Blog</a></li>
<li><a href="http://forum.nigerianseminarsandtrainings.com" target="_blank" >Forum</a></li>
</ul>

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
    <img src="images/logo2.png" alt="Nigerian Seminars and Trainings" />
    <div class="clearfix"></div>
    </div>
    <div class="Adbanner">
 
<?php echo $GetAdverts -> LandScapeAds("Index TopBanner 1","Index");?>
		
<div class="clearfix"></div>
<!--<div class="triangle-r"></div>-->
    </div>
		<div class="clearfix"></div>
       
       
  </div>
 

<div class="clearfix"></div>
</div>
<div class="menu_container menu_float">

 <ul class="orion-menu petrol">
		<li ><h1 style="font-size:14px;" class="active"><a href="<?php echo SITE_URL;?>" >Home</a></h1></li>
				<li ><a href="<?php echo SITE_URL;?>all-event" >All Events</a></li>
				<li><a href="<?php echo SITE_URL;?>training-providers" >Training Providers</a> </li>
                <li><a href="<?php echo SITE_URL;?>advertise" rel="nofollow">Advertise</a></li>
            	<li><a href="<?php echo SITE_URL;?>premium-listing" rel="nofollow" >Premium Listing</a></li>
                <li><a href="<?php echo SITE_URL;?>contact-us" rel="nofollow">Contact Us</a></li>
             	<li><a href="#" rel="nofollow"  >More...</a>
            		 <ul>	
            			 <li><a href="<?php echo SITE_URL;?>articles" >Articles</a></li>
              			<li><a href="<?php echo SITE_URL;?>venues" >Find Venues</a></li>
             			<li><a href="<?php echo SITE_URL;?>suppliers" >Find Suppliers</a></li>
      						<li><a href="<?php echo SITE_URL;?>event-managers">Event Managers</a></li>
     		 			
				
             		</ul>
             </li>
				<li class="search">
					<form method="get" action="<?php echo SITE_URL; ?>content_search">
						<input name="query" type="text" id="query" class="search" placeholder="Google&trade; Custom Search" />
				  </form>
		</li>
      
				<li class="social">
                 <div class="hidele">
					<a href="https://www.facebook.com/nigerianseminars" target="_blank" style="background:none;color:#003399;"><i class="fa fa-facebook"></i><span class="tooltip">Facebook</span></a>
					<a href="https://twitter.com/NigerianSeminar" target="_blank" style="background:none;color:#3CF;"  ><i class="fa fa-twitter" ></i><span class="tooltip">Twitter</span></a>
					<a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank" style="background:none;color:#F00;" rel="publisher" ><i class="fa fa-google" ></i><span class="tooltip">Google Plus</span></a>
					<a href="https://www.pinterest.com/nigerianseminar" target="_blank" style="background:none;"  ><i class="fa fa-pinterest" ></i><span class="tooltip">Pinterest</span></a>
                    <a href="https://www.youtube.com/user/nigerianseminars" target="_blank" style="background:none;color:#F00;"  ><i class="fa fa-youtube" ></i><span class="tooltip">Youtube</span></a>
                    </div>
				</li>

</ul>
<div>
 
 

		
<div class="clearfix"></div>


 </div>		
<div class="clearfix"></div>

 </div>
<div class="clearfix"></div>







<div id="main">
  
<div id="content">

<div class="advertHolder">

<div class="LeftAdd"><?php echo $GetAdverts -> SmallAds("Left Banner","Index");?></div>

<div class="CenterAdd">

<?php echo $GetAdverts -> LandScapeAds("Index PageBanner 1","Index");?>

</div>

<div class="RightAdd">

<?php echo $GetAdverts -> SmallAds("Right Banner","Index");?>
 
</div>

</div>


   
       <div class="category_content responsiveCategoryMain">
       
       

       <div class="sneak_peak2_category">
      <div class="button_class_category">Search Events by Category</div>
      <div class="clearfix"></div>
         </div>
       <!-- Categories -->
       <div class="addshadow" style="float:left;">
       <ul >
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/administrative-and-secretarial">Administrative and Secretarial</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/agriculture-and-rural-development">Agriculture and Rural Development.</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/aviation-and-maritime">Aviation and Maritime</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/banking-and-insurance">Banking and Insurance</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/conferences-agm-seminars">Conferences AGM Seminars</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/corporate-governance">Corporate Governance</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/customer-service-and-support">Customer Service and Support</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/e-learning">E-Learning </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/economic-management">Economic Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/education">Education</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/engineering-and-technical-skills">Engineering and Technical Skills</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/entrepreneurship-and-business-development">Entrepreneurship and Business Development</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/executive-education">Executive Education</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/finance-and-accounting">Finance and Accounting</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/general-management">General Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/health-and-hse">Health and HSE</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/human-resource-management">Human Resource Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/information-and-communications-technology">Information and Communications Technology</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/internal-audit-fraud">Internal Audit, Fraud </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/leadership-and-self-development">Leadership and Self Development</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/legal-and-legislative">Legal and Legislative</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/logistics-and-supply-chain-management">Logistics and Supply Chain Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/management-consultancy">Management Consultancy</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/marketing-and-sales-management">Marketing and Sales Mgt</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/media-and-communication">Media and Communication</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/oil-and-gas-energy-and-power">Oil and Gas Energy and Power</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/operations-management">Operations Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/pre-retirement-and-new-beginnings">Pre-Retirement and New Beginnings</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/project-management">Project Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/public-administration">Public Administration</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/real-estate-management">Real Estate Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/research-methodology-and-analytics">Research Methodology and Analytics</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/risk-management">Risk Management </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/security-and-crime-prevention">Security and Crime Prevention</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/strategic-management">Strategic Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/telecommunications">Telecommunications</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/time-and-self-management">Time and Self Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/vocational-education-and-training">Vocational Education and Training</a></h2></li>
            
            <li><a href="<?php echo SITE_URL;?>events/countries/38/Nigeria">Events in Nigeria</a></li>
      <li><a href="<?php echo SITE_URL;?>events/countries" >Events by Countries</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries/38/Nigeria" >Training Providers in  Nigeria</a></li>
         <li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" >Training Providers by Category</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries" >Training Providers by Countries</a></li>
       
       
      </ul>
    </div>
      <!-- Categories -->
    
      
<div id="venuProviders" style="float:left;">
      <!-- Loads Venue Providers Asynchronously -->
    </div>
    
  
            <div class="featuredVenue addshadow" style="float:left;">
         <span class="span_cat span_title" >Useful Web Tools</span>
         <ul>
            <li><a href="#currency" class="currency" style="font-size:13px;" >Currency Converter</a></li>
            <li><a href="favicon-generator" style="font-size:13px;" >Favicon Generator</a></li>
             <li><a href="domain-checker" style="font-size:13px;" >Domain Name Checker</a></li>
            </ul>
    
         	</div>
            
            
            
         </div>
       
         <div style="margin-top:10px; margin-bottom:10px; text-align:center;">  
		 <?php //echo $GetAdverts -> SkyScrapper("Index Skyscrapper Left","Index");?>
         </div> 
      
      

	  	  <div id="content_left">
          
          
<div class="searchSite smart-forms " style="padding-top:0px;">

<div class="advanced" style="display:none;" >

<form action="<?php echo SITE_URL;?>search" method="get" id="searchform" autocomplete="off" style="width:100%; margin-top:0px;">

<div class="search_inputs"> 
<label class="field select">
      <select name="category" id="category">
         <option value="">Choose Category</option>
      <?php 

	$result_category = MysqlSelectQuery("select * from categories order by category_name");?>
      <?php while ($rows_category = SqlArrays($result_category)){?>
      <option value="<?php echo $rows_category['category_id'];?>"><?php echo $rows_category['category_name'];?></option>
      <?php

		}

	?>
      </select>
     <i class="arrow double"></i>
    </label>
</div>
<div class="search_inputs"> 
  <label class="field prepend-icon">
     <input type="text" id="month-picker1" name="month" class="gui-input" placeholder="Select Month">
    <span class="field-icon" ><i class="fa fa-calendar-o"></i></span>  
</label>
</div>
<div class="search_inputs">
<label class="field prepend-icon">
                                    <input type="text" name="provider" id="textInput" class="gui-input" placeholder="Select Training Provider">
          <span  class="field-icon"><i class="fa fa-user"></i></span>  
                                    <span id="output"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
                                </label> 
</div>
<div class="search_inputs">
<label class="field select">
      <select name="country" id="country" onChange="GetState()">
          <?php echo GetContries()?>
      </select>
     <i class="arrow double"></i>
    </label>
</div>

<div class="search_btn">
<button class="button btn-primary" type="submit">Search</button>
</div>
<div class="last_input">
<h4><em>(Leave box blank where not applicable)</em></h4>
<div class="search_inputs">
<label class="field select" id="stateSelect" style="display:none;">
      <select name="state" id="state" >
        <option value="">Select state (Nigeria only)</option>
        <?php echo GetState()?>
        </select>
      <i class="arrow double"></i>
    </label>
</div>
<p><a href="#" style="font-size:11px; text-decoration:none;">Use Basic Search</a></p>
</div>

</form>
</div>


<div class="basic">


  <form action="#" method="post" id="searchform_basic" autocomplete="off" style="width:100%; margin-top:0px;">
<div class="smart-widget sm-right smr-80">
  
                            <label class="field prepend-icon">
                                <input type="text" name="sub2" id="evtsearch" class="gui-input" placeholder="Enter keywords to search for events - conferences, training seminars...">
                                 <span id="output_events"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
                                <span  class="field-icon"><i class="fa fa-search"></i></span> 
                            </label>
                            <button type="submit" class="button btn-primary"> Search </button>
                           
                            <span><a href="#" style="font-size:11px; text-decoration:none;">Advanced search</a></span>
                        </div>
 </form>

<div class="clearfix"></div>
</div>


<div class="clearfix"></div>
</div>
          
          <?php //include("tools/search_box.php");?>

                    <div class="sub_links">
                    
                    <div class="highlights">Highlights of upcoming conferences, training seminars and workshops</div>
                    
                      <div class="video_box" id="loadEvent">
                      <?php 
					$today = date("Y-m-d");
					$month = date("F Y");
	$result_pre = MysqlSelectQuery("SELECT * FROM `events` WHERE SortDate >= '$today' and status = 1 and premium > 0 and premium !=8 ORDER BY  premium desc, RAND() ");
	
	if(NUM_ROWS($result_pre) > 0){
					while($rows_pre = SqlArrays($result_pre)){
						
						$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rows_pre['organiser']."%' and premium > 0");
						$biz_name = SqlArrays($business);
							if($biz_name['logos'] == '') $logo = 'images/star2.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
						
						if ($rows_pre['premium'] == 1){
							$star = '<div class="star2"></div>';
							$image = '<img src="'.SITE_URL.$logo.'" alt="business logo" width="50" height="50"/>';
							$clock_icon = '<div class="calendar_time"></div>';
							$bg_class ='#FFF9EA';
							$listing_diff = '';
							$start_h1 = '<h2>';
							$end_h1 = '</h2>';
						}
						else{
							$star = '<div class="star1"></div>';
							$bg_class ='';
							$clock_icon ='<div class="icon_clock"></div>';
							$listing_diff ='';
							$start_h1 = '';
							$end_h1 = '';
						}
						
						?>
                       <div class="eventListing vevent" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rows_pre['event_id'].'/'.str_replace($title_link,"-",$rows_pre['event_title']);?>')">
                       <div class="eventListingInner">
                      <a href="<?php echo SITE_URL.'events/'.$rows_pre['event_id'].'/'.str_replace($title_link,"-",$rows_pre['event_title']);?>" class="url" style="display:block; padding:3px;" ><h2 style="font-size:16px;"> <span class="spanTitle summary" ><?php echo $rows_pre['event_title'];?></span></h2></a>
                      
                    
                      
                      <div class="innerHeadingPropEvent">
     <p ><?php echo dateDiff($rows_pre['startDate'], $rows_pre['endDate']);?>, 
                       
                
                       <?php echo date('M d',strtotime($rows_pre['startDate']))." - ".date('d M, Y',strtotime($rows_pre['endDate']));?> &nbsp;</p>
                         <span style="display:none;" class="dtstart" content="<?php echo date('Y-m-d h:m:s',strtotime($rows_pre['startDate']));?>"><?php echo date('Y-m-d h:m:s',strtotime($rows_pre['startDate']));?></span>
                 
                        <div class="clearfix"></div>   
                       </div> 
                       <div style="text-align:center;"><?php echo GetEventLocation($rows_pre['event_id']);?></div> 
                       
                       <div class="respond" id="loadImg-<?php echo $rows_pre['event_id'];?>"><p style="display:none;">loadImg-<?php echo $rows_pre['event_id'];?></p></div>
                       
                        
              <p style="text-align:center; font-size:14px; color: #105773; margin:5px 0 5px 0;" ><?php echo $rows_pre['organiser'];?></p>
                      
                        <div class="trainingProviders" style="width:100%;">
                    
                      
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description" ><?php echo substr(stripslashes(strip_tags($rows_pre['description'])),0,150).'...';?> </div>
                       
            
                       </div> 
                     </div>
                        <div class="view_button"> 
                        <a class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:10px; background-color:#435A65; color:#FFF;">View More</a>
                        
                        </div>
                       <div class="clearfix"></div>   
                       </div>
                       <?php
					}
	}
					?>
                    <script type="text/javascript">
					function url_location(data){
						window.location = data
					}
					</script>
                     <div class="description roundborder" style="font-size:13px; text-align:justify; float:left;">
                   
                     <p style="line-height:20px; color:#000000;"><strong>About Nigerian Seminars and Trainings</strong> – <em>Nigeria&rsquo;s one-stop training marketplace.</em></p>
<h2 style="font-size:13px; font-weight:normal;">Nigerian  seminars and trainings provides free, easy, up-to-date and by-the-click access  to information on upcoming training seminars, workshops, management and  professional short courses and conferences to intending trainees / conference  attendees in the comfort of their living rooms/offices anywhere in the world.  We also provide information and access to training providers, venue providers,  training equipment suppliers etc.
<a href="about">Read More</a></h2>
					
    
                    </div>
		    </div>
                    </div>

          

  
               <div class="respond"> 
         <?php echo $GetAdverts -> LandScapeAds("Index PageBanner 2","Index");?>
       </div>  
       
        <div>
       

 <div id="mask"></div>
    <div id="currency" style="float:left;" class="window_currency boxContent">
       <div id="currency-widget"></div>
      </div>


        </div>
        <div class="clearfix"></div>
      
      </div>

<?php include("tools/category_new_responsive.php");?>
        
		<div id="sidebar" style="padding-top:0px;">
        
        <div class="respond">
        <div class="sneak_peak2">
         <div class="button_class">Socialize with us</div>
         </div>
<div class="addshadow">
 
  <ul>
            <li> 
            <a href="https://twitter.com/nigerianseminar" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @twitterapi</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    </li>
            <li style="margin-bottom:5px; margin-top:5px;" class="remove"> 
            <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="margin-bottom:5px;" ></div>
            </li>
            
            
<!-- Place this tag where you want the +1 button to render. -->
<li>
<div class="g-plusone" data-annotation="inline" data-width="300"></div>
<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script> 
</li>
</ul>
	</div>
</div>
<div class="divider"></div>
      
        <div style="text-align:center;">
		<?php echo $GetAdverts -> SmallSideAds("Index Small SideAds","Index");?>
        </div>
     
      <!--quarterly guide-->
         <?php
            $result = MysqlSelectQuery("select * from quarterly_guide where year='".date("Y")."' order by guide_id desc limit 0, 4");
		if(NUM_ROWS($result) > 0){
			?>
              <div class="sneak_peak2">
            <div class="button_class">News / Updates</div>
          </div>
          <div class="addshadow">
         <ul>
			<!--<li><a href=""></a></li>-->
            <?php Get_News(); ?>
            
         </ul>
             <p style="margin-top:10px; margin-bottom:10px; margin-left:5px;"><a href="<?php echo SITE_URL;?>archive">Read More</a></p>
             
          </div>
           <div class="divider"></div>
          <div class="slideshow">
           <div style="text-align:center">
		<?php echo $GetAdverts -> SideMenus("Index SideBanner 1","Index");?>
        </div>
       
         </div>
         

           <div class="divider"></div>
            <div class="sneak_peak2">
    <div class="button_class">Read Articles</div>
    
    
    </div>
          <div class="addshadow">
         <ul>
			
            <?php Get_Articles(); ?>
</ul>
             <p style="margin-top:10px; margin-bottom:10px; margin-left:5px;"><a href="<?php echo SITE_URL;?>articles" >Read More</a></p>
             
          </div>
           
			<div>
            </div>
            <div>
          
           <div class="divider"></div>
          <div class="slideshow">
           <div style="text-align:center">
		<?php echo $GetAdverts -> SideMenus("Index SideBanner 2","Index");?>
        </div>
       
         </div>

          
          <div class="divider"></div>
         <div class="sneak_peak2">
         <div class="button_class">Download Quarterly Guide</div>
         
         
         
         </div>
          <div class="addshadow">
         <ul>
			<?php
		while($rows = SqlArrays($result)){
			
			$link = SITE_URL.'download-guide/'.str_replace($title_link,"-",$rows['name']);
		?>
       <li><a href="<?php echo $link ;?>"><?php echo $rows['name'];?> Conferences and Training Guide</a></li>
       <?php
		}
		?>
       
</ul>
             
          </div>
          <?php
	}
		?>
          <!--end quarterly guide-->

              <div class="divider"></div>
             <div class="respond">
         <div class="slideshow">
         <div style="text-align:center;">
		<?php echo $GetAdverts -> SideMenus("Index SideBanner 3","Index");?>
        </div>
       
         	</div>
         </div>
            
             <div class="sneak_peak2">
             <div class="button_class">Quote of the Day</div>
             
             </div>
             <div class="quoteContainer addshadow" >
              <ul class="bjqs">
              <li>
            <div class="TabbedPanelsContent" style="color: #33454E; text-align:center; height:150px;" >
            <table>
            <tr>
           
            <td> <div class="fb-like" data-href="<?php echo SITE_URL.'quote/full/'.$row['quote_id'].'/'.str_replace($title_link,"-",substr($row['quote'],0,70));?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div></td>
            </tr>
            </table>
             
            <br /> "<?php echo $row['quote']; ?>"<br /><span style="font-weight:normal; color:#039;"><i><?php  echo $row['authur'];?></i></span>
            
            </div>
           </li>
           </ul>
            <span style="display:block;padding:0 5px 0 5px; font-weight:bold; margin-bottom:10px;"><a href="<?php echo SITE_URL;?>quoteArchive" rel="nofollow" >...more quotes </a></span>
             </div>
             
			<div style="text-align:center; margin-top:10px;">  
			<?php //echo $GetAdverts -> SkyScrapper("Index Skyscrapper","Index");?>
            </div>
           <div class="respond"> 
           
          <div class="divider"></div>
            <div style="text-align:center;"><div class="fb-like-box" data-href="https://www.facebook.com/nigerianseminars" data-width="100%" data-height="400" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div></div>
            <div class="divider"></div>

</div>
         
        <!--  <div class="respond">
  <div class="slideshow" style="text-align:center;">
		<?php //echo $GetAdverts -> SideMenus("Index SideBanner 4","Index");?>
       
         </div>
    </div>-->
  
        <div class="searchTable">
  <div style="text-align:center;">
  </div>
<!--  <div class="divider"></div><br />-->
    <div style="text-align:center; background-color:#F8F8F8;">
    <div id="weather"></div>
    <span style="display:block;padding:0 5px 0 5px; font-weight:bold;"><a href="<?php echo SITE_URL;?>weather" rel="nofollow" >Full Forecast</a></span>
    </div>        
    <br /><br />
    
    
    <div class="respond">
   <div style="text-align:center;"> <div class="fb-recommendations" data-app-id="Recommendations on Nigerian Seminars and Trainings.com" data-site="nigerianseminarsandtrainings.com" data-action="likes, recommends" data-width="300" data-colorscheme="light" data-header="true"></div></div>  
   </div>
   
         <div class="sneak_peak2">
            <div class="button_class">Search Events by Tags</div>
          </div>
          <div class="tags" >
          <span style="max-height:900px; overflow:scroll;" id="EvtTags">
         
                        
             </span>
          </div>
   
   <div class="divider"></div>
   
                <div class="respond">  
         <div class="sneak_peak2">
    <div class="button_class">Watch Latest Videos</div>
     </div>
     <div class="slider-wrapper default">
         <!-- Load Videos -->
         <div id="slider_video">
		        <?php
				$result = MysqlSelectQuery("select * from videos order by id desc limit 0 , 6");
					if(NUM_ROWS($result) > 0){
					$i = 0;
					while($rows = SqlArrays($result)){
						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
					?>
                    <a href="video-watch?id=<?php echo $rows['id'];?>">
                    <p class="content from-left" style="position:absolute;top:70%; font-size:16px;"><?php echo $rows['video_title'];?></p>
                    <img src="https://img.youtube.com/vi/<?php echo $rows['video_id'];?>/0.jpg" class="youTube" alt="nigerian seminars and training youtube "/></a>
                   
                    <?php
					}
				}
					?>
	        </div>	 
            <p><a href="<?php echo SITE_URL;?>videos-all" rel="nofollow">View all videos</a></p>
         </div>
    
     </div>
     
  </div>
   
   <br />
   <div style="text-align:center;" class="ad_float">
    <?php //echo $GetAdverts -> SkyScrapper("Index Skyscrapper RightBottom","Index");?>
    </div>
</div>   

 
         
            
      </div>
    <div class="clearfix"></div>         
    </div>
    <div class="clearfix"></div>
</div> 
 <div class="clearfix"></div>
</div> 
 



<!--prompt for download-->
  <div id="Login_pop" style="float:left;" class="window_currency boxContent smart-forms">
      <div class="alert notification alert-error">You must be logged in to download this quarterly guide, <a href="login" rel="nofollow" >Click here</a> to login. <br /> Dont have an account? <a href="biz-info" rel="nofollow">Click here</a>to register as a business or <a href="subscribers" rel="nofollow" >Click here</a> to register as a subscriber</div>
      <br />
      </div>
     <!-- end prompt-->
  
   
<div id="footer_content">
<div id="footer">

<div class="menu_container" style="background-color:#33454E; border:none;">
<div style="width:65%; margin-right:auto; margin-left:auto;">
 	<ul class="orion-menu kerosine" >
		
                    <li><a href="<?php echo SITE_URL;?>about" >About Us</a></li>
                  <li><a href="http://www.nsthotels.com" target="_blank" rel="nofollow" >Find Hotels</a></li>
            <li><a href="<?php echo SITE_URL;?>all-vacancies" >Find Jobs</a></li>       
                   <li><a href="<?php echo SITE_URL;?>rss" rel="nofollow">RSS Feeds</a></li>
                   <li><a href="<?php echo SITE_URL;?>sitemap-page" rel="nofollow" >Sitemap</a></li>
                   <li><a href="<?php echo SITE_URL;?>subscribers" rel="nofollow" >Subscribe</a></li>
                   <li><a href="<?php echo SITE_URL;?>videos-all" >Watch Training Videos</a></li>
                   <li><a href="<?php echo SITE_URL;?>article-submission" >Submit Articles</a></li>
                   <li><a href="<?php echo SITE_URL;?>faq" >FAQ</a></li>
	</ul>
</div>
	
<div class="clearfix"></div>

 </div>

   
        <div class="respond">
   <div class="TopBottomMenu">
	<ul style="font-size:14px;">
		<li><a href="https://www.facebook.com/nigerianseminars" style="color:#003399;" target="_blank"><i class="fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/NigerianSeminar" style="color:#3CF;" target="_blank"><i class="fa fa-twitter" ></i></a></li>
		<li><a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank"><i class="fa fa-google" ></i></a></li>
		<li><a href="https://www.youtube.com/user/nigerianseminars" style="color:#F00;" target="_blank"><i class="fa fa-youtube" ></i></a></li>
        <li><a href="https://www.pinterest.com/nigerianseminar" style="color:#F00;" target="_blank"><i class="fa fa-pinterest" ></i></a></li>
		<li><a href="https://www.stumbleupon.com/stumbler/nigerianseminars"  style="color:#3CF;" target="_blank"><i class="fa fa-stumbleupon" ></i></a></li>
        <li><a href="javascript:void(0);" onClick="OpenContactForm()"><i class="fa fa-phone" ></i>&nbsp;Contact Us</a></li>
	</ul>
</div>
</div>
 
<!-- <div class="socialize socialLast">
       
       <div class="clearfix"></div> 
 </div>-->
   
		<div class="copyright">

			<p>Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>terms-of-use" rel="nofollow" >Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>privacy-policy" rel="nofollow" >Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            
            </p>
           

            <span class="goDaddy" style="margin-top:20px;">
            <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>
            <span class="goDaddy" style="margin-top:20px;">
            <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwww.nigerianseminarsandtrainings.com%2F" target="_blank" rel="nofollow" ><img src="images/w3c-html.png" alt="nigerian seminars W3C badge" /></a>
            </span>  
            <span class="goDaddy" style="margin-top:10px;">
            <a href="#" target="_blank" rel="nofollow" ><img src="images/paypal_accepted.jpg" alt="nigerian seminars W3C badge" /></a>
            </span> 
            
            
</div>
<!-- END Attracta -->
  </div>
  
    <?php include('tools/contact-form.html');?>
    
</div>

<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=css/smartforms/js/jquery-1.9.1.min.js,css/smartforms/js/jquery-ui-1.10.4.custom.min.js,css/smartforms/js/jquery-ui-monthpicker.min.js,css/menu/js/orion-menu.js,js/dwsee.top.bottom.menu.min.js,js/mostslider.js,js/jquery.sticky.js,js/eventImg.js,js/jquery.currency.js,js/jquery.currency.localization.en_US.js,js/jquery.zweatherfeed.min.js,js/contact-form.js"></script>

<script type="text/javascript">
$(document).ready(function () {
	$('#weather').weatherfeed(['1398823'], {
		refresh: 1,
		woeid: true
	});
});
</script>
 
<script type="text/javascript">
$(document).ready(function(){
	$('#currency-widget').currency();
});
</script>
   
     <script>
  $(document).ready(function(){
    $(".menu_float").sticky({topSpacing:0});
  });
</script>
 <script>
/*  $(document).ready(function(){
    $(".ad_float").sticky({topSpacing:0});
  });*/
</script>

     
        <script type="text/javascript">
        	$(document).ready(function(){
	        	var slider = $("#slider_video").mostSlider();
				
				//load featured businesses
				$.post("<?php echo SITE_URL;?>tools/loadVenueProviders.php",function(data) {
				$('#venuProviders').html(data);
				});
        	});
			
			$(document).ready(function(){
	     		$('#EvtTags').html('Loading....');
				//load featured businesses
				$.post("<?php //echo SITE_URL;?>tools/loadTags.php",function(data) {
				$('#EvtTags').html(data);
				});
        	});
        </script>
        
       
        
        <div class="respond">
        <script type="text/javascript">

	$(document).ready(function() {

	$(this).dwseeTopBottomMenu({
		topicon : 'images/direction_up.png',
		menuicon : 'images/manage.png',
		bottomicon : 'images/direction_down.png'
		})

	})
		</script>
    </div>
     <script type="text/javascript"> 
	 //login form keyup controller
     $(document).ready(function(e) {
        $('#email_login').keypress(function(e) {
            var value = $(this).val().length;
			if(value > 0){
				$('#forgot').text('?');
			}else{
				$('#forgot').text('Forgot?');
			}
        });
		
		$('#password').keypress(function(e) {
			  var value = $(this).val().length;
			if(value > 0){
				$('#password_forget').text('?');
			}else{
				$('#password_forget').text('Forgot?');
			}
            
        });
		
		//capcha reloader
		function reloadCaptcha(){
					$("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});
				
				
				
				/****************Submit forgot password form*********************/		
					$('#forgotPassword').submit(function(){
					$('#msgComment').removeClass().removeClass('alert-success alert-error alert-info').addClass('alert-warning').html('Processing...').show();								
		$.post("tools/password_forget.php",{email:$('#emailForgot').val(),security:$('#securitycode').val()} ,function(msg){
			
					if(msg == 'Sent'){
						$('#msgComment').removeClass('alert-success alert-error alert-warning').addClass('alert-info').text("A new password has been to your email")
						$('#emailForgot').val('');
						$('#securitycode').val('')
						$('.contact_provider_table').hide();
						$('#btn').show();
						
					}
					if(msg == 'Security'){
						$('#msgComment').removeClass('alert-success alert-info alert-warning').addClass('alert-error').text("Invalid Verification Code")
						$('#emailForgot').val('');
						$('#securitycode').val('')
						
					}
					else if(msg == 'Not Found'){
					$('#msgComment').removeClass('alert-success alert-warning alert-info').addClass('alert-error').text("Sorry there no account associated with this email!");
					$('#emailForgot').val('');
					$('#securitycode').val('')
					}
					
					});
						
						return false;
					});
    });
     
     </script>
     <script>
	 
	 // over lay pop up controler
$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('.prompt').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
		
		
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window_currency #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		//$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
}); 


function Subscriber(){
	window.location='subscribers';
}
function Account(){
	window.location='login';
}

$(document).ready(function(){
  $(window).resize(function(){
    $("#clock-show").text($(window).width());
  });
});


</script>
    
    <script type="text/javascript">
	//script for the search calender
		$(function() {
		
					$("#month-picker1").monthpicker({
						changeYear: false,
						stepYears: 1,
						prevText: '<i class="fa fa-chevron-left"></i>',
						nextText: '<i class="fa fa-chevron-right"></i>',
						showButtonPanel: true,
						dateFormat: 'MM yy'
					});					
		
		
		});	
		/**************** function to show the state when nigeria is selected in the countries dropdown*************/
		function GetState(){
		if($('#country').val() == 38){
			$('#stateSelect').fadeIn('slow');
		}
		else{
			$('#stateSelect').fadeOut('slow');
		}
	}
	
		/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#textInput').keyup(function(){
			$('#output').fadeIn('slow');
			$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/search.php", {query:$(this).val()}, function(data) {
				
				$('#output').html(data)
			
			
		});
	})
	//disappears the training providers when the text box looses focus
	$('#textInput').blur(function(){
		$('#output').fadeOut();
		
	})
	//displays the training providers when the text box gains focus
		$('#textInput').focus(function(){
			$('#output').fadeIn('slow');
			$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
			if($(this).val() == ""){
			$.post("<?php echo SITE_URL;?>tools/search.php", {queryFocus:$(this).val()}, function(data) {
				
				$('#output').html(data)
			
			
		});
			}
			else{
				$.post("<?php echo SITE_URL;?>tools/search.php", {query:$(this).val()}, function(data) {
				
				$('#output').html(data)
			
			
		});
			}
	})
	
	//funtion to retrieve the value from the training providers drop down
	function GetVal(elem){
				
		$('#textInput').val($('#'+elem).text());
		$('#output').hide();

			}
			
	//this function records the clicks on the adverts
	/*function GetAds(AdID){
		$.post("<?php //echo SITE_URL;?>tools/hit.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
				
			
			
		});
	}*/
	//gets the impression on the ads
	/*function GetImp(AdID){
		$.post("<?php //echo SITE_URL;?>tools/impression.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}*/
	//gets the clicks to the websites
	function GetWebClicks(AdID){
		$.post("<?php echo SITE_URL;?>tools/WebClicks.php", {id:"Business-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
	
	//get current action
	function GetAction(type){
		$.post("<?php echo SITE_URL;?>tools/SetUrl.php?url="+type, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
	
	// orion-menu menu script
	$(document).ready(function(){
				$(".panel a").click(function(e){
					e.preventDefault();
					var style = $(this).attr("class");
					$(".orion-menu").removeAttr("class").addClass("orion-menu").addClass(style);
				});
			});
	
	$(document).ready(function(){  
				$().orion({
					speed: 500
				});
			});
			
			//google script for the google+ 1
			(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
    
	$(document).ready(function(e) {
        $('.basic a').click(function(e) {
            $('.basic').fadeOut('slow',function(){
				 $('.advanced').fadeIn('slow');
			})
			
			 e.preventDefault();
        });
    });
	
	$(document).ready(function(e) {
        $('.advanced a').click(function(e) {
            $('.advanced').fadeOut('slow',function(){
				 $('.basic').fadeIn('slow');
			})
			  e.preventDefault();
        });
    });
	
    </script>

<script type="text/javascript">
$(document).ready(function(e) {
	
	
	/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#evtsearch').keyup(function(){
			$('#output_events').fadeIn('slow');
			$('#output_events').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/searchEvents.php", {query:$(this).val(),type:'Training'}, function(data) {
				
				$('#output_events').html(data)
			
			
		});
	})
	//disappears the training providers when the text box looses focus
	$('#evtsearch').blur(function(){
		$('#output_events').fadeOut();
		
	})

	
});
//funtion to retrieve the value from the training providers drop down
	function GetEvtVal(elem){
		var URL = $('#'+elem).attr('data');
				
		$('#evtsearch').val($('#'+elem).text());
		$('#output_events').hide();
		
		$('#searchform_basic').attr('action',URL)
	

			}
			
		$(document).ready(function(e) {	
			
			$('.currency').click(function(e) {
      		//Cancel the link behavior
		e.preventDefault();
		
		//$('#price_container').show();
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.currency-footer #closeBoxCurr').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
    });
	
});
function Close(){
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
}


			
</script>

</body>


</html>
