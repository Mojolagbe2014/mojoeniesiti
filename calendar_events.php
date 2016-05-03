<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

$paged = "";

$category_query = "";

$title = "";

$pageInnerTitle = "";

$today = date("Y-m-d");

$dtds3=date("F");

$advert = "Calendar Events";

if(connection()){

	$recordperpage = 25;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	if(isset($_GET['sortdate'])){

		$result = MysqlSelectQuery("select * from events WHERE SortDate = '".$_GET['sortdate']."' and status = 1   ORDER BY premium desc, SortDate limit $offset, $recordperpage");

		if(isset($_GET['page'])){
			
		$title = "Upcoming training seminars, conferences for ".date("l F d, Y", strtotime($_GET['sortdate']))." Page ".$_GET['page'];
		$meta_content = "Find latest, educational, professional, technical and state-of-the-heart corporate Seminars, Tranings and Conferences for ".date("l F d, Y", strtotime($_GET['sortdate']))." Page ".$_GET['page'];
		
		//$meta_content = $rows_cat['meta_description']."-Pg-".$_GET['page']."-of-".$rows_cat['category_id'];
		}
		else{
			$title = substr('Upcoming training seminars, conferences for '.date("l F d, Y", strtotime($_GET['sortdate'])),0,69);
			$meta_content = 'Find latest, educational, professional, technical and state-of-the-heart corporate Seminars, Tranings and Conferences  for  '.date("l F d, Y", strtotime($_GET['sortdate']));
		}
		
		$pageInnerTitle = 'Showing result for Events on <span style="color:#060">'.date("l F d, Y", strtotime($_GET['sortdate'])).'</span>';


	}

	else{

	if(isset($_GET['page'])){

		$meta_content = 'Current and upcoming conferences, trainings seminars, workshops, exhibitions in Nigeria, Africa, Asia, North/South America and Oceania for '.date("l F d, Y", strtotime($_GET['sortdate']))." Page ".$_GET['page'];

		}

		else{

			$meta_content = 'Current and upcoming conferences, trainings seminars, workshops,  exhibitions in Nigeria, Africa, Asia, North/South America and Oceania for '.date("l F d, Y", strtotime($_GET['sortdate']));

		}

	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and SortDate >= '$today' ORDER BY premium desc, SortDate limit $offset, $recordperpage");

	$country_query = "WHERE status = 1 and SortDate = '$today'";

	$pageInnerTitle = 'Latest Events';

	if(isset($_GET['page'])){
		
		$title = "Upcoming training seminars, conferences for ".date("l F d, Y", strtotime($_GET['sortdate']))." Page-".$_GET['page'];
	}
else{
	$title = "Upcoming training seminars, conferences for ".date("l F d, Y", strtotime($_GET['sortdate']));
}
	}

}

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">


<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo $title;?></title>

<meta name="description" content="<?php echo $meta_content;?>"/>



	
<?php include("scripts/headers_new.php");?>

	    
<?php include('tools/analytics.php');?>

	

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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<?php include("tools/header_new.php");?>


<div id="main">

	
	<div id="content">
<?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">

                <h4 class="categoryHeader"><?php echo $pageInnerTitle;?></h4>

                <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
				  <?php include("tools/searchResult.php");?>
				  <?php

		if(NUM_ROWS($result) > 0 ){

                     Paging("SELECT COUNT(sortdate) AS numrows FROM events where sortdate = '".$_GET['sortdate']."'",$recordperpage,$pagenum,"calendar_events?sortdate=".$_GET['sortdate']);
		}

				?>	 

</div>

		    </div>

                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

 <div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>
 
       <?php include("tools/search_box.php");?>
        
         <div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>
     
     </div>   
        
<div class="divider"></div>

               <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

<div class="clearfix"></div>

</div>



			</div><!-- end subpage -->

					

	
<?php include("tools/side-menu_new.php");?>

</div>
	<div id="content_bottom"></div>

	<div class="clearfix"></div>

</div>

	

</div>

</div>
<?php include ("tools/footer_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.currency.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.currency.localization.en_US.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#currency-widget').currency();
});
</script>

<script>

$(document).ready(function() {	


//capcha reloader
		function reloadCaptcha(){
					$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
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
	$('.window #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
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
	
	
	$('a[name=currency]').click(function(e) {
      		//Cancel the link behavior
		e.preventDefault();
		$('#price').text('<?php echo GetPrice();?>')
		$('#price_container').show();
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

function showPhone(){
	var Phone = document.getElementById('Phone_btn');
	Phone.style.backgroundColor='white';
	Phone.style.color='black';
	Phone.innerHTML = '<?php if(GetPhone() != '') echo GetPhone(); else echo 'NIL';?>';
}

	$(document).ready(function()
{
	$("#formProvider").submit(function()
	{
		if($('#subject').val() == ''){
			alert("Please enter subject");
			
			return false;
		}
		if($('#name').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if ($('#email').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#comment').val() == ''){
			alert("Please enter your message");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass('alert-error alert-success').addClass('alert-info').html('Sending message....').show();
		//check the username exists or not from ajax
		$.post("<?php echo SITE_URL;?>tools/send.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),address:$('#address').val(),title:$('#course').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your message has been sent!').removeClass('alert-info').addClass('alert-success').fadeTo(900,1);
			  $('#name').val("");
			  $('#email').val("");
			  $('#comment').val("");
			  $('#title').val("");
			  $('#phone').val("");
			  $('#address').val("");
			   $('#securitycode').val("");
			   $('#subject').val("");
			   
			});
			setInterval(function(){$('#formProvider').fadeOut('slow', function(){
			$('#subscribe').fadeIn('slow');
			})},1000);
			
		  }
		  else if(data=='Security'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Invalid Security Code!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Error sending message!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
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
function CloseSub(){
	$('#mask').fadeOut('slow');
	$('#contact-wrapper2').fadeOut('slow');
}
</script>

</body>

</html>