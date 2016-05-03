<?php
	session_start();
	require_once("../scripts/config.php");
	require_once("../scripts/functions.php");
	$advert = "Articles";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta property="og:image" content="http://localhost/nigerianseminars/nstlogin/articles_images/LEtsPqiUTNdU3C8GZ0dlfc63cd852b0b5576725f1926ea18ce9d.png"/>
  <meta property="og:image:type" content="image/jpeg"/>
  <meta property="og:image:width" content="250"/>
  <meta property="og:image:height" content="250"/>
  <?php include('../tools/analytics.php');?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="http://localhost/nigerianseminars/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <title><?php echo substr(trim("Confronting Inter-Regional Disparities in Nigeria"), 0, 65);?></title>
  <meta name="description" content="
	Disparities in endowments of agricultural, mineral and commercial wealth across Nigeria&rsquo;s six geopolitical zones determine - 67"/>
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
  <div class="imageFloat"><img src="http://localhost/nigerianseminars/nstlogin/articles_images/LEtsPqiUTNdU3C8GZ0dlfc63cd852b0b5576725f1926ea18ce9d.png" width="100" height="100" alt="nigerianseminarsand trainings" class="articleImg shadow"/></div>
  </td>
  <td style="text-align:center;">
  <h1 style="font-size:23px; text-align:center;">Confronting Inter-Regional Disparities in Nigeria</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=67" title="Authors Page">
  <p style="color:#fff;"> Author:&nbsp;&nbsp;Dr. Ayo Teriba </p>
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
	Disparities in endowments of agricultural, mineral and commercial wealth across Nigeria&rsquo;s six geopolitical zones determine the rates at which the different regions can grow. Economic activities and growth are concentrated in four regions, while the remaining two regions are largely excluded from the growth processes. This calls for urgent efforts to make economic growth more inclusive. Investing in fast and efficient rail links between rich and poor regions is suggested as a win-win national redistributive strategy that could bring resource-poor regions closer to needful inputs, ensure benefits of growth are more evenly distributed across regions without hurting any of the resource-rich regions, ultimately eliminate interregional growth disparities, and ensure the peaceful coexistence that is required to sustain growth. Nigeria needs a strong national economic intelligence apparatus like the defunct National Economic Intelligence Committee (NEIC) to, amongst other things, provide the foresight required henceforth to ensure that regional growth divergence is prevented rather than cured.</p>
<p style="text-align: justify;">
	1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Resource Endowments and Growth</p>
<p style="text-align: justify;">
	From 19 states in 1980, the next two decades were to see the creation of seventeen additional states (two in 1987, nine and the FCT in 1990, and six more in 1996) to arrive at the present 36 states and FCT in six geo-political zones or regions. The economies of all Nigerian states and regions had looked very similar in the stagnant 1980s and 1990s when weak global commodity prices inflicted deep contractions on the country&rsquo;s economy. Oil production, agricultural and manufacturing output fell steeply and remained stagnant until 1999. Infrastructures, such as rail transport and power supply, deteriorated or collapsed over this period.</p>
<p style="text-align: justify;">
	The nation&rsquo;s economy however entered a recovery phase in 1999 when global commodity prices saw a broadly-based surge that has surprising been sustained for more than a decade, the brief contraction during the 2008/2009 global crisis notwithstanding. This has boosted agricultural, oil and trading output in Nigeria. Growth has however been concentrated in a few sectors as crops, oil, and commerce have contributed 90 percent of Nigeria&rsquo;s growth. Each of these three activities is regionally concentrated, meaning that some regions are excluded from the growth process. This creates a challenge of making growth more inclusive.</p>
<p style="text-align: justify;">
	Regional Endowments and Sectoral Shares</p>
<table border="1" cellpadding="0" cellspacing="0" style="width:560px;" width="560">
	<tbody>
		<tr>
			<td style="width: 101px; height: 22px; text-align: justify;">
				&nbsp;</td>
			<td style="width:122px;height:22px;">
				<p style="text-align: justify;">
					Land Area</p>
			</td>
			<td style="width:78px;height:22px;">
				<p style="text-align: justify;">
					Coastline</p>
			</td>
			<td style="width:78px;height:22px;">
				<p style="text-align: justify;">
					Boarders</p>
			</td>
			<td style="width:57px;height:22px;">
				<p style="text-align: justify;">
					Crops</p>
			</td>
			<td style="width:54px;height:22px;">
				<p style="text-align: justify;">
					Oil</p>
			</td>
			<td style="width:70px;height:22px;">
				<p style="text-align: justify;">
					Trading</p>
			</td>
		</tr>
		<tr>
			<td style="width:101px;height:15px;">
				<p style="text-align: justify;">
					North-central</p>
			</td>
			<td style="width:122px;height:15px;">
				<p style="text-align: justify;">
					Large, landlocked</p>
			</td>
			<td style="width:78px;height:15px;">
				<p style="text-align: justify;">
					Nil</p>
			</td>
			<td style="width:78px;height:15px;">
				<p style="text-align: justify;">
					Nil</p>
			</td>
			<td style="width:57px;height:15px;">
				<p style="text-align: justify;">
					30%</p>
			</td>
			<td style="width:54px;height:15px;">
				<p style="text-align: justify;">
					-</p>
			</td>
			<td style="width:70px;height:15px;">
				<p style="text-align: justify;">
					16.33%</p>
			</td>
		</tr>
		<tr>
			<td style="width:101px;height:14px;">
				<p style="text-align: justify;">
					Northeast</p>
			</td>
			<td style="width:122px;height:14px;">
				<p style="text-align: justify;">
					Large, semi-arid</p>
			</td>
			<td style="width:78px;height:14px;">
				<p style="text-align: justify;">
					Nil</p>
			</td>
			<td style="width:78px;height:14px;">
				<p style="text-align: justify;">
					Yes</p>
			</td>
			<td style="width:57px;height:14px;">
				<p style="text-align: justify;">
					5%</p>
			</td>
			<td style="width:54px;height:14px;">
				<p style="text-align: justify;">
					-</p>
			</td>
			<td style="width:70px;height:14px;">
				<p style="text-align: justify;">
					1.46%</p>
			</td>
		</tr>
		<tr>
			<td style="width:101px;height:14px;">
				<p style="text-align: justify;">
					Northwest</p>
			</td>
			<td style="width:122px;height:14px;">
				<p style="text-align: justify;">
					Large</p>
			</td>
			<td style="width:78px;height:14px;">
				<p style="text-align: justify;">
					Nil</p>
			</td>
			<td style="width:78px;height:14px;">
				<p style="text-align: justify;">
					Yes</p>
			</td>
			<td style="width:57px;height:14px;">
				<p style="text-align: justify;">
					60%</p>
			</td>
			<td style="width:54px;height:14px;">
				<p style="text-align: justify;">
					-</p>
			</td>
			<td style="width:70px;height:14px;">
				<p style="text-align: justify;">
					4.41%</p>
			</td>
		</tr>
		<tr>
			<td style="width:101px;height:14px;">
				<p style="text-align: justify;">
					Southeast</p>
			</td>
			<td style="width:122px;height:14px;">
				<p style="text-align: justify;">
					Small, landlocked</p>
			</td>
			<td style="width:78px;height:14px;">
				<p style="text-align: justify;">
					Nil</p>
			</td>
			<td style="width:78px;height:14px;">
				<p style="text-align: justify;">
					Nil</p>
			</td>
			<td style="width:57px;height:14px;">
				<p style="text-align: justify;">
					2.18%</p>
			</td>
			<td style="width:54px;height:14px;">
				<p style="text-align: justify;">
					2.69%</p>
			</td>
			<td style="width:70px;height:14px;">
				<p style="text-align: justify;">
					2.73%</p>
			</td>
		</tr>
		<tr>
			<td style="width:101px;height:12px;">
				<p style="text-align: justify;">
					South-south</p>
			</td>
			<td style="width:122px;height:12px;">
				<p style="text-align: justify;">
					Small, coastal</p>
			</td>
			<td style="width:78px;height:12px;">
				<p style="text-align: justify;">
					Yes</p>
			</td>
			<td style="width:78px;height:12px;">
				<p style="text-align: justify;">
					Yes</p>
			</td>
			<td style="width:57px;height:12px;">
				<p style="text-align: justify;">
					1.25%</p>
			</td>
			<td style="width:54px;height:12px;">
				<p style="text-align: justify;">
					91.52%</p>
			</td>
			<td style="width:70px;height:12px;">
				<p style="text-align: justify;">
					13.45%</p>
			</td>
		</tr>
		<tr>
			<td style="width:101px;height:20px;">
				<p style="text-align: justify;">
					Southwest</p>
			</td>
			<td style="width:122px;height:20px;">
				<p style="text-align: justify;">
					Small, coastal</p>
			</td>
			<td style="width:78px;height:20px;">
				<p style="text-align: justify;">
					Yes</p>
			</td>
			<td style="width:78px;height:20px;">
				<p style="text-align: justify;">
					Yes</p>
			</td>
			<td style="width:57px;height:20px;">
				<p style="text-align: justify;">
					2.73%</p>
			</td>
			<td style="width:54px;height:20px;">
				<p style="text-align: justify;">
					5.79%</p>
			</td>
			<td style="width:70px;height:20px;">
				<p style="text-align: justify;">
					61.33%</p>
			</td>
		</tr>
	</tbody>
</table>
<p style="text-align: justify;">
	Source: Economic Associates: Regional Insights report, September 2012. Metal Ores and Coal are potential regionally concentrated growth sectors.</p>
<p style="text-align: justify;">
	Thus, regional growth incidence has been primarily dependent on regional resource endowments. States and regions are beginning to look very dissimilar as growth has not been uniform across the regions. States/regions included in the growth processes are getting rich, just as those excluded from the growth processes, remain poor. Regions can now easily be grouped into the haves and the have-nots. If this trend continues, the rich states/regions will get richer, and the poor, poorer.</p>
<p style="text-align: justify;">
	Northwest and North-central, with well-watered stretches of land area, account for 90 percent of crop production; South-south, with access to coastal oil and gas deposits, accounts for 91.5 percentof oil production; Southwest, with the historic ports of Lagos and lucrative land borders, account for 60 percent of trading and commercial activities, and North-central and South-south combine to contribute another 30 percent of this. The remaining two regions, the semi-arid Northeast with immense metal ores, and the landlocked Southeast with immense coal deposits, are marginalized from the existing growth processes.</p>
<p style="text-align: justify;">
	2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recent Growth Patterns</p>
<p style="text-align: justify;">
	Southwest gross regional output grew the most in 2012 with an absolute nominal increase of N1.4 trillion (or 21.8% nominal growth), followed by the Northwest with N1 trillion (16.38%), and North-central with N800 billion (14.27%). These are to be compared to regional output increases of N123 billion (10.89%) in the Southeast and N100 billion (8.19%) in the Northeast. Owing to a slight dip in oil price in 2012 after growing impressively in the preceding three years, oil-dominated South-south recorded a slight decline of about N268.9 billion (-1.69%) in regional output in 2012.</p>
<p style="text-align: justify;">
	The South-south still had the largest gross regional product, N15.65 trillion (38.6% of Nigeria&rsquo;s GDP), followed by the Northwest&rsquo;s N8.4 trillion (20.65%), Southwest&rsquo;s N8.2 trillion (20.26%), and North-central&rsquo;s N5.7 trillion (15%). Southeast&rsquo;s N1.4 trillion (3.27%) and North-central&rsquo;s N1.2 (3.11%) trillion were the smallest GRPs in 2012, each being even smaller than the increase in Southwest&rsquo;s regional output that year. More importantly, Southeast and Northeast not only had the smallest economies in 2012, they also recorded the least absolute and percentage growths.</p>
<p style="text-align: justify;">
	3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Output versus Consumption</p>
<p style="text-align: justify;">
	The seeming advantage of the South-south&rsquo;s output over other regions has to be qualified that only a small fraction of the oil wealth created in the region is appropriated in the region. One third of the oil wealth is appropriated by multinational joint venture partners with the remaining two thirds heading into the federation account which only concedes 13 percent of the oil revenue to producing states over and above what comes to them, like any other state, based on the revenue allocation. The non-oil output of about N1.9 trillion in 2012 is fully appropriable within the region, as with non-oil output in all other regions.</p>
<p style="text-align: justify;">
	The consequence is that South-south ranks third, after Southwest and Northwest in total consumption spending, and ranks a distant fifth, only ahead of the Northeast, in consumption spending per head. The region&rsquo;s domestic income is high enough to rank first; consumption is low enough to rank third; and consumption per head even lover to rank fifth. Worse still, food consumption per head in the region is the lowest in the country, while non-food consumption per head is the second highest; revealing the irony that, while the average person in the South-south spends less on food than persons in the other region, the average outlay on non-food items in the South-south is second only to the Southwest, and even higher than in the North-central! This anomaly suggests that derivation payouts funds luxury spending by few privileged government officials and their cronies, while the populace don&rsquo;t have enough to spend on basic needs like food.</p>
<p style="text-align: justify;">
	On the contrary, the output disadvantage of the Southeast is mitigated by the fact that south easterners&rsquo; income from involvement in wealth creation in all the five other regions and in the Diaspora far exceeds the value of wealth generated within the region. The strong home bias of the average south easterner ensures that huge fractions of such wealth are repatriated to the region with the consequence that Southeast ranks third in consumption spending per head after the Southwest and the North-central, ahead of the Northwest, South-south and the Northeast, although total consumption in the region still ranks fifth, only ahead of the Northeast. Southeast consistently remains third in both food consumption per head and non-food consumption per head. The relative rankings of the other four regions do not need to be qualified as they remain fairly consistent across output and consumption measures.</p>
<p style="text-align: justify;">
	4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Confronting Interregional Divergence</p>
<p style="text-align: justify;">
	The 2012 growth patterns may persist into the medium term as the current outlook of global commodity prices remain favourable for food and agricultural raw materials. Crop production and trading and commerce will continue to contribute the most to Nigeria&rsquo;s growth in the foreseeable future. With oil price already a little above US$100, oil sector growth is likely to remain intermittent in the medium term. In the absence of a national interregional redistributive policy, rich regions will continue to get richer, just as poor regions get poorer. Residents in the poor regions might eventually lose hope, become restive, engage in activities that may threaten peaceful interregional coexistence, and undermine growth in the country. Sustenance of growth in the country can only be assured through peaceful redistribution of growth from rich to poor regions. Otherwise, violent redistribution of the pains and anguish of penury from poor to rich regions will be inevitable, breach the peace among regions, and the country will be the worse for it.</p>
<p style="text-align: justify;">
	5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rail Transportation and Regional Development</p>
<p style="text-align: justify;">
	Investing in fast and efficient rail links between rich and poor regions is the win-win national redistributive strategy that could bring resource-poor regions closer to needful inputs, ensure benefits of growth are more evenly distributed across regions without hurting any of the resource-rich regions, ultimately eliminate interregional growth disparities, and ensure the peaceful coexistence that is required to sustain growth. Nigeria therefore needs to approach the nationwide rail development with a much stronger sense of urgency.</p>
<p style="text-align: justify;">
	The recently released Mid-Term Report of The Transformation Agenda (May 2011&ndash;May 2013): Taking Stock, Moving Forward did say that, &lsquo;The Federal Government in a bid to turnaround the railways nationwide, articulated a 25-year strategic vision for the rail sector, with milestones to be implemented in three stages. The broad targets of the rail sub-sector are the completion of the rehabilitation of the existing narrow gauge and construction of new standard gauge rail lines, and construction of extension to link all State Capitals and commercial centres. ...&nbsp; Currently, feasibility studies are on-going to create additional corridors for the standard gauge rail system. The studies are expected to be completed by the third quarter of this year and their reports will amongst others consist of Outline Business Cases which will be made available to potential investors for the development of tracks under Public Private Partnership.&rsquo;</p>
<p style="text-align: justify;">
	The Federal Government does seem to have the rail sector development on its radar. The only problem is that the 25-year timeframe does not reflect the strong sense of urgency that an appreciation of the likely impact on states, regions and sectors, and industrial clusters would impose. 25 years? Not five years? Full economic revival of the six regions depends critically on the development of a fully functioning rail sector. Every region will gain tremendously from fully functioning rail transport system. Train terminuses have historically been known to open up new markets, which propelled the growth of major Nigerian cities and triggered the emergence and growth of regional industry clusters across Nigeria. Since the collapse of the rail transport system in the 1980s, the markets surrounding the terminuses have either declined or died altogether, all major Nigerian cities, except Lagos and Abuja, have declined markedly, regional industrial clusters are dead; in the absence of rail transport, only parts of Lagos and Ogun States have sufficient proximity to the ports to sustain industry clusters. Revival of cities and industries requires a fully functioning rail transport system. Metal Ores and Coal production can only thrive in the presence of rail transportation. Nigeria can extract additional growth by exploiting these two minerals that abound in the Northeast and the Southeast respectively.</p>
<p style="text-align: justify;">
	With 160 million people to move across thirty-six states and the FCT, spread over 774 local government areas, annual crops, livestock, forestry, fishery, petroleum products, and solid minerals output in excess of 440 million tonnes, with an even larger volume of merchandise imported through the airports, seaports and land borders, the business case for the Nigerian rail sector shouldbe more than obvious. The developmental impact is no less compelling. Competitiveness in manufacturing and broader industrial activities depends very critically on the existence of a transport cost reducing fully functioning modern rail sector. Growing long term savings represented by the pension fund assets need long term investment vents which are currently absent in Nigeria. Opportunities for investing these funds in the rail sector will be in the long term interest of the savers and the country. Government can issue rail bonds, or even levy rail specific taxes to provide part of the required funding, in addition to funds that could be contributed by joint venture partners and public-private-partners.</p>
<p style="text-align: justify;">
	6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Stronger National Economic Intelligence Apparatus is Urgently Required</p>
<p style="text-align: justify;">
	Nigeria needs a strong national economic intelligence apparatus like the defunct National Economic Intelligence Committee (NEIC) to, amongst other things, provide the foresight required to ensure that regional growth divergence is prevented on an ongoing basis rather than cured. The NEIC Act should be amended, rather than repealed as being contemplated by the Senate, to give the agency more powers to provide insight, oversight, and foresight on matters of urgent national importance in line with the original vision for the agency when it was created in 1994. The National Assembly, the Presidency, and the National Economic Council alike should rely on such an agency to clarify their vision and thinking on the best ways to ensure a more inclusive national economic growth trajectory.</p>
<p style="text-align: justify;">
	Ayo Teriba</p>
<p style="text-align: justify;">
	CEO, Economic Associates</p>
<p style="text-align: justify;">
	ayo.teriba@econassociates.com</p>
</div><br /><br />
  <div>
      <div class="articleaboutAuthor"><h2 style="font-size:13px;">About the Author - <span style="color:#000;font-weight: bold">Dr. Ayo Teriba</span></h2></div><br />
  <div> 
  <div >
      <div style=" width:100%"><div style="text-align:justify;  font-size:12px"><p>
	Ayo is the <em>CEO </em>of <em>Economic Associates (EA) </em>where he provides strategic direction for ongoing research and consulting on the outlook of the Nigerian economy, focusing on: global, national, regional, state, and sector issues. He was a <em>Member </em>of the <em>National Economic Intelligence Committee (NEIC) </em>from April 2009 to April 2012, where he conducted periodic reality checks on macroeconomic, fiscal and monetary developments in Nigeria.</p>
<p>
	&nbsp;</p>
<p>
	Ayo is well known for articulating his views on economic policy imperatives through articles, interviews and comments in the mass media. Most notably, from 1996 to 1998, he spearheaded the advocacy for re-denomination of Naira notes and coins that led to the successful introduction of N100, N200, N500 and N1000 between December 1999 and October 2005. N50 note was the highest denomination prior to the policy advocacy.</p>
<p>
	&nbsp;</p>
<p>
	Before becoming the CEO of EA in 2004, Ayo worked as <em>Chief Economist </em>and Member of Editorial Board at ThisDay Newspaper Group (2001-2004), <em>Faculty Member </em>at the Lagos Business School (1995-2001), <em>Head of Research </em>at the Lagos Chamber of Commerce (1993-1995), and <em>Company Economist </em>at UAC of Nigeria (1992-1993). He has served as <em>Consultant </em>to a long list of blue chip companies, Federal Ministry of Information, Senate Committee on Banking and Finance, several State Governments, DfID, USAID, World Bank, and was a Visiting Scholar to the IMF Research Department in Washington DC.</p>
<p>
	&nbsp;</p>
<p>
	He has received grants from Ford Foundation and Rockefeller Foundation, and chaired the steering committee of the Money, Macroeconomic and Finance Research Group of the Money Market Association of Nigeria. His prolific research output has included a 400-page annual economic, fiscal and sectoral report on the 36 states &amp; the FCT, plus numerous scholarly publications resulting from his doctoral thesis, research grants, policy advocacy, and consultancy projects.</p>
<p>
	&nbsp;</p>
<p>
	Ayo earned B.Sc. in Economics from the University of Ibadan with <em>Sir James Robertson Prize and Medal, UAC Prize in Economics, and Economics Departmental Prize as the all-round best economics graduate in 1988</em>, M. Sc. Economics from Ibadan in 1990, M. Phil. Economics of Developing Countries as a <em>Cambridge-DfID Scholar </em>at the <em>University of Cambridge </em>in 1992, and Ph.D. in Applied Econometrics and Monetary Economics from University of Durham in 2003.</p>
</div></div>
  </div>
  </div>
  </div>

  <br />
  
  </td>
  </tr>
  
  <tr class="smart-forms">
  <td style="text-align:left;">
  <a href="http://localhost/nigerianseminars/author/Dr.-Ayo-Teriba" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;" title="More articles by Dr. Ayo Teriba" > More articles by Dr. Ayo Teriba</a>
  </td>
  <td style="text-align:left;"> <h3 style="font-weight:normal;font-size: 13px;"><a href="#author-contact" class="cssButton_roundedLow cssButton_aqua author" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;">Contact Author</a></h3></td>
  <td style="width:30%; text-align:right;">
  
  <?php  
  if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
  $link = "http://localhost/nigerianseminars/download_article/67/".stripslashes("Confronting_Inter-Regional_Disparities_in_Nigeria.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/67/Confronting_Inter-Regional_Disparities_in_Nigeria.pdf";
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
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/67/".str_replace($title_link,"-","Confronting Inter-Regional Disparities in Nigeria");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/67/".str_replace($title_link,"-","Confronting Inter-Regional Disparities in Nigeria");?>" data-type="button_count"></div>
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
  <strong style="float:left; margin-right:8px;">Tags: </strong> <?php echo tags("",'articletagsearch');?>
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
  <strong style="color:#006600;">Contact Dr. Ayo Teriba</strong>
  
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
  <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',"ayo.teriba@econassociates.com");?>" id="to" />
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