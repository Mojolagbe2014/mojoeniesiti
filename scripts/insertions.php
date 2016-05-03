<?php
$errors = array();
//(isset($_SESSION['email']) && $_SESSION['email']!='' ? $_SESSION['email'] : '')

$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];

$currentUser = "<strong>Event added by:</strong><br/> ".(isset($_SESSION['email']) && $_SESSION['email']!='' ? $_SESSION['email'] : '')." <br/>";
$visitorInfo =  "<div><b>Visitor IP address:</b><br/>" . $ip . "<br/>";
$visitorInfo .= "<b>Browser (User Agent) Info:</b><br/>" . $browser . "<br/></div>";
$addedBy = $currentUser.$visitorInfo;

if(isset($_POST['submit_event'])){
	reset ($_POST);
	while (list ($key, $val) = each ($_POST)) {
		if ($val == "") $val = "NULL";
		$add_event[$key] = (get_magic_quotes_gpc()) ? $val : addslashes($val);
		if ($val == "NULL")
			$_SESSION[$key] = NULL;
		else
			$_SESSION[$key] = strip_tags($val);
	}
        
        $eventBrochure = basename($_FILES["brochure"]["name"]) ? rand(100000, 1000000)."_".  strtolower(str_replace(" ", "_", trimStringToFullWord(20, stripslashes(strip_tags(filter_input(INPUT_POST, 'title')))))).".".pathinfo(basename($_FILES["brochure"]["name"]),PATHINFO_EXTENSION): "";
        $brochureLink = "event-brochures/".$eventBrochure;
//        echo $eventBrochure;
        if($eventBrochure !=""){ 
            $brochFileType = pathinfo($eventBrochure, PATHINFO_EXTENSION);
            if(file_exists($brochureLink)) $errors[] = "Brochure already exists";
            if ($_FILES["brochure"]["size"] > 200000) $errors[] = "Brochure file is too large. It must be less than 200KB";
            if($brochFileType != "pdf" && $brochFileType != "doc" && $brochFileType != "docx") $errors[] = "Sorry, only MS-Word Documents and PDF files are allowed.";
        }
	if($_SESSION['entrant_name'] == "") $errors[] = "Enter your name";
	if($_SESSION['email'] == "") $errors[] = "Enter your email address";
	if(!smcf_validate_email($_SESSION['email'])) $errors[] = "Enter a valid email address";
	if($_SESSION['title'] == "") $errors[] = "Enter event title";
	if($_SESSION['description'] == "") $errors[] = "Enter event description";
	if($_SESSION['venue'] == "") $errors[] = "Enter event venue";
	if($_SESSION['category'] == "") $errors[] = "Select event category";
	if($_SESSION['country'] == "") $errors[] = "Select country";
	if($_POST['country'] == "38" && $_POST['state'] == "") $errors[] = "Select state in Nigeria";
        if($_POST['state'] == "25" && $_POST['division'] == "") $errors[] = "Select a Lagos division";
	if(isset($_POST['organizer']) && $_POST['organizer'] == "") $errors[] = "Enter event organizer";
	//else if($_SESSION['facilitator'] == "")$message = errorMsg("Please enter event facilitator");
	if($_SESSION['start_date'] == "")$errors[] = "Select the start date";
	if($_SESSION['end_date'] == "") $errors[] = "Select end date";
	if($_SESSION['website'] == "") $errors[] = "Enter event website";
	if($_SESSION['currency'] == "") $errors[] = "Select a currency type";
	if(!isValidURL($_SESSION['website'])) $errors[] = "Enter a valid url";
	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode']))$errors[] = "Invalid security code";
	
			if(count($errors) > 0){
				$message = '<div class="alert notification alert-error">
				<strong>Please attend to the following:</strong>
				<ul>';
				foreach($errors as $error){
					$message .= '<li><en>'.$error.'</em></li>';
				}
				$message .='</ul></div>';
			}
	else{
		if(isset($_SESSION['login_business'])){
			 $organiser = $_SESSION['name'];
			 $user_id = $_SESSION['user_id'];
		}
		else {
			$organiser = $_SESSION['organizer'];
			$user_id = 0;
		}
		//$date = //date("F j, Y");
                if($eventBrochure !=""){ move_uploaded_file($_FILES["brochure"]["tmp_name"], $brochureLink); }
		$date = date("Y-m-d");
		$StartDate = date("j F Y",strtotime($_SESSION['start_date']));
		$EndDate = date("j F Y",strtotime($_SESSION['end_date']));
		$NewStartDate = date("Y-m-d", strtotime($StartDate));
	if(MysqlQuery("insert into events (name,email,phone,event_title,venue,description,category,startDate,endDate,website,cost,organiser,facilitator,posted_date,SortDate,country,state,currency,comment,tags,deals,user_id,second_currency,second_cost,second_comment,third_currency,third_cost,third_comment,fourth_currency,fourth_cost,fourth_comment, vat, brochure, last_changed, changed_by, division)
										  values('".addslashes($_SESSION['entrant_name'])."','".addslashes($_SESSION['email'])."','".addslashes($_SESSION['phone'])."','".
											addslashes($_SESSION['title'])."','".addslashes($_SESSION['venue'])."','".addslashes($_SESSION['description'])."','".
											$_SESSION['category']."','".$StartDate."','".$EndDate."','".addslashes($_SESSION['website'])."','".
											addslashes($_SESSION['cost'])."','".addslashes($organiser)."','".addslashes($_SESSION['facilitator'])."','$date','$NewStartDate','".$_POST['country']."','".$_POST['state']."','".
											addslashes($_SESSION['currency'])."','".addslashes($_SESSION['comment'])."','".addslashes($_SESSION['tags'])."','".addslashes($_POST['deal'])."','".
											$user_id."','".$_SESSION['second_currency']."','".$_SESSION['second_cost']."', '".$_SESSION['second_comment']."','".$_SESSION['third_currency']."','".
											$_SESSION['third_cost']."','".$_SESSION['third_comment']."','".$_SESSION['fourth_currency']."','".$_SESSION['fourth_cost']."','".$_SESSION['fourth_comment']."','".$_SESSION['vat']."','".$eventBrochure."', '".time()."', '".$addedBy."', '".$_SESSION['division']."')")){
		AdminNotificationMail($_SESSION['title'],$_SESSION['organizer'],$date);
		reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (isset($_SESSION[$key])) $_SESSION[$key] = "";
	}
	//unset($_SESSION['entrant_name']);
	//unset($_SESSION['email']);
	unset($_SESSION['phone']);
	unset($_SESSION['title']);
	unset($_SESSION['venue']);
	unset($_SESSION['description']);
	unset($_SESSION['website']);
	unset($_SESSION['cost']);
	unset($_SESSION['organizer']);
        unset($_SESSION['vat']);
        unset($_SESSION['division']);
	header("location: add-event?type=success");
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
			$_SESSION[$key] = strip_tags($val);
	}
	//check user login table if email exist
	$checkLogin = MysqlSelectQuery("select email from user_login where email= '".$_POST['email']."'");
	$numLogin = NUM_ROWS($checkLogin);
	//check business info table if business already exist
	$checkBiz = MysqlSelectQuery("select * from businessinfo where business_name = '".$_SESSION['business_name']."'");
	$numBiz = NUM_ROWS($checkBiz);
	//check business info table if email exist
	$checkBizEmail = MysqlSelectQuery("select email from businessinfo where email= '".$_POST['email']."'");
	$numBizEmail = NUM_ROWS($checkBizEmail);
	if($_SESSION['business_name'] == "")$errors[] = "Enter your business name";
	if($numBiz > 0) $errors[] ="Business already exist, please enter another";
	if($_SESSION['buz_type'] == "")$errors[] = "Select your business type";
	if($_SESSION['email'] == "")$errors[] ="Enter your email address";
	if(!smcf_validate_email($_SESSION['email']))$errors[] ="Enter a valid email address";
	if(($numLogin > 0) || ($numBizEmail > 0))$errors[] = "Email already exist, please choose another";
	if($_POST['password'] == "")$errors[] = "Enter your password";
	if($_POST['password'] != $_POST['confirm_password'])$errors[] = "Your password does not match";
	if($_SESSION['description'] == "")$errors[] = "Enter your business description";
	if($_SESSION['address'] == "")$errors[] = "Enter your business address";
	if($_SESSION['country'] == "")$errors[] = "Select country";
	if($_POST['country'] == "38" && $_POST['state'] == "")$errors[] = "Select state in Nigeria";
        if($_POST['state'] == "25" && $_POST['division'] == "")$errors[] = "Select a Lagos division";
	if($_SESSION['buz_type'] == "Training" && $_SESSION['category'] == "")$errors[] ="Select area of specialization";
	if($_SESSION['contact_person'] == "")$errors[] ="Enter contact person";
	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode']))$errors[] = "Invalid security code";
			if(count($errors) > 0){
				$message = '<div class="alert notification alert-error">
				<strong>Please attend to the following:</strong>
				<ul>';
				foreach($errors as $error){
					$message .= '<li><en>'.$error.'</em></li>';
				}
				$message .='</ul></div>';
			}
	else{
	if(connection()){
		$hashed = md5($_POST['password']);
		
		$result = MysqlInsertQuery("insert into user_login (email,password) values ('".$_SESSION['email']."','".$hashed."')");
		$id = mysqli_insert_id($sql_connection);
	if(MysqlQuery("insert into businessinfo (business_name,email,description,address,size,capacity,contact_person,telephone,website,business_type,specialization,country,state,user_id,designation,division)
										  values('".addslashes($_SESSION['business_name'])."','".addslashes($_SESSION['email'])."','".addslashes($_SESSION['description'])."','".
											addslashes($_SESSION['address'])."','".addslashes($_SESSION['size'])."','".addslashes($_SESSION['capacity'])."','".
											addslashes($_SESSION['contact_person'])."','".addslashes($_SESSION['telephone'])."','".
											addslashes($_SESSION['website'])."','".$_SESSION['buz_type']."','".$_POST['category']."','".$_POST['country']."','".$_POST['state']."','$id','".addslashes($_SESSION['designation'])."','".@$_POST['division']."')")){
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
	header("location: upload-business-info?type=success");
		}
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
	if($_SESSION['title'] == "")$errors[] = "Please enter job title";
	if($_SESSION['experience'] == "")$errors[] = "Please select job expereince";
	if($_SESSION['type'] == "")$errors[] = "Please select job type";
	if($_SESSION['country'] == "")$errors[] = "Please select country";
	if($_SESSION['city'] == "")$errors[] = "Please enter city";
	if($_SESSION['description'] == "")$errors[] = "Please enter job description";
	if($_SESSION['company_name'] == "")$errors[] = "Please enter company name";
	if($_SESSION['contact_person'] == "")$errors[] = "Please enter contact person's name";
	if($_SESSION['telephone'] == "")$errors[] = "Please enter your telephone number";
	if($_SESSION['email'] == "")$errors[] = "Please enter your email address";
	if(!smcf_validate_email($_SESSION['email']))$errors[] = "Please enter a valid email address";
	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode'])) $errors[] = "Invalid security code";
	if(count($errors) > 0){
				$message = '<div class="alert notification alert-error">
				<strong>Please attend to the following:</strong>
				<ul>';
				foreach($errors as $error){
					$message .= '<li><en>'.$error.'</em></li>';
				}
				$message .='</ul></div>';
			}
	else{
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
	header("location: upload-vacancies?type=success");
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
			$_SESSION[$key] = strip_tags($val);
	}
	$check = MysqlSelectQuery("select email from subscribers where email='".$_SESSION['email_sub']."'");
	$checkUsername = MysqlSelectQuery("select username from subscribers where username='".$_SESSION['username']."'");
	if($_SESSION['email_sub'] == "")$errors[]="Enter your email address";
	if(!smcf_validate_email($_SESSION['email_sub']))$errors[]="Enter a valid email address";
	if($_SESSION['fname'] == "")$errors[]="Enter your firstname";
	if($_SESSION['lname'] == "")$errors[]="Enter your lastname";
	if($_SESSION['username'] == "")$errors[]="Enter your username";
	if($_POST['password'] == "")$message = errorMsg("Enter your password");
	if(!is_numeric($_SESSION['phone']))$errors[]="Enter a valid telephone number";
	if($_SESSION['address'] == "")$errors[]="Enter your address";
	if($_SESSION['state'] == "")$errors[]="Enter your state";
	if($_SESSION['country'] == "")$errors[]="Eelect your country";
	if($_SESSION['category'] == "")$errors[]="Select category your interested in";
	if(NUM_ROWS($check) > 0){$errors[]="Email already exists!";}
	if(NUM_ROWS($checkUsername) > 0){$errors[]="Username already exists!";}
			
	if($_SESSION['smartCheck']['securitycode']!= md5($_POST['securitycode'])) $errors[] = "Invalid security code";

	if(count($errors) > 0){
				$message = '<div class="alert notification alert-error">
				<strong>Please attend to the following:</strong>
				<ul>';
				foreach($errors as $error){
					$message .= '<li><en>'.$error.'</em></li>';
				}
				$message .='</ul></div>';
			}
	else{
	if(connection()){
		if(MysqlQuery("insert into subscribers (email,fname,lname,phone,organization,country,city,state,address,category,sex,username,designation,password,reg_date)
										  values('".addslashes($_SESSION['email_sub'])."','".addslashes($_SESSION['fname'])."','".addslashes($_SESSION['lname'])."','".
											addslashes($_SESSION['phone'])."','".addslashes($_SESSION['organization'])."','".$_SESSION['country']."','".
											addslashes($_SESSION['city'])."','".addslashes($_SESSION['state'])."','".
											addslashes($_SESSION['address'])."','".$_SESSION['category']."','".$_POST['sex']."','".$_POST['username']."','".$_SESSION['designation']."','".md5($_SESSION['password'])."','".date('Y-m-d')."')")){
		
	$id = mysqli_insert_id($sql_connection);
	
	//add selected event to calendar
			if(!empty($_POST['addToCal'])){
				//decode encoded get val
				$event = base64_decode($_POST['addToCal']);
				// query the db
				$result = MysqlSelectQuery("select * from my_events where event_id='".$event."' and subscriber_id = $id");
				if((NUM_ROWS($result) == 0)){
							MysqlInsertQuery("insert into my_events (subscriber_id, event_id, date_added) values('$id','".$event."','".date('Y-m-d')."')");
							
				$_SESSION['fullname'] = $_SESSION['fname']." ".$_SESSION['lname'];
					}
			}
	
	$to = $_SESSION['email_sub'];
	$hashId = md5($id);
	$subject = "Confirm your subscription";
	$message = "<p>Dear ".$_SESSION['fname']." ".$_SESSION['lname'].",<br \> Your Login details are Email: ".$_SESSION['email_sub']."Password : ".$_POST['password']." <br /> Thank you for your subscription. </p><p style='position: relative;left: 20%;width: 300px;height: 30px;background-color: seagreen;padding: 10px;border-radius: 10px; text-align: center;'><a style='color:white; text-decoration:none' href='http://www.nigerianseminarsandtrainings.com/confirmation?type=email&g=$id&user=$hashId' >click here to confirm your subscription.</a></p>";
	
	SendNewsEmails($to,$subject,$message,"","");
	
	reset ($subscribers);
	while (list ($key, $val) = each ($vacancies)) {
		if (isset($_SESSION[$key])) unset($_SESSION[$key]);
	}
	header("location: subscribers?type=success");
			}
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