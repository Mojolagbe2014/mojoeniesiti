<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
/*
ipn.php - example code used for the tutorial:

PayPal IPN with PHP
How To Implement an Instant Payment Notification listener script in PHP
http://www.micahcarrick.com/paypal-ipn-with-php.html

(c) 2011 - Micah Carrick
*/

// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// intantiate the IPN listener
include('ipnlistener.php');
$listener = new IpnListener();


// tell the IPN listener to use the PayPal test sandbox
$listener->use_sandbox = true;

// try to process the IPN POST
try {
    $listener->requirePostMethod();
    $verified = $listener->processIpn();
} catch (Exception $e) {
    error_log($e->getMessage());
    exit(0);
}
$primary_email = 'akpo@nigerianseminarsandtrainings.com';
if ($verified) {

    $errmsg = '';   // stores errors from fraud checks
    
    // 1. Make sure the payment status is "Completed" 
    if ($_POST['payment_status'] != 'Completed') { 
        // simply ignore any IPN that is not completed
        exit(0); 
    }

    // 2. Make sure seller email matches your primary account email.
    /*if ($_POST['receiver_email'] != $primary_email) {
        $errmsg .= "'receiver_email' does not match: ";
        $errmsg .= $_POST['receiver_email']."\n";
    }*/
    
    // 3. Make sure the amount(s) paid match
	/*switch($_POST['mc_fee']){
		case '101.04'://Basic Text Listing Plus
		
		$errmsg .= "'mc_fee' does not match: ";
        $errmsg .= $_POST['mc_fee']."\n";
	
		 break;
		 case '202.14'://Value Listing
		 if ($_POST['mc_fee'] != '202.14'){
		
		 }
		 break;
		  case '303.65'://Premium Listing
		
		 break;
	}
	if ($_POST['mc_fee'] != '303.65'){//premium listing*
		$errmsg .= "'mc_fee' does not match: ";
        $errmsg .= $_POST['mc_fee']."\n";
		 }
		 else if($_POST['mc_fee'] != '202.14'){//Value Listing
		$errmsg .= "'mc_fee' does not match: ";
        $errmsg .= $_POST['mc_fee']."\n";
		 }
		 else if($_POST['mc_fee'] != '101.04'){//Basic Text Listing Plus
		$errmsg .= "'mc_fee' does not match: ";
        $errmsg .= $_POST['mc_fee']."\n";
		 }*/
    
    // 4. Make sure the currency code matches
    if ($_POST['mc_currency'] != 'USD') {
        $errmsg .= "'mc_currency' does not match: ";
        $errmsg .= $_POST['mc_currency']."\n";
    }

     //5. Ensure the transaction is not a duplicate.
   if(connection());

    $txn_id = mysql_real_escape_string($_POST['txn_id']);
    $sql = "SELECT COUNT(*) FROM payment WHERE transaction_id = '$txn_id'";
    $r = mysql_query($sql);
    
    if (!$r) {
        error_log(mysql_error());
        exit(0);
    }
    
    $exists = mysql_result($r, 0);
    mysql_free_result($r);
    
    if ($exists) {
        $errmsg .= "'transaction_id' has already been processed: ".$_POST['txn_id']."\n";
    }
    
    if (!empty($errmsg)) {
    
        // manually investigate errors from the fraud checking
        $body = "IPN failed fraud checks: \n$errmsg\n\n";
        $body .= $listener->getTextReport();
        mail($primary_email, 'IPN Fraud Warning', $body);
        
    } else {
    
        // add this order to a table of completed orders
        $payer_email = mysql_real_escape_string($_POST['payer_email']);
        $mc_gross = mysql_real_escape_string($_POST['mc_fee']);
		$business = mysql_real_escape_string($_POST['os2']);
		$fname = mysql_real_escape_string($_POST['first_name']);
		$lname = mysql_real_escape_string($_POST['last_name']);
		$business_type = mysql_real_escape_string($_POST['os1']);
		$plan = mysql_real_escape_string($_POST['os0']);
		$amount = mysql_real_escape_string($_POST['mc_fee']);
		
        $sql = "INSERT INTO payment (transaction_id,business_name,contact_person,email,business_type,plan,teller_no,amount_deposited,payment_type,payment_date) VALUES 
                ('$txn_id','$business', '$fname "."$lname', '$payer_email', '$business_type','$plan','NULL','USD"."$amount','Paypal','".date("Y-m-d")."')";
        
        if (!mysql_query($sql)) {
            error_log(mysql_error());
            exit(0);
        }
        
        // send user an email with a link to their digital download
        $to = filter_var($payer_email, FILTER_SANITIZE_EMAIL);
		$headers = "From: Nigerian Seminars and Training <payments@nigerianseminarsandtrainings.com> \r\n";
		$headers .= "Reply-To: ".$payer_email." \r\n";
		$headers .= "MIME-Version: 1.0\r\n";
        $subject = "Transaction Acknowledgement!";
		$message = "<p>Dear ".$fname." ".$lname."</p><br/>";
		$message .="<p>Thank you for subscribing to our ".$plan."</p><br/>";
		$message .="<p>Your subscription will be active within the next 24hrs. \n\n You would also recieve an email from Us containing your access details.</p><br/>";
		Email($to,$subject,$message);
		
		
		
       // mail($to, $subject, $message, $headers);
    }
    
} else {
    // manually investigate the invalid IPN
    mail($primary_email, 'Invalid IPN', $listener->getTextReport());
}

?>