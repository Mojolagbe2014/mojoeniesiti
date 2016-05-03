<?php
	
session_start();
require_once("scripts/config.php");

require_once("scripts/functions.php");



if(connection()){

	$recordperpage = 10;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	$result = MysqlSelectQuery("SELECT * FROM `articles` where status=1 ORDER BY articleDate desc limit $offset, $recordperpage");

}

$advert = "Articles";




?>

<!DOCTYPE html>



<html lang="en">

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

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Gallery: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?></title>

<meta name="description" content="Search, find and download professional, academic and general purpose articles and journals on Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>"/>

	
<link href="css/min-all-css.css" rel="stylesheet" type="text/css"/>
	

	<?php include("scripts/headers_new.php");?>

<style type="text/css">
.article_bg {
	background-image: url(images/article_bg.png);
	background-repeat: no-repeat;
	overflow: hidden;
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
    <td style="padding-left:8px"><h2 style="font-size:22px; padding:5px; color:#000;">Photos</h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				<div id="sub_links">

                 

                <div id="contact-wrapper" class="rounded "> 

				<div class="video_box">

                <?php

				if(NUM_ROWS($result) > 0){

							?>

				

   <?php

   if(connection()){
	   ?>
       <div id="paging1">
       <?php

                     //Paging("SELECT COUNT(article_id) AS numrows FROM articles ",$recordperpage,$pagenum,SITE_URL."articles?get");
                     ?>
                     </div>
                      <div id="paging2">
       <?php

                    // PagingMobile("SELECT COUNT(article_id) AS numrows FROM articles ",$recordperpage,$pagenum,SITE_URL."articles?get");
                     ?>
                     </div>
<?php
   }

				}

   else{

   echo errorMsg("found no event(s) for the selected category");

   }

					 ?>

</div>

		    </div>

            <div class="sub_links2_middle"><div class="sub_links2_middle">


 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



<div class="clearfix"></div>

 
</div>
</div>


                
<div class="clearfix"></div>


</div>
</div>

			

		<?php include("tools/side-menu_new.php");?>


	</div>
    <div class="clearfix"></div>
</div>


<?php include ("tools/footer_new.php");?>

</body>
</html>