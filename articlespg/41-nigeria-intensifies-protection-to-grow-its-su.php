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
  <title><?php echo substr(trim("Nigeria Intensifies Protection to Grow Its Sugar Sector"), 0, 65);?></title>
  <meta name="description" content="
	The Government of Nigeria has banned imports of packaged sugar, granulated and in cubes, beginning January 2013. Nigeria&rsquo;s - 41"/>
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
  <h1 style="font-size:23px; text-align:center;">Nigeria Intensifies Protection to Grow Its Sugar Sector</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=41" title="Authors Page">
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
	The Government of Nigeria has banned imports of packaged sugar, granulated and in cubes, beginning January 2013. Nigeria&rsquo;s Trade and Investment Minister, Dr. Olusegun Aganga, said this was in line with the Nigerian Sugar Master Plan which aims at achieving self-sufficiency in the country&rsquo;s sugar production by 2020. Imports of machinery for local sugar refineries have recently been made tariff-free and investors in domestic sugar processing also get a five-year tax holiday. Minister Aganga indicated that the National Sugar Master Plan was designed to increase local sugar production, attain self-sufficiency, reduce dependence on importation as well as create job opportunities and increase prospects of contributing to the production of ethanol. Currently, more than 90 percent of all sugar consumed in Nigeria is imported raw, mostly from Brazil, and refined by domestic sugar refineries.</p>
<p style="text-align: justify;">
	Overview:</p>
<p style="text-align: justify;">
	Nigeria&rsquo;s Trade and Investment Minister Dr. Olusegun Aganga, together with the Executive Secretary of the country&rsquo;s National Sugar Development Council (NSDC), Dr. Latif D. Busari, announced recently that the GON had banned imports of packaged sugar, granulated and in cubes, effective January 2013. According to these officials, this is being done as part of the Nigerian Sugar Master Plan, which aims to achieve self-sufficiency in sugar consumption by 2020. Also, Nigeria&rsquo;s Minister for State, Agricultural and Rural Development, Dr. Bukar Tijani, (Deputy Minister for Agriculture) on a different occasion, also announced that the GON will ban all imports of sugar in any form, raw or refined, into the country by January 2015.</p>
<p style="text-align: justify;">
	Pending the outright sugar ban in 2015, Minister Aganga indicated that presently all importers of brown sugar are mandated to own sugar farms in the country or contract out sugar farming to individual local farmers if they are to continue having licenses to import brown sugar for refining. He disclosed that the GON would take the issue of sugar policy implementation seriously in order to develop the country economically and create wealth for Nigerians.</p>
<p style="text-align: justify;">
	According to the GON officials, the import ban on sugar would attract an estimated $3.1 billion foreign direct investment into the country, whereas the backward integration program for sugar would generate local production of 1.8 million tons of sugar and 161.2 million liters of ethanol annually. The new measures are also expected to create about 37,000 permanent jobs and approximately 80,000 seasonal jobs, save about U.S. $66 million in foreign exchange on fuel imports annually and $350 to $500 million in foreign exchange on sugar imports annually.</p>
<p style="text-align: justify;">
	Domestic Sugar Production</p>
<p style="text-align: justify;">
	Nigeria&rsquo;s domestic sugar production in MY2011/12 is forecast at 65,000 tons (raw value), up from the revised estimate of 60,000 tons in MY2010/11. The Nigerian Sugar Development Council (NSDC) was established as the GON agency responsible for formulating sugar policies and strategies. NSDC recently refocused towards promoting private sector-led development. Government-owned sugar estates were privatized in 2005. Investment in local sugar production is hampered by the huge funds required to establish a sugar estate as well as the lack of long-term loans for investment purposes in the country. However, the management of these estates improved under privatization, which also mostly accounted for the marginal increase recorded in sugar production. For further details, see http://www.nsdc.gov.ng/sugar_impo%20fron%20incep.html</p>
<p style="text-align: justify;">
	Nigeria&rsquo;s Sugar Consumption</p>
<p style="text-align: justify;">
	Nigeria is the largest consumer of sugar in Africa apart from South Africa, and the industry is still dependent on raw sugar imports. Nigeria&rsquo;s overall sugar consumption in MY2011/12 was estimated at 1.34 million tons and raw sugar imports 1.5 million tons. However, only 100,000 tons of refined sugar was imported that year. Industry sources project Nigeria&rsquo;s sugar consumption will grow 27 percent to reach 1.7 million tons by 2016. This growth projection is driven mostly by the expectation of strong population growth and the lack of available substitutes as well as increasing industrial demand. &nbsp;</p>
<p style="text-align: justify;">
	Sugar use in industrial activities such as manufacturing soft drinks, pharmaceuticals, biscuits, other beverages and confectionery products is also rising steadily despite higher international prices, and there is no competing High-Fructose Corn Syrup (HFCS) in the market. Demand for direct household consumption also remains strong. More that 90 percent of Nigeria&rsquo;s sugar needs are met by import of raw sugar, shipped mostly from Brazil, which is then refined by the local domestic sugar industry. The bulk of the available refined sugar supply is also exported from Brazil.</p>
<p style="text-align: justify;">
	New Sugar Policy Measures</p>
<p style="text-align: justify;">
	President Goodluck Jonathan on October 10, 2012 announced a new tariff for raw and refined sugar as well as sugar related equipment and machinery in his 2013 Budget Speech presented to the country&rsquo;s National Assembly (the country&rsquo;s national legislative arm). He proposed a zero per cent import duty on machinery and spare parts imported for local sugar manufacturing industries, from sugarcane to sugar value chain investors. There will also be a five year tax holiday for investors in the sugar value chain, a 10 percent import duty, and a 50 percent levy on imported raw sugar, while refined sugar will attract a 20 percent duty and a 60 percent levy. These measures became effective January 1, 2013 except for the sudden imposition of the outright import ban on refined sugar announced in mid January 2013.</p>
<p style="text-align: justify;">
	Conclusion</p>
<p style="text-align: justify;">
	Currently two major companies refine sugar in the Nigeria. Dangote Sugar remains the dominant player with a refinery capacity of 1.44 million tons, followed by BUA Sugar Refinery with a capacity of 720,000 tons per year. The combined capacity of the two refineries is 2.3 million tons of sugar per year, far exceeding national consumption. More investors plan to establish sugar refineries despite this existing overcapacity. Nigeria&rsquo;s low five percent import tariff on raw sugar has made local sugar refining very attractive.</p>
<p style="text-align: justify;">
	The sugar tariff regime seeks to boost the development of sugar cane production to meet the raw sugar needs of the existing and the upcoming domestic sugar refining companies. However, Dangote Sugar Refining Company is the only one that has developed a sugar estate which it acquired through the GON privatization program and has advanced ahead of all others in its raw sugar production capacity. Post believes that under the new tariff regime, Dangote Sugar will be the company with the largest competitive advantage.</p>
<p style="text-align: justify;">
	Recommendation/Comment</p>
<p style="text-align: justify;">
	While the tariff increases and import ban are expected to provide incentives for investment in local sugar production that might help reduce costs of sugar manufacturing, the impact this development may have on local food production, especially confectioneries and bakeries, is unknown. If local production of raw sugar (sugar from sugar cane) is not enough and prices increase, this will lead to increased prices for many other items that depend on sugar as a major ingredient. However, local manufacturers utilizing sugar as an input are expected to seek available and inexpensive sugar substitutes. This may create market opportunities for exporters of Sweeteners and High-Fructose Corn Syrup (HFCS). &nbsp;Exchange Rate: $1 = 160 Naira</p>
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
  $link = "http://localhost/nigerianseminars/download_article/41/".stripslashes("NigeriaIntensifiesProtectiontoGrowitsSugarSector_Lagos_Nigeria_1-31-2013.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/41/NigeriaIntensifiesProtectiontoGrowitsSugarSector_Lagos_Nigeria_1-31-2013.pdf";
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
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/41/".str_replace($title_link,"-","Nigeria Intensifies Protection to Grow Its Sugar Sector");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/41/".str_replace($title_link,"-","Nigeria Intensifies Protection to Grow Its Sugar Sector");?>" data-type="button_count"></div>
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
  <strong style="float:left; margin-right:8px;">Tags: </strong> <?php echo tags("Imports, Sugar, Ethanol, Investment, Integration, Production, Tariff, Market.",'articletagsearch');?>
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