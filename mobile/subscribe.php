<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
if(connection());
reset ($subscribers);
	while (list ($key, $val) = each ($subscribers)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	$random = random(8);
	
if(isset($_POST['submit_subscriber'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$subscribers[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	$check = MysqlSelectQuery("select email from subscribers where email='".$_SESSION['email_sub']."'");
	if($_SESSION['email_sub'] == "")$message = '<div class="error">Please enter your email address</div>';
	else if(!smcf_validate_email($_SESSION['email_sub']))$message = '<div class="error">Please enter a valid email address</div>';
	else if($_SESSION['fname'] == "")$message = '<div class="error">Please your firstname</div>';
	else if($_SESSION['lname'] == "")$message = '<div class="error">Please enter your lastname</div>';
	else if(!is_numeric($_SESSION['phone']))$message = '<div class="error">Please enter a valid telephone number</div>';
	else if($_SESSION['organization'] == "")$message = '<div class="error">Please enter your organization</div>';
	else if($_SESSION['address'] == "")$message = '<div class="error">Please enter your address</div>';
	else if($_SESSION['city'] == "")$message = '<div class="error">Please enter your city</div>';
	else if($_SESSION['state'] == "")$message = '<div class="error">Please enter your state</div>';
	else if($_SESSION['country'] == "")$message = '<div class="error">Please select your country</div>';
else if($_SESSION['category'] == "")$message = '<div class="error">Please select category your interested in</div>';
else if(strtolower($subscribers['verify'])!= strtolower($subscribers['verifyHidden'])) {
    $message = '<div class="error">Invalid verification code</div>';
  			}
			else if(NUM_ROWS($check) > 0){$message = '<div class="error">Email already exists!</div>';}
	else
	if(connection()){
	if(MysqlQuery("insert into subscribers (email,fname,lname,phone,organization,country,city,state,address,category,sex)
										  values('".$_SESSION['email_sub']."','".$_SESSION['fname']."','".$_SESSION['lname']."','".
											$_SESSION['phone']."','".$_SESSION['organization']."','".$_SESSION['country']."','".
											$_SESSION['city']."','".$_SESSION['state']."','".
											$_SESSION['address']."','".$_SESSION['category']."','".$_POST['sex']."')")){
		reset ($vacancies);
	while (list ($key, $val) = each ($vacancies)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	$id = mysql_insert_id();
	$to = $_SESSION['email_sub'];
	$hashId = md5($id);
	$subject = "Confirm your subscription";
	$message = "<p>Dear ".$_SESSION['fname']." ".$_SESSION['lname'].",<br \> Thank you for your subscription. Please click on the link below to confirm your subscription.</p>";
	$message .= "<p>http://www.nigerianseminarsandtrainings.com/confirmation?type=email&g=$id&user=$hashId</p>";
	SendHtmlEmails($to,$subject,$message);
	unset($_SESSION['email_sub']);
	unset($_SESSION['fname']);
	unset($_SESSION['lname']);
	unset($_SESSION['phone']);
	unset($_SESSION['organization']);
	unset($_SESSION['description']);
	unset($_SESSION['country']);
	unset($_SESSION['city']);
	unset($_SESSION['state']);
	unset($_SESSION['address']);
	unset($_SESSION['category']);
	unset($_SESSION['sex']);
	header("location: confirmation?type=subscriber");
			}
		}
}

//  Copyright 2009 Google Inc. All Rights Reserved.
  /*$GA_ACCOUNT = "MO-38908551-1";
  $GA_PIXEL = "ga.php";

  function googleAnalyticsGetImageUrl() {
    global $GA_ACCOUNT, $GA_PIXEL;
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);

    $referer = $_SERVER["HTTP_REFERER"];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];

    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);

    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }

    $url .= "&guid=ON";

    return $url;
  }*/
?>
<!DOCTYPE html >
<html lang="en">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
 
<!-- Website Title --> 
<title>Subscribe - Nigerian Seminars and Trainings.com</title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-23693392-1', 'auto');
  ga('send', 'pageview');

</script>

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
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none"  alt="Alexa Tracker" /></noscript>
<!-- End Alexa Certify Javascript -->

</head>
<body>

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
<?php include("script/header_file.php"); ?>
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                
                <h1 class="title">Subscribe</h1>
                <p>Fill this form to subscribe to our our newsletter to get regular updates on events and breaking news as we post them on the website. A confirmation message will be sent to the email address you provided. Please visit your inbox to activate your subscription.</p>
                <?php echo $message;?>
                <form action="" method="post">
                <table width="100%" border="0">
						        <tr>
						          <td width="17%" align="right" valign="middle">Email: <span style="color:#F00"> *</span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="email_sub" type="text" class="input" id="email_sub" value="<?php echo $_SESSION['email_sub'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle">Firstname <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="fname" type="text" class="input" id="fname" value="<?php echo $_SESSION['fname'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle"><span class="contact-left">Lastname: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="lname" type="text" class="input" id="lname" value="<?php echo $_SESSION['lname'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle">Sex:</td>
						          <td width="7%">
						            <input name="sex" type="radio" id="sex_0" value="Male" checked="checked" />
						            Male</td>
						          <td width="37%"><input type="radio" name="sex" value="Female" id="sex_1" />
						            Female</td>
						          <td width="39%">&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle"><span class="contact-left">Phone No: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="phone" type="text" class="input" id="phone" value="<?php echo $_SESSION['phone'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle">Organization / Place of work: <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="organization" type="text" class="input" id="organization"  value="<?php echo $_SESSION['organization'];?>" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle">Address: <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="address" type="text" class="input" id="address" value="<?php echo $_SESSION['address'];?>" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle"><span class="contact-left">City: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="city" type="text" class="input" id="city" value="<?php echo $_SESSION['city'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle"><span class="contact-left">State: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
					              <input name="state" type="text" class="input" id="state" value="<?php echo $_SESSION['state'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle"><span class="contact-left">Country: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><select name="country" id="country" class="input">
						            <option><?php echo $_SESSION['country'];?></option>
						            <?php if(connection());
	$result = MysqlSelectQuery("select * from countries order by countries");?>
						            <?php while ($rows = SqlArrays($result)){?>
						            <option value="<?php echo $rows['countries'];?>"><?php echo $rows['countries'];?></option>
						            <?php
		}
		?>
						            </select></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle"><span class="contact-left">Interetsted in:</span></td>
						          <td colspan="3"><select name="category" id="category" class="input">
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
						          <td align="right" valign="middle">Verification: <span style="color:#F00"> * </span></td>
						          <td colspan="2"><input name="verify" type="text"  class="input" id="verify" size="30" /></td>
						          <td><span class="verification"><?php echo $random;?></span>
						            <input name="verifyHidden" type="hidden" value="<?php echo $random;?>" /></td>
					            </tr>
						        <tr>
						          <td align="right" valign="middle">&nbsp;</td>
						          <td colspan="3"><input name="submit_subscriber" type="submit" class="button_bg" value="Submit" />
					                </td>
					            </tr>
					          </table>
                            </form>
                 <div class="search">
                <h1 class="title">Search Events</h1>
		      <form action="search" id="search_form" name="search_form" method="get">
		        <p>
		          <input type="text" id="query" name="query" title="Search" class="search"/><input type="submit" class="button_dark" value="Search"/>
	            </p>
	          </form>
              
	        </div>
            <br class="clear"/>
                </div>
                <?php
				include("script/footer_menu.php");
				?>
            
	</div>
	<!-- End page wrapper -->
	
</body>
</html>