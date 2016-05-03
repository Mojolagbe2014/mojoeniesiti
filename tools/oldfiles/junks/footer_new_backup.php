 
  <?php include(dirname( dirname( __FILE__ ) ) .'/tools/contact-form.html');?>
 
<!--prompt for download-->
 <div id="maskLog"></div>
  <div id="Login_pop" style="float:left;" class="window_currency boxContent smart-forms">
      <div class="alert notification alert-error">You must be logged in to download an article or quarterly guide, <a href="<?php echo SITE_URL;?>login" >Click here</a> to login. <br /> Dont have an account? <a href="<?php echo SITE_URL;?>biz_info">Click here</a>to register as a business or <a href="<?php echo SITE_URL;?>subscribers">Click here</a> to register as a subscriber<br /><p style="text-align:center"><a href="#" class="close">close</a></p></div>
      <br />
      </div>
     <!-- end prompt-->
 <div id="password_forget" style="float:left;" class="window boxContent password_forget"> 
    
    <form id="forgotPassword" name="form1" method="post" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;"><i class="fa fa-info-circle "></i>&nbsp;&nbsp;Forgot Password?</strong>
                   
                    </div>
                     <div class="alert notification spacer-b30" style="display:none; text-align:center;" id="msgComment"></div>
<table class="contact_provider_table" style="width:300px;">

<tr>
 
<td style="color:#009900; font-size:12px; text-align:center;">Please provide your email so we can reset your password.</td>

</tr>
<tr>
 
<td >
   <label class="field">
                                    <input type="text" name="email" id="emailForgot" class="gui-input" placeholder="Email" required >
                                </label>
</td></tr>




<tr>

  <td>
  <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
                            </label>
                            <label for="securitycode" class="button captcode">
                            	<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha anti-spam security">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>
  </td>
</tr>
<tr>
  <td style="text-align:center;">
    <button class="button btn-primary" type="submit"> Send </button>
   
   <button class="button" id="closeBox"> Close </button></td>
  </tr>
</table> 
</form>
<div class="clearfix"></div>
</div>

 
<footer>
<div id="footer_content">
<div id="footer">
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

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


<!--<div class="respond">
   <div class="TopBottomMenu">
	<ul style="font-size:14px;">
		<li><a href="https://www.facebook.com/nigerianseminars" style="color:#003399;" target="_blank"><i class="fa fa-facebook"></i></a></li>
		<li><a href="https://twitter.com/NigerianSeminar" style="color:#3CF;" target="_blank"><i class="fa fa-twitter" ></i></a></li>
		<li><a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank"><i class="fa fa-google" ></i></a></li>
		<li><a href="https://www.youtube.com/user/nigerianseminars" style="color:#F00;" target="_blank"><i class="fa fa-youtube" ></i></a></li>
        <li><a href="https://www.pinterest.com/nigerianseminar" style="color:#F00;" target="_blank"><i class="fa fa-pinterest" ></i></a></li>
		<li><a href="https://www.stumbleupon.com/stumbler/nigerianseminars"  style="color:#3CF;" target="_blank"><i class="fa fa-stumbleupon" ></i></a></li>
         <li><a href="javascript:void()" onClick="OpenContactForm()"><i class="fa fa-phone" ></i>&nbsp;Contact Us</a></li>
	</ul>
</div>
</div>-->
    
    
		<div class="copyright">
        
			<p>Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>terms-of-use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="<?php echo SITE_URL;?>privacy-policy">Privacy Policy</a></p>
           
            <span class="goDaddy" style="margin-top:20px;">
            <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>
       
             <span class="goDaddy" style="margin-top:10px;">
            <a href="#" target="_blank" rel="nofollow" ><img src="<?php echo SITE_URL;?>images/paypal_accepted.jpg" alt="nigerian seminars pay pal image" /></a>
            </span> 
    
</div>
<!-- END Attracta -->
  </div>
     
		<div class="footer_nav"> </div>
       

</div>
</footer>
<?php if (!strpos($_SERVER['SCRIPT_NAME'],'subscribers.php') && !strpos($_SERVER['SCRIPT_NAME'],'add_event.php') && !strpos($_SERVER['SCRIPT_NAME'],'vacancies.php') && !strpos($_SERVER['SCRIPT_NAME'],'upload-business-info.php')&& !strpos($_SERVER['SCRIPT_NAME'],'business_info.php')&& !strpos($_SERVER['SCRIPT_NAME'],'webVacancies.php') && !strpos($_SERVER['SCRIPT_NAME'],'profile.php') && !strpos($_SERVER['SCRIPT_NAME'],'article-submission.php') && !strpos($_SERVER['SCRIPT_NAME'],'authorPage.php') && !strpos($_SERVER['SCRIPT_NAME'],'fullArticle.php')&& !strpos($_SERVER['SCRIPT_NAME'],'profile.php')){?>

 <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-monthpicker.min.js"></script>
   <!-- <script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=css/menu/js/orion-menu.js"></script>-->
   
    
   <?php
}
?>
<script type="text/javascript" src="<?php echo SITE_URL;?>css/menu/js/orion-menu.js"></script>
<script src="<?php echo SITE_URL;?>js/dwsee.top.bottom.menu.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>js/jquery.sticky.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>js/eventCategory.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>js/jquery.zweatherfeed.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/contact-form.js"></script>

 <script>
  $(document).ready(function(){
	  /*Works for the category auto complete search*/
    GetCategoryEvents(<?php echo @$_GET['category'];?>)
  });
</script>
<script type="text/javascript">
$(document).ready(function () {
	$('#weather').weatherfeed(['NIXX0012'], {
		refresh: 1
	});
});
</script>

 <script>
  $(document).ready(function(){
    $(".menu_container").sticky({topSpacing:0});
  });
</script>

     <script type="text/javascript">

	$(document).ready(function() {
		
	

	$(this).dwseeTopBottomMenu({
		topicon : '<?php echo SITE_URL;?>images/direction_up.png',
		menuicon : '<?php echo SITE_URL;?>images/manage.png',
		bottomicon : '<?php echo SITE_URL;?>images/direction_down.png'
		})

	})
		</script>
    <script type="text/javascript">
	
	function Subscriber(){
	window.location='<?php echo SITE_URL;?>subscribers';
}
function Account(){
	window.location='<?php echo SITE_URL;?>login';
}
	
	//script for the search calender
		$(function() {
		
					$("#month-picker1").monthpicker({
						changeYear: false,
						stepYears: 1,
						prevText: '<i class="fa fa-chevron-left"></i>',
						nextText: '<i class="fa fa-chevron-right"></i>',
						dateFormat: 'MM yy',
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
			$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image"  /></center>')
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
			
			
			
			
			/*********** script to show the training providers,event managers, suppliers and venues page **************/
		//fires up the training providers when the keboard is pressed
		$('#search_provider').keyup(function(){
			$('#outputTprovider').fadeIn('slow');
			$('#outputTprovider').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/search_providers.php", {query:$(this).val(), type:$('#biz_type').val()}, function(data) {
				
				$('#outputTprovider').html(data)
			
			
		});
	})
	//disappears the training providers when the text box looses focus
	$('#search_provider').blur(function(){
		$('#outputTprovider').fadeOut();
		
	})
	//displays the training providers when the text box gains focus
		$('#search_provider').focus(function(){
			$('#outputTprovider').fadeIn('slow');
			$('#outputTprovider').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
			if($(this).val() == ""){
			$.post("<?php echo SITE_URL;?>tools/search_providers.php", {queryFocus:$(this).val(), type:$('#biz_type').val()}, function(data) {
				
				$('#outputTprovider').html(data)
			
			
		});
			}
			else{
				$.post("<?php echo SITE_URL;?>tools/search_providers.php", {query:$(this).val(), type:$('#biz_type').val()}, function(data) {
				
				$('#outputTprovider').html(data)
			
			
		});
			}
	})
	
	//funtion to retrieve the value from the training providers drop down
	function GetValProvider(elem){
				
		$('#search_provider').val($('#'+elem).text());
		$('#outputTprovider').hide();

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
	/*function GetImp(AdID){
		$.post("<?php //echo SITE_URL;?>tools/impression.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}*/
	//gets the clicks to the websites
	/*function GetWebClicks(AdID){
		$.post("<?php //echo SITE_URL;?>tools/WebClicks.php", {id:"Business-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}*/
	
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
		$('#maskLog').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#maskLog').fadeIn(1000);	
		$('#maskLog').fadeTo("slow",0.8);	
	
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
	$('.window_currency .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//$('#msgbox').fadeOut('slow');
		$('#maskLog').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#maskLog').click(function () {
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
        $('#maskLog').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});
    
    </script>
   <script type="text/javascript">
$(document).ready(function(e) {
	
	/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#evtsearch').keyup(function(){
			$('#output_events').fadeIn('slow');
			$('#output_events').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image"  /></center>')
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
					function url_location(data){
						window.location = data
					}
					</script>