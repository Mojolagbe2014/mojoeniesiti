<?php
header("HTTP/1.1 301 Moved Permanently");

header( "location: upload-vacancies");
/*session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($vacancies);
	while (list ($key, $val) = each ($vacancies)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Add Vacancies";
require_once("scripts/insertions.php");	

if(isset($_GET['type']) && $_GET['type'] == 'success'){
	$message ='<div class="alert notification alert-success">Your vacancy has been uploaded,  Your vacancy will be displayed after it has been reviewed</div>'; 
}*/
?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Nigerian Seminars and Trainings - Upload Vacancies</title>
<meta name="description" content="Add, Post, advertise your training vacancies and training facilitation opportunities (free) on Nigerian Seminars and Trainings."/>
	
	<meta name="dcterms.description" content="Add, Post, advertise your training vacancies and training facilitation opportunities (free) on Nigerian Seminars and Trainings." />

<meta property="og:title" content="Nigerian Seminars and Trainings - Upload Vacancies" />

<meta property="og:description" content="Add, Post, advertise your training vacancies and training facilitation opportunities (free) on Nigerian Seminars and Trainings." />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Upload Vacancies" />

<meta property="twitter:description" content="Add, Post, advertise your training vacancies and training facilitation opportunities (free) on Nigerian Seminars and Trainings." />

   
	<?php include("scripts/headers_new.php");?>
  <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.validate.js"></script>
     <script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/additional-methods.js"></script>
     
<?php include('tools/analytics.php');?>

<script type="text/javascript">

<?php 
if(!isset($_SESSION['login_business']) && !isset($_SESSION['login_subcriber'])){?>
$(document).ready(function(e) {
    $("#eventForm input, #eventForm select , #eventForm textarea, #eventForm button").attr('disabled',true);
});

$(document).ready(function() {	

	//$('a[name=currency]').click(function(e) {
      		//Cancel the link behavior
		//e.preventDefault();
		
		//Get the A tag
		var id = $('#Login_pop');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);
		
		$('#amount').val('200');
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	//});
	
	//if close button is clicked
	$('.window_currency #Close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
	
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
    });
	
});
<?php } ?>

$().ready(function() {
	
	
	function reloadCaptcha(){
					$("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
	});
	
	// validate the comment form when it is submitted
	$("#vacancyForm").validate({
			rules:{
				title: {
				required:true,
				minlength: 2
				},
				experience: {
				required:true,
				},
				country: {
				required:true,
				},
				category: {
				required:true,
				},
				type: {
				required:true,
				},
				city: {
				required:true,
				},
				description:{
					required: true,
					minlength: 150
				},
				company_name:{
					required: true,
					minlength: 2
				},
				contact_person:{
					required: true,
					minlength: 2
				},
				email:{
					required: true,
					email:true
				},
				telephone:{
					required:true,
					number: true
				},
				securitycode:{
					required: true,
				}
				
			},
			
			/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
			
			/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
								title: {
				required:'Enter job title',
				minlength: 'Minimum character lenght expected is 2'
				},
				experience: {
				required:'Select job experience',
				},
				country: {
				required:'Select country',
				},
				category: {
				required:'Select category',
				},
				type: {
				required:'Select job type',
				},
				city: {
				required:'Enter job city',
				},
				description:{
					required: 'Enter job description',
					minlength: 'Description must not be less than 150 characters'
				},
				company_name:{
					required: 'Enter company\'s name',
					minlength: 'Company\'s name must not be less than 2 characters'
				},
				contact_person:{
					required: 'Enter a contact person',
					minlength: 'contact person must not be less than 2 characters'
				},
				email:{
					required: 'Enter email address',
					email:'Enter a valid email address'
				},
				telephone:{
					required:'Enter telephone number',
					number:'Enter a valid telephone number'
				},
				securitycode:{
					required: 'Enter security code',
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
<style type="text/css">
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}

.window_currency {
  position:fixed;
  left:0;
  top:0;
  width:auto;
  z-index:9999;
  padding:20px;
  display:none;
}
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}

</style>
    
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


<?php include("tools/header_new.php");?>



<div id="main">
  <div id="content">
  
  <?php include("tools/categories_new.php");?>
  

  
		<div id="content_left">

				<div id="subpage">
					<div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;"><p>Upload your vacancies</p></h1></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
   <div id="mask"></div>
    <div id="Login_pop" style="float:left;" class="window_currency boxContent smart-forms">
      <div class="alert notification alert-error">You must be logged in to upload your vacancy, <a href="login">Click here</a> to login. <br /> Dont have an account? <a href="biz_info">Click here</a>to register as a business or <a href="subscribers">Click here</a> to register as a subscriber</div>
      </div>
			 <div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
						<?php echo $message;
                        if(!isset($_SESSION['login_business']) && !isset($_SESSION['login_subcriber'])){?>
                         <div class="alert notification alert-error">You must be logged in to upload your vacancy, <a href="login">Click here</a> to login. <br /> Dont have an account? <a href="biz_info">Click here</a> to register as a business or <a href="subscribers">Click here</a> to register as a subscriber</div>
                         <?php } ?>
						    <form action="" method="post" id="eventForm">
						  <table border="0" width="100%" class="event_detail">
  <tr>
    <td>
     <label class="field prepend-icon">
    <input name="title" type="text" class="gui-input" placeholder="Job Title" id="title" value="<?php echo $_SESSION['title'];?>" size="40" /><label class="field-icon"><i class="fa fa-briefcase"></i></label>  
      </label>    
      </td>
    </tr>
  <tr>
    <td>
    <label class="field select">
      <select name="experience" id="experience">
          <option value="">Select job experience</option>
          <option value="1 Year">1 year</option>
          <option value="2 years">2 years</option>
          <option value="3 years">3 years</option>
          <option value="4 years">4 years</option>
          <option value="5 years">5 years</option>
          <option value="6 years">6 years</option>
          <option value="7 years">7 years</option>
          <option value="8 years">8 years</option>
          <option value="9 years">9 years</option>
          <option value="10 and Above">10 and Above</option>
          </select>
        <i class="arrow double"></i>
    </label>    </td>
    </tr>
  <tr>
    <td><label class="field select">
      <select name="type" id="type" class="input">
          <option value="">Select Job Type</option>
          <option value="Fulltime">Fulltime</option>
          <option value="Partime">Partime</option>
          <option value="Contract">Contract</option>
          </select>
        <i class="arrow double"></i>
    </label>    </td>
    </tr>
  <tr>
    <td><label class="field select">
      <select name="country" id="country" >
          <option selected="selected" value="">Select country</option>
          <?php 
	  if(connection());
	  $result_country = MysqlSelectQuery("select * from countries");
	  while($rows = SqlArrays($result_country)){
	  ?>
          <option value="<?php echo $rows['countries'];?>"><?php echo $rows['countries'];?></option>
          <?php
	  }
	  ?>
          </select>
        <i class="arrow double"></i>
    </label>    </td>
    </tr>
  <tr>
    <td>
     <label class="field prepend-icon">
    <input name="city" type="text" class="gui-input" placeholder="City" id="city" value="<?php echo $_SESSION['city'];?>" size="40" /><label class="field-icon"><i class="fa fa-building-o"></i></label>  
      </label></td>
    </tr>
  <tr>
    <td>
     <label class="field prepend-icon">
    <label for="description" class="field prepend-icon">
  <textarea name="description" id="description" class="gui-textarea"  placeholder="Event Description" ><?php echo $_SESSION['description'];?></textarea>
      
  <label for="description" class="field-icon"><i class="fa fa-comment"></i>
  </label>  
      <span class="input-hint"> 
        Enter detailed description of your vacancy here
        </span>
      </label>    </td>
    </tr>
  <tr>
    <td>
     <label class="field prepend-icon">
      <input name="company_name" type="text" class="gui-input" placeholder="Company Name" id="company_name" value="<?php echo $_SESSION['company_name'];?>" size="40" /><label class="field-icon"><i class="fa fa-building-o"></i></label>  
      </label>
</td>
    </tr>
  <tr>
    <td>
     <label class="field prepend-icon">
      <input name="contact_person" type="text" class="gui-input" placeholder="contact_person" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
      </label>
   </td>
    </tr>
  <tr>
    <td>
     <label class="field prepend-icon">
      <input name="telephone" type="text" class="gui-input" placeholder="Telephone" id="telephone" value="<?php echo $_SESSION['telephone'];?>" size="40" /><label class="field-icon"><i class="fa fa-phone"></i></label>  
      </label>
      </td>
    </tr>
  <tr>
    <td>
     <label class="field prepend-icon">
    <input name="email" type="text" class="gui-input" placeholder="email" id="email" value="<?php echo $_SESSION['email'];?>" size="40" /><label class="field-icon"><i class="fa fa-envelope"></i></label>  
                  </label>
                  </td>
    </tr>
  <tr>
    <td>
   
      <div class="smart-widget sm-left sml-120">
        <label class="field">
          <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
          </label>
        <label for="securitycode" class="button captcode">
          <img src="tools/captcha.php" id="captcha" alt="Captcha">
          <span class="refresh-captcha"><i class="fa fa-refresh"></i>
          </label>
        </div>
      </td>
  </tr>
  <tr>
    <td align="center">
     
      <button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:14px; background-color:#435A65; color:#FFF;" name="submit_vacancies">Submit</button> 
</td>
  </tr>
                            </table>
					        </form>
						  

				  </div>
		
                    
				</div>
                <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	 <div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>

                </div>
                <!-- end subpage -->
             


				<?php //include("tools/categories.php");?>	
	
		
		<?php include("tools/side-menu_new.php");?>	
        <div class="clearfix"></div>
	</div>
     <div class="clearfix"></div>
	</div>
    </div>

<?php include ("tools/footer_new.php");?>

</body>
</html>