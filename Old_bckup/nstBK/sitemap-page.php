<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

ob_start();

$message = '';

if(connection());
function getMetaTitle($url){
				$content = file_get_contents($url);
$pattern = "|<[\s]*title[\s]*>([^<]+)<[\s]*/[\s]*title[\s]*>|Ui";
if(preg_match($pattern, $content, $match))
return $match[1];
else
return $url;
}

$advert = "Sitemap";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title>Nigerian Seminars and Trainings - Sitemap Page</title>
	  <meta name="description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website"/>
      
      <meta name="dcterms.description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website" />

<meta property="og:title" content="Nigerian Seminars and Trainings - Sitemap Page" />

<meta property="og:description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website" />

<meta property="twitter:title" content="Nigerian Seminars and Trainings - Sitemap Page" />

<meta property="twitter:description" content="View our sitemap to get instant access to information available on nigerian seminars and trainings website" />
      

	<?php include("scripts/headers_new.php");?>

	<style type="text/css">
#right{
	width:229px;
	height:140px;
	float:left;
	margin-right: 7px;
	margin-bottom: 7px;
	border-color:#999
	
}

#right ul li {
	margin-left: 14px;
	list-style-position: inside; line-height:20px; list-style: none; 
}

#right ul li a{ text-decoration:none;
	
}

#right ul li a:hover{ text-decoration: underline;
	
}

#righth{
	width:150px;
	height:140px;
	float:left;
	margin-right: 7px;
	margin-bottom: 7px;	
}

#righth ul li {
	margin-left: 14px;
	list-style-position: inside; line-height:20px; list-style:square; 
}

#righth ul li a{ text-decoration:none;
	
}

#righht ul li a:hover{ text-decoration: underline;
	
}
#event{
	width:110px;
	height:200px;
	float:left;
	margin-right: 7px;
}

#event ul li {
	margin-left: 8px;
	list-style-position: inside; line-height:20px;
}

#heading{
	width:220px;
	height:35px;
	float:left;
	margin-right: 7px;
	margin-bottom: 7px;	
}
#heading2{
	
	width:185px;
	height:30px;
	float:left;
	margin-right: 7px;
	margin-bottom: 7px;
	
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
    <td style="padding-left:8px"><h2 style="font-size:26px; padding:5px;">Sitemap</h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
	    
	    <div id="subpage">
	      <div id="subpage_content_ad">
          
          <div id="righth" class="tabs">
	          <p style="font-size:12px; font-weight:bold">Quick links</p>
	          
	          <ul>
	            <li><a href="<?php echo SITE_URL;?>">Home</a></li>
	            <li><a href="<?php echo SITE_URL;?>about">About Us</a></li>
	            <li><a href="<?php echo SITE_URL;?>advertise">Advertise</a></li>
	            <li><a href="http://m.nigerianseminarsandtrainings.com">Visit Mobile Site</a></li>
	            
              </ul>
            </div>
	        
	        <div id="righth" class="tabs">
	          <p style="font-size:12px; font-weight:bold">Find Vendors</p>
	          <ul>
	            <li><a href="<?php echo SITE_URL;?>venues">Venue Providers</a></li>
	            <li><a href="<?php echo SITE_URL;?>event-managers">Event Managers</a></li>
	            <li><a href="<?php echo SITE_URL;?>suppliers">Equipment Suppliers</a></li>
              </ul>
            </div>
	        <div id="righth" class="tabs">
	          <p style="font-size:12px; font-weight:bold">Subscription</p>
	          <ul>
	            <li><a  href="<?php echo SITE_URL;?>rss">RSS Feed</a></li>
	            <li><a  href="<?php echo SITE_URL;?>premium-listing">Premium Listing</a></li>
	            <li><a  href="<?php echo SITE_URL;?>subscribers">Updates / Newsletter</a></li>
              </ul>
            </div>
	        <div id="righth" class="tabs">
	          <p style="font-size:12px; font-weight:bold">Resources</p>
	          <ul>
	            <li><a  href="<?php echo SITE_URL;?>all-vacancies">Find Jobs</a></li>
	            <li><a  href="<?php echo SITE_URL;?>videos-all">Watch Training Video</a></li>
	            
	       
              </ul>
            </div>
          </div>
         
	      
	      <div id="subpage_content_ad"> 
	        <div id="subpage_content_ad">

	          
	          <div id="heading">
	            <p   style="font-size:12px; font-weight:bold;text-align:left">Events by Location (Global)</p>
	            
              </div>
	          <div id="heading" >
	            <p style="font-size:12px; font-weight:bold;text-align:left">Events in Nigeria</p>
	            
              </div>
	          
            </div><br /><br />
  
  <div id="right" style="height:400px; overflow:scroll;">
    
    <?php
					  $countries = MysqlSelectQuery("select * from countries order by countries asc");
					?>
    <ul>
      <?php
    while($rows = SqlArrays($countries)){
		$strip = str_replace(" / ","-",$rows['countries']);

		$final = str_replace(" ","-",$strip);
		?>
      <?php echo '<li><a href="'.SITE_URL.'events/countries/'.$rows['id'].'/'.$final.'">'.$rows['countries'].'</a></li>';?>
      <?php 
	}
	?>
      </ul>
    </div>
	        <div id="right" style="height:400px; overflow:scroll;">
	          <?php
					   $countries = MysqlSelectQuery("select * from states order by name");
					?>
	          <ul>
	            <?php
    while($rows = SqlArrays($countries)){
		$strip = str_replace(" / ","-",$rows['name']);

		$final = str_replace(" ","-",$strip);
		?>
	            <?php echo '<li><a href="'.SITE_URL.'events/state/'.$rows['id_state'].'/'.$final.'">'.$rows['name'].'</a></li>';?>
	            <?php 
	}
	?>
              </ul>
            </div>
	        
	        
          </div>
	   
	      <div id="subpage_content_ad">
	        <div id="subpage_content_ad"><br />
	          <div id="heading">
                <p style="font-size:12px; font-weight:bold;text-align:left">Training Providers by Location (Global)</p>
</div>
	          
	          <div id="heading">
                <p style="font-size:12px; font-weight:bold;text-align:left">Training Providers in Nigeria</p>
   
    </div><div id="heading">
	            <p style="font-size:12px; font-weight:bold; letter-spacing:inherit;text-align:left;">Training Providers by Category</p>
	            
              </div>
            </div>
  <div id="right" style="height:400px; overflow:scroll;scrollbar-base-color: orange; ">
    <p style="font-size:13px; font-weight:bold">&nbsp;</p>
    <?php
					 $countries = MysqlSelectQuery("select * from countries order by countries asc");
					?>
    <ul>
      <?php
    while($rows = SqlArrays($countries)){
		$strip = str_replace(" / ","-",$rows['countries']);

		$final = str_replace(" ","-",$strip);
		?>
      <?php echo '<li><a href="'.SITE_URL.'training-providers/countries/'.$rows['id'].'/'.$final.'">'.$rows['countries'].'</a></li>';?>
      <?php 
	}
	?>
      </ul>
    </div>
  <div id="right" style="height:400px; overflow:scroll;">
    <p style="font-size:13px; font-weight:bold">&nbsp;</p>
    <?php
					   $countries = MysqlSelectQuery("select * from states order by name");

					?>
    <ul>
      <?php
    while($rows = SqlArrays($countries)){
			$strip = str_replace(" / ","-",$rows['name']);
		$final = str_replace(" ","-",$strip);
		?>
      <?php echo '<li><a href="'.SITE_URL.'training-providers/state/'.$rows['id_state'].'/'.$final.'">'.$rows['name'].'</a></li>';?>
      <?php 
	}
	?>
      </ul>
    </div>
    <div id="right" style="height:400px; overflow:scroll; ">
	          
	          <?php
					   $categories = MysqlSelectQuery("select * from categories order by category_name");

					?>
	          <ul>
	            <?php
    while($rows = SqlArrays($categories)){
		$strip = str_replace(" / ","-",$rows['category_name']);

		$final = strtolower(str_replace($title_link,"-",$strip));
		?>
	            <?php echo '<li><a href="'.SITE_URL.'training-provider/categories/'.$final.'">'.$rows['category_name'].'</a></li>';?>
                
	            <?php 
	}
	?>
              </ul>
            </div>
          </div>
	      <div>
          </div> 
	      
	      
	      
  <div id="latest_content_items">
    
    
    
    <!-- Section 1 Featured -->
    
    <!-- End Featured 1 -->
    
    
    
    </div><!-- end latest_content_items -->
	      
        </div>
	    
	    <div id="sub_links"><div id="sub_links2_middle">
		<?php 

 echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
	      
  <div class="clearfix"></div>
	      
  </div></div><!-- end subpage -->
	    
	    
	    
      </div>
	  
	  
	  
	  <?php include("tools/side-menu_new.php");?>
	  
    </div>

	

    <div class="clearfix"></div>
    
  </div>
  
  
  
</div>

</div>

</div>
<?php include ("tools/footer_new.php");?>
</body>

</html>