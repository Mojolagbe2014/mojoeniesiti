<?php
session_start();
if(!isset($_SESSION['SESSION'])) require( "../scripts/sessions.php");
require("../scripts/config.php");
require("../scripts/functions.php");
if(@$_SESSION['LOGGEDIN'] != true){
	header("location: ./");exit;
}
$id = "";
$message ="";
if(isset($_GET['detail'])) $id = $_GET['detail'];

if(isset($_POST['update_bizinfo'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$business[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$business[$key] = NULL;
		else
			$business[$key] = $val;
	}
	if($business['business_name'] == "")$message = errorMsg("Please enter your business name");
		else if($business['buz_type'] == "")$message = errorMsg("Please your business type");
	else if($business['email'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($business['email']))$message = errorMsg("Please enter a valid email address");
	else if($business['description'] == "")$message = errorMsg("Please enter your business description");
	else if($business['address'] == "")$message = errorMsg("Please enter your business address");
	else if($business['contact_person'] == "")$message = errorMsg("Please enter contact person");
	else
	if(connection()){
	if(MysqlQuery("update businessinfo set business_name='".addslashes($business['business_name'])."',email='".$business['email']."',description='".addslashes($business['description'])."',address='".addslashes($business['address'])."',size='".$business['size']."',capacity='".$business['capacity']."',contact_person='".addslashes($business['contact_person'])."',telephone='".$business['telephone']."',website='".$business['website']."',business_type='".$business['buz_type']."', price='".$business['price']."',specialization='".$business['category']."',country='".$_POST['country']."',state='".$_POST['state']."' where business_id='".$_GET['detail']."'"))
										 {
	
	$message = successMsg("Business Infomation has been updated successfully!");
		}
	}
	
}

if(connection()){
	$result = MysqlSelectQuery("select * from businessinfo where business_id = '$id'");
	$rows = mysql_fetch_array($result);
	
	if($rows['status'] == 1) $status = "Activated";
						else 
						$status = '<a href="javascript:ActivateBusiness('.$rows['business_id'].')"><img src="images/adminicons/sucicon2.png" width="24" height="23" /></a>';
}
$url = $rows['website'];
if (!strstr($url, "http://") == $url) {$url ="http://".$rows['website']; }

$resultCategory = MysqlSelectQuery("select * from categories where category_id = '".$rows['specialization']."'");
	$rowsCategory = SqlArrays($resultCategory);
	
	$resultCountry = MysqlSelectQuery("select * from countries where id = '".$rows['country']."'");
	$rowsCountries = SqlArrays($resultCountry);
	
	$resultState = MysqlSelectQuery("select * from states where id_state = '".$rows['state']."'");
	$rowsState = SqlArrays($resultState);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php echo $rows['business_name'];?> | Admin | Nigerian Seminars and Trainings.com </title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="admin.css" />
 <link rel="stylesheet" href="../css/cmxform.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script src="../js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="../js/calender.js"></script>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
function delete_business(val){
	if(confirm("Are you sure you want to delete this business information?"))
	{
		window.location='scripts/delete.php?id='+val+'&action=true';
	}
}
function activateBusiness(val){
	if(confirm("Are you sure you want to activate this business information?"))
	{
	window.location='scripts/activate.php?business_id='+val+'&action=true';
	}
}
function InitXMLHttpRequest() {
     if (window.XMLHttpRequest) {
          req = new XMLHttpRequest();
     } else if (window.ActiveXObject) {
          req = new ActiveXObject("Microsoft.XMLHTTP");
     }
}
/* var HttPRequest = false;
 
	   function Get_Countries() {
 
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
 
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
 
			var url = '../tools/countries.php';
			var Countries = document.getElementById("changeCountry");
			var region = document.getElementById("region");
			var pmeters = 'country='+region.value;
			
 
 
			HttPRequest.onreadystatechange = function()
			{
				 if(HttPRequest.readyState == 4) // Return Request
				  {
		var response = HttPRequest.responseText;
		//Countries.innerHTML= response;
				   document.getElementById("changeCountry").innerHTML = response;
				  }
				else // Loading Request
				  {
	Countries.innerHTML = '<img src="../images/preloader.gif" width="20" height="20" />';
				  }
 
			}
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
 }
*/

function Get_Countries(){
	InitXMLHttpRequest()
	var url = '../tools/countries.php';
			var Countries = document.getElementById("changeCountry");
			var region = document.getElementById("region");
			var postData = 'country='+region.value;
if (req) {
 req.onreadystatechange = function() {
              if (req.readyState == 4) {
						document.getElementById("changeCountry").innerHTML = req.responseText;
				
				}
				else if(req.responseText == 200){
					Countries.innerHTML='Ajax Error Please reload the page and try again';
				}

           else {
			   Countries.innerHTML = '<img src="../images/preloader.gif" width="20" height="20" />';
               }
          }
        req.open("POST", url, true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          req.send(postData);
          
     } 
	 else {
          //document.getElementById("response").innerHTML = 'Browser unable to create XMLHttp Object';
    	 }
}

function Get_State(){
	InitXMLHttpRequest()
	var Countries = document.getElementById("country");
	//if(Countries.value == 38){
		var url = '../tools/countries.php';
	var state = document.getElementById("changeState");
	var postData = 'GetState='+Countries.value;
if (req) {
 req.onreadystatechange = function() {
              if (req.readyState == 4) {
						state.innerHTML= req.responseText;
				
				}
				else if(req.responseText == 200){
					state.innerHTML='Ajax Error Please reload the page and try again';
				}

           else {
			   state.innerHTML='<img src="../images/preloader.gif" width="20" height="20" />';
               }
          }
        req.open("POST", url, true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
          req.send(postData);
          
     } 
	 else {
          //document.getElementById("response").innerHTML = 'Browser unable to create XMLHttp Object';
    	 }
	//}
}


	</script>
</head>
<body>
<div id="main_container">

<?php include("scripts/menus.php");?>
    

    
    <div id="main_content">
    
    
    <div id="admin_header">
    	<div class="admin_edit_title">Edit Business Information</div>
        
        <div class="right_buttons">
          <div class="right_button"><a href="business">Back to main</a></div>
        
        </div>
    
    
    </div>
    <div id="admin_header_border"></div>
    
   
    	 <?php echo $message;?>
         <div class="add_tab">	
        
         <form action="" method="post" id="eventForm">
                    <table width="100%" border="0">
  <tr>
    <td width="21%" align="right">Busiess Name: <span style="color:#F00"> * </span></td>
    <td width="79%"><span class="contact-left">
      <input name="business_name" type="text" class="input" id="business_name" value="<?php echo $rows['business_name'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right">Business Type: <span style="color:#F00"> * </span></td>
    <td><select name="buz_type" id="buz_type" class="input">
      <option selected="selected"><?php echo $rows['business_type'];?></option>
     <option value="Training">Training Provider</option>
	<option value="Managers">Event Managers</option>
    <option value="Suppliers">Event Equipment Supplier</option>
    <option value="Venue">Venue Provider</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">Email: <span style="color:#F00"> * </span></td>
    <td><span class="contact-left">
      <input name="email" type="text" class="input" id="email" value="<?php echo $rows['email'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top"><span class="contact-left">Description: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <textarea name="description" rows="7" id="description" style="width: 350px;"><?php echo $rows['description'];?></textarea>
      </span></td>
      <script type="text/javascript">
		CKEDITOR.replace( 'description' );
			</script>
  </tr>
  <tr>
    <td align="right">Category: <span style="color:#F00"> * </span></td>
    <td colspan="3"><select name="category" id="category" class="input">
    <option value="<?php echo $rowsCategory['category_id'];?>" selected="selected"><?php echo $rowsCategory['category_name'];?></option>
    <?php 
	if(connection());
	$result_cat = MysqlSelectQuery("select * from categories order by category_name");?>
    <?php while ($rows_cat = SqlArrays($result_cat)){
		//if ($rows['category'] == $rows_cat['category_id']);
		//$selected = 'selected="selected"';
		?>
    <option value="<?php echo $rows_cat['category_id'];?>"><?php echo $rows_cat['category_name'];?></option>
    <?php
		}
	?>
    </select></td>
  </tr>
  <tr>
    <td align="right">Country <span style="color:#F00"> * </span></td>
    <td colspan="3"><select name="country" id="country" class="input" onchange="Get_State()">
    <option value="<?php echo $rowsCountries['id'];?>" selected="selected"><?php echo $rowsCountries['countries'];?></option>
    <?php 
	if(connection());
	$result_country = MysqlSelectQuery("select * from countries");?>
    <?php while ($rows_country = SqlArrays($result_country)){?>
    <option value="<?php echo $rows_country['id'];?>"><?php echo $rows_country['countries'];?></option>
    <?php
		}
	?>
    </select></td>
  </tr>
  <tr>
    <td align="right">State</td>
    <td colspan="3"><div id="changeState"><select name="state" id="state" class="input" >
    <option value="<?php echo $rowsState['id_state'];?>" selected="selected"><?php echo $rowsState['name'];?></option>
     <?php 
	if(connection());
	$result_state = MysqlSelectQuery("select * from states");?>
    <?php while ($rows_state = SqlArrays($result_state)){?>
    <option value="<?php echo $rows_state['id_state'];?>"><?php echo $rows_state['name'];?></option>
    <?php
		}
	?>
    </select></div></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Address: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <input name="address" type="text" class="input" id="address" value="<?php echo $rows['address'];?>" size="40"/> 
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Size:</span></td>
    <td><span class="contact-left">
      <input name="size" type="text" class="input" id="size" value="<?php echo $rows['size'];?>" size="40" />
      (for venue providers only)</span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Capacity</span></td>
    <td><span class="contact-left">
      <input name="capacity" type="text" class="input" id="capacity" value="<?php echo $rows['capacity'];?>" size="40" />
    (for venue providers only)</span></td>
  </tr>
  <tr>
    <td align="right">Price</td>
    <td><span class="contact-left">
      <input name="price" type="text" class="input" id="price" value="<?php echo $rows['price'];?>" size="40" />
    (for venue providers only)</span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Contact Person:  <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <input name="contact_person" type="text" class="input" id="contact_person" value="<?php echo $rows['contact_person'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Telephone: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <input name="telephone" type="text" class="input" id="telephone" value="<?php echo $rows['telephone'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Website:</span></td>
    <td><span class="contact-left">
      <input name="website" type="text" class="input" id="website" value="<?php echo $rows['website'];?>" size="40" />
      </span></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>
      <input name="update_bizinfo" type="submit" class="button_bg" id="submit_bizinfo" value="Update" />
      </span></td>
  </tr>
                            </table>

                    </form>
         </div>
    </div>
    <!-- end of main_content -->
    
<div id="footer">

	<div id="copyright">
    Nigerian Seminars and Trainings.com &copy; All Rights Reserved 2012<a href="http://csscreme.com" style="color:#772c17;"></a></div>
   
</div>


</div>
<!-- end of main_container -->

</body>
</html>