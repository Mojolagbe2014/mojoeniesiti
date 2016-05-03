<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
if(isset($_SESSION['loggedin'])){
header("location: user/profile");
}
$advert = "Advertise";
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
	<title>Login: Nigerian Seminars and Trainings.com </title>
<meta name="description" content="Login to Nigerian Seminars and Trainings to manage your business listing and events"/>
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
</head>

<body>

<?php include("tools/top-banner.php");?>
  <div id="main">
  <div id="content_bar">
		<div id="content_nav">
			<ul id="main_content_slider">
				<li><a href="#" class="activeSlide"><h4>Members Login</h4></a></li>
				
		  </ul>
		</div>
		<div id="search">
        <h4><?php echo date("j F Y, g:i a");?></h4>
			<!--<form action="test.php" method="post">
                <input onblur="if(this.value == '') this.value='Search' ;" onfocus="if(this.value == 'Search') this.value='';" value="Search" type="text" />
            </form>-->
		</div>
	</div>
	<div id="content">
		<div id="content_left">
			
		

				<div id="subpage">
					
					<div id="subpage_content">
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
                           <div class="login">
 <span id="msgbox" style="display:none"></span>
                             
			<form action="scripts/login.php" method="post" id="login-form2"> 
            <table width="100%" border="0">
  <tr>
    <td width="11%"><label>Email:</label></td>
    <td colspan="2"><input name="email" type="text" class="input" id="email" /></td>
    <td><h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Don't have an account?</h1></td>
  </tr>
  <tr>
    <td><label>Password:</label></td>
    <td colspan="2"><input name="password"  class="input" id="password" /></td>
    <td align="center"><a href="premium-listing" style="color:#039">Click here to sign-up to our premium platform now!</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="13%"><button name="submit">Sign In</button></td>
    <td width="40%"><a href="#">Forgot your password?</a></td>
    <td width="36%">&nbsp;</td>
  </tr>
</table>
			 
            </form>
            </div>
					       </div>
					  </div>
                    
						 <div id="contact-info">
						   
					     </div>
					</div>
			
					<div id="latest_content_items">
					
						<!-- Section 1 Featured -->
						<!-- End Featured 1 -->
				
					</div><!-- end latest_content_items -->
				</div>
                <div id="sub_links"><div id="sub_links2_middle"><?php 
 echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div></div><!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu.php");?>
	</div>
	<div id="content_bottom"></div>
    <div class="clearfix"></div>
</div>
	<?php include ("tools/footer.php");?>
    </div>
</div>
</div>
</body>
</html>