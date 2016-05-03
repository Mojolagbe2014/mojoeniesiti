<?php
	session_start();
	require_once("../scripts/config.php");
	require_once("../scripts/functions.php");
	$advert = "Articles";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta property="og:image" content="http://localhost/nigerianseminars/nstlogin/articles_images/Cj7UxttIeHmUq5rZ8UXM19f2e5a21bba8d6a7793bd4a9d35c1bf.png"/>
  <meta property="og:image:type" content="image/jpeg"/>
  <meta property="og:image:width" content="250"/>
  <meta property="og:image:height" content="250"/>
  <?php include('../tools/analytics.php');?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="http://localhost/nigerianseminars/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <title><?php echo substr(trim("Puzzles about Monetary Policy in Nigeria"), 0, 65);?></title>
  <meta name="description" content="
	Abstract - Two puzzles are becoming striking from recent communiqu&eacute;s of the Monetary Policy Committee (MPC) of the Central - 69"/>
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
  <div class="imageFloat"><img src="http://localhost/nigerianseminars/nstlogin/articles_images/Cj7UxttIeHmUq5rZ8UXM19f2e5a21bba8d6a7793bd4a9d35c1bf.png" width="100" height="100" alt="nigerianseminarsand trainings" class="articleImg shadow"/></div>
  </td>
  <td style="text-align:center;">
  <h1 style="font-size:23px; text-align:center;">Puzzles about Monetary Policy in Nigeria</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=69" title="Authors Page">
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
	Abstract - Two puzzles are becoming striking from recent communiqu&eacute;s of the Monetary Policy Committee (MPC) of the Central Bank of Nigeria (CBN). First, growth, employment, household and business expenditure issues have completely crept out of policy deliberations, as concerns about fiscal and banking operations have become the primary preoccupations of the committee. Second, the number of economists on the 12-member MPC has dropped to just about four. One must wonder how Nigeria can sustain monetary policy that marginalizes growth or employment concerns and excludes economists. To resolve these puzzles, we reason that since fiscal and banking optimization concerns are also legitimate, creating parallel independent committees for dealing with each of them, as is currently the case in the UK, is the best way to ensure that growth and employment issues are not crowded out of monetary policy deliberations. Each of these committees will need to be populated by people with the right expertise, as the expertise of most of the present members of the MPC indicates that they will do better in the parallel committees. The MPC needs to be wholly made up of economists with the technical capacity to contemplate and incorporate growth and employment issues into the policy process.</p>
<p style="text-align: justify;">
	Recent deliberations and reasons for policy actions of the Monetary Policy Committee (MPC) of the Central Bank of Nigeria (CBN) have been too much about fiscal stance and liquidity of banks to the exclusion of considerations of the dynamics of real output growth, employment, consumer spending, household sector balance sheet, business spending and corporate sector balance sheet, which ought to be the real reasons we need to manage monetary policy. Discussing and acting on fiscal and banking developments in isolation of output, employment, household and business spending growth is not the right way to do monetary policy. Providing optimal liquidity support for aggregate, sectoral, and regional real output and employment growth, household and business spending is the motivation for monetary policy. Fiscal stability, financial stability, financial regulation, and financial supervision all make sense only if they contribute to the attainment of growth and employment. The focus is lost when the committee&rsquo;s discussions and interventions can proceed without reference to the more vital growth and employment aspects of the economy. Regaining that focus is a pressing policy challenge for Nigeria.</p>
<p style="text-align: justify;">
	Of course many of the issues that currently distract the MPC from dwelling on core economic issues at its meetings are legitimate issues that must be addressed, but they are best left to other entities. Most of the concerns expressed on fiscal stance should ideally preoccupy some other committee outside of the central bank. A lot of the issues discussed about banks by the MPC should also be dealt with outside of the MPC, but within the central bank. It is important to ensure that the MPC is primarily preoccupied with growth and employment issues in coming to decisions about interest rates. Contemporary experience of the United Kingdom offers key lessons in these regards. In the UK, the MPC is freed from paying too much attention to what banks are or are not doing because a different entity, the Financial Policy Committee (FPC), another independent subsidiary of the Bank of England, also chaired by the Governor of the Bank of England, deals with concerns about banks and financial stability. Similarly in the UK, MPC is freed from paying too much attention to the fiscal stance because the House of Commons&rsquo; Treasury Committee works extremely actively to ensure fiscal stability.</p>
<p style="text-align: justify;">
	Nigeria needs to learn urgently from the UK example by moving towards a situation in which the MPC is not the only one striving to manage all aspects of macroeconomic stability. Parallel arrangements for managing fiscal and financial stability in an open and forward-looking way are needed in Nigeria. The UK MPC concentrates on growth and employment issues, knowing that other arrangements are in place to optimize fiscal and banking activities. Members dwell primarily on the role that monetary policy can play in promoting real growth, employment, household and business spending, and regularly visit various regions of the country to speak to audiences throughout the country, explaining the MPC&#39;s policy decisions and thinking. The regional visits also give members of the MPC a chance to gather first-hand intelligence about the economic situation from businesses and other organizations. In its August 2013 statement on Monetary Policy Trade-offs and Forward Guidance, the UK MPC says it currently strives to &lsquo;explore the scope for economic expansion without putting price stability and financial stability at risk.&rsquo;, and that, &lsquo;The MPC intends at a minimum to maintain the present highly stimulative stance of monetary policy until economic slack has been substantially reduced, provided this does not entail material risks to price stability or financial stability.&rsquo; This goes to show that price and financial stability concerns ought not to be pursued to the neglect of real growth and employment concerns.</p>
<p style="text-align: justify;">
	The Nigerian MPC communiqu&eacute;s have a tendency to passively note the latest real GDP growth figures from the National Bureau of Statistics (NBS) in a single paragraph without attempting to link subsequent deliberations and policy decisions to them. The MPC ought to make more explicit statements about observable, periodically measurable, and easily understood indicators of real economic conditions that MPC deliberations and actions will impact, and then hold itself accountable to demonstrate the extent to which such impact is being attained from one meeting to the next. Growth in nominal GDP, consumption, investment, Real GDP growth, employment are some of the variables that public care about and the MPC needs to say a lot more about how its actions impact them at each of its meetings. The MPC does have a lot to say about consumer price inflation, which is the key target and indicator variable the MPC deliberations and actions revolve around, but almost never has anything to say about consumer spending, making it difficult to situate the committee&rsquo;s views on the outlook of consumer price movements within the context of the overall outlook of developments in real consumer spending.</p>
<p style="text-align: justify;">
	The economy is not just about singling out consumer price inflation and or real consumer spending. It is more broadly about inflation, of which consumer price movements is only a component, and real activity, of which consumer spending is only a component. To be sure that monetary policy actions are not doing more harm than good, discussions leading up to interest rate decisions need to be broad enough to cover the linkages between broader measures of inflation and real activity and the policy rate and other policy instruments. This would require each communiqu&eacute; of the MPC to speak to a series of measurable slacks, gaps, imbalances or deviations from norms in real and nominal economic activities: e.g. nominal GDP shortfall, output gap, employment rate, unemployment rate, manufacturing and industrial capacity utilization, savings ratios, and household and corporate debt ratios. We need to hear more about what the MPC knows about nominal and real output developments, employment and unemployment developments, wages and profit developments, developments in aggregate demand and its key components, and what views the MPC hold about the outlook of these core measures of economic activity in Nigeria. It is only then anyone can judge whether MPC actions make sense, or for that matter, whether the MPC&rsquo;s oft expressed views about the inappropriateness of the fiscal stance make sense. Closing measurable gaps in overall real and nominal economic performance must define the common grounds for fiscal and monetary policy. Changes in fiscal or monetary policy stance must be directed at clear measures of gaps in economic activity. But it is important that these considerations be evaluated at every meeting of the MPC and similar committees so that the appropriateness of their choice of policy stance is unambiguous.</p>
<p style="text-align: justify;">
	Much of the progress in evolving better institutions for managing growth and stability in the UK have been spearheaded by the parliament, which has provided new enabling legislations as rapidly as necessary on an ongoing basis over the past one and a half decades. Each of the MPC and the FPC are collectively directly accountable to the Treasury Committee for fulfilment of their mandates, just as the members of each of the two committees are individually directly accountable to the committee as a way of preserving their independence. It remains to be seen how soon the Nigerian Legislature can have such functionality in economic policy management. While MPC and FPC have overlapping membership to ensure that both committees are kept abreast of the insights from each other&rsquo;s deliberations, members of the MPC and the FPC give evidence on a regular basis before the Treasury Committee, and each of the MPC and the FPC in the UK includes a non-voting representative from the Treasury, who sits with the Committees at their meetings, discuss policy issues but is not allowed to vote. The purpose is to ensure that the MPC and FPC are fully briefed on fiscal policy developments and other aspects of the Government&#39;s economic policies, and that the Treasury is kept fully informed about monetary policy and financial policy. In Nigeria the Permanent Secretary of the Federal Ministry of Finance represents the ministry on the MPC as a voting member, though they have tended not to be economists.</p>
<p style="text-align: justify;">
	The current composition of the Nigerian MPC in which lawyers, accountants, and bankers account for as many as eight of the 12 members must partly account for the tendency to retreat from the more important but exacting task of linking policy discourse and action to aggregate, sectoral, and regional economic growth, employment, household and business spending. All the nine members of the UK MPC are economists with expertise in the fields of economics and monetary policy, while only about five of the 10-member UK FPC are economists (including the Governor and two Deputy Governors who also belong to the MPC), the others being lawyers, bankers, accountants or stockbrokers. There is a need for Nigeria to create a Financial Policy Committee (FPC) within the CBN and re-examine the modalities for appointing persons to the MPC in Nigeria to preserve the competence of the committee. The current composition of the Nigerian MPC in which economists are in the minority might be suitable for the FPC, that requires economists, supervisors, and regulators to work together, but only economists should be called upon to set interest rate in the MPC. Economic literacy of individual MPC members, defined as demonstrable ability to read and write technical documents in macro-monetary economics, is needed to preserve the competence, integrity, and credibility of the committee. Track record of ability to publicly articulate views on practical monetary policy issues, especially in writing, is essential for individual MPC members.</p>
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
      <div style=" width:100%"><div style="text-align:justify;  font-size:12px"><p style="text-align: justify;">
	Ayo is the <em>CEO </em>of <em>Economic Associates (EA) </em>where he provides strategic direction for ongoing research and consulting on the outlook of the Nigerian economy, focusing on: global, national, regional, state, and sector issues. He was a <em>Member </em>of the <em>National Economic Intelligence Committee (NEIC) </em>from April 2009 to April 2012, where he conducted periodic reality checks on macroeconomic, fiscal and monetary developments in Nigeria.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: justify;">
	Ayo is well known for articulating his views on economic policy imperatives through articles, interviews and comments in the mass media. Most notably, from 1996 to 1998, he spearheaded the advocacy for re-denomination of Naira notes and coins that led to the successful introduction of N100, N200, N500 and N1000 between December 1999 and October 2005. N50 note was the highest denomination prior to the policy advocacy.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: justify;">
	Before becoming the CEO of EA in 2004, Ayo worked as <em>Chief Economist </em>and Member of Editorial Board at ThisDay Newspaper Group (2001-2004), <em>Faculty Member </em>at the Lagos Business School (1995-2001), <em>Head of Research </em>at the Lagos Chamber of Commerce (1993-1995), and <em>Company Economist </em>at UAC of Nigeria (1992-1993). He has served as <em>Consultant </em>to a long list of blue chip companies, Federal Ministry of Information, Senate Committee on Banking and Finance, several State Governments, DfID, USAID, World Bank, and was a Visiting Scholar to the IMF Research Department in Washington DC.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: justify;">
	He has received grants from Ford Foundation and Rockefeller Foundation, and chaired the steering committee of the Money, Macroeconomic and Finance Research Group of the Money Market Association of Nigeria. His prolific research output has included a 400-page annual economic, fiscal and sectoral report on the 36 states &amp; the FCT, plus numerous scholarly publications resulting from his doctoral thesis, research grants, policy advocacy, and consultancy projects.</p>
<p style="text-align: justify;">
	&nbsp;</p>
<p style="text-align: justify;">
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
  $link = "http://localhost/nigerianseminars/download_article/69/".stripslashes("Puzzles_about_Monetary_Policy_in_Nigeria.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/69/Puzzles_about_Monetary_Policy_in_Nigeria.pdf";
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
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/69/".str_replace($title_link,"-","Puzzles about Monetary Policy in Nigeria");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/69/".str_replace($title_link,"-","Puzzles about Monetary Policy in Nigeria");?>" data-type="button_count"></div>
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
  <strong style="float:left; margin-right:8px;">Tags: </strong> <?php echo tags("Monetary, policy, Growth,  Employment, Stability, Investment, Developments, Fiscal.",'articletagsearch');?>
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