<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$id = "";
if (isset($_GET['id'])) $id = $_GET['id'];
else if (isset($_GET['detail']))
    $id = $_GET['detail'];
else {
    header("HTTP/1.1 301 Moved Permanently");
    header("location: " . SITE_URL);
}
$url = "";

CatchViews($id);
CatchDailyViews($id);
  $result = MysqlSelectQuery("select * from events where event_id = '$id' ");
  $rows = SqlArrays($result);
  $name = "select * from events where business_name='applehall-id'";
  $rowArray = $rows;
  //search for training provider
  $resultBiz = MysqlSelectQuery("select * from businessinfo where business_name like '%" . mysqli_escape_string($sql_connection, $rows['organiser']) . "%' and status = 1 ");
  $rowsBiz = SqlArrays($resultBiz);
  if (NUM_ROWS($result) == 0 || $rows['status'] == 0) {
  //header("location: ".SITE_URL."all-event" , true, 301);
  //exit();
  header("HTTP/1.0 404 Not Found");
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
  //payment 
  $myamount = filter_input(INPUT_POST, 'amount')* 100;
  $phone = filter_input(INPUT_POST, 'phone');
  $cust_id = rand(10000, 10000000);
  $cust_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $cust_name = filter_input(INPUT_POST, 'cust_name', FILTER_SANITIZE_SPECIAL_CHARS);
  $pro_email = filter_input(INPUT_POST, 'pro_email', FILTER_VALIDATE_EMAIL);
  $pro_name = filter_input(INPUT_POST, 'pro_name', FILTER_SANITIZE_SPECIAL_CHARS);
  $item_name = filter_input(INPUT_POST, 'item_name', FILTER_SANITIZE_SPECIAL_CHARS);
  $txn_ref = "NST".rand(10000, 10000000);
  $currency = 566;
  $product_id = 5791;
  $pay_item_id = $biz_name['web_pay_item_id'];
//  $pay_item_id = 102;
  $company_name =  "Kaiste Ventures Limited";
  $redirect_to  = "https://www.nigerianseminarsandtrainings.com/payment?pid=".base64_encode($product_id)."&amt=".  base64_encode($myamount)."&cust_email=". base64_encode($cust_email) ."&cust_name=". base64_encode($cust_name) ."&pro_email=". base64_encode($pro_email) ."&pro_name=". base64_encode($pro_name) ."&phone=".base64_encode($phone)."&item_name=".base64_encode($item_name)."";
  $site_name = "www.kaisteventures.com";
  $mackey = "27ED7ACA287A0364501B13841B70F72430E9DEA4F55C9278C1E28006EA236BF28B7C11A7F1CCCACA7EC72AB0B692B23A090A54729D75923118B8799A4F100EF1";
  $unsave_hash = $txn_ref.$product_id.$pay_item_id.$myamount.$redirect_to.$mackey;
  $save_hash = hash("sha512", $unsave_hash, false);
  //end payment
  
  
  $url = $rows['website'];//
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
//$advert = $rows_cat['category_name'];
$url = (stripos($url, "http://")!==false || stripos($url, "https://")!==false) ? $url : "http://" . $url;
//$url = $parsedUrl = parse_url($url);
//$url = $parsedUrl['scheme'].'://'.$parsedUrl['host'];

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
$thisPageTit = ($number > 0 ) && ($rows['status'] == 1) ? trimStringToFullWord(55, stripslashes(strip_tags($rows['event_title']))) . " :" . $rows['event_id'] : "Training has not been activated or has been removed!";
$thisPageDesc = ($number > 0 ) && ($rows['status'] == 1) ? trimStringToFullWord(146, stripslashes(strip_tags(str_replace('"', "'", $rows['description'])))) . " -" . $rows['event_id'] : "Training has not been activated or has been removed!";

$thisPageTitle = (strlen($thisPageTit) < 62) ? trimStringToFullWord(64, $thisPageTit." - Nigerian Seminars and Trainings") : $thisPageTit;
?>
<!DOCTYPE html>
<html lang="en">
<head>  
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="<?php echo SITE_URL; ?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" /> 
  <title><?php echo $thisPageTitle; ?></title>
  <meta name="description" content="<?php echo $thisPageDesc; ?>"/>
  <meta name="dcterms.description" content="<?php echo $thisPageDesc; ?>" />
  <meta property="og:title" content="<?php echo $thisPageTitle; ?>" />
  <meta property="og:description" content="<?php echo $thisPageDesc; ?>" />
  <meta property="twitter:title" content="<?php echo $thisPageTitle; ?>" />
  <meta property="twitter:description" content="<?php echo $thisPageDesc; ?>" />
  <meta name="keywords" content="<?php if (($number > 0 ) && ($rows['status'] == 1)) echo $rows['tags']; else echo 'Not available'; ?>" />
  <?php include("scripts/headers_new.php"); ?>
  <?php include('tools/analytics.php'); ?>
  <style type="text/css">
        .event-param{
        display:block;
        padding:4px 0px;
        }
        .event-param span{
        display:block;
        padding:7px;
        background-color:#435a65;
        float:right;
        margin: 0 5px 0 5px;
        width:25%;
        text-align:center;
        border-radius:3px;
        font-size:14px;
        border: solid 1px #E3EBEE;
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
        .event-param span {background-color: #E3EBEE;color: #000;}
    </style>
</head>
<body>
        <?php include("tools/header_new.php"); ?>
        <div id="main" class="event-detail">
            <?php include("tools/categories_new.php"); ?>
            <div id="content">
                <div id="content_left">
                        <?php if (($number > 0 ) && ($rows['status'] == 1)) {    ?>
                        <div class="sub_links">
                            <div class="event_table_inner" style="margin: 0px;border: solid 1px #E3EBEE;"><table  class="smart-forms" style="padding:4px; ">
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
                                        <td style="text-align:center; width:90%;" >
                                            <h1 style="font-size:23px; font-weight: normal; text-align:center; margin-bottom:8px;">
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
                                     <?php if($rowsBiz['web_pay_item_id']) {?>
                                    <a href="#contact-wrapper5" class="cssButton_roundedLow cssButton_medGreen modalDetail" style="padding:8px; font-size:14px; color:#FFF;" ><i class="fa fa-edit" style="font-size:16px;"></i> Pay Now</a>
                                    <?php }?>
                                   <div class="respond"> <a href="#contact-wrapper2" class="cssButton_roundedLow cssButton_medGreen modalDetail" style="padding:8px; font-size:14px; color:#FFF;" ><i class="fa fa-edit" style="font-size:16px;"></i> Book Now</a></div>
                                    <?php echo $button;?>
                                       <?php }?>
                                    <?php if($rows['website'] != ''){?>
                                   <a href="<?php echo $url;?>" target="_blank"  class="cssButton_roundedLow cssButton_aqua" style="padding:7px; font-size:14px; color:#FFF;" rel="nofollow" onclick="trackOutboundLink('<?php echo $url; ?>')"><i class="fa fa-globe" style="font-size:16px;"></i> Visit Website</a>
                                    <?php if(($rows['premium'] > 0) && ($rows['premium'] !=8) && ($rows['user_id'] != 0)){?>
                                        <a href="<?php echo SITE_URL;?>courses/business/<?php echo $biz_name['business_id'].'-'.str_replace($title_link,"-",$rows['organiser']);?>" target="_blank"  class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:14px; color:#FFF;" title="View more courses by this provider">
                                            <i class="fa fa-list" style="font-size:16px;"></i> More Courses</a>
                                    <?php }?>
                                    <a id="Phone_btn" onclick="alert('<?php echo $biz_name['telephone'];?>')"  class="cssButton_roundedLow cssButton_aqua" style="padding:7px; font-size:14px; color:#FFF;"><i class="fa fa-phone" style="font-size:16px;"></i> Telephone </a>
                                    <?php if($rows['brochure'] !=''){ ?>
                                    <a href="<?php echo SITE_URL; ?>event-brochures/<?php echo $rows['brochure']; ?>" class="cssButton_roundedLow cssButton_aqua" style="padding:7px; font-size:14px; color:#FFF;"><i class="fa fa-download" style="font-size:16px;"></i> Download Brochure  </a>
                                    <?php } ?>
                                    
                                </div>
                                 <script type="text/javascript">
                                    function url_contact(data){
                                        window.location = data
                                    }
                                </script>
                               <div class="clearfix"></div>
                            </div>
                            <?php if (!empty($rows['facilitator'])) { ?>
                             <div style="border: solid 1px #E3EBEE; display: block; padding: 15px; ">
                                 <span style="height:auto;"> <h3 style="font-size:13px; font-weight:normal"><strong>Facilitators:</strong> <?php echo $rows['facilitator']; ?></h3></span>
                            </div>
                            <?php } ?>    
                            <div style="border: solid 1px #E3EBEE;border-bottom:none; display: block; padding: 15px;">
                                <span style="height:auto;"> <h3 style="font-size:13px; font-weight:normal"><strong>Deals:</strong> <?php echo $rows['deals']?></h3></span>
                            </div>
                            <div style="border: solid 1px #E3EBEE;border-bottom:none; display: block; padding: 15px;">
                                <div style="float:left;height: auto;"> <h3 style="font-size:13px; font-weight:normal"><strong>Attendance Fee: </strong> </h3></div>
                                <section style="display: inline-table;padding-left:10px">
                                <?php 
                                $first_amount = 0; $second_amount = 0; $third_amount =0; $fourth_amount = 0;
                                $priceParams = ['currency', 'cost', 'comment', 'amount'];
                                $priceLevels = ['first_', 'second_', 'third_', 'fourth_'];
                                foreach ($priceLevels as $priceLevel) {
                                    switch ($priceLevel) { 
                                        case 'first_':  $paymentCost = is_numeric($rows[$priceParams[1]]) ? ($rows['vat']=='yes' ? (number_format($rows[$priceParams[1]], 2)." + ".number_format(($rows[$priceParams[1]]* 0.05), 2)." (VAT)"): number_format($rows[$priceParams[1]], 2)) : $rows[$priceParams[1]];
                                                        $first_amount = is_numeric($rows[$priceParams[1]]) ? ($rows['vat']=='yes' ? ($rows[$priceParams[1]]+($rows[$priceParams[1]]* 0.05)): $rows[$priceParams[1]]) : $rows[$priceParams[1]];
                                                        $paymentComment = !empty($rows[$priceParams[2]]) ? '<em>('.trim($rows[$priceParams[2]]).')</em><br/>' : '';
                                                        echo '<strong>'.$rows[$priceParams[0]].' '.$paymentCost.' &nbsp; </strong> &nbsp; '.$paymentComment;
                                                        break;
                                        default:        $paymentCost = is_numeric($rows[$priceLevel.$priceParams[1]])  ? ($rows['vat']=='yes' ? (number_format($rows[$priceLevel.$priceParams[1]], 2)." + ".number_format(($rows[$priceLevel.$priceParams[1]]* 0.05),2)." (VAT)"): number_format($rows[$priceLevel.$priceParams[1]], 2)) : $rows[$priceLevel.$priceParams[1]];
                                                        $newVariab = $priceLevel.$priceParams[3];
                                                        $$newVariab = is_numeric($rows[$priceLevel.$priceParams[1]])  ? ($rows['vat']=='yes' ? ($rows[$priceLevel.$priceParams[1]]+($rows[$priceLevel.$priceParams[1]]* 0.05)): $rows[$priceLevel.$priceParams[1]]) : $rows[$priceLevel.$priceParams[1]];
                                                        $paymentComment = !empty($rows[$priceLevel.$priceParams[2]]) ? '<em>('.trim($rows[$priceLevel.$priceParams[2]]).')</em><br/>' : '';
                                                        if($paymentCost!=0) {
                                                            echo '<strong>'.$rows[$priceLevel.$priceParams[0]].' '.$paymentCost.' &nbsp; </strong> &nbsp; '.$paymentComment;
                                                        }
                                                        break;
                                    }
                                }
                                ?>
                                <a href="#currency" class="currencyDetail" style="text-align:center; font-size:10px;" data-type="inline" data-width="20%">(Convert Currency)</a>
                                </section>
                            </div>
                            <div  style="border: solid 1px #E3EBEE; display: block; padding: 15px;">
                                <span ><h3 style="font-size:13px; font-weight:normal"><strong>Venue:</strong> <?php echo $rows['venue']?></h3></span>
                            </div>
                            
                            <div class="clearfix"></div>
                            <div id="contact-wrapper5" style="float:left;" class="window boxContent"> 
                              <div class="smart-forms" style="width:100%;">
                                    <form action="" method="post" id="PremiumListing">
                                      <table style="width:100%;" class="premium2">
                                        <tbody>
                                          <tr>
                                            <td >
                                                <div class="notification alert-info spacer-t10" style="width:100%; display:none;" id="msgbox"></div>
                                            </td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <p style="text-align:center">
                                                      Make Payment for <?php echo $rows['event_title']; ?>
                                                  </p>
                                              </td>
                                          </tr>
                                          <tr>
                                            <td style="text-align:center;"><strong></strong></td>
                                          </tr>
                                          <tr>
                                              <td><label class="field prepend-icon">
                                              <input name="cust_name" type="text" class="gui-input" placeholder="Payee's Name" id="name"  required />
                                              <span id="output_premium"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image" width="20" height="14" style="text-align:center" /></span>
                                              <span class="field-icon"><i class="fa fa-suitcase"></i>
                                              </span>  
                                              </label>          
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style="width:100%;"><label class="field prepend-icon">
                                                  <input name="phone" type="phone" class="gui-input" placeholder="Payee's Phone" id="contact_person"  size="40" required />
                                                  <span class="field-icon"> <i class="fa fa-user"></i></span>
                                                  </label>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <label class="field prepend-icon">
                                                  <input name="email" type="email" class="gui-input" placeholder="Payee's Email" id="email_pre" size="40" required /><span class="field-icon"><i class="fa fa-envelope"></i></span>  
                                                  </label>          
                                              </td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <label class="field prepend-icon">Select Amount: <br/>
                                                      <select class="gui-input" name="amount" required="required">
                                                          <?php if(is_numeric($first_amount) && intval($first_amount)!=0){ ?> <option value="<?php echo $first_amount; ?>"><?php echo number_format($first_amount, 2)." (".$rows['comment'].")"; ?></option><?php } ?>
                                                          <?php if(is_numeric($second_amount) && intval($second_amount)!=0){ ?> <option value="<?php echo $second_amount; ?>"><?php echo number_format($second_amount, 2)." (".$rows['second_comment'].")"; ?></option><?php } ?>
                                                          <?php if(is_numeric($third_amount) && intval($third_amount)!=0){ ?> <option value="<?php echo $third_amount; ?>"><?php echo number_format($third_amount, 2)." (".$rows['third_comment'].")"; ?></option><?php } ?>
                                                          <?php if(is_numeric($fourth_amount) && intval($fourth_amount)!=0){ ?> <option value="<?php echo $fourth_amount; ?>"><?php echo number_format($fourth_amount, 2)." (".$rows['fourth_comment'].")"; ?></option><?php } ?>
                                                      </select>
                                                  </label>          
                                              </td>
                                          </tr>
                                              <input name="plan" type="hidden" value="Value Listing">
                                              <input name="item_name" type="hidden"  value="<?php echo $rows['event_title']; ?>" />
<!--                                              <input name="amount" type="hidden"  value="<?php // echo intval($rows['cost']) ?>" />-->
                                              <input name="pro_email" type="hidden"  value="<?php echo $rowsBiz['email']; ?>" />
                                              <input name="pro_name" type="hidden"  value="<?php echo $rowsBiz['business_name']; ?>" />
                                          <tr>
                                            <td  >
                                         
                                              <button class="button" type="submit"> Continue </button>
                                            </td>
                                            <td>
                                             <button class="button" id="closeBox"> Close </button> 
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </form>
                                </div>
                          <div class="clearfix"></div>
                          </div>
                            </div>
                            <div style="border: solid 1px #E3EBEE; display: block; padding: 15px;"> 
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
                            <div class="respond"> <div class="tags"></div> </div>

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
                                
                                <?php
                                } else {
                                ?>
                                <strong style="font-size:20px; color:#F30;">Sorry! The training you requested has not been activated or no longer exists</strong>
                                 <?php
                                }
        ?>
                                <div class="clearfix"></div>
                        <div class="respond" style="margin-top:20px"> <?php echo $GetAdverts -> LandScapeAds("Page Banner 2", $advert);?> </div>
                        <?php 
                        if(intval($rowsBiz['premium']) > 2){ 
                            $resRelEvs = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 AND organiser = '".$rowsBiz['business_name']."' AND event_id !='".$rows['event_id']."' AND SortDate >= CURRENT_DATE ORDER BY RAND() LIMIT 3 ");
                            if(NUM_ROWS($resRelEvs) > 0){
                        ?>
                        
                        <div class="clearfix"></div>
                        <div class="respond">
                            <h6 style="font-size:20px;margin-top: 40px">Related Courses</h6>
                            <?php 
                            while($rowsPremium = SqlArrays($resRelEvs)){	
                                $business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rowsPremium['organiser']."%'");
                                $biz_name = SqlArrays($business);
                                if($biz_name['logos'] == '' || $rowsPremium['premium']<1 || $biz_name['logos']==false) $logo = 'images/blank.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
                                $star = '<img src="'.SITE_URL.$logo.'" alt="business logo" width="50" height="50" alt=""/>';
                                $clock_icon = '<div class="calendar_time"></div>';
                                $bg_class = '';
                                $listing_diff = '';
                                $start_h1 = '<h2>';
                                $end_h1 = '</h2>';
                                $pre_link = '<a href="'.SITE_URL.'tprovider/'.$biz_name['business_id'].'/'.str_replace($title_link,"-",$biz_name['business_name']).'" target="_blank" style="color:#333; font-weight:normal;">'.$rowsPremium['organiser'].'</a>';
                            
                            ?>
                                <div itemscope itemtype="http://schema.org/EducationEvent" class="eventListing <?php echo ($rowsPremium['deals'] != '') ? 'deals' : '' ?>" onClick="javascript:url_location('<?php echo SITE_URL . 'events/' . $rowsPremium['event_id'] . '/' . str_replace($title_link, "-", $rowsPremium['event_title']); ?>')">
                                    <div class="eventListingInner">
                                        <a href="<?php echo SITE_URL . 'events/' . $rowsPremium['event_id'] . '/' . str_replace($title_link, "-", $rowsPremium['event_title']); ?>" itemprop="url" style="display:block; padding:3px;" title="<?php echo $rowsPremium['event_title']; ?>">
                                            <span class="spanTitle" itemprop="name" ><?php echo $rowsPremium['event_title']; ?></span>
                                        </a> 
                                        <div class="innerHeadingPropEvent">
                                            <p itemprop="doorTime" ><?php echo dateDiff($rowsPremium['startDate'], $rowsPremium['endDate']); ?>, 
                                                <?php echo date('M d', strtotime($rowsPremium['startDate'])) . " - " . date('d M, Y', strtotime($rowsPremium['endDate'])); ?> &nbsp;</p>
                                            <span style="display:none;" itemprop="startDate" content="<?php echo date('Y-m-d h:m:s', strtotime($rowsPremium['startDate'])); ?>"><?php echo date('Y-m-d h:m:s', strtotime($rowsPremium['startDate'])); ?>
                                            </span>

                                            <div class="clearfix"></div>   
                                        </div>  

                                        <span itemprop="location" style="text-align:center; display:block;">
                                            <?php echo GetEventLocation($rowsPremium['event_id']); ?>
                                        </span>
                                        <div class="respond">
                                            <div class="testImg" style="background-image:url(<?php echo SITE_URL . $logo; ?>); background-repeat:no-repeat; background-position:center;">
                                            </div>
                                        </div>
                                        <p style="text-align:center; font-size:14px; color: #105773; margin:5px 0 5px 0;" >
                                            <?php echo $rowsPremium['organiser']; ?>
                                        </p>
                                        <div class="trainingProviders" style="width:100%;">
                                            <div style="color:#000; font-size:12px; text-align:left;"  class="description" itemprop="description" ><?php echo trimStringToFullWord(145, $rowsPremium['description']) . ' ...'; ?> </div>
                                        </div> 
                                    </div>

                                    <div class="clearfix"></div>   
                                </div>
                            <?php } ?>
                        </div>
                        <?php } }?>
                    </div>
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
                    <div id="currency" style="float:left;" class="window_currency boxContent"> <div id="currency-widget"></div> </div>
<div id="contact-wrapper2" class="window boxContent"> 
    <form id="formProvider" name="form1" method="post" class="smart-forms form_content" >
        <div class="highlights" style="margin-top:6px;">
        <strong style="color:#006600;">Book for this Course now</strong>
        </div>
        <div class="notification alert-info spacer-t10" style="display:none;" id="msgbox"></div>
        <label class="field"> 
        <input type="hidden" name="subject" id="subject" value="<?php echo ucwords($rows['event_title']); ?>">
        <input type="text" class="gui-input" style="color:#000" value="Course Title: <?php echo strtoupper($rows['event_title']); ?>" disabled >
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
        <span class="field-icon"><i class="fa fa-home"></i></span>
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
        <input name="to" type="hidden" value="<?php echo str_replace('@', '&#64;', $rows['email']); ?>" id="to" /> 
        <button class="button" id="closeBox"> Close </button> 
    </form>
</div>
<?php include("tools/side-menu_new.php"); ?> 
<div class="clearfix"></div>        
</div>
<!-- end subpage -->    
</div>
<div class="clearfix"></div>
</div>  
<div class="clearfix"></div>
</div>
    <!-- contact-wrapper5 -->

<!-- End contact-wrapper5 -->

<!-- Interswitch form -->
<form name="form2" id="form2" action="https://webpay.interswitchng.com/paydirect/pay" method="post">     
  <input name="product_id" type="hidden" value="<?php echo $product_id;?>" />     
  <input name="amount" type="hidden" value="<?php echo $myamount;?>" />     
  <input name="currency" type="hidden" value="<?php echo $currency;?>" />     
  <input name="site_redirect_url" type="hidden" value="<?php echo $redirect_to;?>" /> 
  <input name="txn_ref" type="hidden" value="<?php echo $txn_ref;?>" />     
  <input name="site_name" type="hidden" value="<?php echo $site_name;?>" />     
  <input name="cust_id" type="hidden" value="<?php echo $cust_id;?>" />     
  <input name="cust_name" type="hidden" value="<?php echo $cust_name;?>" /> 
   <input name="cust_email" type="hidden" value="<?php echo $cust_email;?>" />     
  <input name="cust_name_desc" type="hidden" value="<?php echo $cust_name;?>" />     
  <input name="pay_item_id" type="hidden" value="<?php echo $pay_item_id;?>" />  
  <input name="pay_item_name" type="hidden" value="<?php echo $item_name;?>" />     
  <input name="local_date_time" type="hidden" value="" />     
  <input name="hash" type="hidden" value="<?php echo $save_hash;?>" />     
  <input name="payment_params" type="hidden" value="0" />     
  
</form>
  <!-- end interswitch form -->
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
    if($('form#formProvider #name').val() == ''){
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
    $.post("<?php echo SITE_URL;?>tools/send.php",{ name:$('form#formProvider #name').val(),email:$('#email').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('form#formProvider #phone').val(),address:$('#address').val(),title:$('#course').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
        {
      if(data=='yes') //if correct login detail
      {
        $("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
      { 
        //add message and change the class of the box and start fading
        $(this).html('Your message has been sent!').removeClass('alert-info').addClass('alert-success').fadeTo(900,1);
        $('form#formProvider #name').val("");
        $('#email').val("");
        $('#comment').val("");
        $('#title').val("");
        $('form#formProvider #phone').val("");
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
      $('#add_event').html('<a href="#" class="cssButton_roundedLow cssButton_lightGrey" style="padding:10px;                       font-size:14px; color:#000;">Added to my events</a>');
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
 <script>
    $(document).ready(function(){
        var userId = $('#form2 input[name="cust_id"]').val();
        var transactionReference = $('#form2 input[name="txn_ref"]').val();
        var amount = $('#form2 input[name="amount"]').val();
        var userName = $('#form2 input[name="cust_name"]').val();
        var email = $('#form2 input[name="cust_email"]').val();
        if (userName !== '' && email !=='') {
          submitForm(userId, transactionReference, amount, userName);
        };
        function submitForm(userId, transactionReference, amount, userName){
            $.ajax({
                url: 'log-payment-record.php',
                type: 'POST',
                data:{userId:userId, transactionReference:transactionReference, amount:amount, userName:userName},
                success: function(data, status){
                    $("#form2").submit();
                }
            });
        }
    });
 </script>
</body>
</html>