<?php
	session_start();
	require_once("../scripts/config.php");
	require_once("../scripts/functions.php");
	$advert = "Articles";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta property="og:image" content="http://localhost/nigerianseminars/images/nigerianseminars_logo.png"/>
  <meta property="og:image:type" content="image/jpeg"/>
  <meta property="og:image:width" content="250"/>
  <meta property="og:image:height" content="250"/>
  <?php include('../tools/analytics.php');?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="http://localhost/nigerianseminars/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <title><?php echo substr(trim("Nigeria Can Strengthen Economy via Wheat Trade Liberalization"), 0, 65);?></title>
  <meta name="description" content="
	Report Highlights: Nigeria remains a huge export market for wheat with export value of U.S. wheat averaging $1 billion, about 85 - 70"/>
  <?php include("../scripts/headers_new.php");?>
  <script type="text/javascript" src="http://localhost/nigerianseminars/css/smartforms/js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="http://localhost/nigerianseminars/css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
  <script>
  // over lay pop up controler
  $(document).ready(function() {	
  
  
  //capcha reloader
  function reloadCaptcha(){
  $("#captcha").attr("src","http://localhost/nigerianseminars/tools/captcha.php?r=" + Math.random());
  }
  
  $('.captcode').click(function(e){
  e.preventDefault();
  reloadCaptcha();
  });
  
  //select all the a tag with name equal to modal
  $('.author').click(function(e) {
  //Cancel the link behavior
  e.preventDefault();
  
  //Get the A tag
  var id = $(this).attr('href');
  
  //Get the screen height and width
  var maskHeight = $(document).height();
  var maskWidth = $(window).width();
  
  //Set heigth and width to mask to fill up the whole screen
  $('#mask').css({'width':maskWidth,'height':maskHeight});
  
  //transition effect		
  $('#mask').fadeIn(1000);	
  $('#mask').fadeTo("slow",0.8);
  
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
  
  //$('#msgbox').fadeOut('slow');
  $('#mask').fadeOut('slow');
  $('.window').fadeOut('slow');
  });		
  
  //if mask is clicked
  $('#mask').click(function () {
  $(this).fadeOut('slow');
  //$('#msgbox').fadeOut('slow');
  $('.window').fadeOut('slow');
  });			
  
  $(window).resize(function () {
  
  var box = $('#boxes .window');
  
  //Get the screen height and width
  var maskHeight = $(document).height();
  var maskWidth = $(window).width();
  
  //Set height and width to mask to fill up the whole screen
  $('#mask').css({'width':maskWidth,'height':maskHeight});
  
  //Get the window height and width
  var winH = $(window).height();
  var winW = $(window).width();
  
  //Set the popup window to center
  box.css('top',  winH/2 - box.height()/2);
  box.css('left', winW/2 - box.width()/2);
  
  });
  
  
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
  else if ($('#email').val() == ''){
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
  $.post("http://localhost/nigerianseminars/tools/authors-mail.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#comment').val(),subject:$('#subject').val(),to:$('#to').val(),phone:$('#phone').val(),security:$('#securitycode').val(), rand:Math.random() } ,function(data)
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
  
  
  });
  
  // over lay pop up controler
  $(document).ready(function() {	
  
  
  //select all the a tag with name equal to modal
  $('.prompt').click(function(e) {
  //Cancel the link behavior
  e.preventDefault();
  
  //Get the A tag
  var id = $(this).attr('href');
  
  
  
  //Get the screen height and width
  var maskHeight = $(document).height();
  var maskWidth = $(window).width();
  
  //Set heigth and width to mask to fill up the whole screen
  $('#mask').css({'width':maskWidth,'height':maskHeight});
  
  //transition effect		
  $('#mask').fadeIn(1000);	
  $('#mask').fadeTo("slow",0.8);	
  
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
  $('.window_currency #closeBox').click(function (e) {
  //Cancel the link behavior
  e.preventDefault();
  
  //$('#msgbox').fadeOut('slow');
  $('#mask').fadeOut('slow');
  $('.window_currency').fadeOut('slow');
  });		
  
  //if mask is clicked
  $('#mask').click(function () {
  $(this).fadeOut('slow');
  //$('#msgbox').fadeOut('slow');
  $('.window_currency').fadeOut('slow');
  });			
  $('.close button').click(function () {
  $('#mask').fadeOut('slow');
  //$('#msgbox').fadeOut('slow');
  $('.window_currency').fadeOut('slow');
  });			
  
  $(window).resize(function () {
  
  var box = $('#boxes .window_currency');
  
  //Get the screen height and width
  var maskHeight = $(document).height();
  var maskWidth = $(window).width();
  
  //Set height and width to mask to fill up the whole screen
  $('#mask').css({'width':maskWidth,'height':maskHeight});
  
  //Get the window height and width
  var winH = $(window).height();
  var winW = $(window).width();
  
  //Set the popup window to center
  box.css('top',  winH/2 - box.height()/2);
  box.css('left', winW/2 - box.width()/2);
  
  });
  
  });
  
  
  </script>
  <style>
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
  width:auto;
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
  .close {
  text-decoration:none; cursor:pointer; width:20px;
  }
  .close button { cursor:pointer; width:20px }
  -->
  </style>
</head>
  
<body>
  <?php include("../tools/header_new.php");?>
  <div id="main">
  <div id="content">
  <?php include("../tools/categories_new.php");?>
  <div id="content_left">
  <div id="sub_links">
  <div class="event_table_inner " style="margin-bottom:8px;">
  <table style="width:100%;" >
  <tr>
  <td style="padding-left:8px; width:11%; text-align:center;">
  <div class="imageFloat"><img src="http://localhost/nigerianseminars/images/nigerianseminars_logo.jpg" width="100" height="100" alt="nigerian seminars article logo" class="articleImg shadow" /></div>
  </td>
  <td style="text-align:center;">
  <h1 style="font-size:23px; text-align:center;">Nigeria Can Strengthen Economy via Wheat Trade Liberalization</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=70" title="Authors Page">
  <p style="color:#fff;"> Author:&nbsp;&nbsp;USDA Foreign Agricultural Service </p>
  </a>
  </div>
  <!--social media-->
  <!--end social media-->
  </td>
  </tr>
  </table>
  
  <div class="clearfix"></div>
  </div>
  
  <div id="contact-wrapper" class="rounded"> 
  
  
  <div class="video_box">
  
  <table  id="listTable">
  <tr>
      <td colspan="3"><div class="description" style="font-size:13px; text-align:justify;"><p style="text-align: justify;">
	Report Highlights: Nigeria remains a huge export market for wheat with export value of U.S. wheat averaging $1 billion, about 85 percent share of the wheat market. The high demand is mostly pressured by increasing &nbsp;consumption of wheat flour - based products &nbsp;and insufficient &nbsp;domestic substitutes. The Government of Nigeria (GON) efforts at becoming a major wheat - producing country since 1959 have still not been &nbsp;attained and domestic wheat production has remained at 50,000 metric tons out of 3.7 million metric tons it consumes per year. The country&rsquo;s wheat milling capacity is about 8.0 million tons with capacity &nbsp;utilization at approximately 50 percent. Although not permitted, wheat flour &nbsp;and other wheat - based products from Nigeria worth much more than 400,000 metric tons are also informally exported to its neighboring countries while the GON have continued to introduce measures such as high levies, to cut back on wheat imports. With the country&rsquo;s current position in wheat milling within Sub - Sahara Africa, Nigeria would better grow its economy by dropping wheat import levies and growing its export market for wheat - based products in the region.</p>
<p style="text-align: justify;">
	General Information:</p>
<p style="text-align: justify;">
	Introduction</p>
<p style="text-align: justify;">
	Wheat cultivation began in Nigeria in the 16th century utilizing local methods and low - yielding seed in pockets of lands where varying temperature permitted its cultivation. The wheat area covers mainly the Sudan/Sahelian zones of Borno, Yobe, Bauchi, Jigawa, Kano, Zamfara, Katsina, Sokoto, Kebbi and Adamawa States where commercial wheat production can be possible through the use of expensive irrigation. For Nigeria to reach significance in wheat production, the country will need to explore producing the crop under less expensive rain - fed conditions, especially in the highland areas of the country such as the plateaus of Mambila, Jos and Obudu. Also, there is the need to expand areas under production and increase the yield of varieties through improved b reeding and management. Nigeria&rsquo;s efforts at exploiting its wheat growing potential are challenged by inconsistent agricultural policies, poor marketing channels, and weak farming organizations and motivation. Nigeria should drop its wheat import levies to its wheat flour wheat flour and related products export market in Sub - Sahara Africa to permit it grow utilizing more fully its installed capacity in wheat milling currently at 50 &nbsp;percent.</p>
<p style="text-align: justify;">
	Background of Nigeria&rsquo;s Wheat Sector</p>
<p style="text-align: justify;">
	The first major Government of Nigeria (GON) intervention on wheat production came in 1959 and was spurred by the development of irrigation schemes for Northern Nigeria and increasing local demand for &nbsp;bread. These attracted many towards growing wheat. In 1987 the GON initiated the Accelerated Wheat Production Program (AWPP) in order to stimulate local wheat production and encourage backward integration. This was followed by a decline in wheat importation that year and eventually resulted in an outright ban on wheat imports into the country. Wheat production figures increased from 400,000 to 600,000 metric tons whereas the estimated total national demand for wheat stood at about 3.7 million metric tons per year. The GON lifted the import ban on wheat six years later in 1993. Nigeria&rsquo;s wheat production figures then declined to 50,000 metric tons following this, given that local production was not economically viable.</p>
<p style="text-align: justify;">
	Economics of Wheat</p>
<p style="text-align: justify;">
	Nigeria is a huge export market for wheat. High demand for wheat flour for the production of bread, noodles, pasta and biscuits (cookies) contributes to Nigeria&rsquo;s wheat market being worth approximately $1 billion (over 85 percent market share) in U.S. exports. Nigeria&rsquo;s wheat milling capacity increased in 2012/13 to about 8.0 million tons, up from 6.6 million tons, although local capacity utilization is about 50 percent. Flour Mills of Nigeria (FMN) continues to be the market leader by capacity but other millers, such as Dangote, Honeywell, and BUA, keep increasing market share. Competition among the wheat millers remains strong on the basis of price and quality.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: justify;">
	Wheat in Nigeria was mainly milled into flour for bakery and confectionery as well as domestic pastries and local dishes. Recently, wheat meals such as semovita or semolina, etc., are gaining popularity in our restaurants. Additionally, the Nigerian baking industry (small and large independent bakeries and retail in - store bakeries) continues to expand and upgrade production facilities. The increased competition has resulted in &nbsp;a more diverse product selection and an increase in the variety and quality of fresh baked products available to consumers.</p>
<p style="text-align: justify;">
	Consumption patterns are changing in line with the strong growth of the middle class. Production of bread continues to expand because it is a standard item in the modern breakfast diet and it is convenient for many Nigerians. The rapid growth in the quick service restaurant industry (fast food) offering savory pastries in recent years has also contributed to increased wheat demand.</p>
<p style="text-align: justify;">
	At present, Nigeria is experiencing the greatest growth in the production of pasta (noodles) as virtually all flour mills in the country have established noodle production facilities. Noodle production is estimated to use up to 560,000 metric tons of Hard Red Winter (HRW) wheat in 2012/13.</p>
<p style="text-align: justify;">
	Although Nigeria is traditionally a market for HRW, in recent years there has also been a steady increase in demand for other types of wheat such as Soft Red Winter (SRW) for use in cookies (biscuit) production, Hard White Wheat (HWW) for bread and noodle production, and even Durum (wheat) for pasta.</p>
<p style="text-align: justify;">
	Nigeria Exports Wheat Flour</p>
<p style="text-align: justify;">
	According to industry sources, Nigerian wheat flour is exported informally to neighboring countries as &nbsp;official exports are not permitted. Trade figures are not available for such exports, but industry sources estimate informal exports of wheat products to far exceed 400,000 metric tons. Branded Nigerian flour can be found in several countries in West and Central Africa. Export figure was estimated much higher except that this trade has been reduced by the &ldquo;Boko Haram&rdquo; (BH) insurgent&rsquo;s terrorist activities as borders have been more tightly controlled and less trade flows over them.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: justify;">
	Research for Increased Local Wheat Production</p>
<p style="text-align: justify;">
	Current domestic wheat production is low at less than 100,000 tons per year and increased production is mostly challenged by the lack of development of heat tolerant wheat varieties that are high yielding and development of rain - fed wheat cultivars that are tolerant /resistant to high temperatures, humidity, pests and diseases. In 1959, some increased research in promoting local wheat production resulted in the introduction of some improved and high - and early - yielding local wheat varieties for better bread making. The Lake Chad Research Institute [Nigeria&rsquo;s science and research institute covering wheat for high quality breeder and foundation seeds for seed companies, state agricultural development projects (ADPs) and lead farmers, who produce certified seeds for farmers] collaborated with International Maize and Wheat Improvement Center (CIMMYT) to do so.</p>
<p style="text-align: justify;">
	Poor extension services, inadequate capital, weak infrastructure, insecurity and myriads of other limiting factors restrain Nigeria&rsquo;s efforts at increasing local wheat production for addressing the country&rsquo;s food security challenges....</p>
</div><br /><br />
  <div>
      <div class="articleaboutAuthor"><h2 style="font-size:13px;">About the Author - <span style="color:#000;font-weight: bold">USDA Foreign Agricultural Service</span></h2></div><br />
  <div> 
  <div >
      <div style=" width:100%"><div style="text-align:justify;  font-size:12px"><p>
	This report contains assessments of commodity and trade issues made by USDA staff and not necessarily statements of official U.S. government policy.</p>
<p>
	&nbsp;</p>
<p>
	Report: Nigeria Remains a Strong Growth Market for Wheat</p>
<p>
	&nbsp;</p>
<p>
	Approved by: Russ Nicely, Regional Agricultural Counselor</p>
<p>
	&nbsp;</p>
<p>
	Written by: Uche M. Uzeka, Agricultural Marketing Specialist</p>
<p>
	&nbsp;</p>
<p>
	Post: Lagos, Nigeria</p>
</div></div>
  </div>
  </div>
  </div>

  <br />
  
  </td>
  </tr>
  
  <tr class="smart-forms">
  <td style="text-align:left;">
  <a href="http://localhost/nigerianseminars/author/USDA-Foreign-Agricultural-Service" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;" title="More articles by USDA Foreign Agricultural Service" > More articles by USDA Foreign Agricultural Service</a>
  </td>
  <td style="text-align:left;"> <h3 style="font-weight:normal;font-size: 13px;"><a href="#author-contact" class="cssButton_roundedLow cssButton_aqua author" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;">Contact Author</a></h3></td>
  <td style="width:30%; text-align:right;">
  
  <?php  
  if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
  $link = "http://localhost/nigerianseminars/download_article/70/".stripslashes("Nigeria_Can_Strengthen_Economy_via_Wheat_Trade_Liberalization_Lagos_Nigeria_6-27-2013.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/70/Nigeria_Can_Strengthen_Economy_via_Wheat_Trade_Liberalization_Lagos_Nigeria_6-27-2013.pdf";
  }
  ?>
  
  <a href="<?php echo $link;?>" target="_blank"  class="cssButton_roundedLow cssButton_aqua <?php echo $name;?>" onClick="GetAction('<?php echo $ArticleUrl ;?>')" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;" title="Download full article">Download full article &nbsp;<img src="http://localhost/nigerianseminars/images/pdf-icon.png" width="20" height="20" style="vertical-align:middle;" alt="pdf icon"/></a>
  </td>
  </tr>
  
  </table>
  <div class="tags">
  <div> 
  <p style="float:left; margin-right:8px;"><strong>Share this article: </strong></p> 
  <div style="float:left;"> 
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/70/".str_replace($title_link,"-","Nigeria Can Strengthen Economy via Wheat Trade Liberalization");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/70/".str_replace($title_link,"-","Nigeria Can Strengthen Economy via Wheat Trade Liberalization");?>" data-type="button_count"></div>
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
  
  <div class="tags">
  
  
  <p> 
  <span>
  <strong style="float:left; margin-right:8px;">Tags: </strong> <?php echo tags("Wheat, Demand, Production, Development, Competition, Consumption.",'articletagsearch');?>
  </span>
  </p>
  <div class="clearfix"></div>
  </div>
  
  </div>
  <!--prompt for download-->
  <div id="Login_pop" style="float:left;" class="window_currency boxContent smart-forms">
  <div class="alert notification alert-error">
  <a href=''  class="close">X</a><br/>
  <p>You must be logged in to download this quarterly guide, 
  <a href="http://localhost/nigerianseminars/login" >Click here</a> to login. <br /> 
  Dont have an account? <a href="http://localhost/nigerianseminars/biz-info">Click here</a>
  to register as a business or <a href="http://localhost/nigerianseminars/subscribers">Click here</a> 
  to register as a subscriber</p>
  </div>
  <br />
  </div>
  <!-- end prompt-->
  <div class="respond">
  </div>
  </div>
  
  <div id="mask"></div>      
  <div id="author-contact" style="float:left;" class="window boxContent"> 
  <form id="formProvider" name="form1" method="post" class="smart-forms form_content" >
  <div class="highlights" style="margin-top:6px;">
  <strong style="color:#006600;">Contact USDA Foreign Agricultural Service</strong>
  
  </div>
  <div class="notification alert-info spacer-t10" style="float:left; width:100%; display:none;" id="msgbox">
  
							
  </div>
  <table class="contact_provider_table">
  <tr>
  
  <td style="width:85%;">
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
  <input type="email" name="email" id="email" class="gui-input" placeholder="Email" required>
  <span class="field-icon"><i class="fa fa-envelope"></i></span>  
  </label>
  </td></tr>
  <tr>
  
  <td>  <label class="field prepend-icon">
  <input type="tel" name="phone" id="phone" class="gui-input" placeholder="Telephone" required >
  <span class="field-icon"><i class="fa fa-phone-square"></i></span>  
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
  <img src="http://localhost/nigerianseminars/tools/captcha.php" id="captcha" alt="Captcha anti-spam image">
  <span class="refresh-captcha"><i class="fa fa-refresh"></i></span>
  </span>
  </div>
  </td>
  </tr>
  <tr>
  <td style="text-align:center;" >
  <button class="button btn-primary" type="submit"> Send </button>
  <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',"");?>" id="to" />
  <input name="course" type="hidden" value="" id="course" /> <button class="button" type="button" id="closeBox"> Close </button></td>
  </tr>
  </table> 
  </form>
  <div class="clearfix"></div>
  </div>
  
  
  
  <!-- Begin BidVertiser code -->
  <?php // echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
  
  <div class="fb-comments" data-href="<?php echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" data-width="720px" data-numposts="5" data-colorscheme="light"></div>
  
  
  <div id="sub_links2_middle"><div><!-- Begin BidVertiser code -->
  
  <div class="clearfix"></div>
  </div>
  <div>
  <!--<div class="divider"></div>-->
  <?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
  <div class="clearfix"></div>
  </div>
  </div><!-- end subpage -->
<div class="video_box" style="margin-top:20px">
<h3>Related Articles</h3>
<?php $result = MysqlSelectQuery("SELECT * FROM `articles` WHERE status=1 ORDER BY RAND() desc LIMIT 3"); if(NUM_ROWS($result) > 0){ ?>

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
<?php } ?>
</div>
  </div>	
  </div>
  
  <?php include("../tools/side-menu_new.php");?>
  </div>
  
  <div class="clearfix"></div>
  </div>
  <div class="clearfix"></div>
  </div>
  
  <?php include ("../tools/footer_new.php");?>
  
</body>
</html>