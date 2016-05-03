<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/scroller.js"></script>
		<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery.reveal.js"></script>
            <script type="text/javascript" src='<?php echo SITE_URL_S;?>js/jquery.min.js'></script>
			<script type="text/javascript" src='<?php echo SITE_URL_S;?>js/jquery-ui.min.js'></script> 
		      <script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery-1.4.2.min.js"></script> 
              <script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery.prettyphoto.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery-ui-1.8.1.custom.min.js"></script>
<script src="<?php echo SITE_URL_S;?>js/jquery.color.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo SITE_URL_S;?>js/superfish.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&sensor=true"></script>
<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery.gmap-1.0.3-min.js"></script>

<script src="<?php echo SITE_URL_S;?>js/jquery.validate.js" type="text/javascript"></script>
   <script src='<?php echo SITE_URL_S;?>js/jquery.ui.monthpicker.js' type="text/javascript"></script>
   
   <script src="<?php echo SITE_URL_S;?>fxTab/js/jquery.easing.1.3.js" type="text/javascript"></script>
    <script src="<?php echo SITE_URL_S;?>fxTab/js/fxtabs.jquery.js" type="text/javascript"></script>
  
  <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.totemticker.js"></script>
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
      
    
     <script src='<?php echo SITE_URL_S;?>js/jquery.ui.monthpicker.js' type="text/javascript"></script>


  
<script src="<?php echo SITE_URL_S;?>js/jquery.cookie.js" type="text/javascript"></script>

               
<script src="<?php echo SITE_URL_S;?>js/jquery.cookie.js" type="text/javascript"></script>
	
	
            <script type="text/javascript">
			$(document).ready(function(){
			
			//categories
			$.post("<?php echo SITE_URL;?>tools/category_new.php", {query:'category'}, function(data) {
				$('#categoryTab').html(data)
			});
			
			//premium-listing
			$('#business_name').keyup(function(){
			$('#outputPremium').fadeIn('slow');
			$('#outputPremium').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL_S;?>tools/searchPremium.php", {query:$(this).val()}, function(data) {
				
				$('#outputPremium').html(data)
			
			
					});
				});
			
			$('#business_name').blur(function(){
		$('#outputPremium').fadeOut();
		
	})
			
									   
				//event search					   
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
			$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" /></center>')
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
			
			function GetValPremium(elem){
				
		$('#business_name').val($('#'+elem).text());
		$('#outputPremium').hide();

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
						buttonImage: "<?php echo SITE_URL_S;?>images/calendar.png",
						buttonImageOnly: true,
						dateFormat: 'MM yy',
						prevText: 'Prev'

						});
					});
					

</script>
                      
 <script  type="text/javascript">
$(document).ready(function()
{
	$("#login-form2").submit(function()
	{
		if($('#name').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if ($('#email').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#message').val() == ''){
			alert("Please enter your message");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Sending message....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("http://www.nigerianseminarsandtrainings.com/tools/send.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#message').val(),subject:$('#title').val(),to:$('#to').val(),phone:$('#phone').val(),address:$('#address').val(),title:$('#course').val(), rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your message has been sent!').addClass('messageboxok').fadeTo(900,1);
			  $('#name').val("");
			  $('#email').val("");
			  $('#message').val("");
			  $('#title').val("");
			  $('#phone').val("");
			  $('#address').val("");
			});
			setInterval(function(){$('#contact-wrapper2').fadeOut('slow')},3000);
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Error sending message!').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
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
    
    <script type="text/javascript" src="<?php echo SITE_URL_S;?>css/menu/js/orion-menu.js"></script>
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
