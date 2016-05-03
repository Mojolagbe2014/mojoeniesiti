<div id="top_element">
 <div id="TopNav">

 <!--<div class="welcomeMsg" style="float:left;">
 </div>-->

  <?php
 $display = '';
 if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])) $display = 'Hello, '.$_SESSION['name'];
 else $display = '<script type="text/javascript" language="javascript">renderTime();</script>';
 ?>
 <div class="welcomeNote" id="clockDisplay"><?php echo $display;?></div>
 <div id="scroller">
<p id="tag">Welcome to Nigerian Seminars and Trainings.... Home of conferences, training seminars, workshops, short courses and other learning opportunities in Nigeria and around the world</p>
<div class="clearfix"></div>
</div >
<div class="topmenu_options" >
<p class="topsubscribe"><a href="<?php echo SITE_URL;?>subscribers" >Subscribe</a></p>
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
                   <!-- <ul>
                  <li><a href="<?php //echo SITE_URL_S;?>login" >Premium Account</a></li>
                 <li><a href="<?php //echo SITE_URL;?>subscriber_login" >Subscribers</a></li>
                 <li><a href="<?php //echo SITE_URL;?>facilitator_login" >Facilitator Login</a></li>
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
		<div class="clearfix"></div>
        <div class="clearfix"></div>
       
  </div>
 <ul class="orion-menu green">
				<li><h1 style="font-size:11px;"><a href="<?php echo SITE_URL;?>"  style="background:#EBEBEB; color:#000">Home</a></h1></li>
				<li><a href="<?php echo SITE_URL;?>all_event">All Events</a></li>
				<li><a href="<?php echo SITE_URL;?>articles">Articles</a></li>
                <li><a href="<?php echo SITE_URL;?>advertise">Advertise</a></li>
			<li><a href="<?php echo SITE_URL;?>training_providers">Training Providers</a> </li>  
            <li><a href="<?php echo SITE_URL_S;?>premium-listing">Premium Listing</a></li>
            <li><a href="<?php echo SITE_URL;?>venues">Find Venues</a></li>
             <li><a href="<?php echo SITE_URL;?>suppliers">Find Suppliers</a></li>
      <li><a href="#">Uploads</a>
                <ul>
                   <li><a href="<?php echo SITE_URL;?>add_event">Upload Your Event (free)</a></li>
				<li><a href="<?php echo SITE_URL;?>biz_info">Upload Your Business Info</a></li>
				<li><a href="<?php echo SITE_URL;?>add_video">Upload Training Videos</a></li>
				<li><a href="<?php echo SITE_URL;?>vacancies">Upload Training Vacancy</a></li>
               <!-- <li><a href="<?php //echo SITE_URL;?>articleUpload">Upload Article(s)</a></li>
                   <li><a href="<?php //echo SITE_URL;?>newsUpload">Upload New(s)</a></li>-->
				
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