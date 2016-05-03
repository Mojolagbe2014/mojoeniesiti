 <?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$advert = "Error Page"; $timeStamp = " [".time()."] "; 
$title = "Payment Response Page - Nigerian Seminars and Trainings";
$description = "payment";
$product_id = base64_decode($_REQUEST['pid']);
$phone = base64_decode($_REQUEST['phone']);
$plan = base64_decode($_REQUEST['plan']);
$business_name = base64_decode($_REQUEST['business_name']);
$business_type = base64_decode($_REQUEST['business_type']);
$cust_name = base64_decode($_REQUEST['cust_name']);
$cust_email = base64_decode($_REQUEST['cust_email']);
$pro_email = base64_decode($_REQUEST['pro_email']);
$pro_name = base64_decode($_REQUEST['pro_name']);
$item_name = base64_decode($_REQUEST['item_name']);
$txnref = $_POST['txnref'];
$amount = base64_decode($_REQUEST['amt']);
$real_payment = ($amount / 100);
echo $real_payment;
$mackey = "27ED7ACA287A0364501B13841B70F72430E9DEA4F55C9278C1E28006EA236BF28B7C11A7F1CCCACA7EC72AB0B692B23A090A54729D75923118B8799A4F100EF1";
$unsave_hash = $product_id.$txnref.$mackey;
$save_hash = hash("sha512", $unsave_hash, false);
// set HTTP header
$headers = array(
                'method'=>"GET",
                'header' => "UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)\r\n" .
                        "Hash:$save_hash\r\n",
                'protocol_version' => 1.1
          );
$url = "https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json?productid=".$product_id."&transactionreference=".$txnref."&amount=".$amount."";
$ch = curl_init(); // Open connection
// Set the url, number of GET vars, GET data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HTTP_VERSION, 1.1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);// Execute request
curl_close($ch);// Close connection
$transacObj = json_decode($result, true);// get the result and parse to JSON
$sql = "UPDATE web_pay SET status = '{".$transacObj['ResponseDescription']."}', response_code = '{".$transacObj['ResponseCode']."}', response_description = '{".$transacObj['ResponseDescription']."}' WHERE transaction_reference = '{$txnref}' ";
$logStatus = MysqlQuery($sql);
$interswitchEmail = "info@interswitchng.com";
$emailAddress = $cust_email;
$msg = <<<EOT
<p>Dear $cust_name</p>
Your payment for <strong>$item_name</strong> of <strong>N$real_payment</strong> 
via Nigerian Seminars and Trainings portal was successful.

<p> Your payment reference number is <strong>$txnref</strong> </p>
<p> Contact <a href='mailto:$interswitchEmail'>$interswitchEmail</a> for any enquiries. </p>
Yours Failthfully.<br/>
Interswitch.
EOT;

$pro_msg = <<<EOT
<p>Dear $business_name</p>
A payment of <strong>N$real_payment</strong>  was made for <strong>$item_name</strong> On nigerian seminars and trainings portal

<p> Payment reference number is <strong>$txnref</strong> </p>
<p> Contact <a href='mailto:$interswitchEmail'>$interswitchEmail</a> for any enquiries. </p>
Yours Failthfully.<br/>
Interswitch.
EOT;
$subject = "Web Pay Transaction Response";
$message = "<strong>From:</strong> Interswitch Web Pay Direct <br/><br/> <strong>Message:</strong> $msg";
$headers = 'From: Interswitch Web Pay Direct<' . $interswitchEmail . '>' . "\r\n";
$headers .= 'Reply-To: ' . $interswitchEmail . "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.min.css">
<title> <?php echo $title; ?> </title>
<meta name="description" content="<?php echo $description; ?>"/>
<?php include("scripts/headers_new.php");?>
</head>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
<div id="subpage">
<div class="event_table_inner">
<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Transaction Response</h2></td>
</tr>
<tr>
<td align="center" style="font-size:11px">&nbsp;</td>
</tr>
</table>
</form>
</div>
<div id="subpage_content">
<div>
<br/><br/>
<?php
if ($transacObj['ResponseCode'] == "00") {
    echo '<div class="alert alert-success"><strong>'.$transacObj['ResponseDescription']
        .'<br/>Your transaction was successful. A mail has been sent to your email.<br/> Transaction Reference: '
        .$transacObj['MerchantReference'].'<br/> Payment Reference: '
        .$transacObj['PaymentReference'].'</p></strong></div>';
    mail($emailAddress, $subject, $message, $headers);
    mail($pro_email, $subject, $pro_msg, $headers);
    mail("info@nigerianseminarsandtrainings.com", $subject, $pro_msg, $headers);
    if ($amount != "" && $cust_email != "" && $business_name !="" && $business_type != "" && $plan !="") {
        MysqlQuery("insert into payment (business_name,contact_person,email,business_type, plan,amount_deposited,payment_type,payment_date) 
            values('".$business_name."','".$phone."','".$cust_email."','".$business_type."','".$plan."','".$amount."','Interswitch Deposit','".date("Y-m-d")."')");
    }
}else{
    echo '<div class="alert alert-danger"><p><strong>Your transaction was not successful<br/> Reason: '
    .$transacObj['ResponseDescription'].'<br/> Transaction Reference: '
    .$txnref.'</strong></p></div>';
}
?>
</div>
</div>
</div><!-- end subpage -->
</div>
<div id="sidebar" style="text-align: center;">
<!-- Begin Addynamo Code -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- InnerpageScyscraper -->
<ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px" data-ad-client="ca-pub-8065984041001502" data-ad-slot="9730644677"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>    
<!-- End Addynamo Code -->
</div>
</div>
<div id="content_bottom"></div>
<div class="clearfix"></div>
</div>
<?php include ("tools/footer_new.php");?>
</div>
</div>
</div>

</body>
</html>
