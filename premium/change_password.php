<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
	if(connection());
	if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: '.SITE_URL.'login');
	exit;
}
$errors = array();
$advert = "Add Business Info";
if(isset($_POST['update_password'])){
	
	$result = MysqlSelectQuery("select password from user_login where user_id='".$_SESSION['user_id']."'");
	$rows = SqlArrays($result);
	
	if($_POST['old_pass'] == "")$errors[] = "Enter your old password";
	if($_POST['new_pass'] == "")$errors[] = "Enter new password";
		if($_POST['confirm_pass'] == "")$errors[] = "Please confirm your new password";
		if($_POST['confirm_pass'] != $_POST['new_pass']) $errors[] = "Password mismatch!";
	if(md5($_POST['old_pass']) != $rows['password']) $errors[] = "Your old password is wrong";
	if(count($errors) > 0){
		$message = ErrorCall($errors);
	}
	else{
		$hashP = md5($_POST['new_pass']);
	if(MysqlQuery("update user_login set password='$hashP' where user_id='".$_SESSION['user_id']."'"))
		{	
			$_SESSION['update_password_info'] = '<p class="suc">Password was changed successfully</p>';
			header("Location: ".SITE_URL."premium/profile");
		}
	}
	
}

?>
<!DOCTYPE html >

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


	<title>Change Password: Nigerian Seminars and Trainings.com </title>
<meta name="description" content="Place your business above the line - Add your business to our extensive database (free) on Nigerian Seminars and Trainings.com."/>

	<!--	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->
   <?php include("../scripts/headers_new.php");?>

	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="../js/chili-1.7.pack.js"></script>
	<script type="text/javascript" src="../js/jquery.cycle.all.min.js"></script>
	<script type="text/javascript" src="../js/jquery.easing.1.1.1.js"></script>
	<script type="text/javascript" src="../js/jquery.colorbox.js"></script>
     <script src="../js/jquery.validate.js" type="text/javascript"></script>
     
     
     <script type="text/javascript">
	
		$(function() {
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
						
				$( "#contactform2" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
							
						rules:{
				old_pass: {
				required:true,
				minlength: 2
				},
				new_pass:{
										required: true,
										minlength: 6,
										maxlength: 16						
								},
								confirm_pass:{
										required: true,
										minlength: 6,
										maxlength: 16,						
										equalTo: '#new_pass'
								},
						},
						
						/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
								old_pass: {
										required: 'Enter your current password'
								},
								new_pass: {
										required: 'Enter your new password',
								},
								confirm_pass: {
										required: 'Please repeat the above password',
										equalTo: 'Password mismatch detected'
								}
						},

						/* @validation highlighting + error placement  
						---------------------------------------------------- */	
						
						highlight: function(element, errorClass, validClass) {
								$(element).closest('.field').addClass(errorClass).removeClass(validClass);
						},
						unhighlight: function(element, errorClass, validClass) {
								$(element).closest('.field').removeClass(errorClass).addClass(validClass);
						},
						errorPlacement: function(error, element) {
						   if (element.is(":radio") || element.is(":checkbox")) {
									element.closest('.option-group').after(error);
						   } else {
									error.insertAfter(element.parent());
						   }
						}
								
				});		
		
		});				
    
    </script>

 <script type="text/javascript">

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
function CheckPassword(){
	var pass1 = document.getElementById("new_pass");
	var pass2 = document.getElementById("confirm_pass");
	if(pass1.value != pass2.value){
		document.getElementById('conf').innerHTML = '<span style="color:#F00">Password does not match</span>';
	}
	else{
		document.getElementById('conf').innerHTML ='';
	}
}
	</script>
	
</head>

<body>
<?php include("../tools/header_new.php");?>

<div id="main">

	<div id="content">
    <?php include('userstools/menu.php');?>
		<div id="content_left">
			<div class="event_table_inner" style="float:left; width:97%; min-height:120px; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:28px; padding:5px;"><i class="fa fa-lock"></i>&nbsp; Change Password</h2></td>
    <td width="21%" style="padding-left:8px">&nbsp;</td>
    </tr>
  
</table>
</form>
</div>

		
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
						 
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded smart-forms">
						   <?php echo $message;?>
						     <form action="" method="post" id="contactform2">
						       <table width="100%" border="0">
						         <tr>
						           <td width="21%" align="right">Current Password: <span style="color:#F00"> * </span></td>
						           <td>
                                     
                                     <label for="password" class="field prepend-icon">
                        	<input type="password" name="old_pass"" id=""old_pass" class="gui-input" placeholder="Enter current password">
                            <label for="password" class="field-icon"><i class="fa fa-lock"></i></label>  
                        </label>
                                     
						             </td>
						           <td>&nbsp;</td>
					             </tr>
						         <tr>
						           <td align="right">New Password: <span style="color:#F00"> *</span></td>
						           <td width="38%"><span class="contact-left">
						            
                                     <label for="password" class="field prepend-icon">
                        	<input type="password" name="new_pass" id="new_pass" class="gui-input" placeholder="Enter password" onKeyUp="passwordStrength(this.value)">
                            <label for="password" class="field-icon"><i class="fa fa-lock"></i></label>  
                        </label>
						           </span></td>
						           <td width="41%"><div id="passwordDescription">Password not entered</div>
			<div id="passwordStrength" class="strength0"></div></td>
					             </tr>
						         <tr>
						           <td align="right">Confirm Password: <span style="color:#F00"> *</span></td>
						           <td><span class="contact-left">
						            
                                     <label for="password" class="field prepend-icon">
                        	<input type="password" name="confirm_pass" id="confirm_pass" class="gui-input" placeholder="Confirm  password" onblur="CheckPassword()">
                            <label for="password" class="field-icon"><i class="fa fa-lock"></i></label>  
                        </label>
						           </span></td>
						           <td id="conf"></td>
					             </tr>
						         <tr>
						           <td align="right">&nbsp;</td>
						           <td colspan="2"><button type="submit" class="button btn-primary" name="update_password">Update Password</button>
                                  </td>
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
					
		</div>
		
		<?php include("../tools/side-menu_new.php");?>
	</div>
   
 
	
	<div class="clearfix"></div>
</div>
	
	
	<?php include("../tools/footers_new.php");?>
</div>

</div>
</body>
</html>