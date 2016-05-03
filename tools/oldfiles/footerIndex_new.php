<div id="footer_content">
<div id="footer">
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

<noscript></noscript>
<script language="javascript" type="text/javascript">
<!--//
$(function(){
	function moveFloatMenu() {
		var menuOffset = menuYloc.top + $(this).scrollTop() + "px";
		$('#floatMenu').animate({top:menuOffset},{duration:500,queue:false});
	}
 
	menuYloc = $('#floatMenu').offset();
 
	$(window).scroll(moveFloatMenu);
 
	moveFloatMenu();
});
//-->
</script>





     <?php //include("user_float.php");?>
 
<div class="socialize">
     
    <h2 >Quick Links</h2>
    <ul class="bulleting">
					<li><a href="<?php echo SITE_URL;?>">Home</a></li>
                    <li><a href="<?php echo SITE_URL;?>about">About Us</a></li>
                  <li><a href="<?php echo SITE_URL;?>advertise">Advertise</a></li>
            <li><a href="<?php echo SITE_URL;?>sitemap_page">Sitemap</a></li>       
                    <li><a href="http://m.nigerianseminarsandtrainings.com">Visit Mobile Site</a></li>
 
  </ul>
        
       
    </div>
    <div class="socialize">
    <h2>Quick Links</h2>
    
 	<ul class="bulleting">
          
				<li><a href="<?php echo SITE_URL;?>venues">Venue Providers</a></li>
				<li><a href="<?php echo SITE_URL;?>event_managers">Event Managers</a></li>
				<li><a href="<?php echo SITE_URL;?>suppliers">Equipment Suppliers</a></li>
			 <li><a  href="<?php echo SITE_URL;?>all_vacancies">Find Jobs</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Watch Training Video</a></li>
				
               
      </ul>  
    
    </div>
       <div class="socialize">
        <h2>Subscriptions</h2>
       <ul class="bulleting">
       <li><a  href="<?php echo SITE_URL;?>rss">RSS Feed</a></li>
       <li><a  href="<?php echo SITE_URL_S;?>premium-listing">Premium Listing</a></li>
       <li><a  href="<?php echo SITE_URL;?>subscribers">Updates / Newsletter</a></li>
       
       </ul>    
 </div>
  <div class="socialize">
        <h2>Uploads</h2>
       <ul class="bulleting">
       <li><a  href="<?php echo SITE_URL;?>all_vacancies">Add Event</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Add Business</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Upload Vacancy</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Upload Videos</a></li>
      <!-- <li><a target="_blank" href="https://s3.amazonaws.com/com.alexa.toolbar/atbp/NunuTq/download/index.htm">Download our toolbar</a></li>-->
       
       

     </p>
       
       </ul>    
 </div>
    
		<div class="copyright">
        
			<p>Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>terms_of_use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>privacy_policy">Privacy Policy</a></p>
            <span>
            <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>
       
            
       <!-- <div class="style-switcher clearfix">
        <div class="style-switcher-toggler">
             <a class="trigger" href="<?php echo SITE_URL;?>contact-us"><img src="<?php echo SITE_URL;?>images/x.gif" width="19" height="128" alt="contact"   /></a>
        </div>
  
</div>-->
</div>
<!-- END Attracta -->
  </div>
     
		<div class="footer_nav"> </div>
       

</div>

 <script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="css/smartforms/js/jquery-ui-monthpicker.min.js"></script>
    
    <script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=css/menu/js/orion-menu.js"></script>
    
    <script type="text/javascript">
     $(document).ready(function(e) {
        $('#email_login').keypress(function(e) {
            alert('test');
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
						showButtonPanel: true
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
	
	/***************** jquery for the tabs ********************/
	 jQuery(document).ready(function($) {
          var slider = new FxTabs({controls : '#m1', minSize : 150, autoResize : true, noMouseDrag : true, noTouchDrag : true}, '#t1');
        });
		
		
	/**************************** script for the links that loads in the tabs ***********************/
	//TabsLinks
			
			//category
			$(document).ready(function(){
			
			$.post("<?php echo SITE_URL;?>tools/category_new.php", {query:'category'}, function(data) {
				$('#categoryTab').html(data)
			});
			
			//Event Location Tab
			
			$.post("<?php echo SITE_URL;?>tools/event_location.php", {query:'category'}, function(data) {
				$('#eventLocTab').html(data)
			});
			
			//Event Location Nigeria Tab
			
			$.post("<?php echo SITE_URL;?>tools/event_location_nigeria.php", {query:'category'}, function(data) {
				$('#eventLocNigTab').html(data)
			});
			
			//Category Training Tab
		
			$.post("<?php echo SITE_URL;?>tools/category_new_training.php", {query:'category'}, function(data) {
				$('#categoryTrainingTab').html(data)
			});
			
			//Category Training Tab
			
			$.post("<?php echo SITE_URL;?>tools/event_location_training.php", {query:'category'}, function(data) {
				$('#eventLocTraining').html(data)
			});
			
			//Event Location Training Nigeria Tab
			
			$.post("<?php echo SITE_URL;?>tools/event_location_nigeria_training.php", {query:'category'}, function(data) {
				$('#eventLocNigTraining').html(data)
			});
		});
		
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
    <!--scroll to top script-->
    <script type="text/javascript" src="http://arrow.scrolltotop.com/arrow34.js" async ></script>
     