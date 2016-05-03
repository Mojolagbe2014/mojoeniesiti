<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
if(isset($_SESSION['loggedin'])){
header("location: user/profile");
}
$advert = "Advertise";
$message = "";
if(isset($_GET['user']) && isset($_GET['path'])){
	$result = MysqlSelectQuery("select email from subscribers where email='".$_GET['user']."'");
	if(NUM_ROWS($result) == 0){
		header("location: ".SITE_URL."subscriber_login");
		
	}
}
else{
	header("location: ".SITE_URL."subscriber_login");
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
<link href="https://www.nigerianseminarsandtrainings.com/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Premium Account Password Reset: Nigerian Seminars and Trainings.com </title>
<meta name="description" content=""/>
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <?php include("scripts/headers_s.php");?>
    
    <style>

.validating{
	background-color:#FFF2C1;
	color:#FC0;
}
.error{
	background-color:#FFC4C4;
	color:#F00;
}
.ok{
	background-color:#C6FFE2;
	color:#0C0;
}
#msgComment{
	display:block;
	padding:5px;
	width:100%;
	text-align:center;
	margin-bottom:3px;
}
.forgotTable tr td{
	padding:3px;
}
.headerForm {
	font-size: 14px;
	font-weight: bold;
}
</style>
<script type="text/javascript">
				$(document).ready(function(){
					
					$('#login-form .button_bg').click(function(){
					if($('#new_pass').val() == ''){
						alert('Please enter a password!');
					}
					else if($('#new_pass').val() != $('#confirm_pass').val()){
						alert('Password mismatch!');
						$('#new_pass').val("");
						$('#confirm_pass').val("");
					}
					else{
					$('#msgComment').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL;?>tools/updatePasswordSubscribers.php",{email:$('#email').val(),password:$('#new_pass').val()} ,function(msg){
					if(msg == 'done'){
						$("#msgComment").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Update successfull, Redirecting.....').addClass('ok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='<?php echo SITE_URL_S;?>subscriber_login';
			  });
			  
			});
					}
					else {
						$("#msgComment").fadeTo(200,0.1,function() //start fading the messagebox

			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('sorry an error occured while processing your request! please try again').addClass('error').fadeTo(900,1);
			  $('#new_pass').val("");
						$('#confirm_pass').val("");
			});		
					}
					
					});
					}
						
						return false;
					})
				});
				
				function passwordStrength(password)
{
	var desc = new Array();
	desc[0] = "Very Weak";
	desc[1] = "Weak";
	desc[2] = "Better";
	desc[3] = "Medium";
	desc[4] = "Strong";
	desc[5] = "Strongest";

	var score   = 0;

	//if password bigger than 6 give 1 point
	if (password.length > 6) score++;

	//if password has both lower and uppercase characters give 1 point	
	if ( ( password.match(/[a-z]/) ) && ( password.match(/[A-Z]/) ) ) score++;

	//if password has at least one number give 1 point
	if (password.match(/\d+/)) score++;

	//if password has at least one special caracther give 1 point
	if ( password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score++;

	//if password bigger than 12 give another 1 point
	if (password.length > 12) score++;

	 document.getElementById("passwordDescription").innerHTML = desc[score];
	 document.getElementById("passwordStrength").className = "strength" + score;
}
</script>
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<?php include("tools/header2.php");?>

	
  <div id="main">
  <div id="content_bar">
		<div id="content_nav">
			<ul id="main_content_slider">
				<li><a href="#" class="activeSlide"><h4>Reset Password</h4></a></li>
				
		  </ul>
		</div>
		<div id="search2">
        
			<form action="<?php echo SITE_URL_S;?>content_search.php" method="get" id="search_site">
            <table  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><input name="query" type="text" id="query" onfocus="if(this.value == 'Search Site...') this.value='';" onblur="if(this.value == '') this.value='Search Site...' ;" value="Search Site..." /></td>
    <td align="right" valign="middle"><input type="submit" class="button" value="" /><input name="search" type="hidden" value="1" /></td>
  </tr>
</table>
           
	  </form>
		</div>
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
                          
			<form action="" method="post" id="login-form" > 
             <span id="msgComment"></span>
            <table width="100%" border="0">
						         
						         <tr>
						           <td width="15%" rowspan="3" align="right"><img src="images/keypass.png" width="69" height="98" /></td>
						           <td width="22%" align="right">New Password: <span style="color:#F00"> *</span></td>
						           <td width="63%"><span class="contact-left">
						             <input name="new_pass" type="password" class="input" id="new_pass" value="" size="30" onKeyUp="passwordStrength(this.value)" />
						           </span></td>
					             </tr>
						         <tr>
						           <td align="right">&nbsp;</td>
						           <td><div id="passwordDescription">Password not entered</div>
					               <div id="passwordStrength" class="strength0"></div></td>
		            </tr>
						         <tr>
						           <td align="right">Confirm Password: <span style="color:#F00"> *</span></td>
						           <td><span class="contact-left">
						             <input name="confirm_pass" type="password" class="input" id="confirm_pass" value="" size="30" onblur="CheckPassword()" />
						           </span></td>
					             </tr>
						         <tr>
						           <td colspan="2" align="right">&nbsp;<input name="email" type="hidden" value="<?php echo @$_GET['user'];?>"  id="email"  /></td>
						           <td><input name="update_password" type="submit" class="button_bg" id="submit_bizinfo" value="Update" /></td>
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
                <div id="sub_links"><div id="sub_links2_middle">
				<?php include("tools/categories.php");?>
				<?php 
 echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div></div><!-- end subpage -->
					
		</div>
		
		<?php include("tools/side-menu.php");?>
	</div>
	
    <div class="clearfix"></div>

	
    </div>
    <?php include ("tools/footer.php");?>
</body>
</html>