<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$id = "34";
$url = "";

//payment 
$product_id = 6205;
$amount = 3000000;
$currency = 566;
$txn_ref = "NST".rand(10000, 10000000);

$pay_item_id = 101;
$pay_item_name = "Advanced Management and Administrative Course for Secretaries and Personal Assistant";

$company_name =  "KAISTE VENTURES LIMITED";
$redirect_to  = "https://www.nigerianseminarsandtrainings.com/payment?pid=".base64_encode($product_id)."&amt=".  base64_encode($amount)."";
$site_name = "https://www.nigerianseminarsandtrainings.com";

$cust_id = "898837";
$customer_name = "Ajani Thomas";
$mackey = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";

$unsave_hash = $txn_ref.$product_id.$pay_item_id.$amount.$redirect_to.$mackey;
$save_hash = hash("sha512", $unsave_hash, false);
//end payment

CatchViews($id);

CatchDailyViews($id);
$result = MysqlSelectQuery("select * from events where event_id = '$id' ");

$rows = SqlArrays($result);
$rowArray = $rows;
//search for training provider
$resultBiz = MysqlSelectQuery("select * from businessinfo where business_name like '%" . mysqli_escape_string($sql_connection, $rows['organiser']) . "%' and status = 1 ");
$rowsBiz = SqlArrays($resultBiz);
if (NUM_ROWS($result) == 0 || $rows['status'] == 0) {
//header("location: ".SITE_URL."all-event" , true, 301);
//exit();
}
$button = '<span id="add_event"><a href="#" class="cssButton_roundedLow cssButton_aqua my-event tooltipshow" style="padding:8px;font-size:14px; color:#FFF;" id="' . $id . "+" . date("Y-m-d", strtotime($rows['startDate'])) . '" title="Event will be added to your profile"><i class="fa fa-calendar" style="font-size:16px;"></i> Add to calendar</a></span>';
if (isset($_SESSION['login_subcriber'])) {
//check if the user already added this event to calendar
    $resultSub = MysqlSelectQuery("select * from my_events where event_id=$id and subscriber_id = {$_SESSION['user_id']}");
    if ((NUM_ROWS($resultSub) > 0)) {
        $button = '<a href="#" class="cssButton_roundedLow cssButton_lightGrey tooltipshow" style="padding:10px;font-size:14px; color:#000;" title="Lookup event in your profile">Added to my events</a></span>';
    }
}
$cost = $rows['cost'];
$phone = $rows['phone'];
$eventID = $rows['event_id'];
/* $truePattern = '/events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);
  $RecievedPattern = $_SERVER['REQUEST_URI']; */
/* $truePattern = str_replace($title_link,"-",$rows['event_title']);
  $RecievedPattern = @$_GET['title']; */
$redir = 'events/' . $rows['event_id'] . '/' . str_replace($title_link, "-", $rows['event_title']);

//compare the two urls
/* if($truePattern != $RecievedPattern){

  header("HTTP/1.1 301 Moved Permanently");

  header("location: ".SITE_URL.$redir);

  } */
// if the url is a get variable redirect to the re-written
if (isset($_GET['id'])) {

    header("HTTP/1.1 301 Moved Permanently");

    header("location: " . SITE_URL . $redir);
}

$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%" . addslashes($rows['organiser']) . "%' and premium >= 2");
$biz_name = SqlArrays($business);
if ($biz_name['logos'] == '')
    $logo = '<img src="' . SITE_URL . 'images/blank.png" alt="business logo" width="70" height="70" style="visibility:hidden; margin-left:auto; margin-right:auto;" class="articleImg shadow"/>';
else
    $logo = '<img src="' . SITE_URL . 'premium/logos/thumbs/' . $biz_name['logos'] . '" alt="business logo" width="70" height="70" style="margin-left:auto; margin-right:auto;" class="articleImg shadow"/>';
$number = NUM_ROWS($result);
$url = $rows['website'];
$cat = MysqlSelectQuery("select * from categories where category_id = '" . $rows['category'] . "'");
$rows_cat = SqlArrays($cat);

function GetPhone() {
    global $phone;
    return $phone;
}

function GetPrice() {
    global $cost;
    return $cost;
}
	$opt = array (
	'address' => urlencode($rows['venue']),
	'sensor'  => 'false'
);



$advert = "Event Detail";
if (!strstr($url, "http://") == $url) {
    $url = "http://" . $rows['website'];
}
$description = substr(strip_tags(stripslashes(str_replace('"', "'", $rows['description']))), 0, 130) . "-" . $rows['event_id'];
$site_name = 'Nigerian Seminars and Trainings';

function GenerateHotelLink(){
    global $rowArray;
    $location = GetEventLocation($rowArray['event_id']);
    $startDate = date("Y-m-d",  strtotime($rowArray['startDate']));
    $endDate = date("Y-m-d",  strtotime($rowArray['endDate']));
    if($rowArray['country'] == 38){
        $replace = array(" State, Nigeria"," FCT, Nigeria");
        $str = str_replace($replace,"",$location);
        $str = $str."_State";
        $url = "http://www.nsthotels.com/Hotels/Search?destination=place%3a".$str
                . "&resultID=0"
                . "&checkin=".$startDate."&checkout=".$endDate
                . "&Rooms=1&adults_1=1&languageCode=EN"
                . "&currencyCode=NGN&a_aid=32291";
        return $url;
    }else{
        //instantiate html Dom
        $html = new DOMDocument();
        //load html file
        $html->loadHTMLFile("hotelURL/countryList.html");
       // $arrayProp = array();
        //extract all the anchor tag
        foreach($html->getElementsByTagName("a") as $items){
        //populate the array links and link text
        //$arrayProp[$items->getAttribute("href")] = strtolower($items->nodeValue);
            if($items->nodeValue == $location){
                $url = "http://www.nsthotels.com".$items->getAttribute("href")."?a_aid=32291";
                return $url;
                break;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL; ?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />	
<title><?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(55, stripslashes(strip_tags($rows['event_title']))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?></title>
<meta name="description" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(146, stripslashes(strip_tags(str_replace('"', "'", $rows['description'])))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?>"/>
<meta name="dcterms.description" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(146, stripslashes(strip_tags(str_replace('"', "'", $rows['description'])))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?>" />
<meta property="og:title" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(55, stripslashes(strip_tags($rows['event_title']))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?>" />
<meta property="og:description" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(146, stripslashes(strip_tags(str_replace('"', "'", $rows['description'])))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?>" />
<meta property="twitter:title" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(55, stripslashes(strip_tags($rows['event_title']))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?>" />
<meta property="twitter:description" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo trimStringToFullWord(146, stripslashes(strip_tags(str_replace('"', "'", $rows['description'])))) . " -" . $rows['event_id'];
else echo 'Training has not been activated or has been removed!'; ?>" />
<meta name="keywords" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo $rows['tags']; else echo 'Not available'; ?>" />
  
<?php include("scripts/headers_new.php"); ?>

<?php include('tools/analytics.php'); ?>
<style type="text/css">
<!--
.event-param{
display:block;
padding:4px 0px;
}
.event-param span{
display:block;
padding:7px;
background-color:#E3EBEE;
float:right;
margin: 0 5px 0 5px;
width:25%;
text-align:center;
border-radius:3px;
font-size:14px;
border: solid 1px #C5CCCF;
}
.event-param .last{
margin-right:0px;
}
.eventDetail .trainingProviders span li {
margin-left: 5px;
padding-left: 5px;
list-style-position: inside;
}
.eventDetail .trainingProviders img{
float:none;
}
#mask {
position:absolute;
left:0;
top:0;
z-index:9000;
background-color:#000;
display:none;
}

.window {
position:fixed;
left:0;
top:0;
width:500px; 
z-index:9999;
padding:20px;
display:none;
}
.window_currency {
position:fixed;
left:0;
top:0;
width:200px;
z-index:9999;
padding:20px;
display:none;
}
.window_popup {
position:fixed;
left:0;
top:0;
width:37%;
z-index:9999;
padding:20px;
display:none;
}
.window_friend {
position:fixed;
left:0;
top:0;
width:37%;
z-index:9999;
padding:20px;
display:none;
}
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}
.form_content{
background-color:#FFF;
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
display: block;
float: left;
}.subscribe_notification {
padding: 10px;
height: 200px;
width:500px;
background-color: #FFF;
float: left;
display: none;
background-image: url(<?php echo SITE_URL; ?>images/school.png);
background-repeat: repeat;
}
.subscribe_notification span {

padding: 5px;
font-size: 24px;
text-align: center;
float: left;
text-shadow: 1px 1px 1px rgba(150, 150, 150, 1);
}
.subscribe_notification span img {
vertical-align: middle;
padding-right: 5px;
float: left;
}
#add_event{
color:#FFF;
font-size:16px;
}
/*Light Grey*/
.cssButton_lightGrey, .cssButton_lightGrey:focus {
background-color:#DDD;
background-image:-webkit-linear-gradient(top, #EEE 0px, #CCC 100%);
background-image:-moz-linear-gradient(top, #EEE 0px, #CCC 100%);
background-image:-o-linear-gradient(top, #EEE 0px, #CCC 100%);
background-image:-ms-linear-gradient(top, #EEE 0px, #CCC 100%);
background-image:linear-gradient(top, #EEE 0px, #CCC 100%);
filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0, startColorStr=#EEEEEE, endColorStr=#CCCCCC);
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#EEEEEE', endColorstr='#CCCCCC')";
border-color:#DDD;
color:#333;
text-shadow:0px 1px 5px #FFF;
}
.cssButton_lightGrey:hover {
background-image:-webkit-linear-gradient(top, #EEE 0px, #EEE 100%);
background-image:-moz-linear-gradient(top, #EEE 0px, #EEE 100%);
background-image:-o-linear-gradient(top, #EEE 0px, #EEE 100%);
background-image:-ms-linear-gradient(top, #EEE 0px, #EEE 100%);
background-image:linear-gradient(top, #EEE 0px, #EEE 100%);
filter:progid:DXImageTransform.Microsoft.Gradient(GradientType=0, startColorStr=#EEEEEE, endColorStr=#EEEEEE);
-ms-filter: "progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#EEEEEE', endColorstr='#EEEEEE')";
background-color:#EEE;
}
.tooltipsy
{
padding: 10px;
max-width: 200px;
color: #303030;
background-color: #f5f5b5;
border: 1px solid #deca7e;
}
.event-content{
padding:4px 0px;
}
.event-content .description{
float:left;
border: solid 1px #E3EBEE;
width:69%;
height:300px;
min-height:200px;
overflow:auto;
text-align:justify;
}
.event-content .event-menu{
float:right;
border: solid 1px #E3EBEE;
width:25%;
height:300px;
min-height:200px;
padding: 7px 0.985915%;
}
.event-content a{
width:87%;
text-align:left;
margin:5px 0;
font-weight:normal;
}
@media only screen and (max-width: 480px){
.event-param .first, .event-param.last {
float: none;
}
.event-content .description, .event-content .event-menu{
float: none;
width: 100%;
margin-bottom: 5px;
}
}
body{overflow-x: hidden}
            </style>
    </head>
    <body>
        <?php include("tools/header_new.php"); ?>
        <div id="main">
            <?php include("tools/categories_new.php"); ?>
            <div id="content">
                <div id="content_left">
                        <?php if (($number > 0 ) && ($rows['status'] == 1)) {    ?>
                        <div class="sub_links">

                            <div class="event_table_inner" style="margin: 0px;border: solid 1px #C5CCCF;"><table  class="smart-forms" style="padding:9px; ">
                                    <tr>
                                        <td>
                                            <p style="text-align:center;">
                                                <?php echo $logo; ?>
                                            </p>
                                            <p style="text-align:center;">
                                                <?php 
                                                if(!empty($rowsBiz['cmd_accr_number'])){
                                                     echo '<img src="'.SITE_URL.'images/accreditation.png" style="margin-top: 5px;" alt="accrediation logo" />';
                                                 }
                                                ?>
                                            </p>
                                        </td>
                                        <td style="text-align:center; width:87%;" >
                                            <h1 style="font-size:20px; font-weight: normal; text-align:center; margin-bottom:8px; color:#000;">
                                                <?php echo $rows['event_title']; ?>
                                            </h1>
                                             <div style="color:#000;font-size:16px;">
                                                 <p ><h2 style=" font-weight: normal">By: <?php echo $rowsBiz['business_name']; ?></h2></p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="event-param">
                                <span class="last"><i class="fa fa-map-marker"></i> <?php echo GetEventLocation($rows['event_id']);?></span>
                                <span><i class="fa fa-calendar"></i> <?php echo date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate']));?></span>
                                <span><i class="fa fa-clock-o"></i> <?php echo dateDiff($rows['startDate'], $rows['endDate']);?></span>
                                <div class="respond"><span style="width:13.5%; height:32px;padding: 0px; margin-left:0px " ></span></div>
                                <div class="clear"></div>
                            </div>
                            <div class="event-content" style="margin: 0px;">
                                <div class="description">
                                    <p style="font-size: 13px;"><strong>Event Description:</strong></p>
                                    <div>
                                        <?php
                                        $str = stripslashes($rows['description']);
                                        //echo preg_replace('/<iframe.*?\/iframe>/i', '', $str);
                                        $xml = new DOMDocument(); 
                                        $xml->loadHTML($str); 
                                        $links = $xml->getElementsByTagName('a');
                                        //Loop through each <a> tags and replace them by their text content    
                                        for ($i = $links->length - 1; $i >= 0; $i--) {
                                            $linkNode = $links->item($i);
                                            $lnkText = $linkNode->textContent;
                                            $newTxtNode = $xml->createTextNode($lnkText);
                                            $linkNode->parentNode->replaceChild($newTxtNode, $linkNode);
                                        }
                                        echo $xml->saveHTML();
                                        ?>
                                    </div>         
                                </div>
                                <div class="event-menu">
                                   <div class="respond"> <a href="#contact-wrapper2" class="cssButton_roundedLow cssButton_medGreen modalDetail" style="padding:8px; font-size:14px; color:#FFF;" ><i class="fa fa-edit" style="font-size:16px;"></i> Book Now</a></div>
                                   <div>
                                        <?php include("view/partials/interswitchForm.php") ?>
                                   </div>
                                    <?php echo $button;?>
                                    <?php if($rows['website'] != ''){?>
                                        <a href="<?php echo $url;?>" target="_blank"  class="cssButton_roundedLow cssButton_aqua" style="padding:7px; font-size:14px; color:#FFF;" rel="nofollow" onclick="trackOutboundLink('<?php echo $url ;?>')"><i class="fa fa-globe" style="font-size:16px;"></i> Visit Website</a>
                                    <?php }?>
                                    <?php if(($rows['premium'] > 0) && ($rows['premium'] !=8) && ($rows['user_id'] != 0)){?>
                                        <a href="<?php echo SITE_URL;?>courses/business/<?php echo $biz_name['business_id'].'-'.str_replace($title_link,"-",$rows['organiser']);?>" target="_blank"  class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:14px; color:#FFF;" title="View more courses by this provider">
                                            <i class="fa fa-list" style="font-size:16px;"></i> More Courses</a>
                                    <?php }?>
                                    <a id="Phone_btn" onclick="alert('<?php echo $biz_name['telephone'];?>')"  class="cssButton_roundedLow cssButton_aqua" style="padding:7px; font-size:14px; color:#FFF;"><i class="fa fa-phone" style="font-size:16px;"></i> Telephone </a>
                                    <a class="cssButton_roundedLow cssButton_medGreen hotel" href="http://www.nsthotels.com" target="_blank" style="padding:7px; font-size:14px; color:#FFF;" rel="nofollow"><i class="fa fa-building" style="font-size:16px;"></i> Book hotel</a>
                                </div>
                                 <script type="text/javascript">
                                    function url_contact(data){
                                        window.location = data
                                    }
                                </script>
                               <div class="clearfix"></div>
                            </div>
                            <?php if (!empty($rows['facilitator'])) { ?>
                             <div style="border: solid 1px #C5CCCF; display: block; padding: 15px; ">
                                 <span style="height:auto;"> <h3 style="font-size:13px; font-weight:normal"><strong>Facilitators:</strong> <?php echo $rows['facilitator']; ?></h3></span>
                            </div>
                            <?php } ?>    
                            <div style="border: solid 1px #C5CCCF; display: block; padding: 15px;">
                                <span style="height:auto;"> <h3 style="font-size:13px; font-weight:normal"><strong>Deals:</strong> <?php echo $rows['deals']?></h3></span>
                            </div>
                            <div style="border: solid 1px #C5CCCF; display: block; padding: 15px;">
                                <span style="height:auto;"> <h3 style="font-size:13px; font-weight:normal"><strong>Attendance Fee:</strong> N30000<a href="#currency" class="currencyDetail" style="text-align:center; font-size:10px;" data-type="inline" data-width="20%"></a> </h3></span>
                            </div>
                            <div  style="border: solid 1px #C5CCCF; display: block; padding: 15px;">
                                <span ><h3 style="font-size:13px; font-weight:normal"><strong>Venue:</strong> <?php echo $rows['venue']?></h3></span>
                            </div>
                            
<!--                            <div id="map_canvas" style="margin: 10px 0; border: solid 1px #C5CCCF; padding: 5px; height: 200px;">
                            </div>-->
                            <div style="border: solid 1px #C5CCCF; display: block; padding: 15px;"> 
                                <span style="float:left; margin-right:8px;"><strong>Share this event: </strong></span> 

                                <div style="float:left;"> 

                                    <div class="fb-share-button" data-href="<?php echo SITE_URL . 'events/' . $rows['event_id'] . '/' . str_replace($title_link, "-", $rows['event_title']); ?>" data-type="button_count"></div>
                                    <div class="g-plus" data-action="share" data-annotation="bubble"></div><!-- Place this tag after the last share tag. -->
                                    <script type="text/javascript">
                                        (function () {
                                            var po = document.createElement('script');
                                            po.type = 'text/javascript';
                                            po.async = true;
                                            po.src = 'https://apis.google.com/js/platform.js';
                                            var s = document.getElementsByTagName('script')[0];
                                            s.parentNode.insertBefore(po, s);
                                        })();
                                    </script>
                                        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>    
                                        <script>!function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (!d.getElementById(id)) {
                                                js = d.createElement(s);
                                                js.id = id;
                                                js.src = "https://platform.twitter.com/widgets.js";
                                                fjs.parentNode.insertBefore(js, fjs);
                                            }
                                        }(document, "script", "twitter-wjs");
                                    </script> 
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="respond">
                                <div class="tags">                      
                                    

                                </div>
                            </div>
    <?php if (!empty($rows['tags'])) { ?>
                                <div class="respond">
                                    <div class="tags">
                                        <span>
                                            <p style="float:left; margin-right:8px; margin-bottom:0px;"><strong>Tags:</strong></p>
        <?php echo tags($rows['tags'], 'all-event-tag-search'); ?>
                                            <div class="clearfix"></div>
                                        </span>

                                    </div>
                                </div>

        <?php } ?>    
                        </div>
    <?php
} else {
    ?>
                        <strong style="font-size:20px; color:#F30;">Sorry! The training you requested has not been activated or no longer exists</strong>
    <?php
}
?>

                    <div id="mask"></div>

                    <!-- <div style="display:none;">-->
                    <!-- <a href="#popup" data-type="inline" class="popup">popup</a>-->
                    <div id="popup" class="window_popup boxContent">
                        <div class="smart-forms" style="text-align:center; padding-top:0px;">
                            <div class="alert notification alert-error" ><strong>You must be logged in to continue, <a href="javascript:void();" onClick="RedirSub()" title="login page">Click here</a> to login.</strong> <br /> <br />Dont have an account? <br /><br />
                                <a href="javascript:void();" onClick="RedirSub()" class="button btn-primary alert alert-success" title="subscribers page">
                                    <i class="fa fa-user"></i> Create an Account
                                </a>
                                <br />
                                <a href="javascript:void()" onClick="CloseSub()" class="popup">close</a>
                            </div>
                        </div>

                    </div>
                    <script>
                        function RedirSub() {
                            window.location = '<?php echo SITE_URL; ?>subscribers?auth=subscriber&event=<?php echo base64_encode($eventID); ?>&return=<?php echo $_SERVER['REQUEST_URI']; ?>';
                                }
                    </script>
                    <!-- </div>-->


                    <div id="currency" style="float:left;" class="window_currency boxContent">
                        <div id="currency-widget"></div>
                    </div>

<div id="contact-wrapper2" class="window boxContent"> 
<form id="formProvider" name="form1" method="post" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
<strong style="color:#006600;">Book for this Course now</strong>
</div>
<div class="notification alert-info spacer-t10" style="display:none;" id="msgbox"></div>
<label class="field">
<input type="hidden" name="subject" id="subject">
<input type="text" class="gui-input" style="color:#000" value="<?php echo ucwords($rows['event_title']); ?>" disabled >
</label>
<label class="field prepend-icon">
<input type="text" name="name" id="name" class="gui-input" placeholder="Name" required>
<span class="field-icon"><i class="fa fa-user"></i></span>  
</label>
<label class="field prepend-icon">
<input type="email" name="email" id="email" class="gui-input" placeholder="Email" required>
<span class="field-icon"><i class="fa fa-envelope"></i></span>  
</label>
<label class="field prepend-icon">
<input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone" required >
<span class="field-icon"><i class="fa fa-phone-square"></i></span>  
</label>
<label class="field prepend-icon">
<input type="text" name="address" id="address" class="gui-input" placeholder="Address">
<span class="field-icon"><i class="fa fa-phone-square"></i></span>
<label class="field prepend-icon">
<textarea class="gui-textarea" id="comment" name="comment" placeholder="message" required ></textarea>
<span class="field-icon"><i class="fa fa-comments"></i></span>
<span class="input-hint"> 
<strong>Hint: </strong>Enter your enquiry / booking in this box. The training provider will contact you.</span>   
</label>
<div class="smart-widget sm-left sml-120">
<label class="field">
<input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
</label>
<span class="button captcode">
<img src="<?php echo SITE_URL; ?>tools/captcha.php" id="captcha" alt="Captcha">
<span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
</span>
</div>
<button class="button btn-primary" type="submit"> Send </button>
<input name="to" type="hidden" value="<?php echo str_replace('@', '&#64;', $rows['email']); ?>" id="to" /> <button class="button" id="closeBox"> Close </button>
</td>
</tr>
</table> 
</form>
</div>
                    <div id="sendtofriend" style="float:left;" class="window_friend boxContent"> 

                        <form id="toFriend" name="form1" method="post" class="smart-forms form_content" >

                            <div class="highlights" style="margin-top:6px;">
                                <strong style="color:#006600;">Send to a friend</strong>

                            </div>
                            <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgboxFriend">

                            </div>
                            <table class="contact_provider_table">
                                <tr>

                                    <td style="width:85%;">

                                        <label class="field prepend-icon">
                                            <input type="text" name="to" id="to" class="gui-input" placeholder="Enter friends email. (separate multiple email with comma (,))" required >
                                                <span class="field-icon"><i class="fa fa-users"></i></span>
                                        </label>
                                    </td></tr>
                                <tr>

                                    <td>  <label class="field prepend-icon">
                                            <input type="text" name="sender_name" id="sender_name" class="gui-input" placeholder="Enter your name" required>
                                                <span class="field-icon"><i class="fa fa-user"></i></span>  
                                        </label></td></tr>
                                <tr><td><label class="field prepend-icon">
                                            <input type="email" name="sender_email" id="sender_email" class="gui-input" placeholder="Enter your email" required>
                                                <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                                        </label>
                                    </td></tr>
                                <tr>

                                </tr>
                                <tr></tr>
                                <tr>  <td> <label class="field prepend-icon">
                                            <textarea class="gui-textarea" id="message" name="message" placeholder="message (optional)"></textarea>
                                            <span class="field-icon"><i class="fa fa-comments"></i></span>

                                        </label>
                                    </td>
                                </tr>
                                <tr>  <td> 				<div class="smart-widget sm-left sml-120">
                                            <label class="field">
                                                <input type="text" name="securitycode" id="securitycodefriend" class="gui-input sfcode" placeholder="Enter security code">
                                                    <input name="eventID" type="hidden" value="<?php echo $rows['event_id']; ?>">
                                                        </label>
                                                        <span class="button captcode">
                                                            <img src="<?php echo SITE_URL; ?>tools/captcha.php" id="captchaFriend" alt="Captcha">
                                                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                                                        </span>
                                                        </div>
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td  style="text-align:center;" >
                                                                <button class="button btn-primary" type="submit"> Send </button>
                                                            </td>
                                                        </tr>
                                                        </table> 
                                                        </form></div>
                                                        <div class="respond">

                                                            <div class="sub_links2_middle"> <?php echo $GetAdverts->LandScapeAds("Page Banner 1", $advert); ?>

                                                                <br />
<!--                                                                <div class="highlights">Continue your search from here...
<?php //include("tools/search_box.php"); ?>
                                                                </div>-->
                                                                
                                                            </div>
<!--                                                            <div style="text-align:center; margin:5%"><a class="cssButton_roundedLow cssButton_aqua" href="javascript:;" style="padding:7px; font-size:14px; color:#FFF;" rel="nofollow" title="Go Back" onclick="window.history.back();"><i class="fa fa-backward" style="font-size:16px;"></i></a></div>-->
                                                        </div>
                                                        <!-- end subpage -->		<div class="clearfix"></div>					</div>
                <?php include("tools/side-menu_new.php"); ?>
            </div>
            <div class="clearfix"></div>
            </div>	
            
        <div class="clearfix"></div>
        </div>
<?php include ("tools/footer_new.php");?>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.currency.js"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.currency.localization.en_US.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#currency-widget').currency({
		localRateProvider: '<?php echo SITE_URL;?>api_currency.php',
		loadingImage: '<?php echo SITE_URL;?>images/img/loader.gif',
	});
	$('.res').click(function(e) {
		$('.contact_provider_table').removeClass().addClass('contact_provider_table_responsive');
        $('#contact-wrapper2').removeClass('window boxContent contact_provider_table').slideDown('slow')
		return false;
    });
    //$('.hotel').attr('href','http://www.nsthotels.com');
    
});
</script>
<script type="text/javascript">$(document).ready(function(b){$("#evtsearch").keyup(function(){$("#output_events").fadeIn("slow");$("#output_events").html('<center"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>');$.post("<?php echo SITE_URL;?>tools/searchEvents.php",{query:$(this).val(),type:"Training"},function(a){$("#output_events").html(a)})});$("#evtsearch").blur(function(){$("#output_events").fadeOut()})});function GetEvtVal(c){var d=$("#"+c).attr("data");$("#evtsearch").val($("#"+c).text());$("#output_events").hide();$("#searchform_basic").attr("action",d)}$(document).ready(function(b){$(".currency").click(function(j){j.preventDefault();var e=$(this).attr("data-id");var l=$(document).height();var i=$(window).width();$("#mask").css({width:i,height:l});$("#mask").fadeIn(1000);$("#mask").fadeTo("slow",0.8);var k=$(window).height();var a=$(window).width();$(e).css("top",k/2-$(e).height()/2);$(e).css("left",a/2-$(e).width()/2);$(e).fadeIn(2000)});$(".currency-footer #closeBoxCurr").click(function(a){a.preventDefault();$("#msgbox").fadeOut("slow");$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow")});$("#mask").click(function(){$(this).fadeOut("slow");$("#msgbox").fadeOut("slow");$(".window_currency").fadeOut("slow")});$(window).resize(function(){var i=$("#boxes .window_currency");var j=$(document).height();var g=$(window).width();$("#mask").css({width:g,height:j});var h=$(window).height();var a=$(window).width();i.css("top",h/2-i.height()/2);i.css("left",a/2-i.width()/2)})});function Close(){$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow")};</script>

<script>

$(document).ready(function() {	

		$('#toFriend').submit(function(e) {
            if($('#to').val() == ''){
				alert("Friend's email");
				return false;
			}
			if($('#sender_name').val() == ''){
				alert("Please enter your name");
				return false;
			}
		else if ($('#sender_email').val() == ''){
			alert("Please enter your email");
			return false;
		}
		else{
			$.ajax({
				url:'<?php echo SITE_URL;?>tools/send-to-friend.php',
				type: 'POST',
				data: $(this).serialize(),
				beforeSend: function(){
						$("#msgboxFriend").removeClass('alert-error alert-success').addClass('alert-info').html('<i class="fa fa-spinner fa-spin"></i> Sending message....').show();
					},
				success: function(data){
					if(data == 'Sent'){
						$("#msgboxFriend").fadeTo(200,0.1,function() { 
			  				//add message and change the class of the box and start fading
			 			 		$(this).html('Your message has been sent!').removeClass('alert-info alert-error').addClass('alert-success').fadeTo(900,1);
			 					$('#to').val("");
			 			 		$('#sender_email').val("");
			  					$('#sender_name').val("");
			  					$('#message').val("");
			   					$('#securitycodefriend').val("");
							});
						}
						else if(data == 'Security'){
							$("#msgboxFriend").fadeTo(200,0.1,function() { 
			  			//return error message from request
			 			 	$(this).html('Invalid security code!').removeClass('alert-info alert-success').addClass('alert-error').fadeTo(900,1);
							});
						}
						else{
							alert(data);
						}
					 },
				error: function(jqXHR,exception){
					$("#msgboxFriend").fadeTo(200,0.1,function() { 
			  			//return error message from request
			 			 	$(this).html('Error: '+jqXHR.responseText).removeClass('alert-info alert-success').addClass('alert-error').fadeTo(900,1);
						});
				}
			});
		}
		return false;
     });

    $(document).ready(function() {
            $("#hamburger").click(function(e) {
            $("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
            $("#main-menu").toggleClass("mobile-hide");
        });
        $(".mobile-show > a").click(function(e) {
            e.preventDefault();
            $(this).parent().children("ul").toggle();
        });

    })
//capcha reloader
		function reloadCaptcha(){
					$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
					$("#captchaFriend").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});

	//select all the a tag with name equal to modal
	$('.modalDetail').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
	//send to a friend

	$('.modalFriend').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window_friend #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window_friend').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_friend');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
	
	//currency form
	$('.currencyDetail').click(function(e) {
      		//Cancel the link behavior
		e.preventDefault();
		$('#price').text('<?php echo GetPrice();?>')
		$('#price_container').show();
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.currency-footer #closeBoxCurr').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_currency');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
    });
	
});

function Close(){
		$('#mask').fadeOut('slow');
		$('.window_currency').fadeOut('slow');
}

function showPhone(){
	var Phone = document.getElementById('Phone_btn');
	Phone.style.backgroundColor='white';
	Phone.style.color='black';
	Phone.innerHTML = '<?php if(GetPhone() != '') echo GetPhone(); else echo 'NIL';?>';
}

	$(document).ready(function()
{
	$("#formProvider").submit(function()
	{
		if($('#subject').val() == ''){
			alert("Please enter subject");
			
			return false;
		}
		if($('#name').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if ($('#email').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#comment').val() == ''){
			alert("Please enter your message");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass('alert-error alert-success').addClass('alert-info').html('Sending message....').show();
		//check the username exists or not from ajax
		$.post("<?php echo SITE_URL;?>tools/send.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),address:$('#address').val(),title:$('#course').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your message has been sent!').removeClass('alert-info').addClass('alert-success').fadeTo(900,1);
			  $('#name').val("");
			  $('#email').val("");
			  $('#comment').val("");
			  $('#title').val("");
			  $('#phone').val("");
			  $('#address').val("");
			   $('#securitycode').val("");
			   $('#subject').val("");
			   
			});
			setInterval(function(){$('#formProvider').fadeOut('slow', function(){
			$('#subscribe').fadeIn('slow');
			})},1000);
			
		  }
		  else if(data=='Security'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Invalid Security Code!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Error sending message!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
});
function CloseSub(){
	$('#mask').fadeOut('slow');
	$('#contact-wrapper2').fadeOut('slow');
	$('#popup').fadeOut('slow');
}
$(document).ready(function(e) {
	$('.tooltipshow').tooltipsy();
	
    $('.my-event').click(function(e) {
		$(this).html('<i class="fa fa-spinner fa-spin" style="font-size:16px;"></i> Adding...');
        var str = $(this).attr('id').split("+");
		var eventID = str[0];
		var startDate = str[1];
		$.post("<?php echo SITE_URL;?>tools/add_to_event.php",{event_id:eventID,start_date:startDate},function(data){
			if(data == 'redirect') {
				
				popup();
				
				$('.my-event').html('<i class="fa fa-calendar" style="font-size:16px;"></i> Add to calendar');
			}
			else{
			//alert(data)
			$('#add_event').html('<a href="#" class="cssButton_roundedLow cssButton_lightGrey" style="padding:10px; 											font-size:14px; color:#000;">Added to my events</a>');
			}
		});
		return false;
    });
});

function popup(){
	
		var id = '#popup';
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	

	
	/*//if close button is clicked
	$('.window_popup #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});	*/	
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('.window_popup').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window_popup');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 });
	
}
</script>
<script src="js/jquery-1.10.1.min.js"></script>
<script>
    $(document).ready(function(){
        //$('form input[name="cust_id"]').val()
        var userId = $('form input[name="cust_id"]').val();
        var transactionReference = $('form input[name="txn_ref"]').val();
        var amount = $('form input[name="amount"]').val();
        var userName = $('form input[name="cust_name"]').val();

        $('#payNowButton').click(function(e){ 
            e.preventDefault(); e.stopPropagation();
            if(confirm("Please confirm that you are paying NGN30000.\n Your transaction reference is: "+transactionReference))submitForm(userId, transactionReference, amount, userName);

        });

        function submitForm(userId, transactionReference, amount, userName){
            $.ajax({
                url: 'log-payment-record.php',
                type: 'POST',
                data:{userId:userId, transactionReference:transactionReference, amount:amount, userName:userName},
                success: function(data, status){
                    $('form#form1').trigger('submit');
                }
            });

        }

       
    });
</script>
    </body>
</html>