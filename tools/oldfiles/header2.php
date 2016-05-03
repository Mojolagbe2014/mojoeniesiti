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
 //include("browser_detect.php");
//if (App_Util::is_old_browser()) : ?>

 
   <!-- <div class="app_old_browser_notice" id="browser">
    <div class="innerBrowser">
      <p><strong>Outdated Browser!</strong> We have detected that you are using an outdated browser which may prevent you from accessing some features on our site. We strongly recommend you upgrade to improve your browsing experience. Please click one of them below. <a href="javascript:void" onclick="closeDetect()" style="float:right; margin-top:20px; margin-right:10px"><strong>Dismiss</strong></a></p>
        <ul style="margin-top:10px">
            <li><a href="http://www.mozilla.org/en-US/firefox/fx/#desktop" target="_blank"><img src="images/firefox.gif" width="30" height="30" alt="firefox" /></a></li>
            <li><a href="https://www.google.com/chrome" target="_blank"><img src="images/chrome.gif" width="30" height="30" alt="chrome" /></a></li>
            <li><a href="http://www.apple.com/safari/" target="_blank"><img src="images/safari.gif" width="30" height="30" alt="safari" /></a></li>
            <li><a href="http://www.opera.com/download/" target="_blank"><img src="images/opera.gif" width="30" height="30" alt="opera" /></a></li>
            <li><a href="http://www.microsoft.com/windows/ie/" target="_blank"><img src="images/msie.gif" width="30" height="30" alt="internet explorer" /></a></li>
        </ul>
        </div>
        <div class="clearfix"> </div>
    </div>-->
<?php //endif; ?>
<script type="text/javascript">
function closeDetect(){
	$('#browser').fadeOut("slow");
}
 </script>
<div id="main_content">
<?php
$GetAdverts = new Adverts;?>
 <div id="top_element">
 <div id="TopNav">

 <!--<div class="welcomeMsg" style="float:left;">
 </div>-->
  <script type="text/javascript" language="javascript">
 
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
 <?php
 $display = '';
 if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])) $display = 'Hello, '.$_SESSION['name'];
 else $display = '<script type="text/javascript" language="javascript">renderTime();</script>';
 ?>
 <div class="welcomeNote" id="clockDisplay"><?php echo $display;?></div>
 <div id="scroller">
<p id="tag">Welcome to Nigerian Seminars and Trainings.com.... Home of conferences, training seminars, workshops, short courses and other learning opportunities in Nigeria and around the world</p>
<div class="clearfix"></div>
</div >

<div class="topmenu_options" >
 <p class="topsubscribe"><a href="<?php echo SITE_URL;?>subscribers" >Subscribe
     </a></p>
<div class="menu_top">
        <ul>
            <?php
                if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
?>
                  <li><a href="<?php echo SITE_URL;?>logout" style="font-size:12px; font-family:Verdana, Geneva, sans-serif; text-decoration:underline; font-weight:bold;color: #060;">Logout</a></li>
                 
                  <?php
				 }
				 
                 else {
?>
                  <li><a href="<?php echo SITE_URL_S;?>login" style="font-size:12px; font-family:Verdana, Geneva, sans-serif; text-decoration:underline; font-weight:bold;color: #060;">Login</a>
                  <!--  <ul>
                  <li><a href="<?php //echo SITE_URL;?>login" >Premium Account</a></li>
                 <li><a href="<?php //echo SITE_URL;?>subscriber_login" >Subscribers</a></li>
                  </ul>-->
                  </li>
                  <?php
				 }
				 
				 ?>
            
            
            
        </ul>
        
       
              
    </div>
   
   </div>
   
         
     
                 
		
 </div>

<div class="clearfix"></div>
 </div>
 
<div id="slider">
	
	<!-- start slideshow -->
	<div id="slideshow">
    
	<div class="logoClass" >
    <div class="clearfix"></div>
    </div>
    <div class="Adbanner">
   
    <su:badge layout="1" location="http://www.nigerianseminarsandtrainings.com"></su:badge>

<!-- Place this snippet wherever appropriate -->
<script type="text/javascript">
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>
   <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/107382097978433122911" data-rel="publisher"></div>

<!-- Place this tag after the last widget tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
 
     <a href="https://twitter.com/nigerianseminar" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @twitterapi</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <!-- Place this tag where you want the su badge to render -->


   <br style="margin-bottom:7px;"/>
  <a href="<?php echo SITE_URL;?>rss" title="RSS"><img src="<?php echo SITE_URL;?>images/social_icons/rss.png" width="20"  height="20" style="float:left; vertical-align:middle; margin-right:3px" alt="rss" /></a>
    <div class="fb-like" data-href="http://www.nigerianseminarsandtrainings.com" data-layout="standard" data-action="like" data-show-faces="false" data-share="true" ></div>
    </div>
    

	
	</div>
		<div class="clearfix"></div>
       <?php 
		
 $bg_color1="";	
 $bg_color2="";	
 $bg_color3="";	
  $bg_color4="";	
 $bg_color5="";	
 $bg_color6="";	
  $bg_color7="";
   $bg_color8="";
    $bg_color9="";
 
 
if($_SERVER['SCRIPT_NAME']=="/nigerianseminars/"){
 $bg_color1='background-color:#EBEBEB; color:#000';
$bg_color2="";
}
else if($_SERVER['SCRIPT_NAME']=="/all_event.php"){
 $bg_color2='background-color:#EBEBEB; color:#000';
 $bg_color1="";
 

}
else if($_SERVER['SCRIPT_NAME']=="/articles.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='background-color:#EBEBEB; color:#000';
 

}

else if($_SERVER['SCRIPT_NAME']=="/advertise.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='background-color:#EBEBEB; color:#000';
 

}
else if($_SERVER['SCRIPT_NAME']=="/training_providers.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='';
  $bg_color5='background-color:#EBEBEB; color:#000';
 
 

}

else if($_SERVER['SCRIPT_NAME']=="/subscribers.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='';
 $bg_color5='';
 $bg_color6='background-color:#EBEBEB; color:#000';
 
 

}
else if($_SERVER['SCRIPT_NAME']=="/premium-listing.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='';
 $bg_color5='';
 $bg_color6='';
 $bg_color7='background-color:#EBEBEB; color:#000';
 

}

else if($_SERVER['SCRIPT_NAME']=="/logout.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='';
 $bg_color5='';
 $bg_color6='';
 $bg_color7='';
  $bg_color8='background-color:#EBEBEB; color:#000';

}

else if($_SERVER['SCRIPT_NAME']=="/event_detail.php"){
 $bg_color2='background-color:#EBEBEB; color:#000';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='';
 $bg_color5='';
 $bg_color6='';
 $bg_color7='';
  $bg_color8='';

}

else if($_SERVER['SCRIPT_NAME']=="/fullArticle.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='background-color:#EBEBEB; color:#000';
 $bg_color4='';
 $bg_color5='';
 $bg_color6='';
 $bg_color7='';
  $bg_color8='';

}

else if($_SERVER['SCRIPT_NAME']=="/authorPage.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='background-color:#EBEBEB; color:#000';
 $bg_color4='';
 $bg_color5='';
 $bg_color6='';
 $bg_color7='';
  $bg_color8='';

}

else if($_SERVER['SCRIPT_NAME']=="/business_info.php"){
 $bg_color2='';
 $bg_color1="";
 $bg_color3='';
 $bg_color4='';
 $bg_color5='background-color:#EBEBEB; color:#000';
 $bg_color6='';
 $bg_color7='';
  $bg_color8='';

}

?>
<style>
.bgchange{
	background-color:#EBEBEB; color:#000;
}
</style>
	</div>
  <ul class="orion-menu green">
				<li><h1><a  href="<?php echo SITE_URL;?>"  style=" <?php echo $bg_color1;?>">Home</a></h1></li>
				<li><a href="<?php echo SITE_URL;?>all_event" style=" <?php echo $bg_color2;?>">All Events</a></li>
				<li><a href="<?php echo SITE_URL;?>articles" style=" <?php echo $bg_color3;?>">Articles</a></li>
                <li><a href="<?php echo SITE_URL;?>advertise"  style=" <?php echo $bg_color4;?>">Advertise</a></li>
			<li><a href="<?php echo SITE_URL;?>training_providers" style=" <?php echo $bg_color5;?>">Training Providers</a> </li>
            <li><a href="<?php echo SITE_URL_S;?>premium-listing" style=" <?php echo $bg_color7;?>">Premium Listing</a></li>
             <li><a href="<?php echo SITE_URL;?>venues">Find Venues</a></li>
             <li><a href="<?php echo SITE_URL;?>suppliers">Find Suppliers</a></li>
             <li><a href="#">Uploads</a>
                <ul>
                   <li><a href="<?php echo SITE_URL;?>add_event">Upload Your Event (free)</a></li>
				<li><a href="<?php echo SITE_URL;?>biz_info">Upload Your Business Info</a></li>
				<li><a href="<?php echo SITE_URL;?>add_video">Upload Training Videos</a></li>
				<li><a href="<?php echo SITE_URL;?>vacancies">Upload Training Vacancy</a></li>
				
                </ul>
            </li>
				 
                  
               
				<li class="search">
					<form method="get" action="<?php echo SITE_URL; ?>content_search">
						<input name="query" type="text" id="query" class="search" />
					</form>
				</li>
                
				<li class="social">
					<a href="https://www.facebook.com/nigerianseminars" target="_blank" style="background:none"><i class="icon-facebook"></i><span class="tooltip">Facebook</span></a>
					<a href="https://twitter.com/NigerianSeminar" target="_blank" style="background:none"><i class="icon-twitter"></i><span class="tooltip">Twitter</span></a>
					<a href="https://www.pinterest.com/nigerianseminar" target="_blank" style="background:none"><i class="icon-pinterest"></i><span class="tooltip">Pinterest</span></a>
					<a href="https://plus.google.com/107382097978433122911" target="_blank" style="background:none"><i class="icon-google-plus"></i><span class="tooltip">Google Plus</span></a>
				</li>
			</ul>