<?php 

if (!isset($_SESSION)) session_start(); 
header( "(anti-spam-content-type:) image/png" );

$enc_num = rand( 0, 9999 );
$key_num = rand( 0, 24 );
$hash_string = substr( md5( $enc_num ), $key_num, 5 ); 
$hash_md5 = md5( $hash_string );

$_SESSION['smartCheck']['securitycode'] = $hash_md5;

# Verification image backgrounds
$dir = dirname( dirname( __FILE__ ) ) . '/tools/';
$bgs = array(
	$dir . 'captch_images/cbg1.png',
	$dir . 'captch_images/cbg2.png',
	$dir . 'captch_images/cbg3.png',
	$dir . 'captch_images/cbg4.png',
	$dir . 'captch_images/cbg5.png',
	$dir . 'captch_images/cbg6.png'	
);
$background = array_rand( $bgs, 1 );

# Verification image variables
$img_handle 	= imagecreatefrompng( $bgs[$background]);
$text_colour 	= imagecolorallocate( $img_handle, 53,66,79);
$font_size 		= 5;
$rotate_img     = rand(-15, 15);

$size_array = getimagesize( $bgs[$background] );
$img_w = $size_array[0];
$img_h = $size_array[1];

$horiz = round( ( $img_w/2 )-( ( strlen( $hash_string )*imagefontwidth( 5 ) )/2 )  + $rotate_img, 1 );
$vert = round( ( $img_h/2 )-( imagefontheight( $font_size )/2 ) );

# Create the verification image
imagettftext($img_handle, 22, rand(0, -4), 5, 30, $text_colour, $dir . 'captch_images/zxxnoise.otf', $hash_string );
imagepng( $img_handle );

# Destroy the image 
imagedestroy( $img_handle);


?>