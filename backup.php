<?php 
function getTransactionDetails($pid, $tnr, $amt, $hash){
	$url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=".$pid."&transactionreference=".$tnr."&amount=".$amt."";
	$opts = array(
            'http'=>array(
                'method'=>"GET",
                'header' => "UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)\r\n" .
                        "Hash:$hash\r\n",
                'protocol_version' => 1.1

            ),
            "ssl"=>array(
                "allow_self_signed"=>true,
                "verify_peer"=>false,
            )
          );
        $context = stream_context_create($opts);
        $fetchedData = file_get_contents($url, false, $context);
	return json_decode($fetchedData);
}

$product_id = base64_decode($_REQUEST['pid']);
$txnref = $_POST['txnref'];
$amount = base64_decode($_REQUEST['amt']);
$mackey = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";

$unsave_hash = $product_id.$txnref.$mackey;
$save_hash = hash("sha512", $unsave_hash, false);

$transacObj = getTransactionDetails($product_id, $txnref, $amount, $save_hash);

?>
<div>
    <div style="background: yellow">
        Original Transaction Ref: <?php echo $_REQUEST['txnref']; ?> <br/>
        Payment Ref: <?php echo $_REQUEST['payRef']; ?> <br/>
        Ret. Ref: <?php echo $_REQUEST['retRef']; ?> <br/>
        Card Number: <?php echo $_REQUEST['cardNum']; ?> <br/>
        Apr Amount: <?php echo $_REQUEST['apprAmt']; ?> <br/>
    </div>
	<br/><br/>
	Amount: <?php echo $transacObj->Amount; ?> <br/>
	Card Number: <?php echo $transacObj->CardNumber; ?> <br/>
	Merchant Reference: <?php echo $transacObj->MerchantReferenec; ?> <br/>
	Payment Reference: <?php echo $transacObj->PaymentReference; ?> <br/>
	Retrieval Reference Number: <?php echo $transacObj->RetrievalReferenceNumber; ?> <br/>
	LeadBank Cbn Code: <?php echo $transacObj->LeadbankCbnCode; ?> <br/>
	LeadBank Name: <?php echo $transacObj->LeadBankName; ?> <br/>
	Transaction Date: <?php echo $transacObj->TransactionDate; ?><br/>
	Response Code: <?php echo $transacObj->ResponseCode; ?> <br/>
	Response Description: <?php echo $transacObj->ResponseDescription; ?> <br/>
</div>


<?php 
function getTransactionDetails($pid, $tnr, $amt, $hash){
	$url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=".$pid."&transactionreference=".$tnr."&amount=".$amt."";
	$opts = array(
            'http'=>array(
                'method'=>"GET",
                'header' => "UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)\r\n" .
                        "Hash:$hash\r\n",
                'protocol_version' => 1.1

            ),
            "ssl"=>array(
                "allow_self_signed"=>true,
                "verify_peer"=>false,
            )
          );
        $context = stream_context_create($opts);
        $fetchedData = file_get_contents($url, false, $context);
	return json_decode($fetchedData);
}

$product_id = base64_decode($_REQUEST['pid']);
$txnref = $_POST['txnref'];
$amount = base64_decode($_REQUEST['amt']);
$mackey = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";

$unsave_hash = $product_id.$txnref.$mackey;
$save_hash = hash("sha512", $unsave_hash, false);

//$transacObj = getTransactionDetails($product_id, $txnref, $amount, $save_hash);

// set HTTP header
$headers = array(
                'method'=>"GET",
                'header' => "UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)\r\n" .
                        "Hash:$save_hash\r\n",
                'protocol_version' => 1.1
          );
$url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=".$product_id."&transactionreference=".$txnref."&amount=".$amount."";

// Open connection
$ch = curl_init();

// Set the url, number of GET vars, GET data
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HTTP_VERSION, 1.1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Execute request
$result = curl_exec($ch);

// Close connection
curl_close($ch);

// get the result and parse to JSON
$transacObj = json_decode($result, true);

print_r($transacObj);

?>
<div>
    <div style="background: yellow">
        Original Transaction Ref: <?php echo $_REQUEST['txnref']; ?> <br/>
        Payment Ref: <?php echo $_REQUEST['payRef']; ?> <br/>
        Ret. Ref: <?php echo $_REQUEST['retRef']; ?> <br/>
        Card Number: <?php echo $_REQUEST['cardNum']; ?> <br/>
        Apr Amount: <?php echo $_REQUEST['apprAmt']; ?> <br/>
    </div>
	<br/><br/>
	Amount: <?php echo $transacObj['Amount']; ?> <br/>
	Card Number: <?php echo $transacObj['CardNumber']; ?> <br/>
	Merchant Reference: <?php echo $transacObj['MerchantReference']; ?> <br/>
	Payment Reference: <?php echo $transacObj['PaymentReference']; ?> <br/>
	Retrieval Reference Number: <?php echo $transacObj['RetrievalReferenceNumber']; ?> <br/>
	LeadBank Cbn Code: <?php echo $transacObj['LeadbankCbnCode']; ?> <br/>
	LeadBank Name: <?php echo $transacObj['LeadBankName']; ?> <br/>
	Transaction Date: <?php echo $transacObj['TransactionDate']; ?><br/>
	Response Code: <?php echo $transacObj['ResponseCode']; ?> <br/>
	Response Description: <?php echo $transacObj['ResponseDescription']; ?> <br/>
</div>