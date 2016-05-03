<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
$errors = array();
$articles_array = array('title'=>"",'author'=>"",'authoremail'=>"",'biography'=>"",'tags'=>"");
reset ($articles_array);
	while (list ($key, $val) = each ($articles_array)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	
$advert = "Article Submission";

if(isset($_POST['submit_article'])){
	
	//create and array element for the image and picture post values
	$fileUpload = array('pictureName' => $_FILES['picture']['name'],'pictureSize'=> $_FILES['picture']['size'],'pictureTmp'=> $_FILES['picture']['tmp_name'], 'article' => $_FILES['article_file']['name'],'articleTmp' => $_FILES['article_file']['tmp_name'], 'articleSize' => $_FILES['article_file']['size']);
	
	//get article and image extensions
	$picture_ext = substr(strrchr($fileUpload['pictureName'], "."), 1);
	
	$article_ext = substr(strrchr($fileUpload['article'], "."), 1); 
	
	//create image extension array
	$imgExt = array('jpg','png','jpeg','gif','GIF','JPEG','JPG','bmp','PNG');
	
	//generate random image name
	$name = random(20).md5($fileUpload['pictureName']);
	
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		//if ($val == "") $val = "NULL";
		$articles_array[$key] = strip_tags(EscapeStrings($val));
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}

	
	if($articles_array['title'] == "") $errors[] = "Enter article title";
	if($articles_array['author'] == "") $errors[] = "Enter article author";
	if(!smcf_validate_email($articles_array['authoremail'])) $errors[] = "Enter authors email";
	if($articles_array['biography'] == "") $errors[] = "Enter authors biography";
	if($fileUpload['pictureName']!= '' and !in_array($picture_ext,$imgExt)) $errors[] = "Invalid image extension, please upload jpg, png, gif or bmp files";
	if($fileUpload['pictureSize'] > "153600") $errors[] = "Picture too large! Maximum size allowed is 150 kb";
	if($article_ext != "pdf") $errors[] = "Invalid article file, Please upload pdf files only";
	if($fileUpload['article'] == "") $errors[] = "Please select an article to upload";

	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode']))$errors[] = "Invalid security code";
	
			if(count($errors) > 0){
				$message = '<div class="alert notification alert-error">
				<strong>Please attend to the following:</strong>
				<ul>';
				foreach($errors as $error){
					$message .= '<li><en>'.$error.'</em></li>';
				}
				$message .='</ul></div>';
			}
			else{
				$ArticleFolder = "articles-pdf/";
				$authorImage = "nstlogin/articles_images/".$name.".$picture_ext";
				$picture = $name.".$picture_ext";
				$date = date("Y-m-d");
				
				if(MysqlQuery("insert into articles (article_title,author,email,author_detail,image,tags,filename,filetype,articleDate,articleImage) values('".$articles_array['title']."','".$articles_array['author']."','".$articles_array['authoremail']."','".$articles_array['biography']."','".$picture."','".$articles_array['tags']."','".$fileUpload['article']."','$article_ext','$date','".$picture."')")){
					
					//upload picture
					copy($fileUpload['pictureTmp'],$authorImage);
					
					//upload article
					copy($fileUpload['articleTmp'],$ArticleFolder.$fileUpload['article']);
					
					$message ='<div class="alert notification alert-success">Your article was submitted successfully</div>';
					
					// send notification email for newley submited article
		$to = 'info@nigerianseminarsandtrainings.com';
		$subject = "New article submitted";
		$Email_message .= "Author : ".$articles_array['author']." \n";
		$Email_message .= "Article Title: ".$articles_array['title'];
		$Email_message .= "\n";
		//$Email_message .= "Phone: ($phone)";
		//$Email_message .= "\n";
		$Email_message .= "Author's Email: ".$articles_array['authoremail'];
		$Email_message .= "\n";
		$Email_message .= "Biography: ".$articles_array['biography'];
		$Email_message .= "\n";
		$headers = "From: no_reply <no_reply@nigerianseminarsandtrainings.com>";
		mail($to, $subject, $Email_message, $headers);
					
			reset ($articles_array);		
	while (list ($key, $val) = each ($articles_array)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
				}
				
			}
}

?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Nigerian Seminars and Trainings - Article Submission</title>
<meta name="description" content="Submit your academic and general purpose articles and journals for publication on Nigerian Seminars and Trainings"/>

<meta name="dcterms.description" content="Submit your academic and general purpose articles and journals for publication on Nigerian Seminars and Trainings" />

<meta property="og:title" content="Nigerian Seminars and Trainings - Article Submission" />

<meta property="og:description" content="Submit your academic and general purpose articles and journals for publication on Nigerian Seminars and Trainings" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Article Submission" />

<meta property="twitter:description" content="Submit your academic and general purpose articles and journals for publication on Nigerian Seminars and Trainings" />
	    
  

	<?php include("scripts/headers_new.php");?>
   <script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
     <script type="text/javascript" src="js/jquery.validate.js"></script>
     <script type="text/javascript" src="css/smartforms/js/js/additional-methods.js"></script>
     
     <script type="text/javascript">

	   
				

//script for the search calender
		$(function() {
		
				/* @reload captcha
				------------------------------------------- */		
		function reloadCaptcha(){
					$("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});
		});




</script>
 <script type="text/javascript">
	
		$(function() {
		
				/* @custom validation method (smartCaptcha) 
				------------------------------------------------------------------ */
					
				$.validator.methods.smartCaptcha = function(value, element, param) {
						return value == param;
				};
						
				$( "#article_form" ).validate({
				
						/* @validation states + elements 
						------------------------------------------- */
						
						errorClass: "state-error",
						validClass: "state-success",
						errorElement: "em",
						
						/* @validation rules 
						------------------------------------------ */
							
						rules: {
								title: {
										required: true
								},
								authoremail: {
										required: true,
										email:true
								},
								author: {
										required: true,
								},
																
								biography:  {
										required: true,
										minlength: 150
								},			
								securitycode:{
										required:true
								},
								
								
								article_file:{
									required:true,
									extension:"pdf"
								}																									
							
						},
						
						/* @validation error messages 
						---------------------------------------------- */
							
						messages:{
								title: {
										required: 'Enter article title'
								},
								authoremail: {
										required: 'Enter your email address',
										email:'Enter a valid email address'
								},
								author: {
										required: 'Enter authors name',
								
								},
											
								biography:  {
										required: 'Enter authors biography',
										minlength: 'Authors biography must contain atleast 150 characters'
								},			
								securitycode:{
										required:'Enter security code'
								},
								
								picture:{
									required:'Browse to select picture',
									extension:'Sorry, file format not supported jpg,png,bitmap or gif files only'
								},
								article_file:{
									required:'Browse to select article',
									extension:'Sorry, file format not supported pdf file only'
								},																				
																				
						 
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
			<div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0" style="width:100%;">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Submit Article</p></h2> </td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px"><div class="smart-forms" style="width:250px; padding-top:0px;"><a href="<?php echo SITE_URL;?>article-submission-policy.pdf" class="button" target="_blank">View Article Submission Policy</a>
       <div class="clearfix"></div>
       </div></td>
    </tr>
</table>
</form>
</div>
<div id="tab_slider">
				<div id="subpage">
					
		     <div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
						
						<?php echo $message;?>
						
						     <form action="" method="post" id="article_form" enctype="multipart/form-data">
						       <table width="100%" border="0" class="event_detail">
						         <tr>
						           <td colspan="2">
                                   <label class="field prepend-icon">
						            <input name="title" type="text" class="gui-input" placeholder="Article Title" id="title" value="<?php echo $_SESSION['title'];?>" /><label class="field-icon"><i class="fa fa-pencil"></i></label>  
                                    </label>
					              </td>
					             </tr>
						         <tr>
						           <td colspan="2">
                                    <label class="field prepend-icon">
						            <input name="author" type="text" class="gui-input" placeholder="Author" id="author" value="<?php echo $_SESSION['author'];?>" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
                                    </label>
                                   
                                   </td>
					             </tr>
						         
						         <tr>
						           <td colspan="2">
                                  <label class="field prepend-icon">
						            <input name="authoremail" class="gui-input" placeholder="Email" id="authoremail" value="<?php echo $_SESSION['authoremail'];?>" size="40" /><label class="field-icon"><i class="fa fa-envelope"></i></label>  
                                   </label>
                                 </td>
					             </tr>
						        
						         <tr>
						           <td colspan="2"><label for="description" class="field prepend-icon">
						            <textarea name="biography" id="biography" class="gui-textarea"  placeholder="Author's Brief Biography" ><?php echo $_SESSION['biography'];?></textarea>
                                  
<label for="biography" class="field-icon"><i class="fa fa-user"></i>
                                    </label>  
                                    <span class="input-hint"> 
                            	Enter brief biography of the author here
                            </span>
                                   </label></td>
					             </tr>
						         <tr>
						           <td colspan="2"> 
                                   <div class="section" style="margin-bottom:0px;">
        <label class="field prepend-icon file">
        <span class="button btn-primary"> Choose File </span>
        <input type="file" class="gui-file" name="picture" id="picture" onChange="document.getElementById('pic_uploader').value = this.value;">
        <input type="text" class="gui-input" id="pic_uploader" placeholder="Upload authors picture" readonly>
        <label class="field-icon"><i class="fa fa-file-picture-o"></i></label>
        </label>
        </div>
        <p style="color:#009900; font-size:12px; text-align:center;">Please upload image not larger than 150kb </p>
                                   </td>
					             </tr>
						         <tr>
						           <td colspan="2"><label class="field prepend-icon">
						            <input name="tags" type="text" class="gui-input" placeholder="Tags (separate tags with commas (,))" id="tags" value="<?php echo $_SESSION['tags'];?>" size="40" />
                                  <label for="tags" class="field-icon">  <i class="fa fa-tag"></i></label>
                                   </label></td>
					             </tr>
						        
						         
						         
						         <tr>
						           <td colspan="2"><div class="section" style="margin-bottom:0px;">
        <label class="field prepend-icon file">
        <span class="button btn-primary"> Choose File </span>
        <input type="file" class="gui-file" name="article_file" id="article_file" onChange="document.getElementById('art_uploader').value = this.value;">
        <input type="text" class="gui-input" id="art_uploader" placeholder="Upload Article" readonly>
        <label class="field-icon"><i class="fa fa-file-pdf-o"></i></label>
        </label>
        </div>
        <p style="color:#009900; font-size:12px; text-align:center;">Please upload pdf files only</p>
        </td>
					             </tr>
						         
						         
                                   
                                   
                                   
						         
						         <tr>
						           <td colspan="2"> 
                                                                      <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code:">
                            </label>
                            <label for="securitycode" class="button captcode">
                            	<img src="tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </label>
                        </div>  
                        </td>
					             </tr>
						         <tr>
						           <td colspan="2"></td>
					             </tr>
						         <tr>
						           <td colspan="2" align="center">
                                   
                                   <button type="submit" class="button btn-primary" name="submit_article">Submit Article</button>
                                 </td>
					             </tr>
					           </table>
					         </form>
                          
                             
                             
                            
					 
						 <div id="contact-info">
						   
					     </div>
					</div>
                    </div>
				</div><!-- end subpage -->
                 <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	 <div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
     </div>
				<?php //include("tools/categories.php");?>	
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>

<div class="clearfix"></div>
</div>


<?php include ("tools/footer_new.php");?>
</body>
</html>