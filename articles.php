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

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Articles <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?> - Nigerian Seminars and Trainings</title>

<meta name="description" content="Search, find and download professional, academic and general purpose articles and journals on Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>"/>

<meta name="keywords" content="articles, write-ups, journals, reports, educational reprots, reports about Nigeira" />

<meta name="dcterms.description" content="Search, find and download professional, academic and general purpose articles and journals on Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="og:title" content="Articles <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?> - Nigerian Seminars and Trainings" />

<meta property="og:description" content="Search, find and download professional, academic and general purpose articles and journals on Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

<meta property="twitter:title" content="Articles <?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?> - Nigerian Seminars and Trainings" />

<meta property="twitter:description" content="Search, find and download professional, academic and general purpose articles and journals on Nigerian Seminars and Trainings<?php if(isset($_GET['page'])) echo "-Pg".$_GET['page'];?>" />

	<?php include("scripts/headers_new.php");?>

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
</style>
</head>



<body>

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
    <td style="padding-left:8px"><h1 style="font-size:25px; padding:5px; font-weight: normal;">Articles</h1></td>
    </tr>
  <tr>
      <td style="font-size:11px"><h2>&nbsp;</h2></td>
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

				<table style="width:100%;" id="listTable">

                    <?php

					

                    $i = 1;

					while($rows = SqlArrays($result)){

						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
						

?>

  <tr>

    <td style="vertical-align:top; width:5%;"> <?php if($rows['articleImage']==""){?>
                      <img src="<?php echo SITE_URL;?>images/nigerianseminars_logo.png" width="70" height="70" alt="nigerianseminarsandtrainings" class="articleImg shadow" />
                   
<?php ;}
					 
					 else{?>
                     <img src="<?php echo SITE_URL;?>nstlogin/articles_images/<?php echo $rows['articleImage'];?>" width="70"  height="70" alt="Articles nigerian seminars and training" class="articleImg shadow"/>
                     <?php ;}?>
                     </td>
	<?php
		//this gets the characters 0 to the period and stores it in $newFile
		$newFile = substr(trim($rows['article_title']), 0, 45);
		$newFile = str_replace(" ", "000", $newFile);
		//Remove special Characters
		$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
		//Replace spaces with dash/hyphen
		$newFile = str_replace("000", "-", $newFile);
		$newFile = str_replace("--", "-", $newFile);
		//Covert d name to lowercase
		$newFile = strtolower($rows['article_id']."-".$newFile);//.".php"
	?>
      <td style="width:72%;"><h3 style="font-size:14px; font-weight:normal;"><a href="<?php echo SITE_URL.'articlespg/'.$newFile;?>" style="font-size:14px; font-weight:normal;" ><?php echo $rows['article_title'];?></a></h3>

      <div style="font-size:12px; text-align:justify"><?php echo substr(strip_tags(stripslashes($rows['article_description'])),0,300);?> <a href="<?php echo SITE_URL.'articlespg/'.$newFile;?>" style="font-size:10px; color:#999;" target="_blank">[Read more]</a></div>
      

     

      </td>

    <td style="vertical-align:top; width:23%;"><strong>Posted:</strong> <img src="<?php echo SITE_URL;?>images/icon_clock.png" width="10" height="10" alt="Articles nigerian seminars and training" /> <?php echo time_ago($rows['articleDate']);?></td>

  </tr>

  <?php

  $i++;

					}

					?>
                   
                  </table>
                 

   <?php

   if(connection()){
	   ?>
       
       
       <div id="paging1">
       <?php

                     Paging("SELECT COUNT(article_id) AS numrows FROM articles ",$recordperpage,$pagenum,SITE_URL."articles?get");
                     ?>
                      <div class="clearfix"></div>
                     </div>
                      <div id="paging2">
       <?php

                     PagingMobile("SELECT COUNT(article_id) AS numrows FROM articles ",$recordperpage,$pagenum,SITE_URL."articles?get");
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
            
             <div class="button_class_right smart-forms" style="margin-bottom:20px; width:250px; margin-right:180px; padding-top:0px;"><a href="<?php echo SITE_URL;?>article-submission" class="button" >Submit Articles</a>
       <div class="clearfix"></div>
       </div>
         
 <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>



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