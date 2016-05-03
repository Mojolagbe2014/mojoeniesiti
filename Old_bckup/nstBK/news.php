<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

$id = "";

if(isset($_GET['news_id'])) $id = $_GET['news_id'];

if(connection()){

	$recordperpage =  20;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	

	$result = MysqlSelectQuery("select * from news where News_id = '$id' limit $offset, $recordperpage");

	//if(NUM_ROWS($result) == 0) header("location:" .SITE_URL."404error");

	$rows = SqlArrays($result);

}

$advert = "News";

 $image="";
 if($rows['image']==""){
	  $imgFB = 'images/news_image_BIG.png';
	 }
 else{
	  $imgFB = 'nstlogin/articles_images/'.$rows['image'];
	 }
 


?>
<!DOCTYPE html >



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<meta property="og:image" content="<?php echo SITE_URL.$imgFB;?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="250"/>
<meta property="og:image:height" content="250"/>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php if(NUM_ROWS($result) > 0){echo $rows['newsTitle'];}else{echo "News Error";}?> - Nigerian Seminars and Trainings</title>

<meta name="description" content="<?php if(NUM_ROWS($result) > 0){echo substr(strip_tags($rows['description']),0,130)."-".$rows['News_id'];}else{echo "News Error";}?>"/>


<meta name="dcterms.description" content="<?php if(NUM_ROWS($result) > 0){echo substr(strip_tags($rows['description']),0,130)."-".$rows['News_id'];}else{echo "News Error";}?>" />

<meta property="og:title" content="<?php if(NUM_ROWS($result) > 0){echo substr($rows['newsTitle'],0,69);}else{echo "News Error";}?>" />

<meta property="og:description" content="<?php if(NUM_ROWS($result) > 0){echo substr(strip_tags($rows['description']),0,130)."-".$rows['News_id'];}else{echo "News Error";}?>" />

<meta property="twitter:title" content="<?php if(NUM_ROWS($result) > 0){echo substr($rows['newsTitle'],0,69);}else{echo "News Error";}?>" />

<meta property="twitter:description" content="<?php if(NUM_ROWS($result) > 0){echo substr(strip_tags($rows['description']),0,130)."-".$rows['News_id'];}else{echo "News Error";}?>" />


	<?php include("scripts/headers_new.php");?>


<?php include('tools/analytics.php');?>

</head>



<body>

<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



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

				<div id="sub_links">

	<div class="event_table_inner">

<form action="" method="post">
<table width="100%" border="0">
  
  <tr>
    <td width="11%" align="center" style="padding-left:8px">
      <div style="float:left; width:120px"><?php if($rows['image']==""){?>
                      <img src="<?php echo SITE_URL;?>images/news_image_BIG.png" width="100"  height="100" alt="nigerianseminarsandtraining.com" class="articleImg shadow"/>
                     
                     <?php ;}
					 
					 else{?>
                     <img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['image'];?>" width="100"  height="100" class="articleImg shadow"/>
                     <?php ;}?></div>     </td>
    <td width="77%" align="center"><h2 style="font-size:22px; text-align:center;"><p><?php echo $rows['newsTitle'];?></p></h2>
	<span class="span_detail">Posted:</span>
	<span class="event_provider" style="font-size:12px;"><?php echo time_ago($rows['posted_date']);?></span>
    </td>
    
  </tr>
  </table>
</form>
<div class="clearfix"></div>
</div>

                <div id="contact-wrapper" class="rounded"  style="margin-top:8px;"> 

				<div class="video_box">

                <?php 		
					if(NUM_ROWS($result) > 0){
						?>

					<table width="100%" id="listTable">

 

  <tr>

    <td colspan="4" style="color:#333; text-align:justify; line-height:20px"><div class="description" style="font-size:13px;"><?php echo stripslashes($rows['description']);?></div>
    </td>

  </tr>
  

  

                  </table>  
                  
                  <div class="tags">

                      
                       <span> 
                       <p style="float:left; margin-right:8px;"><strong>Share this news: </strong></p> 
                       
                       <div style="float:left;"> 
                  <div class="fb-like" data-href="<?php echo SITE_URL."news/".$rows['News_id']."/".str_replace($title_link,"-",substr($rows['newsTitle'],0,150))."/";?> " data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
                  
    <div class="fb-share-button" data-href="<?php echo SITE_URL."news/".$rows['News_id']."/".str_replace($title_link,"-",substr($rows['newsTitle'],0,150))."/";?> " data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>

<!-- Place this tag after the last share tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
    <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
 </div>
                       
                        <div class="clearfix"></div>
                       </span>
                      
</div>
                  
                   <div class="event_social">

                       
                       <span>
                       <p style="float:left; margin-right:8px;"><strong>Tags</strong></p> <?php echo tags($rows['tags'],'newstagSearch');?>
                        <div class="clearfix"></div>
                       </span>
                      
</div>
<?php 
					}
					else{
						echo ' <h4 style="font-size:17px; color:#F30;">Sorry! The news you requested no longer exists or the has been removed!</h4>';
					}
					?>
</div>

		    </div>

                

                           <div id="sub_links2_middle"><div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

<div class="clearfix"></div>

</div>


			</div><!-- end subpage -->

				</div>	

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