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
  <title><?php echo substr(trim("What is the Balance Sheet Channel of Monetary Policy Transmission?"), 0, 65);?></title>
  <meta name="description" content="
	The purpose of monetary policy is to influence the tempo of economic activities in the country. The manner in which this policy - 54"/>
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
  <h1 style="font-size:23px; text-align:center;">What is the Balance Sheet Channel of Monetary Policy Transmission?</h1>
  <br />
  <div class="event_provider">
  <a href="http://localhost/nigerianseminars/authorPage?id=54" title="Authors Page">
  <p style="color:#fff;"> Author:&nbsp;&nbsp;Central Bank Of Nigeria (CBN) - Education Series </p>
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
	The purpose of monetary policy is to influence the tempo of economic activities in the country. The manner in which this policy affects real economic aggregates such as inflation, output, interest and exchange rates and employment is referred to as transmission mechanism. In theory, monetary policy can be transmitted through the economy in several channels: the interest rate, the bank credit, the balance sheet, the exchange rate, the asset price, and the expectations channels.</p>
<p style="text-align: justify;">
	In this issue, we shall examine what the balance sheet channel of monetary policy is and how monetary policy transmitted via this channel affect the rest of the economy. This channel of monetary policy transmission refers to the role the financial position of private agents play in the transmission mechanism of monetary policy. It arises because the shifts in policy affect not only market interest rates but also, the financial position of private economic agents because changes in interest rates affect bank balance sheets, cash follows and the net worth of companies and consumers. Higher interest rates result in reduced cash flow, reduced net worth, drop in loans, and decline in aggregate demand.</p>
<p style="text-align: justify;">
	The argument here is that official interest rates affect the market value and the income flows of certain categories of financial instruments and that these changes in wealth and interest income have an effect on micro and aggregate expenditure, output, prices and the profitability of economic agents because they directly affect the balance sheet items of the accounts of companies. This relationship is illustrated in the diagram below.</p>
<p style="text-align: justify;">
	The process of the balance sheet channel shows how monetary policy affects the credit portfolio of financial intermediaries as well as other economic agents. For instance, a contradictionary monetary policy such as sale of treasury instruments would affect banks ability to grant loans, leading to credit rationing. This has implications for credit availability to borrowers, especially small-scale borrowers with less sophistication and collateral to back-up their loan demand. In addition, low credit leads to an increase in interest rates thereby raising the cost of credit to small users with ill-defined collaterals.</p>
<p>
	BALANCE SHEET CHANNEL OF MONETARY POLICY TRANSMISSION</p>
<p>
	<img alt="" src="data:image/png;base64,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" /></p>
</div><br /><br />
  <div>
      <div class="articleaboutAuthor"><h2 style="font-size:13px;">About the Author - <span style="color:#000;font-weight: bold">Central Bank Of Nigeria (CBN) - Education Series</span></h2></div><br />
  <div> 
  <div >
      <div style=" width:100%"><div style="text-align:justify;  font-size:12px"><p>
	The series seeks to educate stakeholders and the general public on monetary policy issues such as: what is monetary policy, how it is conducted, What it can do and not do and how the monetary policy actions of the Central Bank of Nigeria affects Nigerians, the economy and the outside world.</p>
</div></div>
  </div>
  </div>
  </div>

  <br />
  
  </td>
  </tr>
  
  <tr class="smart-forms">
  <td style="text-align:left;">
  <a href="http://localhost/nigerianseminars/author/Central-Bank-Of-Nigeria-(CBN)---Education-Series" class="cssButton_roundedLow cssButton_aqua" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;" title="More articles by Central Bank Of Nigeria (CBN) - Education Series" > More articles by Central Bank Of Nigeria (CBN) - Education Series</a>
  </td>
  <td style="text-align:left;"> <h3 style="font-weight:normal;font-size: 13px;"><a href="#author-contact" class="cssButton_roundedLow cssButton_aqua author" style="padding:6px; font-size:12px; background-color:#435A65; color:#FFF;">Contact Author</a></h3></td>
  <td style="width:30%; text-align:right;">
  
  <?php  
  if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){
  $link = "http://localhost/nigerianseminars/download_article/54/".stripslashes("Monetary_Policy_Transmission.pdf");
  $name = '';
  $ArticleUrl = "";
  }
  else{
  $link = '#Login_pop';
  $name = 'prompt';
  $ArticleUrl = "http://localhost/nigerianseminars/download_article/54/Monetary_Policy_Transmission.pdf";
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
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/54/".str_replace($title_link,"-","What is the Balance Sheet Channel of Monetary Policy Transmission?");?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div> 
  <div class="fb-share-button" data-href="https://www.nigerianseminarsandtrainings.com/<?php echo "article/full/54/".str_replace($title_link,"-","What is the Balance Sheet Channel of Monetary Policy Transmission?");?>" data-type="button_count"></div>
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
  <strong style="float:left; margin-right:8px;">Tags: </strong> <?php echo tags("Monetary, Policy, Transmission, Mechanism, Interest, Rate, Credit.",'articletagsearch');?>
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
  <strong style="color:#006600;">Contact Central Bank Of Nigeria (CBN) - Education Series</strong>
  
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
  <input name="to" type="hidden" value="<?php echo str_replace('@','&#64;',"info@cenbank.org");?>" id="to" />
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