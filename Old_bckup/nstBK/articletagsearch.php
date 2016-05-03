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

	

}

$advert = "Articles";



if(isset($_GET['tag'])){
	
	$query = "WHERE tags like '%".$_GET['tag']."%'";
	
	$result = MysqlSelectQuery("select * from articles $query order by article_id desc limit $offset , $recordperpage");
	}
	
	


?>
<!DOCTYPE html >



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Articles about <?php echo ucwords($_GET['tag']);?> : Nigerian seminars and tranings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?></title>

<meta name="description" content="All Article(s) about <?php echo ucwords($_GET['tag']);?> | Nigerian Seminars and Trainings <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>"/>

<meta name="dcterms.description" content="All Article(s) about <?php echo ucwords($_GET['tag']);?> | Nigerian Seminars and Trainings <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="og:title" content="Articles about <?php echo ucwords($_GET['tag']);?> : Nigerian seminars and tranings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="og:description" content="All Article(s) about <?php echo ucwords($_GET['tag']);?> | Nigerian Seminars and Trainings <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="twitter:title" content="Articles about <?php echo ucwords($_GET['tag']);?> : Nigerian seminars and tranings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="twitter:description" content="All Article(s) about <?php echo ucwords($_GET['tag']);?> | Nigerian Seminars and Trainings <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<?php include("scripts/headers_new.php");?>

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

                  <h4 class="categoryHeader"> Article(s) about <?php echo $_GET['tag']?> </h4>

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
						

?>

  <tr>

    <td width="5%" valign="top"> <?php if($rows['articleImage']==""){?>
                      <img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.png" width="50px" height="50px" alt="nigerianseminarsandtrainings" />
                   
<?php ;}
					 
					 else{?>
                     <img src="<?php echo SITE_URL;?>admin/articles_images/<?php echo $rows['articleImage'];?>" width="50px"  height="50px"/>
                     <?php ;}?>
                     </td>

    <td width="72%"><p><a href="<?php echo SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" ><?php echo $rows['article_title'];?></a></p>

      <div style="font-size:12px; text-align:justify"><?php echo substr(stripslashes($rows['article_description']),0,300);?> <a href="<?php echo SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",$rows['article_title']);?>" style="font-size:10px; color:#999;" target="_blank">[Read more]</a></div>
      </div>

     

      </td>

    <td width="23%" valign="top"><strong>Posted:</strong> <img src="images/icon_clock.png" width="10px" height="10px" /> <?php echo time_ago($rows['articleDate']);?></td>

  </tr>

  <?php

  $i++;

					}

					?>

                  </table>

   <?php

   if(connection()){

                    
					 
					  Paging("SELECT COUNT(article_id) AS numrows FROM articles  $query ",$recordperpage,$pagenum,SITE_URL."articletagsearch?get");

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

<div class="divider"></div>

               <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
               
                
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