 <?php



require_once("scripts/config.php");

require_once("scripts/functions.php");

?>



 <div class="searchTable">
<div style="color:#090; margin-bottom:5px; font-size:14px;">View events by Categories and Months</div>
    <form action="search" method="get" id="searchform" >

    

            <table width="100%" align="left" frame="border" height="90">
  <tr>
    <td width="58%" align="left"><input name="month" type="text" class="Textinput" id="month" readonly="readonly" placeholder="Please select month to find event" value="" onfocus="if(this.placeholder == 'Please select month to find event'){this.placeholder = ''}" onblur="if(this.placeholder == ''){this.placeholder = 'Please select month to find event'}" /></td>
    <td width="24%" align="left"><select name="category" class="Textselect" id="category">
      <option value="">Choose Category</option>
      <?php 

	$result_category = MysqlSelectQuery("select * from categories order by category_name");?>
      <?php while ($rows_category = SqlArrays($result_category)){?>
      <option value="<?php echo $rows_category['category_id'];?>"><?php echo $rows_category['category_name'];?></option>
      <?php

		}

	?>
    </select></td>
    <td width="18%" align="left"><input type="submit" class="buttonHome" value="Search" /></td>
  </tr>

      </table>



   </form> 

    </div>