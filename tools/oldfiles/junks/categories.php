<div class="categoryDisplay">
  <div class="clearfix"></div>
 

 <div id="m1" class="menu">
            <ul>
                <li><a href="#" rel="0">Find events by categories</a></li>
               
            </ul>
        </div>
      <div id="t1" class="slider">
            <div class="wrapper">
                <div class="tabs">
                 <div style="overflow:scroll; width:725px; height:200px;" id="categoryTab">
          <center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>
				  </div>
        </div>
               
            </div>
        </div>
 </div>
 
 <!--<div class="searchTable" style="margin-top:10px;">
         <div class="pastSearch3" >
  <div class="sneak_peak2"><div class="button_class">Events Search</div></div>
    <form action="search" method="get" id="searchform" autocomplete="off">

    

            <table width="100%" align="left" >
  <tr>
    <td width="44%" align="left"><input name="month" type="text" class="Textinput" id="month" readonly="readonly" placeholder="Please select month to find event (optional)" value="" onfocus="if(this.placeholder == 'Please select month to find event (optional)'){this.placeholder = ''}" onblur="if(this.placeholder == ''){this.placeholder = 'Please select month to find event (optional)'}" /></td>
    <td width="56%" align="left"><select name="category" class="Textselect" id="category">
      <option value="">Choose Category (optional)</option>
      <?php 

	//$result_category = MysqlSelectQuery("select * from categories order by category_name");?>
      <?php //while ($rows_category = SqlArrays($result_category)){?>
      <option value="<?php //echo $rows_category['category_id'];?>"><?php //echo $rows_category['category_name'];?></option>
      <?php

		//}

	?>
    </select></td>
   
  </tr>
  <tr>
    <td colspan="2" align="left"></td>
   
  </tr>
  <tr>
    <td align="left"><input type="text" name="provider" class="Textinput"  id="textInput" placeholder="Training Providers(optional)" value="" onfocus="if(this.placeholder == 'Training Providers(optional)'){this.placeholder = ''}" onblur="if(this.placeholder == ''){this.placeholder = 'Training Providers(optional)'}" />
      <div id="output"><center><img src="<?php //echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center></div></td>
    <td align="left"><select class="Textselect" name="country" id="country" onchange="GetState()" >
        <?php //echo GetContries()?>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="left">
      </td>
  </tr>
  <tr>
    <td align="left"><input type="submit" class="buttonHome" value="Search" /></td>
    <td align="left"><select class="" name="state" id="state" disabled="disabled">
      <option value="">Select state (Nigeria only)</option>
        <?php //echo GetState()?>
      </select></td>
 
  </tr>
  <tr>
    <td colspan="2" align="left"></td>
    
  </tr>

            </table>



   </form> 
    <script type="text/javascript" >
function GetState(){
	var state = document.getElementById('state');
	var country  = document.getElementById('country');
	if(country.value == 38){
	state.disabled = false;
	state.className = 'Textselect';
	}
	else{
		state.disabled = true;
		state.className = '';
	}
}

</script>
   </div>
   </div>
 -->