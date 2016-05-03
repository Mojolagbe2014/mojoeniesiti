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
	
	if($rows['website'] == "") $check_website = 'No Website'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
	
if(NUM_ROWS($result2) == 0){
	$image = SITE_URL."images/no_icon.gif";
}
else{
	$rows_logo = SqlArrays($result2);
	$image = SITE_URL."user/logos/thumbs/".$rows_logo['logos'];
}
	$opt = array (
	'address' => urlencode($rows['address']),
	'sensor'  => 'false'
);

// now simply call the function
//$geolocation = getLatLng($opt);

function getCoordinatesFromAddress( $sQuery)
{
	$sURL = 'http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($sQuery).'&sensor=false';
	$sData = file_get_contents($sURL);
	
	return json_decode($sData);
}

 $res = getCoordinatesFromAddress($rows['address']);
$lat = $res->results[0]->geometry->location->lat;
$long = $res->results[0]->geometry->location->lng;
}

// if status was successful, then print the lat/lon ?

$advert = "Training Providers";
function FormatSrting($stringVal,$int){
	$string = strip_tags($stringVal);
	$string = substr($string,0,$int);
	 return $string ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23693392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title><?php echo $rows['business_name'];?> | Nigerian Seminars and Trainings</title>
<meta name="description" content="<?php echo FormatSrting($rows['description'],145);?>-<?php echo $rows['business_id'];?>" />
<meta property="og:image" content="<?php if($rows['premium'] == 3 || $rows['premium'] == 2){ echo $image; } else {echo SITE_URL.'images/facebookIMG.png';}?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>

	<link rel="stylesheet" href="<?php echo SITE_URL;?>css/cmxform.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />
   <?php include("scripts/headers.php");?>
   
<script type="text/javascript" src="<?php echo SITE_URL_S;?>js/jquery-1.4.2.min.js"></script> 
     <script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&sensor=true"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.gmap-1.0.3-min.js"></script>

	  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>


<script type="text/javascript">

function ShowBox(){
	$('#contact-wrapper2').toggle('slow'); 
}

function showEmail(){
	var emailele = document.getElementById('emailShow')
	emailele.innerHTML = '<?php echo $rows['email'];?>';
}
function showWeb(){
	var Web = document.getElementById('webShow')
	Web.innerHTML = '<?php if($rows['website'] != '') echo $rows['website']; else echo 'NIL';?>';
}
function showPhone(){
	var Phone = document.getElementById('phoneShow')
	Phone.innerHTML = '<?php if($rows['telephone'] != '') echo $rows['telephone']; else echo 'NIL';?>';
}
                  </script>


<style>

 .pastSearch {
background: -webkit-gradient(linear, bottom, left 175px, from(#FFF3D5), to(#FFF9EA));
background: -moz-linear-gradient(bottom, #FFF3D5, #FFF9EA 175px);
margin:auto;
position:relative;
width:680px;



line-height: 24px;

text-decoration: none;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
padding:10px;
border: 1px solid #999;
border: inset 1px solid #333;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
margin-top:10px;
border-bottom:5px;
}
.buttonContact {
width:100px;
position:absolute;
right:20px;
bottom:20px;
background:#09C;
color:#fff;
font-family: Tahoma, Geneva, sans-serif;
height:30px;
-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;
border: 1p solid #999;
}

.buttonContact:hover {
background:#fff;
color:#09C;
}
.input    {
width:375px;
display:block;
border: 1px solid #999;
height: 25px;
padding-left:3px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.clearlines tr td{
	border:none;
	padding:5px;
}
.input1 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.input1 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
    .input2 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.input2 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.wide{
	height:150px;
}
.clickAction{
	border-radius:5px;
	padding:3px;
	background-color:#090;
	color:#FFF;
	font-size:11px;
	cursor:pointer;
}
.shadows{
	-moz-box-shadow: 3px 3px 4px #000;
-webkit-box-shadow: 3px 3px 4px #000;
box-shadow: 3px 3px 4px #000;
/* For IE 8 */
-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
/* For IE 5.5 - 7 */
filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');
width:100px; height:100px;
	
}
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

<?php include("tools/header2.php");?>
<div id="main">
	
	<div id="content">
		<div id="content_left">
			
		<h3 class="categoryHeader">Business Information </h3>
<div id="tab_slider">
				<div id="subpage">
					<div id="subpage_content">
					  
						 
					</div>
					<div id="subpage_content">
						 <?php echo $message;?>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						     <form action="" method="post" id="contactform2">
						       <table width="100%" border="0">
						         <tr>
						           <td width="20%"><strong>Busiess Name:</strong></td>
						           <td colspan="2"><span style="color:#090; font-size:14px; text-transform:capitalize;"><strong><?php echo $rows['business_name'];?></strong></span></td>
						           <td width="18%" rowspan="7" valign="top"><?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
					              <div class="shadows"> <img src="<?php echo $image;?>" width="100" height="100" alt="<?php echo $rows['business_name'];?>" />	</div>					             <?php }?></td>
					             </tr>
						         <tr>
						           <td><strong>Business Type:</strong></td>
						           <td colspan="2"><?php echo $rows['business_type'];?> </td>
					             </tr>
						         <tr>
						           <td><strong>Email:</strong></td>
						           <td colspan="2"><div id="emailShow"><span class="clickAction" id="clickAction" onclick="showEmail()">Click to show email</span></div></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Address:</span></strong></td>
						           <td colspan="2"><?php echo $rows['address'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Size:</span></strong></td>
						           <td colspan="2"><?php if($rows['size'] != '') echo $rows['size']; else echo 'NIL';?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Capacity</span></strong></td>
						           <td colspan="2"><?php if($rows['capacity'] != '') echo $rows['capacity']; else echo 'NIL';?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Contact Person:</span></strong></td>
						           <td colspan="2"><?php if($rows['contact_person'] != '') echo $rows['contact_person']; else echo 'NIL';?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Telephone:</span></strong></td>
						           <td colspan="2"><div id="phoneShow"><span class="clickAction" id="clickAction" onclick="showPhone()">Click to show telephone</span></div></td>
                                 </tr>
                                 
						         <tr>
						           <td><strong><span class="contact-left">Website:</span></strong></td>
						           <td width="46%"><div id="webShow"><span class="clickAction" id="clickAction" onclick="showWeb()">Click to show website</span></div></td>
						           <td width="46%">&nbsp;</td>
						           <td>&nbsp;</td>
                                   
					             </tr>
						         <tr>
						           <td>&nbsp;</td>
						           <td><?php  if($rows['premium'] == 3 || $rows['premium'] == 2){ echo $check_website;}?></td>
						           <td><a href="javascript:void(0);" onclick="ShowBox()" ><img src="<?php echo SITE_URL;?>images/contact_btn.png" width="132" height="28" /></a></td>
						           <td>&nbsp;</td>
					             </tr>
					           </table>
					         </form>
					       </div>
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
					<div id="contact-info">
                    <script  type="text/javascript">
$(document).ready(function()
{
	$("#login-form2").submit(function()
	{
		if($('#title').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if($('#name').val() == ''){
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
						 <div id="contact-wrapper2" class="rounded" style="display:none"> 

<form id="login-form2" name="form1" method="post" action="" class="pastSearch" >
<center><strong><span style="color:#0072BC; font-size:12px; ">Contact Business</span></strong></center>
<table width="41%"  class="clearlines">
<tr>
  <td width="37%" height="26"><strong><span style="color:#0072BC; font-size:12px">Subject:</span></strong></td>
<td width="5%">&nbsp;</td><td width="58%">
  <input name="title" type="text" class="input" id="title" />
</td></tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Name:</span></strong></td>
<td>&nbsp;</td>
<td> <input name="name" type="text" class="input" id="name" /></td></tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Email:</span></strong></td>
<td>&nbsp;</td>
<td><input name="email" type="text" class="input" id="email" />
</td></tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Phone:</span></strong></td>
  <td>&nbsp;</td>
  <td> <input name="phone" type="text" class="input" id="phone" /></td>
</tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Address:</span></strong></td>
  <td>&nbsp;</td>
  <td> <input name="address" type="text" class="input" id="address" /></td>
</tr>
<tr>
  <td valign="top"><strong><span style="color:#0072BC; font-size:12px">Message:</span></strong></td>
  <td>&nbsp;</td>
  <td> <textarea name="message" cols="45"  class="input wide" id="message"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td></td>
  <td><span id="msgbox" style="display:none;" ></span></td>
</tr>
<tr>
  <td><input name="to" type="hidden" value="<?php echo $rows['email'];?>" id="to" />
                 </td>
<td></td>
<td>
  <input  type="submit" class="buttonContact" name="button" id="button" value="Submit" />
</td></tr>

 

</table> 
</form>
</div>	     </div>
					</div>
                    
                    <div id="subpage_content">
						 <h2 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Business Description</h2>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded" style="line-height:20px; text-align:justify;">
						   <div class="description"><?php echo stripslashes($rows['description']);?></div>
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div> 
					<?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
                    <div id="subpage_content">
						 <h2 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Business Images</h2>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						    <div class="video_box">
                  <?php
			$images = MysqlSelectQuery("select * from pictures where user_id='".$rows['user_id']."'");
				if(NUM_ROWS($images) > 0){

					while($rows_pic = mysql_fetch_array($images)){

						?>

				  <div class="gallery" id="<?php echo $rows_pic['image_id'];?>"><a href="<?php echo SITE_URL;?>user/images/<?php echo $rows_pic['images'];?>" rel="prettyPhoto[web]"><img  class="img_mix" src="<?php echo SITE_URL;?>user/images/<?php echo $rows_pic['images'];?>" width="100" height="100" alt="<?php echo $rows['business_name'];?>" /></a></div>


  <?php
		}

			}

   else{

   echo errorMsg("found no images for this business");

   }

					 ?>

                </div>
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                     
                    <div id="subpage_content">
						<h2 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Our Location</h2>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						     <div id="map_canvas" style="width: 100%; height: 220px"></div>
					       </div>
					  </div>
						
					</div>
                    <?php
					 }
					 ?>
                     <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
                    </div>
				</div><!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu.php");?>
	</div>

	<div class="clearfix"></div>
</div>
	
	
	
</div>

</div>
<?php include ("tools/footer.php");?>
</body>
</html>