<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());
$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
$result = MysqlSelectQuery("select * from vacancies where status = 1 order by job_id desc limit $offset , $recordperpage");
$advert = "All Vacancies";
?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Nigerian Seminars and Trainings - All Vacancies</title>
    
<meta name="description" content="Latest training vacancies and training facilitation opportunities in Nigeria and around the world."/>

    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	
   
    <meta name="keywords" content="Conferences, training seminars, workshops, training, conference seminars, seminar trainings, events" />

<meta name="dcterms.description" content="Latest training vacancies and training facilitation opportunities in Nigeria and around the world." />

<meta property="og:title" content="Nigerian Seminars and Trainings - All Vacancies" />

<meta property="og:description" content="Latest training vacancies and training facilitation opportunities in Nigeria and around the world." />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - All Vacancies" />

<meta property="twitter:description" content="Latest training vacancies and training facilitation opportunities in Nigeria and around the world." />

   
	<?php include("scripts/headers_new.php");?>
  
     <script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>

</head>
<body>
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>



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
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" height="1" width="1" alt="Quantcast"/>
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
<table>
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:24px; padding:5px;">Latest Training/Facilitation Vacancies</h2></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	
				<div id="subpage">
					
				  <div id="contact-wrapper" class="rounded" style="margin-top:8px; padding-top:8px;">
             		
		<?php
		if(NUM_ROWS($result) > 0){
		$i = 0;
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
								?>
					      <table bgcolor="<?php //echo $bg;?>" class="listing_table_event">
					        <tr>
					          <td colspan="2"><h4><a href="<?php echo SITE_URL;?>vacancy/full/<?php echo $rows['job_id'];?>/<?php echo str_replace($title_link,"-",$rows['title']);?>"><?php echo $rows['title'];?></a></h4></td>
					          <td style="width:18%;">&nbsp;</td>
					          <td style="width:5%;" rowspan="5"><img src="images/star.png" width="22" height="23" /></td>
				            </tr>
					        
					        <tr>
					          <td colspan="2" style="font-size:11px; width:10%;"><?php echo substr(strip_tags($rows['description']),"0",200)."...";?></td>
					          <td><span style="color:#090; width:67%;"><img src="images/icon_clock.png" alt="" width="10" height="10" /> <?php echo time_ago($rows['posted_date']);?></span></td>
				            </tr>
					        <tr>
					          <td style="font-size:11px; width:10%;"><strong>Company:</strong></td>
					          <td style="color:#090; width:67%;"><?php echo $rows['company_name'];?></td>
					          <td>
</td>
				            </tr>
					        <tr>
					          <td style="font-size:11px;"><strong>Location:</strong></td>
					          <td><img src="images/icon.gif" width="7" height="8" /> <?php echo $rows['city']." , ".$rows['country'];?></td>
					          <td><a href="<?php echo SITE_URL;?>vacancy/full/<?php echo $rows['job_id'];?>/<?php echo str_replace($title_link,"-",$rows['title']);?>">Full Detail</a></td>
				            </tr>
					       
				          </table>
                          <?php
							$i++;
								}
								?>
                                  <div id="paging1">
       <?php
Paging("SELECT COUNT(job_id) AS numrows FROM vacancies where status = 1",$recordperpage,$pagenum,"all_vacancies?get");
                   
                     ?>
                    </div>
                     <div id="paging1">
       <?php
PagingMobile("SELECT COUNT(job_id) AS numrows FROM vacancies where status = 1",$recordperpage,$pagenum,"all_vacancies?get");
                   
                     ?>
                     </div>
				<?php				
		}
		else{
			echo errorMsg("No training vacancy found!");
		}
								?>
                                
                     
                  
			  </div>
						 
					

                </div>
                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
<div class="clearfix"></div>
</div>
			
                <!-- end subpage -->
					
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