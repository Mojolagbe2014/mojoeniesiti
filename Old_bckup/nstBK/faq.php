<?php
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");

$pg = "";

if(connection()){

	$recordperpage = 10;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];
	$pg = "-pg".$_GET['page'];
	}

	$offset = ($pagenum - 1) * $recordperpage;

	$result = MysqlSelectQuery("SELECT * FROM `faq` where status=1 ORDER BY faq_id desc limit $offset, $recordperpage");

}

$advert = "FAQ";




?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Nigerian Seminars and Trainings - Frequently Asked Questions (FAQ) <?php  echo $pg;?></title>

<meta name="description" content="Get answers to most the questions you have about Nigerian Seminars and Trainings<?php  echo $pg;?>"/>

<meta name="keywords" content="questions, anaswers, frequesntly asked questions, FAQ" />

<meta name="dcterms.description" content="Get answers to most the questions you have about Nigerian Seminars and Trainings<?php  echo $pg;?>" />

<meta property="og:title" content="Nigerian Seminars and Trainings - Frequently Asked Questions (FAQ) <?php  echo $pg;?>" />

<meta property="og:description" content="Get answers to most the questions you have about Nigerian Seminars and Trainings<?php  echo $pg;?>" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Frequently Asked Questions (FAQ) <?php  echo $pg;?>" />

<meta property="twitter:description" content="Search, find and download professional, academic and general purpose articles and journals on Nigerian Seminars and Trainings<?php  echo $pg;?>" />

	<?php include("scripts/headers_new.php");?>
     <link rel="stylesheet" type="text/css" href="css/accordion.css" />

<style type="text/css">
.article_bg{
	background-image: url(images/ArticleBG.png);
	background-repeat: no-repeat;
	background-position: center center;	
}
.shadow{
	-webkit-box-shadow: 0px 0px 2px 0px rgba(50, 50, 50, 0.57);
	-moz-box-shadow:    0px 0px 2px 0px rgba(50, 50, 50, 0.57);
	box-shadow:         0px 0px 2px 0px rgba(50, 50, 50, 0.57);
}
.articleImg{
	display:block;
	padding:3px;
	background-color:#F8F8F8;
}
.faq_content p{
	line-height:20px;
	font-style:normal;
}
.faq_content ul{
	margin-left:10px;

}
.faq_content ul li{
	list-style-position:inside;
	padding-left:5px;
	margin-bottom:3px;
	text-shadow: 1px 1px 1px rgba(255,255,255,0.8);
	font-size:12px;
}
</style>
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
<table >
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:28px; padding:5px;">Frequently Asked Questions (FAQ)</h2></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				<div id="sub_links">

                

                <div id="contact-wrapper" style="border:none;"> 

				<div class="video_box">

                <?php

				if(NUM_ROWS($result) > 0){

							?>

			<section class="ac-container">
            
            <?php
			$i = 1;
			
			while($rows = SqlArrays($result)){
				if($i == 1)
				$checked = 'checked';
				else
				$checked = "";
			?>
				<div>
					<input id="ac-<?php echo $i;?>" name="accordion-1" type="radio" <?php echo $checked;?> />
					<label for="ac-<?php echo $i;?>"><?php echo stripslashes($rows['question']);?></label>
					<article class="ac-small">
                    <div style="max-height:180px; height:auto; overflow:scroll;" class="faq_content">
						<?php echo stripslashes($rows['answer']);?>
                   </div>
					</article>
				</div>
               <?php
			   $i ++;
			}
			?>
			</section>
                 

   <?php

   if(connection()){
	   ?>
       
       
       <div id="paging1">
       <?php

                     Paging("SELECT COUNT(faq_id) AS numrows FROM faq where status=1 ",$recordperpage,$pagenum,SITE_URL."faq?get");
                     ?>
                      <div class="clearfix"></div>
                     </div>
                      <div id="paging2">
       <?php

                     PagingMobile("SELECT COUNT(faq_id) AS numrows FROM faq where status=1 ",$recordperpage,$pagenum,SITE_URL."faq?get");
                     ?>
                     </div>
                      
<?php
   }

				}

   else{

   echo errorMsg("found no article(s) ");

   }

					 ?>
                     
 
</div>

		    </div>
            
           

            <div class="sub_links2_middle">
            
            
         
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



<div class="clearfix"></div>

</div>


                
<div class="clearfix"></div>


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