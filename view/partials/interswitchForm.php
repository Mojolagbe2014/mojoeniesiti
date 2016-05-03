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
</form>
<button type="submit" class="cssButton_roundedLow cssButton_medGreen" id="payNowButton" name="payNowButton" style="font-size:14px; font-weight: normal; height:40px; color:#FFF; background-color:#0B4570; text-align:center; padding-top: 6px;
    width: 172px; margin-left:-1px">
    <i class="fa fa-credit-card" style="font-size:16px;     margin-left: -60px; margin-right: 6px;"></i>Buy Course
</button>