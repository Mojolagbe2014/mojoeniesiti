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

	<title>Subscribe: Nigerian Seminars and Trainings </title>
<meta name="description" content="Subscribe to Nigerian Seminars and Trainings to get the latest news and updates on events and learning opportunities around the world."/>
 
    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="Robots" content="INDEX,FOLLOW">
    <meta name="Revisit-after" content="3 Days">
		<link rel="stylesheet" href="https://www.nigerianseminarsandtrainings.com/css/cmxform.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="https://www.nigerianseminarsandtrainings.com/style.css" type="text/css" media="screen" />
	<?php include("scripts/headers.php");?>
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


<?php include("tools/header2.php");?>

<div id="main">
	
	<div id="content">
		<div id="content_left">
			
		<h3 class="categoryHeader">Subscribe to our Event notification / Newsletters </h3>
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper-inner" class="rounded">
                          <?php echo $message;?>
						    <p>Fill this form to subscribe to our newsletter to get regular updates on events and breaking news as we post them on the website. A confirmation message will be sent to the email address you provided. Please visit your inbox to activate your subscription.</p>
						    <form action="" method="post" id="contactform2">
						      <table width="100%" border="0">
						        <tr>
						          <td width="25%" align="right">Email: <span style="color:#F00"> *</span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="email_sub" type="text" class="input" id="email_sub" value="<?php echo $_SESSION['email_sub'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Firstname <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="fname" type="text" class="input" id="fname" value="<?php echo $_SESSION['fname'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Lastname: <span style="color:#F00"> *</span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="lname" type="text" class="input" id="lname" value="<?php echo $_SESSION['lname'];?>" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right">Username <span class="contact-left"> <span style="color:#F00"> *</span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="username" type="text" class="input" id="username" value="<?php echo $_SESSION['username'];?>" size="40" />
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
						            <input name="phone" type="text" class="input" id="phone" value="<?php echo $_SESSION['phone'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Organization / Place of work: <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="organization" type="text" class="input" id="organization"  value="<?php echo $_SESSION['organization'];?>" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">Designation:</td>
						          <td colspan="3"><span class="contact-left">
						            <input name="designation" type="text" class="input" id="designation"  value="<?php echo $_SESSION['designation'];?>" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right">Address: <span style="color:#F00"> * </span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="address" type="text" class="input" id="address" value="<?php echo $_SESSION['address'];?>" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">City: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="city" type="text" class="input" id="city" value="<?php echo $_SESSION['city'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">State: <span style="color:#F00"> * </span></span></td>
						          <td colspan="3"><span class="contact-left">
						            <input name="state" type="text" class="input" id="state" value="<?php echo $_SESSION['state'];?>" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Country: <span style="color:#F00"> * </span></span></td>
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
						          <td align="right"><span class="contact-left">Interetsted in:</span></td>
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
						          <td align="right">Verification</td>
						          <td colspan="2"><input name="verify" type="text"  class="input" id="verify" size="30" /></td>
						          <td> <span class="verification2"><?php echo $random;?></span>
                                  <span class="verification"><?php echo $random;?></span>
						            <input name="verifyHidden" type="hidden" value="<?php echo $random;?>" /></td>
					            </tr>
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td colspan="3"><span style="color:#F00">Note: Verification code is case "SENSITIVE"</span></td>
					            </tr>
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td colspan="3"><input name="submit_subscriber" type="submit" class="button_bg" value="Submit" /></td>
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