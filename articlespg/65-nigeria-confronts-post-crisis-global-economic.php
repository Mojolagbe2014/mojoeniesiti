<?php
	session_start();
	require_once("../scripts/config.php");
	require_once("../scripts/functions.php");
	$advert = "Articles";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta property="og:image" content="http://localhost/nigerianseminars/nstlogin/articles_images/jsJcMTZ7d2ty1VDoadGR89b622ac82bc162191854ad8c9ae43ad.png"/>
  <meta property="og:image:type" content="image/jpeg"/>
  <meta property="og:image:width" content="250"/>
  <meta property="og:image:height" content="250"/>
  <?php include('../tools/analytics.php');?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="http://localhost/nigerianseminars/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <title><?php echo substr(trim("Nigeria Confronts Post-Crisis Global Economic Realities"), 0, 65);?></title>
  <meta name="description" content="
	Nigeria has long been trying to learn how best to manage boom-bust cycles in global commodity prices, adopting an oil-price benchmark - 65"/>
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
  <div class="imageFloat"><img src="http://localhost/nigerianseminars/nstlogin/articles_images/jsJcMTZ7d2ty1VDoadGR89b622ac82bc162191854ad8c9ae43ad.png" width="100" height="100" alt="nigerianseminarsand trainings" class="articleImg shadow"/></div>
  </td>
  <td style="text-align:center;">
  <h1 style="font-size:23px; text-align:center;">Nigeria Confronts Post-Crisis Global Economic Realities</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=65" title="Authors Page">
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
	Nigeria has long been trying to learn how best to manage boom-bust cycles in global commodity prices, adopting an oil-price benchmark for annual budgets while saving revenues above the benchmark in an excess crude account in the half decade before the 2008/2009 global crisis. The crisis and its aftermath now dictate that the country needs additional lessons on how best to manage surge-shortage cycles in global liquidity. Managing frequent external trade shocks is now only a part of the story, managing frequent external financial shocks, particularly with the intricate interactions between the two, is the other part.</p>
<table border="0" cellpadding="0" cellspacing="0" style="width:.75pt;" width="1">
	<tbody>
		<tr>
			<td style="height:175px;">
				<table border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td style="height:168px;">
								<table border="0" cellpadding="0" cellspacing="0" style="width:100.0%;" width="100%">
									<tbody>
										<tr>
											<td>
												<table border="0" cellpadding="0" cellspacing="0" style="width:552px;" width="552">
													<tbody>
														<tr>
															<td style="width:74px;height:39px;">
																<p style="text-align: justify;">
																	tR</p>
															</td>
															<td style="width:83px;height:39px;">
																<p style="text-align: justify;">
																	ExternalTrade Shocks</p>
															</td>
															<td style="width:101px;height:39px;">
																<p style="text-align: justify;">
																	ExternalFinancial</p>
																<p style="text-align: justify;">
																	Shocks</p>
															</td>
															<td style="width:97px;height:39px;">
																<p style="text-align: justify;">
																	RealGDPGrowth</p>
																<p style="text-align: justify;">
																	Acceleration</p>
															</td>
															<td style="width:81px;height:39px;">
																<p style="text-align: justify;">
																	StockMarket</p>
																<p style="text-align: justify;">
																	Capitalization</p>
															</td>
															<td style="width:115px;height:39px;">
																<p style="text-align: justify;">
																	ExternalReserves</p>
																<p style="text-align: justify;">
																	Stock</p>
															</td>
														</tr>
														<tr>
															<td style="width:74px;height:27px;">
																<p style="text-align: justify;">
																	Pre-crisis</p>
																<p style="text-align: justify;">
																	(2004tomid-2008)</p>
															</td>
															<td style="width:83px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:101px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:97px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:81px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:115px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
														</tr>
														<tr>
															<td style="width:74px;height:27px;">
																<p style="text-align: justify;">
																	Crisis</p>
																<p style="text-align: justify;">
																	(Mid-2008tomid-2009)</p>
															</td>
															<td style="width:83px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:101px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:97px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:81px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:115px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
														</tr>
														<tr>
															<td style="width:74px;height:27px;">
																<p style="text-align: justify;">
																	Recovery</p>
																<p style="text-align: justify;">
																	(Mid-2009tomid-2012)</p>
															</td>
															<td style="width:83px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:101px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:97px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:81px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
															<td style="width:115px;height:27px;">
																<p style="text-align: justify;">
																	Negative</p>
															</td>
														</tr>
														<tr>
															<td style="width:74px;height:27px;">
																<p style="text-align: justify;">
																	Post-crisis</p>
																<p style="text-align: justify;">
																	Mid-2012to?)</p>
															</td>
															<td style="width:83px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:101px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:97px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:81px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
															<td style="width:115px;height:27px;">
																<p style="text-align: justify;">
																	Positive</p>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<p style="text-align: justify;">
	The global economy has presented Nigeria with four distinct and often contrasting regimes over the last decade. The four phases can be identified with reference to the 2008/2009 meltdown: pre-crisis, crisis, recovery, and post-crisis.</p>
<p style="text-align: justify;">
	Pre-Crisis (2004 to Mid-2008)</p>
<p style="text-align: justify;">
	Prior to the 2008/2009 global economic and financial meltdown, Nigeria had enjoyed a significant boom from 2004 to mid-2008. Unprecedented broadly-based sustained growth in global commodity prices coincided with an equally unprecedented surge in global liquidity. The paths of the real and financial shocks hitting Nigeria from the global environment became convergent as trade shocks from global commodity prices were positive and financial shocks were also positive. Nigeria earned exceptional income on its current account on account of the commodity price surge, just as surplus liquidity in the global climate conveyed positive capital account shocks in the form of increased inflow of investment funds and remittances from citizens who were resident abroad.</p>
<p style="text-align: justify;">
	Nigeria therefore experienced economic growth acceleration, surge in domestic financial assets, and massive build-up in external reserves. Inflation moderated, interest rates fell steadily, and the Naira strengthened significantly against the US dollar. This phase became a tale of twin booms for Nigeria: (a). oil boom provided excess government revenue and foreign exchange reserves; (b). non- oil boom provided strong non-oil output growth, and private income boost. Unanticipated positive external shocks provided unexpected funds in government coffers, stimulated supply-side recovery, and private income boost in the non-oil sectors.</p>
<p style="text-align: justify;">
	The pre-crisis boom presented the Nigerian government a major window of opportunity to: (a). use the oil windfall to transform the economy by investing the exceptional government oil income in capital projects that were capable of providing revenue and fuelling growth in the event of a global downturn; (b) tax windfalls in the non-oil sectors to fund recurrent spending. The government chose rather to: (a) keep its exceptional income in external reserves, often referring to the gains from the favourable global cyclical situation as evidence that economic reform programmes had worked, and a sign of prudent management of the Nigerian economy; (b) leave non-oil income and private income boom untaxed, with the notable exception of Lagos state where successful non-oil tax reforms yielded a revolutionary surge in internally generated revenue.</p>
<p style="text-align: justify;">
	Crisis (mid-2008 to mid-2009)</p>
<p style="text-align: justify;">
	The mid-2008 to mid-2009 global economic and financial meltdown saw steep contractions in both global commodity prices and global stock markets, with dire consequences for the fiscal, macro-financial, and economic&nbsp;growth situation&nbsp;of&nbsp;Nigeria. Unexpected broadly- based crash in global commodity prices coincided with an equally unexpected contraction in global liquidity. Trade shocks from global commodity prices were sharply negative, just as capital account shocks were sharply negative. Nigeria&rsquo;s current account balance fell, just as global liquidity shortages meant increased outflow of funds, typified by excess demand pressures at the foreign exchange auctions. Nigeria experienced growth deceleration, financial assets contracted steeply, and external reserves were rapidly depleted. Inflation surged, interest rates rose, and the Naira weakened significantly against the US dollar.</p>
<p style="text-align: justify;">
	&nbsp;The window of opportunity had closed, and there was nothing to show for the preceding boom. The savings amassed in nearly five years of unexpected global cyclical upturn were depleted within two years of an unexpected global cyclical downturn. Needless to say, they were spent on recurrent items such as salaries, overheads and debt service, not capital projects. Of course, it is difficult to invest during a recession. But if the oil savings had been committed to capital projects as the boom occurred, government would have had the motivation to overhaul the non-oil tax system. In a country where VAT has remained at 5% across all categories since introduction in 1995, the presence of idle funds cannot but continue to kill incentives for needful tax reforms.</p>
<p style="text-align: justify;">
	The vital policy lesson of that experience is that if not committed to investment, the proceeds of boom will be eventually consumed! Saving the excess funds is inferior to investing them. Savings are nothing more than deferred consumption. Investment is deferred income. Savings are funds that are allowed to build up without committing them to any particular purpose, leaving them open to discretionary uses. Investment on the other hand, means that the funds are irreversibly committed to some medium term capital spending programmes. The only ways to ensure that excess crude funds translate to future output and income growth is to commit them to investment as they accrue.</p>
<p style="text-align: justify;">
	Recovery (mid-2009 to mid-2012)</p>
<p style="text-align: justify;">
	The global economic and financial meltdown turned out to be short- lived. Global commodity prices and global stock markets recovered at different paces since the second quarter of 2009. Commodity price recovery was however much stronger and steadier than equity market recovery. The IMF&rsquo;s all-commodity index has nearly returned to the June 2008 pre-crisis peak. The non-fuel index and its three components- food, agricultural inputs and metals- all surpassed their pre-crisis peaks to reach new record levels by the first half of 2011. Only the energy index remained slightly below its pre-crisis peak, but it dominates the all-commodity index. Nigerian economy certainly then faced a strongly positive global economic situation again, as the favourable global commodity price stimuli must have lifted domestic fuel, food and agricultural raw materials production, boosted the fiscal situation, and raised Nigeria&rsquo;s current account balance, to bestow net inflows of foreign exchange from trading transactions.</p>
<p style="text-align: justify;">
	On the contrary, until the third quarter of 2012, global equity markets, as revealed by MCSI World Commodity Index, not only remained well below pre-crisis levels, but have been highly prone to contractions on the back of concerns about sovereign debt sustainability and support for adjustment efforts in Europe, and doubts about medium term fiscal stability in the United States and Japan. The paths of the real and financial shocks hitting Nigeria from the global environment were thus became divergent in the recovery phase, with trade shocks from global commodity prices once again becoming positive, while financial shocks remained negative.</p>
<p style="text-align: justify;">
	Commodity price improvements impacted Nigeria&rsquo;s current account and foreign exchange supply positively just as contractions in global financial markets imposed adverse capital account shocks that drained liquidity from Nigeria and other emerging markets. Nigeria therefore found it hard to keep the gains from commodity price improvements, as&nbsp; excess&nbsp; demand&nbsp; pressures on&nbsp; the&nbsp; foreign exchange market drained the foreign exchange earnings. External reserves trended steadily downwards, even as the price of Bonny Light trended steadily upwards from mid-2009 until mid-2012 when global equity markets finally entered a stable growth path that are to push the market indices very close to the pre-crisis peak in the first half of 2013.</p>
<p style="text-align: justify;">
	In the recovery phase, Nigeria faced a policy dilemma of striking a balance between policies that could strengthen real sector growth and policies that could stem haemorrhage on the capital account: the central bank resolved the conflict in favour of stemming the external financial haemorrhage by adopting a tight monetary policy stance from September 2010. Nigeria experienced mild growth decelerations in 2011 and 2012, while financial assets and external reserves remained stagnant. Inflation remained sticky around ten per cent, and interest rates rose in response to the tight monetary policy stance, but the Naira remained weak against the US dollar.</p>
<p style="text-align: justify;">
	&ldquo;Savingsarenothingmorethandeferredconsumption.Investmentisdeferredincome&rdquo;</p>
<p style="text-align: justify;">
	Post-crisis (mid-2012 to?)</p>
<p style="text-align: justify;">
	The paths of the real and financial shocks hitting Nigeria from the global environment are just becoming convergent again; trade shocks from global commodity prices are positive and stable, just as sustained improvements in global liquidity mean that financial shocks are also becoming positive and more likely to be stable. For Nigeria, the next few years may see the repeat of the experiences of 2004-2008: growth acceleration, pronounced surge in domestic financial assets, massive build-up in external reserves, low inflation, low interest rates, and a strong Naira.The post-crisis reality of the global climate for Nigeria is the coincidence of positive trade shocks from high global commodity prices with positive financial shocks from improved global liquidity. The twin booms are back for Nigeria. It however remains to be seen how long this phase will last given the inherent cyclicality of recent global economic evolution. It nonetheless presents Nigeria with another window of opportunity to: (a) institute a regime of investing most of the excess oil earnings in capital projects as they accrue to government coffers; and, (b) institute another regime of taxing the windfalls in the non-oil sector for the purpose of funding recurrent spending.</p>
<p style="text-align: justify;">
	To gain the most from the current boom, Nigerians need to put more rigour and depth into economic growth discussions. Beyond overall growth figures, more understanding of the dynamics of growth; accelerations and decelerations, and sectoral and regional distribution, is required. Policies must be adapted to changes in the incidence of growth on an ongoing basis. There is a need to pinpoint what changing growth incidence mean for revenue generation and monetary policies. The bulk of the GDP growth is happening in the non-oil sectors such as crops, trading and other commercial activities. Unlike the oil sector where sales proceeds accrue into government coffers, sales proceeds in the non-oil sectors accrue into private hands, and are manifestly under-taxed. Governments at different tiers should generate revenue from the current boom in private income and spending to fund recurrent spending, and re-invest oil revenue.</p>
<p style="text-align: justify;">
	Nigerians need to resolve the deadlock that holds the nation from investing excess funds in times of boom. The benchmark price of oil should be set high enough to ensure balanced budgets at the different tiers of government, while savings accruing to the excess crude account (ECA) should be committed to capital projects as they accrue. Unlike recurrent spending, investment spending is unlikely to be inflationary because of significant time lags from budgetary commitment to actual disbursement. In any case, considerations about inflation should ideally apply to the tactical details of implementation and not the strategic issue of whether to invest or not.</p>
<p style="text-align: justify;">
	Nigerians also need to respond more strategically to cyclical swings in global liquidity that show up in the form perennial demand pressures on the foreign exchange market in the face of contractions in stock market capitalization and foreign reserves. One option is to hedge the risk of capital account haemorrhages by creating a fund to invest part of Nigeria&rsquo;s excess crude savings in equities in the developed markets during booms, and hope that these can be used to cushion capital account shocks during global liquidity shortages, as the little funds available tend to head into the developed markets at times of global liquidity shortages.</p>
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
  $link = "http://localhost/nigerianseminars/download_article/65/".stripslashes("Nigeria_Confronts_Post-Crisis_Global_Economic_Realities.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/65/Nigeria_Confronts_Post-Crisis_Global_Economic_Realities.pdf";
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
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/65/".str_replace($title_link,"-","Nigeria Confronts Post-Crisis Global Economic Realities");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/65/".str_replace($title_link,"-","Nigeria Confronts Post-Crisis Global Economic Realities");?>" data-type="button_count"></div>
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