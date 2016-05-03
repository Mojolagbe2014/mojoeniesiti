<div class="searchSite smart-forms " style="padding-top:0px;">
<?php
	if(!isset($_GET['category']) || strpos($_SERVER['SCRIPT_NAME'],'search.php')){
?>
<div class="advanced" style="display:none;" >

<form action="<?php echo SITE_URL;?>search" method="get" id="searchform" autocomplete="off" style="width:100%; margin-top:0px;">

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
                                    <span id="output"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loading image" width="20" height="14" style="text-align:center" /></span>
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
<div><em>(Leave box blank where not applicable)</em></div>
<div class="search_inputs">
<label class="field select" id="stateSelect" style="display:none;">
      <select name="state" id="state" >
        <option value="">Select state (Nigeria only)</option>
        <?php echo GetState()?>
        </select>
      <i class="arrow double"></i>
    </label>
</div>
<p><a href="#" style="font-size:11px; text-decoration:none;" title="basic search">Use Basic Search</a></p>
</div>

</form>
</div>


<div class="basic">
  <form action="#" method="post" id="searchform_basic" autocomplete="off" style="width:100%; margin-top:0px;">
  <table style="width:100%;" >
  <tr>
    <td style="width:88%; vertical-align:top;"><label class="field prepend-icon">
                                <input type="text" name="sub2" id="evtsearch" class="gui-input" placeholder="Enter keywords to search for events - conferences, training seminars...">
                                 <span id="output_events"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loading image" width="20" height="14" style="text-align:center" /></span>
<span  class="field-icon"><i class="fa fa-search"></i></span> 
</label>
<span><a href="#" style="font-size:11px; text-decoration:none;" title="advanced search">Advanced search</a></span>
</td>
    <td  style="width:12%; vertical-align:top;"><button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:11px; font-size:12px; background-color:#435A65; color:#FFF; margin:0" >Search</button>
                           
	</td>
  </tr>
</table>

 </form>

<div class="clearfix"></div>
</div>

<?php
	}
else{
?>
<div class="basicCat" >
  <form action="#" method="post" id="searchform_basic" autocomplete="off" style="width:100%; margin-top:0px;">
  <table style="width:100%;" >
  <tr>
    <td style="width:88%; vertical-align:top;"> <label class="field prepend-icon">
                                <input type="text" name="sub2" id="evtsearchCat" class="gui-input" placeholder="Enter keywords to search for events - conferences, training seminars in <?php if(isset($_GET['category']) && $_GET['category'] != '') echo GetCategoryByID($_GET['category']);?> category">
                                 <span id="output_events"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
                                <span class="field-icon"><i class="fa fa-search"></i></span> 
	</label>
</td>
    <td  style="width:12%; vertical-align:top;"><button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:11px; font-size:12px; background-color:#435A65; color:#FFF; margin:0" >Search</button>
                           
	</td>
  </tr>
</table>

 </form>
<div class="clearfix"></div>
</div>

<?php
	}
	?>
<div class="clearfix"></div>
</div>