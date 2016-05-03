<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
if(isset($_SESSION['login_business']) && $_SESSION['login_business'] == true){
	if(isset($_SESSION['premium'])){
		header("location: ".SITE_URL."user/profile");
	}
	else{
		header("location: ".SITE_URL."business/profile");
	}
}
else if(isset($_SESSION['login_subcriber'])){
	header("location: ".SITE_URL."sub/profile");
	exit;
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
<link href="https://www.nigerianseminarsandtrainings.com/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Login: Nigerian Seminars and Trainings</title>
<meta name="description" content="Login to Nigerian Seminars and Trainings to manage your business and events listing"/>
	
	<link rel="stylesheet" href="<?php echo SITE_URL_S;?>style.css" type="text/css" media="screen" />
    <?php include("scripts/headers_s.php");?>
    
    <style>

.black_overlay{
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color:#000;
    z-index:1001;
    -moz-opacity: 0.3;
    opacity:.30;
    filter: alpha(opacity=30);
}
.white_content {
	 display: none;
    position: fixed;
	top: 10%;
	left: 35%;
	width: 25%;
	height: 30%;
	padding: 16px;
	border: 4px solid  #090;
	background-color: white;
	z-index:1002;
}
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
 .confirmation{
	background-color:#FFE9D2;
	display:block;
	padding:2px;

	border:1px solid #F90;
}
.confirmation p{
	color:#F60;
	font-weight:bold;
	text-align: center;
}
.confirmation span{
	display:block;
	padding:5px;
	width:300px;
	margin: 5px auto 5px auto;
}
.confirmation .clear{
	clear:both;
}
.confirmation a{
	display:block;
	padding:3px;
	width:100px;
	float:left;
	margin-right:20px;
	text-align: center;
	color: #FFF;
	background-color: #009300;
	font-weight: bold;
	text-decoration: none;
	border-radius:5px;
}
.confirmation .options{
	background:#FCC;
	text-align:left;
}
.confirmation .options ul{
	display:block;
}
.confirmation .options ul li{
	display:block;
	list-style:none;
	padding:2px;
}
.confirmation .options ul li a{
	display:block;
	width: auto;
	float: none;
	background-color: #FCC;
	color: #060;
	text-align:left;
	font-weight: normal;
}
    </style>
<script type="text/javascript">

				$(document).ready(function(){
					
					$('#forgotPassword .fPassword').click(function(){
					$('#msgComment').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL_S;?>tools/password_forget.php",{email:$('#emailForgot').val()} ,function(msg){
					if(msg == 'Sent'){
						$('#msgComment').removeClass().addClass('ok').text("A new password has been to your email")
						$('#emailForgot').val('');
						
					}
					else if(msg == 'Not Found'){
					$('#msgComment').removeClass().addClass('error').text("Sorry there no account associated with this email!");
					$('#emailForgot').val('');
					}
					/*else {
						
						alert(msg)
					}*/
					
					});
						
						return false;
					})
				});
</script>
<script type="text/javascript">

$(document).ready(function()
{
	$("#login-form").submit(function()
	{
		var GetEmail = $('#email').val();
		
		if($('#email').val() == ''){
			alert("Please enter your email");
			
			
			return false;
		}
		else if ($('#password').val() == ''){
			alert("Please enter your password");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Authenticating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("<?php echo SITE_URL_S;?>tools/login_new.php",{ user_email:$('#email').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		
		  if(data=='Premium Login') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login successful, Redirecting.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='<?php echo SITE_URL;?>user/profile';
			  });
			  
			});
		  }
		  else if(data=='Regular Business') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login successful, Redirecting.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='<?php echo SITE_URL;?>business/profile';
			  });
			  
			});
		  }
		  else if(data=='Account Expired'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Sorry your premium account has expired! <a href=\'premium-listing-renew\'>Click here to renew</a>').addClass('messageboxerror').fadeTo(900,1);
			});
		  }
		   else if(data=='Regular Business Email Sent'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('<p>This Account currently does not have a login password, would you like to generate a login password for this account? </p><span><a href="javascript:void(0)" onclick="BusinessEmail()">Yes</a> <a href="javascript:void(0)" style="background:#F00;" onclick="NoEmail()">No</a><div class=\'clear\'></div></span>').addClass('confirmation').fadeTo(900,1);
			});
			 /* $("#msgbox").fadeOut('slow');
			   $("#emailMessage").fadeIn('slow');*/
		  }
		   else if(data=='Subscriber Login') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login successful, Redirecting.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='<?php echo SITE_URL;?>sub/profile';
			  });
			  
			});
		  }
		  else if(data=='Subscriber Email Sent'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			   $(this).html('<p>This Account currently does not have a login password, would you like to generate a login password for this account? </p><span><a href="javascript:void(0)" onclick="SubscriberEmail()">Yes</a> <a href="javascript:void(0)" style="background:#F00;" onclick="NoEmail()">No</a><div class=\'clear\'></div></span>').addClass('confirmation').fadeTo(900,1);
			});
		  }
		   else if(data=='Not Found'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('<div class="options"><p style="text-align:left; padding-left:5px;">This Account currently does not exist in out database, what will you like to do?</p><ul><li><a href="<?php echo SITE_URL;?>biz_info">Upload your business information ?</a></li><li><a href="<?php echo SITE_URL_S;?>premium-listing">Subscribe to our premium listing ?</a></li><li><a href="<?php echo SITE_URL;?>subscribers">Register as a subscriber ?</a></li></ul></div>').addClass('confirmation').fadeTo(900,1);
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login Faild!').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	//$("#yes").click(function())
	
	
});
/*$(document).ready(function(){
$("#yes").click(function(){
		alert('test');
		return false;
	});
});
*/function BusinessEmail(){
	$("#msgbox").removeClass().addClass('messagebox').text('Processing....').fadeIn(1000);
	$.post("<?php echo SITE_URL_S;?>tools/login_email.php",{ Acctype:'Business'} ,function(data){
		if(data=='Regular Business Email Sent'){
		  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('<p style="color:#000;">A login password has been sent to your email address</p>').addClass('validating').fadeTo(900,1);
			});	
		}
	});
	return false;
}
function SubscriberEmail(){
	$("#msgbox").removeClass().addClass('messagebox').text('Processing....').fadeIn(1000);
	$.post("<?php echo SITE_URL_S;?>tools/login_email.php",{ Acctype:'Subscriber'} ,function(data){
		if(data=='Subscriber Email Sent'){
		  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('<p style="color:#000;">A login password has been sent to your email address</p>').addClass('validating').fadeTo(900,1);
			});	
		}																																		   });
	return false;
}
function NoEmail(){
	window.location='./';
}
</script>
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->

<?php include("tools/header2.php");?>

	
  <div id="main">
  
	</div>
	<div id="content">
		<div id="content_left">
			
		<h3 class="categoryHeader">Login</h3>

				<div id="subpage">
					
					<div id="subpage_content">
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
                           <div class="login">
 <span id="msgbox" style="display:none"></span>
<!-- <div class="confirmation">
 <div class="options">
 <p style="text-align:left; padding-left:5px;">This Account currently does not exist in out database, what will you like to do?</p>
<ul>
 <li><a href="biz_info">Upload your business information</a></li>
 <li><a href="premium-listing">Subscribe to our premium listing? </a></li>
 <li><a href="subscribers">Register as a subscriber</a></li>
 </ul>
 </div>
 </div>-->
                             
			<form action="tools/login_new.php" method="post" id="login-form"> 
            <table width="100%" border="0">
  <tr>
    <td width="11%"><label>Email:</label></td>
    <td colspan="2"><input name="email2" type="text" class="input" id="email" style="width:260px;" /></td>
    <td width="33%" rowspan="3" valign="top"><h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Don't have an account?</h1>      <ul style="list-style:none; line-height:20px;">
        <li><a href="<?php echo SITE_URL;?>biz_info">Upload your business information ?</a></li><li><a href="<?php echo SITE_URL_S;?>premium-listing">Subscribe to our premium listing ?</a></li><li><a href="<?php echo SITE_URL;?>subscribers">Register as a subscriber ?</a></li></ul></td>
  </tr>
  <tr>
    <td><label>Password:</label></td>
    <td colspan="2"><input name="password" type="password" class="input" id="password" style="width:260px;" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="10%"><button name="submit">Sign In</button></td>
    <td width="46%"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Forgot your password? or don't have a password?</a></td>
    </tr>
</table>
			 
            </form>
            </div>
             <div id='fade' class="black_overlay"></div>
              <div id="light" class="white_content"> 
      <a href = "javascript:void(0)" onclick ="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                    
                <form id="forgotPassword" name="form1" method="post" action="" >
        <p class="headerForm" style="color:#090">Please enter your email address</p>
        <span id="msgComment"></span>
	           <table width="320" border="0" align="center" class="forgotTable">
                <tr>
	                <td>Email :</td>
	                <td><input name="email" type="text" id="emailForgot" style="width:250px; height:30px" /></td>
	                </tr>
	             
	              <tr>
	                <td>&nbsp;</td>
	               
	                <td><button name="submit" class="fPassword">Submit</button></td>
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
				<?php //include("tools/categories.php");?>
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