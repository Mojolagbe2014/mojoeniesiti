<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true && !isset($_SESSION['premium'])){
	//redirect back to login page if login session is not set
	header('location: ../login');
	exit;
}
if(connection());
$result = MysqlSelectQuery("select * from businessinfo where user_id='".@$_SESSION['user_id']."'");
$rows = SqlArrays($result);
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

// now simply call the function
$geolocation = getLatLng($opt);
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

	<title><?php echo $rows['business_name'];?>: Nigerian Seminars and Trainings </title>
    
	<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/prettyphoto.css" type="text/css" media="screen" />
    <?php include("../scripts/headers.php");?>
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="../js/chili-1.7.pack.js"></script>
	<script type="text/javascript" src="../js/jquery.cycle.all.min.js"></script>
	<script type="text/javascript" src="../js/jquery.easing.1.1.1.js"></script>
  
<script type="text/javascript" src="../js/jquery.js"></script>
<script src="http://maps.google.com/maps?file=api&v=2&sensor=true&key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs" type="text/javascript"></script>
<script type="text/javascript" src="../js/jquery.gmap-1.0.3-min.js"></script>
 <script type="text/javascript" src="../js/gps.jquery.js"></script>
<script type="text/javascript" src="../js/jquery.prettyphoto.js"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header2.php");?>

<div id="main">
	<div id="content_bar">
		<div id="content_nav">
			<ul id="main_content_slider">
				<li><a href="#" class="activeSlide"><strong>Business Profile</strong></a></li>
			</ul>
		</div>
		<div id="search">
        <h4 style="display:block; padding:5px 3px 3px 3px;"><?php echo "Welcome, ".$_SESSION['name'];?></h4>
			<!--<form action="test.php" method="post">
                <input onblur="if(this.value == '') this.value='Search' ;" onfocus="if(this.value == 'Search') this.value='';" value="Search" type="text" />
            </form>-->
		</div>
	</div>
	<div id="content">
		<div id="content_left">
			
		
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
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						     <form action="" method="post" id="contactform2">
						       <table width="100%" border="0">
						         <tr>
						           <td width="21%"><strong>Busiess Name:</strong></td>
						           <td width="64%"><?php echo $rows['business_name'];?></td>
						           <td width="15%" rowspan="7"><img  class="img_mix" src="<?php echo $image;?>" width="150" height="150" /></td>
					             </tr>
						         <tr>
						           <td><strong>Business Type:</strong></td>
						           <td><?php echo $rows['business_type'];?></td>
					             </tr>
						         <tr>
						           <td><strong>Email:</strong></td>
						           <td><?php echo $rows['email'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Address:</span></strong></td>
						           <td><?php echo $rows['address'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Size:</span></strong></td>
						           <td><?php echo $rows['size'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Capacity</span></strong></td>
						           <td><?php echo $rows['capacity'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Contact Person:</span></strong></td>
						           <td><?php echo $rows['contact_person'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Telephone:</span></strong></td>
						           <td colspan="2"><?php echo $rows['telephone'];?></td>
					             </tr>
						         <tr>
						           <td><strong><span class="contact-left">Website:</span></strong></td>
						           <td colspan="2"><?php echo $rows['website'];?></td>
					             </tr>
					           </table>
					         </form>
					       </div>
					  </div>
                      <script type="text/javascript">
$(function() {
    $("#map_canvas").gMap
	({ controls: false,
	   scrollwheel: false,
	   markers: [{ latitude:	<?php echo $geolocation['lat'];?>,
                   longitude: <?php echo $geolocation['lon'];?>,
				    html: "<?php echo $rows['address'];?>",
                              popup: true }],
	   zoom: 15   
	});
});
</script>
						 <div id="contact-info">
						   
					     </div>
					</div>
                    <div id="subpage_content">
						 <h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Business Description </h1>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						   <div class="description"><?php echo $rows['description'];?></div>
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                    <div id="subpage_content">
						 <h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Business Images</h1>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						    <div class="video_box">
                  <?php
			$images = MysqlSelectQuery("select * from pictures where user_id='".$rows['user_id']."'");
				if(NUM_ROWS($images) > 0){

					while($rows_pic = mysql_fetch_array($images)){

						?>

				  <div class="gallery" id="<?php echo $rows_pic['image_id'];?>"><a href="<?php echo SITE_URL;?>user/images/<?php echo $rows_pic['images'];?>" rel="prettyPhoto[web]"><img  class="img_mix" src="<?php echo SITE_URL;?>user/images/<?php echo $rows_pic['images'];?>" width="100" height="100" alt="<?php echo $rows['business_name'];?>" /></a></div>


  <?php
		}

			}

   else{

   echo errorMsg("found no images for this business");

   }

					 ?>

                </div>
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                     
                    <div id="subpage_content">
						<h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Our Location</h1>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						     <div id="map_canvas" style="width: 100%; height: 220px"></div>
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                    <div id="subpage_content">
						<h1 class="premium-header" style="margin-top:5px; margin-bottom:5px;">Options</h1>
						 <div id="contact-wrapper" class="rounded">
						   <div id="contact-wrapper-inner" class="rounded">
						   <table width="100%">
                           <tr>
						           <td width="17%" height="44" align="left"><strong><a href="edit_profile"><img src="../images/edit-icon.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Edit Profile</a></strong></td><?php
								   $result = MysqlSelectQuery("select premium from events where premium = 1 and  user_id='".@$_SESSION['user_id']."'");
								   ?>
						           <td width="51%" align="left"><!--Premuim Listing used --><?php //echo NUM_ROWS($result)."  of ".$_SESSION['space'];?></td>
						           <td width="15%" align="left"><strong>Expiration Date : </strong></td>
						           <td width="17%" align="left" style="color:#F00;"><?php  
								   echo date("F j, Y",strtotime($rowsExp['exp_date']));
								   
								   ?></td>
                           </tr>
                           </table>
					       </div>
					  </div>
						 <div id="contact-info">
						   
					     </div>
					</div>
                    </div>
				</div><!-- end subpage -->
					
		</div>
		<?php include("../tools/side-menu.php");?>
	</div>
	<div id="content_bottom"></div>
	
	<div class="clearfix"></div>
</div>
	<?php include("userstools/footer.php");?>
</div>
</div>
</body>
</html>