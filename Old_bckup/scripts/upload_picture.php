<?php
session_start();
require_once("config.php");
require_once("functions.php");
if(connection());
$upload_result = 0;
$type = $_FILES['fileField']['type'];
$size = $_FILES['fileField']['size'];
$Filename = $_FILES['fileField']['name'];
$file_cv = random(20);
	
	$ext_cv = substr(strrchr($_FILES['fileField']['name'], "."), 1); 
	if($Filename == ""){echo $upload_result = 1;}
	else if($size > 1000000){
		$upload_result = 5;
	}
	else if(($ext_cv =="jpeg") || ($ext_cv =="jpg")||($ext_cv =="JPG") || ($ext_cv =="JPEG")||($ext_cv =="png") || ($ext_cv =="gif")){
	$name = random(20).md5($_FILES['fileField']['tmp_name']);
	$ext = substr(strrchr($_FILES['fileField']['name'], "."), 1); 
	$thumb = "../user/images/thumbs/".$name.".$ext";
	$pass = "../user/images/".$name.".$ext";
	move_uploaded_file($_FILES['fileField']['tmp_name'],$pass);
	thumbnail($pass,100,$thumb);
	$big_image = $name.".$ext";

$sql = "insert into pictures (user_id, images) values('".$_SESSION['biz_id']."','$big_image')";
	$result = mysql_query($sql) or die("Invalid Query".mysql_error());
$upload_result = 2;
							  }
							  else{
								 $upload_result = 3;
					}
							 
?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $upload_result;?>);
</script> 