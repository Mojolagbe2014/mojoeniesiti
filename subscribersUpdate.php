<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($subscribers);
	while (list ($key, $val) = each ($subscribers)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
$advert = "Subscribers";
//require_once("scripts/insertions.php");	
$random = random(8);

if(isset($_GET['id'])){
	
	$query="select * from categories,subscribers  WHERE  subscriber_id='".$_GET['id']."' and category_id=category ";
	
	$result=MysqlSelectQuery($query);
	$rowsSub=SqlArrays($result);
	
	}
	
	if(isset($_POST['changeInterest'])){
	MysqlQuery("update subscribers set category='".$_POST['category']."' where subscriber_id='".$_GET['id']."'");
	header('location: subscribersUpdate?id='.$_GET['id'].'&suc=updated');
	 }
	if(isset($_GET['suc'])){ 
$message = successMsg("Your watch List have been changed!");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Subscribe to event updates on Nigerian seminars and trainings.com </title>
<meta name="description" content="Subscribe to Nigerian Seminars and Trainings.com to get the latest news and updates on events and learning opportunities around the world."/>

	
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<?php include("scripts/headers_new.php");?>
 <script type="text/javascript">
$().ready(function() {
	// validate the comment form when it is submitted
	$("#contactform2").validate({
			rules:{
				fname: {
				required:true,
				minlength: 2
				},
				lname: {
				required:true,
				},
				country: {
				required:true,
				},
				category: {
				required:true,
				},
				state: {
				required:true,
				},
				city: {
				required:true,
				},
				organization:{
					required: true,
					minlength: 2
				},
				email_sub:{
					required: true,
					email:true
				},
				phone:{
					required: true,
					number: true
				},
				address:{
					required: true,
				},
				verify:{
					required: true,
				}
				
			}		
		});
	});

	</script>
	
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-2fH5lI6K2ceJA"
});
</script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->


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
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;"><p>Change category of interest on watch list</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				<div id="subpage">
					
					<div id="subpage_content">
						
						<div id="contact-wrapper" class="rounded">
                           <?php echo $message;?>
						  <div id="contact-wrapper-inner" class="rounded">
                        
						  
						    <form action="" method="post" id="contactform2">
                           
						      <table width="100%"  height="212" border="0">
						       <tr>
						          <td height="43" align="right" valign="bottom"><span class="contact-left">Interetsted in:</span></td>
						          <td colspan="3" valign="bottom"><select name="category" id="category2" class="input">
                                  <option><?php echo $rowsSub['category_name'];?></option>
						            <?php 
	if(connection());
	$result = MysqlSelectQuery("select * from categories order by category_name");?>
						            
						            <?php while ($rows = SqlArrays($result)){?>
						            <option value="<?php echo $rows['category_id'];?>"><?php echo $rows['category_name'];?></option>
						            <?php
		}
	?>
					              </select></td>
					            </tr>
						        
						        <tr>
						          <td align="right">&nbsp;</td>
						          <td colspan="3" valign="top"><input name="changeInterest" type="submit" class="button_bg" value="Change" /></td>
					            </tr>
					          </table>
					        </form>
					      </div>
					 </div>
						 
						 <div id="contact-info">
						 
						 </div>
					</div>
                    </div>
				</div><!-- end subpage -->
				
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