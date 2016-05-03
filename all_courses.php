<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$paged = "";
$category_query = "";
$title = "";
$pageInnerTitle = "";
$pastLink ="";
$pastEvent ="";
$today = date("Y-m-d");
$dtds3=date("F");
$advert = "";
$pg = "";
$recordperpage = 60;
$pagenum = 1;

if(isset($_GET['page'])){
$pg = " - Pg-".$_GET['page'];
$pagenum = $_GET['page'];
}
$offset = ($pagenum - 1) * $recordperpage;
if(isset($_GET['category'])){
//$query = " and category = '".$_GET['category']."' and status = 1 and SortDate >= '$today'";
$categories = MysqlSelectQuery("select * from categories where category_id = '".$_GET['category']."'");
$rows_cat = SqlArrays($categories);
$strip = str_replace($title_link,"-",strtolower($rows_cat['category_name']));
header("HTTP/1.0 404 Not Found");
header("location: ".SITE_URL.$strip); //header("location: ".SITE_URL."category/".$strip, true, 301);
}
else if(isset($_GET['countryid']) && isset($_GET['location'])){
$resultCT = MysqlSelectQuery("SELECT * FROM `countries` WHERE id = '".$_GET['countryid']."'");
$rowsCT = SqlArrays($resultCT);
$strip = str_replace($title_link,"-",$rowsCT['countries']);
$final = strtolower(str_replace("--","-",$strip));
header("HTTP/1.0 404 Not Found");
header("location: ".SITE_URL.$final);
}
else if(isset($_GET['stateid']) && isset($_GET['location'])){
$result = MysqlSelectQuery("SELECT * FROM `states` WHERE id_state = '".$_GET['stateid']."'");
$rows = SqlArrays($result);
header("HTTP/1.0 404 Not Found");
header("Location: ".SITE_URL.strtolower(str_replace($title_link,"-",$rows['name'])));
exit();
}
else if (isset($_GET['category_list'])){
$pageInnerTitle = 'Upcoming conferences, training seminars by categories';
$advert = "All Events";
$meta_description = 'Search all upcoming conferences, training, seminars, workshop and symposiums by categories.'.$pg;
$title = "Upcoming conferences, training and seminars by categories".$pg;
}
else if(isset($_GET['state_list'])){
$pageInnerTitle = 'Upcoming conferences, training seminars by states in Nigeria';
$advert = "All Events";
$meta_description = 'Search all upcoming conferences, training, seminars and workshops in Nigeria according to states.'.$pg;
$title = "Upcoming conferences | training | seminars by states in Nigeria";
}
else{
$pageInnerTitle = 'Upcoming conferences, training seminars by countries';
$advert = "All Events";
$meta_description = 'Search upcoming conferences, training, seminars, workshops and exhibitions in different countries around the world.'.$pg;
$title = "Conferences |training |seminars |courses |workshops by countries";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo SITE_URL;?>css/bootstrap.min.css">
<title><?php echo substr(trim($title), 0, 65);?></title>
<meta name="description" content="<?php echo $meta_description;?>" />
<meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />
<meta name="dcterms.description" content="<?php echo $meta_description;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta_description;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta_description;?>" />
<?php include("scripts/headers_new.php");?>
</head>
<style>
    #tabs a {
        padding-left:1em;
        padding-right:1em;
    }
</style>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="sub_links">
<div class="event_table_inner">
<table>
<tr>
<td style="padding-left:8px; text-align:center;"><h1 style="font-size:25px;"><?php echo $pageInnerTitle;?></h1></td>
</tr>
</table>
</div>
<div class="video_box">
<?php 
if (isset($_GET['countries'])){
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
if ($isEndOfColumn) { echo "</ul></div>"; }
if ($isStartOfNewColum) { echo'<div class="link_box"> <ul>'; }
$strip = str_replace($title_link,"-",$rows['countries']);
$final = strtolower(str_replace("--","-",$strip));
$num = MysqlSelectQuery("select category from events where country='".$rows['id']."' and status = 1 and SortDate >= '$today'");
$totalCat = NUM_ROWS($num);
echo '<li><a href="'.SITE_URL.$final.'" style="font-size:13px;"><img src="'.SITE_URL.'images/flags/medium/'.$rows['country_image'].'" style="vertical-align:middle;" alt="'.$rows['countries'].'" /> '.$rows['countries'].'</a></li>';
}
echo "</ul></div>"; } else if (isset($_GET['state_list'])){
$today = date("Y-m-d");
$state = MysqlSelectQuery("select * from states order by name");
$total_item = NUM_ROWS($state);
$colSize = 13;
$column = 0; // init a column counter
for($count=0; $count< $total_item; $count++) {
$rows = SqlArrays($state);
$isStartOfNewColum = 0 === ($count % $colSize); // modulo
$isEndOfColumn = ($count && $isStartOfNewColum);
$isStartOfNewColum && $column++; // update column counter
if ($isEndOfColumn) { echo "</ul></div>"; }
if ($isStartOfNewColum) { echo'<div class="link_box"> <ul>'; }
    $strip = str_replace($title_link,"-",$rows['name']);
    $final = strtolower(str_replace("--","-",$strip));
    echo '<li><a href="'.SITE_URL.$final.'" style="font-size:13px;" >'.$rows['name'].'</a></li>';
}
echo "</ul> </div>";
}
else if(isset($_GET['category_list'])){
?>
<!-- Category Links -->
<div class="link_box ">
<ul>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
            <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>administrative-and-secretarial" title="Administrative and Secretarial">Administrative and Secretarial</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>agriculture-and-rural-development" title="Agriculture and Rural Development." class="cat-text">Agriculture and Rural Development</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>aviation-and-maritime" title="Aviation and Maritime">Aviation and Maritime</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>banking-and-insurance" title="Banking and Insurance">Banking and Insurance</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>conferences-agm-seminars" title="Conferences AGM Seminars">Conferences AGM Seminars</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>corporate-governance" title="Corporate Governance">Corporate Governance</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>customer-service-and-support" title="Customer Service and Support" class="cat-text">Customer Service and Support</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>e-learning" title="E-Learning">E-Learning </a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>economic-management" title="Economic Management">Economic Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>education" title="Education">Education</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>engineering-and-technical-skills" title="Engineering and Technical Skills" class="cat-text">Engineering and Technical Skills</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>entrepreneurship-and-business-development" title="Entrepreneurship and Business Development" class="cat-text">Entrepreneurship and Business Development</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>executive-education" title="Executive Education">Executive Education</a>
            </h5>
        </div>
    </div>
</li>

</ul>
</div>
<div class="link_box">
<ul>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>finance-and-accounting" title="Finance and Accounting">Finance and Accounting</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>general-management" title="General Management">General Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>health-and-hse" title="Health and HSE">Health and HSE</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>human-resource-management" title="Human Resource Management" class="cat-text">Human Resource Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>information-and-communications-technology" title="Information and Communications Technology" class="cat-text">Information and Communications Technology</a>

            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>internal-audit-and-fraud" title="Internal Audit, Fraud">Internal Audit, Fraud </a>

            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>leadership-and-self-development" title="Leadership and Self Development" class="cat-text" class="cat-text">Leadership and Self Development</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>legal-and-legislative" title="Legal and Legislative">Legal and Legislative</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>logistics-and-supply-chain-management" title="Logistics and Supply Chain Management" class="cat-text">Logistics and Supply Chain Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>management-consultancy" title="Management Consultancy">Management Consultancy</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>marketing-and-sales-management" title="Marketing and Sales Mgt">Marketing and Sales Mgt</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>media-and-communication" title="Media and Communication">Media and Communication</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>oil-and-gas-energy-and-power" title="Oil and Gas Energy and Power">Oil and Gas Energy and Power</a>
            </h5>
        </div>
    </div>
</li>
</ul>
</div>
<div class="link_box">
<ul>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>operations-management" title="Operations Management">Operations Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>pre-retirement-and-new-beginnings" title="Pre-Retirement and New Beginnings" class="cat-text">Pre-Retirement and New Beginnings</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>project-management" title="Project Management">Project Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>public-administration" title="Public Administration">Public Administration</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>real-estate-management" title="Real Estate Management" class="cat-text">Real Estate Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>research-methodology-and-analytics" title="Research Methodology and Analytics" class="cat-text">Research Methodology and Analytics</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>risk-management" title="Risk Management">Risk Management </a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>security-and-crime-prevention" title="Security and Crime Prevention" class="cat-text">Security and Crime Prevention</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>strategic-management" title="Strategic Management">Strategic Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>telecommunications" title="Telecommunications">Telecommunications</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>time-and-self-management" title="Time and Self Management">Time and Self Management</a>
            </h5>
        </div>
    </div>
</li>
<li>
    <div class="col-md-6">
        <div class="feature-icon">
                <i class="glyphicon glyphicon-education"></i>
        </div>
        <div class="feature-text">
            <h5>
                <a href="<?php echo SITE_URL;?>vocational-education-and-training" title="Vocational Education and Training" class="cat-text">Vocational Education and Training</a>
            </h5>
        </div>
    </div>
</li>
</ul>
</div>
<?php } ?>
</div>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="divider"  style=" border:#0C0; margin-bottom:5px;"></div>
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
</div>               
<div class="clearfix"></div>
</div>
</div><!-- end subpage -->
<?php include("tools/side-menu_new.php");?>	
</div>
<div class="clearfix"></div>
</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>