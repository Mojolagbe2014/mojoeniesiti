<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: '.SITE_URL.'login');
	exit;
}
if (isset($_SESSION['update_password_info'])) {
  $message = $_SESSION['update_password_info'];
  $_SESSION['update_password_info'] = '';
}
if(connection());
$result = MysqlSelectQuery("select * from businessinfo where user_id='".@$_SESSION['user_id']."'");
$rows = SqlArrays($result);
$_SESSION['BIZ_ID'] = $rows['business_id'] ;
$result2 = MysqlSelectQuery("select * from logos where user_id='".@$_SESSION['user_id']."'"); 
if(NUM_ROWS($result2) == 0){
	$image = "../images/no_icon.gif";
}
else{
	$rows_logo = SqlArrays($result2);
	$image = "logos/thumbs/".$rows_logo['logos'];
}
$advert = "Vacancy Detail";
$opt = array (
	'address' => urlencode($rows['address']),
	'sensor'  => 'false'
);
$cat =  MysqlSelectQuery("select * from categories where category_id = '".$rows['specialization']."'");
	$rows_cat = SqlArrays($cat);
switch ($rows['business_type']){
		case 'Training':
		$biz_type = 'Training Provider';
		break;
		case 'Suppliers':
		$biz_type = 'Equipment Suppliers';
		break;
		case 'Managers':
		$biz_type = 'Event Managers';
		break;
		case 'Venues':
		$biz_type = 'Event Managers';
		break;
		default:
		$biz_type ='';
}
$GetAdverts = new Adverts;
// now simply call the function
$geolocation = getLatLng($opt);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo $rows['business_name'];?> : Nigerian Seminars and Trainings </title>
	<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<!-- <link rel="stylesheet" href="../style.css" type="text/css" media="screen" />-->
  <link rel="stylesheet" type="text/css"  href="<?php echo SITE_URL;?>premium/css/prettyphoto.css">
  <?php include("../scripts/headers_new.php");?>
  <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery-1.4.2.min.js"></script> 
  <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.prettyphoto.js"></script> 
  <script type="text/javascript" src="https://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&sensor=true"></script>
  <script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.gmap-1.0.3-min.js"></script>
  <link rel="stylesheet" href="../js/lightbox/venobox.css" type="text/css" media="screen" />
  <script type="text/javascript" src="../js/lightbox/venobox.min.js"></script>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $("a[rel^='prettyPhoto']").prettyPhoto();
    });
    $(document).ready(function(){
  	/* default settings */
    	$('.venobox').venobox(); 
    	/* open content with custom settings */
    	$('.preview').venobox({
    		framewidth: '300px',
    		frameheight: '250px',
    		border: '6px',
    		bordercolor: '#ba7c36',
    		numeratio: true
  	});
  });
</script>
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
</head>
<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header_new.php");?>
<div id="main">
<div id="content">
<?php include('userstools/menu.php');?>
<div id="content_left">
<div class="event_table_inner smart-forms">
  <form action="" method="post">
    <table width="100%" border="0">
      <tr>
        <td width="20%" rowspan="2" align="center" style="padding-left:8px">
          <?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
    			<img src="<?php echo $image;?>" width="90" height="90" alt="<?php echo $rows['business_name'];?>" class="articleImg shadow " />
          <?php }?>
        </td>
        <td height="93" colspan="2" align="center"><h2 style="font-size:25px; text-align:center; "><p><?php echo $rows['business_name'];?></p></h2>
        </td>
      </tr>
      <tr>
        <td width="33%" align="right" style="padding-right:5px;"> 
        </td>
        <td width="47%" align="left" style="padding-left:5px;">   
        </td>
      </tr>
    </table>
  </form>
</div>
<div id="tab_slider">
	<div id="subpage">
		<div id="subpage_content">
      <?php 
      $resultExp = MysqlSelectQuery("select exp_date from user_login where user_id='".@$_SESSION['user_id']."'"); 
  		$rowsExp = SqlArrays( $resultExp);
  		//Grace period expiration
  		$dateExp =  strtotime($rowsExp['exp_date']."+ 2weeks");
  		$GraceDate = date("Y-m-d", $dateExp);
  		//two weeks before expiration date set
  		$dateBefore =  strtotime($rowsExp['exp_date']."- 2weeks");
  		$ReminderDate = date("Y-m-d", $dateBefore);
  		if((date('Y-m-d') >= $ReminderDate) && (date('Y-m-d') <= $rowsExp['exp_date'])){
  		?>
    <div id="contact-wrapper" class="rounded">
  		<div id="contact-wrapper-inner" class="rounded" style="background-color:#FDFCCE; color:#FF5C0F">
  			<table width="100%" >
          <tr>
  					<td height="44" align="left">Your account will expire on <strong><?php echo date("F j, Y",strtotime($rowsExp['exp_date']));?></strong>, Please renew your account to avoid service suspension.</td>
  				</tr>
        </table>
  		</div>
		</div>
      <?php
			}
			else if((date('Y-m-d') > $rowsExp['exp_date']) && (date('Y-m-d') <= $GraceDate)){
			?>
      <?php if ($message) { echo($message);} ?>
		<div id="contact-wrapper" class="rounded">
			<div id="contact-wrapper-inner" class="rounded" style="background-color:#FFDDE6; color:#C20110;">
				<table width="100%" >
          <tr>
						<td height="44" align="left">Your account has expired, but you are currently enjoying a grace period of two weeks which will end on <strong><?php echo date("F j, Y",strtotime($GraceDate));?></strong> Please note that your account will be suspended if no renewal occurs after this day.</td>
				  </tr>
        </table>
			</div>
		</div>
    <?php
		}?>
  </div>
    <div class="" style="float:left; width:97%; height:50px; margin-top:10px; margin-bottom:10px; background-color:#FFFFFF;">
      <form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
        <table border="0" style="float:left; width:100%;">
          <tr>
            <td width="79%" style="padding-left:8px; text-align:center;"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-briefcase"></i>&nbsp; Business Profile</h2></td>
            <td width="21%" style="padding-left:8px"><strong><a href="edit_profile"><img src="../images/edit-icon.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Edit Profile</a></strong></td>
            </tr>
        </table>
      </form>
    </div>  
           <div class="TrainingProvider">
            <div class="infoBox">
                <div class="innerHeading">
                   <p>Business Type</p>
                   <span ><?php echo $biz_type ;?></span></div>
                    <div class="innerHeading">
                      <p>Email</p>
                      <span id="email" onclick="showEmail()" style="cursor:pointer; font-size:12px; text-decoration:underline;"><?php echo $rows['email'];?></span></div>
                      <div class="innerHeading last">
                      <p>Telephone</p>
                      <span id="Phone1" onclick="showPhone()" style="cursor:pointer; font-size:12px;text-decoration:underline;"><?php echo $rows['telephone'];?></span>
                    </div>
                </div>
                <div class="infoBox" style="float:right;">
                <div class="innerHeading">
                   <p>Specialization</p>
                   <span ><?php echo $rows_cat['category_name'];?></span></div>
                   <div class="innerHeading">
                      <p>Contact Person</p>
                      <span><?php echo $rows['contact_person'];?></span></div>
                      <div class="innerHeading last">
                        <p>Website</p>
                        <span id="website" onclick="showWeb()" style="cursor:pointer; font-size:12px; text-decoration:underline;"><?php echo $rows['website'];?></span>
                      </div>
                    </div>
                    <div class="innerHeading">
                      <p>Address</p>
                      <span style="height:auto;"><?php echo $rows['address']?></span></div>
                      <?php if($rows['business_type'] != 'Training'){;?>
                      <div class="innerHeading" style="width:99%; margin-right:0px; padding-right:0px;">
                          <p>Size</p>
                          <span><?php echo $rows['size'];?></span></div>
                            <div class="innerHeading" style="width:99%; margin-right:0px; padding-right:0px;">
                              <p>Capacity</p>
                              <span><?php echo $rows['capacity'];?></span></div>
                              <?php }?>
                              <div class="trainingProviders">
                                <p><strong>Business Description</strong></p>
                                <span class="description"><?php echo stripslashes($rows['description']);?></span>
                              </div> 
                              <?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
                              <div class="trainingProviders">
                                <p><strong>Business Images</strong></p>
                                <span style="padding-left:20px;">
                                <?php
	                              $images = MysqlSelectQuery("select * from pictures where user_id='".$rows['user_id']."'");
		                            if(NUM_ROWS($images) > 0){
			                            while($rows_pic = SqlArrays($images)){
				                          ?>
		                              <div class="gallery" id="<?php echo $rows_pic['image_id'];?>">
                                    <a href="<?php echo SITE_URL;?>premium/images/<?php echo $rows_pic['images'];?>" rel="prettyPhoto[web]"><img  class="img_mix" src="<?php echo SITE_URL;?>premium/images/<?php echo $rows_pic['images'];?>" width="90" height="90" alt="<?php echo $rows['business_name'];?>" /></a>
                                  </div>
                                <?php
                                  }
	                              }else{
                                  echo '<div class="smart-forms"><div class="alert notification alert-info">No images for this business</div></div>';
                                }
			                          ?>
                                <div class="clearfix"></div>
                            </div>
                           
                            <?php
			                       }
			                     ?>
                          <div class="infoBox"></div>
                        </div>      
                        <div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px; background-color:#FFFFFF;">
                          <form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
                            <table border="0" style="float:left; width:100%;">
                              <tr>
                                <td width="31%" style="padding-left:8px"> <span style="font-size:18px; padding:5px; color:#FF0000;">Account Expiration:</span></td>
                                <td width="69%" align="left" style="padding-left:8px; color:#F00;"><span style="font-size:18px; padding:5px;">
                                <?php  
					                          echo date("F j, Y",strtotime($rowsExp['exp_date']));
					                      ?>
                                </span></td>
                              </tr>
                            </table>
                          </form>
                        </div>
                      </div>
		                </div><!-- end subpage -->
	                 </div>
                <?php include("../tools/side-menu_new.php");?>
             </div>
             <div class="clearfix"></div>
          </div>
        	<?php include("../tools/footers_new.php");?>
      </div>
    </div>
  </body>
</html>