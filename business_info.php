<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$message = '';
reset ($business);
	while (list ($key, $val) = each ($business)) {
		if (!isset($_SESSION[$key])) $_SESSION[$key] = "";
		if ($_SESSION[$key] == "NULL") $_SESSION[$key] = "";
	}
	if(connection());
if(isset($_GET['info']) && $_GET['info'] != ""){
	$result = MysqlSelectQuery("select * from businessinfo where business_id='".$_GET['info']."' and status=1");
	$rows = SqlArrays($result);
        $numberBiz  = NUM_ROWS($result);
        
	$result2 = MysqlSelectQuery("select * from logos where user_id='".$rows['user_id']."'"); 
	
	if($rows['website'] == "") $check_website = '<a href="#" class="cssButton_roundedLow cssButton_aqua" style="padding:10px; font-size:14px; color:#FFF;float:right;" onclick="alert(\'No Website\')" ><i class="fa fa-globe" style="font-size:16px;"></i> Visit Website</a>'; 
        else $check_website = '<a href="'.$rows['website'].'" target="_blank" class="cssButton_roundedLow cssButton_aqua" style="padding:10px; font-size:14px; color:#FFF;float:right;" rel="nofollow" onclick="trackOutboundLink(\''.$rows['website'].'\')" ><i class="fa fa-globe" style="font-size:16px;"></i> Visit Website</a>';
	
	CatchBusinessViews($_GET['info']);
	
	$cat =  MysqlSelectQuery("select * from categories where category_id = '".$rows['specialization']."'");

	$rows_cat = SqlArrays($cat);
        
        
        $number  = NUM_ROWS($result2);

if(NUM_ROWS($result2) == 0){
	$image = SITE_URL."images/blank.png";
}
else{
	$rows_logo = SqlArrays($result2);
	$image = SITE_URL."premium/logos/thumbs/".$rows_logo['logos'];
}
	$opt = array (
	'address' => urlencode($rows['address']),
	'sensor'  => 'false'
);

// now simply call the function
//$geolocation = getLatLng($opt);

function getCoordinatesFromAddress( $sQuery){
	@$sURL = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($sQuery).'&sensor=false';
	@$sData = file_get_contents($sURL);
	
	return json_decode($sData);
}

@$res = getCoordinatesFromAddress($rows['address']);
@$lat = $res->results[0]->geometry->location->lat;
@$long = $res->results[0]->geometry->location->lng;
}

// if status was successful, then print the lat/lon ?

$advert = "Training Providers";
function FormatSrting($stringVal,$int){
	$string = strip_tags($stringVal);
	$string = substr($string,0,$int);
	 return $string ;
}
switch ($rows['business_type']){
		case 'Training':
		$biz_type = 'Training Provider';
		break;
		case 'Suppliers':
		$biz_type = 'Equipment Suppliers';
		break;
		case 'Managers':
		$biz_type = 'Event Managers';
		break;
		case 'Venue':
		$biz_type = 'Venue Provider';
		break;
		default:
		$biz_type ='';
}
$title = (($numberBiz > 0 ) && ($rows['status'] == 1)) ? trimStringToFullWord(60, stripslashes(strip_tags($rows['business_name']." - Nigerian Seminars and Training")))  : "Business information has not been activated or has been removed!";
$description = (($numberBiz > 0 ) && ($rows['status'] == 1)) ? trimStringToFullWord(150, stripslashes(strip_tags($rows['description']."-".$rows['business_id']))) : "Business information has not been activated or has been removed!";
if(NUM_ROWS($result) == 0 || $rows['status'] == 0) { header("HTTP/1.0 404 Not Found"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $description;?>" />
<meta name="keywords" content="<?php echo $rows['business_name']; ?>" />
<meta property="og:image" content="<?php if($rows['premium'] == 3 || $rows['premium'] == 2){ echo $image; } else {echo SITE_URL.'images/facebookIMG.png';}?>"/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>
<meta name="dcterms.description" content="<?php echo $description;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $description;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $description;?>" />
<link rel="stylesheet" type="text/css"  href="<?php echo SITE_URL;?>premium/css/prettyphoto.css">
<?php include("scripts/headers_new.php");?>
<?php include('tools/analytics.php');?>                 
<style type="text/css">
.TrainingProvider .trainingProviders span li {
	margin-left: 5px;
	padding-left: 5px;
	list-style-position: inside;
}

#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}
  
.window {
  position:fixed;
  left:0;
  top:0;
  width:500px; 
  z-index:9999;
  padding:20px;
  display:none;
}
.boxContent{
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
background-color:#666666;
padding:8px;
}
.form_content{
	background-color:#FFF;
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	display: block;
	float: left;
}
body{overflow-x: hidden}
</style> 
<style type="text/css">
           
                .event-param{
                    display:block;
                    padding:4px 0px;
                }
                .event-param span{
                    display:block;
                    padding:7px;
                    background-color:#E3EBEE;
                    float:right;
                    margin: 0 5px 0 5px;
                    text-align:center;
                    border-radius:3px;
                    font-size:14px;
                    border: solid 1px #E3EBEE;
                }
                .event-param .last{
                    margin-right:0px;
                    width:25%;
                }
                .event-param .first{
                    margin-left:0px;
                    width:69%;
                     text-align:left;
                }
                
                .eventDetail .trainingProviders span li {
                    margin-left: 5px;
                    padding-left: 5px;
                    list-style-position: inside;
                }
                .eventDetail .trainingProviders img{
                    float:none;
                }
                #mask {
                    position:absolute;
                    left:0;
                    top:0;
                    z-index:9000;
                    background-color:#000;
                    display:none;
                }

                .window {
                    position:fixed;
                    left:0;
                    top:0;
                    width:500px; 
                    z-index:9999;
                    padding:20px;
                    display:none;
                }
                .window_currency {
                    position:fixed;
                    left:0;
                    top:0;
                    width:200px;
                    z-index:9999;
                    padding:20px;
                    display:none;
                }
                .window_popup {
                    position:fixed;
                    left:0;
                    top:0;
                    width:37%;
                    z-index:9999;
                    padding:20px;
                    display:none;
                }
                .window_friend {
                    position:fixed;
                    left:0;
                    top:0;
                    width:37%;
                    z-index:9999;
                    padding:20px;
                    display:none;
                }
                .boxContent{
                    -webkit-border-radius: 8px;
                    -moz-border-radius: 8px;
                    border-radius: 8px;
                    background-color:#666666;
                    padding:8px;
                }
                .form_content{
                    background-color:#FFF;
                    -webkit-border-radius: 8px;
                    -moz-border-radius: 8px;
                    border-radius: 8px;
                    display: block;
                    float: left;
                }.subscribe_notification {
                    padding: 10px;
                    height: 200px;
                    width:500px;
                    background-color: #FFF;
                    float: left;
                    display: none;
                    background-image: url(<?php echo SITE_URL; ?>images/school.png);
                    background-repeat: repeat;
                }
                .subscribe_notification span {

                    padding: 5px;
                    font-size: 24px;
                    text-align: center;
                    float: left;
                    text-shadow: 1px 1px 1px rgba(150, 150, 150, 1);
                }
                .subscribe_notification span img {
                    vertical-align: middle;
                    padding-right: 5px;
                    float: left;
                }
                #add_event{
                    color:#FFF;
                    font-size:16px;
                }
               
                .tooltipsy
                {
                    padding: 10px;
                    max-width: 200px;
                    color: #303030;
                    background-color: #f5f5b5;
                    border: 1px solid #00A859;
                }
                .event-content{
                    padding:4px 0px;
                }
                .event-content .description{
                    float:left;
                    border: solid 1px #E3EBEE;
                    width:69%;
                    height:300px;
                    min-height:200px;
                    overflow:auto;
                    text-align:justify;
                }
                .event-content .event-menu{
                    float:right;
                    border: solid 1px #E3EBEE;
                    width:25%;
                    height:300px;
                    min-height:200px;
                    padding: 7px 0.985915%;
                }
                .event-content a{
                   width:87%;
                   text-align:left;
                   margin:5px 0;
                   font-weight:normal;
                }
@media only screen and (max-width: 780px){
	.event-param .first, .event-param.last {
		float: none;
	}
     .event-content .description, .event-content .event-menu{
        float: none;
        width: 100%;
        margin-bottom: 5px;
     }
}
           .event-param span {background-color: #E3EBEE;color: #000;}    
            </style>
</head>
<body>
<?php include("tools/header_new.php");?>
<div id="main">
    <?php include("tools/categories_new.php"); ?>
    <div id="content">
        <div id="content_left">
            <?php
               if (($numberBiz > 0 ) && ($rows['status'] == 1)){
            ?>
            <div class="sub_links">

                    <div class="event_table_inner" style="margin: 0px;border: solid 1px #E3EBEE;"><table  class="smart-forms" style="padding:9px; ">
                            <tr>
                                <td>
                                    <p style="text-align:center;">
                                         <?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
                                             <img src="<?php echo $image;?>" width="90" height="90" style="margin-left:auto; margin-right:auto;" alt="<?php echo $rows['business_name'];?>" class="articleImg shadow " />
                                        <?php } else { ?>
                                            <img src="<?php echo $image;?>" width="90" height="90" style="visibility:hidden;margin-left:auto; margin-right:auto;" alt="<?php echo $rows['business_name'];?>" class="articleImg shadow " />
                                        <?php } ?>
                                    </p>
                                    <p style="text-align:center;">
                                        <?php 
                                        if(!empty($rows['cmd_accr_number'])){
                                             echo '<img src="'.SITE_URL.'images/accreditation.png" style="margin-top: 5px;" alt="accreditation logo" />';
                                         }
                                        ?>
                                    </p>
                                </td>
                                <td style="text-align:center; width:90%;" >
                                    <h1 style="font-size:23px; font-weight: normal; text-align:center; margin-bottom:8px;">
                                        <?php echo $rows['business_name'];?>
                                    </h1>

                                </td>
                            </tr>

                        </table>
                    </div>
                    <div class="event-param">
                        <span class="last"><i class="fa fa-building"></i> <?php echo $biz_type ;?></span>
                        <span class="first"><i class="fa fa-flag"></i>Specialization: <?php echo $rows_cat['category_name'];?> </span>
                        <div class="clear"></div>
                    </div>
                    <div class="event-content" style="margin: 0px;">
                        <div class="description">
                            <p ><h2 style="font-size: 13px; font-weight: bold">Business Description:</h2></p>
                            <div>
                                <?php
                                    $str = stripslashes($rows['description']);
                                    //echo preg_replace('/<iframe.*?\/iframe>/i', '', $str);
                                    $xml = new DOMDocument(); 
                                    $xml->loadHTML($str); 
                                    $links = $xml->getElementsByTagName('a');
                                    //Loop through each <a> tags and replace them by their text content    
                                    for ($i = $links->length - 1; $i >= 0; $i--) {
                                        $linkNode = $links->item($i);
                                        $lnkText = $linkNode->textContent;
                                        $newTxtNode = $xml->createTextNode($lnkText);
                                        $linkNode->parentNode->replaceChild($newTxtNode, $linkNode);
                                    }
                                    echo $xml->saveHTML();
                               ?>
                            </div>         
                        </div>
                        <div class="event-menu">
                            <a href="#contact-wrapper2" class="cssButton_roundedLow cssButton_aqua modal" style="padding:10px; font-size:14px; float: right; color:#FFF;" title="Contact Business"><i class="fa fa-phone" style="font-size:16px;"></i> Contact Business</a>
                            <?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
                            <a href="<?php echo SITE_URL;?>courses/business/<?php echo $rows['business_id'].'-'.str_replace($title_link,"-",$rows['business_name']);?>" class="cssButton_roundedLow cssButton_aqua" style="padding:10px; font-size:14px; color:#FFF;float:right;" title="View Courses by this business"><i class="fa fa-book" style="font-size:16px;"></i> Courses </a>
                            <?php } ?>      
                            <?php /* if($rows['premium'] == 3 || $rows['premium'] == 2) */echo $check_website;?>
                            <a onclick="alert('<?php echo $rows['contact_person'].": ".$rows['telephone'];?>')" class="cssButton_roundedLow cssButton_aqua" style="padding:10px; font-size:14px; color:#FFF; float:right;" title="Telephone"><i class="fa fa-user" style="font-size:16px;"></i> Contact Person</a>
                            <a href="#map_canvas" onclick="$('#map_canvas').slideToggle('slow');if($(this).attr('title')=='Show Map'){ $(this).attr('title','Hide Map');} else {$(this).attr('title','Show Map');}" class="cssButton_roundedLow cssButton_aqua" style="padding:10px; font-size:14px; color:#FFF; float:right;" title="Show Map"><i class="fa fa-map-marker" style="font-size:17px;"></i> Map &amp; Location</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <?php if($rows['business_type'] == 'Venue'){;?>
                    <div  style="margin: 10px 0; border: solid 1px #E3EBEE; display: block; padding: 5px;">
                        <span ><strong>Size:</strong> <?php echo $rows['size']?></span>
                    </div>
                    <div  style="margin: 10px 0; border: solid 1px #E3EBEE; display: block; padding: 5px;">
                        <span ><strong>Capacity:</strong> <?php echo $rows['capacity']?></span>
                    </div>
                    <?php 
                     } 
                    ?>
           <?php if($rows['premium'] == 3 || $rows['premium'] == 2){?>
             <div style="margin: 10px 0; border: solid 1px #E3EBEE; display: block; padding: 5px;">
                                   <p><strong>Business Images</strong></p>
                                   <div style="padding-left:20px;">
                              <?php
                                    $images = MysqlSelectQuery("select * from pictures where user_id='".$rows['user_id']."'");
                                            if(NUM_ROWS($images) > 0){

                                                    while($rows_pic = SqlArrays($images)){
                                                            ?>
                                              <div class="gallery" id="<?php echo $rows_pic['image_id'];?>">
                              <a href="<?php echo SITE_URL;?>premium/images/<?php echo $rows_pic['images'];?>" rel="prettyPhoto[pp_gal]" title="<?php echo $rows['business_name'];?>"><img  class="img_mix" src="<?php echo SITE_URL;?>premium/images/<?php echo $rows_pic['images'];?>" width="90" height="90" alt="<?php echo $rows['business_name'];?>" /></a>
                              </div>


              <?php
                            }
                    }

               else{

                    echo '<div class="smart-forms"><div class="alert notification alert-info">No images for this business</div></div>';

                         }
                         ?>
                         <div class="clearfix"></div>
                           </div>
                    </div>
               <?php
                   }
                   ?>
                    <div style="margin: 10px 0; border: solid 1px #E3EBEE; display: block; padding: 5px;">
                        <span style="height:auto;"> <h3 style="font-size: 13px; font-weight: normal"><strong>Address:</strong> <?php echo $rows['address']?></h3></span>
                    </div>

                    <div id="map_canvas" style="display:none; margin: 10px 0; border: solid 1px #E3EBEE; padding: 5px; height: 200px;">
                    </div>
                    <div style="margin: 10px 0; border: solid 1px #E3EBEE; display: block; padding: 5px;"> 
                        <span style="float:left; margin-right:8px;"><strong>Tell your friends about this business: </strong></span> 

                        <div style="float:left;"> 
                            <div class="fb-like" data-href="<?php echo "https://www.nigerianseminarsandtrainings.com". $_SERVER['REQUEST_URI'];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false" style="margin-right:20px; float:left;"></div> 
                            <div class="fb-share-button" data-href="<?php echo "https://www.nigerianseminarsandtrainings.com". $_SERVER['REQUEST_URI'];?>" data-type="button_count" style="margin-right:20px; float:left;"></div>
                            <div style="margin-right:20px; display:block;float:left;"><div class="g-plus" data-action="share" data-annotation="bubble" ></div><!-- Place this tag after the last share tag. --></div>
                            <script type="text/javascript">
                                (function () {
                                    var po = document.createElement('script');
                                    po.type = 'text/javascript';
                                    po.async = true;
                                    po.src = 'https://apis.google.com/js/platform.js';
                                    var s = document.getElementsByTagName('script')[0];
                                    s.parentNode.insertBefore(po, s);
                                })();
                            </script>
                               <div style="margin-right:20px; display:block;float:left;"> <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a> </div>
                                <script>!function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (!d.getElementById(id)) {
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = "https://platform.twitter.com/widgets.js";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }
                                }(document, "script", "twitter-wjs");
                            </script> 
                        </div>
                        <div class="clearfix"></div>
                    </div>
</div>
            <div class="clearfix"></div>
                        <div class="respond" style="margin-top:10px"> <?php echo $GetAdverts -> LandScapeAds("Page Banner 2","Training Providers");?> </div>
            <div id="mask"></div>
            <div id="tab_slider">
                <div id="subpage" >


                                        <div id="mask"></div>
                                <div id="contact-wrapper2" style="float:left;" class="window boxContent"> 

    <form id="formProvider" name="form1" method="post" class="smart-forms form_content" >
<div class="highlights" style="margin-top:6px;">
                    <strong style="color:#006600;">Contact Business</strong>

                    </div>
                    <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgbox">


                        </div>
<table class="contact_provider_table">
<tr>

<td>
   <label class="field">
                                    <input type="text" name="subject" id="subject" class="gui-input" placeholder="Subject" required >
                                </label>
</td></tr>
<tr>

<td>  <label class="field prepend-icon">
                                    <input type="text" name="name" id="name" class="gui-input" placeholder="Name" required>
                                    <span class="field-icon"><i class="fa fa-user"></i></span>  
                </label></td></tr>
<tr>

<td><label class="field prepend-icon">
                                    <input type="email" name="email" id="emailfield" class="gui-input" placeholder="Email" required>
                                    <span class="field-icon"><i class="fa fa-envelope"></i></span>  
                                </label>
</td></tr>
<tr>

  <td>  <label class="field prepend-icon">
                                    <input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone" type="number" required >
                                    <span class="field-icon"><i class="fa fa-phone-square"></i></span>  
                  </label></td>
</tr>
<tr>

  <td>  <label class="field">
                                    <input type="text" name="address" id="address" class="gui-input" placeholder="Address">

                                </label></td>
</tr>
<tr>

  <td> <label class="field prepend-icon">
                                <textarea class="gui-textarea" id="comment" name="comment" placeholder="message" required ></textarea>
                            <span class="field-icon"><i class="fa fa-comments"></i></span>
                            <span class="input-hint"> 
                                <strong>Hint: </strong>Enter your enquiry / booking in this box. The training provider will contact you.</span>   
                        </label>
               </td>
</tr>
<tr>

  <td> <div class="smart-widget sm-left sml-120">
                            <label class="field">
                                <input type="text" name="securitycode" id="securitycode" class="gui-input sfcode" placeholder="Enter code">
                            </label>
                            <span class="button captcode">
                                <img src="<?php echo SITE_URL;?>tools/captcha.php" id="captcha" alt="Captcha anti-spam security">
                                <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
                            </span>
                        </div>
               </td>
</tr>
<tr>
  <td style="text-align:center;">
    <button class="button btn-primary" type="submit"> Send </button>
    <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',$rows['email']);?>" id="to" />
   <button class="button" id="closeBox"> Close </button></td>
  </tr>
</table> 
</form>
<div class="clearfix"></div>
</div>	


                     <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
                        <?php //echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
                        <div class="clearfix"></div>
                    </div>
        </div>
            </div><!-- end subpage -->
            <?php
            }
            else{
                echo '<p style="font-size:20px; color:#F30;">Sorry! The business information you requested has not been activated or no longer exists</p>';
            }
            ?>
            <div class="clearfix"></div>					
        </div>
        <?php include("tools/side-menu_new.php"); ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>


<?php include ("tools/footer_new.php");?>
<script src="<?php echo SITE_URL;?>js/jquery-1.4.2.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.prettyphoto.js"></script> 
<script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
//      $("a[rel^='prettyPhoto']").hover(function(){alert($(this).attr('href'))});
        $("a[rel^='prettyPhoto']").prettyPhoto();
  });
</script>

<script type="text/javascript" src="https://maps.google.com/maps?file=api&amp;v=3&amp;key=AIzaSyDSt4wuqlV19kn3NUuQGohOkeM7yuRBVgs&amp;sensor=true"></script>
<script type="text/javascript" src="<?php echo SITE_URL;?>js/jquery.gmap-1.0.3-min.js"></script>
 <script type="text/javascript">
$(function() {
    $("#map_canvas").gMap
	({ controls: false,
	   scrollwheel: false,
	   markers: [{ latitude:	<?php echo $lat;?>,
                   longitude: <?php echo $long;?>,
				    html: "<?php echo $rows['address'];?>",
                              popup: true }],
	   zoom: 15   
	});
});
</script>
<script  type="text/javascript">
  
$(document).ready(function() {	


//capcha reloader
		function reloadCaptcha(){
					$("#captcha").attr("src","<?php echo SITE_URL;?>tools/captcha.php?r=" + Math.random());
				}
				
				$('.captcode').click(function(e){
					e.preventDefault();
					reloadCaptcha();
				});

	//select all the a tag with name equal to modal
	$('.modal').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		//$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		//$('#mask').fadeIn(1000);	
		//$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window #closeBox').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#msgbox').fadeOut('slow');
		$('#mask').fadeOut('slow');
		$('.window').fadeOut('slow');
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut('slow');
		$('#msgbox').fadeOut('slow');
		$('.window').fadeOut('slow');
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        //$('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});

  
  
	$(document).ready(function()
{
	$("#formProvider").submit(function()
	{
		if($('#subject').val() == ''){
			alert("Please enter subject");
			
			return false;
		}
		if($('#name').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if ($('#emailfield').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#comment').val() == ''){
			alert("Please enter your message");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass('alert-error alert-success').addClass('alert-info').html('Sending message....').show();
		//check the username exists or not from ajax
		$.post("<?php echo SITE_URL;?>tools/send.php",{ name:$('#name').val(),email:$('#emailfield').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),address:$('#address').val(),title:$('#course').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your message has been sent!').removeClass('alert-info').addClass('alert-success').fadeTo(900,1);
			  $('#name').val("");
			  $('#email').val("");
			  $('#comment').val("");
			  $('#title').val("");
			  $('#phone').val("");
			  $('#address').val("");
			});
			//setInterval(function(){$('#contact-wrapper2').fadeOut('slow')},3000);
		  }
		  else if(data=='Security'){
			  $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Invalid Security Code!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			 $(this).html('Error sending message!').removeClass('alert-info').addClass('alert-error').fadeTo(900,1);
			// alert(data);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
});

</script>
<script type="text/javascript">
$(document).ready(function(e) {
	
	
	/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#tsearch').keyup(function(){
			$('#output_providers').fadeIn('slow');
			$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
			$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'All'}, function(data) {
				
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
			$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {queryFocus:$(this).val(),type:'All'}, function(data) {
				
				$('#output_providers').html(data)

			
		});
			}
			else{
				$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'All'}, function(data) {
				
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

<script type="text/javascript">

function ShowBox(){
	$('#contact-wrapper2').toggle('slow'); 
}

function showEmail(){
	var emailele = document.getElementById('email')
	
	emailele.innerHTML = '<?php echo '<a href="mailto:'.str_replace('@','&#64;',$rows['email']).'">Email Business</a>';?>';
}
function showWeb(){
	var Web = document.getElementById('website')

	Web.innerHTML = '<?php if($rows['website'] != '') echo $rows['website']; else echo 'NIL';?>';
}

function showPhone(){
	var Phone = document.getElementById('Phone1');
	
	Phone.innerHTML = '<?php if($rows['telephone'] != '') echo $rows['telephone']; else echo 'NIL';?>';
}
</script>
<script>
       $(document).ready(function() {
            $("#hamburger").click(function(e) {
            $("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
            $("#main-menu").toggleClass("mobile-hide");
        });
        $(".mobile-show > a").click(function(e) {
            e.preventDefault();
            $(this).parent().children("ul").toggle();
        });

    });
</script>
</body>
</html>