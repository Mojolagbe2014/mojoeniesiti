<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");

ob_start();

$message = '';

if(connection());
function getMetaTitle($url){
$content = file_get_contents($url);
$pattern = "|<[\s]*title[\s]*>([^<]+)<[\s]*/[\s]*title[\s]*>|Ui";
if(preg_match($pattern, $content, $match))
return $match[1];
else
return $url;
}

$advert = "Sitemap";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title> Sitemap Page - Nigerian Seminars and Trainings</title>
<meta name="description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website"/>
<meta name="dcterms.description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website" />
<meta property="og:title" content="Sitemap Page - Nigerian Seminars and Trainings" />
<meta property="og:description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website" />
<meta property="twitter:title" content="Sitemap Page - Nigerian Seminars and Trainings" />
<meta property="twitter:description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website" />
<?php include("scripts/headers_new.php");?>
<style type="text/css">
.right_ele{
width:229px;
height:140px;
float:left;
margin-right: 7px;
margin-bottom: 7px;
border-color:#999

}

.right_ele ul li {
margin-left: 14px;
list-style-position: inside; line-height:20px; list-style: none; 
}

.right_ele ul li a{ text-decoration:none;

}

.right_ele ul li a:hover{ text-decoration: underline;

}

.righth{
width:150px;
height:140px;
float:left;
margin-right: 7px;
margin-bottom: 7px;	
}

.righth ul li {
margin-left: 14px;
list-style-position: inside; line-height:20px; list-style:square; 
}

.righth ul li a{ text-decoration:none;

}

.righht ul li a:hover{ text-decoration: underline;

}
#event{
width:110px;
height:200px;
float:left;
margin-right: 7px;
}

#event ul li {
margin-left: 8px;
list-style-position: inside; line-height:20px;
}

.heading{
width:220px;
height:35px;
float:left;
margin-right: 7px;
margin-bottom: 7px;	
}
#heading2{

width:185px;
height:30px;
float:left;
margin-right: 7px;
margin-bottom: 7px;

}

</style>
</head>

<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<table style="width:100%;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h1 style="font-size:26px; padding:5px;">Sitemap</h1></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</div>
<div id="subpage">
<div id="subpage_content_ad1">
<div class="tabs righth">
<h2 style="font-size:12px; font-weight:bold">Quick links</h2>
<ul>
<li><a href="<?php echo SITE_URL;?>" title="Home Page">Home</a></li>
<li><a href="<?php echo SITE_URL;?>about" title="About Us Page">About Us</a></li>
<li><a href="<?php echo SITE_URL;?>advertise" title="Advertise Page">Advertise</a></li>
</ul>
</div>
<div class="tabs righth">
<h3 style="font-size:12px; font-weight:bold">Find Vendors</h3>
<ul>
<li><a href="<?php echo SITE_URL;?>venues" title="Venue Providers">Venue Providers</a></li>
<li><a href="<?php echo SITE_URL;?>event-managers" title="Event Managers">Event Managers</a></li>
<li><a href="<?php echo SITE_URL;?>suppliers" title="Equipment Suppliers" >Equipment Suppliers</a></li>
<li><a  href="<?php echo SITE_URL;?>article-submission" title="Frequerntly asked questions">Articles Submission</a></li>
</ul>
</div>
<div class="tabs righth">
<p style="font-size:12px; font-weight:bold">Subscription</p>
<ul>
<li><a  href="<?php echo SITE_URL;?>rss" title="RSS Feed page" >RSS Feed</a></li>
<li><a  href="<?php echo SITE_URL;?>premium-listing" title="Premium Listing"  >Premium Listing</a></li>
<li><a  href="<?php echo SITE_URL;?>subscribers" title="Updates / Newsletter">Updates / Newsletter</a></li>
<li><a  href="<?php echo SITE_URL;?>quoteArchive" title="Watch Training Video">Quotes</a></li>
<li><a  href="<?php echo SITE_URL;?>faq" title="Frequerntly asked questions">FAQ</a></li>
</ul>
</div>
<div class="tabs righth">
<p style="font-size:12px; font-weight:bold">Resources</p>
<ul>
<li><a  href="<?php echo SITE_URL;?>all-vacancies" title="Find Jobs">Find Jobs</a></li>
<li><a  href="<?php echo SITE_URL;?>videos-all" title="Watch Training Video">Watch Training Video</a></li>
<li><a  href="<?php echo SITE_URL;?>archive" title="News Archive">News Archive</a></li>
<li><a  href="<?php echo SITE_URL;?>articles" title="List of articles">Articles</a></li>
</ul>
</div>
</div>
<div class="subpage_content_ad"> 
<div class="subpage_content_ad">
<div class="heading">
<p   style="font-size:12px; font-weight:bold;text-align:left">Events by Location (Global)</p>
</div>
<div class="heading" >
<p style="font-size:12px; font-weight:bold;text-align:left">Events in Nigeria</p>
</div>
<div class="heading" >
<p style="font-size:12px; font-weight:bold;text-align:left">Events by category</p>
</div>
</div><br /><br />
<div class="right_ele" style="height:400px; overflow:scroll;">
<?php
$countries = MysqlSelectQuery("select * from countries order by countries asc");
?>
<ul>
<?php
while($rows = SqlArrays($countries)){
$strip = str_replace($title_link,"-",$rows['countries']);

$final = strtolower(str_replace("--","-",$strip));
?>
<?php echo '<li><a href="'.SITE_URL.strtolower($final).'">'.$rows['countries'].'</a></li>';?>
<?php 
}
?>
</ul>
</div>
<div class="right_ele" style="height:400px; overflow:scroll;">
<?php
$countries = MysqlSelectQuery("select * from states order by name");
?>
<ul>
<?php
while($rows = SqlArrays($countries)){
$strip = str_replace(" / ","-",$rows['name']);

$final = str_replace(" ","-",$strip);
?>
<?php echo '<li><a href="'.SITE_URL.strtolower($final).'" title="'.$rows['name'].'">'.$rows['name'].'</a></li>';?>
<?php 
}
?>
</ul>
</div>


<div class="right_ele" style="height:400px; overflow:scroll;">
<?php
$categories = MysqlSelectQuery("select * from categories order by category_name");

?>
<ul>
<?php
while($rows = SqlArrays($categories)){
$strip = str_replace(" / ","-",$rows['category_name']);

$final = strtolower(str_replace($title_link,"-",$strip));
?>
<?php echo '<li><a href="'.SITE_URL.$final.'" title="'.$rows['category_name'].'" >'.$rows['category_name'].'</a></li>';?>

<?php 
}
?>
</ul>
</div>


</div>

<div class="subpage_content_ad">
<div class="subpage_content_ad"><br />
<div class="heading">
<p style="font-size:12px; font-weight:bold;text-align:left">Training Providers by Location (Global)</p>
</div>

<div class="heading">
<p style="font-size:12px; font-weight:bold;text-align:left">Training Providers in Nigeria</p>

</div><div class="heading">
<p style="font-size:12px; font-weight:bold; letter-spacing:inherit;text-align:left;">Training Providers by Category</p>

</div>
</div>
<div class="right_ele" style="height:400px; overflow:scroll;scrollbar-base-color: orange; ">
<p style="font-size:13px; font-weight:bold">&nbsp;</p>
<?php
$countries = MysqlSelectQuery("select * from countries order by countries asc");
?>
<ul>
<?php
while($rows = SqlArrays($countries)){
$strip = str_replace($title_link,"-",$rows['countries']);

$final = strtolower(str_replace("--","-",$strip));
?>
<?php echo '<li><a href="'.SITE_URL.'training-provider/'.strtolower($final).'" title="'.$rows['countries'].'">'.$rows['countries'].'</a></li>';?>
<?php 
}
?>
</ul>
</div>
<div class="right_ele" style="height:400px; overflow:scroll;">
<p style="font-size:13px; font-weight:bold">&nbsp;</p>
<?php
$countries = MysqlSelectQuery("select * from states order by name");

?>
<ul>
<?php
while($rows = SqlArrays($countries)){
$strip = str_replace($title_link,"-",$rows['name']);
$final = str_replace(" ","-",$strip);
?>
<?php echo '<li><a href="'.SITE_URL.'training-provider/'.strtolower($final).'" title="'.$rows['name'].'" >'.$rows['name'].'</a></li>';?>
<?php 
}
?>
</ul>
</div>
<div class="right_ele" style="height:400px; overflow:scroll; ">

<?php
$categories = MysqlSelectQuery("select * from categories order by category_name");

?>
<ul>
<?php
while($rows = SqlArrays($categories)){
$strip = str_replace(" / ","-",$rows['category_name']);

$final = strtolower(str_replace($title_link,"-",$strip));
?>
<?php echo '<li><a href="'.SITE_URL.'training-provider/'.$final.'" title="'.$rows['category_name'].'" >'.$rows['category_name'].'</a></li>';?>

<?php 
}
?>
</ul>
</div>
</div>
<div>
</div> 
<div id="latest_content_items">
<!-- Section 1 Featured -->
<!-- End Featured 1 -->
</div><!-- end latest_content_items -->
</div>
<div id="sub_links"><div id="sub_links2_middle">
<?php 
echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div></div><!-- end subpage -->
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>