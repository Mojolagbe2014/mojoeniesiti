<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");



if(connection()){

	$recordperpage = 10;

	$pagenum = 1;

	if(isset($_GET['page'])){

	$pagenum = $_GET['page'];

	}

	$offset = ($pagenum - 1) * $recordperpage;

	$result = MysqlSelectQuery("SELECT * FROM `dailyquote` WHERE status=1 ORDER BY quote_id desc limit $offset, $recordperpage");

}

$advert = "Articles";

?>

<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >

<head>

</script>

 
<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Quote Archive: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?></title>

<meta name="description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>"/>



<meta name="dcterms.description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="og:title" content="Quote Archive: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="og:description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="twitter:title" content="Quote Archive: Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="twitter:description" content="Get, read inspiring, motivational and wise quotes daily from Nigerian seminars and trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

	
    <link rel="stylesheet" type="text/css"  href="css/all-css.css" />


	<?php //include("scripts/headers_new.php");?>
   
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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




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
    <td style="padding-left:8px"><h2 style="font-size:22px; padding:5px; "><p>Quotes Archive</p></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

				<div id="sub_links">

               

                <div id="contact-wrapper" class="rounded"> 
               
              
				<div class="video_box">

                <?php

				if(NUM_ROWS($result) > 0){

							?>

				<table width="100%" id="listTable" style="padding-bottom:5px; padding-top:5px">

                    <?php

					

                    $i = 1;

					while($rows = SqlArrays($result)){

						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}

?>

  <tr class="adjust">

    <td valign="top">
    <br />
    
      <div style="font-size:12px; text-align:center" >
        <a href="<?php echo SITE_URL.'quote/full/'.$rows['quote_id'].'/'.str_replace($title_link,"-",substr($rows['quote'],0,70));?>" style="font-weight:normal; font-size:18px;">" <?php echo substr(stripslashes($rows['quote']),0,300);?> "</a>
        <br />
        
        <span style="font-weight:normal; color:#666;">
          <?php  echo $rows['authur'];?>
          </span><br /><br />
        </div>
      
        
        
        <div style="padding-top:3px; padding-bottom:9px; font-size:12px" ><span style="font-weight:900">
          <?php if(!empty($rows['tags'])){ echo'Tags: ';}?>
          </span>
          <?php  echo tags($rows['tags'],'quotearchivetagsearch');?>
          </div>
        <div class="fb-like" data-href="<?php echo SITE_URL.'quote/full/'.$rows['quote_id'].'/'.str_replace($title_link,"-",substr($rows['quote'],0,70));?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
      
      <span style="float:right;">Posted: <img src="images/icon_clock.png" width="10" height="10" /> <?php echo time_ago($rows['day_of_quote']);?></span>
      
      <br />    <br /></td>

    </tr>

  <?php

  $i++;

					}

					?>

                  </table>

   <?php

   if(connection()){

                     Paging("SELECT COUNT(quote_id) AS numrows FROM dailyquote ",$recordperpage,$pagenum,SITE_URL."quoteArchive?get");

   }

				}

   else{

   echo errorMsg("found no event(s) for the selected category");

   }

					 ?>

</div>

		    </div>

            <div class="sub_links2_middle">
           


 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>


</div>
                
<div class="clearfix"></div>


</div>

</div>



 <?php include("tools/side-menu_new.php");?>
	</div>
</div>

	

	<div class="clearfix"></div>


</div>

	
  
  
</div>
<?php include ("tools/footer_new.php");?>
</body>

</html>