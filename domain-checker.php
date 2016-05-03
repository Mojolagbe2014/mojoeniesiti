<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
require( dirname( __FILE__ ) . '/scripts/class-php-ico.php' );
$errors = array();
$advert = "Add Event";
$message = "";
$title = "Domain Name Checker - Nigerian Seminars and Trainings";
$meta_description = "Use our free domain name checker tool to check availabilty of any domain name";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title; ?></title>
<meta name="description" content="<?php echo $meta_description;?>"/>
<meta name="keywords" content="<?php echo $title; ?>" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title; ?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<?php include("scripts/headers_new.php");?>
<script type="text/javascript" src="js/jquery_1.5.2.js"></script>
<script type="text/javascript" src="js/post_watermarkinput.js"></script>
<script type="text/javascript" src="js/vpb_script.js"></script>
<style>
/*Form Wrapper*/
.vpb_main_wrapper
{
width:430px;
margin: 0 auto;
border: solid 1px #cbcbcb;
background-color: #FFF;
box-shadow: 0 0 15px #cbcbcb;
-moz-box-shadow: 0 0 15px #cbcbcb;
-webkit-box-shadow: 0 0 15px #cbcbcb;
-webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;
padding:10px;
padding-left:40px;
padding-right:0px;
padding-top:20px;
font-family:Verdana, Geneva, sans-serif;
font-size:11px;
}


#vasplus_pb {
border:1px solid #F1F1F1;
font-family:Verdana,"Lucida Grande",Arial,Helvetica,Sans-Serif;
font-size:12px;
margin:0px;
padding:5px;
min-width:120px;
text-align:left
}


#vasplus_pb span {
font-family:Verdana;
font-size:12px;
font-style:normal;
padding:3px 5px;
}

#vasplus_pb .taken span {background: #F08F78; margin-right:5px;}
#vasplus_pb .available span { background: #bce67b; margin-right:5px; }


/*Textarea Boxes and Input Boxes Style*/
.vpb_textAreaBoxInputs {min-width:278px; width:auto;height:21px;font-family:Verdana, Geneva, sans-serif; font-size:12px;padding:7px; padding-left:10px; padding-right:10px;border: 1px solid #6CF;outline:none;border-radius: 2px;-moz-border-radius: 2px;-webkit-border-radius:2px; line-height:20px;}
.vpb_textAreaBoxInputs:focus {outline:none;border: 1px solid #6CF;box-shadow: 0 0 10px #6AB5FF;-moz-box-shadow: 0 0 10px #6AB5FF;-webkit-box-shadow: 0 0 10px #6AB5FF;}


/*Error Message Style*/
.info { width:350px;border: 1px solid #999; padding:12px 20px 12px 20px; font: bold 12px verdana;-moz-box-shadow: 0 0 5px #888; -webkit-box-shadow: 0 0 5px#888;box-shadow: 0 0 5px #888;text-shadow: 2px 2px 2px #ccc;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;font-family:Verdana, Geneva, sans-serif; font-size:11px; line-height:20px;font-weight:normal;color: black;background: #BDE5F8;}


/*Vasplus Button*/
.vpb_general_button 
{
background-color: #7fbf4d;
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #7fbf4d), color-stop(100%, #63a62f));
background-image: -webkit-linear-gradient(top, #7fbf4d, #63a62f);
background-image: -moz-linear-gradient(top, #7fbf4d, #63a62f);
background-image: -ms-linear-gradient(top, #7fbf4d, #63a62f);
background-image: -o-linear-gradient(top, #7fbf4d, #63a62f);
background-image: linear-gradient(top, #7fbf4d, #63a62f);
border: 2px solid #63a62f;box-shadow: 0 2px 3px #666666;-moz-box-shadow: 0 2px 3px #666666;-webkit-box-shadow: 0 2px 3px #666666;
color: #fff;
font-family:Verdana, Geneva, sans-serif;
font-size:14px;
text-align: center;
text-shadow: 0 -1px 0 #4c9021;
min-width: 70px;
width: auto;
padding:7px;
padding-bottom:7px;
text-decoration:none;
float:left;
}
.vpb_general_button:hover 
{
background-color: #76b347;
background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #76b347), color-stop(100%, #5e9e2e));
background-image: -webkit-linear-gradient(top, #76b347, #5e9e2e);
background-image: -moz-linear-gradient(top, #76b347, #5e9e2e);
background-image: -ms-linear-gradient(top, #76b347, #5e9e2e);
background-image: -o-linear-gradient(top, #76b347, #5e9e2e);
background-image: linear-gradient(top, #76b347, #5e9e2e);
box-shadow: 0 2px 3px #666666;
-moz-box-shadow: 0 2px 3px #666666;
-webkit-box-shadow: 0 2px 3px #666666;
cursor: pointer; 
}
</style>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div id="subpage">
<div class="event_table_inner">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px;text-align: center"><h1 style="font-size:24px; padding:5px;">Domain Availability Checker</h1></td>
</tr>
<tr>
<td style="font-size:16px; text-align:center;"><h2 style="font-weight:normal; font-size: 13px;">Use our free domain checker tool to check availabilty of any domain name</h2></td>
</tr>
<tr>
<td style="font-size:11px"><h3>&nbsp;</h3></td>
</tr>
</table>
</div>
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px; margin-bottom:10px;"> 
<?php echo $message;?>
<form method="post" id="eventForm" enctype="multipart/form-data">
<table class="event_detail">
<tr>
<td><div class="smart-widget sm-right smr-80">
<label class="field prepend-icon">
<input type="text" name="sub2" id="suggested_names" class="gui-input" placeholder="Enter enter domain name">
<span class="field-icon"><i class="fa fa-search"></i></span> 
</label>
<button type="button" class="button" onClick="vpb_check_this_domain();"> Search </button>
</div></td>
</tr>
<tr>
<td style="text-align:center;"><div id="vpb_search_status" style="width:100%;float:left; text-align:left;" ></div></td>
</tr>
</table>
</form>
</div>
</div>
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
</div>
<!-- end subpage -->
<?php include("tools/side-menu_new.php");?>	
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>