<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

if(!isset($_SESSION['login_subcriber']) && ($_SESSION['login_subcriber'] != true)){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}

$message = '';
reset ($business);
	while (list ($key, $val) = each ($business)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}

$advert = "Add Business Info";
$errors = array();



	if(isset($_POST['update_subscriber'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$subscribers[$key] = addslashes($val);
		if ($val == "NULL")
			$subscribers[$key] = NULL;
		else
			$subscribers[$key] = $val;
	}
	$check = MysqlSelectQuery("select user_id,email from user_login where email= '".$_POST['email']."'");
	$num = NUM_ROWS($check);
	$rows_edit = SqlArrays($check);
	if($_POST['email'] == "")$errors[]="Enter your email address";
	if(!smcf_validate_email($_POST['email']))$errors[]="Enter a valid email address";
	if($_POST['fname'] == "")$errors[]="Enter your firstname";
	if($_POST['lname'] == "")$errors[]="Enter your lastname";
	/*if($_POST['username'] == "")$errors[]="Enter your username";*/
	
	
	if($_POST['address'] == "")$errors[]="Enter your address";
	if($_POST['state'] == "")$errors[]="Select your state";
	if($_POST['country'] == "")$errors[]="Select your country";
	if($_POST['category'] == "")$errors[]="Select category your are interested in";
	if(($rows_edit['user_id']!=$_SESSION['user_id'])&&($num > 0))$errors[]='Email already Exist';
	
		if(count($errors) > 0){
		$message = ErrorCall($errors);
	}
		else{
		
if(MysqlQuery("update subscribers set email='".$subscribers['email_sub']."',fname='".$subscribers['fname']."',lname='".$subscribers['lname']."',phone='".$subscribers['phone']."',organization='".$subscribers['organization']."',country='".$subscribers['country']."',city='".$subscribers['city']."',state='".$subscribers['state']."',address='".$subscribers['address']."',category='".$_POST['category']."',sex='".$_POST['sex']."' ,designation='".$subscribers['designation']."' where subscriber_id='".$_SESSION['user_id']."'"))
										 {

	$message='<div class="alert notification spacer-b30 alert-success">Your information updated successfully</div>'; 
											 
											 }
		} 
	}


?>

<?php


	$result = MysqlSelectQuery("select * from subscribers where subscriber_id='".$_SESSION['user_id']."'");
	$rows = SqlArrays($result);

$resultCategory = MysqlSelectQuery("select * from categories where category_id = '".$rows['category']."'");
	$rowsCategory = SqlArrays($resultCategory);
	
	$resultCountry = MysqlSelectQuery("select * from countries where id = '".$rows['country']."'");
	$rowsCountries = SqlArrays($resultCountry);
	
	$resultState = MysqlSelectQuery("select * from states where id_state = '".$rows['state']."'");
	$rowsState = SqlArrays($resultState);
	
	
?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Edit profile information : Nigerian Seminars and Trainings</title>
<meta name="description" content=""/>
	
    
	<?php include("../scripts/headers_new.php");?>
    
   
 <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/js/additional-methods.js"></script>

<script type="text/javascript">

function Get_Countries(){
		$.post("<?php echo SITE_URL;?>../tools/countries.php",{country:$('#region').val()}, function(data) {
				$('#country').html(data)
		});
	}
function Get_States(){
	if($('#country').val() == 'Nigeria'){
		$.post("<?php echo SITE_URL;?>../tools/countries.php",{GetState:38}, function(data) {
				$('#state').html(data)	
		});
		}
}


</script>
 <script type="text/javascript">
	
		$(function() {
			
			function reloadCaptcha(){
					$("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
	});
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
						
				$( "#subscriberForm" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
							
						rules:{
				fname: {
				required:true,
				minlength: 2
				},
				lname: {
				required:true,
				minlength: 2
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
				
				email:{
					required: true,
					email:true
				},
				phone:{
					required: true,
				},
				securitycode:{
					required: true,
				},
				
				sex:{
					required: true,
				}
			},
						
						/* @validation error messages 
						---------------------------------------------- */
						messages:{
								fname: {
				required:'Please enter your first name',
				minlength: 'Your firstname must contain a minimum of 2 characters'
				},
				lname: {
				required:'Please enter your lastname',
				minlength: 'Your first name must contain a minimum of 2 characters'
				},
				country: {
				required:'Select country',
				},
				category: {
				required:'Selec category',
				},
				state: {
				required:'Select State',
				},
				email:{
					required: true,
					email:true
				},
				phone:{
					required: 'Enter your telephone number',

				},
				sex:{
					required: 'Select your sex',
				},
				email:{
					required: 'Enter an email address',
					email:'Enter a valid email address'
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
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23693392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body>
<!-- Start Alexa Certify Javascript -->

<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>

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
<div id="main_content">
  <?php include("../tools/header_new.php");?>
  <div id="main">
<div id="content">	
<?php include("menu.php");?>
		<div id="content_left">
			<div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-edit"></i>&nbsp; Edit Information</h2></td>
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
						     <form action="" method="post" id="subscriberForm">
						       <table width="100%" border="0" class="formTable">
                               
						        <tr>
						          <td width="27%" align="left">Email:</td>
						          <td colspan="2">
                                     <label class="field prepend-icon">
						            <input name="email" type="text" class="gui-input" placeholder="Email Address" id="email" value="<?php echo $rows['email'];?>" size="40" /><label class="field-icon"><i class="fa fa-suitcase"></i></label>  
                                    </label>
                              </td>
					            </tr>
						        <tr>
						          <td align="left">Firstname</td>
						          <td colspan="2">
                                  
                                  <label class="field prepend-icon">
						            <input name="fname" type="text" class="gui-input" placeholder="Firstname" id="fname" value="<?php echo $rows['fname'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
                                    </label>
                                  
						         
                                   </td>
					            </tr>
						        <tr>
						          <td align="left"><span class="contact-left">Lastname</span></td>
						          <td colspan="2">
                                  
                                    <label class="field prepend-icon">
						            <input name="lname" type="text" class="gui-input" placeholder="Lastname" id="lname" value="<?php echo $rows['lname'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
                                    </label>
                                   </td>
					            </tr>
						        <tr>
						          <td align="left">Sex:</td>
						          <td width="16%">    
                                   <div class="option-group field">
                                <label for="female" class="option block">
                                    <input type="radio" name="sex" id="male" value="Male" <?php if ($rows['sex'] == 'Male'){?>checked="checked"<?php } ;?> >
                                    <span class="radio"></span> Male 
                                </label>
                               
                            </div>
                                   </td>
						          <td width="57%">
                                  
                                  <div class="option-group field">
                                <label for="female" class="option block">
                                    <input type="radio" name="sex" id="female" value="Female" <?php if ($rows['sex'] == 'Female'){?> checked="checked" <?php } ;?> >
                                    <span class="radio"></span> Female 
                                </label>
                          </div>
                               </td>
					             </tr>
						        <tr>
						          <td align="left"><span class="contact-left">Phone No:</span></td>
						          <td colspan="2">
                                  
                                    <label class="field prepend-icon">
						            <input name="phone" type="text" class="gui-input" placeholder="Telephone" id="phone" value="<?php echo $rows['phone'];?>" size="40" /><label class="field-icon"><i class="fa fa-phone"></i></label>  
                                    </label>
						         
						         </td>
					            </tr>
						        <tr>
						          <td align="left">Organization / Place of work:</td>
						          <td colspan="2">
                                  
                                  <label class="field prepend-icon">
						            <input name="organization" type="text" class="gui-input" placeholder="Organization" id="organization" value="<?php echo $rows['organization'];?>" size="40" /><label class="field-icon"><i class="fa fa-building-o"></i></label>  
                                    </label>
                                
                                  </td>
					            </tr>
						        <tr>
						          <td align="left">Designation:</td>
						          <td colspan="2">
                                  
                                  <label class="field prepend-icon">
						            <input name="designation" type="text" class="gui-input" placeholder="Designation" id="designation" value="<?php echo $rows['designation'];?>" size="40" /><label class="field-icon"><i class="fa fa-asterisk"></i></label>  
                                    </label>
                                
						         </td>
					            </tr>
						        <tr>
						          <td align="left">Address:</td>
						          <td colspan="2">
                                  
                                  <label class="field prepend-icon">
						            <input name="address" type="text" class="gui-input" placeholder="Address" id="address" value="<?php echo $rows['address'];?>" size="40" /><label class="field-icon"><i class="fa fa-home"></i></label>  
                                    </label>
						         </td>
					            </tr>
						        <tr>
						          <td align="left"><span class="contact-left">City:</span></td>
						          <td colspan="2">
                                  
                                  <label class="field prepend-icon">
						            <input name="city" type="text" class="gui-input" placeholder="City" id="city" value="<?php echo $rows['city'];?>" size="40" /><label class="field-icon"><i class="fa fa-building-o"></i></label>  
                                    </label>
                                  
                              
                                 </td>
					            </tr>
						        <tr>
						          <td align="left"><span class="contact-left">Country:</span></td>
						          <td colspan="2">
                                   <label class="field select">
                                  <select name="country" id="country" onchange="GetState()" >
				                  <option value="<?php echo $rowsCountries['id'];?>"><?php echo $rowsCountries['countries'];?></option>
						              <?php echo GetContries()?>
				                  </select>
                                  
						           <i class="arrow double"></i>
                                     </label>
                                  </td>
					            </tr>
						        <tr>
						          <td align="left"><span class="contact-left">State:</span></td>
						          <td colspan="2">
                                   <label class="field select">
                                  <select name="state" id="state" class="Textselect">
						            <option value="<?php echo $rowsState['id_state'];?>"><?php echo $rowsState['name'];?></option>
						            <?php echo GetState()?>
					              </select>
                                     <i class="arrow double"></i>
                                     </label>
                                  </td>
					            </tr>
						        <tr>
						          <td align="left"><span class="contact-left">Interetsted in:</span></td>
						          <td colspan="2">
                                   <label class="field select">
                                  <select name="category" class="" id="category">
      <option value="<?php echo $rowsCategory['category_id'];?>"><?php echo $rowsCategory['category_name'];?></option>
      <?php 

	$result_category = MysqlSelectQuery("select * from categories order by category_name");?>
      <?php while ($rows_category = SqlArrays($result_category)){?>
      <option value="<?php echo $rows_category['category_id'];?>"><?php echo $rows_category['category_name'];?></option>
      <?php

		}

	?>
    </select>
       <i class="arrow double"></i>
                                     </label>
    </td>
					            </tr>
                                <tr>
						          <td align="left">&nbsp;</td>
						          <td colspan="2">
                                  <button type="submit" class="button btn-primary" name="update_subscriber">Submit</button>
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
                 <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	
     </div>
				
		</div>
		
		<?php include("../tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>

</div>
<?php include ("../tools/footers_new.php");?>
<script>
       $(document).ready(function() {
            $("#hamburger").click(function(e) {
            $("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
            $("#main-menu").toggleClass("mobile-hide");
        });
        $(".mobile-show > a").click(function(e) {
            e.preventDefault();
            $(this).parent().children("ul").toggle();
        });

    });
</script>
</body>
</html>