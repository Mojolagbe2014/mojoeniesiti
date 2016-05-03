<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$suc_message = '';
if(connection());
switch($_GET['type']){
	case "event":
	$suc_message = successMsg("Your event has been uploaded, Your event will be displayed after it has been reviewed"); 
	break;
	case "business":
	$suc_message = successMsg("Your business has been uploaded, Your business information will be displayed after it has been reviewed"); 
	break;
	case "video":
	$suc_message = successMsg("Your video has been uploaded, Your video will be displayed after it has been reviewed"); 
	break;
	case "vacancy":
	$suc_message = successMsg("Your vacancy has been uploaded,  Your vacancy will be displayed after it has been reviewed"); 
	break;
	case "subscriber":
	$suc_message = successMsg("Thank your for subscribing to our newsletter, a confirmation email has been sent to your mailbox, please check you spam box if you don't get it in your Inbox."); 
	break;
	case "email":
	$result = MysqlQuery("update subscribers set confirm=1 where subscriber_id='".$_GET['g']."'");
	$suc_message = successMsg("Thank You. Your subscription has been verrified"); 
	if(isset($_SESSION['SubRedirectPath'])){
		//set login session
				$_SESSION['login_subcriber'] = true;
				$_SESSION['name'] = $_SESSION['fullname'];
				$_SESSION['user_id']= $_GET['g'];			
		 header("localhost: ".$_SESSION['SubRedirectPath']);
		 }
	break;
}
$advert = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Confirmation: Nigerian Seminars and Trainings </title>
	
	<!--<link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->
   <?php include("scripts/headers_new.php");?>
	
</head>

<body>
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
		<div id="content_left">
			
		<h3 class="categoryHeader">Confirmation</h3>
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">  
						  <div id="contact-wrapper-inner" class="rounded">
                          <?php echo $suc_message;?></div>
						 </div>
						 
						 <div id="contact-info">
						 
						 </div>
					</div>
                    </div>
				</div><!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>

</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>