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
<div id="top_element">
 <div id="TopNav">
<div class="topmenu_options">

<ul>
<li class="resShow"><a href="<?php echo SITE_URL;?>login"  rel="nofollow" >Login</a></li>
<?php if(!isset($_SESSION['login_subcriber'])){?>
<li class="hide" ><a href="<?php echo SITE_URL;?>subscribers" rel="nofollow" >Subscribe</a></li>
<?php } ?>
<li style="margin-right:0px;"><a href="<?php echo SITE_URL;?>upload-vacancies" style="background-image:none;">Add Vacancy</a></li>
<li><a href="http://www.nigerianseminarsandtrainings.com/videos/add-video" >Add Video</a></li>
<?php  if(!isset($_SESSION['login_business'])){?>
<li><a href="<?php echo SITE_URL;?>upload-business-info" >Add Business</a></li>
<?php } ?>
<li><a href="<?php echo SITE_URL;?>add-event" >Add Event</a></li>
<?php if(!isset($_SESSION['login_subcriber'])){?>
<li class="hide"><a href="<?php echo SITE_URL;?>subscribers" rel="nofollow" >Subscribe</a></li>
<?php } ?>
<li class="hide"><a href="<?php echo SITE_URL;?>login" rel="nofollow" >Login</a></li>
<li><a href="http://blog.nigerianseminarsandtrainings.com" target="_blank" >Blog</a></li>
<li><a href="http://forum.nigerianseminarsandtrainings.com" target="_blank" >Forum</a></li>
</ul>
<?php if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
?>
<form action="<?php echo SITE_URL;?>logout" method="post">
 <table width="286" border="0" style="width:150px;">
    <tr>
      <td width="57"><input type="submit" value="Logout" name="submit_login2" style="cursor:pointer;"></td>
      <td><?php if (!strpos($_SERVER['SCRIPT_NAME'],'profile.php')){;?><input type="button" value="Back to Profile" name="subject2" class="inputBox_button" onClick="Account()" style="background-color:#33454E;"><?php } ?></td>
      </tr>
  </table>
  </form>
<?php
}
else{
?>
<?php if (!strpos($_SERVER['SCRIPT_NAME'],'login.php')){?>
<form name="form1" method="post" action="<?php echo SITE_URL;?>login">

<div class="top_login_form">
	
    <div class="btn-control">
    <input type="submit" value="Login" name="submit_login" style="cursor:pointer;background-color:#33454E;" class="inputBox_button">
    <input type="button" value="Subscribe" name="subject" class="inputBox_button" onClick="Subscriber()">
    <div class="clear"></div>
    </div>
</div>
</form>
 <?php
	}
}
?>
   </div>
   
<div class="topmenu_options_left" >
 <?php
 $display = '';
 if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])) $display = 'Hello '.$_SESSION['name'];
 else $display = '<script type="text/javascript">renderTime();</script>';
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
    <img src="<?php echo SITE_URL;?>images/logo2.png" alt="Nigerian Seminars and Trainings" />
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
 <ul class="orion-menu petrol">
		<li><h1 style="font-size:14px;"><a href="<?php echo SITE_URL;?>">Home</a></h1></li>
				<li <?php echo active('all-event');?>><a href="<?php echo SITE_URL;?>all-event">All Events</a></li>
				<li <?php echo active('articles');?>><a href="<?php echo SITE_URL;?>articles">Articles</a></li>
                <li <?php echo active('advertise');?>><a href="<?php echo SITE_URL;?>advertise" rel="nofollow" >Advertise</a></li>
			<li <?php echo active('training-providers');?>><a href="<?php echo SITE_URL;?>training-providers">Training Providers</a> </li>  
            <li <?php echo active('premium-listing');?>><a href="<?php echo SITE_URL;?>premium-listing" rel="nofollow" >Premium Listing</a></li>
            <li <?php echo active('venues');?>><a href="<?php echo SITE_URL;?>venues">Find Venues</a></li>
             <li <?php echo active('suppliers');?>><a href="<?php echo SITE_URL;?>suppliers">Find Suppliers</a></li>
      <li <?php echo active('event-managers');?>><a href="<?php echo SITE_URL;?>event-managers">Event Managers</a></li>
      <li <?php echo active('contact-us');?>><a href="<?php echo SITE_URL;?>contact-us" rel="nofollow" >Contact Us</a></li>
				
                  
                
                 
				<li class="search ">
					<form method="get" action="<?php echo SITE_URL; ?>content_search">
						<input name="query" type="text" id="query" class="search" placeholder="Google&trade; Custom Search" />
				  </form>
		</li>
				<li class="social hidele">
					<a href="https://www.facebook.com/nigerianseminars" target="_blank" style="background:none" ><i class="fa fa-facebook"></i><span class="tooltip">Facebook</span></a>
					<a href="https://twitter.com/NigerianSeminar" target="_blank" style="background:none"><i class="fa fa-twitter" ></i><span class="tooltip">Twitter</span></a>
					<a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank" style="background:none" rel="publisher" ><i class="fa fa-google" ></i><span class="tooltip">Google Plus</span></a>
					<a href="https://www.pinterest.com/nigerianseminar" target="_blank" style="background:none"><i class="fa fa-pinterest" ></i><span class="tooltip">Pinterest</span></a>
                    <a href="https://www.youtube.com/user/nigerianseminars" target="_blank" style="background:none"  ><i class="fa fa-youtube" ></i><span class="tooltip">Youtube</span></a>
				</li>
</ul>
<div>
 
 

		
<div class="clearfix"></div>

 </div>
 </div>		
<div class="clearfix"></div>

 </div>
<div class="clearfix"></div>