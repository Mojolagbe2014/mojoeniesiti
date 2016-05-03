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
<title>Nigerian seminars | training | courses | workshops | conferences</title>
<meta name="application-name" content="Nigerian seminars and trainings" />
<meta name="author" content="Kaiste Ventures" />
<meta name="dcterms.audience" content="Global" />
<meta name="robots" content="All" />
<meta name="description" content="Training in Nigeria | seminars in Nigeria | workshops | conferences | management training courses in Nigeria | Africa | Asia | North | South America | Europe" />
<meta name="keywords" content="keyword1,keyword2, O2rgfmM0yFJeSCKH-84b4X52xkk" />
<meta name="keywords" content="Nigerian seminars and trainings,training in nigeria, seminars in nigeria,conferences in nigeria, workshops in nigeria, training providers in nigeria, training equipment suppliers in nigeria, event venues in nigeria, short courses in Nigeria, professional training seminars in nigeria and around the world, management training in nigeria, training and seminars in nigeria, nigeria training courses, nigeria training directory, nigeria training website, Training in Nigeria, seminars in Nigeria, management / professional training courses in Nigeria, Africa, Asia, North/South America, Europe and Oceania" />
<meta name="rating" content="General" />
<meta name="dcterms.title" content="Nigerian seminars | training | courses | workshops | conferences" />
<meta name="dcterms.contributor" content="Kaiste Ventures" />
<meta name="dcterms.creator" content="Kaiste Ventures" />
<meta name="dcterms.publisher" content="Kaiste Ventures" />
<meta name="dcterms.description" content="Training in Nigeria | seminars in Nigeria | workshops | conferences | management training courses in Nigeria | Africa | Asia | North | South America | Europe" />
<meta name="dcterms.rights" content="2010 - 2014" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Nigerian seminars | training | courses | workshops | conferences" />
<meta property="og:description" content="Training in Nigeria | seminars in Nigeria | workshops | conferences | management training courses in Nigeria | Africa | Asia | North | South America | Europe" />
<meta property="twitter:title" content="Nigerian seminars | training | courses | workshops | conferences" />
<meta property="twitter:description" content="Training in Nigeria | seminars in Nigeria | workshops | conferences | management training courses in Nigeria | Africa | Asia | North | South America | Europe" />
<meta property="og:image" content="<?php echo SITE_URL;?>images/facebookIMG.png"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>



<!--<meta name="google-translate-customization" content="7fc6ab6e53f0eb2a-ddc6d9c4ae6b8748-g0089efb7873bd8d5-24">-->
<meta name="viewport" content="width=device-width" />


<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>

	<link rel="stylesheet" href="style.css"  type="text/css" media="screen" />
     <link rel="stylesheet" type="text/css"  href="css/smartforms/css/smart-forms.css"> 
     <link rel="stylesheet" type="text/css"  href="css/smartforms/css/smart-themes/green.css">
    <link rel="stylesheet" type="text/css"  href="css/smartforms/css/font-awesome.min.css">
    <link type="text/css" href="css/menu/css/orion-menu.css" rel="stylesheet" />
    <link href="css/responsive.css" rel="stylesheet" type="text/css">
    <link href="css/dwsee.top.bottom.menu.css" rel="stylesheet" type="text/css" />
    


  
    
<?php //include("scripts/headers.php");?>


<style type="text/css">
.window_currency {
  position:fixed;
  left:0;
  top:0;
  width:auto;
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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" style="border:none;" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<div id="main_content">
<div id="top_element">
 <div id="TopNav">
<div class="topmenu_options">

<ul>
<li class="resShow"><a href="<?php echo SITE_URL;?>login">Login</a></li>
<?php if(!isset($_SESSION['login_subcriber'])){?>
<li class="hide" ><a href="<?php echo SITE_URL;?>subscribers">Subscribe</a></li>
<?php } ?>
<li style="margin-right:0px;"><a href="<?php echo SITE_URL;?>vacancies" style="background-image:none;">Add Vacancy</a></li>
<li><a href="<?php echo SITE_URL;?>add_video">Add Video</a></li>
<?php  if(!isset($_SESSION['login_business'])){?>
<li><a href="<?php echo SITE_URL;?>biz_info">Add Business</a></li>
<?php } ?>
<li><a href="<?php echo SITE_URL;?>add_event">Add Event</a></li>
<?php if(!isset($_SESSION['login_subcriber'])){?>
<li class="hide"><a href="<?php echo SITE_URL;?>subscribers" >Subscribe</a></li>
<?php } ?>
<li class="hide"><a href="<?php echo SITE_URL;?>login" >Login</a></li>
</ul>
<?php if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
?>
<form action="logout" method="post">
 <table width="286" border="0" style="width:150px;">
    <tr>
      <td width="57"><input type="submit" value="Logout" name="submit_login2" style="cursor:pointer;"></td>
      <td><input type="button" value="Back to Profile" name="subject2" class="inputBox_button" onClick="Account()" style="background-color:#F90;"></td>
      </tr>
  </table>
  </form>
<?php
}
else{
?>
<form name="form1" method="post" action="tools/login_no_ajax.php">

<div class="top_login_form">
	<div class="inputBox input_shadow">
		<input name="email" type="text" placeholder="Email" id="email_login" />
	<a href="#" id="forgot">Forgot?</a>
	<div class="clear"></div>
</div>
	<div class="inputBox input_shadow">
	<input name="password" type="password" placeholder="Password" id="password" />
	<a href="#contact-wrapper2" class="modal" id="password_forget">Forgot?</a>
	<div class="clear"></div>
	</div>
    <div class="btn-control">
    <input type="submit" value="Login" name="submit_login" style="cursor:pointer;background-color:#0C6;" class="inputBox_button">
    <input type="button" value="Subscribe" name="subject" class="inputBox_button" onClick="Subscriber()">
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
<br />
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
<div class="menu_container">
 <div style="width:100%; margin-right:auto; margin-left:auto; height:45px; float:left;">
 <ul class="orion-menu green">
		<li><h1 style="font-size:14px;"><a href="<?php echo SITE_URL;?>">Home</a></h1></li>
				<li><a href="<?php echo SITE_URL;?>all_event">All Events</a></li>
				<li><a href="<?php echo SITE_URL;?>articles">Articles</a></li>
                <li><a href="<?php echo SITE_URL;?>advertise">Advertise</a></li>
			<li><a href="<?php echo SITE_URL;?>training_providers">Training Providers</a> </li>  
            <li><a href="<?php echo SITE_URL;?>premium-listing">Premium Listing</a></li>
            <li><a href="<?php echo SITE_URL;?>venues">Find Venues</a></li>
             <li><a href="<?php echo SITE_URL;?>suppliers">Find Suppliers</a></li>
      <li><a href="<?php echo SITE_URL;?>event_managers">Event Managers</a></li>
      <li><a href="<?php echo SITE_URL;?>contact-us">Contact Us</a></li>
				
                  
                
                 
				<li class="search">
					<form method="get" action="<?php echo SITE_URL; ?>content_search">
						<input name="query" type="text" id="query" class="search" placeholder="Enter keywords..." />
				  </form>
		</li>
       
				<li class="social hidele">
					<a href="https://www.facebook.com/nigerianseminars" target="_blank" style="background:none" ><i class="icon-facebook"></i><span class="tooltip">Facebook</span></a>
					<a href="https://twitter.com/NigerianSeminar" target="_blank" style="background:none"><i class="icon-twitter"></i><span class="tooltip">Twitter</span></a>
					<a href="https://www.pinterest.com/nigerianseminar" target="_blank" style="background:none"><i class="icon-pinterest"></i><span class="tooltip">Pinterest</span></a>
					<a href="https://plus.google.com/107382097978433122911" target="_blank" style="background:none"><i class="icon-google-plus"></i><span class="tooltip">Google Plus</span></a>
				</li>
               
</ul>
<div>
 
 

		
<div class="clearfix"></div>

 </div>
 </div>		
<div class="clearfix"></div>

 </div>
<div class="clearfix"></div>

<?php //include("tools/search_box.php");?>
<div class="searchSite smart-forms">

<form action="search" method="get" id="searchform" autocomplete="off">
<h2>Search Events</h2>
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
</div>

</form>
<div class="clearfix"></div>
</div>

<div id="main">
  
<div id="content">

<div class="advertHolder">

<div class="LeftAdd"><?php echo $GetAdverts -> SmallAds("Left Banner","Index");?></div>

<div class="CenterAdd">

<?php echo $GetAdverts -> LandScapeAds("Index PageBanner 1","Index");?>

</div>

<div class="RightAdd"><?php echo $GetAdverts -> SmallAds("Right Banner","Index");?></div>

</div>
   
       <div class="category_content responsiveCategoryMain">
       
       

       <div class="sneak_peak2_category">
      <div class="button_class_category">Event Categories</div>
         </div>
       <ul>
      <?php
	 $cat =  MysqlSelectQuery("select * from categories order by category_name");
	  while($rowsCat = SqlArrays($cat)){
		  $strip = str_replace(" / ","-",$rowsCat['category_name']);

						$final = str_replace(" ","-",$strip);
	  ?>
      <li><a href="<?php echo SITE_URL.'events/categories/'.$rowsCat['category_id'].'/'.$final ;?>"><?php echo $rowsCat['category_name'];?></a></li>
      <?php
	  }
	  ?>
      <li><a href="<?php echo SITE_URL;?>events/countries/38/Nigeria" class="event_location">Events in Nigeria</a></li>
      <li><a href="<?php echo SITE_URL;?>events/countries" class="event_location">Events by Countries</a></li>
       <li><a href="<?php echo SITE_URL;?>training_providers/countries/38/Nigeria" class="event_location">Training Providers in  Nigeria</a></li>
       <li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" class="event_location">Training Providers by Category</a></li>
       <li><a href="<?php echo SITE_URL;?>training_providers/countries" class="event_location">Training Providers by Countries</a></li>
      </ul>

      <?php //include("tools/categories_new.php");?>
      
       <div class="featuredVenue">
         <span><i class="fa fa-star"></i>Featured Venue Providers</span>
       <div class="providers_Image">
       </div>
          <?php echo GetFeaturedVenue();?>
         </div>
         
         <div class="featuredVenue">
         <span><i class="fa fa-star"></i>Featured Equipment Suppliers</span>
        
          <?php echo GetFeaturedSupplier();?>
         </div>
      
       <div class="featuredVenue">
         <span><i class="fa fa-star"></i>Featured Event Managers </span>
        
          <?php //echo GetFeaturedSupplier();?>
         </div>
         
                  <div class="sneak_peak2"><div class="button_class">Search events by tags </div></div>
          <div class="tags" style="float:none;">
       <span style="float:none; height:400px; overflow:scroll;">
			
            <?php 
			$sql = MysqlSelectQuery("select tags from events where tags != '' order by rand() ");
$tags = '';
while($rows = SqlArrays($sql)){
	$tags .= $rows['tags'];
}
echo tags($tags,'all_event_tag_search');
 ?>
 
</span>
           
             
          </div>
         
         <div style="margin-top:10px; margin-bottom:10px; text-align:center;">  
		 <?php //echo $GetAdverts -> SkyScrapper("Index Skyscrapper","Index");?>
         </div>
    
       
         
      
       </div>

	  <div id="content_left">

                    <div class="sub_links">
                    
                    <div class="description roundborder" style="font-size:13px; text-align:justify; margin-top:12px; ">
                   
                      <p style="line-height:20px; color:#060;"><strong style="font-size:16px">Welcome</strong> to Nigerian Seminars and Trainings.com</p>
                      <p>Nigerian seminars and trainings.com is the most comprehensive source of information on conferences, workshops, seminars, training and other learning opportunities in Nigeria today. Our global reach extends to over one hundred and thirty three (133) countries with very strong presence in United States, United Kingdom, India, Indonesia, Netherlands, Liberia, Estonia, Kenya, Gambia and Brazil to mention a few.</p>
                      <p>We provide easy, up-to-date and by-the-click access to information on upcoming conferences, seminars and training to intending trainees / conference attendees in the comfort of their living rooms/offices anywhere in the world. We also provide information (and web links) on training providers, venue providers, training equipment suppliers etc. <a href="about">Read More</a></p>
    
                    </div>
                    
                    <div class="highlights">
                    <strong>Events Highlights</strong></div>
                    
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
                  
                       <div >
                      <a href="<?php echo SITE_URL ?>event_detail?id=<?php echo $rows_pre['event_id'];?>" class="eventListing"> <span class="spanTitle"><?php echo $rows_pre['event_title'];?></span>
                       <div class="innerHeading">
                       <p>Date</p>
                       <span><?php echo date('M d',strtotime($rows_pre['startDate']))." - ".date('d M, Y',strtotime($rows_pre['endDate']));?></span></div>
                       <div class="innerHeading">
                       <p>Duration</p>
                       <span ><?php echo dateDiff($rows_pre['startDate'], $rows_pre['endDate']);?></span></div><div class="innerHeading">
                       <p>Location</p>
                       <span ><?php echo GetEventLocation($rows_pre['event_id']);?></span></div>
                       <?php echo $image;?>
                
                        <div class="trainingProviders">
                       <span class="provider">Provider:</span>
                        <span class="provider_name"><span style="color:#000"><?php echo $rows_pre['organiser'];?></span></span>
                      
                       </div> 
                       <div style="display:block;"><div class="ViewBox"> View more </div></div>
                       <div class="clearfix"></div>
                       </a>
                       
                       
                       </div>
                       <?php
					}
	}
					?>
		    </div>
                    </div>

          

  
                
         <?php echo $GetAdverts -> LandScapeAds("Index PageBanner 2","Index");?>
         
       
        <div>
       
	  
             <div id="mask"></div>
             
         <div id="contact-wrapper2" style="float:left; width:332px;" class="window boxContent"> 
    
    <form id="forgotPassword" name="form1" method="post" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;width:332px;">
                    <strong style="color:#006600;width:100%;" id="fpass"><i class="fa fa-info-circle "></i>&nbsp;&nbsp;Forgot Password?</strong>
                   
                    </div>
                   
                    <div class="alert notification spacer-b30" style="display:none;width:100%;" id="msgComment"></div>
<table class="contact_provider_table" style="width:332px;">

<tr>
 
<td style="color:#009900; font-size:12px; text-align:center;">Please provide your email so we can reset your password.</td>

</tr>
<tr>
 
<td >
   <label class="field">
                                    <input type="text" name="emailForgot" id="emailForgot" class="gui-input" placeholder="Email" required >
                                </label>
</td></tr>




<tr>

  <td>
  <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
                            </label>
                            <label for="securitycode" class="button captcode">
                            	<img src="tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>
  </td>
</tr>
<tr>
  <td>
    <button class="button btn-primary fpassword" type="submit"> Send </button>
   
   <button class="button" id="closeBox"> Close </button></td>
  </tr>
</table> 
<p style="text-align:center; display:none;" id="btn"><button class="button" id="closeBox2"> Close </button></p>
</form>
<div class="clearfix"></div>
</div>
         
         
        </div>
      
      </div>

<?php include("tools/category_new_responsive.php");?>
        
		<div id="sidebar" >
      
        <div style="text-align:center;">
		<?php echo $GetAdverts -> SmallSideAds("Index Small SideAds","Index");?>
        </div>
     
      <!--quarterly guide-->
         <?php
            $result = MysqlSelectQuery("select * from quarterly_guide where year='".date("Y")."' order by guide_id desc limit 0, 4");
		if(NUM_ROWS($result) > 0){
			?>
         <div class="sneak_peak2">
         <div class="button_class">Quarterly Guide</div>
         
         
         
         </div>
          <div>
         <ul>
			<?php
		while($rows = SqlArrays($result)){
			if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
			$link = SITE_URL.'QuarterlyGuide/'.str_replace(" ","_",$rows['name']).'_Conferences_and_Training_Guide.pdf';
			$name = '';
			}
			else{
			$link = '#Login_pop';
			$name = 'class="prompt"';
			}
			echo '<li><a href="'.$link.'" '.$name.' target="_blank" >'.$rows['name'].' Conferences and Training Guide</a></li>';
			}
		?>
       
       
</ul>
             
          </div>
          <?php
	}
		?>
          <!--end quarterly guide-->
     <div class="divider"></div>
          <div class="slideshow">
           <div style="text-align:center">
		<?php echo $GetAdverts -> SideMenus("Index SideBanner 1","Index");?>
        </div>
       
         </div>

      
          <div class="sneak_peak2">
            <div class="button_class">News / Updates</div>
             
             
          </div>
          <div>
         <ul>
			
            <?php Get_News(); ?>
</ul>
             <p><a href="<?php echo SITE_URL;?>archive">Read More</a></p>
             
          </div>
              <div class="divider"></div>
         <div class="slideshow">
         <div style="text-align:center;">
		<?php echo $GetAdverts -> SideMenus("Index SideBanner 2","Index");?></div>
       
         </div>
         
         <div class="sneak_peak2">
    <div class="button_class">Latest Videos</div>
    
    
    </div>
     <div class="slider-wrapper default">
          <div id="slider_video">
          
		        <?php
				$result = MysqlSelectQuery("select * from videos order by id desc limit 0 , 6");
					if(NUM_ROWS($result) > 0){
					$i = 0;
					while($rows = SqlArrays($result)){
						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
					?>
                    <a href="video_watch?id=<?php echo $rows['id'];?>"><img src="http://img.youtube.com/vi/<?php echo $rows['video_id'];?>/0.jpg" class="youTube" alt="nigerian seminars and training youtube "/></a>
                   
                    <?php
					}
				}
					?>
	        </div>
      
         </div>
     <p><a href="<?php echo SITE_URL;?>videos_all">View all videos</a></p>
			<div style="text-align:center;">  <?php //echo $GetAdverts -> SkyScrapper("Index Skyscrapper","Index");?></div>
            
            <div class="divider"></div>
             
            <div style="text-align:center;"><div class="fb-like-box" data-href="https://www.facebook.com/nigerianseminars" data-width="100%" data-height="400" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div></div>
            <div class="divider"></div>
 
<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-annotation="inline" data-width="300"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
          <div class="divider"></div>
  <div class="slideshow" style="text-align:center;">
		<?php echo $GetAdverts -> SideMenus("Index SideBanner 3","Index");?>
       
         </div>
    
  
    <div class="sneak_peak2">
    <div class="button_class">Articles</div>
    
    
    </div>
          <div>
         <ul>
			
            <?php Get_Articles(); ?>
</ul>
             <p><a href="<?php echo SITE_URL;?>articles">Read More</a></p>
             
          </div>
           
			<div>
            </div>
            <div>
          
               
            <div class="divider"></div>
            <div style="text-align:center;">  <?php echo $GetAdverts -> BottomSideMenusIndex("Index SideBanner 4","Index");?>  </div>
             <div class="divider"></div>
             
             <div class="sneak_peak2">
             <div class="button_class">Quote of the Day</div>
             
             
             </div>
             <div class="quoteContainer">
            <div class="TabbedPanelsContent" style="color: #090; font-weight:bold; text-align:center; height:150px" ><div class="fb-like" data-href="<?php echo SITE_URL;?>quoteFull?quoteID=<?php echo $row['quote_id'];?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true" style="width:80%; float:left"></div><br /><br /> "<?php echo $row['quote']; ?>"<br /><span style="font-weight:normal; color: #000"><i><?php  echo $row['authur'];?></i></span>
            
            </div>
            <span style="display:block;padding:0 5px 0 5px; font-weight:bold;"><a href="<?php echo SITE_URL;?>quoteArchive" >...more quotes</a></span>
             </div>
     
  </div>
            
        <div class="searchTable">
  <div style="text-align:center;">
  </div>
  <div class="divider"></div><br />
    <div style="text-align:center;"><a href="<?php echo SITE_URL;?>weather"><img src="images/weather_logo_large.gif" width="300" height="90" alt="nigerianseminarand training" /></a></div>        <br /><br />
    
    
    
   <div style="text-align:center;"> <div class="fb-recommendations" data-app-id="Recommendations on Nigerian Seminars and Trainings.com" data-site="nigerianseminarsandtrainings.com" data-action="likes, recommends" data-width="300" data-colorscheme="light" data-header="true"></div></div>  
</div>   

 
         
            
      </div>
    <div class="clearfix"></div>         
    </div>
    <div class="clearfix"></div>
</div> 
<div class="clearfix"></div>
 </div>



<div class="social_plugin">
<div class="socialInner title">
 <p>Socialize with us :</p>
</div>

<div class="socialInner twitter">
   <a href="https://twitter.com/nigerianseminar" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @twitterapi</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <!-- Place this tag where you want the su badge to render -->
</div>

<div class="socialInner google">
  <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/107382097978433122911" data-rel="publisher"></div>

<!-- Place this tag after the last widget tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
</div>

<div class="socialInner facebook">
 <div class="fb-like" data-href="http://www.nigerianseminarsandtrainings.com" data-layout="standard" data-action="like" data-show-faces="false" data-share="true" ></div>
</div>
<div class="socialInner" style="margin-left:10px;">
 <p id="google_translate_element" style="float:left;padding:0px;"><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-23693392-1'}, 'google_translate_element');
}
</script>
</p>
<p style="margin:0px; padding:0px;"><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</p>
</div>
</div>
<!--prompt for download-->
  <div id="Login_pop" style="float:left;" class="window_currency boxContent smart-forms">
      <div class="alert notification alert-error">You must be logged in to download this quarterly guide, <a href="login" >Click here</a> to login. <br /> Dont have an account? <a href="biz_info">Click here</a>to register as a business or <a href="subscribers">Click here</a> to register as a subscriber</div>
      <br />
      </div>
     <!-- end prompt-->
   
   <div class="TopBottomMenu">
	<ul>
		<li><a href="./">Home Page</a></li>
		<li><a href="<?php echo SITE_URL;?>advertise">Advertise</a></li>
		<li><a href="<?php echo SITE_URL;?>premium-listing">Premium Listing</a></li>
		<li><a href="<?php echo SITE_URL;?>subscribers">Subscribe</a></li>
		<li><a href="<?php echo SITE_URL;?>articles">Articles</a></li>
		<li><a href="<?php echo SITE_URL;?>about">About Us</a></li>
		<li><a href="<?php echo SITE_URL;?>contact-us">Contact Us</a></li>
	</ul>
</div>

   
<div id="footer_content">
<div id="footer">
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

 
<div class="socialize">
     
    <h2 >Quick Links</h2>
    <ul class="bulleting">
					<li><a href="<?php echo SITE_URL;?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL;?>about">About Us</a></li>
                  <li><a href="<?php echo SITE_URL;?>advertise">Advertise</a></li>
            <li><a href="<?php echo SITE_URL;?>sitemap_page">Sitemap</a></li>       
                   
 
  </ul>
   <div class="clearfix"></div>     
       
    </div>
    <div class="socialize" >
    <h2>Quick Links</h2>
    
 	<ul class="bulleting">
          
				<li><a href="<?php echo SITE_URL;?>venues">Venue Providers</a></li>
				<li><a href="<?php echo SITE_URL;?>event_managers">Event Managers</a></li>
				<li><a href="<?php echo SITE_URL;?>suppliers">Equipment Suppliers</a></li>
			 <li><a  href="<?php echo SITE_URL;?>all_vacancies">Find Jobs</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Watch Training Video</a></li>
				
               
      </ul>  
    <div class="clearfix"></div>
    </div>
       <div class="socialize">
        <h2>Subscriptions</h2>
       <ul class="bulleting">
       <li><a  href="<?php echo SITE_URL;?>rss">RSS Feed</a></li>
       <li><a  href="<?php echo SITE_URL;?>premium-listing">Premium Listing</a></li>
       <li><a  href="<?php echo SITE_URL;?>subscribers">Updates / Newsletter</a></li>
       
       </ul>
       <div class="clearfix"></div>    
 </div>
  <div class="socialize">
        <h2>Uploads</h2>
       <ul class="bulleting">
       <li><a  href="<?php echo SITE_URL;?>all_vacancies">Add Event</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Add Business</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Upload Vacancy</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Upload Videos</a></li>

       </ul>   
       <div class="clearfix"></div> 
 </div>
<!-- <div class="socialize socialLast">
       
       <div class="clearfix"></div> 
 </div>-->
   
		<div class="copyright">
        
         
        
			<p>Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>terms_of_use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>privacy_policy">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
            
            </p>
            <a href="#" onClick="window.open('https://www.sitelock.com/verify.php?site=nigerianseminarsandtrainings.com','SiteLock','width=600,height=600,left=160,top=170');" ><img alt="website security" title="SiteLock" src="//shield.sitelock.com/shield/nigerianseminarsandtrainings.com"/></a> 

            <span class="goDaddy" style="margin-top:20px;">
            <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>
            <span class="goDaddy" style="margin-top:20px;">
            <a href="http://validator.w3.org/check?uri=http%3A%2F%2Fwww.nigerianseminarsandtrainings.com%2F" target="_blank"><img src="images/w3c-html.png" alt="nigerian seminars W3C badge" /></a>
            </span>  
            
            
</div>
<!-- END Attracta -->
  </div>
     
		<div class="footer_nav"> </div>
       

</div>

 <script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="css/smartforms/js/jquery-ui-monthpicker.min.js"></script>
    <script type="text/javascript" src="css/menu/js/orion-menu.js"></script>
    <script src="js/dwsee.top.bottom.menu.min.js" type="text/javascript"></script>
   <!-- Latest Video Controler -->
      <script src="js/mostslider.js" type="text/javascript"></script>
        <script>
        	$(document).ready(function(){
	        	var slider = $("#slider_video").mostSlider();
        	});
        </script>
        
        <script type="text/javascript">

	$(document).ready(function() {

	$(this).dwseeTopBottomMenu({
		topicon : 'images/direction_up.png',
		menuicon : 'images/manage.png',
		bottomicon : 'images/direction_down.png'
		})

	})
		</script>
    
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

	 
// over lay pop up controler
$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('.modal').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
		
		$('#btn').hide();
		$('#fpass').html('<i class="fa fa-info-circle "></i>&nbsp;&nbsp;Forgot Password?');
		$('.contact_provider_table').show();
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
	$('.window #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgComment').hide();
		//$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});
	
	//if close button is clicked
	$('.window #closeBox2').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//$('#msgbox').fadeOut('slow');
		
		$('#msgComment').hide();
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
		
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		//$('#msgbox').fadeOut('slow');
		$('.window').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
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
	function GetAds(AdID){
		$.post("<?php echo SITE_URL;?>tools/hit.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
				
			
			
		});
	}
	//gets the impression on the ads
	function GetImp(AdID){
		$.post("<?php echo SITE_URL;?>tools/impression.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
	//gets the clicks to the websites
	function GetWebClicks(AdID){
		$.post("<?php echo SITE_URL;?>tools/WebClicks.php", {id:"Business-"+AdID}, function(data) {
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
    
    </script>
 
<?php //include ("tools/footerIndex_new.php");?>

</body>


</html>
