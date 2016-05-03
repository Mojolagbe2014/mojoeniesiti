<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
require( dirname( __FILE__ ) . '/scripts/class-php-ico.php' );
$errors = array();
$advert = "Add Event";
$message = "";
$title = "Search Widget - Nigerian Seminars and Trainings";
$meta_description = "Add our training widget to enable you find training, seminars, conferences and workshops in Nigeria and around the world.";
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
<script type="text/javascript" src="<?php echo SITE_URL;?>css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
$("#code").click(function(e) {
$(this).select();
});
});
</script>
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
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;">Search Widget</h1></td>
</tr>
<tr>
<td style="font-size:16px"><h2 style="font-weight:normal; font-size: 13px;">Install our responsive search widget on your website</h2></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</div>
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px; margin-bottom:10px;"> 
<h3 style="display:block; padding:7px; font-size:18px; text-align:center; font-weight: normal">Widget Preview</h3>
<div style="width:60%; margin-left:auto; margin-right:auto;">
<?php
function dateCountDown(){
$currentYear = date('Y');
$startYear = 2010;
$ele = "";
for($currentYear = date('Y'); $currentYear >= $startYear ; $currentYear --){
$ele .='<option value="'.$currentYear.'">'.$currentYear.'</option>';
}
return $ele;
}
function Category(){
$result = MysqlSelectQuery("select * from categories");
$data = "";
while($rows = SqlArrays($result)){
$data .='<option value="'.$rows['category_id'].'">'.$rows['category_name'].'</option>';
}
return $data;
}
$data = '<div style="background-color:#00CC00;padding-top:10px">
<div style="color:#FFF; text-align:center; padding:5px; font-size:16px;">
Nigerian Seminars and Training Search Widget
</div>
<form id="NST_Widget_Form" name="form1" target="_blank" method="post" action="https://www.nigerianseminarsandtrainings.com/tools/widget/redirect.php" class="smart-forms"  style="float:none">
<table class="contact_provider_table_responsive" style="width:100%">
<tr>
<td colspan="2" style="width:85%">
<div class="search_inputs"> 
<label class="field select">
<select name="category" id="nst_category">
<option value="">Choose Category</option>

'.Category().'

</select>
<i class="arrow double"></i>
</label>
</div>
</td></tr>
<tr>
<td style="width:34%"><div class="search_inputs"> 
<label class="field select">
<select name="year" id="nst_year">
<option value="">Select Year</option>

'.dateCountDown().'

</select>
<i class="arrow double"></i>
</label>
</div></td>
<td style="width:66%"><div class="search_inputs"> 
<label class="field select">
<select name="month" id="nst_month">
<option value="">Select Month</option>
<option value="January">January</option>
<option value="February">February</option>
<option value="March">March</option>
<option value="April">April</option>
<option value="May">May</option>
<option value="June">June</option>
<option value="July">July</option>
<option value="August">August</option>
<option value="September">September</option>
<option value="October">October</option>
<option value="November">November</option>
<option value="December">December</option>
</select>
<i class="arrow double"></i>
</label>
</div></td>
</tr>
<tr>
<td colspan="2">
<div class="search_inputs">
<label class="field select">
<select name="country" id="nst_country" onChange="GetState()">
'.GetContries().'

</select>
<i class="arrow double"></i>
</label>
</div>
</td></tr>
<tr>
<td colspan="2" style="text-align:center">
<div class="search_inputs">
<label class="field select" id="nst_stateSelect" >
<select name="state" id="state" >
<option value="">Select state (Nigeria only)</option>
'.GetState().'
</select>
<i class="arrow double"></i>
</label>
</div>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center;padding:5px;">
<button class="button btn-primary" type="submit" name="submit"> Submit </button>
</td>
</tr>
</table>
</form></div>';
echo $data;
 ?>
<p style="display:block; padding:7px; font-size:18px; text-align:center;">Copy Code</p>
<textarea style="display:block; width:100%; background-color:#EAEAEA; margin-bottom:5px; margin-top:5px; height:90px;" id="code">
&lt;script type=&quot;text/javascript&quot; src=&quot;https://www.nigerianseminarsandtrainings.com/js/form-widget.js&quot; &gt;&lt;/script&gt;<br>
&lt;div id=&quot;NST_Widget&quot;&gt;&lt;/div&gt;
</textarea>
</div>
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