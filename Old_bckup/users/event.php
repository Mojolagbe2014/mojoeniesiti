<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: ../login');
	exit;
}
if(connection());
reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}

$advert = "Add Event";
if(isset($_POST['submit_event'])){
	$result = MysqlselectQuery("select email from businessinfo where user_id='".$_SESSION['user_id']."'");
	$business_email = SqlArrays($result);
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$add_event[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	if($_SESSION['title'] == "")$message = errorMsg("Please enter event title");
	else if($_SESSION['description'] == "")$message = errorMsg("Please enter event description");
	//else if($_SESSION['facilitator'] == "")$message = errorMsg("Please enter event facilitator");
	else if($_SESSION['venue'] == "")$message = errorMsg("Please enter event venue");
	else if($_SESSION['category'] == "")$message = errorMsg("Please select event category");
	else if($_SESSION['country'] == "")$message = errorMsg("Please select country");
	else if($_POST['country'] == "38" && $_POST['state'] == "")$message = errorMsg("Please select state in Nigeria");
	
	else if($_SESSION['start_date'] == "")$message = errorMsg("Please select the start date");
	else if($_SESSION['end_date'] == "")$message = errorMsg("Please select end date");
	else if($_SESSION['website'] == "")$message = errorMsg("Please enter event website");
	else if(!isValidURL($_SESSION['website']))$message = errorMsg("Please enter a valid url");
	/*else if(isset($_POST['premium']) && $num > $_SESSION['space'])$message = errorMsg("You have reached the maximum number of premium listing for your account");*/
	
	else{
	if(connection()){
		//$date = date("F j, Y");
		$date = date("Y-m-d");
		$StartDate = $_SESSION['start_date'];

		$NewStartDate = date("Y-m-d", strtotime($StartDate));
		
	if(MysqlQuery("insert into events (email,phone,event_title,venue,description,facilitator,category,startDate,endDate,website,cost,organiser,posted_date,SortDate,country,state,user_id,makePremium,tags)
										  values('".$business_email['email']."','".$_SESSION['phone']."','".
											addslashes($_SESSION['title'])."','".addslashes($_SESSION['venue'])."','".addslashes($_SESSION['description'])."','".addslashes($_SESSION['facilitator'])."','".$_SESSION['category']."','".$_SESSION['start_date']."','".$_SESSION['end_date']."','".
											$_SESSION['website']."','".$_SESSION['cost']."','".$business_email['name']."','$date','$NewStartDate','".$_POST['country']."','".$_POST['state']."','".$_SESSION['user_id']."','".$_POST['premium']."','".addslashes($_SESSION['tags'])."')")){
											
		AdminNotificationMail($_SESSION['title'],$_SESSION['organizer'],$date);
		reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['title']);
	unset($_SESSION['venue']);
	unset($_SESSION['description']);
	unset($_SESSION['facilitaotr']);
	unset($_SESSION['website']);
	unset($_SESSION['cost']);
	unset($_SESSION['organizer']);
	header("location: event?stat=success");
			}
		}
	}
	
}
if(isset($_GET['stat'])){
	$message = successMsg("Event was added successfully");
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
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Add event: Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	
	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
    <?php include("../scripts/headers.php");?>
    <link rel="stylesheet" href="../css/cmxform.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script src="../js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="../js/calender.js"></script>
<script type="text/javascript" src="../admin/scripts/ckeditor/ckeditor.js"></script>
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
 
			var url = '../tools/countries.php';
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
		var url = '../tools/countries.php';
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
<?php include("../tools/header2.php");?>

<div id="main">
	<div id="content_bar">
		<div id="content_nav">
			<ul id="main_content_slider">
				<li><h3><a href="#" class="activeSlide">Add event</a></h3></li>
		  </ul>
		</div>
		<div id="search">
		  <h4 style="display:block; padding:5px 3px 3px 3px;"><?php echo "Welcome, ".$_SESSION['name'];?></h4>
		  <!--<form action="test.php" method="post">
                <input onblur="if(this.value == '') this.value='Search' ;" onfocus="if(this.value == 'Search') this.value='';" value="Search" type="text" />
            </form>-->
	  </div>
	</div>
	<div id="content">
		<div id="content_left">
			
		
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
						<?php echo $message;?>
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper-inner" class="rounded">
						    <form action="event" method="post" id="contactform2">
						      <table width="100%" border="0">
						        <tr>
						          <td width="21%" align="right"><span class="contact-left">Event Title: <span style="color:#F00"> * </span></span></td>
						          <td width="79%"><span class="contact-left">
						            <input name="title" type="text" class="input" id="title" value="<?php echo $_SESSION['title'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Phone No: </span></td>
						          <td><span class="contact-left">
						            <input name="phone" type="text" class="input" id="phone" value="<?php echo $_SESSION['phone'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="top"><span class="contact-left">Event Description: <span style="color:#F00"> * </span></span></td>
						          <td></td>
					            </tr>
						        <tr>
						          <td colspan="2" align="right" valign="top"><span class="contact-left">
						            <textarea name="description" id="description" style="width: width: 100%; height: 100px;"><?php echo $_SESSION['description'];?></textarea>
					              </span><script type="text/javascript">
		CKEDITOR.replace( 'description' );
			</script></td>
					            </tr>
                                 <tr>
						          <td align="right"><span class="contact-left">Facilitator(s):</span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="facilitator" type="text" class="input" id="organizer" value="<?php echo $_SESSION['facilitator'];?>" size="40" />
						            </span><span style="color:#F00">Optional </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="top"><span class="contact-left">Event Venue: <span style="color:#F00"> * </span></span></td>
						          <td><span class="contact-left">
						            <textarea name="venue" id="venue" style="width: 350px; height: 100px;" class="input"><?php echo $_SESSION['venue'];?></textarea>
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Event Category: <span style="color:#F00"> * </span></td>
						          <td><select name="category" id="category" class="input">
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
						          <td><select name="region" id="region" class="input" onchange="Get_Countries()">
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
						          <td><div id="changeCountry">
						            <select name="country" id="country" class="input" onchange="Get_State()">
					                </select>
						            </div></td>
					            </tr>
						        <tr >
						          <td align="right">State</td>
						          <td><div id="changeState">
						            <select name="state" id="state" class="input" >
					                </select>
						            </div>
						            (For Nigeria only)</td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Attendance Cost:</span></td>
						          <td><span class="contact-left">
						            <input name="cost" type="text" class="input" id="cost" value="<?php echo $_SESSION['cost'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Start Date: <span style="color:#F00"> * </span></span></td>
						          <td><span class="contact-left">
						            <input name="start_date" type="text" class="input" id="start_date" style="width: 120px;" onclick="scwShow(this,event);" value="<?php echo $_SESSION['start_date'];?>" readonly="readonly" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">End Date: <span style="color:#F00"> * </span></span></td>
						          <td><span class="contact-left">
						            <input name="end_date" type="text" class="input" id="end_date" style="width: 120px;" onclick="scwShow(this,event);" value="<?php echo $_SESSION['end_date'];?>" readonly="readonly" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Event  url: <span style="color:#F00"> * </span></span></td>
						          <td><span class="contact-left">
						            <input name="website" type="text" class="input" id="website" value="<?php echo $_SESSION['website'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Tags</td>
						          <td><span class="contact-left">
						            <input name="tags" type="text" class="input" id="tags" value="<?php echo $_SESSION['tags'];?>" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right"></td>
						          <td><label>
						            <input name="premium" type="checkbox" id="premium" value="1"  />
					              Make this event listed as premium</label></td>
					            </tr>
						        <tr>
						          <td align="right"></td>
						          <td><input type="submit" value="Add Event" name="submit_event" class="button_bg" /></td>
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
					
		</div>
		
		<?php include("../tools/side-menu.php");?>
	</div>
	<div id="content_bottom"></div>

	
	<div class="clearfix"></div>
</div>

	<?php include ("userstools/footer.php");?>
</div>

</div>
</body>
</html>