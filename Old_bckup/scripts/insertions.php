<?php
if(isset($_POST['submit_event'])){
	
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$add_event[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	
	if($_SESSION['name'] == "")$message = errorMsg("Please enter your name");
	else if($_SESSION['email'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($_SESSION['email']))$message = errorMsg("Please enter a valid email address");
	else if($_SESSION['title'] == "")$message = errorMsg("Please enter event title");
	else if($_SESSION['description'] == "")$message = errorMsg("Please enter event description");
	else if($_SESSION['venue'] == "")$message = errorMsg("Please enter event venue");
	else if($_SESSION['category'] == "")$message = errorMsg("Please select event category");
	else if($_SESSION['country'] == "")$message = errorMsg("Please select country");
	else if($_POST['country'] == "38" && $_POST['state'] == "")$message = errorMsg("Please select state in Nigeria");
	else if($_SESSION['organizer'] == "")$message = errorMsg("Please enter event organizer");
	//else if($_SESSION['facilitator'] == "")$message = errorMsg("Please enter event facilitator");
	else if($_SESSION['start_date'] == "")$message = errorMsg("Please select the start date");
	else if($_SESSION['end_date'] == "")$message = errorMsg("Please select end date");
	else if($_SESSION['website'] == "")$message = errorMsg("Please enter event website");
	else if(!isValidURL($_SESSION['website']))$message = errorMsg("Please enter a valid url");
	else if($add_event['verify']!= $add_event['verifyHidden']) {
    $message = errorMsg("Invalid verification code");
  			}
	else{
	if(connection()){
		//$date = //date("F j, Y");
		$date = date("Y-m-d");
		$StartDate = $_SESSION['start_date'];

		$NewStartDate = date("Y-m-d", strtotime($StartDate));

	if(MysqlQuery("insert into events (name,email,phone,event_title,venue,description,category,startDate,endDate,website,cost,organiser,facilitator,posted_date,SortDate,country,state,tags)
										  values('".addslashes($_SESSION['name'])."','".addslashes($_SESSION['email'])."','".addslashes($_SESSION['phone'])."','".
											addslashes($_SESSION['title'])."','".addslashes($_SESSION['venue'])."','".addslashes($_SESSION['description'])."','".
											$_SESSION['category']."','".$_SESSION['start_date']."','".$_SESSION['end_date']."','".
											addslashes($_SESSION['website'])."','".addslashes($_SESSION['cost'])."','".addslashes($_SESSION['organizer'])."','".addslashes($_SESSION['facilitator'])."','$date','$NewStartDate','".$_POST['country']."','".$_POST['state']."','".addslashes($_SESSION['tags'])."')")){
											
		AdminNotificationMail($_SESSION['title'],$_SESSION['organizer'],$date);
		reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	unset($_SESSION['name']);
	unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['title']);
	unset($_SESSION['venue']);
	unset($_SESSION['description']);
	unset($_SESSION['website']);
	unset($_SESSION['cost']);
	unset($_SESSION['organizer']);
	header("location: confirmation?type=event");
			}
		}
	}
	
}
if(isset($_POST['submit_bizinfo'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$business[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	//check user login table if email exist
	$checkLogin = MysqlSelectQuery("select email from user_login where email= '".$_POST['email']."'");
	$numLogin = NUM_ROWS($checkLogin);
	
	//check business info table if business already exist
	$checkBiz = MysqlSelectQuery("select * from businessinfo where business_name like '%".$_SESSION['business_name']."%'");
	$numBiz = NUM_ROWS($checkBiz);
	
	//check business info table if email exist
	$checkBizEmail = MysqlSelectQuery("select email from businessinfo where email= '".$_POST['email']."'");
	$numBizEmail = NUM_ROWS($checkBizEmail);
	
	if($_SESSION['business_name'] == "")$message = errorMsg("Please enter your business name");
	else if($numBiz > 0)$message = errorMsg("Business already exist, please enter another");
		else if($_SESSION['buz_type'] == "")$message = errorMsg("Please your business type");
	else if($_SESSION['email'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($_SESSION['email']))$message = errorMsg("Please enter a valid email address");
	else if(($numLogin > 0) || ($numBizEmail > 0))$message = errorMsg("Email already exist, please choose another");
	else if($_POST['password'] == "")$message = errorMsg("Please enter your password");
	else if($_POST['password'] != $_POST['password2'])$message = errorMsg("Your password does not match");
	else if($_SESSION['description'] == "")$message = errorMsg("Please enter your business description");
	else if($_SESSION['address'] == "")$message = errorMsg("Please enter your business address");
	else if($_SESSION['country'] == "")$message = errorMsg("Please select country");
	else if($_POST['country'] == "38" && $_POST['state'] == "")$message = errorMsg("Please select state in Nigeria");
	else if($_SESSION['buz_type'] == "Training" && $_SESSION['category'] == "")$message = errorMsg("Please select area of specialization");
	else if($_SESSION['contact_person'] == "")$message = errorMsg("Please enter contact person");
	else if($business['verify']!= $business['verifyHidden']) {
    $message = errorMsg("Invalid verification code");
  			}
	else
	if(connection()){
		$hashed = md5($_POST['password']);
		
		MysqlQuery("insert into user_login (email,password) values ('".$_SESSION['email']."','".$hashed."')");
		$id = mysql_insert_id();
		
	if(MysqlQuery("insert into businessinfo (business_name,email,description,address,size,capacity,contact_person,telephone,website,business_type,specialization,country,state,user_id)
										  values('".addslashes($_SESSION['business_name'])."','".addslashes($_SESSION['email'])."','".addslashes($_SESSION['description'])."','".
											addslashes($_SESSION['address'])."','".addslashes($_SESSION['size'])."','".addslashes($_SESSION['capacity'])."','".
											addslashes($_SESSION['contact_person'])."','".addslashes($_SESSION['telephone'])."','".
											addslashes($_SESSION['website'])."','".$_SESSION['buz_type']."','".$_POST['category']."','".$_POST['country']."','".$_POST['state']."','$id')")){
		
		reset ($business);
	while (list ($key, $val) = each ($business)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	unset($_SESSION['business_name']);
	unset($_SESSION['email']);
	unset($_SESSION['address']);
	unset($_SESSION['telephone']);
	unset($_SESSION['size']);
	unset($_SESSION['description']);
	unset($_SESSION['website']);
	unset($_SESSION['capacity']);
	unset($_SESSION['buz_type']);
	header("location: confirmation?type=business");
		}
	}
	
}
if(isset($_POST['submit_vacancies'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$vacancies[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	if($_SESSION['title'] == "")$message = errorMsg("Please enter job title");
	else if($_SESSION['experience'] == "")$message = errorMsg("Please select job expereince");
	else if($_SESSION['type'] == "")$message = errorMsg("Please select job type");
	else if($_SESSION['country'] == "")$message = errorMsg("Please select country");
	else if($_SESSION['city'] == "")$message = errorMsg("Please enter city");
	else if($_SESSION['description'] == "")$message = errorMsg("Please enter job description");
	else if($_SESSION['company_name'] == "")$message = errorMsg("Please enter company name");
	else if($_SESSION['contact_person'] == "")$message = errorMsg("Please enter contact person's name");
	else if($_SESSION['telephone'] == "")$message = errorMsg("Please enter your telephone number");
	else if($_SESSION['email'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($_SESSION['email']))$message = errorMsg("Please enter a valid email address");
	else if($vacancies['verify']!= $vacancies['verifyHidden']) {
    $message = errorMsg("Invalid verification code");
  			}
	else
	if(connection()){
	if(MysqlQuery("insert into vacancies (title,type,experience,category,country,city,description,contact_person,company_name,telephone,email,posted_date)
										  values('".addslashes($_SESSION['title'])."','".addslashes($_SESSION['type'])."','".$_SESSION['experience']."','".
											$_SESSION['category']."','".$_SESSION['country']."','".addslashes($_SESSION['city'])."','".
											addslashes($_SESSION['description'])."','".addslashes($_SESSION['contact_person'])."','".
											addslashes($_SESSION['company_name'])."','".addslashes($_SESSION['telephone'])."','".addslashes($_SESSION['email'])."','".date("Y-m-d")."')")){
		reset ($vacancies);
	while (list ($key, $val) = each ($vacancies)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	unset($_SESSION['title']);
	unset($_SESSION['type']);
	unset($_SESSION['experience']);
	unset($_SESSION['category']);
	unset($_SESSION['country']);
	unset($_SESSION['description']);
	unset($_SESSION['contact_person']);
	unset($_SESSION['city']);
	unset($_SESSION['description']);
	unset($_SESSION['company_name']);
	unset($_SESSION['telephone']);
	unset($_SESSION['email']);
	header("location: confirmation?type=vacancy");
			}
		}
}

if(isset($_POST['submit_subscriber'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$subscribers[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	$check = MysqlSelectQuery("select email from subscribers where email='".$_SESSION['email_sub']."'");
	$checkUsername = MysqlSelectQuery("select username from subscribers where username='".$_SESSION['username']."'");
	if($_SESSION['email_sub'] == "")$message = errorMsg("Please enter your email address");
	else if(!smcf_validate_email($_SESSION['email_sub']))$message = errorMsg("Please enter a valid email address");
	else if($_SESSION['fname'] == "")$message = errorMsg("Please your firstname");
	else if($_SESSION['lname'] == "")$message = errorMsg("Please enter your lastname");
	else if($_SESSION['username'] == "")$message = errorMsg("Please enter your username");
	else if($_POST['password'] == "")$message = errorMsg("Please enter your password");
	else if(!is_numeric($_SESSION['phone']))$message = errorMsg("Please enter a valid telephone number");
	else if($_SESSION['organization'] == "")$message = errorMsg("Please enter your organization");
	else if($_SESSION['address'] == "")$message = errorMsg("Please enter your address");
	else if($_SESSION['city'] == "")$message = errorMsg("Please enter your city");
	else if($_SESSION['state'] == "")$message = errorMsg("Please enter your state");
	else if($_SESSION['country'] == "")$message = errorMsg("Please select your country");
else if($_SESSION['category'] == "")$message = errorMsg("Please select category your interested in");
else if(strtolower($subscribers['verify'])!= strtolower($subscribers['verifyHidden'])) {
    $message = errorMsg("Invalid verification code");
  			}
			else if(NUM_ROWS($check) > 0){$message = errorMsg("Email already exists!");}
			else if(NUM_ROWS($checkUsername) > 0){$message = errorMsg("Username already exists!");}
	else
	if(connection()){
	if(MysqlQuery("insert into subscribers (email,fname,lname,phone,organization,country,city,state,address,category,sex,designation)
										  values('".addslashes($_SESSION['email_sub'])."','".addslashes($_SESSION['fname'])."','".addslashes($_SESSION['lname'])."','".
											addslashes($_SESSION['phone'])."','".addslashes($_SESSION['organization'])."','".$_SESSION['country']."','".
											addslashes($_SESSION['city'])."','".addslashes($_SESSION['state'])."','".
											addslashes($_SESSION['address'])."','".$_SESSION['category']."','".$_POST['sex']."','".$_SESSION['designation']."')")){
		reset ($vacancies);
	while (list ($key, $val) = each ($vacancies)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	$id = mysql_insert_id();
	$to = $_SESSION['email_sub'];
	$hashId = md5($id);
	$subject = "Confirm your subscription";
	$message = "<p>Dear ".$_SESSION['fname']." ".$_SESSION['lname'].",<br \> Your Login details are Email: ".$_SESSION['email_sub']." <br /> Password : ".$_POST['password']." <br /> Thank you for your subscription. Please click on the link below to confirm your subscription.</p>";
	$message .= "<p><a href='http://www.nigerianseminarsandtrainings.com/confirmation?type=email&g=$id&user=$hashId' >http://www.nigerianseminarsandtrainings.com/confirmation?type=email&g=$id&user=$hashId</a></p>";
	SendHtmlEmails($to,$subject,$message,"","");
	unset($_SESSION['email_sub']);
	unset($_SESSION['fname']);
	unset($_SESSION['lname']);
	unset($_SESSION['phone']);
	unset($_SESSION['organization']);
	unset($_SESSION['description']);
	unset($_SESSION['country']);
	unset($_SESSION['city']);
	unset($_SESSION['state']);
	unset($_SESSION['address']);
	unset($_SESSION['category']);
	unset($_SESSION['sex']);
	header("location: confirmation?type=subscriber");
			}
		}
}

if(isset($_POST['submit_video'])){

	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$video[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = $val;
	}
	if($_SESSION['video_title'] == "")$message = errorMsg("Please enter your video title");
	else if($_SESSION['video_id'] == "")$message = errorMsg("Please enter video id");
	else if(!smcf_validate_email($_SESSION['email']))$message = errorMsg("Please enter a valid email address");
	else if($_SESSION['description'] == "")$message = errorMsg("Please  enter your video description");
	else if($_SESSION['posted_by'] == "")$message = errorMsg("Please name of the person posting this video");
	else if(!is_numeric($_SESSION['telephone']))$message = errorMsg("Please enter a valid telephone number");
	else if($_SESSION['website'] == "")$message = errorMsg("Please enter your website");
	else if($video['verify']!= $video['verifyHidden']) {
    $message = errorMsg("Invalid verification code");
  			}
	else
	if(connection()){
			$date = date("Y-m-d");
	if(MysqlQuery("insert into videos (video_title,video_id,email,description,posted_by,telephone,website,posted_date)
										  values('".addslashes($_SESSION['video_title'])."','".addslashes($_SESSION['video_id'])."','".addslashes($_SESSION['email'])."','".
											addslashes($_SESSION['description'])."','".addslashes($_SESSION['posted_by'])."','".addslashes($_SESSION['telephone'])."','".
											addslashes($_SESSION['website'])."','".$date."')")){
		reset ($video);
	while (list ($key, $val) = each ($video)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	
	header("location: confirmation?type=video");
			}
		}
}
?>