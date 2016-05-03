<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");
if(connection());
$message = '';
$advert = "Articles";

?>
<!DOCTYPE html >



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Nigerian Seminars and Trainings - Advertise</title>

<meta name="description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings."/>

 <meta name="dcterms.description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings." />

<meta property="og:title" content="Nigerian Seminars and Trainings - Advertise" />

<meta property="og:description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings." />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Advertise" />

<meta property="twitter:description" content="Advertise your business, conferences, training seminars, workshops, short courses, products and services on Nigerian seminars and trainings." />


	<?php include("scripts/headers_new.php");?>
 <link rel="stylesheet" type="text/css"  href="css/pricing-tabled-light.css">

 
 <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
 
<?php include('tools/analytics.php');?>

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



<body>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<!-- Quantcast Tag -->
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

_qevents.push({
qacct:"p-2fH5lI6K2ceJA"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->





<?php include("tools/header_new.php");?>



<div id="main">
  <div id="content">

<?php include("tools/categories_new.php");?>
  
<div id="content_left" style="padding:8px; margin-left:10px;">

         
<div class="event_table_inner advert_bg">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table >
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:28px; padding:5px;"><i class="fa fa-flag"></i>&nbsp;Advertise with us</h2></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
				<div id="sub_links">
 
				<div id="subpage">
                
                 <div id="contact-wrapper" class="rounded" style="padding:8px;"> 
                 
		<div id="subpage_content_ad">

					  <p><!--<img src="images/advertise-girl.jpg" width="348" height="183" alt="advertise with us" style="padding:3px; background-color:#CCC; float:left; margin-right:5px;" />-->Nigerian

					    Seminars and Trainings.com provides free and comprehensive information on

					    conferences, workshops, seminars, trainings, and other learning opportunities

					    in Nigeria, Africa and around the world. We also offer information about and

					    free links to training providers, venue providers, training equipment suppliers

					    etc.

				      </p>


                      <p>With thousands of current training programs, over two

                        hundred training providers, several training venues and event managers on the

                        site, Nigerian Seminars and Trainings.com is now the biggest and fastest

                      growing training website in Nigeria. </p>

                      <p>Because we cater for a specific niche with a generous parade

                        of high caliber audience, the website is an obvious choice for businesses

                        hoping to reach business leaders, company executives, professionals in all

                        fields of learning, training providers, prospective trainees and the conference

                      and seminars industry subsector as a whole.</p><br />

                      <p>&nbsp;<strong>Benefits of Advertising on the site</strong></p>

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

                <p><strong>Pay for your advert with PayPal</strong></p>

                      <p>After sending in your advert

                        materials, you can now pay us for your advert booking with your credit/debit

                        cards using the PayPal button below.<span style="">&nbsp; </span>PayPal is a universally accepted and secure payment platform affording

                        you the opportunity to make payment across continents in minutes.</p>

                <p><strong>Contact Us</strong>

                <br />Advert Unit

               <br /> Nigerian Seminars and Trainings.com

                    

  <br />Telephone: +2348189810988, +2348094413786, +2348057659870

               <br /> 
               Email: <a href="mailto:admin&#64;nigerianseminarsandtrainings.com">admin</a>

              <br />
              Office Hours: 09:00am &#8211;

                       <br /> 05:00pm GMT+1 (Monday &#8211; Friday)</p>

                       <div class="highlights" style="font-size:22px;">Advert Formats and Rates</div>
                        
                        <div class="pricing two green_tab">
                        
                        
                               <!--price box column-->
				<div class="price-col first">
				<div class="th">
					<span class="title"><strong>Advert Sizes in </strong>(pixel)</span>
					<span class="bottom"></span>
				</div>
					<div class="p-inner">
					<ul class="feature" style="list-style:none;">
						<li>120 x 600</li>
						<li class="odd">160 X 600</li>
						<li>468 x 60</li>
						<li class="odd">728 X 90</li>
						<li>234 X 90</li>
                        <li class="odd">300 X 90</li>
                        <li>300 X 250</li>
                        <li class="odd">200 X 200</li> 
					  <li>250 X 400</li>
                     
					</ul>
					<span class="call-action">
					
					</span>
					</div>
				</div>
				
				<!--price box column-->
					<div class="price-col  last"> 
					<div class="th">
					<span class="title"><strong>Prices / Month</strong></span>
					<span class="bottom"></span>
					</div>
					<div class="p-inner">
					<ul class="feature" style="list-style:none;">
					<li>NGN 297,500 <a href="#currency" class="currency" onclick="GetRate('NGN 297,500')" style="padding-left:30px;">Convert</a></li>
						<li class="odd">NGN 297,500<a href="#currency" class="currency" onclick="GetRate('NGN 297,500')" style="padding-left:30px;">Convert</a></li>
						<li>NGN 175,000 <a href="#currency" class="currency" onclick="GetRate('NGN 175,000')" style="padding-left:30px;">Convert</a></li>
						<li class="odd">NGN 297,500 <a href="#currency" class="currency" onclick="GetRate('NGN 297,500')" style="padding-left:30px;">Convert</a></li>
						<li>NGN 122,500 <a href="#currency" class="currency" onclick="GetRate('NGN 122,500')" style="padding-left:30px;">Convert</a></li>
                        <li class="odd">NGN 122,500 <a href="#currency" class="currency" onclick="GetRate('NGN 122,500')" style="padding-left:30px;">Convert</a></li>
                        <li>NGN 210,000 <a href="#currency" class="currency" onclick="GetRate('NGN 210,000')" style="padding-left:30px;">Convert</a></li>
                        <li class="odd">NGN 175,000 <a href="#currency" class="currency" onclick="GetRate('NGN 175,000')" style="padding-left:30px;">Convert</a></li> 
					  <li>NGN 262,500 <a href="#currency" class="currency" onclick="GetRate('NGN 262,500')" style="padding-left:30px;">Convert</a></li>
                     
                      
                        
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

<table class="premium2">

  <tr>

    <th style="text-align:center; width:204; color:#000000;">Pay through Paypal</th>

    <th colspan="2"  style="text-align:center;color:#000000;" >Pay by Bank Deposit</th>

  </tr>

  <tr>

    <td style="vertical-align:top;" ><?php include("tools/paypal.php");?>







</td>

    <td colspan="2"  style="vertical-align:top;"><form id="form12" name="form1" method="post" >

      <table class="bankdetail">

        <tr>

          <td style="width:413" ><strong>Bank Account Information</strong></td>
          <td style="width:347" >&nbsp;</td>

          </tr>

        <tr>

          <td >Account Name:</td>

          <td >KAISTE VENTURES</td>

        </tr>

        <tr>

          <td>Bank:</td>

          <td>Skye Bank Plc</td>

        </tr>

        <tr>

          <td>Account Number:</td>

          <td>1770443788</td>

        </tr>

        <tr>

          <td>Account Sort code (for internet transfer)</td>

          <td>076151488</td>

        </tr>

        <tr>

          <td>&nbsp;</td>

          <td>&nbsp;</td>

        </tr>

        <tr>

          <td ><p><strong>Note: </strong>Please send email to <a href="mailto:admin&#64;nigerianseminarsandtrainings.com">admin</a>
 with the following information:

            </p>

            <p>1. Depositor's name </p>

            <p>2. Advert Size</p>

            <p>3.Teller  No and Amount  deposited. </p>

            <p>4.The image you wish to display on our website. (<strong>only PNG, JPEG AND GIF images are allowed)</strong>.</p></td>
            
             <td >&nbsp;</td>

        </tr>

      </table> </form>

    </td>

  </tr>

  

  <tr>

    <td >&nbsp;</td>
     <td style="width:513" >&nbsp;</td>
     <td style="width:297" >&nbsp;</td>

  </tr>

</table></div>

<div class="newBankdetail">

<table  class="premium2">

  <tr>

    <th  style="text-align:center;">Pay by Bank Deposit</th>

    </tr>

  <tr>
    
    <td >      <blockquote>
      <form id="form1" name="form1" method="post" >
        
        <table style="width:100%;" class="bankdetail">
          
          <tr>
            
            <td ><strong>Bank Account Information</strong></td>
            
            </tr>
          
          <tr>
            
            <td >Account Name:</td>
            
            <td >KAISTE VENTURES</td>
            
            </tr>
          
          <tr>
            
            <td>Bank:</td>
            
            <td>Skye Bank Plc</td>
            
            </tr>
          
          <tr>
            
            <td>Account Number:</td>
            
            <td>1770443788</td>
            
            </tr>
          
          <tr>
            
            <td>Account Sort code (for internet transfer)</td>
            
            <td>076151488</td>
            
            </tr>
          
          <tr>
            
            <td>&nbsp;</td>
            
            <td>&nbsp;</td>
            
            </tr>
          
          <tr>
            
            <td ><p><strong>Note: </strong>Please send email to payments@nigerianseminarsandtrainings.com with the following information:
              
              </p>
              
              <p>1. Depositor's name </p>
              
              <p>2. Advert Size</p>
              
              <p>3.Teller  No and Amount  deposited. </p>
              
              <p>4.The image you wish to display on our website. (<strong>only PNG, JPEG AND GIF images are allowed)fff</strong>.</p></td>
            
            </tr>
          
        </table> </form>
    </blockquote>
        
        
      
    </td>
    
    </tr>
  <tr>
    <th style="text-align:center; vertical-align:top;">Pay through Paypal</th>
  </tr>
  <tr>
    <td ><?php include("tools/paypal.php");?></td>
  </tr>

  
  

</table>
</div>

</div>

                      

                </div>

			

					<div id="latest_content_items">

					

						<!-- Section 1 Featured -->

						<!-- End Featured 1 -->

				

					</div><!-- end latest_content_items -->

				</div>
                </div>

               

					


            <div class="sub_links2_middle"><div class="sub_links2_middle">


 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

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
	$('#currency-widget').currency();
});
</script>
</body>

</html>