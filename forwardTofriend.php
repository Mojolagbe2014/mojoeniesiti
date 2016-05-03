<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($add_event);
	while (list ($key, $val) = each ($add_event)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Add Event";
if(!isset($_GET['user'])&& !isset($_GET['msgid']) && !isset($_GET['action'])){
	header("location: ".SITE_URL);
}
$result_sub = MysqlSelectQuery("select email,fname,lname from subscribers where email='".$_GET['user']."'");
$rows_sub = SqlArrays($result_sub);

if(isset($_POST['send'])){
	$result = MysqlSelectQuery("select * from sentMessages where msgID='".$_GET['msgid']."'");
	$rows = SqlArrays($result);
	if(empty($_POST['name'][0]) || empty($_POST['email'][0])){$message = errorMsg("You must send to at least one friend!");}
	else{
	for($i=0; $i <count($_POST['name']); $i++){
		
		$name = $_POST['name'][$i];
		$email = $_POST['email'][$i];
		if(isset($email) && !smcf_validate_email($email)){
			$message = errorMsg("You have entered and invalid email in one of the email fields!");
			}
			else{
				$FriendMessage = "<p>Dear ".$name.",<br \> ";
				$FriendMessage .= $_POST['message']."<br />";
				$FriendMessage .= "<hr />";
				$msg = $rows['Content'];
				//
				$subject = $rows_sub['fname']." ".$rows_sub['lname']." Forworded a message to you";
				SendHtmlEmails($email,$subject,$msg,$rows['msgID'],$FriendMessage);
				
			}
			header('location: '.SITE_URL.'forwardTofriend?user='.$_GET['user'].'&token='.md5($_GET['user']).'&msgid='.$_GET['msgid'].'&action=sendtofriend&seq='.md5('sendtofriend').'&flg=success');
		}
	}
}
if(isset($_GET['flg']) && $_GET['flg']=='success'){
	$message = successMsg("Thank you, your mail has been forwarded to your friends");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include('tools/analytics.php');?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Forward to a friend :: Nigerian Seminars and Trainings.com</title>

<meta name="description" content="Forward to a friend"/>
	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
   
	<?php include("scripts/headers_new.php");?>

    
</head>

<body>

<?php include("tools/header_new.php");?>

<div id="main">
	
	<div id="content">
    
  <?php include("tools/categories_new.php");?>
       
		<div id="content_left">
        
        <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Forward to a Friend</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
		
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper-inner" class="rounded">
						  <?php echo $message;?>
                          <p><strong>Forward this newsletter message to a friend</strong></p>
						    <form action="" method="post" id="contactform2">
							
						      <table width="100%" border="0">
						        <tr>
						          <td align="right">Your Email Address:</td>
						          <td colspan="2"><?php echo $_GET['user'];?></td>
					            </tr>
						        <tr>
						          <td width="21%" align="right">Your Name:</td>
						          <td colspan="2"><span class="contact-left">
						            <input name="name_send" type="text" disabled="disabled" class="input" id="name_send" size="40" value="<?php echo $rows_sub['fname']." ".$rows_sub['lname'];?>" />
					              <br />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td colspan="2">&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right">Friend 1: Name</td>
						          <td colspan="2"><span class="contact-left">
						            <input name="name[]" type="text" class="input" id="name1" size="40" />
						            </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Friend 1: Email</span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="email[]" type="text" class="input" id="email" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td>&nbsp;</td>
						          <td>&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Friend 2: Name</span></td>
						          <td width="38%"><span class="contact-left">
						            <input name="name[]" type="text" class="input" id="name1" size="40" />
						            </span></td>
						          <td width="41%">&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right" valign="top"><span class="contact-left">Friend 2: Email</span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="email[]" type="text" class="input" id="email2" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right" valign="top">&nbsp;</td>
						          <td colspan="2">&nbsp;</td>
					            </tr>
						        <tr>
						          <td align="right" valign="top"><span class="contact-left">Friend 3: Name</span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="name[]" type="text" class="input" id="name1" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right"><span class="contact-left">Friend 3: Email </span></td>
						          <td colspan="2"><span class="contact-left">
						            <input name="email[]" type="text" class="input" id="name2" size="40" />
						          </span></td>
					            </tr>
						        <tr>
						          <td align="right"></td>
						          <td colspan="2" style="color:#F00;"><label>
						           Maximum of  
						               <input name="counter" type="text" style="color:#F00;" disabled="disabled" id="counter" value="100" size="3" />  Characters remaining
					              </label></td>
					            </tr>
						        <tr>
						          <td align="right">Add message</td>
						          <td colspan="2"><label>
						            <textarea name="message" id="message" cols="45" rows="5" onkeyup="textCounter(this,'counter',100);"></textarea>
					              </label>
                                  <script>
function textCounter(field,field2, maxlimit)
{
 var countfield = document.getElementById(field2);
 if ( field.value.length > maxlimit ) {
  field.value = field.value.substring( 0, maxlimit );
  return false;
 } else {
  countfield.value = maxlimit - field.value.length;
 }
}
</script>
                                  </td>
					            </tr>
						        <tr>
						          <td align="right"></td>
						          <td colspan="2"><input name="send" type="submit" class="button_bg" id="send" value="Send" /></td>
					            </tr>
					          </table>
					        </form>
						    <div id="listingAJAX"></div>
					      </div>
						</div>
						
					</div>
                    
				</div>
                
                </div>
                <!-- end subpage -->
				<?php //include("tools/categories.php");?>	
		</div>
		
		<?php include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
	
</div>

</div>
<?php include ("tools/footer_new.php");?>
</body>
</html>