<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($business);
	while (list ($key, $val) = each ($business)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Add Business Info";
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


	<title>Upload Business Information: Nigerian Seminars and Trainings</title>
<meta name="description" content="Place your business above the line - Add your business to our extensive database on Nigerian Seminars and Trainings (free)"/>
	<link rel="stylesheet" href="css/cmxform.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    
	<?php include("scripts/headers.php");?>
    
   
 <script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactform2").validate({
			rules:{
				business_name: {
				required:true,
				minlength: 2
				},
				buz_type: {
				required:true,
				},
				email:{
					required: true,
					email:true
				},
				description:{
					required: true,
					minlength: 2
				},
				title:{
					required: true,
					minlength: 2
				},
				address:{
					required: true,
					minlength: 2
				},
				contact_person:{
					required: true,
					minlength: 2
				},
				telephone:{
					required: true,
					number: true
				},
				region:{
					required: true,
				},
				country:{
					required: true,
				},
				website:{
					url:true
				}
			
			},
			messages: {
			
			email: {
				required: "Please enter your email"
			},
			description:"Please enter event description",
			website:{
					url: "Enter valid url e.g (http://www.example.com)"
				}
		}
						
						
		});
	});

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
			<h3 class="categoryHeader">Upload Business Information</h3>
		
<div id="tab_slider">
				<div id="subpage">
					
		     <div id="subpage_content">
						 <?php echo $message;?>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						     <form action="" method="post" id="contactform2">
						       <table width="100%" border="0">
						         <tr>
						           <td width="21%" align="right">Busiess Name: <span style="color:#F00"> * </span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="business_name" type="text" class="input" id="business_name" value="<?php echo $_SESSION['business_name'];?>" size="40" />
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right">Business Type: <span style="color:#F00"> * </span></td>
						           <td colspan="2"><select name="buz_type" id="buz_type" class="input">
						             <option selected="selected"><?php echo $_SESSION['buz_type'];?></option>
						             <option value="Training">Training Provider</option>
						             <option value="Managers">Event Managers</option>
						             <option value="Suppliers">Event Equipment Supplier</option>
                                      <option value="Venue">Venue Provider</option>
						             </select></td>
					             </tr>
						         <tr>
						           <td align="right">Email: <span style="color:#F00"> * </span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="email" type="text" class="input" id="email" value="<?php echo $_SESSION['email'];?>" size="40" />
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right">Password</td>
						           <td colspan="2"><span class="contact-left">
						             <input name="password" type="password" class="input" id="password" size="40" />
						           </span></td>
					             </tr>
						         <tr>
						           <td align="right">Confirm Password</td>
						           <td colspan="2"><span class="contact-left">
						             <input name="password2" type="password" class="input" id="password2" size="40" />
						           </span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Description: <span style="color:#F00"> * </span></span></td>
						           <td colspan="2"><span class="contact-left">
					               <textarea name="description" rows="7" id="description" style="width: 350px;"><?php echo $_SESSION['description'];?></textarea>
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Address: <span style="color:#F00"> * </span></span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="address" type="text" class="input" id="address" value="<?php echo $_SESSION['address'];?>" size="40"/>
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Region: <span style="color:#F00"> *</span></span></td>
						           <td colspan="2"><select name="region" id="region" class="input" onchange="Get_Countries()">
						            <option value="" selected="selected">&nbsp;</option>
						            <option value="1">Africa</option>
						            <option value="2">Asia</option>
						            <option value="3">Europe</option>
						            <option value="4">N. America</option>
						            <option value="5">Oceania</option>
						            <option value="6">S. America</option>
					               </select></td>
					             </tr>
						         <tr>
						           <td align="right">Country:</td>
						           <td colspan="2"><div id="changeCountry">
                                   <select name="country" id="country" class="input" onchange="Get_State()">
					                </select></div></td>
					             </tr>
						         <tr>
						           <td align="right">State:</td>
						           <td colspan="2"><div id="changeState">
						            <select name="state" id="state" class="input" >
					                </select>
						            </div>
						            (For Nigeria only)</td>
					             </tr>
						         <tr>
						           <td align="right">Specialization: </td>
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
						            </select>
					                <span class="contact-left">(for training providers only)</span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Size:</span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="size" type="text" class="input" id="size" value="<?php echo $_SESSION['size'];?>" size="40" />
						             (for venue providers only)</span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Capacity</span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="capacity" type="text" class="input" id="capacity" value="<?php echo $_SESSION['capacity'];?>" size="40" />
						             (for venue providers only)</span></td>
					             </tr>
						         <tr>
						           <td align="right">Price</td>
						           <td colspan="2"><span class="contact-left">
						             <input name="price" type="text" class="input" id="price" value="<?php echo $_SESSION['price'];?>" size="40" />
						           (for venue providers only)</span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Contact Person: <span style="color:#F00"> * </span></span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="contact_person" type="text" class="input" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" size="40" />
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Telephone: <span style="color:#F00"> * </span></span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="telephone" type="text" class="input" id="telephone" value="<?php echo $_SESSION['telephone'];?>" size="40" />
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right"><span class="contact-left">Website:</span></td>
						           <td colspan="2"><span class="contact-left">
						             <input name="website" type="text" class="input" id="website" value="<?php echo $_SESSION['website'];?>" size="40" />
						             </span></td>
					             </tr>
						         <tr>
						           <td align="right">Verification </td>
						           <td width="38%"><input name="verify" type="text" class="input"  id="verify" size="30" /></td>
						           <td width="41%"> <span class="verification2"><?php echo $random;?></span>
                                  <span class="verification"><?php echo $random;?></span><br /></td>
					             </tr>
						         <tr>
						           <td align="right">&nbsp;</td>
						           <td colspan="2"><span style="color:#F00">Note: Verification code is case "SENSITIVE"</span></td>
					             </tr>
						         <tr>
						           <td align="right">&nbsp;</td>
						           <td colspan="2"><input name="submit_bizinfo" type="submit" class="button_bg" id="submit_bizinfo" value="Upload" /></td>
					             </tr>
					           </table>
					         </form>
                             
                            
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                    </div>
				</div><!-- end subpage -->
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