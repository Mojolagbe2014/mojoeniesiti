<div id="contact-wrapper2" style="float:left;" > 
    
    <form id="formProvider" name="form1" method="post" class="smart-forms form_content" >
    
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;">Contact Training Provider</strong>
                   
                    </div>
                    <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgbox">
                            
                                                              
                        </div>
<table class="contact_provider_table">
<tr>
 
<td style="width:85%;">
   <label class="field">
                                    <input type="text" name="subject" id="subject" class="gui-input" placeholder="Subject"  >
                                </label>
</td></tr>
<tr>
 
<td>  <label class="field prepend-icon">
                                    <input type="text" name="name" id="name" class="gui-input" placeholder="Name" >
                                    <span class="field-icon"><i class="fa fa-user"></i></span>  
                                </label></td></tr>
<tr>

<td><label class="field prepend-icon">
                                    <input type="email" name="email" id="email" class="gui-input" placeholder="Email" >
                                    <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                                </label>
</td></tr>
<tr>

  <td>  <label class="field prepend-icon">
                                    <input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone"  >
                                    <span class="field-icon"><i class="fa fa-phone-square"></i></span>  
                                </label></td>
</tr>
<tr>

  <td>  <label class="field">
                                    <input type="text" name="address" id="address" class="gui-input" placeholder="Address">
                                    
                                </label></td>
</tr>
<tr>

  <td> <label class="field prepend-icon">
                        	<textarea class="gui-textarea" id="comment" name="comment" placeholder="message"  ></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                            <span class="input-hint"> 
                            	<strong>Hint: </strong>Enter your enquiry / booking in this box. The training provider will contact you.</span>   
                        </label>
               </td>
</tr>
<tr>

  <td> <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
                            </label>
                            <span class="button captcode">
                            	<img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </span>
                        </div>
               </td>
</tr>
<tr>
  <td  style="text-align:center;" >
    <button class="button btn-primary" type="button" onClick="SubmitForm()"> Send </button>
    <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',$rows['email']);?>" id="to" />
    </td>
  </tr>
</table> 
</form>

</div>