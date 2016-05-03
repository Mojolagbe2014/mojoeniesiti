<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$id = "";
if(isset($_GET['tpID']) && isset($_GET['provider'])) {
	header("location: contact_business?evID=".$_GET['tpID'], true, 301);
	}
else if(isset($_GET['tpBID']) && isset($_GET['provider'])){
	header("location: contact_business?tpBID=".$_GET['tpBID'], true, 301);
}

$url ="";
$message = "";
	$random = random(8);
	
	$course = '';

$advert = "Event Detail";
//if (!strstr($url, "http://") == $url) {$url ="http://".$rows['website']; }

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
  $id = "";
  if(isset($_GET['evID'])) {
	$result = MysqlSelectQuery('SELECT event_title,email,organiser from events where event_id='.$_GET['evID']);
	$rows = SqlArrays($result);
	$course = 'Course Title: '.$rows['event_title'].'<br>';
	$provider = $rows['organiser'];
	$biz_email = $rows['email'];
	$id = $_GET['evID'];
}
  if(isset($_GET['tpBID'])) {
	$result = MysqlSelectQuery('SELECT business_name,email from businessinfo where business_id='.$_GET['tpBID']);
	$rows = SqlArrays($result);
	$provider = $rows['business_name'];
	$biz_email = $rows['email'];
	$id = $_GET['tpBID'];
}
  
if(isset($_POST['contact'])){

$title = $_POST['subject'];

$name = $_POST['name'];

$email = $_POST['email'];

$phone=$_POST['phone'];

$address=$_POST['address'];

$message = $_POST['message'];

$to_email = $_POST['to'];



if($title == '') {$message = '<p style="color:#F00; font-weight:bold;">Please enter a subject of the message </p>';}
else if($name == ''){ $message = '<p style="color:#F00; font-weight:bold;">Please enter your name</p>';}
else if($email == ''){ $message = '<p style="color:#F00; font-weight:bold;">Please enter your email</p>';}
else if($phone == '') {$message = '<p style="color:#F00; font-weight:bold;">Please enter your telephone number</p>';}
else if($address == ''){ $message = '<p style="color:#F00; font-weight:bold;">Please enter your contact address</p>';}
else if($message == '') {$message = '<p style="color:#F00; font-weight:bold;">Please enter your message</p>';}
else if($_POST['verify']!= $_POST['verifyHidden']) {$message = '<p style="color:#F00; font-weight:bold;">Invalid verification code</p>';}
else{
// Add Email Address
$headers ="From: ".$name."<".$email."> \r\n";
$headers .= "Reply-To: ".$email." \r\n";
$headers .= "Cc:info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";

$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

$to = $to_email;
$subject = $title;
$msg = $course." Name: ".$name."<br>"."Email: ".$email."<br>"."Phone: ".$phone."<br>"."Address: ".$address."<br>".$message.'<br><br><br>You are receiving this message courtesy of <a href="https://www.nigerianseminarsandtrainings.com">Nigerian Seminars and Trainings.com</a><br>
<br>Our service offerings:<br><ul><li><a href="https://www.nigerianseminarsandtrainings.com/add_event">Free course listing</a></li>
           <li> <a href="https://www.nigerianseminarsandtrainings.com/biz_info">Free business listing</a></li>
		   <li><a href="https://www.nigerianseminarsandtrainings.com/premium_listing">Premium course/business listing</a> (paid service)</li>
		   <li><a href="https://www.nigerianseminarsandtrainings.com/advertise">Banner advert placement</a> (paid service)</li>
		   <li>Free training search - we help prospective trainees search for courses / training providers free.</li></ul>
		   <br><p>Take advantage of any of our free or paid services. You’d be glad you did!<br>
		   For enquiries, please contact:<a href="mailto:admin@nigerianseminarsandtrainings.com">admin@nigerianseminarsandtrainings.com</a></p><br><p style="color:#F00; font-style:italic; font-size:12px";>Nigerian Seminars and Trainings.com – <br /> Nigeria’s Apex Training Portal</p>';

	if(@mail($to, $subject, $msg, $headers)){
		$message = '<p style="color:#090; font-weight:bold;">Your message was sent successfuly!</p>';
		}
		else{
			$message = '<p style="color:#F00; font-weight:bold;">Sorry there was an error sending the message, please try again later </p>';
		}
	}
}
?>
<!DOCTYPE html >
<html lang="en">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
 
<!-- Website Title --> 
<title>Contact : <?php echo $provider." : ".$id ;?></title>

<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/custom.js"></script>


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
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="Alexa" /></noscript>
<!-- End Alexa Certify Javascript -->
</head>
<body>
	<!-- Begin page wrapper -->
	<div id="wrapper">
		
<?php include("script/header_file.php"); ?>
		
		
		<div id="content_wrapper">
		  <div class="inner">
			<div id="content" class="rounded">
          <h1 class="title">Contact : <?php echo $provider ;?></h1>
                <form action="" method="post">
                <table width="100%" >
                    <?php 
					
					
						//if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
						?>
  <tr>
    <td colspan="5" align="center"><?php echo $message;?>
    </td>
    </tr>
  <tr>
    <td width="11%" align="right"><span style="color:#090; font-size:11px"><strong>Subject:</strong></span></td>
    <td colspan="4"><input name="subject" type="text" class="input" id="subject" /></td>
    </tr>
  <tr>
    <td align="right"><span style="color:#090; font-size:11px"><strong>Name:</strong></span></td>
    <td colspan="4"><input name="name" type="text" class="input" id="name" /></td>
    </tr>
  <tr>
    <td align="right" valign="top"><span style="color:#090; font-size:11px"><strong>Email:</strong></span></td>
    <td colspan="4" valign="top" style="color:#666;"><input name="email" type="text" class="input" id="email" /></td>
    </tr>
  <tr>
    <td align="right"><span style="color:#090; font-size:11px"><strong>Phone No:</strong></span></td>
    <td colspan="4" style="color:#666;"><input name="phone" type="text" class="input" id="phone" /></td>
    </tr>
  <tr>
    <td align="right"><strong><span style="font-size: 11px; color: #090">Contact Address:</span></strong></td>
    <td colspan="4"><input name="address" type="text" class="input" id="address" /></td>
  </tr>
  
  <tr>
    <td align="right"><span style="color:#090; font-size:11px"><strong>Message:</strong></span></td>
    <td colspan="4"><span style="color:#666;">
      <textarea name="message" cols="45" rows="5" class="input" id="message" style="width:90%; height:120px;"></textarea>
    </span></td>
  </tr>
  <tr>
    <td align="right" style="color:#666;"><span style="color:#090; font-size:11px"><strong>Verification:</strong></span></td>
    <td style="color:#666;"><input name="verify" type="text" class="input"  id="verify" size="30" /></td>
    <td style="color:#666;"><span class="verification"><?php echo $random;?></span>
						            <input name="verifyHidden" type="hidden" value="<?php echo $random;?>" /></td>
    <td style="color:#666;">&nbsp;</td>
    <td style="color:#666;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#666;"> <input name="to" type="hidden" value="<?php echo $biz_email;?>" id="to" /></td>
    
    <td style="color:#666;"><span class="st_plusone_vcount">
      <input type="submit" name="contact" id="button" value="Submit " />
    </span></td>
    <td style="color:#666;">&nbsp;</td>
    <td style="color:#666;">&nbsp;</td>
    <td style="color:#666;">&nbsp;</td>
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
			</div>
		</div>
	</div>
	<div id="content_wrapper2">
	  <div class="inner">
	    <?php
				include("script/footer_menu.php");
				?>
      </div>
</div>
	<!-- End page wrapper -->
	
</body>

</html>