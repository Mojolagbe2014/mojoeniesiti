<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Add Event";
require_once("scripts/insertions.php");	
$random = random(8);

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
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Add Event: Nigerian Seminars and Trainings</title>

<meta name="description" content="Add your events - conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<?php include("scripts/headers.php");?>
    <script type="text/JavaScript" src="js/calender.js"></script>

<script type="text/javascript">

function InitXMLHttpRequest() {
     if (window.XMLHttpRequest) {
          req = new XMLHttpRequest();
     } else if (window.ActiveXObject) {
          req = new ActiveXObject("Microsoft.XMLHTTP");
     }
}
 var HttPRequest = false;
 
	   function Get_Countries() {
 
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
 
			var url = 'tools/countries.php';
			var Countries = document.getElementById("changeCountry");
			var region = document.getElementById("region");
			var pmeters = 'country='+region.value;
			
 
 
			HttPRequest.onreadystatechange = function()
			{
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
		//Countries.innerHTML= response;
				   document.getElementById("changeCountry").innerHTML = response;
				  }
				else // Loading Request
				  {
	Countries.innerHTML = '<img src="images/preloader.gif" width="20" height="20" />';
				  }
 
			}
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 }


/*function Get_Countries(){
	InitXMLHttpRequest()
	var url = 'tools/countries.php';
	var Countries = document.getElementById("country");
	var region = document.getElementById("region");
	var postData = 'country='+region.value;
if (req) {
 req.onreadystatechange = function() {
              if (req.readyState == 4) {
						Countries.innerHTML= req.responseText;
				
				}
				else if(req.responseText == 200){
					Countries.innerHTML='Ajax Error Please reload the page and try again';
				}

           else {
			   Countries.innerHTML='<option> Loading... </option>';
               }
          }
        req.open("POST", url, true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          req.send(postData);
          
     } 
	 else {
          //document.getElementById("response").innerHTML = 'Browser unable to create XMLHttp Object';
    	 }
}
*/
function Get_State(){
	InitXMLHttpRequest()
	var Countries = document.getElementById("country");
	//if(Countries.value == 38){
		var url = 'tools/countries.php';
	var state = document.getElementById("changeState");
	var postData = 'GetState='+Countries.value;
if (req) {
 req.onreadystatechange = function() {
              if (req.readyState == 4) {
						state.innerHTML= req.responseText;
				
				}
				else if(req.responseText == 200){
					state.innerHTML='Ajax Error Please reload the page and try again';
				}

           else {
			   state.innerHTML='<img src="images/preloader.gif" width="20" height="20" />';
               }
          }
        req.open("POST", url, true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          req.send(postData);
          
     } 
	 else {
          //document.getElementById("response").innerHTML = 'Browser unable to create XMLHttp Object';
    	 }
	//}
}

$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactform2").validate({
			rules:{
				name: {
				required:true,
				minlength: 2
				},
				email:{
					required: true,
					email:true
				},
				title:{
					required: true,
					minlength: 2
				},
				description:{
					required: true,
					minlength: 2
				},
				region:{
					required: true,
				},
				venue:{
					required: true,
					minlength: 2
				},
				category:{
					required: true,
					
				},
				country:{
					required: true,
					
				},
				organizer:{
					required: true,
					minlength: 2
				},
				start_date:{
					required: true,
					minlength: 2
				},
				end_date:{
					required: true,
					minlength: 2
				},
				website:{
					required: true,
					url: true
				},
				verify:{
					required: true,
				}
			},
			messages: {
			name: "Please enter your name",
			email: {
				required: "Please enter your email"
			},
			title: "Please enter event title",
			description:"Please enter event description",
			website:{
					required: "Please enter your web address",
					url: "Enter valid url e.g (http://www.example.com)"
				}
		}
						
		});
	});


</script>

    
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
			
		
<div id="tab_slider">
				<div id="subpage">
					<h3 class="categoryHeader">Upload Your Event (Free)</h3>
			  <div id="subpage_content">
						<?php echo $message;?>
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper-inner" class="rounded">
						    <form action="" method="post" id="contactform2">
						      <table width="100%" border="0">
						        <tr>
						          <td width="21%" align="right">Name: <span style="color:#F00"> * </span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="name" type="text" class="input" id="name" value="<?php echo $_SESSION['name'];?>" size="40" />
						            <br />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Email: <span style="color:#F00"> * </span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="email" type="text" class="input" id="email" value="<?php echo $_SESSION['email'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Phone No: </span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="phone" type="text" class="input" id="phone" value="<?php echo $_SESSION['phone'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Event Title: <span style="color:#F00"> * </span></span></td>
						          <td><span class="contact-left">
						            <input name="title" type="text" class="input" id="title" value="<?php echo $_SESSION['title'];?>" size="40" />
						            </span></td>
						          <td>&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right" valign="top"><span class="contact-left">Event Description: <span style="color:#F00"> * </span></span></td>
						          <td colspan="2"><span class="contact-left">
						            <textarea name="description" id="description" style="width: 350px; height: 100px;"><?php echo $_SESSION['description'];?></textarea>
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="top"><span class="contact-left">Event Venue: <span style="color:#F00"> * </span></span></td>
						          <td colspan="2"><span class="contact-left">
						            <textarea name="venue" id="venue" style="width: 350px; height: 100px;" class="input"><?php echo $_SESSION['venue'];?></textarea>
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Event Category: <span style="color:#F00"> * </span></td>
						          <td colspan="2"><select name="category" id="category" class="input">
						            <?php 
	if(connection());
	$result = MysqlSelectQuery("select * from categories order by category_name");?>
						            <option><?php echo $_SESSION['category'];?></option>
						            <?php while ($rows = SqlArrays($result)){?>
						            <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
						            <?php
		}
	?>
						            </select></td>
					            </tr>
						        <tr>
						          <td align="right">Region <span style="color:#F00"> * </span></td>
						          <td colspan="2"><select name="region" id="region" class="input" onchange="Get_Countries()">
						            <option value="">--- Select ---</option>
						            <option value="1">Africa</option>
						            <option value="2">Asia</option>
						            <option value="3">Europe</option>
						            <option value="4">N. America</option>
						            <option value="5">Oceania</option>
						            <option value="6">S. America</option>
						            </select></td>
					            </tr>
						        <tr>
						          <td align="right">Country <span style="color:#F00"> * </span></td>
						          <td colspan="2"><div id="changeCountry">
						            <select name="country" id="country" class="input" onchange="Get_State()">
					                </select>
						            </div></td>
					            </tr>
						        <tr >
						          <td align="right">State</td>
						          <td colspan="2"><div id="changeState">
						            <select name="state" id="state" class="input" >
					                </select>
						            </div>
						            (For Nigeria only)</td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Attendance Cost:</span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="cost" type="text" class="input" id="cost" value="<?php echo $_SESSION['cost'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Event Organizer: <span style="color:#F00"> * </span></span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="organizer" type="text" class="input" id="organizer" value="<?php echo $_SESSION['organizer'];?>" size="40" />
						            </span></td>
					            </tr>
                                <tr>
						          <td align="right"><span class="contact-left">Facilitator(s): </span></td>
						          <td colspan="2"><span class="contact-left">
					              <input name="facilitator" type="text" class="input" id="organizer" value="<?php echo $_SESSION['facilitator'];?>" size="40" />
						            </span><span style="color:#F00">Optional </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Start Date: <span style="color:#F00"> * </span></span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="start_date" type="text" class="input" id="start_date" style="width: 120px;" onclick="scwShow(this,event);" value="<?php echo $_SESSION['start_date'];?>" readonly="readonly" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">End Date: <span style="color:#F00"> * </span></span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="end_date" type="text" class="input" id="end_date" style="width: 120px;" onclick="scwShow(this,event);" value="<?php echo $_SESSION['end_date'];?>" readonly="readonly" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Event  url: <span style="color:#F00"> * </span></span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="website" type="text" class="input" id="website" value="<?php echo $_SESSION['website'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Tags</td>
						          <td><span class="contact-left">
						            <input name="tags" type="text" class="input" id="tags" value="<?php echo $_SESSION['tags'];?>" size="40" />
						          </span></td>
						          <td>&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right">Verification:</td>
						          <td width="38%"><input name="verify" type="text" class="input"  id="verify" size="30" /></td>
						          <td width="41%"> <span class="verification2"><?php echo $random;?></span>
                                  <span class="verification"><?php echo $random;?></span><br />
						            <input name="verifyHidden" type="hidden" value="<?php echo $random;?>" /><br />
                                    
                                    </td>
					            </tr>
						        <tr>
						          <td align="right"></td>
						          <td colspan="2"><span style="color:#F00">Note: Verification code is case "SENSITIVE"</span></td>
					            </tr>
						        <tr>
						          <td align="right"></td>
						          <td colspan="2"><input type="submit" value="Add Event" name="submit_event" class="button_bg" /></td>
					            </tr>
					          </table>
					        </form>
						    <div id="listingAJAX"></div>
					      </div>
						</div>
						
					</div>
                    
				</div>
               
                </div>
                <!-- end subpage -->
               <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	 <div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
     </div>
				<?php include("tools/categories.php");?>	
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