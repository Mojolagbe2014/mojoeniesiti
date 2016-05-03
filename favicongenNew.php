<?php
// bgallz.org - Web coding and design tutorials, scripts, resources and more.
// favicon Generator Script
require( dirname( __FILE__ ) . '/scripts/class-php-ico.php' );



if(isset($_GET["do"])){
if($_GET["do"] == "create"){
if(isset($_POST["submit"])){


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

move_uploaded_file($postvars["image_tmp"],$directory.$filename);


$ico_lib = new PHP_ICO( $directory.$filename, array( array( 32, 32 )));
$ico_lib->save_ico( $directoryGen."favicon.ico" );

//echo $gen_favicon;
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
<form action="favicongenNew.php?do=create"  enctype="multipart/form-data" method="post">
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