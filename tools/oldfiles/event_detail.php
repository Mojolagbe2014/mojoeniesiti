<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

$id = "";

if(isset($_GET['id'])) 
	$id = $_GET['id'];
else if (isset($_GET['detail']))
	$id = $_GET['detail'];
else{
	header("HTTP/1.1 301 Moved Permanently");

	header( "location: ".SITE_URL );
}
	
	       
$url ="";

if(connection()){
	
	 
	CatchViews($id);
	
	$result = MysqlSelectQuery("select * from events where event_id = '$id'");


	/*if(NUM_ROWS($result) == 0){

		header("HTTP/1.1 301 Moved Permanently");

	 header("location: ".SITE_URL);

	 }*/
	 
	

	$rows = mysql_fetch_array($result);


	 $business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".addslashes($rows['name'])."%' and premium >= 2");
	$biz_name = SqlArrays($business);
	if($biz_name['logos'] == '') $logo = ''; else $logo = '<img src="'.SITE_URL.'user/logos/thumbs/'.$biz_name['logos'].'" alt="business logo" width="60" height="60"/>';
	
	$url = $rows['website'];

	 $cat =  MysqlSelectQuery("select * from categories where category_id = '".$rows['category']."'");

	 $rows_cat = mysql_fetch_array($cat);
	 

}

$advert = "Event Detail";

if (!strstr($url, "http://") == $url) {$url ="http://".$rows['website']; }

function tags($tag){
	if($tag){
	$getTags = explode(",",$tag);
	$link ="";
	for($i = 0; $i <  sizeof($getTags); $i++){
		$link .= '<a href="'.SITE_URL.'all_event_tag_search?tag='.ucfirst(str_replace(" ","",$getTags[$i])).'" style="font-size:12px;text-decoration:underline; font-weight:normal;color:#060;" >'.ucfirst(str_replace(" ","",$getTags[$i])).'</a> ';
			
	}
	return $link;
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"

	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo substr($rows['event_title'],0,65)."(EVID:".$rows['event_id'].")";?></title>

<meta name="description" content="<?php echo substr(strip_tags(stripslashes(str_replace('"',"'",$rows['description']))),0,130)."(EVID:".$rows['event_id'].")";?>"/>


	
	<link rel="stylesheet" href="<?php echo SITE_URL_S;?>style.css" type="text/css" media="screen" />


	<?php include("scripts/headers.php");?>
    
    <script type="text/javascript">

function showPhone(){
	var Phone = document.getElementById('Phone');
	Phone.style.backgroundColor='white';
	Phone.style.color='black';
	Phone.innerHTML = '<?php if($rows['phone'] != '') echo $rows['phone']; else echo 'NIL';?>';
}


</script>
    
    <style>

 .pastSearch {
background: -webkit-gradient(linear, bottom, left 175px, from(#FFF3D5), to(#FFF9EA));
background: -moz-linear-gradient(bottom, #FFF3D5, #FFF9EA 175px);
margin:auto;
position:relative;
width:680px;



line-height: 24px;

text-decoration: none;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
padding:10px;
border: 1px solid #999;
border: inset 1px solid #333;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
margin-top:10px;
border-bottom:5px;
}
.buttonContact {
width:100px;
position:absolute;
right:20px;
bottom:20px;
background:#09C;
color:#fff;
font-family: Tahoma, Geneva, sans-serif;
height:30px;
-webkit-border-radius: 15px;
-moz-border-radius: 15px;
border-radius: 15px;
border: 1p solid #999;
}

.buttonContact:hover {
background:#fff;
color:#09C;
}
.input    {
width:375px;
display:block;
border: 1px solid #999;
height: 25px;
padding-left:3px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.clearlines tr td{
	border:none;
	padding:5px;
}
.input1 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.input1 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
    .input2 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.input2 {width:375px;
display:block;
border: 1px solid #999;
height: 25px;
-webkit-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
-moz-box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.3);
}
.wide{
	height:150px;
}
#Phone{
	border-radius:3px;
	background:#060;
	cursor:pointer;
	color:#FFF;
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



<script type="text/javascript">

function ShowBox(){
	$('#contact-wrapper2').toggle('slow'); 
}
                  </script>

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

 <?php include("tools/header2.php");?>
 <div id="main">
    

	<div id="content">

		<div id="content_left">

				<div class="sub_links">
 <h4 class="categoryHeader">Event Detail</h4>
                <div id="contact-wrapper" class="rounded"> 

				<div class="video_box">
 
					</div>
                    <?php if($rows['status'] == 0){;?>
                    <table width="100%" id="listTable" style="background-color:#FFF9EA;">
  <tr>
    <td style="font-size:16px; color:#F60;">Sorry this course is currently being reviewed</td>
  </tr>
</table>
<?php
					}
					else{
					?>

                    
					<table width="100%" id="listTable" style="background-color:#FFF9EA;">

                  

  <tr>

    <td colspan="4" valign="middle" style="font-size:20px; color:#090; line-height:20px; padding-bottom:7px"><p><?php echo ucwords(strtolower($rows['event_title']));?></p><br/><br /><br />
    <div><div class="fb-like" data-href="http://nigerianseminarsandtrainings.com/event_detail?id=<?php echo $rows['event_id'];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
    <div class="fb-share-button" data-href="http://nigerianseminarsandtrainings.com/event_detail?id=<?php echo $rows['event_id'];?>" data-type="button_count"></div>
<div class="g-plus" data-action="share" data-annotation="bubble"></div>
 <!-- Place this tag where you want the su badge to render -->
<su:badge layout="1" location="http://nigerianseminarsandtrainings.com/event_detail?id=<?php echo $rows['event_id'];?>"></su:badge>

<!-- Place this snippet wherever appropriate -->
<script type="text/javascript">
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>
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
 
 </div></td>
    <td colspan="2" align="center" style="font-size:17px; color:#0072BC; padding-bottom:7px"><strong style="margin-bottom:5px; display:block;"><span style="color:#0072BC; font-size:12px">Watch Preview</span></strong><?php if( $rows['videoID'] == ''){;?>
    <img src="<?php echo SITE_URL;?>images/tube_no_video.png" class="youTube" width="120" height="90" alt="nigerian seminars and training youtube"/>
    <?php
	}
	else{
	?>
    <a href="<?php echo $rows['videoURL'];?>" ><!--<div class="youTube_bg"></div>--><img src="http://img.youtube.com/vi/<?php echo $rows['videoID'];?>/2.jpg" class="youTube" width="120" height="90" alt="nigerian seminars and training youtube"/></a>
    <?php
	}
	?>
    </td>
    </tr>

  <tr>
    <td width="7%" rowspan="3" style="font-size:16px; color:#0072BC; padding-bottom:7px"><?php echo $logo;?></td>

    <td width="18%"><strong><span style="color:#0072BC; font-size:14px">Provider:</span></strong></td>

    <td><span style="color:#090; font-size:14px; text-transform:capitalize;"><strong><?php echo $rows['organiser'];?></strong></span></td>
    <td><span style="color:#666;font-size:12px"><span style="color:#666; font-size:12px"><span style="color:#0072BC; font-size:12px"><strong>Date:</strong></span></span></span></td>
    <td colspan="2" align="left"><span style="color:#666;font-size:14px"><?php echo $rows['startDate'];?> <strong>to</strong> <?php echo $rows['endDate'];?></span></td>


    </tr>

  <tr>
    <td><strong><span style="color:#0072BC; font-size:14px">Duration:</span></strong></td>


    <td width="37%"><span style="color:#666; font-size:14px"><?php echo dateDiff($rows['startDate'], $rows['endDate']);?></span></td>
    <td width="7%" align="right"><span style="color:#666;font-size:12px"><span style="color:#666; font-size:14px"><span style="color:#0072BC; font-size:14px"><strong>
      <?php if( $rows['premium']==1){echo'Contact';}?>
    </strong></span></span></span></td>

    <td colspan="2" align="left"><span style="color:#666;">
      <?php if( $rows['premium']==1){?>
      <span id="Phone" onclick="showPhone()">Click to call provider</span>
      <?php ;}?>
    </span></td>
    </tr>

  <tr>
    <td valign="top"><strong><span style="color:#0072BC; font-size:14px">Category:</span></strong></td>

    <td valign="top" style="color:#666;font-size:14px"><?php echo $rows_cat['category_name'];?></td>
    <td colspan="3"  align="right" valign="top" style="color:#666;font-size:12px">&nbsp;</td>
    </tr>

  <tr>

    <td>&nbsp;</td>
    <td><strong><span style="color:#0072BC; font-size:14px">Venue:</span></strong></td>

    <td style="color:#666;font-size:14px"><?php echo $rows['venue'];?></td>
    <td colspan="3" style="color:#666;font-size:12px">&nbsp;</td>
    </tr>

  <tr>

    <td>&nbsp;</td>
    <td><strong><span style="font-size: 14px; color:#0072BC;">Attendance  Fee:</span></strong></td>

    <td><span style="color:#666;font-size:14px"><?php echo $rows['cost'];?></span></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>

  <tr>

    <td colspan="3"><span style="color:#0072BC; font-size:14px"><strong>Event Description:</strong></span></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    </tr>


  <tr bgcolor="#F7F7F7">


    <td colspan="6" style="color:#333"><div class="description" style="font-size:13px; text-align:justify;"><?php echo stripslashes($rows['description']);?>
    </div>
   </td>

  </tr>

  <tr>
    <td style="color:#666;"><span style="color:#0072BC; font-size:12px"><strong>Tags:</strong></span></td>
    <td colspan="5" style="color:#666;"><?php echo tags($rows['tags']);?></td>
    </tr>
  <tr>

    <td colspan="4" style="color:#666;"> 
   

 
    
</td>


    <td width="11%" align="right" style="color:#666;"><?php if(($rows['premium'] > 0) && ($rows['premium'] !=8) ){ if($rows['website'] != ''){?><a href="<?php echo $url;?>" target="_blank" onclick="GetWebClicks('<?php echo $rows['organiser'];?>')"><img src="<?php echo SITE_URL;?>images/link_btn.png" alt="Nigerian Seminars and Trainings Visit Site"/></a><?php }}?></td>
    <td width="20%" align="right" style="color:#666;"><a href="javascript:void(0);" onclick="ShowBox()" ><img src="<?php echo SITE_URL;?>images/contact_btn.png" width="132" height="28" /></a>
      
    </td>



    </tr>
                </table>
                <?php
					}
					?>

<div id="contact-wrapper2" class="rounded" style="display:none"> 

<form id="login-form2" name="form1" method="post" action="" class="pastSearch" >
<center><strong><span style="color:#0072BC; font-size:12px; ">Contact Training Provider</span></strong></center>
<table width="41%"  class="clearlines">
<tr>
  <td width="37%" height="26"><strong><span style="color:#0072BC; font-size:12px">Subject:</span></strong></td>
<td width="5%">&nbsp;</td><td width="58%">
  <input name="title" type="text" class="input" id="title" />
</td></tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Name:</span></strong></td>
<td>&nbsp;</td>
<td> <input name="name" type="text" class="input" id="name" /></td></tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Email:</span></strong></td>
<td>&nbsp;</td>
<td><input name="email" type="text" class="input" id="email" />
</td></tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Phone:</span></strong></td>
  <td>&nbsp;</td>
  <td> <input name="phone" type="text" class="input" id="phone" /></td>
</tr>
<tr>
  <td><strong><span style="color:#0072BC; font-size:12px">Address:</span></strong></td>
  <td>&nbsp;</td>
  <td> <input name="address" type="text" class="input" id="address" /></td>
</tr>
<tr>
  <td valign="top"><strong><span style="color:#0072BC; font-size:12px">Message:</span></strong></td>
  <td>&nbsp;</td>
  <td> <textarea name="message" cols="45"  class="input wide" id="message"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td></td>
  <td><span id="msgbox" style="display:none;" ></span></td>
</tr>
<tr>
  <td><input name="to" type="hidden" value="<?php echo $rows['email'];?>" id="to" />
                  <input name="course" type="hidden" value="<?php echo $rows['event_title'];?>" id="course" /></td>
<td></td>
<td>
  <input  type="submit" class="buttonContact" name="button" id="button" value="Submit" />
</td></tr>

 

</table> 
</form>
</div>
</div>
    </div>

                     <div class="sub_links2_middle"><div class="sub_links2_middle">


 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>



<div class="clearfix"></div>


<div class="divider"  style=" border:#0C0; margin-bottom:20px;"></div>
 
       <?php include("tools/categories.php");?>
 
</div>
</div>

<div class="divider"></div>

      <div id="sub_links"><div id="sub_links2_middle"><?php 

 echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>

<div class="clearfix"></div>

</div></div><!-- end subpage -->

					

		</div>
	    <?php include("tools/side-menu.php");?>
	</div>
</div>

	

	<div class="clearfix"></div>


</div>

	
  
  
</div>

<?php include ("tools/footer.php");?>


</body>


</html>