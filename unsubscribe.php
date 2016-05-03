<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
	if(connection());
$advert = "Add Business Info";
$msg = '<table width="100%" border="0" bgcolor="#FFFF00" class="smart-forms">
						         <tr>
						           <td align="center"><p style="font-size:15px; color:#060">You have decided to unsubscribe from our newsletter, please click on proceed to remove your address from our mailing list or close this page to cancel.</p></td>
					             </tr>
						         <tr>
						           <td align="left"><button name="proceed" type="submit" class="button btn-primary" id="proceed">Proceed? </button></td>
					             </tr>
					           </table>';
/*if(isset($_GET['user'])){
	$subscribers = MysqlSelectQuery("select email from subscribers where email='".$_GET['user']."'");
	$business = MysqlSelectQuery("select email from businessinfo where email='".$_GET['user']."'");
	if(NUM_ROWS($subscribers) == 0 || NUM_ROWS($business) == 0 ){
		header("location: ".SITE_URL);
	}
}
*/
if(isset($_POST['proceed'])){
	$subscribers = MysqlSelectQuery("select email from subscribers where email='".$_GET['user']."'");
	$business = MysqlSelectQuery("select email from businessinfo where email='".$_GET['user']."'");
	if(NUM_ROWS($subscribers) > 0){
		if(MysqlQuery("delete from subscribers where email='".$_GET['user']."'")){
		$msg ='<table width="100%" border="0" bgcolor="#00CC00">
						         <tr>
						           <td align="center"><p style="font-size:15px; color:#FFF">You have now been removed from our newsletters / mailing list</p></td>
					             </tr>
					           </table>';
		}
	}
	else if(NUM_ROWS($business) > 0){
		if(MysqlQuery("update businessinfo set mails=0 where email='".$_GET['user']."'")){
		$msg ='<table width="100%" border="0" bgcolor="#00CC00">
						         <tr>
						           <td align="center"><p style="font-size:15px; color:#FFF">You have now been removed from our newsletters / mailing list</p></td>
					             </tr>
					           </table>';
	}
}
	else{
		header("location: ".SITE_URL);exit;
	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Unsubscribe from newsletters  / mailing list : Nigerian Seminars and Trainings</title>
<meta name="description" content=""/>


    
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
    

      <?php include("tools/categories_new.php");?>
  
		<div id="content_left">
        
        <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Unsubscribe from newsletters / mailing list</h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	
		
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
						
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						     <form action="" method="post" id="contactform2">
						       
                               
                               <?php echo $msg;?>
					         </form>
					       </div>
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