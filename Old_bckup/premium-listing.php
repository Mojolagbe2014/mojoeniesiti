<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");

if(connection());


if($_SESSION['user_id']){
	
	$result = MysqlSelectQuery("select * from businessinfo where user_id='".$_SESSION['user_id']."' ");
	$rows = SqlArrays($result);
	
	
	}

$advert = "Advertise";

$message = '';

reset ($payments);

	while (list ($key, $val) = each ($payments)) {

		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";

		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";

	}

if(isset($_POST['submit_payment'])){

	reset ($_POST);

	while (list ($key, $val) = each ($_POST)) {

		if ($val == "") $val = "NULL";

		$payments[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);

		if ($val == "NULL")

			$_SESSION[$key] = NULL;

		else

			$_SESSION[$key] = $val;

	}

	if($_SESSION['business_name'] == "")$message = errorMsg("Please enter your business name");

	else if($_SESSION['contact_person'] == "")$message = errorMsg("Please enter contact person");

	else if($_SESSION['email'] == "")$message = errorMsg("Please enter your email address");

	else if(!smcf_validate_email($_SESSION['email']))$message = errorMsg("Please enter a valid email address");

	else if($_SESSION['business_type'] == "")$message = errorMsg("Please enter select business type");

	else if($_SESSION['plan'] == "")$message = errorMsg("Please enter select subscription plan");

	else if($_SESSION['teller_no'] == "")$message = errorMsg("Please enter your teller no");

	else if($_SESSION['amount_deposited'] == "")$message = errorMsg("Please enter the amount deposited");

	else if($_SESSION['date_deposit'] == "")$message = errorMsg("Please enter the date of deposit");

  			else{

	MysqlQuery("insert into payment (business_name,contact_person,email,business_type, plan,teller_no,amount_deposited,date_posted,payment_type,payment_date) values('".$_SESSION['business_name']."','".$_SESSION['contact_person']."','".$_SESSION['email']."','".$_SESSION['business_type']."','".$_SESSION['plan']."','".$_SESSION['teller_no']."','".$_SESSION['amount_deposited']."','".$_SESSION['date_deposit']."','Bank Deposit','".date("Y-m-d")."')");

	

		reset ($payments);

	while (list ($key, $val) = each ($payments)) {

		if (isset($_SESSION[$key])) $_SESSION[$key] = "";

	}

	

	header("location: premium-confirmation");

			}

}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<script type="text/javascript">

  var _gaq = _gaq || [];

  _gaq.push(['_setAccount', 'UA-23693392-1']);

  _gaq.push(['_trackPageview']);



  (function() {

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

  })();



</script>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL_S;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Premium Listing: Nigerian Seminars and Trainings</title>

<meta name="description" content="Give your business and events a boost - Upgrade to premium listing!"/>
 
    <meta name="Charset" content="UTF-8">
    <meta name="Distribution" content="Global">
    <meta name="Rating" content="General">
    <meta name="robots" content="index, follow"/>
    <meta name="Revisit-after" content="3 Days">
    <meta name="search-engines" content="all"/>



	

	<link rel="stylesheet" href="<?php echo SITE_URL_S;?>style.css" type="text/css" media="screen" />

   <?php include("scripts/headers_s.php");?>



	

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

<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>

</div>

</noscript>

<!-- End Quantcast tag -->



<?php include("tools/header2.php");?>

  <div id="main">
    <div id="content">

  <div id="content_left">

         

				

               
<h3 class="categoryHeader">Subscribe to Premium Listing</h3>
                <div id="subpage">

					

					<div id="subpage_content">

					  <p>

Give your  business and events a boost! Upgrade to a Premium Listing. Upgrading will allow  your business to benefit from the many advantages of a Premium Listing, which  are: -</p>

                      <ul class="formart">

                        <li>Your listing can display a  Google Map, which will allow your users to easily find your business</li>

                        <li>Your listing will be displayed  at the top of the homepage search results page, which provides more exposure to  users and the search engines</li>

                        <li>Your listing will be  highlighted in the search results page, making it stand out from the  competition</li>

                        <li>Your listing will be displayed  with special HTML tags (H2 headings) which will provide more exposure to Google  and the other search engines.</li>

                        <li>Your listing will display your brand image / company logo.</li>

                      </ul>

                      <br />

                      <h1 class="premium-header">Subscription Options</h1>

                      <table width="100%" class="premium">

                        <tr>

                          <th width="18.99441340782123%" align="center">Features</th>

                          <th width="17.17877094972067%" align="center">Basic Text Listing</th>

                          <th width="25" align="center">Basic  Text Listing Plus </th>

                          <th width="124" align="center">Value  Listing</th>

                          <th width="124" align="center">Premium  Listing </th>

                        </tr>

                        <tr>

                          <td>Text Listing</td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>Link to website</td>

                          <td align="center"><img src="images/cancel.png" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>Google map </td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>Image / Logo</td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>No of Listed Premium Events</td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center">1</td>

                          <td align="center">2</td>

                        </tr>

                        <tr>

                          <td>Self Edit</td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>Quartely Guide listings</td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>Events listed on subscribers news letters</td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/cancel.png" alt="" width="15" height="15" /></td>

                          <td align="center"><img src="images/Check-icon.png" alt="Check" width="15" height="15" /></td>

                        </tr>

                        <tr>

                          <td>Pricing</td>

                          <td align="center">FREE - <a href="<?php echo SITE_URL;?>biz_info"><font color="#00CC00">Add Now</font></a></td>

                          <td align="center">NGN 16,637 / YR</td>

                          <td align="center">NGN 33,285 / YR</td>

                          <td align="center">NGN 50,000 / YR</td>

                        </tr>

                        <tr>

                          <td>Additional Event</td>

                          <td align="center">-</td>

                          <td align="center">-</td>

                          <td align="center">NGN 5000</td>

                          <td align="center">NGN 5000</td>

                        </tr>

                        <tr>

                          <td colspan="5" style="color:#900"><strong>N.B:</strong> Additional event subscription is for existing members that has aready subscribed to any of the payment plan.</td>

                        </tr>

                      </table>

                     <div id="inline" style="background:white;">

<h1 class="premium-header noM">Premium Payment Options</h1>

<?php echo $message;?>
<div class="oldBankdetail">
<table width="100%" class="premium2">

  <tr>

    <th width="50%" align="center">Pay through Paypal</th>

    <th width="50%" align="center">Pay by Bank Deposit</th>

  </tr>

  <tr>

    <td valign="top">
    <form action="https://www.paypal.com/cgi-bin/webscr" 

method="post" target="_top">
<input type="hidden" name="cmd" 

value="_s-xclick">
<input type="hidden" name="hosted_button_id" 

value="CQT45JMYX9UM2">
<table>
<tr><td><input type="hidden" 

name="on0" value="Subscription Plans">Subscription 

Plans</td></tr><tr><td><select name="os0">
	<option 

value="Basic Text Listing Plus">Basic Text Listing Plus : 

$101.04 USD - yearly</option>
	<option value="Value 

Listing">Value Listing : $202.14 USD - yearly</option>
	<option 

value="Premium Listing">Premium Listing : $303.65 USD - 

yearly</option>
</select> </td></tr>
<tr><td><input type="hidden" 

name="on1" value="Business Type">Business 

Type</td></tr><tr><td><select name="os1">
	<option 

value="Training">Training Providers </option>
	<option 

value="Equipment">Equipment Suppliers </option>
	

<option value="Managers">Event Managers </option>
	<option 

value="Venue">Venue Providers </option>
</select> 

</td></tr>
<tr><td><input type="hidden" name="on2" 

value="Business Name">Business Name</td></tr><tr><td><input 

type="text" name="os2" maxlength="200" value="<?php if(isset($_SESSION['user_id'])){ echo $rows['business_name'];}?>"></td></tr>
</table>
<input 

type="hidden" name="currency_code" value="USD">
<input 

type="image" 

src="http://www.nigerianseminarsandtrainings.com/images/subscribe-btn.png" border="0" name="submit" alt="PayPal – The safer, 

easier way to pay online.">
<img alt="" border="0" 

src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" 

width="1" height="1">
</form>







</td>

    <td rowspan="3" valign="top"><form id="form1" name="form1" method="post" action="">

      <table width="100%">

        <tr>

          <td colspan="2"><strong>Bank Account Information</strong></td>

          </tr>

        <tr>

          <td>Account Name:</td>

          <td>KAISTE VENTURES</td>

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

          <td width="42%">Business name:</td>

          <td width="58%">
<input type="text" name="business_name" class="Textinput"  id="business_name" placeholder="Training Providers(optional)" value="<?php if(isset($_SESSION['user_id'])){ echo $rows['business_name'];} else {echo $_SESSION['email'];} ?>" onfocus="if(this.placeholder == 'Training Providers(optional)'){this.placeholder = ''}" onblur="if(this.placeholder == ''){this.placeholder = 'Training Providers(optional)'}" />

<div id="outputPremium"><center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center></div>

          </td>

          </tr>

        <tr>

          <td>Contact  person Phone:</td>

          <td><label>

            <input type="text" name="contact_person" id="contact_person" value="<?php if(isset($_SESSION['user_id'])){ echo $rows['contact_person'];}else{ echo $_SESSION['contact_person']?>" <?php ;} ?>" />

            </label></td>

          </tr>

        <tr>

          <td>Email:</td>

          <td><label>

            <input type="text" name="email" value="<?php if(isset($_SESSION['user_id'])){ echo $rows['email'];}else{ echo $_SESSION['email']?>" <?php ;} ?>" id="email" />

            </label></td>

          </tr>

        <tr>

          <td>Business Type</td>

          <td><select name="business_type" id="business_type">

            <option value="<?php echo $_SESSION['business_type'];?>" selected="selected"><?php echo $_SESSION['business_type'];?></option>
             
            <option value="Training">Training Provider </option>

            <option value="Equipment">Event Equipment Suppliers </option>

            <option value="Managers">Event Managers </option>

            <option value="Venue">Venue Providers</option>

  </select></td>

          </tr>

        <tr>

          <td>Plan</td>

          <td><select name="plan" id="plan">

            <option value="<?php echo $_SESSION['plan'];?>" selected="selected"><?php echo $_SESSION['plan'];?></option>

            <option value="Basic Text Listing Plus">Basic Text Listing Plus</option>

            <option value="Value Listing">Value Listing </option>

            <option value="Premium Listing">Premium Listing </option>

       

            </select></td>

          </tr>

        <tr>

          <td>Teller  No:</td>

          <td><label>

            <input type="text" name="teller_no" id="teller_no" value="<?php echo $_SESSION['teller_no'];?>" />

            </label></td>

          </tr>

        <tr>

          <td>Amount  deposited:</td>

          <td><label>

            <input type="text" name="amount_deposited" id="amount_deposited" value="<?php echo $_SESSION['amount_deposited'];?>"  />

            </label></td>

          </tr>

        <tr>

          <td>Date  of deposit:</td>

          <td><label>

            <input type="text" name="date_deposit" id="date_deposit"  value="<?php echo $_SESSION['date_deposit'];?>"  />

            </label></td>

          </tr>

        <tr>

          <td>&nbsp;</td>

          <td>

            <label>

              <input name="submit_payment" type="submit" class="button_bg" id="submit_payment" value="Subscribe" />

              </label>

            </td>

          </tr>

      </table> </form>

    </td>

  </tr>

</table>
</div>

<div class="newBankdetail">
<table width="100%" class="premium2">

  <tr>

    <th colspan="2" align="center">Pay by Bank Deposit</th>

    </tr>

  <tr>

    <td width="50%" valign="top">
      
      
      <table width="100%">

        <tr>

          <td colspan="2"><strong>Bank Account Information</strong></td>

          </tr>

        <tr>

          <td>Account Name:</td>

          <td>KAISTE VENTURES</td>

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

          <td width="42%">Business name:</td>

          <td width="58%"><label>

            <input type="text" name="business_name" id="business_name" value="<?php echo $_SESSION['business_name'];?>" />

            </label></td>

          </tr>

        <tr>

          <td>Contact  person Phone:</td>

          <td><label>

            <input type="text" name="contact_person" id="contact_person" value="<?php echo $_SESSION['contact_person'];?>" />

            </label></td>

          </tr>

        <tr>

          <td>Email:</td>

          <td><label>

            <input type="text" name="email" value="<?php echo $_SESSION['email'];?>" id="email" />

            </label></td>

          </tr>

        <tr>

          <td>Business Type</td>

          <td><select name="business_type" id="business_type">

            <option value="<?php echo $_SESSION['business_type'];?>" selected="selected"><?php echo $_SESSION['business_type'];?></option>

            <option value="Training">Training Provider </option>

            <option value="Equipment">Event Equipment Suppliers </option>

            <option value="Managers">Event Managers </option>

            <option value="Venue">Venue Providers</option>

  </select></td>

          </tr>

        <tr>

          <td>Plan</td>

          <td><select name="plan" id="plan">

            <option value="<?php echo $_SESSION['plan'];?>" selected="selected"><?php echo $_SESSION['plan'];?></option>

            <option value="Basic Text Listing Plus">Basic Text Listing Plus</option>

            <option value="Value Listing">Value Listing </option>

            <option value="Premium Listing">Premium Listing </option>

       

            </select></td>

          </tr>

        <tr>

          <td>Teller  No:</td>

          <td><label>

            <input type="text" name="teller_no" id="teller_no" value="<?php echo $_SESSION['teller_no'];?>" />

            </label></td>

          </tr>

        <tr>

          <td>Amount  deposited:</td>

          <td><label>

            <input type="text" name="amount_deposited" id="amount_deposited" value="<?php echo $_SESSION['amount_deposited'];?>"  />

            </label></td>

          </tr>

        <tr>

          <td>Date  of deposit:</td>

          <td><label>

            <input type="text" name="date_deposit" id="date_deposit"  value="<?php echo $_SESSION['date_deposit'];?>"  />

            </label></td>

          </tr>

        <tr>

          <td>&nbsp;</td>

          <td>

            <label>

              <input name="submit_payment" type="submit" class="button_bg" id="submit_payment" value="Subscribe" />

              </label>

            </td>

          </tr>

      </table>
      
      
      
      
</td>


    </tr>
<tr>
<th align="center">Pay through Paypal</th>
</tr>
<tr>
  <td><form action="https://www.paypal.com/cgi-bin/webscr" 

method="post" target="_top">
<input type="hidden" name="cmd" 

value="_s-xclick">
<input type="hidden" name="hosted_button_id" 

value="CQT45JMYX9UM2">
<table width="100%">
<tr><td><input type="hidden" 

name="on0" value="Subscription Plans">Subscription 

Plans</td></tr><tr><td><select name="os0">
	<option 

value="Basic Text Listing Plus">Basic Text Listing Plus : 

$101.04 USD - yearly</option>
	<option value="Value 

Listing">Value Listing : $202.14 USD - yearly</option>
	<option 

value="Premium Listing">Premium Listing : $303.65 USD - 

yearly</option>
</select> </td></tr>
<tr><td><input type="hidden" 

name="on1" value="Business Type">Business 

Type</td></tr><tr><td><select name="os1">
	<option 

value="Training">Training Providers </option>
	<option 

value="Equipment">Equipment Suppliers </option>
	

<option value="Managers">Event Managers </option>
	<option 

value="Venue">Venue Providers </option>
</select> 

</td></tr>
<tr><td><input type="hidden" name="on2" 

value="Business Name">Business Name</td></tr><tr><td><input 

type="text" name="os2" maxlength="200"></td></tr>
</table>
<input 

type="hidden" name="currency_code" value="USD">
<input 

type="image" 

src="http://www.nigerianseminarsandtrainings.com/images/subscribe-btn.png" border="0" name="submit" alt="PayPal – The safer, 

easier way to pay online.">
<img alt="" border="0" 

src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" 

width="1" height="1">
</form></td>
</tr>
</table>
</div>

</div>

</p>

                </div>

                

			

					<div id="latest_content_items">

					

						<!-- Section 1 Featured -->

						<!-- End Featured 1 -->

				

					</div><!-- end latest_content_items -->

				</div>

            <div class="sub_links2_middle"><div class="sub_links2_middle">

<div id="sub_links2_middle">
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

</div>

<div class="clearfix"></div>


<div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>
 
       <div class="categoryDisplay"><?php //include("tools/categories.php");?></div>
 
</div>
</div>

<div class="divider"></div>

               <?php //echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
               
                
<div class="clearfix"></div>



</div>

			

		<?php include("tools/side-menu.php");?>


	</div>

	

    <div class="clearfix"></div>

</div>



    </div>

</div>

</div>
	<?php include ("tools/footer.php");?>
</body>

</html>