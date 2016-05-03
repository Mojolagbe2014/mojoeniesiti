<?php

session_start();

require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());



$advert = "";



$recordperpage =  15;



	$pagenum = 1;



	if(isset($_GET['page'])){



	$pagenum = $_GET['page'];



	}



	$offset = ($pagenum - 1) * $recordperpage;



$result = MysqlSelectQuery("select * from businessinfo where business_type = 'Suppliers' and status=1 order by premium desc, business_name limit $offset , $recordperpage");



$advert = "Suppliers";



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



<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/> 



<title>Nigerian Seminars and Trainings - Suppliers <?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?></title>

<meta name="description" content="Find Suppliers | training equipment | conference , like projectors, flip charts, magnetic boards and other training related services in Nigeria.<?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?>"/>

   <meta name="keywords" content="training equipment suppliers , conference and seminars support services, Suppliers in nigeria, training equipment in nigeria , conference , seminars , support services " />

<meta name="dcterms.description" content="Find suppliers of training and conference equipment’s, suppliers of projectors, flip charts, magnetic boards and other training related services in Nigeria" />

<meta property="og:title" content="Nigerian Seminars and Trainings - Suppliers <?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?>" />

<meta property="og:description" content="Find suppliers of training and conference equipment’s, suppliers of projectors, flip charts, magnetic boards and other training related services in Nigeria" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Suppliers <?php if(isset($_GET['page'])) echo " Page ".$_GET['page'];?>" />

<meta property="twitter:description" content="Find suppliers of training and conference equipment’s, suppliers of projectors, flip charts, magnetic boards and other training related services in Nigeria" />

   
<?php include("scripts/headers_new.php");?>

	




 <style>
.supply_bg{
	background-image: url(images/suppliesbg.png);
	background-repeat: no-repeat;
	background-position: center center;	
}
	</style>


</head>







<body>

<!-- Start Alexa Certify Javascript -->

<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>

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



		<div class="event_table_inner supply_bg">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table >
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;">Suppliers of training equipments in  Nigeria and around the world</h2></td>
    </tr>
  <tr>
    <td style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>	



  <div id="subpage">



					



					<div id="subpage_content">
                    
                    
                      <div class="tprovider_search smart-forms">
                    <table style="width:100%;" >
  <tr>
    <td>   <div class="smart-widget sm-right smr-80">
    <form action="#" method="post" id="searchProvider" autocomplete="off">
                            <label class="field prepend-icon">
                                <input type="text" name="sub2" id="tsearch" class="gui-input" placeholder="Search for equipment suppliers">
                                 <span id="output_providers"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
                                <span class="field-icon"><i class="fa fa-search"></i></span> 
                            </label>
                            <button type="submit" class="button"> Search </button>
                            </form>
                        </div>
                         </td>
  </tr>
</table>

                    </div>


		<?php
		$i = 0;
		$check_website ="";
		$web = '';
		while($rows = SqlArrays($result)){
			if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
			if($rows['website'] == "") $check_website = '<a href="#" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>'; else $check_website = '<a href="'.$rows['website'].'" target="_blank"><img src="'.SITE_URL.'images/link_btn.png" alt="Visit Site" /></a>';
			
			$logo = MysqlSelectQuery("select * from logos where user_id ='".$rows['user_id']."' and user_id !=0");
						$biz_logo = SqlArrays($logo);
						$logoNum = NUM_ROWS($logo);
						
							if($logoNum > 0)
							{
								$biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
								$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="30" height="30"/>';
							 }
							 else{ 
							$image = '<img src="images/star.png" alt="business logo"/>';
							}
							
							
			
			switch($rows['premium']){
				case 3:
							$star = '<div class="star2"></div>';
							$bg_class ='eventListing';
							$listing_diff = '';
							
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
							break;
						case 2:
							$star = '<div class="star3"></div>';
							$bg_class ='eventListing';
							$listing_diff = '';
						
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
							break;
						break;
						case 1:
						$star = '<div class="star1"></div>';
							$bg_class ='eventListing_odd';
							$listing_diff = '';
							$view = '';
							//$web = $check_website;
							$start_tag = '<h2 style="font-size:12px; color:#000;">';
							$end_tag = '</h2>';
							
						break;
						default:
						$star = '<div class="star1"></div>';
							$bg_class ='eventListing_odd';
							$listing_diff = '';
							$view = '';
							//$web = '';
							$start_tag = '';
							$end_tag = '';
							
							
			}
								?>
						    
                            <div itemscope itemtype="http://schema.org/Organization" class="<?php echo $bg_class;?>" onClick="javascript:url_location('<?php echo SITE_URL;?>suppliers/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>')">
                            <a href="<?php echo SITE_URL;?>suppliers/<?php echo $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']);?>" > <span class="spanTitle" style="background-color:#E3EBEE; display:block; padding:3px;" itemprop="name"><?php echo $rows['business_name'];?></span></a>
                       <div class="trainingProviders">
                       <span class="span" itemprop="description"><?php echo substr(strip_tags(stripslashes($rows['description'])),0,160)."...";?></span>
                      
</div>
                       <div class="testImg" style="background-image:url(<?php echo SITE_URL.$biz_logo;?>); background-repeat:no-repeat;"></div>
                       
                         <div class="trainingProviders">
                       	<span class="provider">Contact:&nbsp;</span>
                        <span class="provider_name" style="width: 86.8852%;">
                        <span style="color:#000;" itemprop="address">
						<?php echo $rows['address'];?>
                        </span>
                        </span>
                       
                       </div> 
                     <div class="ViewBox"><img src="images/viewbutton.png" width="77" height="18" alt="view more" style="vertical-align:middle; float:right; border:none; background:none;"></div>
                       <div class="clearfix"></div>
                       </div>
                            <?php
							$i++;
								}
								?>
                                 <div id="paging1">
                                <?php
								
								Paging("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Suppliers' and status =1",$recordperpage,$pagenum,"suppliers?get");
								?>
                                </div>
                                 <div id="paging2">
                                  <?php
								PagingMobile("SELECT COUNT(business_id) AS numrows FROM businessinfo where business_type = 'Suppliers' and status =1",$recordperpage,$pagenum,"suppliers?get");
								?>
                                 </div>






                </div>



                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->



 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



         <div class="divider" style=" border:#0C0; margin-bottom:20px;"></div>
</div>

</div>


  <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>



<div class="clearfix"></div>





</div>






	
	<?php include("tools/side-menu_new.php");?>

	</div>		

	<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>


<?php include ("tools/footer_new.php");?>

<script type="text/javascript">
$(document).ready(function(e) {
	
	
	/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#tsearch').keyup(function(){
			$('#output_providers').fadeIn('slow');
			$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Suppliers'}, function(data) {
				
				$('#output_providers').html(data)
			
			
		});
	})
	//disappears the training providers when the text box looses focus
	$('#tsearch').blur(function(){
		$('#output_providers').fadeOut();
		
	})
	//displays the training providers when the text box gains focus
		$('#tsearch').focus(function(){
			$('#output_providers').fadeIn('slow');
			$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
			if($(this).val() == ""){
			$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {queryFocus:$(this).val(),type:'Suppliers'}, function(data) {
				
				$('#output_providers').html(data)

			
		});
			}
			else{
				$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Suppliers'}, function(data) {
				
				$('#output_providers').html(data)
			
			
		});
			}
	})
	
	
});
//funtion to retrieve the value from the training providers drop down
	function GetProVal(elem){
		var URL = $('#'+elem).attr('data');
				
		$('#tsearch').val($('#'+elem).text());
		$('#output_providers').hide();
		
		$('#searchProvider').attr('action',URL)
	

			}
</script>

</body>

</html>