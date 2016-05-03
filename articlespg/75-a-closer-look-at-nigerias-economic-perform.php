<?php
	session_start();
	require_once("../scripts/config.php");
	require_once("../scripts/functions.php");
	$advert = "Articles";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta property="og:image" content="http://localhost/nigerianseminars/nstlogin/articles_images/3g4NqAdxIbJzalJIVTxFa2114894c70a320d799826787aee4894.png"/>
  <meta property="og:image:type" content="image/jpeg"/>
  <meta property="og:image:width" content="250"/>
  <meta property="og:image:height" content="250"/>
  <?php include('../tools/analytics.php');?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="http://localhost/nigerianseminars/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <title><?php echo substr(trim("A Closer Look at Nigeria’s Economic Performance"), 0, 65);?></title>
  <meta name="description" content="
	Uncertain Performance - Just how well is the Nigerian Economy performing? In the absence of a holistic report articulating the economic - 75"/>
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
  <div class="imageFloat"><img src="http://localhost/nigerianseminars/nstlogin/articles_images/3g4NqAdxIbJzalJIVTxFa2114894c70a320d799826787aee4894.png" width="100" height="100" alt="nigerianseminarsand trainings" class="articleImg shadow"/></div>
  </td>
  <td style="text-align:center;">
  <h1 style="font-size:23px; text-align:center;">A Closer Look at Nigeria’s Economic Performance</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=75" title="Authors Page">
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
	Uncertain Performance - Just how well is the Nigerian Economy performing? In the absence of a holistic report articulating the economic performance of Nigeria, no one could claim to know. There are only a lot of partial views on different aspects of the economy being expressed by different government officials. Little surprise that there will be controversies at the highest policy levels about whether the economy is weak or strong. Nigeria needs to show a stronger sense of responsibility in reforming aspects of its economic policy machinery like provision of required data, and periodic articulation of the main issues arising from the data in formal official economic reports. But more importantly, since the President and the National Assembly are the ones with the electoral mandate to manage the national economy, and unelected heads of economic agencies are their appointees, the President and the National Assembly must accept direct responsibility for policy conception and design, and leave implementation to unelected appointees in charge of economic policy agencies, but hold the appointees accountable for the tasks they are appointed to carry out.</p>
<p style="text-align: justify;">
	Data Readings<strong> - </strong>Economic policy is about measuring and influencing economic outcomes. For us to be able to act on economic information, data readings must be available in a timely fashion. Late readings will at best mean no action is taken, or at worst that wrong actions are taken. Timely readings will stimulate discussions that will inform meaningful policy actions. The reality in Nigeria is that annual data updates, yearbooks and fact-books needed to undertake holistic assessments can no longer be relied upon to arrive in time to be meaningful inputs into forward looking assessments of the performance of the economy. Data providing agencies generally feel no responsibility to publish data updates on any due date. The 2012 edition of the Annual Report of the Central Bank of Nigeria which is normally published by the end of June each year is yet to be published in October 2013. The latest Annual Abstract of Statistics available from the National Bureau of Statistics is for 2010. Quarterly and monthly data releases have become irregular, depending on the agency concerned. NBS now regularly provide quarterly output data and monthly consumer price index figures in a very timely fashion, but does not provide expenditure and employment figures with any regularity. The Central Bank is now reasonably up-to-date with monthly data on interbank rates, reserves and oil price on its website, but monetary aggregates and bank rates are not as up to date, and its monthly and quarterly reports arrive too late to be useful for any forward looking evaluation of economic performance. The monthly AGF Report on the fiscal operations that is meant to be on the website of the Office of the Accountant General of the Federation is not made available with any regularity. Same with monthly debt figures from the Debt Management Office (DMO). There is a need for the Federal Ministry of Finance to coordinate data coming out of the various agencies under it to ensure they are released monthly in a more up-to-date fashion. More generally, there is a need for government to show a stronger sense of responsibility in the ensuring that agencies that are charged with the responsibility to provide economic data do so in a timely fashion, preferably on preannounced dates. The President and the National Assembly need to ensure that necessary mandates/statutes are updated and sufficient funds are appropriated for data providing agencies.</p>
<p style="text-align: justify;">
	President&rsquo;s input<strong> - </strong>The Government of Nigeria should ensure that once necessary data are provided, the main trends in the data are holistically evaluated and articulated in published reports at the beginning of each month, each quarter and each year. There is the need for generating a central view of the trends and outlook of the key variables in the economy, as well as the areas of uncertainty about the veracity some of the data, or uncertainty about the extent to which some of the data reflects the economic realities that we are trying to evaluate. Presently, the only time that the President is obliged to say anything about the economy is when he proposes the annual appropriation bill to the National Assembly towards the end of each year. On such occasions, interest in the economy is necessarily limited to those aspects that are needed to form reasonable views about expected revenues and required expenditures. There is a need for Nigeria as a nation to find another way of annually engaging the President and the National Assembly (and State Governors and State Houses of Assembly) solely on the performance of the economy, apart from budget; by instituting an annual &lsquo;State of the Economy&rsquo; address to a joint session of the Senate and the House of Representatives at the beginning of each year for example. Such a practice will oblige the President to provide an annual written articulation of his thinking about where the economy is coming from, where it roughly is, and where it is heading to. Public presentation of the same to the National Assembly will mean that legislators and the general public have some minimum concrete information about the current state and outlook of the economy. Debates about economic policies in parliament, National Economic Council and Federal Executive Council will be better informed, economic legislations will become more prolific and better focused, while economic performance will be easier to gauge and guide. Even the general public will be better placed to provide constructive inputs into the formulation of the President&rsquo;s and National Assembly&rsquo;s thinking about the evolution and outlook of the economy. This has been the practice since the enactment of the Employment Act (1946) in the United States where the President relies on the three-member Council of Economic Advisers (CEA), with a secretariat of another two dozen economists within the Executive Office of the President, to help him put together his annual &lsquo;Economic Report of the President&rsquo;. The CEA also advises the President of the United States on economic policy and provides much of the objective empirical research for the White House. The CEA has become an incubator for new ideas and a breeding ground for future leaders of many vital economic policy agencies in the US. The current nominee for the position of chairman of the Federal Reserve Board, Janet Yellen, the current chairman, Ben Bernanke, and his predecessor, Alan Greenspan, have all previously chaired the CEA. The CEA does not deal with the budget as the Office of Management and Budget (OMB), the largest office within the Executive Office of the President, assists the President to prepare the budget and also measures the quality of agency programs, policies, and procedures and to see if they comply with the President&#39;s policies. It is important to note that the CEA and the OMB do not implement policies.</p>
<p style="text-align: justify;">
	National Assembly&rsquo;s input <strong>- </strong>As Nigeria&rsquo;s democracy matures, the National Assembly needs to play a stronger role in pushing for improved economic performance in Nigeria. As the example of the US Employment Act that has enabled successive US Presidents to have a controlling grip on the country&rsquo;s economic performance shows, the role of the legislature in bringing about stronger economic performance is vital. Forward looking legislations are required in different areas of the economy to ensure improved economic performance. Congressional Budget Office (CBO) and the Government Accountability Office (GAO) are two agencies within the US parliament that have become pillars of stellar economic performance management in the US. Needless to say, the CBO and the GAO do not implement policies. The British Parliament&rsquo;s legislations in the last decade and a half also provides very inspiring examples of the role of the legislature in ensuring improved performance and highest levels of accountability of fiscal and monetary policy agencies. Amendments to existing legislations are required in many cases, and new legislations will be necessary to ensure that key economic agencies become more focused and accountable for their impact on the nation&rsquo;s economic performance. Agencies&rsquo; accountability to the parliament in Nigeria is currently restricted to budget and annual financial reports. But it is standard requirement in most democracies for treasury and central bank to submit their plans for legislative scrutiny, even when they are operationally independent. Unlike the Bank of England and the Federal Reserve Acts that require policy committees to be directly accountable to the parliament for their past actions and future plans, the CBN Act of 2007 has no provision for accountability of the Monetary Policy Committee, only requiring the committee to submit a report of its activities in each year to the internal board of the CBN, making the policy process both independent and unaccountable. Operational independence necessitates accountability. Under the Federal Reserve Act, the Chairman of the Board of Governors of the Federal Reserve System must appear before Congressional hearings at least twice per year regarding the efforts, activities, objectives and plans of the Board and the Federal Open Market Committee with respect to the conduct of monetary policy. The statute requires that the Chairman appear before the House Committee on Banking and Financial Services in February and July of odd numbered years, and before the Senate Committee on Banking, Housing, and Urban Affairs in February and July of even numbered years. Accountability must not be sacrificed on the altar of independence.</p>
<p style="text-align: justify;">
	Economic Agencies&rsquo; input<strong> - </strong>Ministers and heads of government economic agencies charged with the implementation of economic policies in Nigeria have no opportunity at all to articulate their views on how their work contributes to the performance and outlook of the Nigerian economy. Apart from opportunistic and defensive informal speeches, informal presentations, media statements and interviews, policymakers in Nigeria do not provide any written periodic articulation of how their agencies&rsquo; activities contribute to the performance and outlook of the economy. Key economic policy agencies should be required to prepare and publish periodic reports on the developments and outlook of the aspects of the economy under their watch, not just annual reports and statement of accounts. The Federal Ministry of Finance should publish periodic reports on the Performance and Outlook of the Budget of the Federal Government in relation to the evolution and outlook of the economy. The Central Bank should publish periodic reports on the developments in and outlook of the different aspects of the economy under its watch, mainly Monetary Policy Outlook and Financial Stability Outlook, similar to the Inflation Report and the Financial Stability Report regularly published by the Bank of England. It will be best if all such reports are published on preannounced dates to facilitate public debates, and later publicly presented to the relevant committees of the parliament. The heads of these agencies currently only appear before the National Assembly by invitation on ad-hoc basis to address one aspect or the other of their operations. It will best to schedule periodic public hearings that focus holistically on all aspects of how their activities contribute to the performance of the economy. Ongoing constructive public engagement of the executive with the legislature is crucial for ensuring improvements in national economic performance. The President and the National Assembly should however stop passing the buck of policy conception and design to agencies that should ideally only implement. The ideal situation is to regard the policy agencies as the sports team on the pitch, the President and his team as the technical crew, and the National Assembly as the match officials/regulatory authority that can either commend or call both the team and technical crew to order. Recent practice in Nigeria has been more like saddling the team on the pitch with the task of being its own technical crew, as well as officiating. Performance improvements will be difficult to conceive, hard to communicate, and even harder to assess, by the player-cum-coach/official.</p>
<p style="text-align: justify;">
	A Closer Look at Recent Performance<strong> - </strong>Nigeria&rsquo;s economy has grown very fast in the last thirteen years in response the surges in global oil and non-oil commodity prices. In particular, Nigeria&rsquo;s nominal GDP has doubled from N20 trillion in 2007 to N40 trillion in 2012! Oil and gas output rose from N7.5 trillion in 2007 to 15 trillion in 2012. Non-oil GDP rose from N12.5 trillion in 2007 to N25 trillion in 2012. Crops rose from N6 trillion in 2007 to N12 trillion in 2012. Trading and commercial services rose from N6 trillion in 2007 to N11 trillion in 2012. Comparatively, with a nominal GDP of $250 billion in 2012 ($451 billion PPP), Nigeria is the 30th (40th in 2005, 52nd in 2000) largest economy in the world (PPP), 2nd largest within Africa behind South Africa, and on track to overtake South Africa and become one of the 20 largest economies in the world before by 2020 (if recent trends persist!!!). Its small manufacturing sector is the third-largest on the continent, and produces a large proportion of goods and services for the West African region. With a population over 160 million people, GDP per capita was $1560 Nominal, $2,800 PPP in 2012, Nigeria is once again a middle income economy, an emerging market, with expanding financial, service, communications, and entertainment sectors. However, the trouble with Nigeria&rsquo;s recent growth performance is sustainability, because:</p>
<p style="text-align: justify;">
	Nigeria&rsquo;s growth is far too cyclically dependent on global commodity price swings, and is most likely to be reversed in the face of a protracted global economic contraction that sees a sustained decline in global prices of crops and oil, as was Nigeria&rsquo;s experience in the eighties and the mid-nineties.</p>
<p style="text-align: justify;">
	Nigeria&rsquo;s growth has weak structural underpinnings as crop production is surging in response to favorable global prices, uninsured against income and price risks, and forward linkages from crops to manufacturing/industry are weakened by domestic energy supply and transportation failures, while wholesale and retail trade is booming on the back of improved crops income, but held back by high domestic logistics costs. These structural constraints must be relaxed to ensure that Nigeria can continue to grow in a weak global commodity price environment like the commodity-importing G-20 economies are doing in the face of high commodity prices.</p>
<p style="text-align: justify;">
	Nigeria&rsquo;s growth is sectorally concentrated as 90 percent of economic activity and growth come from three or four sectors (oil, crops, trading, and real estate). The remaining 29 or 30 sectors account for only ten to 20 percent of economic growth and activity, including telecoms, manufacturing, banking, insurance, construction and all the other big name sectors.</p>
<p style="text-align: justify;">
	The Nigerian growth sectors are regionally concentrated, creating widening diversity in regional economic activity and growth. Growth exclusion is increasingly stirring socio-political discontent in the excluded regions, with growing threats of a spillover of the restiveness to regions that are included in the growth process.</p>
<p style="text-align: justify;">
	Attainment of Nigeria&rsquo;s 20-2020 aspirations will require insurance of the income and price risks that might reverse the growth in crops in the event of weakening of commodity prices, and a broadening of the sectoral and regional bases of growth through transport system and energy supply reforms that will boost the competitiveness of manufacturing/industry and enhance growth linkages between sectors, cities, states and regions.</p>
<p style="text-align: justify;">
	Boosting Future Performance<strong> - </strong>In particular, Nigeria requires immediate domestic rail transportation reforms that would strengthen economic linkages between sectors, cities, states, and regions, and make Nigeria&rsquo;s growth more inclusive. The sectoral structure of Nigeria&rsquo;s GDP in 2012 in which oil contributed 37%; agriculture, 33%; services, 28%; but manufacturing contributed only 2% underscores the urgent problem that Nigeria must address. High-speed rail networks are needed to re-connect the once vibrant Nigeria&rsquo;s manufacturing and industrial clusters to the boom in agriculture and oil production. This holds the key to the sustenance of Nigeria&rsquo;s growth beyond the current boom in global commodity prices. Nationwide rail sector reform is one single reform that is needed to release the latent growth energies in many of Nigeria&rsquo;s sectors (crops, metal ores, coal, and numerous other non-metallic minerals, real estate, manufacturing, building and construction, and tourism), cities, states and regions. With the world&rsquo;s seventh largest population, Nigeria must be the only large country without a modernized high speed rail sector. With more than 160 million people to move across thirty-six states and the FCT, spread over 774 local government areas, annual crops, livestock, forestry, fishery, petroleum products, and solid minerals output in excess of 440 million tonnes, with an even larger volume of merchandise imported through the airports, seaports and land borders, the business case for accelerating the development of high-speed rail transport in Nigeria should be evident. The developmental impact is even more compelling. Competitiveness in manufacturing and broader industrial activities depends very critically on the existence of a transport-cost reducing fully functioning modern rail sector. Train terminuses have historically been known to open up new markets, which propelled the growth of major Nigerian cities and triggered the emergence and growth of regional industry clusters across Nigeria. Since the collapse of the rail transport system in the 1980s, the markets surrounding the terminuses have either declined or died altogether, all major Nigerian cities, except Lagos and Abuja, have declined markedly, regional industrial clusters are dead; in the absence of rail transport, only parts of Lagos and Ogun States have sufficient proximity to the ports to sustain industry clusters. Revival of cities and industries requires a fully functioning rail transport system that will link the activities centres to the ports and one another. Metal Ores and Coal production can only thrive in the presence of rail transportation. Nigeria can extract additional growth by exploiting these two minerals that abound in the Northeast and the Southeast respectively. Growing long term savings represented by the pension fund assets need long term investment vents which are currently absent in Nigeria. Opportunities for investing these funds in the rail sector will be in the long term interest of the savers and the country. Government can grant rail development concessions across the six geopolitical zones of the country, issue rail bonds, or even levy rail specific taxes to provide part of the required funding, in addition to funds that could be contributed by concessionaires, joint venture partners, public-private-partners, and ultimately, user charges.</p>
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
  $link = "http://localhost/nigerianseminars/download_article/75/".stripslashes("A_Closer_Look_at_Nigeria’s_Economic_Performance.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/75/A_Closer_Look_at_Nigeria’s_Economic_Performance.pdf";
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
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/75/".str_replace($title_link,"-","A Closer Look at Nigeria’s Economic Performance");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/75/".str_replace($title_link,"-","A Closer Look at Nigeria’s Economic Performance");?>" data-type="button_count"></div>
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
  <strong style="float:left; margin-right:8px;">Tags: </strong> <?php echo tags("Performance, Controversies, Responsibility, Economic, Revenues, Expenditures, Accountability, Monetary, Policy, Growth.",'articletagsearch');?>
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