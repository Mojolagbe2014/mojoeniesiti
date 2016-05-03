<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
require_once("img_resize/resize-class.php");
if(connection());
if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: '.SITE_URL.'login');
	exit;
}
$message = '';
$paged = "";
$advert = "Add Event";
$result = MysqlSelectQuery("select * from logos WHERE user_id = '".$_SESSION['user_id']."'");
if(NUM_ROWS($result) == 0){
	$image = "../images/no_icon.gif";
}
else{
	$rows = SqlArrays($result);
	$image = "logos/thumbs/".$rows['logos'];
}
$message = "";
	
if(isset($_POST['upload'])){
$upload_result = 0;
$type = $_FILES['fileField']['type'];
$size = $_FILES['fileField']['size'];
$Filename = $_FILES['fileField']['name'];
$file_cv = random(20);
	
	$ext_cv = substr(strrchr($_FILES['fileField']['name'], "."), 1); 
	if($Filename == ""){$upload_result = 1;}
	else if($size > 60000){
		$message = '<div class="alert notification spacer-b30 alert-error">Image too large! image must not be more than 60kb</div>';
	}
	else if(($ext_cv =="jpeg") || ($ext_cv =="jpg")||($ext_cv =="JPG") || ($ext_cv =="JPEG")||($ext_cv =="png") || ($ext_cv =="gif")){
		
		$name = random(20).md5($_FILES['fileField']['tmp_name']);
	$ext = substr(strrchr($_FILES['fileField']['name'], "."), 1); 
	$thumb = "logos/thumbs/".$name.".$ext";
	$pass = "logos/".$name.".$ext";
	
	move_uploaded_file($_FILES['fileField']['tmp_name'],$thumb);
	
	$resizeObj = new resize($thumb);

	// *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
	$resizeObj -> resizeImage(150, 150, 'auto');

	// *** 3) Save image
	$resizeObj -> saveImage($thumb, 100);

	$big_image = $name.".$ext";
	
		
		$sql1 = "SELECT * FROM logos WHERE user_id='".$_SESSION['user_id']."'";
		$result1 = MysqlSelectQuery($sql1);
		
	if(NUM_ROWS($result1) > 0){
		$rows = SqlArrays($result1);
		//remove existing file
		unlink("logos/thumbs/".$rows['logos']);
		//check if newly uploaded file exists
		if(file_exists($thumb))
			rename($thumb, "logos/thumbs/".$rows['logos']);//rename the file
		
		header("location: add_image?upload=success");
}
else{
$sql = "insert into logos (user_id, logos) values('".$_SESSION['user_id']."','$big_image')";
	$result = MysqlQuery($sql);
	header("location: add_image?upload=success");
}
							  }
							  else{
								  $message = '<div class="alert notification spacer-b30 alert-error">Invalid File Format! Please upload Image files only</div>';
					}
}
if(isset($_GET['upload'])){
	$message = '<div class="alert notification spacer-b30 alert-success">Logo was uploaded successfully!</div>';
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


	<title>Upload / Change Logo: Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	
<!--	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->

  
      <?php include("../scripts/headers_new.php");?>
     <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script src="../js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="../js/calender.js"></script>
   
  <script language="javascript" type="text/javascript">
<!--
function startUpload(){
      document.getElementById('f1_upload_process').style.display='block';
      document.getElementById('f1_upload_form').style.display = 'none';
	   document.getElementById('message').style.display = 'none';
      return true;
}

function stopUpload(success){
      var result = '';
      if (success == 1){
         result = '<span style="color:#F00">Please select file to upload</span>';
		 
		 document.getElementById('f1_upload_process').style.display = 'block';
      document.getElementById('message').innerHTML = result ;
	  document.getElementById('message').style.display = 'block';
      document.getElementById('f1_upload_form').style.display = 'block'; 
	   document.getElementById('file').innerHTML = '<input name="fileField" type="file" id="fileField" size="45" />';

      }
	 else if (success == 2){
         result = '<span style="color:#090">Logo was uploaded successfully!</span>';
		 timedRefresh(2000);
      }
	   else if (success == 4){
         result = '<span style="color:#090">Logo was updated successfully!</span>';
		 timedRefresh(2000);
      }
	  else if (success == 5){
         result = '<span style="color:#F00">Image too large! image must not be more than 60kb</span>';
		  document.getElementById('f1_upload_process').style.display = 'block';
      document.getElementById('message').innerHTML = result ;
	  document.getElementById('message').style.display = 'block';
      document.getElementById('f1_upload_form').style.display = 'block'; 
	   document.getElementById('file').innerHTML = '<input name="fileField" type="file" id="fileField" size="45" />';
		 
      }
	  else if (success == 3){
         result = '<span style="color:#F00"> Invalid File Format! Please upload Image files only </span>';
		 document.getElementById('f1_upload_process').style.display = 'block';
      document.getElementById('message').innerHTML = result ;
	  document.getElementById('message').style.display = 'block';
      document.getElementById('f1_upload_form').style.display = 'block'; 
	   document.getElementById('file').innerHTML = '<input name="fileField" type="file" id="fileField" size="45" />';

      }

	   complete('none');
      return true;   
}
//-->
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
function complete(stat){
	 document.getElementById('f1_upload_process').style.display = stat;
      document.getElementById('message').innerHTML = result ;
	  document.getElementById('message').style.display = 'block';
      document.getElementById('f1_upload_form').style.display = stat; 
	   document.getElementById('file').innerHTML = '<input name="fileField" type="file" id="fileField" size="45" />';
}
</script> 

</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header_new.php");?>

<div id="main">
	 <?php include('userstools/menu.php');?>
     
		<div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; min-height:120px; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:28px; padding:5px;"><i class="fa fa-upload"></i>&nbsp; Upload / Change Logo</h2></td>
    <td width="21%" style="padding-left:8px">&nbsp;</td>
    </tr>
  
</table>
</form>
</div>			
			
		
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
			
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper" class="rounded smart-forms" >
                         <?php echo $message;?>
                           
                          <div id="f1_upload_form">
                          <form action="" id="contactform2" method="post" enctype="multipart/form-data"  onsubmit="startUpload();" >
                         
                          <table width="100%" border="0">
  <tr>
    <td align="center"> <div class="gallery2"><img  class="img_mix" src="<?php echo $image;?>" width="150" height="150" /></div></td>
    </tr>
  <tr>
    <td align="center">
      
      <div class="section">
        <label class="field prepend-icon file">
        <span class="button btn-primary"> Choose File </span>
        <input type="file" class="gui-file" name="fileField" id="fileField" onChange="document.getElementById('uploader2').value = this.value;">
        <input type="text" class="gui-input" id="uploader2" placeholder="no file selected" readonly>
        <label class="field-icon"><i class="fa fa-upload"></i></label>
        </label>
        </div>
      
    </td>
    </tr>
  <tr>
    <td align="center"><button class="button btn-primary" type="submit" name="upload">Upload</button></td>
    </tr>
  <tr>
    <td align="center"><span style="color:#F00">Please logo must not be more than 60kb, width x Height = 150 x 150</span></td>
    </tr>
                          </table>

                          </form>
                          </div>
                          </div>
                           <div id="contact-info">
						   
					     </div>
						</div>
						
					</div>
				</div>
                
          </div>
                <!-- end subpage -->
                <div id="tab_slider"></div>
					
		</div>
		
		<?php include("../tools/side-menu_new.php");?>
	</div>
   
	<div id="content_bottom"></div>
	

	<div class="clearfix"></div>
</div>
	<?php include("../tools/footers_new.php");?>
</div>
</div>
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