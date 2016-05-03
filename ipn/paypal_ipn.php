<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
//--PAYPAL SCRIPT---------------------------------------------------------------

// tell PHP to log errors to ipn_errors.log in this directory
ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/ipn_errors.log');

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
	$value = urlencode(stripslashes($value));
	$req .= "&$key=$value";
}

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.1\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Host: www.paypal.com\r\n";
$header .= "Connection: close\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

// Old HTTP 1.0 code
//$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
//$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
//$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

//$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);             // <- Use this line for real use
$fp = fsockopen ('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);   // <- Use this line when testing in SandBox

// assign posted variables to local variables
$item_name            = $_POST['item_name'];
$item_number          = $_POST['item_number'];
$quantity             = $_POST['quantity'];
$payment_amount       = $_POST['mc_gross'];
$fee                  = $_POST['mc_fee'];
$tax                  = $_POST['tax'];
$payment_currency     = $_POST['mc_currency'];
$exchange_rate        = $_POST['exchange_rate'];
$payment_status       = $_POST['payment_status'];
$payment_type         = $_POST['payment_type'];
$payment_date         = $_POST['payment_date'];
$txn_id               = $_POST['txn_id'];
$txn_type             = $_POST['txn_type']; // 'cart', 'send_money' or 'web_accept' (manual page 46)
$custom               = $_POST['custom'];   // Any custom data
$receiver_email       = $_POST['receiver_email'];
$first_name           = $_POST['first_name'];
$last_name            = $_POST['last_name'];
$payer_business_name  = $_POST['payer_business_name'];
$payer_email          = $_POST['payer_email'];
$address_street       = $_POST['address_street'];
$address_zip          = $_POST['address_zip'];
$address_city         = $_POST['address_city'];
$address_state        = $_POST['address_state'];
$address_country      = $_POST['address_country'];
$address_country_code = $_POST['address_country_code'];
$residence_country    = $_POST['residence_country'];
$business = @mysql_real_escape_string($_POST['os2']);
$plan = @mysql_real_escape_string($_POST['os0']);
$business_type = @mysql_real_escape_string($_POST['os1']);

if (!$fp) {
	// HTTP ERROR
} else {
	fputs ($fp, $header . $req);
	while (!feof($fp)) {
		$res = fgets ($fp, 1024);
		if (strcmp (trim($res), "VERIFIED") == 0) {
			$payment_verified = true;
			break;
		} else if (strcmp (trim($res), "INVALID") == 0) {
			$payment_verified = false;
			break;
		}
	}
	fclose ($fp);
}

//--FORMAT TRANSACTION DETAILS--------------------------------------------------

$transaction_details .= "--------------------------------------------------\r";
$transaction_details .= "Order Details\r";
$transaction_details .= "--------------------------------------------------\r";
$transaction_details .= " Subscription: $plan\r";
$transaction_details .= "  System: $user_system\r";
$transaction_details .= "  Amount: $payment_amount\r";
$transaction_details .= "Currency: $payment_currency\r";
$transaction_details .= "--------------------------------------------------\r";
$transaction_details .= "   Buyer: $first_name $last_name\r";
$transaction_details .= " Company: $business\r";
$transaction_details .= "  E-Mail: $payer_email\r";
$transaction_details .= "--------------------------------------------------\r";
$transaction_details .= "Trans ID: $txn_id\r";
$transaction_details .= "  Status: $payment_status\r";
$transaction_details .= "    Type: $payment_type\r";
$transaction_details .= "  Method: $txn_type\r";
$transaction_details .= "--------------------------------------------------\r";

$primary_email = 'akpo@nigerianseminarsandtrainings.com';

//--PROCESS PAYMENT-------------------------------------------------------------


$customer_address = "$first_name $last_name <$payer_email>";

if ($payment_verified) {
	// check the payment_status is Completed
	// check that txn_id has not been previously processed
	// check that receiver_email is your Primary PayPal email
	// check that payment_amount/payment_currency are correct
	// process payment
	
	if (strcmp ($payment_status, "Completed") == 0) { // Payment has been successfully completed
		
		//if (strcmp ($receiver_email, $paypal_address_raw) == 0) { // The sender e-mail is the right address
		
			if (!CheckTransactionID($txn_id)) { // Check if it is not a duplicate transaction
		
				//if (strcmp ($txn_type, "web_accept") == 0) { // This is a direct sale thru Purchase button on web site
				 // send user an email with a link to their digital download
        $to = $customer_address;
        $subject = "Transaction Acknowledgement!";
		$message = "<p>Dear ".$fname_name." ".$lname_name."</p><br/>";
		$message .="<p>Thank you for subscribing to our ".$plan."</p><br/>";
		$message .="<p>Your subscription will be active within the next 24hrs. \n\n You would also recieve an email from Us containing your access details.</p><br/>";
		
		$message .="$transaction_details";
		Email($to,$subject,$message);
		
		//paeyment notification to us
					$supplier_subject  = "PayPal purchase notification";
					
					$supplier_message  = "PayPal purchase notification\r";
					
					$supplier_message .= "$transaction_details\r\r";
					
					Email('franko172000@gmail.com',$supplier_subject,$supplier_message);
				
		 $sql = "INSERT INTO payment (transaction_id,business_name,contact_person,email,business_type,plan,teller_no,amount_deposited,payment_type,payment_date) VALUES 
                ('$txn_id','$business', '$fname_name "."$lname_name', '$payer_email', '$business_type','$plan','NULL','$payment_currency"."$fee','Paypal','".date("Y-m-d")."')";
        
        if (!mysql_query($sql)) {
            error_log(mysql_error());
            exit(0);
        	}
		}
	}
}
else if (!$payment_verified) { // log for manual investigation

	$subject = "PayPal error";
	$message = "Error in processing.\r\r";
	$message .= $transaction_details;

	Email($primary_email,$subject,$message);
	
}



/*-------FUNCTIONS----*/
// Check if a transaction ID already exists
function CheckTransactionID($trans_id) {
 $txn_id = mysql_real_escape_string($trans_id);
    $sql = "SELECT COUNT(*) FROM payment WHERE transaction_id = '$txn_id'";
    $r = mysql_query($sql);
    
    if (!$r) {
        error_log(mysql_error());
        exit(0);
    }
    
    $exists = mysql_result($r, 0);
    mysql_free_result($r);
    
    if ($exists) {
       // $errmsg .= "'transaction_id' has already been processed or already exist: ".$trans_id."\n";
        return true;
    }
}
