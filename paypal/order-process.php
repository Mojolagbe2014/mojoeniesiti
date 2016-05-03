<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());

$errorArr = array(); //Array of errors
$itemAmount = filter_input(INPUT_POST, 'amount') ? filter_input(INPUT_POST, 'amount') : 0;
$itemName = filter_input(INPUT_POST, 'item_name') ? filter_input(INPUT_POST, 'item_name') : '';
$itemId = filter_input(INPUT_POST, 'item_id') ? filter_input(INPUT_POST, 'item_id') : 0;
$itemBuzName = filter_input(INPUT_POST, 'item_biz_name') ? filter_input(INPUT_POST, 'item_biz_name') : '';
$itemBuzPhone = filter_input(INPUT_POST, 'item_biz_phone') ? filter_input(INPUT_POST, 'item_biz_phone') : '';
$itemBuzType = filter_input(INPUT_POST, 'item_biz_type') ? filter_input(INPUT_POST, 'item_biz_type') : '';

    //set session for item attributes
    $_SESSION['phoneuse'] = $itemBuzPhone;
    $_SESSION['buz_name'] = $itemBuzName;
    $_SESSION['buz_type'] = $itemBuzType;
    $_SESSION['buz_plan'] = $itemName;

include_once __DIR__ . "/vendor/autoload.php"; //include PayPal SDK
include_once __DIR__ . "/functions.inc.php"; //our PayPal functions

//PAYPAL CONSTATNTS
define('CLIENT_ID', 'AYEjH6qRWYTNkAiACAHty_AWWC_7IwnRPhMaJYrC6Q-nsnj5Mrl5hQJ-LKKEI4rydH8hzHYU-Fkwd5BG'); //your PayPal client ID
define('CLIENT_SECRET', 'EM4Qy0UgLbzqoYFFWp6kXqEhryWDjNp95fA09NEsiZoYffsd9FrmDfVYRq0I20roq8GLBYWynReuwclF'); //PayPal Secret
define('RETURN_URL', 'http://localhost/nigerianseminars/paypal/order-process.php'); //order_process.php//return URL where PayPal redirects user
define('CANCEL_URL', 'http://localhost/nigerianseminars/payment-cancel'); //cancel URL
define('PP_CURRENCY', 'USD'); //Currency code
define('PP_CONFIG_PATH', 'C://wamp/www/nigerianseminars/paypal/'); //PayPal config path (sdk_config.ini)

$courseQty = filter_input(INPUT_POST, 'quantity') ? filter_input(INPUT_POST, 'quantity') : 1; 

// Prepare for Payment 
if(!empty($itemAmount) && !empty($itemName) && !empty($itemId)){//isset($_POST['course'])
    //set array of items you are selling, single or multiple
    $items = array( array('name'=> $itemName, 'quantity'=> $courseQty, 'price'=> $itemAmount, 'sku'=> $itemId, 'currency'=>PP_CURRENCY));
    $totalAmount = ($courseQty * $itemAmount);//calculate total amount of all quantity. 
    $_SESSION['currPaypalCourse'] = $itemId;
    $_SESSION['currPaypalCourseName'] = $itemName;

    try{ // try a payment request //if payment method is paypal
        $result = create_paypal_payment($totalAmount, PP_CURRENCY, '', $items, RETURN_URL, CANCEL_URL);
        //if payment method was PayPal, we need to redirect user to PayPal approval URL
        if($result->state == "created" && $result->payer->payment_method == "paypal"){
            $_SESSION["payment_id"] = $result->id; //set payment id for later use, we need this to execute payment
            header("location: ". $result->links[1]->href); //after success redirect user to approval URL 
            exit();
        }

    }
    catch(PPConnectionException $ex) { echo parseApiError($ex->getData()); } catch (Exception $ex) { echo $ex->getMessage(); }
}

// After PayPal payment method confirmation, user is redirected back to this page with token and Payer ID 
if(isset($_GET["token"]) && isset($_GET["PayerID"]) && isset($_SESSION["payment_id"])){
    try{
        $result = execute_payment($_SESSION["payment_id"], $_GET["PayerID"]);  //call execute payment function.

        if($result->state == "approved"){ //if state = approved continue..
            //SUCESS
            unset($_SESSION["payment_id"]); //unset payment_id, it is no longer needed 
            //get transaction details
            $transaction_id 		= $result->transactions[0]->related_resources[0]->sale->id;
            $transaction_time 		= $result->transactions[0]->related_resources[0]->sale->create_time;
            $transaction_currency 	= $result->transactions[0]->related_resources[0]->sale->amount->currency;
            $transaction_amount 	= $result->transactions[0]->related_resources[0]->sale->amount->total;
            $transaction_method 	= $result->payer->payment_method;
            $transaction_state 		= $result->transactions[0]->related_resources[0]->sale->state;

            //get payer details
            $payer_first_name 		= $result->payer->payer_info->first_name;
            $payer_last_name 		= $result->payer->payer_info->last_name;
            $payer_email 			= $result->payer->payer_info->email;
            $payer_id				= $result->payer->payer_info->payer_id;

            $payer_fullname         = $payer_first_name.' '.$payer_last_name;

            //get shipping details 
            $shipping_recipient		= $result->transactions[0]->item_list->shipping_address->recipient_name;
            $shipping_line1			= $result->transactions[0]->item_list->shipping_address->line1;
            $shipping_line2			= $result->transactions[0]->item_list->shipping_address->line2;
            $shipping_city			= $result->transactions[0]->item_list->shipping_address->city;

            $shipping_state			= $result->transactions[0]->item_list->shipping_address->state;
            $shipping_postal_code	= $result->transactions[0]->item_list->shipping_address->postal_code;
            $shipping_country_code	= $result->transactions[0]->item_list->shipping_address->country_code;

            if (isset($_SESSION['phone']) && isset($_SESSION['buz_name']) && isset($_SESSION['buz_type']) && isset($_SESSION['buz_plan'])) {
                MysqlQuery("insert into payment (business_name,contact_person,email,business_type, plan,amount_deposited,payment_type,payment_date) 
                values('".$_SESSION['buz_name']."','".$_SESSION['phone']."','".$payer_email."','".$_SESSION['buz_type']."','".$_SESSION['buz_plan']."','".$transaction_amount."',''Paypal Deposit','".date("Y-m-d")."')");
            }
            
            
            //Set session for later use, print_r($result); to see what is returned
            $_SESSION["results"]  = array(
                            'transaction_id' => $transaction_id, 
                            'transaction_time' => $transaction_time,
                            'transaction_currency' => $transaction_currency,
                            'transaction_amount' => $transaction_amount,
                            'transaction_method' => $transaction_method,
                            'transaction_state' => $transaction_state
                            );

                header("location: ". RETURN_URL); //$_SESSION["results"] is set, redirect back to order_process.php
                exit();
        }

    }
    catch(PPConnectionException $ex) { $ex->getData(); } catch (Exception $ex) { echo $ex->getMessage(); }
}
$redirectBack = SITE_URL;
// Display order confirmation if $_SESSION["results"] is set  
if(isset($_SESSION["results"])) {
$content = <<<EOD
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Purchase Response</title>
<style type="text/css">
.transaction_info {margin:0px auto; background:#F2FCFF;; max-width: 750px; color:#555;font-size: 13px;font-family: Arial, sans-serif;}
.transaction_info thead {background: #BCE4FA;font-weight: bold;}
.transaction_info thead tr th {border-bottom: 1px solid #ddd;}
</style>
</head>
<body>
<div align="center"><h2>Payment Success</h2></div>
<table border="0" cellpadding="10" cellspacing="0" class="transaction_info">
<thead><tr>
<td>Transaction ID</td>
<td>Date</td><td>Currency</td>
<td>Amount</td><td>Method</td>
<td>State</td></tr></thead>
<tbody>
<tr>
<td>{$_SESSION["results"]["transaction_id"]}</td>
<td>{$_SESSION["results"]["transaction_time"]}</td>
<td>{$_SESSION["results"]["transaction_currency"]}</td>
<td>{$_SESSION["results"]["transaction_amount"]}</td>
<td>{$_SESSION["results"]["transaction_method"]}</td>
<td>{$_SESSION["results"]["transaction_state"]}</td></tr><tr>
<td colspan="6">
<div align="center">
<a href="{$redirectBack}?id={$_SESSION["currPaypalCourse"]}">Proceed to Main Website</a></div></td></tr></tbody></table>
</body></html>	
</body>
</html>
EOD;
print $content;
}

unset($_SESSION["results"]); unset($_SESSION["currPaypalCourse"]);unset($_SESSION["currPaypalCourseName"]);
