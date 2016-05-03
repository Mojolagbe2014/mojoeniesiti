<?php
session_start();
require("../../scripts/config.php");
require("../../scripts/functions.php");

/*if(isset($_GET['categories'])){
$result = MysqlSelectQuery("select * from categories");
$data = "<ul>";
while($rows = SqlArrays($result)){
	$data .="<li>".$rows['category_name']."</li>";
}
$data .= "</ul>";
echo json_encode($data);
}*/
function dateCountDown(){
	$currentYear = date('Y');
	$startYear = 2010;
	$ele = "";
	for($currentYear = date('Y'); $currentYear >= $startYear ; $currentYear --){
		$ele .='<option value="'.$currentYear.'">'.$currentYear.'</option>';
	}
	return $ele;
}
function Category(){
	$result = MysqlSelectQuery("select * from categories");
		$data = "";
		while($rows = SqlArrays($result)){
			$data .='<option value="'.$rows['category_id'].'">'.$rows['category_name'].'</option>';
	}
	return $data;
}
$data = '<div style="background-color:#00CC00;padding-top:10px">
<div style="color:#FFF; text-align:center; padding:5px; font-size:16px;">
Nigerian Seminars and Training Search Widget
</div>
<form id="NST_Widget_Form" name="form1" target="_blank" method="post" action="https://www.nigerianseminarsandtrainings.com/tools/widget/redirect.php" class="smart-forms"  style="float:none">
<table class="contact_provider_table_responsive" style="width:100%">
<tr>
<td colspan="2" style="width:85%">
<div class="search_inputs"> 
<label class="field select">
      <select name="category" id="nst_category">
         <option value="">Choose Category</option>
  
      '.Category().'
   
      </select>
     <i class="arrow double"></i>
    </label>
</div>
</td></tr>
<tr>
<td width="34%"><div class="search_inputs"> 
<label class="field select">
      <select name="year" id="nst_year">
        <option value="">Select Year</option>
  
      '.dateCountDown().'
   
      </select>
     <i class="arrow double"></i>
    </label>
</div></td>
<td width="66%"><div class="search_inputs"> 
<label class="field select">
      <select name="month" id="nst_month">
        <option value="">Select Month</option>
        <option value="January">January</option>
        <option value="February">February</option>
        <option value="March">March</option>
        <option value="April">April</option>
        <option value="May">May</option>
        <option value="June">June</option>
        <option value="July">July</option>
        <option value="August">August</option>
        <option value="September">September</option>
        <option value="October">October</option>
        <option value="November">November</option>
        <option value="December">December</option>
      </select>
     <i class="arrow double"></i>
    </label>
</div></td>
</tr>
<tr>
<td colspan="2">
<div class="search_inputs">
<label class="field select">
      <select name="country" id="nst_country" onChange="GetState()">
       '.GetContries().'
          
      </select>
     <i class="arrow double"></i>
    </label>
</div>
</td></tr>
<tr>
  <td colspan="2" style="text-align:center">
  <div class="search_inputs">
<label class="field select" id="nst_stateSelect" >
      <select name="state" id="state" >
        <option value="">Select state (Nigeria only)</option>
       '.GetState().'
        </select>
      <i class="arrow double"></i>
    </label>
</div>
</td>
</tr>
<tr>
<td colspan="2" style="text-align:center;padding:5px;">
<button class="button btn-primary" type="submit" name="submit"> Submit </button>
</td>
</tr>
</table>
</form></div>';
echo $_GET['callback']."(".json_encode($data).");";
?>
