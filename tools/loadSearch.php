<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
?>
<form action="search" method="get" id="searchform" autocomplete="off">
<h2>Search Events</h2>
<div class="search_inputs"> 
<label class="field select">
      <select name="category" id="category">
         <option value="">Choose Category</option>
      <?php 

	$result_category = MysqlSelectQuery("select * from categories order by category_name");?>
      <?php while ($rows_category = SqlArrays($result_category)){?>
      <option value="<?php echo $rows_category['category_id'];?>"><?php echo $rows_category['category_name'];?></option>
      <?php

		}

	?>
      </select>
     <i class="arrow double"></i>
    </label>
</div>
<div class="search_inputs"> 
  <label class="field prepend-icon">
     <input type="text" id="month-picker1" name="month" class="gui-input" placeholder="Select Month">
    <span class="field-icon" ><i class="fa fa-calendar-o"></i></span>  
</label>
</div>
<div class="search_inputs">
<label class="field prepend-icon">
                                    <input type="text" name="provider" id="textInput" class="gui-input" placeholder="Select Training Provider">
          <span  class="field-icon"><i class="fa fa-user"></i></span>  
                                    <span id="output"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
                                </label> 
</div>
<div class="search_inputs">
<label class="field select">
      <select name="country" id="country" onChange="GetState()">
          <?php echo GetContries()?>
      </select>
     <i class="arrow double"></i>
    </label>
</div>

<div class="search_btn">
<button class="button btn-primary" type="submit">Search</button>
</div>
<div class="last_input">
<h4><em>(Leave box blank where not applicable)</em></h4>
<div class="search_inputs">
<label class="field select" id="stateSelect" style="display:none;">
      <select name="state" id="state" >
        <option value="">Select state (Nigeria only)</option>
        <?php echo GetState()?>
        </select>
      <i class="arrow double"></i>
    </label>
</div>
</div>

</form>
<div class="clearfix"></div>