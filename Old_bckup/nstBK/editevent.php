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
$selected = "";
if(connection());
if(isset($_POST['update'])){
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$add_event[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$add_event[$key] = NULL;
		else
			$add_event[$key] = addslashes($val);
	}
	if($add_event['name'] == "")$message = errorMsg("Please enter your name");
	else if($add_event['email'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($add_event['email']))$message = errorMsg("Please enter a valid email address");
	else if($add_event['title'] == "")$message = errorMsg("Please enter event title");
	else if($add_event['description'] == "")$message = errorMsg("Please enter event description");
	else if($add_event['venue'] == "")$message = errorMsg("Please enter event venue");
	else if($add_event['category'] == "")$message = errorMsg("Please select event category");
	else if($add_event['organizer'] == "")$message = errorMsg("Please enter event organizer");
	else if($add_event['start_date'] == "")$message = errorMsg("Please select the start date");
	else if($add_event['end_date'] == "")$message = errorMsg("Please select end date");
	//else if($add_event['website'] == "")$message = errorMsg("Please enter event website");
	else{
		$date = date("F j, Y");
		$StartDate = $add_event['start_date'];

		$NewStartDate = date("Y-m-d", strtotime($StartDate));
	if(MysqlQuery("update events set name='".$add_event['name']."',email='".$add_event['email']."',phone='".$add_event['phone']."',event_title='".$add_event['title']."',venue='".$add_event['venue']."',description='".addslashes($add_event['description'])."',category='".$add_event['category']."',startDate='".$add_event['start_date']."',endDate='".$add_event['end_date']."',website='".$add_event['website']."',cost='".$add_event['cost']."',organiser='".$add_event['organizer']."',facilitator='".$add_event['facilitator']."',country='".$_POST['country']."',state='".@$_POST['state']."',SortDate='$NewStartDate' ,tags='".$_POST['tags']."', videoID='".addslashes($_POST['videoID'])."', videoURL='".addslashes($_POST['videoURL'])."' where event_id='".$_GET['detail']."'"))
	$message = successMsg("Event has been updated successfully!");
	}
	
}
	$result = MysqlSelectQuery("select * from events where event_id = '$id'");
	$rows = SqlArrays($result);
	
	$resultCategory = MysqlSelectQuery("select * from categories where category_id = '".$rows['category']."'");
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
<title>Edit Events | Nigerian Seminars and Trainings</title><em></em>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="admin.css" />
 <link rel="stylesheet" href="../css/cmxform.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script src="../js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="../js/calender.js"></script>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#eventForm").validate({
			rules:{
				name: {
				required:true,
				minlength: 2
				},
				email:{
					required: true,
					email:true
				},
				title:{
					required: true,
					minlength: 2
				},
				description:{
					required: true,
					minlength: 2
				},
				title:{
					required: true,
					minlength: 2
				},
				venue:{
					required: true,
					minlength: 2
				},
				category:{
					required: true,
				},
				country:{
					required: true,
				},
				organizer:{
					required: true,
					minlength: 2
				},
				start_date:{
					required: true,
					minlength: 2
				},
				end_date:{
					required: true,
					minlength: 2
				},
				website:{
					required: true,
					url: true
				}
			},
			messages: {
			name: "Please enter your name",
			email: {
				required: "Please enter your email"
			},
			title: "Please enter event title",
			description:"Please enter event description",
			website:{
					required: "Please enter your web address",
					url: "Enter valid url e.g (http://www.example.com)"
				}
		}
						
		});
	});


function InitXMLHttpRequest() {
     if (window.XMLHttpRequest) {
          req = new XMLHttpRequest();
     } else if (window.ActiveXObject) {
          req = new ActiveXObject("Microsoft.XMLHTTP");
     }
}

function Get_Countries(){
	InitXMLHttpRequest()
	var url = '../tools/countries.php';
	var Countries = document.getElementById("country");
	var region = document.getElementById("region");
	var postData = 'country='+region.value;
if (req) {
 req.onreadystatechange = function() {
              if (req.readyState == 4) {
						Countries.innerHTML= req.responseText;
				
				}
				else if(req.responseText == 200){
					Countries.innerHTML='Ajax Error Please reload the page and try again';
				}

           else {
			   Countries.innerHTML='<option> Loading... </option>';
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
    	<div class="admin_editoffer_title">Edit Event</div>
        
        <div class="right_buttons">
          <div class="right_button"><a href="events.php">Back to main</a></div>
        
        </div>
    
    
    </div>
    <div id="admin_header_border"></div>
    
   
    	<?php echo $message;?>
         <div class="add_tab">	
         <form action="" method="post" id="eventForm">
                    <table width="100%" border="0">
  <tr>
    <td width="13%" align="right">Name: <span style="color:#F00"> * </span></td>
    <td colspan="3"><span class="contact-left">
      <input name="name" type="text" class="input" id="name" value="<?php echo $rows['name'];?>" size="40" /><br />
    </span></td>
  </tr>
  <tr>
    <td align="right">Email: <span style="color:#F00"> * </span></td>
    <td colspan="3"><span class="contact-left">
      <input name="email" type="text" class="input" id="email" value="<?php echo $rows['email'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Phone No: </span></td>
    <td colspan="3"><span class="contact-left">
      <input name="phone" type="text" class="input" value="<?php echo $rows['phone'];?>" id="phone" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Event Title: <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><span class="contact-left">
      <input name="title" type="text" class="input" id="title" value="<?php echo $rows['event_title'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right" valign="top"><span class="contact-left">Event Description: <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><textarea name="description" id="description" style="width: 60%; height: 200px;"><?php echo stripslashes($rows['description']);?></textarea>
     <script type="text/javascript">
		CKEDITOR.replace( 'description' );
			</script>
</td>
  </tr>
  <tr>
    <td align="right" valign="top">Event Venue: <span style="color:#F00"> * </span></span></td>
    <td colspan="3">
      <textarea name="venue" id="venue" style="width: 350px; height: 100px;" class="input"><?php echo $rows['venue'];?></textarea>
</td>
  </tr>
  <tr>
    <td align="right">Event Category: <span style="color:#F00"> * </span></td>
    <td colspan="3"><select name="category" id="category" class="input">
    <option value="<?php echo $rows['category'];?>" selected="selected"><?php echo $rowsCategory['category_name'];?></option>
    <?php 
	if(connection());
	$result_cat = MysqlSelectQuery("select * from categories order by category_name");?>
    <?php while ($rows_cat = SqlArrays($result_cat)){
		if ($rows['category'] == $rows_cat['category_id']);
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
    <td colspan="3"><select name="country" id="country" class="input" onchange="GetState()">
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
    <td colspan="3">
    <select  name="state" id="state" <?php if($rowsCountries['id'] != 38) echo 'disabled="disabled"';?> class="input" >
  <option value="<?php echo $rowsState['id_state'];?>" selected="selected"><?php echo $rowsState['name'];?></option>
      <?php echo GetState()?>
  </select>
</td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Attendance Cost:</span></td>
    <td colspan="3"><span class="contact-left">
      <input name="cost" type="text" class="input" id="cost" value="<?php echo $rows['cost'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Event Organizer: <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><span class="contact-left">
      <input name="organizer" type="text" class="input" id="organizer" value="<?php echo $rows['organiser'];?>" size="40" />
    </span></td>
  </tr>
   <tr>
    <td align="right"><span class="contact-left">Facilitator(s): <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><span class="contact-left">
      <input name="facilitator" type="text" class="input" id="facilitator" value="<?php echo $rows['facilitator'];?>" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Start Date: <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><span class="contact-left">
      <input name="start_date" type="text" class="input" id="start_date" style="width: 120px;" onclick="scwShow(this,event);" value="<?php echo $rows['startDate'];?>" readonly="readonly" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">End Date: <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><span class="contact-left">
      <input name="end_date" type="text" class="input"  value="<?php echo $rows['endDate'];?>" id="end_date" style="width: 120px;" onclick="scwShow(this,event);" readonly="readonly" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Event url: <span style="color:#F00"> * </span></span></td>
    <td colspan="3"><span class="contact-left">
      <input name="website" type="text" class="input" value="<?php echo $rows['website'];?>" id="website" size="40" />
    </span></td>
  </tr>
  <tr>
    <td align="right">Tags</td>
    <td colspan="2"><span class="contact-left">
      <input name="tags" type="text" class="input" value="<?php echo $rows['tags'];?>" id="tags" size="40" />
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Video ID</td>
    <td colspan="2"><span class="contact-left">
      <input name="videoID" type="text" class="input" value="<?php echo $rows['videoID'];?>" id="videoID" size="40" />
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">Video Url</td>
    <td colspan="2"><span class="contact-left">
      <input name="videoURL" type="text" class="input" value="<?php echo $rows['videoURL'];?>" id="videoURL" size="40" />
    </span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td width="15%"><input type="submit" name="update" id="update" value="Update" /></td>
    <td width="65%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
  </tr>
                            </table>

</form>
                     <script type="text/javascript" >
function GetState(){
	var state = document.getElementById('state');
	var country  = document.getElementById('country');
	if(country.value == 38){
	state.disabled = false;
	//state.className = 'input';
	}
	else{
		state.disabled = true;
		//state.className = '';
	}
}

</script>
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