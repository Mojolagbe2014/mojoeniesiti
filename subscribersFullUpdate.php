<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($subscribers);
	while (list ($key, $val) = each ($subscribers)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Subscribers";
require_once("scripts/insertions.php");	
$random = random(8);


if(isset($_GET['vid'])){
	$getSubId = explode('-',$_GET['vid']);
	$id = $getSubId[1];
	
	
//$link = 'subscribersFullUpdate?token='.md5('test').'&md='.md5('php').'&route=email&vid='.random(10).'-'.$getSubId[1].'-'.random(15);
	}
	
	if(isset($_POST['update_subscriber'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$subscribers[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$subscribers[$key] = NULL;
		else
			$subscribers[$key] = addslashes($val);
	}
	 if($subscribers['fname'] == "")$message = errorMsg("Please your firstname");
	else if($subscribers['lname'] == "")$message = errorMsg("Please enter your lastname");
	else if($_POST['username'] == "")$message = errorMsg("Please enter your username");
	else if($_POST['password'] == "")$message = errorMsg("Please enter your password");
	else if($subscribers['phone'] == "")$message = errorMsg("Please enter a valid telephone number");
	else if($subscribers['organization'] == "")$message = errorMsg("Please enter your organization");
	else if($subscribers['address'] == "")$message = errorMsg("Please enter your address");
	else if($subscribers['city'] == "")$message = errorMsg("Please enter your city");
	else if($subscribers['state'] == "")$message = errorMsg("Please enter your state");
	else if($subscribers['country'] == "")$message = errorMsg("Please select your country");
else if($subscribers['category'] == "")$message = errorMsg("Please select category your interested in");
	else
	if(connection()){
	if(MysqlQuery("update subscribers set email='".$subscribers['email_sub']."',fname='".$subscribers['fname']."',lname='".$subscribers['lname']."',phone='".$subscribers['phone']."',organization='".$subscribers['organization']."',country='".$subscribers['country']."',city='".$subscribers['city']."',state='".$subscribers['state']."',address='".$subscribers['address']."',category='".$subscribers['category']."',sex='".$subscribers['sex']."',designation='".$subscribers['designation']."',username='".$_POST['username']."',password='".md5($_POST['password'])."' where subscriber_id='".$id."'")){
	
	$message = successMsg("Your infomation has been updated successfully!");
			}
		}
}

$query="select * from subscribers  WHERE  subscriber_id='".$id."'";
	
	$updateresult=mysql_query($query);
	$rowsSub=mysql_fetch_array($updateresult);

$categories = MysqlSelectQuery("select * from categories where category_id='".$rowsSub['category']."'");
						$rows_cat = SqlArrays($categories);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Subscribe to event updates on Nigerian seminars and trainings.com </title>
<meta name="description" content="Subscribe to Nigerian Seminars and Trainings.com to get the latest news and updates on events and learning opportunities around the world."/>
 
	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />
	<?php include("scripts/headers_new.php");?>
 <script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactform2").validate({
			rules:{
				fname: {
				required:true,
				minlength: 2
				},
				lname: {
				required:true,
				},
				country: {
				required:true,
				},
				category: {
				required:true,
				},
				state: {
				required:true,
				},
				city: {
				required:true,
				},
				organization:{
					required: true,
					minlength: 2
				},
				email_sub:{
					required: true,
					email:true
				},
				phone:{
					required: true,
					number: true
				},
				address:{
					required: true,
				},
				verify:{
					required: true,
				}
				
			}		
		});
	});

	</script>
	
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
        
        <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Update your subscription information</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				<div id="subpage">
					
					<div id="subpage_content">
						 <?php echo $message;?>
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper-inner" class="rounded">
                          
                         
					
                       
						    <form action="" method="post" id="contactform2">
						      <table width="100%" border="0">
						        <tr>
						          <td width="25%" align="right">Email: <span style="color:#F00"> *</span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="email_sub" type="text" disabled="disabled" class="input" id="email_sub" value="<?php echo $rowsSub['email'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Firstname <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="fname" type="text" class="input" id="fname" value="<?php echo $rowsSub['fname'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Lastname: <span style="color:#F00"> *</span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="lname" type="text" class="input" id="lname" value="<?php echo $rowsSub['lname'];?>" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right">Username <span class="contact-left"> <span style="color:#F00"> *</span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="username" type="text" class="input" id="username" value="<?php echo $rowsSub['username'];?>" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right">Password <span class="contact-left"> <span style="color:#F00"> *</span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="password" type="password" class="input" id="password" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right">Sex:</td>
						          <td width="12%"><label>
						            <input name="sex" type="radio" id="sex_0" value="Male" checked="checked" />
						            Male</label></td>
						          <td width="34%"><input type="radio" name="sex" value="Female" id="sex_1" />
						            Female</td>
						          <td width="29%">&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Phone No: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="phone" type="text" class="input" id="phone" value="<?php echo $rowsSub['phone'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Organization / Place of work: <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="organization" type="text" class="input" id="organization"  value="<?php echo $rowsSub['organization'];?>" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Designation:</td>
						          <td colspan="3"><span class="contact-left">
						            <input name="designation" type="text" class="input" id="designation"  value="<?php echo $rowsSub['designation'];?>" />
						          </span>(e.g: MD/CEO,Secretary e.t.c)</td>
					            </tr>
						        <tr>
						          <td align="right">Address: <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="address" type="text" class="input" id="address" value="<?php echo $rowsSub['address'];?>" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">City: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="city" type="text" class="input" id="city" value="<?php echo $rowsSub['city'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">State: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="state" type="text" class="input" id="state" value="<?php echo $rowsSub['state'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Country: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><select name="country" id="country" class="input">
						            <option><?php echo $rowsSub['country'];?></option>
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
						          <td align="right"><span class="contact-left">Interetsted in:</span></td>
						          <td colspan="3"><select name="category" id="category" class="input">
						            <?php 
	if(connection());
	$result = MysqlSelectQuery("select * from categories order by category_name");?>
						            <option><?php echo $rows_cat['category_name'];?></option>
						            <?php while ($rows = SqlArrays($result)){?>
						            <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
						            <?php
		}
	?>
						            </select></td>
					            </tr>
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td colspan="3"><input name="update_subscriber" type="submit" class="button_bg" value="Update" /></td>
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