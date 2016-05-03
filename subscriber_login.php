<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
header('location: login',true,'301');
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
	<title>Subscribers Login: Nigerian Seminars and Trainings.com </title>
<meta name="description" content="Login to Nigerian Seminars and Trainings subscribers page to place your comments"/>
	
	<link rel="stylesheet" href="<?php echo SITE_URL;?>style.css" type="text/css" media="screen" />
    <?php include("scripts/headers_s.php");?>
     <script type="text/javascript">

$(document).ready(function()
{
	$("#login-form .subscriber_btn").click(function()
	{
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
		$.post("<?php echo SITE_URL;?>tools/commentLogin.php",{ email:$('#email').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='valid') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login successful, Redirecting.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='<?php echo SITE_URL;?>';
			  });
			  
			});
		  }
		  else if(data == 'user exist'){
			  			$('#fade').show();
						$('#useremail').val($('#email').val());
						GetSubscriberName($('#email').val());
						
						$('#light_update').show();
					}
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox

			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login Failed!').addClass('messageboxerror').fadeTo(900,1);
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
	
});

function GetSubscriberName(Subemail){
					var result;
					$(document).ready(function(){
				$.post("<?php echo SITE_URL;?>tools/getSubName.php",{email:Subemail},function(msg){
						$('#fname').text(msg);	
						
						});						
				
					});
}
					
$(document).ready(function(){
  $("#close").click(function(){
    $('#light_update').hide();
  });
  
 
});

$(document).ready(function(){
					
					$('#comment_update').submit(function(){
						$('#msgCommentUpdate').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL;?>tools/commentUpdate.php",{username:$('#username').val(),password:$('#updatepassword').val(),email:$('#useremail').val()} ,function(msg){
					if(msg == 'yes'){
						window.location = $('#url').val();
					}
					else if(msg == 'invalid'){
						$('#msgCommentUpdate').removeClass().addClass('error').html('Error! username and password field cannot be empty!').show();
					}
					else{
						alert(msg);
					}
					
					
					});
						
						return false;
					})
				});
</script>

<script>

$(document).ready(function(){
  $("#help").click(function(){
    $("#helpForm").toggle( 'slow');
  });
  
 
});

</script>
  
  
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
    -moz-opacity: 0.5;
    opacity:.50;
    filter: alpha(opacity=50);
}
.white_content {
	 display: none;
    position: fixed;
	top: 9%;
	left: 27%;
	width: 30%;
	padding: 16px;
	border: 4px solid  #090;
	background-color: white;
	z-index:1002;
}
.replyBox{
	display:none;
}
.initialstate{
display:none;
}
.validating{
	color:#FC0;
}
.error{
	color:#F00;
}
.headerForm {
	font-size: 14px;
	color: #FFF;
	padding: 3px;
	margin-top: 5px;
	margin-bottom: 5px;
	background-color: #090;
	font-weight: bold;
}
#comment-login table td {
	border: none;
}
.updateMsg {
	background-color: #FFC;
	padding: 3px;
	border: 1px solid #FC0;
	margin-bottom:5px;
}
.usercomment {
	display: block;
	padding: 1px;
	margin-bottom: 3px;
	font-size: 12px;
	font-weight: bold;
	color: #009;
}
.usercomment span {
	font-size: 10px;
	color: #999;
}
.commentBody{
	float:right;
	width:640px;
	line-height: 20px;
}
.replyBody{
	float:right;
	width:590px;
	line-height: 20px;
}
.commentOptions {
	font-size: 11px;
	color: #006;
	display: block;
	padding: 2px;
	margin-top: 3px;
}
.commentOptions a {
	text-decoration: underline;
}
.commentBox {
	padding: 3px;
	float: left;
	width: 710px;
	margin-top: 5px;
	margin-bottom: 5px;
}
.commentBox:hover{
	background-color:#F7F7F7;
}
.commentBox img {
	float: left;
	background-color: #F3F3F3;
	padding: 2px;
}
.commentTextBox {
	width: 630px;
	border: 1px solid #090;
	height: 58px;
}
.commentTextBoxSmall {
	width: 570px;
	border: 1px solid #090;
	height: 50px;
}
.replyFeeds {
	padding: 3px;
	width: 630px;
	margin-top: 5px;
	margin-bottom: 5px;
	float: left;
}
.updtTable tr td{
	padding:3px;
}
</style>
<script type="text/javascript">
				$(document).ready(function(){
					
					$('#forgotPassword .fPassword').click(function(){
					$('#msgComment').removeClass().addClass('validating').html('Processing...').show();								
		$.post("<?php echo SITE_URL;?>tools/forgotPasswordSubscribers.php",{email:$('#emailForgot').val()} ,function(msg){
					if(msg == 'done'){
						$('#msgComment').removeClass().addClass('ok').text("A password reset link has been sent to your email")
					}
					else if(msg == 'invalid'){
						$('#msgComment').removeClass().addClass('error').text("Sorry there no account associated with this email!");
					}
					else {
						$('#msgComment').removeClass().addClass('error').text("Sorry an error occured while processing your request ! please try again ");
						//alert(msg)
					}
					
					});
						
						return false;
					})
				});
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
			
		 <!--upade account form section--> 
                 <div id="light_update" class="white_content"> <a href = "javascript:void(0);" id="close" >Close</a>
                      <br />
                    
                   <form id="comment_update" name="form1" method="post" action="" ><br /><br />
        <p class="headerForm">Update account information</p>
        <div class="updateMsg">Hi <span id="fname"></span>, this is the first time you are loging in to your account, Please we require you update the information below to continue.</div>
	           <table width="320" border="0" align="center" class="updtTable">
                <tr>
                  <td width="78">Username:</td>
                  <td colspan="2"><input type="text" name="username" id="username" style="width:200px; height:30px" /></td>
                </tr>
	              <tr>
	                <td>Password :</td>
	                <td colspan="2"><input type="password" name="password" id="updatepassword" style="width:200px; height:30px" /></td>
	                </tr>
	              <tr>
	                <td><input name="useremail" type="hidden" id="useremail" value="" /></td>
	                <td colspan="2"><span id="msgCommentUpdate"></span></td>
	                </tr>
	              <tr>
	                <td>&nbsp;</td>
	                <input name="url" type="hidden" value="<?php echo $_SERVER['REQUEST_URI'];?>" id="url" />
	                <td width="63"><input class=" buttonHome" type="submit" name="button" id="button" value="Update" /></td>
	                <td width="165"><a id="help" href="javascript:void(0)">Help?</a></td>
	                </tr>
	              </table>
                  
	            </form> 
                <div id="helpForm" style="margin-left:15px; margin-top:5px; display:none"  >
                   <b>Existing Subscribers:</b><br />
                   <ul>
                   <li >Enter the email address you subscribed with.</li>
                   <li >Enter DEMO in the password box</li>
                   <li >Click Submit</li>
                   </ul><br />
                  <b> New Subscribers:</b><br />
                   <ul>
                   <li>Click create account.</li>
                   
                   </ul><br /><br />
                  </div>
                
                    </div>
                    <!--end of update account form section-->
                    <div id="fade" class="black_overlay"></div>
<h3 class="categoryHeader">Subscribers Login</h3> 
				<div id="subpage">
					
					<div id="subpage_content">
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
                           <div class="login">
 <span id="msgbox" style="display:none"></span>
                             
			<form action="" method="post" id="login-form"> 
            <table width="100%" border="0">
  <tr>
    <td width="11%"><label>Email:</label></td>
    <td colspan="2"><input name="email" type="text" class="input" id="email" /></td>
    <td><h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Don't have an account?</h1></td>
  </tr>
  <tr>
    <td><label>Password:</label></td>
    <td colspan="2"><input name="password" type="password" class="input" id="password" /></td>
    <td align="center"><a href="<?php echo SITE_URL;?>subscribers" style="color:#039">Click here to sign-up as a subscriber</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="13%"><button name="submit" class="subscriber_btn">Sign In</button></td>
    <td width="40%"><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Forgot your password?</a></td>
    <td width="36%">&nbsp;</td>
  </tr>
</table>
			 
            </form>
            </div>
             <div id='fade' class="black_overlay"></div>
              <div id="light" class="white_content"> <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
                    
                <form id="forgotPassword" name="form1" method="post" action="" >
        <p class="headerForm" style="color:#FFF;">Please enter your email address</p>
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