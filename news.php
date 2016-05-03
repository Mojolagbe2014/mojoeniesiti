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
//this gets the characters 0 to the period and stores it in $newFile
$newFile = trim(WordTruncate($rows['newsTitle'], 50)); //Use seven words as file name
$newFile = str_replace(" ", "000", $newFile);
//Remove special Characters
$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
//Replace spaces with dash/hyphen
$newFile = str_replace("000", "-", $newFile);
$newFile = str_replace("--", "-", $newFile);
//Covert d name to lowercase
$fileNameAsLink = strtolower($rows['News_id']."-".$newFile);
$newFile = strtolower($rows['News_id']."-".$newFile);//.".php"
//Redirect to the new article file page
header("HTTP/1.0 404 Not Found");
header("Location:".SITE_URL.'newspg/'.$newFile);

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

	<title><?php if(NUM_ROWS($result) > 0){echo $rows['newsTitle'];}else{echo "News Error";}?> </title>

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

<?php include("tools/header_new.php");?>



<div id="main">

	

	<div id="content">
    
     <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div id="sub_links">

	<div class="event_table_inner">

<table style="width:100%;" >
  
  <tr>
    <td style="padding-left:8px; width:11%; text-align:center;">
      <div style="float:left; width:120px"><?php if($rows['image']==""){?>
                      <img src="<?php echo SITE_URL;?>images/news_image_BIG.png" width="100"  height="100" alt="nigerianseminarsandtraining.com" class="articleImg shadow"/>
                     
                     <?php ;}
					 
					 else{?>
                     <img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['image'];?>" width="100" alt="Article provider's picture"  height="100" class="articleImg shadow"/>
                     <?php ;}?></div>     </td>
    <td style="width:77%; text-align:center;"><h2 style="font-size:22px; text-align:center;"><?php echo $rows['newsTitle'];?></h2>
	<span class="span_detail">Posted:</span>
	<span class="event_provider" style="font-size:12px;"><?php echo time_ago($rows['posted_date']);?></span>
    </td>
    
  </tr>
  </table>

<div class="clearfix"></div>
</div>

                <div id="contact-wrapper" class="rounded"  style="margin-top:8px;"> 

				<div class="video_box">

                <?php 		
					if(NUM_ROWS($result) > 0){
						?>

					<table style="width:100%;" id="listTable">

 

  <tr>

    <td style="color:#333; text-align:justify; line-height:20px"><div class="description" style="font-size:13px;"><?php echo stripslashes($rows['description']);?></div>
    </td>

  </tr>
                  </table>  
                  
                  <div class="tags">

                      
                       <div> 
                       <p style="float:left; margin-right:8px;"><strong>Share this news:</strong></p> 
                       
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
                       </div>
                      
</div>
                  
                   <div class="event_social">

                       
                       <div>
                       <p style="float:left; margin-right:8px;"><strong>Tags</strong></p> <?php echo tags($rows['tags'],'newstagSearch');?>
                        <div class="clearfix"></div>
                       </div>
                      
</div>
<?php 
					}
					else{
						echo ' <h4 style="font-size:17px; color:#F30;">Sorry! The news you requested no longer exists or the has been removed!</h4>';
					}
					?>
</div>

		    </div>

<div class="fb-comments" data-href="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" data-width="720px" data-numposts="5" data-colorscheme="light"></div>

                           <div id="sub_links2_middle">
                           <!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

<div class="clearfix"></div>

			</div>
            <!-- end subpage -->

				</div>	

		</div>

		

		<?php include("tools/side-menu_new.php");?>

	</div>


	<div class="clearfix"></div>

</div>


</div>

<?php include ("tools/footer_new.php");?>

</body>

</html>