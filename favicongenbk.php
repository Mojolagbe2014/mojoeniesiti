<?php
// bgallz.org - Web coding and design tutorials, scripts, resources and more.
// favicon Generator Script


function thumbnail($source,$thumb_width,$destination){
	//$image="";
	$ext = substr(strrchr($source, "."), 1); 	
	$size = getimagesize($source);
	$width = $size[0];
	$height = $size[1];
	$x = 0;
	$y = 0;
	if ($width > $height){
		$x = ceil(($width - $height) / 2 );
		$width = $height;
	}
	elseif($height > $width ){
		$y = ceil(($height - $width) / 2);
		$height = $width;
	}
	$newimage = @imagecreatetruecolor($thumb_width,$thumb_width) or die("Cannot GD image stream");
	switch ($ext){
		case"jpg":
		$image = imagecreatefromjpeg($source);
		break;
		case"JPG":
		$image = imagecreatefromjpeg($source);
		break;
		case"JPEG":
		$image = imagecreatefromjpeg($source);
		break;
		case"jpeg":
		$image = imagecreatefromjpeg($source);
		break;
		case"gif":
		$image = imagecreatefromgif($source);
		break;
		case"png":
		$image = imagecreatefrompng($source);
		break;
	}
	imagecopyresampled($newimage,$image,0,0,$x,$y,$thumb_width,$thumb_width,$width,$height);
	//imageantialias($destination, TRUE);
		
		switch ($ext){
		case"jpg":
		imagejpeg($newimage,$destination);
		break;
		case"JPG":
		imagejpeg($newimage,$destination);
		break;
		case"JPEG":
		imagejpeg($newimage,$destination);
		break;
		case"jpeg":
		imagejpeg($newimage,$destination);
		break;
		case"gif":
		imagegif($newimage,$destination);
		break;
		case"png":
		imagepng($newimage,$destination);
		break;
	}
	
}





function generate_favicon(){
// Create favicon.
$postvars = array("image" => trim($_FILES["image"]["name"]),
"image_tmp"        => $_FILES["image"]["tmp_name"],
"image_size"    => (int)$_FILES["image"]["size"],
"image_dimensions"    => (int)$_POST["image_dimensions"]);
$valid_exts = array("jpg","jpeg","gif","png");
//$ext = end(explode(".",strtolower(trim($_FILES["image"]["name"]))));
$ext = substr(strrchr($_FILES["image"]["name"], "."), 1);
$directory = "./favicon/"; // Directory to save favicons. Include trailing slash.
$directoryGen = "./favicon/gen/"; // Directory to save favicons. Include trailing slash.
$rand = rand(1000,9999);
$filename = $rand.$postvars["image"];
$newwidth = $postvars["image_dimensions"];
$newheight = $postvars["image_dimensions"];

move_uploaded_file($postvars["image_tmp"],$directory.$filename.".".$ext);

thumbnail($directory.$filename.".".$ext,$newwidth,$directoryGen.$filename.".".$ext);




if(file_exists($directory.$filename)){
// Image created, now rename it to its
$ext_pos = strpos($rand.$postvars["image"],"." . $ext);
$strip_ext = substr($rand.$postvars["image"],0,$ext_pos);
// Rename image to .ico file
rename($directory.$filename,$directory.$strip_ext.".ico");
return '<strong>Icon Preview:</strong><br/>
<img src="'.$directory.$strip_ext.'.ico" border="0" title="Favicon  Image Preview" style="padding: 4px 0px 4px 0px;background-color:#e0e0e0" />
Favicon successfully generated. <a href="'.$directory.$strip_ext.'.ico" target="_blank" name="Download favicon.ico now!">Click here to download your favicon.</a>';
	} 
}
if(isset($_GET["do"])){
if($_GET["do"] == "create"){
if(isset($_POST["submit"])){
// Call the generate favicon function and echo its returned value
$gen_favicon = generate_favicon();
echo $gen_favicon;
echo "Place your download instructions and anything else you want here to follow the download link after upload.";
}
}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<h2>Create Your Favicon</h2>
<form action="favicongenbk.php?do=create"  enctype="multipart/form-data" method="post">
<p><strong>Image Dimensions:</strong><br />
<select style="width:170px" name="image_dimensions">
<option value="16">16px x 16px</option>
<option value="32">32px x 32px</option>
</select></p>
<p><strong>Favicon Image:</strong>
<input name="image" size="40" type="file" /></p>
<input name="submit" type="submit" value="Submit!" />
</form>
</body>
</html>