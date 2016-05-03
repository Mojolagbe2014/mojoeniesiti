<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
$paged = "";
	if(connection());
	if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: '.SITE_URL.'login');
	exit;
}
	$recordperpage = 10;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;
$advert = "Add Event";
$result = MysqlSelectQuery("select * from pictures WHERE user_id = '".$_SESSION['user_id']."'ORDER BY image_id limit $offset, $recordperpage");
if(isset($_GET['del']) && $_GET['image']){
	unlink('images/thumbs/'.$_GET['image']);
	unlink('images/'.$_GET['image']);
	MysqlQuery("delete from pictures where image_id='".$_GET['del']."' and user_id='".$_SESSION['user_id']."'");
	header("location: gallery");
}
?>
<!DOCTYPE html>

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
 

	<title>Manage Gallery: Nigerian Seminars and Trainings.com </title>

<meta name="description" content="Add your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	
	<!--	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->
    <link rel="stylesheet" href="css/prettyphoto.css" type="text/css" media="screen" />
     <?php include("../scripts/headers_new.php");?>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script src="../js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="../js/calender.js"></script>
  <script type="text/javascript" src="../js/jquery.prettyphoto.js"></script>
  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>

  <script language="javascript" type="text/javascript">
  function delete_image(val, val_image){
	  if(confirm("Are you sure you want to delete this image?")){
	  window.location = 'gallery?del='+val+'&image='+val_image;
				 }
  }
  
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
         result = '<span style="color:#090">Image was uploaded successfully!</span>';
		 timedRefresh(2000);
      }
	   else if (success == 5){
         result = '<span style="color:#F00">File too large!, image should not be more than 1mb</span>';
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
	 document.getElementById('f1_upload_process').style.display = 'none';
      document.getElementById('message').innerHTML = result ;
	  document.getElementById('message').style.display = 'block';
      document.getElementById('f1_upload_form').style.display = 'none'; 
	   document.getElementById('file').innerHTML = '<input name="fileField" type="file" id="fileField" size="45" />';
	   
      return true;   
}
//-->
function complete(stat){
	 document.getElementById('f1_upload_process').style.display = stat;
      document.getElementById('message').innerHTML = result ;
	  document.getElementById('message').style.display = 'block';
      document.getElementById('f1_upload_form').style.display = stat; 
	   document.getElementById('file').innerHTML = '<input name="fileField" type="file" id="fileField" size="45" />';
}
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
</script> 
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script>

			
<?php include("../tools/header_new.php");?>

<div id="main">
	 <?php include('userstools/menu.php');?>
     
		<div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; min-height:120px; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-photo"></i>&nbsp; Business Images</h2></td>
    <td width="21%" style="padding-left:8px">&nbsp;</td>
    </tr>
  
</table>
</form>
</div>			
		
<div id="tab_slider">
				<div id="subpage" class="smart-forms">
					
					<div id="subpage_content">
					  <p><?php echo $message;?></p>
						<p><a href="gallery_new" class="add" >Add Image </a></p>
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
                  <?php

				if(NUM_ROWS($result) > 0){

						
					$i = 1;

					while($rows = SqlArrays($result)){

						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}

						?>

				  <div class="gallery" id="<?php echo $rows['image_id'];?>"><a href="images/<?php echo $rows['images'];?>" rel="prettyPhoto[web]"><img  class="img_mix" src="images/<?php echo $rows['images'];?>" width="50%" height="50%" /></a><br />
				     <a href="javascript: void(0)" onclick="delete_image(<?php echo $rows['image_id'];?>,'<?php echo $rows['images'];?>')" style="font-size:10px" title="Delete" class="delete" >Delete</a></div>


  <?php

  $i++;

					}


   if(connection()){

                    

   }

				}

   else{

   echo '<div class="alert notification spacer-b30 alert-error">found no image for this business</div>';

   }

					 ?>

                </div>

		    </div>
						</div>
						
					</div>
				</div>
                
                </div>
                
 
                <!-- end subpage -->
					
		</div>
		
		<?php include("../tools/side-menu_new.php");?>
	</div>
    
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