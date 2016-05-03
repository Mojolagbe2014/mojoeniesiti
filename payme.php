<?php
print_r($_POST);
 //payment 
  $product_id = 6205;
  $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
  $cus_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
  $customer_name = filter_input(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
  $pro_email = "info@kaisteventures.com";
  $cust_id = "898837";
  $currency = 566;
  $txn_ref = "NST".rand(10000, 10000000);

  $pay_item_id = 101;
  $pay_item_name = "Advanced Management and Administrative Course for Secretaries and Personal Assistant";

  $company_name =  "Kaiste Ventures Limited";
  $redirect_to  = "https://www.nigerianseminarsandtrainings.com/payment?pid=".base64_encode($product_id)."&amt=".  base64_encode($amount)."&cus_email=". base64_encode($cus_email) ."&pro_email=". base64_encode($pro_email) ."";
  $site_name = "www.kaisteventures.com";

  $mackey = "27ED7ACA287A0364501B13841B70F72430E9DEA4F55C9278C1E28006EA236BF28B7C11A7F1CCCACA7EC72AB0B692B23A090A54729D75923118B8799A4F100EF1";

  $unsave_hash = $txn_ref.$product_id.$pay_item_id.$amount.$redirect_to.$mackey;
  $save_hash = hash("sha512", $unsave_hash, false);
  //end payment

?>
<form name="form1" id="form1" action="https://stageserv.interswitchng.com/test_paydirect/pay" method="post">     
    <input name="product_id" type="hidden" value="<?php echo $product_id;?>" />     
    <input name="amount" type="hidden" value="<?php echo $amount;?>" />     
    <input name="currency" type="hidden" value="<?php echo $currency;?>" />     
    <input name="site_redirect_url" type="hidden" value="<?php echo $redirect_to;?>" /> 
    <input name="txn_ref" type="hidden" value="<?php echo $txn_ref;?>" />     
    <input name="site_name" type="hidden" value="<?php echo $site_name;?>" />     
    <input name="cust_id" type="hidden" value="<?php echo $cust_id;?>" />     
    <input name="cust_name" type="hidden" value="<?php echo $customer_name;?>" />     
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
    <button type="submit">Pay</button>
</form>