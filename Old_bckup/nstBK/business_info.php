<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($business);
	while (list ($key, $val) = each ($business)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
if(isset($_GET['info']) && $_GET['info'] != ""){
	$result = MysqlSelectQuery("select * from businessinfo where business_id='".$_GET['info']."' and status=1");
	$rows = SqlArrays($result);
	$result2 = MysqlSelectQuery("select * from logos where user_id='".$rows['user_id']."'"); 
	
	if($rows['website'] == "") $check_website = 'No Website'; else $check_website = '<a href="'.$rows['website'].'" target="_blank" class="button" rel="nofollow" style="font-size:12px;" onclick="trackOutboundLink(\''.$rows['website'].'\')" >Visit Website</a>';
	
	
	$cat =  MysqlSelectQuery("select * from categories where category_id = '".$rows['specialization']."'");

	$rows_cat = SqlArrays($cat);
	 
	 
	 
	
if(NUM_ROWS($result2) == 0){
	$image = SITE_URL."images/no_icon.gif";
}
else{
	$rows_logo = SqlArrays($result2);
	$image = SITE_URL."premium/logos/thumbs/".$rows_logo['logos'];
}
	$opt = array (
	'address' => urlencode($rows['address']),
	'sensor'  => 'false'
);

// now simply call the function
//$geolocation = getLatLng($opt);

function getCoordinatesFromAddress( $sQuery)
{
	@$sURL = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($sQuery).'&sensor=false';
	@$sData = file_get_contents($sURL);
	
	return json_decode($sData);
}

@$res = getCoordinatesFromAddress($rows['address']);
@$lat = $res->results[0]->geometry->location->lat;
@$long = $res->results[0]->geometry->location->lng;
}

// if status was successful, then print the lat/lon ?

$advert = "Training Providers";
function FormatSrting($stringVal,$int){
	$string = strip_tags($stringVal);
	$string = substr($string,0,$int);
	 return $string ;
}
switch ($rows['business_type']){
		case 'Training':
		$biz_type = 'Training Provider';
		break;
		case 'Suppliers':
		$biz_type = 'Equipment Suppliers';
		break;
		case 'Managers':
		$biz_type = 'Event Managers';
		break;
		case 'Venue':
		$biz_type = 'Venue Provider';
		break;
		default:
		$biz_type ='';
}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title><?php echo $rows['business_name'];?> - Nigerian Seminars and Trainings</title>
<meta name="description" content="<?php echo FormatSrting($rows['description'],145);?>-<?php echo $rows['business_id'];?>" />
<meta property="og:image" content="<?php if($rows['premium'] == 3 || $rows['premium'] == 2){ echo $image; } else {echo SITE_URL.'images/facebookIMG.png';}?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>


   <meta name="dcterms.description" content="<?php echo FormatSrting($rows['description'],145);?>-<?php echo $rows['business_id'];?>" />

<meta property="og:title" content="<?php echo $rows['business_name'];?> | Nigerian Seminars and Trainings" />

<meta property="og:description" content="<?php echo FormatSrting($rows['description'],145);?>-<?php echo $rows['business_id'];?>" />

<meta property="twitter:title" content="<?php echo $rows['business_name'];?> | Nigerian Seminars and Trainings" />

<meta property="twitter:description" content="<?php echo FormatSrting($rows['description'],145);?>-<?php echo $rows['business_id'];?>" />

  <link rel="stylesheet" type="text/css"  href="<?php echo SITE_URL;?>premium/css/prettyphoto.css">
  
 <!-- <link rel="stylesheet" type="text/css"  href="css/all-css.css" />-->

   <?php include("scripts/headers_new.php");?>
   
  <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-1.4.2.min.js"></script> 
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.prettyphoto.js"></script> 
     <script type="text/javascript" src="https://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&sensor=true"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.gmap-1.0.3-min.js"></script>

	  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>



<?php include('tools/analytics.php');?>



  <script  type="text/javascript">
  
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
	
});

  
  
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
		else if ($('#emailfield').val() == ''){
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
		$.post("<?php echo SITE_URL;?>tools/send.php",{ name:$('#name').val(),email:$('#emailfield').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),address:$('#address').val(),title:$('#course').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
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
			});
			//setInterval(function(){$('#contact-wrapper2').fadeOut('slow')},3000);
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

</script>
<script type="text/javascript">
$(document).ready(function(e) {
	
	
	/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#tsearch').keyup(function(){
			$('#output_providers').fadeIn('slow');
			$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'All'}, function(data) {
				
				$('#output_providers').html(data)
			
			
		});
	})
	//disappears the training providers when the text box looses focus
	$('#tsearch').blur(function(){
		$('#output_providers').fadeOut();
		
	})
	//displays the training providers when the text box gains focus
		$('#tsearch').focus(function(){
			$('#output_providers').fadeIn('slow');
			$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
			if($(this).val() == ""){
			$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {queryFocus:$(this).val(),type:'All'}, function(data) {
				
				$('#output_providers').html(data)

			
		});
			}
			else{
				$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'All'}, function(data) {
				
				$('#output_providers').html(data)
			
			
		});
			}
	})
	
	
});
//funtion to retrieve the value from the training providers drop down
	function GetProVal(elem){
		var URL = $('#'+elem).attr('data');
				
		$('#tsearch').val($('#'+elem).text());
		$('#output_providers').hide();
		
		$('#searchProvider').attr('action',URL)
	

			}
</script>

<script type="text/javascript">

function ShowBox(){
	$('#contact-wrapper2').toggle('slow'); 
}

function showEmail(){
	var emailele = document.getElementById('email')
	
	emailele.innerHTML = '<?php echo '<a href="mailto:'.str_replace('@','&#64;',$rows['email']).'">Email Business</a>';?>';
}
function showWeb(){
	var Web = document.getElementById('website')

	Web.innerHTML = '<?php if($rows['website'] != '') echo $rows['website']; else echo 'NIL';?>';
}

function showPhone(){
	var Phone = document.getElementById('Phone1');
	
	Phone.innerHTML = '<?php if($rows['telephone'] != '') echo $rows['telephone']; else echo 'NIL';?>';
}
                  </script>
                  
                  <style type="text/css">
<!--
.TrainingProvider .trainingProviders span li {
	margin-left: 5px;
	padding-left: 5px;
	list-style-position: inside;
}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
  
.window {
  position:fixed;
  left:0;
  top:0;
  width:500px; 
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
.form_content{
	background-color:#FFF;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	display: block;
	float: left;
}
-->
</style>

	
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
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

<div class="searchSite smart-forms " >

<div class="basic ProviderSearch">


  <div class="smart-widget sm-right smr-80">
    <form action="" method="post" id="searchProvider">
                            <label class="field prepend-icon">
                                <input type="text" name="sub2" id="tsearch" class="gui-input" placeholder="Search for training providers">
                                 <span id="output_providers"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
                                <label for="s" class="field-icon"><i class="fa fa-search"></i></label> 
                            </label>
                            <button type="submit" class="button"> Search </button>
                            </form>
                        </div>

<div class="clearfix"></div>

</div>

<div class="clearfix"></div>
</div>

<div id="main">
	
	<div id="content">
     <?php 
	/*
	 if($rows['premium'] == 3 || $rows['premium'] == 2){
	 $width = 'style="width:930px;"';
	 } 
	   else{*/
	 ?>
    <?php include("tools/categories_new.php");?>
      <?php
		    /* $width = '';
	   }*/
	    ?>
		<div id="content_left">
        
      <div class="event_table_inner smart-forms">

<form action="" method="post">
<table width="100%" border="0">
  
  <tr>
    <td width="20%" rowspan="2" align="center" style="padding-left:8px">
      <?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
					             <img src="<?php echo $image;?>" width="90" height="90" alt="<?php echo $rows['business_name'];?>" class="articleImg shadow " />					             <?php }?>
                                  </td>
    <td height="93" colspan="3" align="center"><h2 style="font-size:25px; text-align:center; "><p><?php echo $rows['business_name'];?></p></h2>
      
    </td>
    </tr>
  <tr>
    <td width="29%" align="right" style="padding-right:5px;"> <a href="#contact-wrapper2" name="modal" class="button" >Contact Business</a></td>
                 
    <td width="30%" align="left" style="padding-left:5px;"><?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
      <a href="<?php echo SITE_URL;?>courses/business/<?php echo $rows['business_id'].'-'.str_replace($title_link,"-",$rows['business_name']);?>" class="button" style="font-size:12px;">Courses by this Business</a>
      <?php } ?></td>
    <td width="21%" align="left" style="padding-left:5px;"><span style="padding-right:5px;">
      <?php  if($rows['premium'] == 3 || $rows['premium'] == 2)echo $check_website;?>
    </span></td>
    </tr>
  </table>
</form>
</div>
<div class="TrainingProvider">
                <div class="infoBox">
                 
                       <div class="innerHeading">
                       <p>Business Type</p>
                       <span ><?php echo $biz_type ;?></span></div>
                        <div class="innerHeading">
                 <p>Email</p>
                        <span id="email" onclick="showEmail()" style="cursor:pointer; font-size:12px; text-decoration:underline;">click to view email address</span></div>
                       <div class="innerHeading last">
                       <p>Telephone</p>
                       <span id="Phone1" onclick="showPhone()" style="cursor:pointer; font-size:12px;text-decoration:underline;">click to view phone number</span>
                       </div>
                        
                    </div>
                    <div class="infoBox" style="float:right;">
                    
                    <div class="innerHeading">
                       <p>Specialization</p>
                       <span ><?php echo $rows_cat['category_name'];?></span></div>
                        <div class="innerHeading">
                 <p>Contact Person</p>
                       <span><?php echo $rows['contact_person'];?></span></div>
                       <div class="innerHeading last">
                       <p>Website</p>
                        <span id="website" onclick="showWeb()" style="cursor:pointer; font-size:12px; text-decoration:underline;">click to view URL</span>
                       </div>
                    
                    </div>
                  <div class="innerHeading">
                 <p>Address</p>
                       <span style="height:auto;"><?php echo $rows['address']?></span></div>
                       
                
                <?php if($rows['business_type'] != 'Training'){;?>
                       
                       <div class="innerHeading" style="width:99%; margin-right:0px; padding-right:0px;">
                 <p>Size</p>
                       <span><?php echo $rows['size'];?></span></div>
                       
                       <div class="innerHeading" style="width:99%; margin-right:0px; padding-right:0px;">
                 <p>Capacity</p>
                       <span><?php echo $rows['capacity'];?></span></div>
                       <?php }?>
                       
                        <div class="trainingProviders">
                       <p><strong>Business Description</strong></p>
                       <span class="description"><?php echo stripslashes($rows['description']);?></span>
                      
</div> 
	<?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
<div class="trainingProviders">
                       <p><strong>Business Images</strong></p>
                       <span style="padding-left:20px;">
                  <?php
			$images = MysqlSelectQuery("select * from pictures where user_id='".$rows['user_id']."'");
				if(NUM_ROWS($images) > 0){

					while($rows_pic = SqlArrays($images)){

						?>

				  <div class="gallery" id="<?php echo $rows_pic['image_id'];?>">
                  <a href="<?php echo SITE_URL;?>premium/images/<?php echo $rows_pic['images'];?>" rel="prettyPhoto[web]"><img  class="img_mix" src="<?php echo SITE_URL;?>premium/images/<?php echo $rows_pic['images'];?>" width="90" height="90" alt="<?php echo $rows['business_name'];?>" /></a>
                  </div>


  <?php
		}

			}

   else{

   echo '<div class="smart-forms"><div class="alert notification alert-info">No images for this business</div></div>';

   }

					 ?>
<div class="clearfix"></div>
               </div>
              <script type="text/javascript">
$(function() {
    $("#map_canvas").gMap
	({ controls: false,
	   scrollwheel: false,
	   markers: [{ latitude:	<?php echo $lat;?>,
                   longitude: <?php echo $long;?>,
				    html: "<?php echo $rows['address'];?>",
                              popup: true }],
	   zoom: 15   
	});
});
</script>
     
				
                    
              <div class="trainingProviders">
                       <p><strong>Our Location</strong></p>
                       <span id="map_canvas" style="width: 98%; height: 220px">
				
                </span>
                      
</div>
                    
                    <?php
					 }
					 ?>
               
<div class="infoBox" style="float:left;">
<div class="innerHeading smart-forms" style="float:right; margin-right:0px; margin-top:8px; ">
                       <?php if($rows['premium'] == 0 ) echo $check_website;?></div>
</div>
<div class="infoBox" style="float:right;">
<div class="innerHeading smart-forms" style="float:right; margin-right:0px; margin-top:8px; ">
                        <a href="#contact-wrapper2" name="modal" class="button btn-primary">Contact Business</a></div>
</div>
                      
</div>




                       <div class="clearfix"></div>
                       
			
		
<div id="tab_slider">
		<div id="subpage" >
                
                
					<div id="mask"></div>
				<div id="contact-wrapper2" style="float:left;" class="window boxContent"> 
    
    <form id="formProvider" name="form1" method="post" action="" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;">Contact Business</strong>
                   
                    </div>
                    <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgbox">
                            
                                                              
                        </div>
<table class="contact_provider_table">
<tr>
 
<td width="85%">
   <label class="field">
                                    <input type="text" name="subject" id="subject" class="gui-input" placeholder="Subject" required >
                                </label>
</td></tr>
<tr>
 
<td>  <label class="field prepend-icon">
                                    <input type="text" name="name" id="name" class="gui-input" placeholder="Name" required>
                                    <label for="firstname" class="field-icon"><i class="fa fa-user"></i></label>  
                                </label></td></tr>
<tr>

<td><label class="field prepend-icon">
                                    <input type="email" name="email" id="emailfield" class="gui-input" placeholder="Email" required>
                                    <label for="email" class="field-icon"><i class="fa fa-envelope"></i></label>  
                                </label>
</td></tr>
<tr>

  <td>  <label class="field prepend-icon">
                                    <input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone" type="number" required >
                                    <label for="mobile" class="field-icon"><i class="fa fa-phone-square"></i></label>  
                                </label></td>
</tr>
<tr>

  <td>  <label class="field">
                                    <input type="text" name="address" id="address" class="gui-input" placeholder="Address">
                                    
                                </label></td>
</tr>
<tr>

  <td> <label class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="message" required ></textarea>
                            <label for="comment" class="field-icon"><i class="fa fa-comments"></i></label>
                            <span class="input-hint"> 
                            	<strong>Hint: </strong>Enter your enquiry / booking in this box. The training provider will contact you.</span>   
                        </label>
               </td>
</tr>
<tr>

  <td> <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
                            </label>
                            <label for="securitycode" class="button captcode">
                            	<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>
               </td>
</tr>
<tr>
  <td colspan="2" align="center" >
    <button class="button btn-primary" type="submit"> Send </button>
    <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',$rows['email']);?>" id="to" />
   <button class="button" id="closeBox"> Close </button></td>
  </tr>
</table> 
</form>
<div class="clearfix"></div>
</div>	
                    
                
                     <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php //echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
                    </div>
				</div><!-- end subpage -->
	</div>
		
		<?php include("tools/side-menu_new.php");?>
        <div class="clearfix"></div>
	</div>

	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>

<?php include ("tools/footer_new.php");?>

</body>
</html>