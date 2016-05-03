<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=SpryAssets/SpryTabbedPanels.js"></script>
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





     <?php include("user_float.php");?>
 
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
    <h2>Find Vendors</h2>
    
 	<ul class="bulleting">
          
				<li><a href="<?php echo SITE_URL;?>venues">Venue Providers</a></li>
				<li><a href="<?php echo SITE_URL;?>event_managers">Event Managers</a></li>
				<li><a href="<?php echo SITE_URL;?>suppliers">Equipment Suppliers</a></li>
			
				
               
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
        <h2>Resources</h2>
       <ul class="bulleting">
       <li><a  href="<?php echo SITE_URL;?>all_vacancies">Find Jobs</a></li>
       <li><a  href="<?php echo SITE_URL;?>videos_all">Watch Training Video</a></li>
      <!-- <li><a target="_blank" href="https://s3.amazonaws.com/com.alexa.toolbar/atbp/NunuTq/download/index.htm">Download our toolbar</a></li>-->
       
        <p id="google_translate_element" style="margin-top:10px; padding:0px;"><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-23693392-1'}, 'google_translate_element');
}
</script>
</p>
<p style="margin:0px; padding:0px;"><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<br />

     </p>
       
       </ul>    
 </div>
    
		<div class="copyright">
         
			<span style="margin-top:7px">Copyright &copy; <?php echo date("Y");?> Nigerian Seminars and Trainings.com.</span>
			<span style="margin-top:7px"><a href="<?php echo SITE_URL;?>terms_of_use">Terms of Use</a> |
			<a href="<?php echo SITE_URL;?>privacy_policy">Privacy Policy</a></span>
           <span id="siteseal"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>
            
        <div class="style-switcher clearfix">
        <div class="style-switcher-toggler">
             <a class="trigger" href="<?php echo SITE_URL;?>contact-us"><img src="<?php echo SITE_URL;?>images/x.gif" width="19" height="128" alt="contact"   /></a>
        </div>
  
</div>
</div>
<!-- END Attracta -->
		</div>
     
		<div class="footer_nav"> </div>
       

</div>
<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=js/scroller.js,js/jquery-1.4.2.min.js,js/jquery-ui-1.8.1.custom.min.js,js/jquery.ui.monthpicker.js,fxTab/js/jquery.easing.1.3.js,fxTab/js/fxtabs.jquery.js"></script>

<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=css/menu/js/orion-menu.js"></script>

<script type="text/javascript" src="js/jquery.totemticker.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#vertical-ticker').totemticker({
				row_height	:	'100px',
				next		:	'#ticker-next',
				previous	:	'#ticker-previous',
				stop		:	'#stop',
				start		:	'#start',
				mousestop	:	true,
			});
		});
	</script>
  
 <script type="text/javascript">
 (function($){
    $.fn.fixedMenu=function(){
        return this.each(function(){
			var linkClicked= false;
            var menu= $(this);
			$('body').bind('mouseover',function(){
			
					if(menu.find('.active').size()>0 && !linkClicked)
					{
						menu.find('.active').removeClass('active');
					}
					else
					{
						linkClicked = false; 
					}
			});
			
            menu.find('ul li > a').bind('mouseover',function(){
				linkClicked = true;
				if ($(this).parent().hasClass('active')){
					$(this).parent().removeClass('active');
				}
				else{
					$(this).parent().parent().find('.active').removeClass('active');
					$(this).parent().addClass('active');
				}
            })
        });
    }
})(jQuery);
 
        $('document').ready(function(){
            $('.menu_top').fixedMenu();
        });
        </script>
   <script type="text/javascript">
			   
        jQuery(document).ready(function($) {
          var slider = new FxTabs({controls : '#m1', minSize : 150, autoResize : true, noMouseDrag : true, noTouchDrag : true}, '#t1');
        });
    </script>
  
	
            <script type="text/javascript">
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
			
			
			
			$(document).ready(function(){
	$('#textInput').keyup(function(){
			$('#output').fadeIn('slow');
			$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/search.php", {query:$(this).val()}, function(data) {
				
				$('#output').html(data)
			
			
		});
			/*if($(this).val() == ''){
				$('#output').fadeOut('slow');
			}*/
	})
	
	$('#textInput').blur(function(){
		$('#output').fadeOut();
		
	})
	$('#textInput').focus(function(){
			$('#output').fadeIn('slow');
			$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
			if($(this).val() == ""){
			$.post("<?php echo SITE_URL;?>tools/search.php", {queryFocus:$(this).val()}, function(data) {
				/*if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
					a
				
				}*/
				$('#output').html(data)
			
			
		});
			}
			else{
				$.post("<?php echo SITE_URL;?>tools/search.php", {query:$(this).val()}, function(data) {
				
				$('#output').html(data)
			
			
		});
			}
	})
	
})
			//.css('text-align','center');overflow: scroll ;
			function GetManageHeight(){
				if($('#output').height() > 300){
					$('#output').css('height','300px');
					$('#output').css('overflow','scroll');
				}
				else{
					$('#output').css('height','auto');
					$('#output').css('overflow','hidden');
				}
				
			}
			function GetVal(elem){
				
		$('#textInput').val($('#'+elem).text());
		$('#output').hide();

			}
			$(document).ready(function(){
			$('#searchform').submit(function(){
			var keyword_val = document.getElementById("month")
					if(keyword_val.value == 'Please select month to find event'){
						keyword_val.value ='';
					}
				});
			});
			
			$(document).ready(function(){
			$('#search_site').submit(function(){
			var keyword_val = document.getElementById("query")
					if(keyword_val.value == 'Search Site...'){
						keyword_val.value ='';
					}
				});
			});
			
				jQuery(document).ready(function() {
					jQuery("#month").monthpicker({
						showOn:     "both",
						buttonImage: "<?php echo SITE_URL;?>images/calendar.png",
						buttonImageOnly: true,
						dateFormat: 'MM yy',
						prevText: 'Prev'

						});
					});
					

</script>
                      
    <script type="text/javascript">
	function GetAds(AdID){
		// change /examples/linkstats/ajax-linkstat.php with the path to your file
		$.post("<?php echo SITE_URL;?>tools/hit.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
				
			
			
		});
	}
	</script>
      <script type="text/javascript">
	function GetImp(AdID){
		// change /examples/linkstats/ajax-linkstat.php with the path to your file
		$.post("<?php echo SITE_URL;?>tools/impression.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
	</script>
     <script type="text/javascript">
	function GetWebClicks(AdID){
		// change /examples/linkstats/ajax-linkstat.php with the path to your file
		$.post("<?php echo SITE_URL;?>tools/WebClicks.php", {id:"Business-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
	</script>
    
  
		<script type="text/javascript">
			$(document).ready(function(){
				$(".panel a").click(function(e){
					e.preventDefault();
					var style = $(this).attr("class");
					$(".orion-menu").removeAttr("class").addClass("orion-menu").addClass(style);
				});
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){  
				$().orion({
					speed: 500
				});
			});
		</script>

                    <script type="text/javascript">
					
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<script type="text/javascript">var switchTo5x=true;</script>


	 <script type="text/javascript" src="http://arrow.scrolltotop.com/arrow34.js" async ></script>