<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$message = '';
$paged = "";
	if(connection());
	if(!isset($_SESSION['login_business']) && $_SESSION['login_business'] != true){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}
	$recordperpage = 10;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;
$advert = "Add Event";
$result = MysqlSelectQuery("select * from events WHERE event_title like '%".$_GET['query']."%' and user_id = '".$_SESSION['user_id']."' ORDER BY SortDate limit $offset, $recordperpage");
?>
<!DOCTYPE html>

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
<link href="../images/favicon.ico" rel="shortcut icon" type="image/x-icon" />


	<title>Search posted courses : Nigerian Seminars and Trainings.com </title>

<meta name="description" content="search for your current / upcoming conferences, training seminars, workshops, trade fairs and exhibitions to our large and rapidly expanding database (free)."/>
	

    <?php include("../scripts/headers_new.php");?>
    <link rel="stylesheet" href="../css/cmxform.css" type="text/css" media="screen" />
	<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
    <script src="../js/jquery.validate.js" type="text/javascript"></script>
    <script type="text/JavaScript" src="../js/calender.js"></script>
    
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->
<?php include("../tools/header_new.php");?>

<div id="main">
	<?php include("menu.php");?>
     
		<div id="content_left">
			
		<div class="event_table_inner" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table border="0" style="float:left; width:100%;">
  
  <tr>
    <td width="79%" style="padding-left:8px"><h2 style="font-size:18px; padding:5px;"><i class="fa fa-search"></i>&nbsp; Search uploaded events</h2></td>
    <td width="21%" style="padding-left:8px">&nbsp;</td>
    </tr>
  
</table>
</form>
</div>			
			
		
<div id="tab_slider">
				<div id="subpage">
					<div class="event_table_inner smart-forms" style="float:left; width:97%; margin-top:10px; margin-bottom:10px;  background-color:#FFFFFF;">

<form action="search_events" method="get">
<table width="100%" border="0">
  <tr>
    <td width="77%" style="padding-left:8px"><label class="field append-icon">
                                    <input type="text" name="query" id="query" class="gui-input" placeholder="Search posted events" style="width:500px;">
          <label for="firstname" class="field-icon"><i class="fa fa-search"></i></label>  
                                    
                                </label>
    </td>
    <td colspan="2">    <button class="button btn-primary" type="submit">Search</button><input name="search" type="hidden" value="1" /></td>
    <td width="11%"></td>
  </tr>
</table>
</form>
</div>
					<div id="subpage_content">
						<?php echo $message;?>
						<div id="contact-wrapper" class="rounded">
						  <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">

                <?php

				if(NUM_ROWS($result) > 0){

							?>

					<table width="100%" id="listTable">

                    <?php 

					$i = 1;

					while($rows = SqlArrays($result)){

						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
						if($rows['premium'] == 1){
						$plan ='<br/><img src="../images/email/premium.png" />';
						}
						else if($rows['makePremium'] == 1){
						$plan ='<br/><strong style="color:#F00"><em>Request to make premium</em></strong>';
						}
						else{
							$plan = "";
						}
						if($rows['status'] == 1){ $status = "Activated"; $color='#090';} else {$status = "Pending activation"; $color='#F00';}

						?>

  <tr bgcolor="<?php echo $bg;?>">

    <td width="5%"><img src="<?php echo SITE_URL;?>images/star.png" width="22" height="23" /></td>

    <td width="75%"><p><a href="<?php echo SITE_URL."events/".$rows['event_id']."/".str_replace($title_link,"-",substr($rows['event_title'],0,150))."/";?>"><?php echo $rows['event_title'];?></a></p>


      <p ><strong style="color:#090; font-size:11px">Duration: </strong><?php echo dateDiff($rows['startDate'], $rows['endDate']);?><?php echo $plan;?></p>
       <p ><strong style="color:<?php echo $color;?>; font-size:11px"><?php echo $status;?> </strong></p>
      </td>

    <td width="20%"><img src="../images/icon_clock.png" width="10" height="10" /> <?php echo date('F j, Y', strtotime($rows['startDate']));?><br /><br /><a href="edit_event?val=<?php echo $rows['event_id'];?>" style="font-size:10px" title="edit"><img src="../images/edit-icon.png" width="12" height="14" alt="edit-icon" style="float:left; margin-right:5px" /></a>
    <!--<a href="#" style="font-size:10px" title="Delete" class="delete" id="<?php //echo $rows['event_id'];?>"><img src="../images/cancel.png" width="12" height="14" alt="edit-icon" style="float:left; margin-right:5px" /></a>--></td>

  </tr>

  <?php

  $i++;

					}

					?>

  

   </table>

   <?php

   if(connection()){

                    Paging("SELECT COUNT(event_id) AS numrows FROM events where user_id='".$_SESSION['user_id']."' and event_title like '%".$_GET['query']."%'",$recordperpage,$pagenum,"search_events?query=".$_GET['query']."&search=1");

   }

				}

   else{

   echo errorMsg("You have not posted any event(s) yet!");

   }

					 ?>

</div>

		    </div>
						</div>
						
					</div>
				</div>
                
                </div>
                <!-- end subpage -->
					
		</div>
		
		<?php include("../tools/side-menu_new.php");?>
	</div>
	
	 <script language="javascript">
$(document).ready(function(){
    
    
$('a.delete').click(function(e){ // if a user clicks on the "delete" image
e.preventDefault(); //prevent the default browser behavior when clicking   
var row_id =     $(this).attr('id');
var parent =   $(this).parent().parent();
 if(confirm("Are you sure you want to delete this event?")){
			  $.ajax({//make the Ajax Request
			type: 'get',
			url: '../scripts/delete.php',
			data: 'delete=' + row_id,
			beforeSend: function() {
			 	parent.animate({'backgroundColor':'yellow'},600);
			},
			success: function(response) {//if the page ajax_delete.php returns the value "1"
	if(response=='1'){
	parent.slideUp(600,function() {//remove the Table row .
					parent.remove();
				});
                   
                alert("Event was deleted successfully!");//modal_message();//Display the success message in the modal box
	}
	else {
	   alert('We could not delete it !');//if ajax_delete.php does not return the value "1"
	}
    
			
			}
		});
 }
        });
});

</script>
	
	<div class="clearfix"></div>
</div>

	<?php include('../tools/footer_new.php');?>
</div>
</div>
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