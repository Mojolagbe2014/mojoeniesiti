<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($vacancies);
while (list ($key, $val) = each ($vacancies)) {
if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
}
if(connection());
$message = '';
$advert = "Add Vacancies";
require_once("scripts/insertions.php");	
$random = random(8);
$errors = array();
if(isset($_POST['submit_application'])){


if($_POST['name'] == "")$errors[] = "Please enter your Name";
if(!smcf_validate_email($_POST['email']))$errors[] = "Please enter a valid email";
if($_POST['phone'] == "")$errors[] = "Please enter your Phone number";
if($_FILES['upload']['name'] == "")$errors[] = "Please Upload your CV";
if($_POST['position'] == "")$errors[] = "Please select position you are applying for";
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

$folder = "webmastersCv-pdf/";
$Filename = $_FILES['upload']['name'];
$ext_file = substr(strrchr($Filename, "."), 1); 
$size = $_FILES['upload']['size'];
if($ext_file=="pdf"||$ext_file=="docx"||$ext_file=="doc"){
$date=date('Y-m-d');


MysqlQuery("insert into webvacancy (name,email,phone,filename,filetype,filesize,subdate,category) values('".addslashes($_POST['name'])."','".addslashes($_POST['email'])."','".addslashes($_POST['phone'])."','$Filename','$ext_file','$size','$date','".$_POST['position']."')");
copy($_FILES['upload']['tmp_name'],$folder.$Filename);
header("location: ".$_SERVER['PHP_SELF']."?detail=sucess&confirmation=success");

}
else{
$message = errorMsg("Invalid Format");
}

}
}
?>
<?php
if(isset($_GET['detail'])){
$message= successMsg("Your application has been submitted successfully!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>Submit Your Application - Nigerian Seminars and Trainings</title>
<meta name="description" content="Submit your application on Nigerian Seminars and Trainings.com."/>
<?php include("scripts/headers_new.php");?>
<script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="css/smartforms/js/js/additional-methods.js"></script>
<script type="text/javascript">
    $(function() {
        function reloadCaptcha(){
        $("#captcha").attr("src","tools/captcha.php?r=" + Math.random());
        }

        $('.refresh-captcha').click(function(e){
        e.preventDefault();
        reloadCaptcha();
        });
    });
</script>

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
</script>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:24px; padding:5px;"><p>Submit Application</p></h1></td>
</tr>
<tr>
<td align="center" style="font-size:11px"><h2>&nbsp;</h2></td>
</tr>
</table>
</form>
</div>

<div id="tab_slider">

<div id="subpage">

<div id="subpage_content">
<div id="contact-wrapper" class="rounded smart-forms" style="margin-top:8px; padding-top:8px;"> 
<?php echo $message;?>


<form action="" method="post" id="applicationForm" enctype="multipart/form-data">

<table border="0" class="event_detail">
<tr>

<td colspan="2">

<label class="field prepend-icon">
<input name="name" type="text" class="gui-input" placeholder="Name" id="name" value="" size="40" /><label class="field-icon"><i class="fa fa-user"></i></label>  
</label>

</td>
</tr>
<tr>

<td colspan="2">

<label class="field prepend-icon">
<input name="email" type="email" class="gui-input" placeholder="Email" id="email" value="" size="40" /><label class="field-icon"><i class="fa fa-envelope"></i></label>  
</label>

</td>
</tr>
<tr>

<td colspan="2">
<label class="field prepend-icon">
<input name="phone" type="text" class="gui-input" placeholder="Telephone" id="phone" value=""/>
<label for="mobile_phone" class="field-icon"><i class="fa fa-phone"></i></label>
</label>
</td>
</tr>


<tr>
<td colspan="4">


<label class="field prepend-icon">
<input name="position" type="text" class="gui-input" placeholder="Position Applying for" id="position" value=""/>
<label for="mobile_phone" class="field-icon"><i class="fa fa-asterisk"></i></label>
</label>

</td>
</tr>
<tr>

<td colspan="4">

<div class="section">
<label class="field prepend-icon file">
<span class="button btn-primary"> Choose File </span>
<input type="file" class="gui-file" name="upload" id="upload" onChange="document.getElementById('uploader2').value = this.value;">
<input type="text" class="gui-input" id="uploader2" placeholder="no file selected" readonly>
<label class="field-icon"><i class="fa fa-upload"></i></label>
</label>
</div>

    <h3 style="font-size:12px; font-weight: normal"><span style="color:#F00">(PDF or Ms-Word files only)</span></h3></td>
</tr>
<tr>

<td width="38%">
<div class="smart-widget sm-left sml-120">
<label class="field">
<input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
</label>
<label for="securitycode" class="button captcode">
<img src="tools/captcha.php" id="captcha" alt="Captcha">
<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
</label>
</div> 
</td>
</tr>
<tr>
<td colspan="2">
<button type="submit" class="button btn-primary" name="submit_application" id="submit_vacancies">Submit</button> 
</td>
</tr>
</table>
</form>
</div>
<div id="contact-info">
</div>
</div>
</div>
</div><!-- end subpage -->
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<?php include ("tools/footer_new.php");?>
<script>
    _qevents.push({
    qacct:"p-2fH5lI6K2ceJA"
    });
</script>
<noscript>
    <div style="display:none;">
    <img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
    </div>
</noscript>

</body>
</html>