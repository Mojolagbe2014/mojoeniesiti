<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if($_SERVER['REQUEST_URI'] == "/training-providersTraining"){
	header("location: training-providers");
}
$advert ="";
$pg = "";

function GetCatName($id){
	$result = MysqlSelectQuery("select * from categories where category_id='$id'");
	$rows = SqlArrays($result);
	return $rows['category_name'];
}

$recordperpage =  20;
$pagenum = 1;
if(isset($_GET['page'])){
$pagenum = $_GET['page'];
$pg = " - Pg-".$_GET['page'];
}
$offset = ($pagenum - 1) * $recordperpage;
$countryQuery ="";
$location = "";

if(isset($_GET['countryid']) && isset($_GET['location'])){
$resultCT = MysqlSelectQuery("SELECT * FROM `countries` WHERE id = '".$_GET['countryid']."'");
$rowsCT = SqlArrays($resultCT);
$strip = str_replace($title_link,"-",$rowsCT['countries']);
$final = strtolower(str_replace("--","-",$strip));
header("location: ".SITE_URL."training-provider/".$final, true, 301);
}

else if(isset($_GET['stateid']) && isset($_GET['location'])){
$result = MysqlSelectQuery("SELECT * FROM `states` WHERE id_state = '".$_GET['stateid']."'");
$rows = SqlArrays($result);
header("Location: ".SITE_URL."state/".strtolower(str_replace($title_link,"-",$rows['name'])), true, 301);
exit();
}

else if(isset($_GET['category'])){
$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
$rows_cat = SqlArrays($categories);
$strip = str_replace($title_link,"-",$rows_cat['category_name']);
$final = strtolower(str_replace("--","-",$strip));
header("location: ".SITE_URL."training-provider/".$final, true, 301);
}
else{
if (isset($_GET['categories'])){
$title = trimStringToFullWord(60, stripslashes(strip_tags("Training providers and professional bodies by category "))).$pg;
$meta=trimStringToFullWord(150, stripslashes(strip_tags("Training providers, training institutions, management development centres, colleges and institutions by category".$pg)));
$location = "List of training providers | training institutions |training firms / consultants | professional associations / bodies by categories";
}
else{
$view = '';
$paging = SITE_URL."training-providers?get";
$title = trimStringToFullWord(60, stripslashes(strip_tags("Training providers and professional bodies around the world "))).$pg;
$meta=trimStringToFullWord(150, stripslashes(strip_tags("Training providers, training institutions, management development centres, colleges and institutions around the world".$pg)));
$location = "Training providers in Nigeria, Africa, Asia, North/South America, Europe and Oceania";
}
}
$result = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium=3 $countryQuery order by rand() limit $offset , $recordperpage");
$num = NUM_ROWS($result);
$advert = "Training Providers";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/bootstrap.min.css">
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $meta;?>"/>
<meta name="keywords" content="training providers, training houses in nigeria, professional institutes, associations, management consultants,facilitators, training bodies ">
<meta name="keywords" content="training providers, training houses, in nigeria, professional institutes, consultants, associations, management consultants,facilitators, training bodies ">
<meta name="dcterms.description" content="<?php echo $meta;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta;?>" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/headers_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table style="width:100%;border:0px">
    <tr><td>&nbsp;</td></tr>
<tr>
<td style="padding-left:8px;text-align:center;"><h2 style="font-size:23px;margin:0px"><?php echo $location;?></h2></td>
</tr>
</table>
</div>
<div id="subpage">
<div>
<?php if (isset($_GET['countries'])){?>
<?php
$today = date("Y-m-d");
$categories = MysqlSelectQuery("select * from countries order by countries");
$total_item = NUM_ROWS($categories);
$colSize = 67;
$column = 0; // init a column counter
for($count=0; $count< $total_item; $count++) {
$rows = SqlArrays($categories);
$isStartOfNewColum = 0 === ($count % $colSize); // modulo
$isEndOfColumn = ($count && $isStartOfNewColum);
$isStartOfNewColum && $column++; // update column counter
if ($isEndOfColumn) {
echo "</ul></div>";
}
if ($isStartOfNewColum) {
echo'<div class="link_box">
<ul>';
}
$strip = str_replace($title_link,"-",$rows['countries']);
$final = strtolower(str_replace("--","-",$strip));
$num = MysqlSelectQuery("select category from events where country='".$rows['id']."' and status = 1 and SortDate >= '$today'");
$totalCat = NUM_ROWS($num);
echo '<li><a href="'.SITE_URL.'training-provider/'.$final.'" title="'.$rows['countries'].'" style="font-size:13px;"><img src="'.SITE_URL.'images/flags/medium/'.$rows['country_image'].'" style="vertical-align:middle;" alt="country logo"/> '.$rows['countries'].'</a></li>';
}
echo "</ul></div>";
?>
<?php }
else if(isset($_GET['categories'])){
$today = date("Y-m-d");
$categories = MysqlSelectQuery("select * from categories order by category_name");
$total_item = NUM_ROWS($categories);
$colSize = 13;
$column = 0; // init a column counter
for($count=0; $count< $total_item; $count++) {
$rows = SqlArrays($categories);
$isStartOfNewColum = 0 === ($count % $colSize); // modulo
$isEndOfColumn = ($count && $isStartOfNewColum);
$isStartOfNewColum && $column++; // update column counter
if ($isEndOfColumn) {
echo "</ul></div>";
}
if ($isStartOfNewColum) {
echo'<div class="link_box">
<ul>';
}
$strip = str_replace(" / ","-",$rows['category_name']);
$final = strtolower(str_replace($title_link,"-",$strip));
$num = MysqlSelectQuery("select specialization from businessinfo where business_type='Training' and specialization='".$rows['category_id']."'");
$totalCat = NUM_ROWS($num);
echo '<li><div class="col-md-6"><div class="feature-icon"><i class="glyphicon glyphicon-education"></i></div><div class="feature-text"><h5><a href="'.SITE_URL.'training-provider/'.$final.'" title="'.$rows['category_name'].'" style="font-size:11px; width:165px;">'.$rows['category_name'].'</a></h5></div></div></li>';
}
echo "</ul></div>";
}
else{ ?>
<div >
<?php
$i = 0;
$check_website ="";
$web = '';
while($rows = SqlArrays($result)){
if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
if($rows['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
$logo = MysqlSelectQuery("select * from logos where user_id ='".$rows['user_id']."' and user_id !=0");
$biz_logo = SqlArrays($logo);
$logoNum = NUM_ROWS($logo);
if($logoNum > 0)
{
$biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="30" height="30"/>';
}
else{ 
$image = '<img src="images/star.png" alt="business logo"/>';
}
switch($rows['premium']){
case 3:
$star = '<div class="star2"></div>';
$bg_class ='eventListing';
$listing_diff = '';
$view = '<div style="display:block;"><img src="images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>';
//$web = $check_website;
$start_tag = '<h2 style="font-size:12px; font-weight:normal;">';
$end_tag = '</h2>';
break;
}
?>
<a href="<?php echo SITE_URL;?>tprovider/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" class="eventListing"> <span class="spanTitle" style="background-color:#E3EBEE; display:block; padding:3px;"><?php echo $rows['business_name'];?></span>
<div class="trainingProviders" >
<span class="span"><?php echo substr(strip_tags(stripslashes($rows['description'])),0,160)."...";?></span>
</div>
<div class="testImg" style="background-image:url(<?php echo SITE_URL.$biz_logo;?>); background-repeat:no-repeat;">
</div>
<div class="trainingProviders">
<span class="provider">Contact:&nbsp;</span>
<span class="provider_name" style="width: 86.8852%;">
<span style="color:#000;">
<?php echo $rows['address'];?>
</span>
</span>
</div> 
<div class="ViewBox"><img src="<?php echo SITE_URL;?>images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>
<div class="clearfix"></div>
</a>
<?php
$i++;
}
?>
</div>
<div >
<?php
$i = 0;
$check_website ="";
$web = '';
$resultNonPremium = MysqlSelectQuery("select * from businessinfo where business_type='Training' $countryQuery and status =1 and premium != 1 order by business_name limit $offset , $recordperpage");
$num = NUM_ROWS($resultNonPremium);
while($rowsNonPremium = SqlArrays($resultNonPremium)){
if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
if($rowsNonPremium['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rowsNonPremium['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
$image = '<img src="images/star.png" alt="business logo"/>';
$star = '<div class="star1"></div>';
$bg_class ='eventListing_odd';
$listing_diff = '';
?>
<a href="<?php echo SITE_URL;?>tprovider/<?php echo $rowsNonPremium['business_id'].'/'.str_replace($title_link,"-",$rowsNonPremium['business_name']);?>" class="<?php echo $bg_class;?>"> <span class="spanTitle" style="background-color:#E3EBEE; display:block; padding:3px;"><?php echo $rowsNonPremium['business_name'];?></span>
<div class="trainingProviders">
<span class="span"><?php echo substr(strip_tags(stripslashes($rowsNonPremium['description'])),0,160)."...";?></span>
</div>
<div class="trainingProviders">
<span class="provider">Contact</span>
<span class="provider_name"><span style="color:#000"><?php echo $rowsNonPremium['address'];?></span></span>
</div> 
<div class="ViewBox"><img src="<?php echo SITE_URL;?>images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>
<div class="clearfix"></div>
</a>
<?php
$i++;
}
if($num > 0){
?>
<div id="paging1">
<?php
Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $countryQuery ",$recordperpage,$pagenum,$paging);
?>
</div>
<div id="paging2">
<?php
PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Training' and status =1 $countryQuery ",$recordperpage,$pagenum,$paging);
?>
</div>
<?php
}
/*else{
//echo errorMsg("found no training provider(s)");
}*/
?>
</div>
<?php 
}
?>
</div>
</div>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>
<script type="text/javascript">
$(document).ready(function(e) {


/*********** script to show the training providers on the search form **************/
//fires up the training providers when the keboard is pressed
$('#tsearch').keyup(function(){
$('#output_providers').fadeIn('slow');
$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Training'}, function(data) {

$('#output_providers').html(data)


});
})
//disappears the training providers when the text box looses focus
$('#tsearch').blur(function(){
$('#output_providers').fadeOut();

})
//displays the training providers when the text box gains focus
$('#tsearch').focus(function(){
$('#output_providers').fadeIn('slow');
$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
if($(this).val() == ""){
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {queryFocus:$(this).val(),type:'Training'}, function(data) {

$('#output_providers').html(data)


});
}
else{
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Training'}, function(data) {

$('#output_providers').html(data)


});
}
})


});
//funtion to retrieve the value from the training providers drop down
function GetProVal(elem){
var URL = $('#'+elem).attr('data');

$('#tsearch').val($('#'+elem).text());
$('#output_providers').hide();

$('#searchProvider').attr('action',URL)


}
</script>
</body>
</html>