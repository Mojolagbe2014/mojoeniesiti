<div id="navigation3">
 <?php
 if(isset($_SESSION['loggedin'])){
 ?>
 <div class="welcomeMsg" style="float:left;"><?php 
 echo "Welcome ". @$_SESSION['u_name'];?></div>
			<ul>
				<li><a href="<?php echo SITE_URL;?>add_video">Upload Training Videos</a></li>
				<li><a href="<?php echo SITE_URL;?>vacancies">Upload Training Vacancy</a></li>
				
                 
			</ul>
            <?php
 }
 else{
 ?>
 	<ul>
          
				<li class="active"><a href="<?php echo SITE_URL;?>add_event">Upload Your Event (free)</a></li>
				<li><a href="<?php echo SITE_URL;?>biz_info">Upload Your Business Info</a></li>
				<li><a href="<?php echo SITE_URL;?>add_video">Upload Training Videos</a></li>
				<li><a href="<?php echo SITE_URL;?>vacancies">Upload Training Vacancy</a></li>
				
                <li><a href="<?php echo SITE_URL_S;?>premium-listing" class="premiumListing">Premium Listing</a></li>
      </ul>  
         
                <p id="google_translate_element" align="left" style="float:left; top:auto; margin-top:auto;"><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-23693392-1'}, 'google_translate_element');
}
</script>
</p>
<p style="float:left; position:relative;"><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script><br />

     </p>
                 
			
            <?php
 }
 ?>
 </div>


 <div class="clearfix"></div>
 </div>
 
<div id="slider">
	
	<!-- start slideshow -->
	<div id="slideshow">
    
	<div class="logoClass" >
    <div class="clearfix"></div>
    </div>
   
    <div id="scroller">
<p id="tag">Welcome to Nigerian Seminars and Trainings.com.... Home of conferences, training seminars, workshops, short courses and other learning opportunities around the world</p>
<div class="clearfix"></div>
</div>

	
	</div>
		<div class="clearfix"></div>
	</div>
<div id="navigation2">
			<ul>
				<li><h1 style="font-size:12px; font-weight:bold;"><a href="<?php echo SITE_URL;?>">Home</a></h1></li>
				<li><a href="<?php echo SITE_URL;?>all_event">Find Events</a></li>
				<li><a href="<?php echo SITE_URL;?>videos_all">Videos</a></li>
				<li><a href="<?php echo SITE_URL;?>venues">Find Venues</a></li>
				 <li><a href="<?php echo SITE_URL;?>all_vacancies">Training Jobs</a></li>
                <li><a href="<?php echo SITE_URL;?>suppliers">Equipment Suppliers </a></li>
                <li><a href="<?php echo SITE_URL;?>event_managers">Event Managers</a></li>
                <li><a href="<?php echo SITE_URL;?>articles">Articles / Journals</a></li>
                <li><a href="<?php echo SITE_URL;?>subscribers">Subscribe</a></li>
               
                <li><a href="<?php echo SITE_URL;?>training_providers">Training Providers</a></li>
                   
                 <?php
                 if(!isset($_SESSION['loggedin'])){
?>
                  <li><a href="https://www.nigerianseminarsandtrainings.com/login" class="big-link">Sign-in</a></li>
                  <?php
				 }
				 ?>
                
			</ul>
		</div>