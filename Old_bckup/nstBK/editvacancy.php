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
$type = "";
if(isset($_GET['detail'])) $id = $_GET['detail'];

if(isset($_POST['update_vacancies'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$vacancies[$key] = addslashes($val);
		if ($val == "NULL")
			$vacancies[$key] = NULL;
		else
			$vacancies[$key] = $val;
	}
	if($vacancies['title'] == "")$message = errorMsg("Please enter job title");
	else if($vacancies['experience'] == "")$message = errorMsg("Please select job expereince");
	else if($vacancies['type'] == "")$message = errorMsg("Please select job type");
	else if($vacancies['country'] == "")$message = errorMsg("Please select country");
	else if($vacancies['city'] == "")$message = errorMsg("Please enter city");
	else if($vacancies['description'] == "")$message = errorMsg("Please enter job description");
	else if($vacancies['company_name'] == "")$message = errorMsg("Please enter company name");
	else if($vacancies['contact_person'] == "")$message = errorMsg("Please enter contact person's name");
	else if($vacancies['email'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($vacancies['email']))$message = errorMsg("Please enter a valid email address");
	else
	if(connection()){
	if(MysqlQuery("update vacancies set title='".$vacancies['title']."',type='".$vacancies['type']."',experience='".$vacancies['experience']."',country='".$vacancies['country']."',city='".$vacancies['city']."',description='".addslashes($vacancies['description'])."',contact_person='".$vacancies['contact_person']."',company_name='".$vacancies['company_name']."',telephone='".$vacancies['telephone']."',email='".$vacancies['email']."' where job_id='".$_GET['detail']."'")){
		
		$message = successMsg("Vacancy has been updated successfully!");
		
		}
	}
}


if(connection()){
	$result = MysqlSelectQuery("select * from vacancies where job_id = '$id'");
	$rows = SqlArrays($result);
	
	switch($rows['type']){
							case 1:
							$type = "Fulltime";
							break;
							case 2:
							$type = "Partime";
							break;
							case 3:
							$type = "Contract";
							break;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php echo $rows['title'];?> | Admin | Nigerian Seminars and Trainings.com </title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="stylesheet" type="text/css" href="admin.css" />
    <script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
</script>
</head>
<body>
<div id="main_container">

<?php include("scripts/menus.php");?>
    

    
    <div id="main_content">
    
    
    <div id="admin_header">
    	<div class="admin_edit_title">Edit Vacancy</div>
        
        <div class="right_buttons">
          <div class="right_button"><a href="vacancies">Back to main</a></div>
        
        </div>
    
    
    </div>
    <div id="admin_header_border"></div>
    
   
    	 <?php echo $message;?>
         <div class="add_tab">	
        
         <form action="" method="post" id="contactform2">
                            <table width="100%" border="0">
  <tr>
    <td width="21%" align="right">Job Title: <span style="color:#F00"> *</span></td>
    <td width="79%"><span class="contact-left">
      <input name="title" type="text" class="input" id="title" value="<?php echo $rows['title'];?>" />
    </span></td>
  </tr>
  <tr>
    <td align="right">Work Experience <span style="color:#F00"> * </span></td>
    <td><select name="experience" id="experience" class="input">
    <option value="<?php echo $rows['experience'];?>"><?php echo $rows['experience'];?></option>
      <option value="1 Year">1 year</option>
      <option value="2 years">2 years</option>
      <option value="3 years">3 years</option>
      <option value="4 years">4 years</option>
      <option value="5 years">5 years</option>
      <option value="6 years">6 years</option>
      <option value="7 years">7 years</option>
      <option value="8 years">8 years</option>
      <option value="9 years">9 years</option>
      <option value="10 and Above">10 and Above</option>
    </select></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Type: <span style="color:#F00"> * </span></span></td>
    <td><select name="type" id="type" class="input">
      <option selected="selected" value="<?php echo $rows['type'];?>"><?php echo $type;?></option>
      <option value="1">Fulltime</option>
      <option value="2">Partime</option>
      <option value="3">Contract</option>
    </select></td>
  </tr>
  <tr>
    <td align="right">Country: <span style="color:#F00"> * </span></td>
    <td><select name="country" id="country" class="input">
      <option selected="selected" value="<?php echo $rows['country'];?>"><?php echo $rows['country'];?></option>
      <?php 
	  if(connection());
	  $result_country = MysqlSelectQuery("select * from countries");
	  while($rows_country = SqlArrays($result_country)){
	  ?>
      <option value="<?php echo $rows_country['countries'];?>"><?php echo $rows_country['countries'];?></option>
      <?php
	  }
	  ?>
      </select></td>
  </tr>
  <tr>
    <td align="right">City: <span style="color:#F00"> * </span></td>
    <td><span class="contact-left">
      <input name="city" type="text" class="input" id="city"  value="<?php echo $rows['city'];?>" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Job Description: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <textarea name="description" style="width: 80%; height:200px" id="description"><?php echo $rows['description'];?></textarea>
       <script type="text/javascript">
		CKEDITOR.replace( 'description' );
			</script>
       
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Company Name: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <input name="company_name" type="text" class="input" id="company_name" value="<?php echo $rows['company_name'];?>" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Contact Person: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <input name="contact_person" type="text" class="input" id="contact_person" value="<?php echo $rows['contact_person'];?>" />
      </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">Telephone:</span></td>
    <td><span class="contact-left">
      <input name="telephone" type="text" class="input" id="telephone" value="<?php echo $rows['telephone'];?>" />
    </span></td>
  </tr>
  <tr>
    <td align="right"><span class="contact-left">email: <span style="color:#F00"> * </span></span></td>
    <td><span class="contact-left">
      <input name="email" type="text" class="input" id="email" value="<?php echo $rows['email'];?>" />
      </span></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td>
      <input name="update_vacancies" type="submit" class="button_bg" id="submit_vacancies" value="Update Vacancy" />
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