<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';$update_message='';
if (isset($_SESSION['update_password_info'])) {
	$update_message = $_SESSION['update_password_info'];
	$_SESSION['update_password_info'] = '';
}
if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}

if(connection());
	
if(isset($_SESSION['user_id'])){
	$result = MysqlSelectQuery("select * from businessinfo where user_id='".$_SESSION['user_id']."' ");
	$rows = SqlArrays($result);
	$_SESSION['BIZ_ID'] = $rows['business_id'] ;
	$_SESSION['email']=$rows['email'];

}


$advert = "Training Providers";
function FormatSrting($stringVal,$int){
	$string = strip_tags($stringVal);
	$string = substr($string,0,$int);
	 return $string ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-23693392-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title><?php echo $rows['business_name'];?> | Nigerian Seminars and Trainings</title>
<meta name="description" content="" />
<meta property="og:image" content="<?php if($rows['premium'] == 3 || $rows['premium'] == 2){ echo $image; } else {echo SITE_URL.'images/facebookIMG.png';}?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>


   <?php include("../scripts/headers_new.php");?>
   





<style>

 .pastSearch {
background: -webkit-gradient(linear, bottom, left 175px, from(#FFF3D5), to(#FFF9EA));
background: -moz-linear-gradient(bottom, #FFF3D5, #FFF9EA 175px);
margin:auto;
position:relative;
width:680px;



line-height: 24px;

text-decoration: none;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
padding:10px;
border: 1px solid #999;
border: inset 1px solid #333;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
margin-top:10px;
border-bottom:5px;
}
.buttonContact {
width:100px;
position:absolute;
right:20px;
bottom:20px;
background:#09C;
color:#fff;
font-family: Tahoma, Geneva, sans-serif;
height:30px;
-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;
border: 1p solid #999;
}

.buttonContact:hover {
background:#fff;
color:#09C;
}
.input    {
width:375px;
display:block;
border: 1px solid #999;
height: 25px;
padding-left:3px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.clearlines tr td{
	border:none;
	padding:5px;
}
.input1 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.input1 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
    .input2 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.input2 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.wide{
	height:150px;
}
.clickAction{
	border-radius:5px;
	padding:3px;
	background-color:#090;
	color:#FFF;
	font-size:11px;
	cursor:pointer;
}
.shadows{
	-moz-box-shadow: 3px 3px 4px #000;
-webkit-box-shadow: 3px 3px 4px #000;
box-shadow: 3px 3px 4px #000;
/* For IE 8 */
-ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000')";
/* For IE 5.5 - 7 */
filter: progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#000000');
width:100px; height:100px;
	
}
</style>
   
	
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
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

<?php include("../tools/header_new.php");?>
<div id="main">
	
	<div id="content">
    
  
                  
				 
    
    <?php include("menu.php");?>
	  <div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-briefcase"></i>&nbsp; Business Information</h2></td>
    <td width="21%" style="padding-left:8px">&nbsp;</td>
    </tr>
  
</table>
</form>
</div>
<div id="tab_slider">
				<div id="subpage">
					
					<div id="subpage_content">
							<?php if ($update_message) { echo($update_message);} ?>
						   <div id="contact-wrapper-inner" class="rounded">
						     <form action="" method="post" id="contactform2">
						       <table width="100%" border="0">
						         <tr>
						           <td width="20%"><strong>Busiess Name:</strong></td>
						           <td colspan="2"><span style="color:#090; font-size:14px; text-transform:capitalize;"><strong><?php echo $rows['business_name'];?></strong></span></td>
						           <td width="18%" rowspan="7" valign="top"></td>
					             </tr>
						         <tr>
						           <td><strong>Business Type:</strong></td>
						           <td colspan="2"><?php echo $rows['business_type'];?> </td>
					             </tr>
						         <tr>
						           <td><strong>Email:</strong></td>
						           <td colspan="2"><?php echo $rows['email'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Address:</span></strong></td>
						           <td colspan="2"><?php echo $rows['address'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Size:</span></strong></td>
						           <td colspan="2"><?php if($rows['size'] != '') echo $rows['size']; else echo 'NIL';?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Capacity</span></strong></td>
						           <td colspan="2"><?php if($rows['capacity'] != '') echo $rows['capacity']; else echo 'NIL';?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Contact Person:</span></strong></td>
						           <td colspan="2"><?php if($rows['contact_person'] != '') echo $rows['contact_person']; else echo 'NIL';?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Telephone:</span></strong></td>
						           <td colspan="2"><?php echo $rows['telephone'];?></td>
                                 </tr>
                                 
						         <tr>
						           <td><strong><span class="contact-left">Website:</span></strong></td>
						           <td width="46%"><?php echo $rows['website'];?></td>
						           <td width="46%">&nbsp;</td>
						           <td>&nbsp;</td>
                                   
					             </tr>
						         
					           </table>
					         </form>
					       </div>
					  </div>
                   
					<div id="contact-info">
    </div>
					</div>
                    
                    <div id="subpage_content">
						 <h2 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Business Description</h2>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded" style="line-height:20px; text-align:justify;">
						   <div class="description"><?php echo stripslashes($rows['description']);?></div>
					       </div>
					  </div>
						 <div id="contact-wrapper-inner" class="rounded" style="background-color:#FDFCCE; color:#FF5C0F">
                            
						   <table width="100%" >
                           <tr>
                               <td width="41%" height="44" align="left"><p class="topsubscribe" style="margin:0px;"><a href="<?php echo SITE_URL;?>premium-listing" target="_blank">Upgrade to Our Premium Listing</a></p></td>
						           <td width="59%" align="left"></td>
				             </tr>
                           </table>
                        
				         </div>
					</div>
		  </div>
		</div><!-- end subpage -->
					
		</div>
		
        
       
		<?php include("../tools/side-menu_new.php");?>
	</div>

	<div class="clearfix"></div>
</div>
	
	
	
</div>

</div>
<?php include('../tools/footer_new.php');?>
<script>
       $(document).ready(function() {
            $("#hamburger").click(function(e) {
            $("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
            $("#main-menu").toggleClass("mobile-hide");
        });
        $(".mobile-show > a").click(function(e) {
            e.preventDefault();
            $(this).parent().children("ul").toggle();
        });

    });
</script>
</body>
</html>