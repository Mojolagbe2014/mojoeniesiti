<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
require 'tools/convert.php';
$converter = new Convert();//Create Money converter object
if(connection());
$message = '';
$advert = "Advertise";
 //payment 
  $monthly = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
  $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
  $cust_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $customer_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  $pro_email = "info@kaisteventures.com";
  $pro_name = "Kaiste Ventures";
  $txn_ref = "NST".rand(10000, 10000000);
  $cust_id = "898837";
  $currency = 566;
  $product_id = 5791;
  $pay_item_id = 101;
  $amount = $monthly * $quantity;
  $pay_item_name = "Advanced Management and Administrative Course for Secretaries and Personal Assistant";
  $company_name =  "Kaiste Ventures Limited";
  $redirect_to  = "https://www.nigerianseminarsandtrainings.com/payment?pid=".base64_encode($product_id)."&amt=".  base64_encode($amount)."&cust_email=". base64_encode($cust_email) ."&cust_name=". base64_encode($customer_name) ."&pro_email=". base64_encode($pro_email) ."&pro_name=". base64_encode($pro_name) ."";
  $site_name = "www.kaisteventures.com";
  $mackey = "27ED7ACA287A0364501B13841B70F72430E9DEA4F55C9278C1E28006EA236BF28B7C11A7F1CCCACA7EC72AB0B692B23A090A54729D75923118B8799A4F100EF1";
  $unsave_hash = $txn_ref.$product_id.$pay_item_id.$amount.$redirect_to.$mackey;
  $save_hash = hash("sha512", $unsave_hash, false);
  //end payment
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title> Advertise - Nigerian Seminars and Trainings </title>
<meta name="description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings."/>
<meta name="keywords" content="Advertise, business, conferences, training seminars, workshops " />
<meta name="dcterms.description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings." />
<meta property="og:title" content=" Advertise - Nigerian Seminars and Trainings" />
<meta property="og:description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings." />
<meta property="twitter:title" content=" Advertise - Nigerian Seminars and Trainings" />
<meta property="twitter:description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings." />
<?php include("scripts/headers_new.php");?>
<link rel="stylesheet" type="text/css"  href="css/pricing-tabled-light.css">
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<?php include('tools/analytics.php');?>
<script>
$(document).ready(function() {  

$('a[class=inter-switch-btn]').click(function(e) {
//Cancel the link behavior
e.preventDefault();
var amountMe = $(this).attr('data-amount');
$('#formProvider #myamount').val(amountMe);
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

$('#amount').val('200');

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
$('#closeBox').click(function (e) {
//Cancel the link behavior
e.preventDefault();

$('.window').fadeOut('slow');
$('#mask').fadeOut('slow');
});   

//if mask is clicked
$('#mask').click(function () {
$('.window').fadeOut('slow');
$(this).fadeOut('slow');
$('#msgbox').fadeOut('slow');
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

});
function Close(e){
e.preventDefault();
$('#mask').fadeOut('slow');
$('.window').fadeOut('slow');
}

$(document).ready(function() {
  $('.paypal-btn').click(function(e) {
    e.preventDefault();
    var amountUSD = $(this).attr('data-amount');
    $("#paypalForm #myamount").val(amountUSD);
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

    $('#amount').val('200');

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();

    //Set the popup window to center
    $(id).css('top',  winH/2-$(id).height()/2);
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(2000); 
  })
});
</script>
<style type="text/css">
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
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
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}

.advert_bg{
  background-image: url(images/advertbg.png);
  background-repeat: no-repeat;
  background-position: center center; 
}

</style>
</head>

<body id="advertise">
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table >
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:28px;font-weight: normal;padding:5px;"><i class="fa fa-flag"></i>&nbsp;Advertise with us</h2></td>
</tr>
<tr>
<td style="font-size:11px">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="sub_links">
<div id="subpage">
<div id="contact-wrapper" class="" style="border:0; padding:8px; font-size:13px; line-height:1.5; text-align:justify;"> 
<div id="subpage_content_ad">
  <p>Nigerian
  Seminars and Trainings.com provides free and comprehensive information on
  conferences, workshops, seminars, trainings, and other learning opportunities
  in Nigeria, Africa and around the world. We also offer information about and
  free links to training providers, venue providers, training equipment suppliers
  etc.</p>

  <p>With thousands of current training programs, over two
  hundred training providers, several training venues and event managers on the
  site, Nigerian Seminars and Trainings.com is now the biggest and fastest
  growing training website in Nigeria. </p>
  <p>Because we cater for a specific niche with a generous parade
  of high caliber audience, the website is an obvious choice for businesses
  hoping to reach business leaders, company executives, professionals in all
  fields of learning, training providers, prospective trainees and the conference
  and seminars industry subsector as a whole.</p><br />
  <p >&nbsp;<strong>Benefits of Advertising on the site</strong></p>
  <ul class="formart">
  <li>Increased exposure of training and training related
  businesses to local and international audiences</li>
  <li>Increased traffic to advertiser&#8217;s website</li>
  <li>Increased awareness for advertisers&#8217; brands</li>
  <li>Networking opportunities with other businesses on the site</li>
  <li>Strategic positioning of your business in the first line of
  thought of training planners/decision makers and all visitors to the website</li>
  <li>Tremendous exposure from our online/offline viral marketing
  activities</li>
  </ul>
  <p><strong>Our Ads Policy</strong></p>
  <p>As a rule, we do not alternate ads. Ad positions booked are available to
  the advertiser on a 24/7 basis for the period booked. Therefore, adverts are
  visible to site visitors at all times. Our advertisers are at liberty to change
  their messages as often as they deem fit to keep their target audiences engaged
  (terms &amp; conditions apply). Please download our ad <a href="format/Nigerian_seminars_advert_formats.pdf" style="color:#F00;"><b>formats</b></a> and <a href="format/Nigerian_seminars_advert_rates.pdf" style="color:#F00;"><b>rates</b></a></p>
  <p><strong>Requirement</strong></p>
  <p>Advertisers are required to provide
  own advert materials - Images, files, scripts in HTML codes, produced to
  specification (download format for available specifications)</p>
  
  <p><strong>Contact Us</strong>
  <br />Advert Unit
  <br /> Nigerian Seminars and Trainings.com
  <br />Telephone: +2348094413786, +2348057659870
  <br /> 
  Email: <a href="mailto:admin&#64;nigerianseminarsandtrainings.com">admin</a>
  <br />
  Office Hours: 09:00am &#8211;
  <br /> 05:00pm GMT+1 (Monday &#8211; Friday)</p>
<div class="highlights"><h2 style="font-size:22px; font-weight:normal;">Advert Rates</h2></div>
<div class="pricing two green_tab">
<!--price box column-->
<div class="price-col first">
<div class="th">
<h3><span class="title" style="font-size:15px; font-weight:bold"><strong>Advert Sizes in </strong>(pixel)</span></h3>
<span class="bottom"></span>
</div>
<div class="p-inner">
<ul class="feature" style="list-style:none;">
<li class="ad-size">120 x 600</li>
<li class="odd ad-size" >160 X 600</li>
<li class="ad-size">468 x 60</li>
<li class="odd ad-size">728 X 90</li>
<li class="ad-size">234 X 90</li>
<li class="odd ad-size">300 X 90</li>
<li class="ad-size">300 X 250</li>
<li class="ad-size">250 X 400</li>
<li class="odd ad-size">250 X 600</li>
<li class="ad-size">200 X 200</li>
<li class="odd ad-size">300 X 600</li>
</ul>
<span class="call-action">
</span>
</div>
</div>
<!--price box column-->
<div class="price-col  last"> 
<div class="th">
<h3><span class="title" style="font-size:13px; font-weight:bold"><strong>Prices / Month (VAT Inclusive)</strong></span></h3>
<span class="bottom"></span>
</div>
<div class="p-inner">
<ul class="feature" style="list-style:none;">
<li> 
  <span>NGN 312,375 </span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="31237500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li class="odd">
  <span>NGN 312,375</span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="31237500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li>
  <span>NGN 183,750</span> 
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="18375000">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li class="odd">
  <span>NGN 312,375 </span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="31237500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li>
  <span>NGN 128,625</span> 
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="12862500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li class="odd">
  <span>NGN 128,625</span> 
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="12862500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li>
  <span>NGN 220,500 </span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
      <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="22050000">
        <img src="images/interswitch_ch.png" alt="payment method">
      </a>
      
  </form>
</li>
<li>
  <span>NGN 312,375</span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="31237500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li>
  <span>NGN 312,375</span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="31237500">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
<li class="odd">
  <span>NGN 183,750</span> 
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="18375000">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li> 
<li>
  <span>NGN 367,500</span>
  <form action="paypal/order-process.php" method="POST" class="paypal-inter">
    <a href="#myModal1" name="modal" class="inter-switch-btn" style="font-size:12px;" data-amount="36750000">
      <img src="images/interswitch_ch.png" alt="payment method">
    </a>
    
  </form>
</li>
</ul>
<span class="call-action">
</span>
</div>
</div>                          
<div id="mask"></div>
<div id="currency" style="float:left;" class="window_currency boxContent">
<div id="currency-widget"></div>
</div>
</div>
<div id="inline" style="background:white;">
<?php echo $message;?>
<div class="oldBankdetail" style="float:left;">
</div>
</div>
</div>
<div id="latest_content_items">
</div><!-- end latest_content_items -->
</div>
</div>
<!-- Modal1 -->
<div id="myModal1" style="float:left;" class="window boxContent"> 
  <form id="formProvider" name="form1" method="post" action="" class="smart-forms form_content" >
      <table class="contact_provider_table" style="width:100%;">
        <tr>
          <td style="width:400px;">  
            <label class="field prepend-icon">
                <input type="text" name="name" id="name" class="gui-input" placeholder="Full Name" s  required>
                <label for="firstname" class="field-icon"><i class="fa fa-user"></i></label>  
            </label>
          </td>
        </tr>
        <tr>
          <td style="width:400px;">
            <label class="field prepend-icon">
                <input type="email" name="email" id="email" class="gui-input" placeholder="Email"  required>
                <label for="email" class="field-icon"><i class="fa fa-envelope"></i></label>  
            </label>
          </td>
        </tr>
        <tr>
          <td style="width:400px;">  
            <label class="field prepend-icon">
                <input type="number" name="quantity" id="quantity" class="gui-input" placeholder="Number Of Months."  required>
                <label for="firstname" class="field-icon"><i class="fa fa-user"></i></label>  
            </label>
          </td>
        </tr>
        <tr>
        <input type="hidden" name="amount" id="myamount">  
        <td colspan="2" align="center" >
          <button class="button btn-primary" type="submit"> Continue </button>
          <input name="to" type="hidden" value="" id="to" />
          <input name="course" type="hidden" value="" id="course" /> 
          <button class="button" id="closeBox"> Close </button>
        </td>
        </tr>
    </table> 
  </form>
  <div class="clearfix"></div>
</div>
<!-- End Modal1 -->

<!-- Modal2 -->
<div id="myModal2" style="float:left;" class="window boxContent"> 
  <form id="paypalForm" name="form1" method="post" action="paypal/order-process.php" class="smart-forms form_content" >
      <table class="contact_provider_table" style="width:100%;">
        <tr>
          <td style="width:400px;">  
            <label class="field prepend-icon">
                <input type="number" name="quantity" id="quantity" class="gui-input" placeholder="Number Of Months."  required>
                <label for="firstname" class="field-icon"><i class="fa fa-user"></i></label>  
            </label>
          </td>
        </tr>

        <tr>
        <input type="hidden" name="item_id" value="100"/>
        <input type="hidden" name="item_name" id="item_name" value="advert"/>
        <input type="hidden" name="amount" id="myamount">  
        <td colspan="2" align="center" >
          <button class="button btn-primary" type="submit"> Continue </button>
          <input name="to" type="hidden" value="" id="to" />
          <input name="course" type="hidden" value="" id="course" /> 
          <button class="button" id="closeBox"> Close </button>
        </td>
        </tr>
    </table> 
  </form>
  <div class="clearfix"></div>
</div>
<!-- End Modal2 -->


<!-- Interswitch form -->
<form name="form2" id="form2" action="https://webpay.interswitchng.com/paydirect/pay" method="post">     
    <input name="product_id" type="hidden" value="<?php echo $product_id;?>" />     
    <input name="amount" type="hidden" value="<?php echo $amount;?>" />     
    <input name="currency" type="hidden" value="<?php echo $currency;?>" />     
    <input name="site_redirect_url" type="hidden" value="<?php echo $redirect_to;?>" /> 
    <input name="txn_ref" type="hidden" value="<?php echo $txn_ref;?>" />     
    <input name="site_name" type="hidden" value="<?php echo $site_name;?>" />     
    <input name="cust_id" type="hidden" value="<?php echo $cust_id;?>" />     
    <input name="cust_name" type="hidden" value="<?php echo $customer_name;?>" /> 
     <input name="cust_email" type="hidden" value="<?php echo $cust_email;?>" />     
    <input name="cust_name_desc" type="hidden" value="<?php echo $customer_name;?>" />     
    <input name="pay_item_id" type="hidden" value="<?php echo $pay_item_id;?>" />  
    <input name="pay_item_name" type="hidden" value="<?php echo $pay_item_name;?>" />     
    <input name="local_date_time" type="hidden" value="" />     
    <input name="hash" type="hidden" value="<?php echo $save_hash;?>" />     
    <input name="payment_params" type="hidden" value="0" />     
    <input name="xml_data" type="hidden" value='
        <payment_item_detail> 
            <item_details detail_ref="<?php echo $txn_ref;?>" institution="<?php echo $company_name;?>" sub_location="" location="">     
                <item_detail item_id="1" item_name="<?php echo $pay_item_name;?>" item_amt="<?php echo $amount;?>" bank_id="6" acct_num="0176251728" />     
            </item_details>     
        </payment_item_detail>' />
</form>
<!-- end interswitch form -->



<div class="sub_links2_middle"><div class="sub_links2_middle">
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
<?php include("tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>
<script type="text/javascript" src="js/jquery.currency.js"></script>
<script type="text/javascript" src="js/jquery.currency.localization.en_US.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$('#currency-widget').currency({
localRateProvider: '<?php echo SITE_URL;?>api_currency.php',
loadingImage: '<?php echo SITE_URL;?>images/img/loader.gif',
});
});
</script>

<script>
$(document).ready(function() {  

$('a[class=currency]').click(function(e) {
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

$('#amount').val('200');

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
$('.window_currency #Close').click(function (e) {
//Cancel the link behavior
e.preventDefault();


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
function GetRate(val){
$('#price_rate').text(val)
$('#price_advert').show();
}
</script>
<script>
    $(document).ready(function(){
        var userId = $('form input[name="cust_id"]').val();
        var transactionReference = $('form input[name="txn_ref"]').val();
        var amount = $('form input[name="amount"]').val();
        var userName = $('form input[name="cust_name"]').val();
        var email = $('form input[name="cust_email"]').val();
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