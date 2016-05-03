<?php session_start();
	require_once("scripts/config.php"); 
	require_once("scripts/functions.php"); 
	require_once("app/classes/RssFeed.php");
	use nigerianseminarsandtrainings\app\classes\RssFeed;
	$msg=''; 
	/* Fetch Today's Date*/ 
	$today=date("Y-m-d"); 
	$month=date("F Y"); 
	/* Get all events of this month that are not premium */ 
	$eventQuery="SELECT * FROM `events` WHERE startDate like '%$month%' and "; 
	$eventQuery .=" status = 1 and premium = 0 ORDER BY RAND() limit 0, 10"; 
	$result=MysqlSelectQuery($eventQuery); 
	/* Get the Adverts */ 
	$GetAdverts=new Adverts; 
	$yesterday=date('Y-m-d',strtotime("-1 days")); 
	/* Get the Daily Quotes */ 
	$quotesQuery="SELECT * FROM dailyquote WHERE status=1 ORDER BY quote_id desc "; 
	$selected=MysqlSelectQuery($quotesQuery); 
	$nums=NUM_ROWS($selected); 
	if($nums>0){$row=SqlArrays($selected);}

	$newFile = trim(WordTruncate($row['quote'], 50));
	$newFile = str_replace(" ", "000", $newFile);
	$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
	$newFile = str_replace("000", "-", $newFile);
	$newFile = str_replace("--", "-", $newFile);
	$newFile = strtolower($row['quote_id']."-".$newFile);
	$title= trimStringToFullWord(60, stripslashes(strip_tags("Nigerian Seminars and Trainings - Training | Conferences |Courses")));
	$meta = trimStringToFullWord(150, stripslashes(strip_tags("Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America")));
?>
<!DOCTYPE html>
<html lang=en>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Nigerian Seminars and Trainings - Training | Conferences |Courses</title>
	<meta name="application-name" content="Nigerian Seminars and Trainings" />
	<meta name="author" content="Kaiste Ventures" />
	<meta name="dcterms.audience" content="Global" />
	<meta name="robots" content="All" />
	<meta name="robots" content="index, follow" />
	<meta name="description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America | Europe" />
	<meta name="keywords" content="Nigeria, lagos, training, associates, management, consulting, skills, administrative, development, business, workshop, marketing, programme, techniques, effective, strategic, providers, service, develop, leadership, Africa, project, programme, courses" />
	<meta name="rating" content="General" />
	<meta name="dcterms.title" content="Nigerian Seminars and Trainings - Training | Conferences |Courses" />
	<meta name="dcterms.contributor" content="Kaiste Ventures" />
	<meta name="dcterms.creator" content="Kaiste Ventures" />
	<meta name="dcterms.publisher" content="Nigerian Seminars and Trainings" />
	<meta name="dcterms.description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />
	<meta name="dcterms.rights" content="2010 - 2015" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Nigerian Seminars and Trainings - Training | Conferences |Courses" />
	<meta property="og:description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />
	<meta property="twitter:title" content="Nigerian Seminars and Trainings - Training | Conferences |Courses" />
	<meta property="twitter:description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" />
	<meta property="og:image" content="<?php echo SITE_URL;?>images/facebookIMG.png"/>
	<meta property="og:image:type" content="image/jpeg"/>
	<meta property="og:image:width" content="200"/>
	<meta property="og:image:height" content="200"/>
	<meta property="fb:admins" content="724927989" />
	<meta property="fb:app_id" content="139788739390395"/>
	<meta property="twitter_id" content="337259573"/>
	<meta name="wot-verification" content="7af71a13c2938965066e"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="canonical" href="<?php echo SITE_URL;?>"/>
	<link rel="publisher" href="https://plus.google.com/+Nigerianseminarsandtrainings" />
	<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-ng"/>
	<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-gb"/>
	<link rel="alternate" href="https://www.nigerianseminarsandtrainings.com/" hreflang="en-us"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo SITE_URL;?>images/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL;?>stylePrint.css" media="print" />
	<link rel="stylesheet" type="text/css" href="css/min-all-css.css?<?php echo time(); ?>" />
	<style type="text/css">.eventDetail .trainingProviders span li{margin-left:5px;padding-left:5px;list-style-position:inside}.eventDetail .trainingProviders img{float:none}#mask{position:absolute;left:0;top:0;z-index:9000;background-color:#000;display:none}.window{position:fixed;left:0;top:0;width:500px;z-index:9999;padding:20px;display:none}.window_currency{position:fixed;left:0;top:0;width:200px;z-index:9999;padding:20px;display:none}.boxContent{-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px;background-color:#666;padding:8px}.form_content{background-color:#FFF;-webkit-border-radius:8px;-moz-border-radius:8px;border-radius:8px;display:block;float:left}.innerHeadingProp{color:#FFC;padding-left:100px}.innerHeadingProp p{font-size:16px;float:left;margin-left:10px}.subscribe_notification{padding:10px;height:200px;width:500px;background-color:#FFF;float:left;display:none;background-image:url(<?php echo SITE_URL;?>images/school.png);background-repeat:repeat}.subscribe_notification span{padding:5px;font-size:24px;text-align:center;float:left;text-shadow:1px 1px 1px rgba(150,150,150,1)}.subscribe_notification span img{vertical-align:middle;padding-right:5px;float:left}</style>
	<script type="text/javascript">function makeArray(){for(i=0;i<makeArray.arguments.length;i++){this[i+1]=makeArray.arguments[i]}}function renderTime(){var w=new Date();var m="AM";var s=w.getHours();var t=w.getMinutes();var h=w.getSeconds();setTimeout("renderTime()",1000);if(s==0){s=12}else{if(s>=12){s=s-12;m="PM"}}if(s<10){s="0"+s}if(t<10){t="0"+t}if(h<10){h="0"+h}var v=new makeArray("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");var o=w.getDate();var r=w.getMonth()+1;var q=w.getYear();var p=(q<1000)?q+1900:q;var u=document.getElementById("clockDisplay");u.textContent=o+" "+v[r]+", "+p+" "+s+":"+t+":"+h+" "+m}</script>
	<?php include('tools/analytics.php');?>
	<script type="text/javascript">var fb_param={};fb_param.pixel_id="129925353726417";fb_param.value="0.00";(function(){var d=document.createElement("script");d.async=true;d.src="//connect.facebook.net/en_US/fp.js";var c=document.getElementsByTagName("script")[0];c.parentNode.insertBefore(d,c)})();</script>
</head>
<body>
<!-- Google Tag Manager -->

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5JM3HJ');</script>
<!-- End Google Tag Manager -->
<script type=text/javascript>(function(b,e,c){var a,f=b.getElementsByTagName(e)[0];if(b.getElementById(c)){return}a=b.createElement(e);a.id=c;a.src="//connect.facebook.net/en_US/all.js#xfbml=1";f.parentNode.insertBefore(a,f)}(document,"script","facebook-jssdk"));</script>
<script type=text/javascript>_atrk_opts={atrk_acct:"BdEse1a8Dq00M9",domain:"nigerianseminarsandtrainings.com",dynamic:true};(function(){var a=document.createElement("script");a.type="text/javascript";a.async=true;a.src="https://d31qbv1cthcecs.cloudfront.net/atrk.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style=display:none height=1 width=1 alt="Alexa Website Audit Image" /></noscript>
<script type=text/javascript>var _qevents=_qevents||[];(function(){var b=document.createElement("script");b.src=(document.location.protocol=="https:"?"https://secure":"http://edge")+".quantserve.com/quant.js";b.async=true;b.type="text/javascript";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)})();_qevents.push({qacct:"p-2fH5lI6K2ceJA"});</script>
<noscript>
<div style=display:none>
<img src=//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif style=border:none height=1 width=1 alt="Quantcast Website Audit Image"/>
</div>
</noscript>
<div class="menu">

      <!-- Menu icon -->
      <div class="icon-close">
        <img src="<?php echo SITE_URL?>/images/close.png" alt="close">
      </div>

      <div itemscope itemtype=http://schema.org/WebSite class="custom-search">
				<meta itemprop=url content="https://www.nigerianseminarsandtrainings.com/"/>
				<form method=get action="<?php echo SITE_URL;?>content_search" itemprop=potentialAction itemscope itemtype=http://schema.org/SearchAction>
				<meta itemprop=target content="https://www.nigerianseminarsandtrainings.com/content-search?query={query}"/>
					<input name="query" type=text id="query" placeholder="Google&trade; Custom Search" itemprop="query-input" required />
					<button type=submit class=" cssButton_aqua" style="background-color:#435a65;color:#FFF;margin:0;     margin-left: -5px; width:50px; height:30px">Search</button>
				</form>
			</div>
      <!-- Menu -->
      	<p>Uploads</p>
      	<ul>
	      	<?php if(!isset($_SESSION['login_business'])){?>
					<li><a href="<?php echo SITE_URL;?>upload-business-info" title="Add Business"> Add Business <i class="fa fa-square"></i></a></li>
					<?php }?>
					<li><a href="<?php echo SITE_URL;?>add-event" title="Add Event"> Add Event <i class="fa fa-square"></i></a></li>
	      	<li><a href="<?php echo SITE_URL;?>upload-vacancies" title="Add Vacancy"> Add Vacancy <i class="fa fa-square"></i></a></li>
					<li><a href="https://www.nigerianseminarsandtrainings.com/videos/add-video" title="Add Video"> Add Video <i class="fa fa-square"></i></a></li>
				</ul>

				<p class="menu-text-head">Find Events</p>
				<ul>
					<li><a href="<?php echo SITE_URL;?>events/categories" title="Events by category">  Events by Category <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>events/countries" title="Events by Countries">  Events by Countries <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>nigeria" title="Events in Nigeria">  Events in Nigeria <i class="fa fa-square"></i></a></li>
        </ul>
        <p class="menu-text-head">Find Training Providers</p>
        <ul>
	        <li><a href="<?php echo SITE_URL;?>cmd-accr-training-providers" title="Training providers">  CMD Accredited Training Providers <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" title="Training Providers by Category">  Training Providers by Category <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>training-providers/countries" title="Training Providers by Countries">  Training Providers by Countries <i class="fa fa-square"></i></a></li>
	        <li><a href="<?php echo SITE_URL;?>training-provider/nigeria" title="Training Providers in  Nigeria">  Training Providers in Nigeria <i class="fa fa-square"></i></a></li>
				</ul>
				<p class="menu-text-head">Other Links</p>
				<ul>
					<li><a href="<?php echo SITE_URL;?>articles" title="Articles">Articles <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>archive" title="News and Updates">News and Updates <i class="fa fa-square"></i></a></li>
                    <li><a href="<?php echo SITE_URL;?>quoteArchive" title="Quotes">Quotes <i class="fa fa-square"></i></a></li>
	      			<li><a href="weather" style="font-size:13px" title="Check Weather Report">  Check Weather Report <i class="fa fa-square"></i></a></li>
					<li><a href="javascript:void(0)" class="currency" data-id="#currency" style="font-size:13px" title="Currency Converter">  Currency Converter <i class="fa fa-square"></i></a></li>
					<li><a href="domain-checker" style="font-size:13px" title="Domain Name Checker">  Domain Name Checker <i class="fa fa-square"></i></a></li>
					<li><a href="favicon-generator" style="font-size:13px" title="Favicon Generator">  Favicon Generator <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>install-widget" style="font-size:13px" title="Install Widget" target=_blank> Install Training Widget <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>article-submission" title="Submit Articles"> Submit Articles <i class="fa fa-square"></i></a></li>
      </ul>
 </div>
<div id="main_content">
<header>
	<div id="top_element">
	<div id="TopNav">
	<div class="topmenu_options">
	<?php if(isset($_SESSION['login_business'])||isset($_SESSION['login_subcriber'])){?>
	<div class="top_login_form">
		<form action="<?php echo SITE_URL;?>logout" method="post">
			<table style="width:auto;margin-top:-0.8%">
			<tr>
			<td><button type="submit" name="submit_login2" class="sml-btn">Logout</button></td>
			<td><button title="Back to Profile" name="subject2" class="sml-btn" onClick="Account()">Profile</button></td>
			</tr>
			</table>
		</form>
	</div><!-- top_login_form  if loged in-->
	<?php }else{?>
	<div class="top_login_form">
		<div class="btn-control">
			<form id="form1">
				<a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>contact-us">Contact Us</a>
				<a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>login">Login</a>
				<a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>subscribers">Subscribe</a>
			</form>
			<div class="clear"></div>
		</div><!-- top_login_form  if not loged in-->
		<ul class="orion-menu">
			<li class="social">
		<div class="hidele">
		<a href="https://www.facebook.com/nigerianseminars" target="_blank" style="color:#003399" title="Facebook"><i class="fa fa-facebook"></i><span class="tooltip">Facebook</span></a>
		<a href="https://twitter.com/NigerianSeminar" target="_blank" style="color:#3CF" title="Twitter"><i class="fa fa-twitter "></i><span class="tooltip">Twitter</span></a>
		<a href="https://www.nigerianseminarsandtrainings.com/rss" target="_blank" style="color:orange" title="RSS Feeds"><i class="fa fa-rss"></i><span class="tooltip">RSS Feeds</span></a>
		<a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank" style="color:#F00" rel="publisher" title="Google Plus"><i class="fa fa-google"></i><span class="tooltip">Google Plus</span></a>
		<a href="https://www.pinterest.com/nigerianseminar" target="_blank" style="color:red" title="Pinterest"><i class="fa fa-pinterest"></i><span class="tooltip">Pinterest</span></a>
		<a href="https://www.youtube.com/user/nigerianseminars" target="_blank" rel="nofollow" style="color:#F00" title="Youtube"><i class="fa fa-youtube"></i><span class="tooltip">Youtube</span></a>
		</div>
		</li>
		</ul>
	</div>
	<?php }?>
	</div>
	<div class="topmenu_options_left">
	<?php $display='';if(isset($_SESSION['login_business'])||isset($_SESSION['login_subcriber']))$display='Hello '.$_SESSION['name'];else $display='<script type=text/javascript>renderTime();</script>';?>
	<div class=welcomeNote id="clockDisplay">
	<?php echo $display;?>
	</div>
	<p id="google_translate_element" style="float:right;">
	<script type="text/javascript">function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage:"en",layout:google.translate.TranslateElement.InlineLayout.SIMPLE,gaTrack:true,gaId:"UA-23693392-1"},"google_translate_element")}var googleTranslateScript=document.createElement("script");googleTranslateScript.type="text/javascript";googleTranslateScript.async=true;googleTranslateScript.src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(googleTranslateScript);</script>
	</p>
	</div><div class=clearfix></div>
	</div><div class=clearfix></div>
	</div>
	<div class="top_content">
	<div id="slider">
	<div class="logoClass">
	<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAaQAAAA8CAMAAAAe0D6dAAAAA3NCSVQICAjb4U/gAAAC31BMVEX///8A/4IA9XAK4GoAzGY4uHsAvmAAtl0AplkAp1Qqd08zMzOMAABRDCVfABdOACUK4GoPwF8As10AqlkAplkzMzM+KDFOEihfABdWACIA9XAA12cAzGYDwmEAtl0As10ArlkAqlkzMzM6LTM+KDFRDCVWACJOACUA12cDwmEAqlkAplkzMzNFFixOEihVDyQAzGYAtl0AqlkAplkzMzM6LTNAIS8AzGYAvmAAs10AqlkAplkzMzNEHS1FFixGEykAvmAAs10AqlkAplkzMzM/JS9AIS9EHS0At2AAtl0AqlkAplkzMzM+KDEAs10ArlwArlkAqlkAplkzMzM6LTNAIS8Atl0As10ArlwAqlkzMzM6LTMArlwAqVwAplkzMzM7LzM6LTM+KDEArlwAqlkAqVwAplkzMzM6LTMAqlkAplkzMzMArlwAqlkAqVwzMzP/////9///9/z7+Pv4+Pj09/jw9/X38/b88vf/7/v18vfx9PP88Pb07/X/6vnv7u/l8e3p7evb8Ofx5+7R7N/t4unW6eHe3+DD5tPu1eLH49TW2dmz5Mu34M7mz9qs3cSg3b6m2sLMzMy80MmZ2rqS2LXCxsbUwcu0ysKJ1rCD06+3wcDJt8F4zqOdvK1mzJmetauPt6RoxJBhxZGuqa2RrqFJv4imn6RFu4SAp5ZCuXyZmZk4uHtjqoiGnZR4oY1unoZZo4AssGeMjo0hsGV+ioVXlnUAs10AsVgArlwArllPlHI+mW0ArVYAqlkAqVwAqlUDqVozmWZEk2oAqVEAplkAp1QFpVkApk8EolYFoVhogHYkmFwAo0gAokwAolEGnlY1jl4cllcAn0kJmlIAnEMHmVQAmkkLl0oLlFQpilgAmEEAmTNidm4ajk8ClUoFlUAAk0gLkEIQjFAQi0UAkD0Ji0EAi0EegU5DdFtUbGIyd1UPgUUqd08HgUATfUxGXVIcaUQXZD8QYz0zMzPWBNcbAAAA9XRSTlMAERERERERERERERERERERIiIiIiIiIiIiIjMzMzMzMzMzMzMzMzMzRERERERERERVVVVVVVVVZmZmZmZmZmZmd3d3d3d3d3eIiIiIiIiZmZmZmZmZmaqqqqqqqru7u7u7u7vMzMzMzMzd3d3u7u7u/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////yZBK+IAAAAJcEhZcwAADk0AAA5NAUbVaAkAAAAWdEVYdENyZWF0aW9uIFRpbWUAMTEvMTAvMTRXFjCiAAAAHnRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1M1LjGrH0jrAAAVcElEQVR4nO1cib/l1F2PezRVqzF11ybilqYuMWq9RqsxbjFU04j2ppBYSY0xxjygME7RgiwWBaG1RSst4kIrrVWsS8tM5QJ1BphWKC1tKUVrKyiiloq+P8Dv73dOcnPf3PfuvHlveIjv95m5Lzf3LL9zvr/le04WRVklmuHFWUGS+ZahrSy/L0+uaIbjp0XTrffSNUXsWftAPXXE8LNGQlNVRVFVjYCry8J9nJ4aYoUN45PFvmMZCHOaZVlemFYd4+QZe63gvhgEUVelvrXxF82LGafC2/emPRXNLwBR4W/iLYaXkpel+860h2KkKz3FiAFT5T1pKu3LBvGq9fXGXxXMLEIy3nemvZGYItlxqWiJ+AAz209MeyBaRm4kjk3XtW3T1L9I/eylZZ/17f4+e9gDIYwq6UaTum3buq7Ll770rLPOmiZJ9APBd7sADrjpqqr2dQxnr7Q9xWIGkb3XOiwRwqiQecZsZ1Juv/N2eXRb+0uE2y8AuTKfAjcaRNYsEgg9mAQmH7mBqypumajK1mJOp+aKIvokSqKJvqKUm0er+tqGBLPZlJpT3WDSyxINzHy6eBbDWaXoTiSeY0QqCmDe+4EPPwC5H3Lvvffefffdtx/u4ZvVpuJ06+lCI+6sbUvSUi3bWlfL2SzYulc1wWxsXSSoyWTafOtSJvpyty6yHelB0imkSDl+KGq+cYDTlcPZifjdejXwtZxROHroyEff+Lrf/8M33/xnb3vn377rXX///vc/+IGjA0izieKvd+FCKy6dD4T6tUpjWDVx0WwWbVmADKYu61mydTvU1y4GqAGkEmZHg2pn7eT4YgnNwlhWDmcnYjXrzZBf9FaCdM/7XrkGedn5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" alt="N.S.T corporate Logo" width=420 height=60 />
	<div class=clearfix></div>
	</div>
	<div class="Adbanner">
	<?php echo $GetAdverts -> LandScapeAds("Index TopBanner 1","Index");?>
	<div class=clearfix></div>
	</div><div class=clearfix></div>
	</div><div class=clearfix></div>
	<div class="menu_container menu_float">
	<nav>
		<div id="hamburger">
			<a href="<?php echo SITE_URL;?>" id="nav"><i class="fa fa-home fa-2x"></i></a>
			<span id="showNav">Show Menu</span>
			<i class="fa fa-bars fa-2x" id="menu"></i>
		    <form action="<?php echo SITE_URL;?>content_search" method="get" class="wrap">
		    <input id="search_input" name="query" type="text" placeholder="What're You looking for ?">
		    <input type="button" id="search_submit" value=" " />
		    </form>
		</div>
		
		<ul class="orion-menu petrol mobile-hide" id="main-menu">
		<li class="mobile-hide"><h1 style=font-weight:normal;font-size:14px><a style=background-color:#435a65;color:#FFF href="<?php echo SITE_URL;?>" title=Home>Home</a></h1></li>
		<li class="mobile-show-me" id="most-hide"><a href="<?php echo SITE_URL;?>add-event" title="Add Event">Add Event</a></li>
		<li class="mobile-show-me" id="hide-me"><a href="<?php echo SITE_URL;?>upload-business-info" title="Add Business">Add Business</a></li>
		<li class="mobile-show-me" id="shuld-hide"><a href="<?php echo SITE_URL;?>upload-vacancies" title="Add Vacancy">Add Vacancy</a></li>
		<?php if(!isset($_SESSION['login_business'])){?>
		<?php }?>
		<li class="mobile-show" id="for-mobile">
			<a href="#">
				Events
				<i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo SITE_URL;?>all-event">All Events</a></li>
				<li><a href="<?php echo SITE_URL;?>events/categories">Events By Category</a></li>
				<li><a href="<?php echo SITE_URL;?>events/countries">Events By Country</a></li>
				<li><a href="<?php echo SITE_URL;?>nigeria">Events In Nigeria</a></li>
			</ul>
		</li>
		<li class="mobile-hide"><a href="<?php echo SITE_URL;?>all-event" title="All Events">All Events</a></li>
		<li class="mobile-hide"><a href="<?php echo SITE_URL;?>training-providers" title="Training providers">Training Providers</a></li>
		<li class="mobile-show" id="hide">
			<a href="#">
				Training Providers
				<i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo SITE_URL;?>training-providers">All Providers</a></li>
				<li><a href="<?php echo SITE_URL;?>cmd-accr-training-providers">CMD Accredited Training Providers</a></li>
				<li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories">Training Providers By Category</a></li>
				<li><a href="<?php echo SITE_URL;?>training-providers/countries">Training Providers By Country</a></li>
				<li><a href="<?php echo SITE_URL;?>training-provider/nigeria">Training Providers In Nigeria</a></li>
			</ul>
		</li>
		<li><a href="<?php echo SITE_URL;?>suppliers" title="Find Suppliers">Equipment Suppliers</a></li>
		<li><a href="<?php echo SITE_URL;?>venues" title="Find Event Venue ">Event Venue Providers</a></li>
		<li><a href="<?php echo SITE_URL;?>event-managers" title="Event Managers">Event Managers</a></li>
		<li><a href="<?php echo SITE_URL;?>facilitators" title="Find Suppliers">Facilitators</a></li>
		<li class="mobile-show" id="another-hide">
			<a href="#">
				Other Links
				<i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo SITE_URL;?>add-event" title="Add Event">Add Event</a></li>
				<li><a href="<?php echo SITE_URL;?>advertise" title="Advertise">Advertise</a></li>
				<li><a href="<?php echo SITE_URL;?>articles" title="Articles">Articles</a></li>
				<li><a href="<?php echo SITE_URL;?>archive" title="News and Updates">News and Updates</a></li>
				<li><a href="<?php echo SITE_URL;?>premium-listing" title="Premium Listing">Premium Listing</a></li>
				<li><a href="<?php echo SITE_URL;?>quoteArchive" title="Quotes">Quotes</a></li>
				<li><a href="<?php echo SITE_URL;?>article-submission" title="Submit Articles">Submit Articles</a></li>
			</ul>
		</li>
		<li><a href="<?php echo SITE_URL;?>advertise" title="Advertise">Advertise with Us</a></li>
		<li><a href="<?php echo SITE_URL;?>premium-listing" title="Premium Listing">Premium Listing</a></li>
		<li class="mobile-hide more">
			<div class="icon-menu">
				<span id="menu-text">More Menu</span>
        <i class="fa fa-bars fa-2x"></i>
      </div>
		</li>
		</ul>
	</nav>
	
	<div class="clearfix"></div>
	</div><div class="clearfix"></div>
	</div> <div class="clearfix"></div>
</header>
<div id="main_content_body">
	<div id="main">
	<div id="content">
	<div class="category_content responsiveCategoryMain">
	<div class=basic>
	<form action="#" method=post id="searchform_basic" autocomplete="off" style="width:100%;margin-top:5px">
	<table>
	<tr>
	<td><label class="field prepend-icon">
	<input type="text" name="sub2" id="evtsearch" class="gui-input" style="height:30px;width:120%" placeholder="  Enter keywords to search">
	</label>
	<span><a href="javascript:void(0)" style="font-size:11px;margin-top:10px; margin-bottom:15px; font-weight:bold" class="mobile_res" title="Advanced search">Use Advanced search</a></span>
	</td>
	<td style="width:12%;vertical-align:top"><button type="submit" class="cssButton_roundedLow cssButton_aqua" style="padding:2px;font-size:10px;background-color:#435a65;color:#FFF;margin:0;height:32px;border-radius:0">Search</button>
	</td>
	</tr>
	</table>
	</form> <div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div style="text-align:center; margin-top:12px">
	<?php echo $GetAdverts -> SkyScrapper("Index Skyscrapper Left","Index");?>
	</div>
	<div style="text-align:center;margin-top:10px;margin-bottom:10px" class="addshadow"id="hotel"></div>
	<div id="venuProviders" style="float:left"></div>
	<div style="text-align:center">
	<?php echo $GetAdverts -> SkyScrapper("Index Skyscrapper Left 2","Index");?>
	</div>
	</div>
	</div>
	<div id="content_left">
	<div class="CenterAdd" >
	<?php echo $GetAdverts -> LandScapeAds("Index PageBanner 1","Index");?>
	</div>
	<div class="searchSite smart-forms" style="padding-top:0px">
	<p class="mobile-hide" style="text-align:center; margin-bottom:5px;">Use our advanced search function to find events faster</p>
	<div class="advanced" style="display:block">
	<form action="<?php echo SITE_URL;?>search" method="get" id="searchform" autocomplete="off" style="width:100%;margin-top:0">
	<div class="search_inputs">
	<label class="field select"><select name="category" id="category">
	<option value>Choose Category</option>
	<?php $result_category=MysqlSelectQuery("select * from categories order by category_name");?>
	<?php while($rows_category=SqlArrays($result_category)){?>
	<option value="<?php echo $rows_category['category_id'];?>"><?php echo $rows_category['category_name'];?></option>
	<?php }?>
	</select><i class="arrow double"></i>
	</label>
	</div>
	<div class="search_inputs">
	<label class="field prepend-icon">
	<input type="text" id="month-picker1" name="month" class="gui-input" placeholder="Select Month">
	<span class=field-icon><i class="fa fa-calendar-o"></i></span>
	</label>
	</div>
	<div class="search_inputs">
	<label class="field prepend-icon">
	<input type="text" name="provider" id="textInput" class="gui-input" placeholder="Select Training Provider">
	<span class=field-icon><i class="fa fa-user"></i></span>
	<span id="output"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader" width="20" height="14" style="text-align:center" /></span>
	</label>
	</div>
	<div class="search_inputs">
	<label class="field select">
	<select name="country" id="country" onChange="GetState()">
	<?php echo GetContries()?>
	</select>
	<i class="arrow double"></i>
	</label>
	</div>
	<div class="search_btn"><button class="button btn-primary" type="submit">Search</button></div>
	<div class="last_input">
	<p style="float:right">(Leave box blank where not applicable)</p>
	<div class="search_inputs">
	<label class="field select" id="stateSelect" style="display:none">
	<select name="state" id="state"><option value>Select state (Nigeria only)</option><?php echo GetState()?>
	</select><i class="arrow double"></i>
	</label>
	</div>
	<p><a href="javascript:void(0)" style="font-size:11px;text-decoration:none; margin-top:-5px;position: relative; top: -5px; font-weight:bold;" title="Use Basic Search">Use Basic Search</a></p>
	</div>
	</form>
	</div>
	<div id="output_events" style="position:relative;overflow:auto;margin-top:-10%;border-radius:4px/8px;overflow-wrap:break-word"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader" width=20 height=14 style=text-align:center /></div>
	</div>
	<script type="text/javascript">function url_location(a){window.location=a}</script>
	<div class="sub_links">
	<div class="highlights">
	<h2 class="highlights_mobile" style="font-weight:normal;font-size:15px"><strong >Highlights of upcoming <u><a href="all-event-tag-search?tag=training" class=highlights_mobile>conferences,</a></u>
	<u><a href="all-event-tag-search?tag=training" class="highlights_mobile">training,</a></u>
	<u><a href="all-event-tag-search?tag=seminars" class="highlights_mobile">seminars,</a></u>
	<u><a href="all-event-tag-search?tag=management" class="highlights_mobile">management</a></u> /
	<u><a href="all-event-tag-search?tag=professional" class="highlights_mobile">professional</a></u> short <u><a href="all-event-tag-search?tag=courses" class=highlights_mobile>courses</a></u> and
	<u><a href="all-event-tag-search?tag=workshops" class="highlights_mobile">workshops</a></u> in <u><a href="all-event-tag-search?tag=nigeria" class=highlights_mobile>Nigeria,</a></u> <u><a href="all-event-tag-search?tag=africa" class=highlights_mobile>Africa,</a></u> <u><a href="all-event-tag-search?tag=asia" class=highlights_mobile>Asia,</a></u> North/South <u><a href="all-event-tag-search?tag=america" class=highlights_mobile>America,</a></u> <u><a href="all-event-tag-search?tag=europe" class=highlights_mobile>Europe</a></u> and <u><a href="all-event-tag-search?tag=oceania" class=highlights_mobile>Oceania</a></u></strong></h2>
	</div>
	<div class="video_box" id="loadEvent">
	<?php $today=date("Y-m-d");$month=date("F Y");$result_pre=MysqlSelectQuery("SELECT * FROM `events` WHERE SortDate>= '$today' and status = 1 and premium > 0 and premium !=8 ORDER BY premium desc, RAND() ");if(NUM_ROWS($result_pre)>0){while($rows_pre=SqlArrays($result_pre)){$business=MysqlSelectQuery("select * from businessinfo left join logos using (user_id) where business_name like '%".$rows_pre['organiser']."%' and premium > 0");$biz_name=SqlArrays($business);if($biz_name['logos']=='')$logo='images/blank.png';else $logo='premium/logos/thumbs/'.$biz_name['logos'];if($rows_pre['premium']==1){$star='<div class=star2></div>';$image='<img src="'.SITE_URL.$logo.'" alt="business logo" width=50 height="50"/>';$clock_icon='<div class=calendar_time></div>';$bg_class='#FFF9EA';$listing_diff='';$start_h1='<h2>';$end_h1='</h2>';}else{$star='<div class=star1></div>';$bg_class='';$clock_icon='<div class=icon_clock></div>';$listing_diff='';$start_h1='';$end_h1='';}?>
	<div itemscope itemtype="http://schema.org/EducationEvent" class="eventListing member <?php echo ($rows_pre['deals'] != '') ? 'deals' : '' ?>" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rows_pre['event_id'].'/'.str_replace($title_link,"-",$rows_pre['event_title']);?>')">
	<div class="eventListingInner">
	<a href="<?php echo SITE_URL.'events/'.$rows_pre['event_id'].'/'.str_replace($title_link,"-",$rows_pre['event_title']);?>" itemprop="url" style="display:block;padding:3px" title="<?php echo $rows_pre['event_title'];?>"><span class="spanTitle" itemprop="name"><?php echo $rows_pre['event_title'];?></span></a>
	<div class="innerHeadingPropEvent">
	<p itemprop="doorTime"><?php echo dateDiff($rows_pre['startDate'],$rows_pre['endDate']);?>,
	<?php echo date('M d',strtotime($rows_pre['startDate']))." - ".date('d M, Y',strtotime($rows_pre['endDate']));?> &nbsp;</p>
	<span style="display:none" itemprop="startDate" ><?php echo date('Y-m-d h:m:s',strtotime($rows_pre['startDate']));?></span>
	<div class="clearfix"></div>
	</div>
	<span itemprop="location" style="text-align:center;display:block">
	<?php echo GetEventLocation($rows_pre['event_id']);?>
	</span>
	<div class="respond">
	<div class="testImg" style="background-image:url(<?php echo SITE_URL.$logo;?>);background-repeat:no-repeat;background-position:center">
	</div>
	</div>
	<p style="text-align:center;font-size:14px;color:#105773;margin:5px 0 5px 0">
	<?php echo $rows_pre['organiser'];?>
	</p>
	<div class="trainingProviders" style="width:100%">
	<div style="color:#000;font-size:12px;text-align:left" class="description" itemprop="description"><?php echo trim(trimStringToFullWord(145, stripslashes(strip_tags(preg_replace('/\s+/', ' ',$rows_pre['description']))))).'<span style=font-size:16px;color:#105773;font-weight:bold> ...</span>';?> </div>
	</div>
	</div><div class="clearfix"></div>
	</div>
	<?php }}?>
	</div>
	<div class="respond">
	<?php echo $GetAdverts -> LandScapeAds("Index PageBanner 2","Index");?>
	</div>
	<div>
	<div id="mask"></div>
	<div id="currency" style="float:left" class="window_currency boxContent">
	<div id="currency-widget"></div>
	</div>
	</div>
	<div class="clearfix"></div>
	</div>
	</div>
	<div id="sidebar" style="padding-top:0">
	<div class="respond" style="margin-top:6px;">
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h3 style="font-size:13px">Socialize with us</h3></div>
	</div>
	<ul>
	<li>
	<a href="https://twitter.com/nigerianseminar" class="twitter-follow-button" data-show-count="true" data-lang="en" title="Follow @twitterapi">Follow @twitterapi</a>
	<script>!function(b,e,c){var a,f=b.getElementsByTagName(e)[0];if(!b.getElementById(c)){a=b.createElement(e);a.id=c;a.src="//platform.twitter.com/widgets.js";f.parentNode.insertBefore(a,f)}}(document,"script","twitter-wjs");</script>
	</li>
	<li style="margin-bottom:5px;margin-top:5px" class="remove">
	<div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com" data-layout="button_count" data-action="like" data-show-faces="false" style="margin-bottom:5px;margin-left:7px"></div>
	</li>
	<li>
	<div class="g-plusone" data-annotation="inline" data-width="300"></div>
	<script type="text/javascript">(function(){var a=document.createElement("script");a.type="text/javascript";a.async=true;a.src="data:application/octet-stream;base64,dmFyIGdhcGk9d2luZG93LmdhcGk9d2luZG93LmdhcGl8fHt9O2dhcGkuX2JzPW5ldyBEYXRlKCkuZ2V0VGltZSgpOyhmdW5jdGlvbigpe3ZhciBhYT1mdW5jdGlvbihhLGIsYyl7cmV0dXJuIGEuY2FsbC5hcHBseShhLmJpbmQsYXJndW1lbnRzKX0sYmE9ZnVuY3Rpb24oYSxiLGMpe2lmKCFhKXRocm93IEVycm9yKCk7aWYoMjxhcmd1bWVudHMubGVuZ3RoKXt2YXIgZD1BcnJheS5wcm90b3R5cGUuc2xpY2UuY2FsbChhcmd1bWVudHMsMik7cmV0dXJuIGZ1bmN0aW9uKCl7dmFyIGM9QXJyYXkucHJvdG90eXBlLnNsaWNlLmNhbGwoYXJndW1lbnRzKTtBcnJheS5wcm90b3R5cGUudW5zaGlmdC5hcHBseShjLGQpO3JldHVybiBhLmFwcGx5KGIsYyl9fXJldHVybiBmdW5jdGlvbigpe3JldHVybiBhLmFwcGx5KGIsYXJndW1lbnRzKX19LGNhPWZ1bmN0aW9uKGEsYixjKXtjYT1GdW5jdGlvbi5wcm90b3R5cGUuYmluZCYmLTEhPUZ1bmN0aW9uLnByb3RvdHlwZS5iaW5kLnRvU3RyaW5nKCkuaW5kZXhPZigibmF0aXZlIGNvZGUiKT9hYTpiYTtyZXR1cm4gY2EuYXBwbHkobnVsbCxhcmd1bWVudHMpfTt2YXIgbj13aW5kb3cscD1kb2N1bWVudCx1PW4ubG9jYXRpb24sZGE9ZnVuY3Rpb24oKXt9LGVhPS9cW25hdGl2ZSBjb2RlXF0vLHY9ZnVuY3Rpb24oYSxiLGMpe3JldHVybiBhW2JdPWFbYl18fGN9LGZhPWZ1bmN0aW9uKGEpe2Zvcih2YXIgYj0wO2I8dGhpcy5sZW5ndGg7YisrKWlmKHRoaXNbYl09PT1hKXJldHVybiBiO3JldHVybi0xfSxnYT1mdW5jdGlvbihhKXthPWEuc29ydCgpO2Zvcih2YXIgYj1bXSxjPXZvaWQgMCxkPTA7ZDxhLmxlbmd0aDtkKyspe3ZhciBlPWFbZF07ZSE9YyYmYi5wdXNoKGUpO2M9ZX1yZXR1cm4gYn0saGE9LyYvZyxpYT0vPC9nLGphPS8+L2csa2E9LyIvZyxsYT0vJy9nLG1hPWZ1bmN0aW9uKGEpe3JldHVybiBTdHJpbmcoYSkucmVwbGFjZShoYSwiJmFtcDsiKS5yZXBsYWNlKGlhLCImbHQ7IikucmVwbGFjZShqYSwiJmd0OyIpLnJlcGxhY2Uoa2EsIiZxdW90OyIpLnJlcGxhY2UobGEsIiYjMzk7Iil9LHc9ZnVuY3Rpb24oKXt2YXIgYTtpZigoYT1PYmplY3QuY3JlYXRlKSYmCmVhLnRlc3QoYSkpYT1hKG51bGwpO2Vsc2V7YT17fTtmb3IodmFyIGIgaW4gYSlhW2JdPXZvaWQgMH1yZXR1cm4gYX0seD1mdW5jdGlvbihhLGIpe3JldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwoYSxiKX0sej1mdW5jdGlvbihhKXtpZihlYS50ZXN0KE9iamVjdC5rZXlzKSlyZXR1cm4gT2JqZWN0LmtleXMoYSk7dmFyIGI9W10sYztmb3IoYyBpbiBhKXgoYSxjKSYmYi5wdXNoKGMpO3JldHVybiBifSxCPWZ1bmN0aW9uKGEsYil7YT1hfHx7fTtmb3IodmFyIGMgaW4gYSl4KGEsYykmJihiW2NdPWFbY10pfSxuYT1mdW5jdGlvbihhKXtyZXR1cm4gZnVuY3Rpb24oKXtuLnNldFRpbWVvdXQoYSwwKX19LEM9ZnVuY3Rpb24oYSxiKXtpZighYSl0aHJvdyBFcnJvcihifHwiIik7fSxEPXYobiwiZ2FwaSIse30pO3ZhciBFPWZ1bmN0aW9uKGEsYixjKXt2YXIgZD1uZXcgUmVnRXhwKCIoWyNdLiomfFsjXSkiK2IrIj0oW14mI10qKSIsImciKTtiPW5ldyBSZWdFeHAoIihbPyNdLiomfFs/I10pIitiKyI9KFteJiNdKikiLCJnIik7aWYoYT1hJiYoZC5leGVjKGEpfHxiLmV4ZWMoYSkpKXRyeXtjPWRlY29kZVVSSUNvbXBvbmVudChhWzJdKX1jYXRjaChlKXt9cmV0dXJuIGN9LG9hPS9eKFtePyNdKikoXD8oW14jXSopKT8oXCMoLiopKT8kLyxxYT1mdW5jdGlvbihhKXthPWEubWF0Y2gob2EpO3ZhciBiPXcoKTtiLks9YVsxXTtiLmw9YVszXT9bYVszXV06W107Yi52PWFbNV0/W2FbNV1dOltdO3JldHVybiBifSxyYT1mdW5jdGlvbihhKXtyZXR1cm4gYS5LKygwPGEubC5sZW5ndGg/Ij8iK2EubC5qb2luKCImIik6IiIpKygwPGEudi5sZW5ndGg/IiMiK2Eudi5qb2luKCImIik6IiIpfSxzYT1mdW5jdGlvbihhLGIpe3ZhciBjPVtdO2lmKGEpZm9yKHZhciBkIGluIGEpaWYoeChhLGQpJiZudWxsIT1hW2RdKXt2YXIgZT0KYj9iKGFbZF0pOmFbZF07Yy5wdXNoKGVuY29kZVVSSUNvbXBvbmVudChkKSsiPSIrZW5jb2RlVVJJQ29tcG9uZW50KGUpKX1yZXR1cm4gY30sdGE9ZnVuY3Rpb24oYSxiLGMsZCl7YT1xYShhKTthLmwucHVzaC5hcHBseShhLmwsc2EoYixkKSk7YS52LnB1c2guYXBwbHkoYS52LHNhKGMsZCkpO3JldHVybiByYShhKX0sdWE9ZnVuY3Rpb24oYSxiKXt2YXIgYz0iIjsyRTM8Yi5sZW5ndGgmJihjPWIuc3Vic3RyaW5nKDJFMyksYj1iLnN1YnN0cmluZygwLDJFMykpO3ZhciBkPWEuY3JlYXRlRWxlbWVudCgiZGl2IiksZT1hLmNyZWF0ZUVsZW1lbnQoImEiKTtlLmhyZWY9YjtkLmFwcGVuZENoaWxkKGUpO2QuaW5uZXJIVE1MPWQuaW5uZXJIVE1MO2I9U3RyaW5nKGQuZmlyc3RDaGlsZC5ocmVmKTtkLnBhcmVudE5vZGUmJmQucGFyZW50Tm9kZS5yZW1vdmVDaGlsZChkKTtyZXR1cm4gYitjfSx2YT0vXmh0dHBzPzpcL1wvW15cLyVcXD8jXHNdK1wvW15cc10qJC9pO3ZhciBGPWZ1bmN0aW9uKGEsYixjLGQpe2lmKG5bYysiRXZlbnRMaXN0ZW5lciJdKW5bYysiRXZlbnRMaXN0ZW5lciJdKGEsYiwhMSk7ZWxzZSBpZihuW2QrInRhY2hFdmVudCJdKW5bZCsidGFjaEV2ZW50Il0oIm9uIithLGIpfSx3YT1mdW5jdGlvbigpe3ZhciBhPXAucmVhZHlTdGF0ZTtyZXR1cm4iY29tcGxldGUiPT09YXx8ImludGVyYWN0aXZlIj09PWEmJi0xPT1uYXZpZ2F0b3IudXNlckFnZW50LmluZGV4T2YoIk1TSUUiKX0semE9ZnVuY3Rpb24oYSl7dmFyIGI9eGE7aWYoIXdhKCkpdHJ5e2IoKX1jYXRjaChjKXt9eWEoYSl9LHlhPWZ1bmN0aW9uKGEpe2lmKHdhKCkpYSgpO2Vsc2V7dmFyIGI9ITEsYz1mdW5jdGlvbigpe2lmKCFiKXJldHVybiBiPSEwLGEuYXBwbHkodGhpcyxhcmd1bWVudHMpfTtuLmFkZEV2ZW50TGlzdGVuZXI/KG4uYWRkRXZlbnRMaXN0ZW5lcigibG9hZCIsYywhMSksbi5hZGRFdmVudExpc3RlbmVyKCJET01Db250ZW50TG9hZGVkIixjLCExKSk6bi5hdHRhY2hFdmVudCYmCihuLmF0dGFjaEV2ZW50KCJvbnJlYWR5c3RhdGVjaGFuZ2UiLGZ1bmN0aW9uKCl7d2EoKSYmYy5hcHBseSh0aGlzLGFyZ3VtZW50cyl9KSxuLmF0dGFjaEV2ZW50KCJvbmxvYWQiLGMpKX19LEFhPWZ1bmN0aW9uKGEpe2Zvcig7YS5maXJzdENoaWxkOylhLnJlbW92ZUNoaWxkKGEuZmlyc3RDaGlsZCl9LEJhPXtidXR0b246ITAsZGl2OiEwLHNwYW46ITB9O3ZhciBIO0g9dihuLCJfX19qc2wiLHcoKSk7dihILCJJIiwwKTt2KEgsImhlbCIsMTApO3ZhciBJPWZ1bmN0aW9uKGEpe3JldHVybiBILmRwbz9ILmg6RShhLCJqc2giLEguaCl9LENhPWZ1bmN0aW9uKGEpe3ZhciBiPXYoSCwic3dzIixbXSk7Yi5wdXNoLmFwcGx5KGIsYSl9LERhPWZ1bmN0aW9uKGEpe3JldHVybiB2KEgsIndhdHQiLHcoKSlbYV19LEVhPWZ1bmN0aW9uKGEpe3ZhciBiPXYoSCwiUFEiLFtdKTtILlBRPVtdO3ZhciBjPWIubGVuZ3RoO2lmKDA9PT1jKWEoKTtlbHNlIGZvcih2YXIgZD0wLGU9ZnVuY3Rpb24oKXsrK2Q9PT1jJiZhKCl9LGY9MDtmPGM7ZisrKWJbZl0oZSl9LEZhPWZ1bmN0aW9uKGEpe3JldHVybiB2KHYoSCwiSCIsdygpKSxhLHcoKSl9O3ZhciBKPXYoSCwicGVyZiIsdygpKSxHYT12KEosImciLHcoKSksSGE9dihKLCJpIix3KCkpO3YoSiwiciIsW10pO3coKTt3KCk7dmFyIElhPWZ1bmN0aW9uKGEsYixjKXt2YXIgZD1KLnI7ImZ1bmN0aW9uIj09PXR5cGVvZiBkP2QoYSxiLGMpOmQucHVzaChbYSxiLGNdKX0sSz1mdW5jdGlvbihhLGIsYyl7R2FbYV09IWImJkdhW2FdfHxjfHwobmV3IERhdGUpLmdldFRpbWUoKTtJYShhKX0sTD1mdW5jdGlvbihhLGIsYyl7YiYmMDxiLmxlbmd0aCYmKGI9SmEoYiksYyYmMDxjLmxlbmd0aCYmKGIrPSJfX18iK0phKGMpKSwyODxiLmxlbmd0aCYmKGI9Yi5zdWJzdHIoMCwyOCkrKGIubGVuZ3RoLTI4KSksYz1iLGI9dihIYSwiX3AiLHcoKSksdihiLGMsdygpKVthXT0obmV3IERhdGUpLmdldFRpbWUoKSxJYShhLCJfcCIsYykpfSxKYT1mdW5jdGlvbihhKXtyZXR1cm4gYS5qb2luKCJfXyIpLnJlcGxhY2UoL1wuL2csIl8iKS5yZXBsYWNlKC9cLS9nLCJfIikucmVwbGFjZSgvXCwvZywiXyIpfTt2YXIgS2E9dygpLE09W10sTj1mdW5jdGlvbihhKXt0aHJvdyBFcnJvcigiQmFkIGhpbnQiKyhhPyI6ICIrYToiIikpO307TS5wdXNoKFsianNsIixmdW5jdGlvbihhKXtmb3IodmFyIGIgaW4gYSlpZih4KGEsYikpe3ZhciBjPWFbYl07Im9iamVjdCI9PXR5cGVvZiBjP0hbYl09dihILGIsW10pLmNvbmNhdChjKTp2KEgsYixjKX1pZihiPWEudSlhPXYoSCwidXMiLFtdKSxhLnB1c2goYiksKGI9L15odHRwczooLiopJC8uZXhlYyhiKSkmJmEucHVzaCgiaHR0cDoiK2JbMV0pfV0pO3ZhciBMYT0vXihcL1thLXpBLVowLTlfXC1dKykrJC8sTWE9L15bYS16QS1aMC05XC1fXC4sIV0rJC8sTmE9L15nYXBpXC5sb2FkZWRfWzAtOV0rJC8sT2E9L15bYS16QS1aMC05LC5fLV0rJC8sU2E9ZnVuY3Rpb24oYSxiLGMsZCl7dmFyIGU9YS5zcGxpdCgiOyIpLGY9ZS5zaGlmdCgpLGc9S2FbZl0saz1udWxsO2c/az1nKGUsYixjLGQpOk4oIm5vIGhpbnQgcHJvY2Vzc29yIGZvcjogIitmKTtrfHxOKCJmYWlsZWQgdG8gZ2VuZXJhdGUgbG9hZCB1cmwiKTtiPWs7Yz1iLm1hdGNoKFBhKTsoZD1iLm1hdGNoKFFhKSkmJjE9PT1kLmxlbmd0aCYmUmEudGVzdChiKSYmYyYmMT09PWMubGVuZ3RofHxOKCJmYWlsZWQgc2FuaXR5OiAiK2EpO3JldHVybiBrfSxWYT1mdW5jdGlvbihhLGIsYyxkKXthPVRhKGEpO05hLnRlc3QoYyl8fE4oImludmFsaWRfY2FsbGJhY2siKTtiPVVhKGIpO2Q9ZCYmZC5sZW5ndGg/VWEoZCk6bnVsbDt2YXIgZT1mdW5jdGlvbihhKXtyZXR1cm4gZW5jb2RlVVJJQ29tcG9uZW50KGEpLnJlcGxhY2UoLyUyQy9nLAoiLCIpfTtyZXR1cm5bZW5jb2RlVVJJQ29tcG9uZW50KGEuJCkucmVwbGFjZSgvJTJDL2csIiwiKS5yZXBsYWNlKC8lMkYvZywiLyIpLCIvaz0iLGUoYS52ZXJzaW9uKSwiL209IixlKGIpLGQ/Ii9leG09IitlKGQpOiIiLCIvcnQ9ai9zdj0xL2Q9MS9lZD0xIixhLko/Ii9hbT0iK2UoYS5KKToiIixhLlQ/Ii9ycz0iK2UoYS5UKToiIixhLlY/Ii90PSIrZShhLlYpOiIiLCIvY2I9IixlKGMpXS5qb2luKCIiKX0sVGE9ZnVuY3Rpb24oYSl7Ii8iIT09YS5jaGFyQXQoMCkmJk4oInJlbGF0aXZlIHBhdGgiKTtmb3IodmFyIGI9YS5zdWJzdHJpbmcoMSkuc3BsaXQoIi8iKSxjPVtdO2IubGVuZ3RoOyl7YT1iLnNoaWZ0KCk7aWYoIWEubGVuZ3RofHwwPT1hLmluZGV4T2YoIi4iKSlOKCJlbXB0eS9yZWxhdGl2ZSBkaXJlY3RvcnkiKTtlbHNlIGlmKDA8YS5pbmRleE9mKCI9Iikpe2IudW5zaGlmdChhKTticmVha31jLnB1c2goYSl9YT17fTtmb3IodmFyIGQ9MCxlPWIubGVuZ3RoO2Q8ZTsrK2Qpe3ZhciBmPQpiW2RdLnNwbGl0KCI9IiksZz1kZWNvZGVVUklDb21wb25lbnQoZlswXSksaz1kZWNvZGVVUklDb21wb25lbnQoZlsxXSk7Mj09Zi5sZW5ndGgmJmcmJmsmJihhW2ddPWFbZ118fGspfWI9Ii8iK2Muam9pbigiLyIpO0xhLnRlc3QoYil8fE4oImludmFsaWRfcHJlZml4Iik7Yz1PKGEsImsiLCEwKTtkPU8oYSwiYW0iKTtlPU8oYSwicnMiKTthPU8oYSwidCIpO3JldHVybnskOmIsdmVyc2lvbjpjLEo6ZCxUOmUsVjphfX0sVWE9ZnVuY3Rpb24oYSl7Zm9yKHZhciBiPVtdLGM9MCxkPWEubGVuZ3RoO2M8ZDsrK2Mpe3ZhciBlPWFbY10ucmVwbGFjZSgvXC4vZywiXyIpLnJlcGxhY2UoLy0vZywiXyIpO09hLnRlc3QoZSkmJmIucHVzaChlKX1yZXR1cm4gYi5qb2luKCIsIil9LE89ZnVuY3Rpb24oYSxiLGMpe2E9YVtiXTshYSYmYyYmTigibWlzc2luZzogIitiKTtpZihhKXtpZihNYS50ZXN0KGEpKXJldHVybiBhO04oImludmFsaWQ6ICIrYil9cmV0dXJuIG51bGx9LFJhPS9eaHR0cHM/OlwvXC9bYS16MC05Xy4tXStcLmdvb2dsZVwuY29tKDpcZCspP1wvW2EtekEtWjAtOV8uLCE9XC1cL10rJC8sClFhPS9cL2NiPS9nLFBhPS9cL1wvL2csV2E9ZnVuY3Rpb24oKXt2YXIgYT1JKHUuaHJlZik7aWYoIWEpdGhyb3cgRXJyb3IoIkJhZCBoaW50Iik7cmV0dXJuIGF9O0thLm09ZnVuY3Rpb24oYSxiLGMsZCl7KGE9YVswXSl8fE4oIm1pc3NpbmdfaGludCIpO3JldHVybiJodHRwczovL2FwaXMuZ29vZ2xlLmNvbSIrVmEoYSxiLGMsZCl9O3ZhciBYYT1kZWNvZGVVUkkoIiU3M2NyaXB0IiksWWE9ZnVuY3Rpb24oYSxiKXtmb3IodmFyIGM9W10sZD0wO2Q8YS5sZW5ndGg7KytkKXt2YXIgZT1hW2RdO2UmJjA+ZmEuY2FsbChiLGUpJiZjLnB1c2goZSl9cmV0dXJuIGN9LCRhPWZ1bmN0aW9uKGEpeyJsb2FkaW5nIiE9cC5yZWFkeVN0YXRlP1phKGEpOnAud3JpdGUoIjwiK1hhKycgc3JjPSInK2VuY29kZVVSSShhKSsnIj48LycrWGErIj4iKX0sWmE9ZnVuY3Rpb24oYSl7dmFyIGI9cC5jcmVhdGVFbGVtZW50KFhhKTtiLnNldEF0dHJpYnV0ZSgic3JjIixhKTtiLmFzeW5jPSJ0cnVlIjsoYT1wLmdldEVsZW1lbnRzQnlUYWdOYW1lKFhhKVswXSk/YS5wYXJlbnROb2RlLmluc2VydEJlZm9yZShiLGEpOihwLmhlYWR8fHAuYm9keXx8cC5kb2N1bWVudEVsZW1lbnQpLmFwcGVuZENoaWxkKGIpfSxhYj1mdW5jdGlvbihhLGIpe3ZhciBjPWImJmIuX2M7aWYoYylmb3IodmFyIGQ9MDtkPE0ubGVuZ3RoO2QrKyl7dmFyIGU9TVtkXVswXSwKZj1NW2RdWzFdO2YmJngoYyxlKSYmZihjW2VdLGEsYil9fSxjYj1mdW5jdGlvbihhLGIsYyl7YmIoZnVuY3Rpb24oKXt2YXIgYztjPWI9PT1JKHUuaHJlZik/dihELCJfIix3KCkpOncoKTtjPXYoRmEoYiksIl8iLGMpO2EoYyl9LGMpfSxQPWZ1bmN0aW9uKGEsYil7dmFyIGM9Ynx8e307ImZ1bmN0aW9uIj09dHlwZW9mIGImJihjPXt9LGMuY2FsbGJhY2s9Yik7YWIoYSxjKTt2YXIgZD1hP2Euc3BsaXQoIjoiKTpbXSxlPWMuaHx8V2EoKSxmPXYoSCwiYWgiLHcoKSk7aWYoZlsiOjoiXSYmZC5sZW5ndGgpe2Zvcih2YXIgZz1bXSxrPW51bGw7az1kLnNoaWZ0KCk7KXt2YXIgaD1rLnNwbGl0KCIuIiksaD1mW2tdfHxmW2hbMV0mJiJuczoiK2hbMF18fCIiXXx8ZSxxPWcubGVuZ3RoJiZnW2cubGVuZ3RoLTFdfHxudWxsLGw9cTtxJiZxLmhpbnQ9PWh8fChsPXtoaW50OmgsTjpbXX0sZy5wdXNoKGwpKTtsLk4ucHVzaChrKX12YXIgbT1nLmxlbmd0aDtpZigxPG0pe3ZhciB0PWMuY2FsbGJhY2s7CnQmJihjLmNhbGxiYWNrPWZ1bmN0aW9uKCl7MD09LS1tJiZ0KCl9KX1mb3IoO2Q9Zy5zaGlmdCgpOylkYihkLk4sYyxkLmhpbnQpfWVsc2UgZGIoZHx8W10sYyxlKX0sZGI9ZnVuY3Rpb24oYSxiLGMpe2E9Z2EoYSl8fFtdO3ZhciBkPWIuY2FsbGJhY2ssZT1iLmNvbmZpZyxmPWIudGltZW91dCxnPWIub250aW1lb3V0LGs9Yi5vbmVycm9yLGg9dm9pZCAwOyJmdW5jdGlvbiI9PXR5cGVvZiBrJiYoaD1rKTt2YXIgcT1udWxsLGw9ITE7aWYoZiYmIWd8fCFmJiZnKXRocm93IlRpbWVvdXQgcmVxdWlyZXMgYm90aCB0aGUgdGltZW91dCBwYXJhbWV0ZXIgYW5kIG9udGltZW91dCBwYXJhbWV0ZXIgdG8gYmUgc2V0Ijt2YXIgaz12KEZhKGMpLCJyIixbXSkuc29ydCgpLG09dihGYShjKSwiTCIsW10pLnNvcnQoKSx0PVtdLmNvbmNhdChrKSxBPWZ1bmN0aW9uKGEsYil7aWYobClyZXR1cm4gMDtuLmNsZWFyVGltZW91dChxKTttLnB1c2guYXBwbHkobSxyKTt2YXIgZD0oKER8fHt9KS5jb25maWd8fAp7fSkudXBkYXRlO2Q/ZChlKTplJiZ2KEgsImN1IixbXSkucHVzaChlKTtpZihiKXtMKCJtZTAiLGEsdCk7dHJ5e2NiKGIsYyxoKX1maW5hbGx5e0woIm1lMSIsYSx0KX19cmV0dXJuIDF9OzA8ZiYmKHE9bi5zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7bD0hMDtnKCl9LGYpKTt2YXIgcj1ZYShhLG0pO2lmKHIubGVuZ3RoKXt2YXIgcj1ZYShhLGspLHk9dihILCJDUCIsW10pLEc9eS5sZW5ndGg7eVtHXT1mdW5jdGlvbihhKXtpZighYSlyZXR1cm4gMDtMKCJtbDEiLHIsdCk7dmFyIGI9ZnVuY3Rpb24oYil7eVtHXT1udWxsO0EocixhKSYmRWEoZnVuY3Rpb24oKXtkJiZkKCk7YigpfSl9LGM9ZnVuY3Rpb24oKXt2YXIgYT15W0crMV07YSYmYSgpfTswPEcmJnlbRy0xXT95W0ddPWZ1bmN0aW9uKCl7YihjKX06YihjKX07aWYoci5sZW5ndGgpe3ZhciBwYT0ibG9hZGVkXyIrSC5JKys7RFtwYV09ZnVuY3Rpb24oYSl7eVtHXShhKTtEW3BhXT1udWxsfTthPVNhKGMsciwiZ2FwaS4iK3BhLGspO2sucHVzaC5hcHBseShrLApyKTtMKCJtbDAiLHIsdCk7Yi5zeW5jfHxuLl9fX2dhcGlzeW5jPyRhKGEpOlphKGEpfWVsc2UgeVtHXShkYSl9ZWxzZSBBKHIpJiZkJiZkKCl9O3ZhciBiYj1mdW5jdGlvbihhLGIpe2lmKEguaGVlJiYwPEguaGVsKXRyeXtyZXR1cm4gYSgpfWNhdGNoKGMpe2ImJmIoYyksSC5oZWwtLSxQKCJkZWJ1Z19lcnJvciIsZnVuY3Rpb24oKXt0cnl7d2luZG93Ll9fX2pzbC5oZWZuKGMpfWNhdGNoKGEpe3Rocm93IGM7fX0pfWVsc2UgdHJ5e3JldHVybiBhKCl9Y2F0Y2goZCl7dGhyb3cgYiYmYihkKSxkO319O0QubG9hZD1mdW5jdGlvbihhLGIpe3JldHVybiBiYihmdW5jdGlvbigpe3JldHVybiBQKGEsYil9KX07dmFyIFE9ZnVuY3Rpb24oYSl7dmFyIGI9d2luZG93Ll9fX2pzbD13aW5kb3cuX19fanNsfHx7fTtiW2FdPWJbYV18fFtdO3JldHVybiBiW2FdfSxSPWZ1bmN0aW9uKGEpe3ZhciBiPXdpbmRvdy5fX19qc2w9d2luZG93Ll9fX2pzbHx8e307Yi5jZmc9IWEmJmIuY2ZnfHx7fTtyZXR1cm4gYi5jZmd9LGViPWZ1bmN0aW9uKGEpe3JldHVybiJvYmplY3QiPT09dHlwZW9mIGEmJi9cW25hdGl2ZSBjb2RlXF0vLnRlc3QoYS5wdXNoKX0sUz1mdW5jdGlvbihhLGIpe2lmKGIpZm9yKHZhciBjIGluIGIpYi5oYXNPd25Qcm9wZXJ0eShjKSYmKGFbY10mJmJbY10mJiJvYmplY3QiPT09dHlwZW9mIGFbY10mJiJvYmplY3QiPT09dHlwZW9mIGJbY10mJiFlYihhW2NdKSYmIWViKGJbY10pP1MoYVtjXSxiW2NdKTpiW2NdJiYib2JqZWN0Ij09PXR5cGVvZiBiW2NdPyhhW2NdPWViKGJbY10pP1tdOnt9LFMoYVtjXSxiW2NdKSk6YVtjXT1iW2NdKX0sZmI9ZnVuY3Rpb24oYSl7aWYoYSYmIS9eXHMrJC8udGVzdChhKSl7Zm9yKDswPT0KYS5jaGFyQ29kZUF0KGEubGVuZ3RoLTEpOylhPWEuc3Vic3RyaW5nKDAsYS5sZW5ndGgtMSk7dmFyIGI7dHJ5e2I9d2luZG93LkpTT04ucGFyc2UoYSl9Y2F0Y2goYyl7fWlmKCJvYmplY3QiPT09dHlwZW9mIGIpcmV0dXJuIGI7dHJ5e2I9KG5ldyBGdW5jdGlvbigicmV0dXJuICgiK2ErIlxuKSIpKSgpfWNhdGNoKGQpe31pZigib2JqZWN0Ij09PXR5cGVvZiBiKXJldHVybiBiO3RyeXtiPShuZXcgRnVuY3Rpb24oInJldHVybiAoeyIrYSsiXG59KSIpKSgpfWNhdGNoKGUpe31yZXR1cm4ib2JqZWN0Ij09PXR5cGVvZiBiP2I6e319fSxnYj1mdW5jdGlvbihhKXtSKCEwKTt2YXIgYj13aW5kb3cuX19fZ2NmZyxjPVEoImN1Iik7aWYoYiYmYiE9PXdpbmRvdy5fX19ndSl7dmFyIGQ9e307UyhkLGIpO2MucHVzaChkKTt3aW5kb3cuX19fZ3U9Yn12YXIgYj1RKCJjdSIpLGU9ZG9jdW1lbnQuc2NyaXB0c3x8ZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoInNjcmlwdCIpfHxbXSxkPVtdLApmPVtdO2YucHVzaC5hcHBseShmLFEoInVzIikpO2Zvcih2YXIgZz0wO2c8ZS5sZW5ndGg7KytnKWZvcih2YXIgaz1lW2ddLGg9MDtoPGYubGVuZ3RoOysraClrLnNyYyYmMD09ay5zcmMuaW5kZXhPZihmW2hdKSYmZC5wdXNoKGspOzA9PWQubGVuZ3RoJiYwPGUubGVuZ3RoJiZlW2UubGVuZ3RoLTFdLnNyYyYmZC5wdXNoKGVbZS5sZW5ndGgtMV0pO2ZvcihlPTA7ZTxkLmxlbmd0aDsrK2UpZFtlXS5nZXRBdHRyaWJ1dGUoImdhcGlfcHJvY2Vzc2VkIil8fChkW2VdLnNldEF0dHJpYnV0ZSgiZ2FwaV9wcm9jZXNzZWQiLCEwKSwoZj1kW2VdKT8oZz1mLm5vZGVUeXBlLGY9Mz09Z3x8ND09Zz9mLm5vZGVWYWx1ZTpmLnRleHRDb250ZW50fHxmLmlubmVyVGV4dHx8Zi5pbm5lckhUTUx8fCIiKTpmPXZvaWQgMCwoZj1mYihmKSkmJmIucHVzaChmKSk7YSYmKGQ9e30sUyhkLGEpLGMucHVzaChkKSk7ZD1RKCJjZCIpO2E9MDtmb3IoYj1kLmxlbmd0aDthPGI7KythKVMoUigpLGRbYV0pO2Q9USgiY2kiKTsKYT0wO2ZvcihiPWQubGVuZ3RoO2E8YjsrK2EpUyhSKCksZFthXSk7YT0wO2ZvcihiPWMubGVuZ3RoO2E8YjsrK2EpUyhSKCksY1thXSl9LFQ9ZnVuY3Rpb24oYSl7aWYoIWEpcmV0dXJuIFIoKTthPWEuc3BsaXQoIi8iKTtmb3IodmFyIGI9UigpLGM9MCxkPWEubGVuZ3RoO2ImJiJvYmplY3QiPT09dHlwZW9mIGImJmM8ZDsrK2MpYj1iW2FbY11dO3JldHVybiBjPT09YS5sZW5ndGgmJnZvaWQgMCE9PWI/Yjp2b2lkIDB9LGhiPWZ1bmN0aW9uKGEsYil7dmFyIGM9YTtpZigic3RyaW5nIj09PXR5cGVvZiBhKXtmb3IodmFyIGQ9Yz17fSxlPWEuc3BsaXQoIi8iKSxmPTAsZz1lLmxlbmd0aDtmPGctMTsrK2YpdmFyIGs9e30sZD1kW2VbZl1dPWs7ZFtlW2ZdXT1ifWdiKGMpfTt2YXIgaWI9ZnVuY3Rpb24oKXt2YXIgYT13aW5kb3cuX19HT09HTEVBUElTO2EmJihhLmdvb2dsZWFwaXMmJiFhWyJnb29nbGVhcGlzLmNvbmZpZyJdJiYoYVsiZ29vZ2xlYXBpcy5jb25maWciXT1hLmdvb2dsZWFwaXMpLHYoSCwiY2kiLFtdKS5wdXNoKGEpLHdpbmRvdy5fX0dPT0dMRUFQSVM9dm9pZCAwKX07dmFyIGpiPXthcHBwYWNrYWdlbmFtZToxLGNhbGxiYWNrOjEsY2xpZW50aWQ6MSxjb29raWVwb2xpY3k6MSxvcGVuaWRyZWFsbTotMSxpbmNsdWRlZ3JhbnRlZHNjb3BlczotMSxyZXF1ZXN0dmlzaWJsZWFjdGlvbnM6MSxzY29wZToxfSxrYj0hMSxsYj13KCksbWI9ZnVuY3Rpb24oKXtpZigha2Ipe2Zvcih2YXIgYT1kb2N1bWVudC5nZXRFbGVtZW50c0J5VGFnTmFtZSgibWV0YSIpLGI9MDtiPGEubGVuZ3RoOysrYil7dmFyIGM9YVtiXS5uYW1lLnRvTG93ZXJDYXNlKCk7aWYoMD09Yy5sYXN0SW5kZXhPZigiZ29vZ2xlLXNpZ25pbi0iLDApKXt2YXIgYz1jLnN1YnN0cmluZygxNCksZD1hW2JdLmNvbnRlbnQ7amJbY10mJmQmJihsYltjXT1kKX19aWYod2luZG93LnNlbGYhPT13aW5kb3cudG9wKXt2YXIgYT1kb2N1bWVudC5sb2NhdGlvbi50b1N0cmluZygpLGU7Zm9yKGUgaW4gamIpMDxqYltlXSYmKGI9RShhLGUsIiIpKSYmKGxiW2VdPWIpfWtiPSEwfWU9dygpO0IobGIsZSk7cmV0dXJuIGV9LApuYj1mdW5jdGlvbihhKXtyZXR1cm4hIShhLmNsaWVudGlkJiZhLnNjb3BlJiZhLmNhbGxiYWNrKX07dmFyIG9iPXdpbmRvdy5jb25zb2xlLHBiPWZ1bmN0aW9uKGEpe29iJiZvYi5sb2cmJm9iLmxvZyhhKX07dmFyIHFiPWZ1bmN0aW9uKCl7cmV0dXJuISFILm9hfSxyYj1mdW5jdGlvbigpe307dmFyIFU9dihILCJydyIsdygpKSxzYj1mdW5jdGlvbihhKXtmb3IodmFyIGIgaW4gVSlhKFVbYl0pfSx0Yj1mdW5jdGlvbihhLGIpe3ZhciBjPVVbYV07YyYmYy5zdGF0ZTxiJiYoYy5zdGF0ZT1iKX07dmFyIHViO3ZhciB2Yj0vXmh0dHBzPzpcL1wvKD86XHd8W1wtXC5dKStcLmdvb2dsZVwuKD86XHd8W1wtOlwuXSkrKD86XC9bXlw/XCNdKik/XC91XC8oXGQpXC8vLHdiPS9eaHR0cHM/OlwvXC8oPzpcd3xbXC1cLl0pK1wuZ29vZ2xlXC4oPzpcd3xbXC06XC5dKSsoPzpcL1teXD9cI10qKT9cL2JcLyhcZHsxMCx9KVwvLyx4Yj1mdW5jdGlvbihhKXt2YXIgYj1UKCJnb29nbGVhcGlzLmNvbmZpZy9zZXNzaW9uSW5kZXgiKTtudWxsPT1iJiYoYj13aW5kb3cuX19YX0dPT0dfQVVUSFVTRVIpO2lmKG51bGw9PWIpe3ZhciBjPXdpbmRvdy5nb29nbGU7YyYmKGI9Yy5hdXRodXNlcil9bnVsbD09YiYmKGE9YXx8d2luZG93LmxvY2F0aW9uLmhyZWYsYj1FKGEsImF1dGh1c2VyIil8fG51bGwsbnVsbD09YiYmKGI9KGI9YS5tYXRjaCh2YikpP2JbMV06bnVsbCkpO3JldHVybiBudWxsPT1iP251bGw6U3RyaW5nKGIpfSx5Yj1mdW5jdGlvbihhKXt2YXIgYj1UKCJnb29nbGVhcGlzLmNvbmZpZy9zZXNzaW9uRGVsZWdhdGUiKTsKbnVsbD09YiYmKGI9KGE9KGF8fHdpbmRvdy5sb2NhdGlvbi5ocmVmKS5tYXRjaCh3YikpP2FbMV06bnVsbCk7cmV0dXJuIG51bGw9PWI/bnVsbDpTdHJpbmcoYil9O3ZhciB6Yj1mdW5jdGlvbigpe3RoaXMuYz0tMX07dmFyIFY9ZnVuY3Rpb24oKXt0aGlzLmM9LTE7dGhpcy5jPTY0O3RoaXMuYj1bXTt0aGlzLkM9W107dGhpcy5XPVtdO3RoaXMudz1bXTt0aGlzLndbMF09MTI4O2Zvcih2YXIgYT0xO2E8dGhpcy5jOysrYSl0aGlzLndbYV09MDt0aGlzLkE9dGhpcy5qPTA7dGhpcy5yZXNldCgpfTsoZnVuY3Rpb24oKXtmdW5jdGlvbiBhKCl7fWEucHJvdG90eXBlPXpiLnByb3RvdHlwZTtWLmdhPXpiLnByb3RvdHlwZTtWLnByb3RvdHlwZT1uZXcgYTtWLks9ZnVuY3Rpb24oYSxjLGQpe2Zvcih2YXIgZT1BcnJheShhcmd1bWVudHMubGVuZ3RoLTIpLGY9MjtmPGFyZ3VtZW50cy5sZW5ndGg7ZisrKWVbZi0yXT1hcmd1bWVudHNbZl07cmV0dXJuIHpiLnByb3RvdHlwZVtjXS5hcHBseShhLGUpfX0pKCk7ClYucHJvdG90eXBlLnJlc2V0PWZ1bmN0aW9uKCl7dGhpcy5iWzBdPTE3MzI1ODQxOTM7dGhpcy5iWzFdPTQwMjMyMzM0MTc7dGhpcy5iWzJdPTI1NjIzODMxMDI7dGhpcy5iWzNdPTI3MTczMzg3ODt0aGlzLmJbNF09MzI4NTM3NzUyMDt0aGlzLkE9dGhpcy5qPTB9Owp2YXIgQWI9ZnVuY3Rpb24oYSxiLGMpe2N8fChjPTApO3ZhciBkPWEuVztpZigic3RyaW5nIj09dHlwZW9mIGIpZm9yKHZhciBlPTA7MTY+ZTtlKyspZFtlXT1iLmNoYXJDb2RlQXQoYyk8PDI0fGIuY2hhckNvZGVBdChjKzEpPDwxNnxiLmNoYXJDb2RlQXQoYysyKTw8OHxiLmNoYXJDb2RlQXQoYyszKSxjKz00O2Vsc2UgZm9yKGU9MDsxNj5lO2UrKylkW2VdPWJbY108PDI0fGJbYysxXTw8MTZ8YltjKzJdPDw4fGJbYyszXSxjKz00O2ZvcihlPTE2OzgwPmU7ZSsrKXt2YXIgZj1kW2UtM11eZFtlLThdXmRbZS0xNF1eZFtlLTE2XTtkW2VdPShmPDwxfGY+Pj4zMSkmNDI5NDk2NzI5NX1iPWEuYlswXTtjPWEuYlsxXTtmb3IodmFyIGc9YS5iWzJdLGs9YS5iWzNdLGg9YS5iWzRdLHEsZT0wOzgwPmU7ZSsrKTQwPmU/MjA+ZT8oZj1rXmMmKGdeaykscT0xNTE4NTAwMjQ5KTooZj1jXmdeayxxPTE4NTk3NzUzOTMpOjYwPmU/KGY9YyZnfGsmKGN8ZykscT0yNDAwOTU5NzA4KTooZj1jXmdeaywKcT0zMzk1NDY5NzgyKSxmPShiPDw1fGI+Pj4yNykrZitoK3ErZFtlXSY0Mjk0OTY3Mjk1LGg9ayxrPWcsZz0oYzw8MzB8Yz4+PjIpJjQyOTQ5NjcyOTUsYz1iLGI9ZjthLmJbMF09YS5iWzBdK2ImNDI5NDk2NzI5NTthLmJbMV09YS5iWzFdK2MmNDI5NDk2NzI5NTthLmJbMl09YS5iWzJdK2cmNDI5NDk2NzI5NTthLmJbM109YS5iWzNdK2smNDI5NDk2NzI5NTthLmJbNF09YS5iWzRdK2gmNDI5NDk2NzI5NX07ClYucHJvdG90eXBlLnVwZGF0ZT1mdW5jdGlvbihhLGIpe2lmKG51bGwhPWEpe3ZvaWQgMD09PWImJihiPWEubGVuZ3RoKTtmb3IodmFyIGM9Yi10aGlzLmMsZD0wLGU9dGhpcy5DLGY9dGhpcy5qO2Q8Yjspe2lmKDA9PWYpZm9yKDtkPD1jOylBYih0aGlzLGEsZCksZCs9dGhpcy5jO2lmKCJzdHJpbmciPT10eXBlb2YgYSlmb3IoO2Q8Yjspe2lmKGVbZl09YS5jaGFyQ29kZUF0KGQpLCsrZiwrK2QsZj09dGhpcy5jKXtBYih0aGlzLGUpO2Y9MDticmVha319ZWxzZSBmb3IoO2Q8YjspaWYoZVtmXT1hW2RdLCsrZiwrK2QsZj09dGhpcy5jKXtBYih0aGlzLGUpO2Y9MDticmVha319dGhpcy5qPWY7dGhpcy5BKz1ifX07ClYucHJvdG90eXBlLmRpZ2VzdD1mdW5jdGlvbigpe3ZhciBhPVtdLGI9OCp0aGlzLkE7NTY+dGhpcy5qP3RoaXMudXBkYXRlKHRoaXMudyw1Ni10aGlzLmopOnRoaXMudXBkYXRlKHRoaXMudyx0aGlzLmMtKHRoaXMuai01NikpO2Zvcih2YXIgYz10aGlzLmMtMTs1Njw9YztjLS0pdGhpcy5DW2NdPWImMjU1LGIvPTI1NjtBYih0aGlzLHRoaXMuQyk7Zm9yKGM9Yj0wOzU+YztjKyspZm9yKHZhciBkPTI0OzA8PWQ7ZC09OClhW2JdPXRoaXMuYltjXT4+ZCYyNTUsKytiO3JldHVybiBhfTt2YXIgQmI9ZnVuY3Rpb24oKXt0aGlzLkc9bmV3IFZ9O0JiLnByb3RvdHlwZS5yZXNldD1mdW5jdGlvbigpe3RoaXMuRy5yZXNldCgpfTt2YXIgQ2I9bi5jcnlwdG8sRGI9ITEsRWI9MCxGYj0wLEdiPTEsSGI9MCxJYj0iIixKYj1mdW5jdGlvbihhKXthPWF8fG4uZXZlbnQ7dmFyIGI9YS5zY3JlZW5YK2EuY2xpZW50WDw8MTYsYj1iKyhhLnNjcmVlblkrYS5jbGllbnRZKSxiPShuZXcgRGF0ZSkuZ2V0VGltZSgpJTFFNipiO0diPUdiKmIlSGI7MDxFYiYmKytGYj09RWImJkYoIm1vdXNlbW92ZSIsSmIsInJlbW92ZSIsImRlIil9LEtiPWZ1bmN0aW9uKGEpe3ZhciBiPW5ldyBCYjthPXVuZXNjYXBlKGVuY29kZVVSSUNvbXBvbmVudChhKSk7Zm9yKHZhciBjPVtdLGQ9MCxlPWEubGVuZ3RoO2Q8ZTsrK2QpYy5wdXNoKGEuY2hhckNvZGVBdChkKSk7Yi5HLnVwZGF0ZShjKTtiPWIuRy5kaWdlc3QoKTthPSIiO2ZvcihjPTA7YzxiLmxlbmd0aDtjKyspYSs9IjAxMjM0NTY3ODlBQkNERUYiLmNoYXJBdChNYXRoLmZsb29yKGJbY10vMTYpKSsiMDEyMzQ1Njc4OUFCQ0RFRiIuY2hhckF0KGJbY10lMTYpO3JldHVybiBhfSxEYj0hIUNiJiYKImZ1bmN0aW9uIj09dHlwZW9mIENiLmdldFJhbmRvbVZhbHVlcztEYnx8KEhiPTFFNiooc2NyZWVuLndpZHRoKnNjcmVlbi53aWR0aCtzY3JlZW4uaGVpZ2h0KSxJYj1LYihwLmNvb2tpZSsifCIrcC5sb2NhdGlvbisifCIrKG5ldyBEYXRlKS5nZXRUaW1lKCkrInwiK01hdGgucmFuZG9tKCkpLEViPVQoInJhbmRvbS9tYXhPYnNlcnZlTW91c2Vtb3ZlIil8fDAsMCE9RWImJkYoIm1vdXNlbW92ZSIsSmIsImFkZCIsImF0IikpO3ZhciBMYj1mdW5jdGlvbigpe3ZhciBhPUdiLGE9YStwYXJzZUludChJYi5zdWJzdHIoMCwyMCksMTYpO0liPUtiKEliKTtyZXR1cm4gYS8oSGIrTWF0aC5wb3coMTYsMjApKX0sTWI9ZnVuY3Rpb24oKXt2YXIgYT1uZXcgbi5VaW50MzJBcnJheSgxKTtDYi5nZXRSYW5kb21WYWx1ZXMoYSk7cmV0dXJuIE51bWJlcigiMC4iK2FbMF0pfTt2YXIgTmI9ZnVuY3Rpb24oKXt2YXIgYT1ILm9ubDtpZighYSl7YT13KCk7SC5vbmw9YTt2YXIgYj13KCk7YS5lPWZ1bmN0aW9uKGEpe3ZhciBkPWJbYV07ZCYmKGRlbGV0ZSBiW2FdLGQoKSl9O2EuYT1mdW5jdGlvbihhLGQpe2JbYV09ZH07YS5yPWZ1bmN0aW9uKGEpe2RlbGV0ZSBiW2FdfX1yZXR1cm4gYX0sT2I9ZnVuY3Rpb24oYSxiKXt2YXIgYz1iLm9ubG9hZDtyZXR1cm4iZnVuY3Rpb24iPT09dHlwZW9mIGM/KE5iKCkuYShhLGMpLGMpOm51bGx9LFBiPWZ1bmN0aW9uKGEpe0MoL15cdyskLy50ZXN0KGEpLCJVbnN1cHBvcnRlZCBpZCAtICIrYSk7TmIoKTtyZXR1cm4nb25sb2FkPSJ3aW5kb3cuX19fanNsLm9ubC5lKCYjMzQ7JythKycmIzM0OykiJ30sUWI9ZnVuY3Rpb24oYSl7TmIoKS5yKGEpfTt2YXIgUmI9e2FsbG93dHJhbnNwYXJlbmN5OiJ0cnVlIixmcmFtZWJvcmRlcjoiMCIsaHNwYWNlOiIwIixtYXJnaW5oZWlnaHQ6IjAiLG1hcmdpbndpZHRoOiIwIixzY3JvbGxpbmc6Im5vIixzdHlsZToiIix0YWJpbmRleDoiMCIsdnNwYWNlOiIwIix3aWR0aDoiMTAwJSJ9LFNiPXthbGxvd3RyYW5zcGFyZW5jeTohMCxvbmxvYWQ6ITB9LFRiPTAsVWI9ZnVuY3Rpb24oYSl7QyghYXx8dmEudGVzdChhKSwiSWxsZWdhbCB1cmwgZm9yIG5ldyBpZnJhbWUgLSAiK2EpfSxWYj1mdW5jdGlvbihhLGIsYyxkLGUpe1ViKGMuc3JjKTt2YXIgZixnPU9iKGQsYyksaz1nP1BiKGQpOiIiO3RyeXtkb2N1bWVudC5hbGwmJihmPWEuY3JlYXRlRWxlbWVudCgnPGlmcmFtZSBmcmFtZWJvcmRlcj0iJyttYShTdHJpbmcoYy5mcmFtZWJvcmRlcikpKyciIHNjcm9sbGluZz0iJyttYShTdHJpbmcoYy5zY3JvbGxpbmcpKSsnIiAnK2srJyBuYW1lPSInK21hKFN0cmluZyhjLm5hbWUpKSsnIi8+JykpfWNhdGNoKGgpe31maW5hbGx5e2Z8fAooZj1hLmNyZWF0ZUVsZW1lbnQoImlmcmFtZSIpLGcmJihmLm9ubG9hZD1mdW5jdGlvbigpe2Yub25sb2FkPW51bGw7Zy5jYWxsKHRoaXMpfSxRYihkKSkpfWZvcih2YXIgcSBpbiBjKWE9Y1txXSwic3R5bGUiPT09cSYmIm9iamVjdCI9PT10eXBlb2YgYT9CKGEsZi5zdHlsZSk6U2JbcV18fGYuc2V0QXR0cmlidXRlKHEsU3RyaW5nKGEpKTsocT1lJiZlLmJlZm9yZU5vZGV8fG51bGwpfHxlJiZlLmRvbnRjbGVhcnx8QWEoYik7Yi5pbnNlcnRCZWZvcmUoZixxKTtmPXE/cS5wcmV2aW91c1NpYmxpbmc6Yi5sYXN0Q2hpbGQ7Yy5hbGxvd3RyYW5zcGFyZW5jeSYmKGYuYWxsb3dUcmFuc3BhcmVuY3k9ITApO3JldHVybiBmfTt2YXIgV2I9L146W1x3XSskLyxYYj0vOihbYS16QS1aX10rKTovZyxZYj1mdW5jdGlvbigpe3ZhciBhPXhiKCl8fCIwIixiPXliKCksYztjPXhiKHZvaWQgMCl8fGE7dmFyIGQ9eWIodm9pZCAwKSxlPSIiO2MmJihlKz0idS8iK2MrIi8iKTtkJiYoZSs9ImIvIitkKyIvIik7Yz1lfHxudWxsOyhlPShkPSExPT09VCgiaXNMb2dnZWRJbiIpKT8iXy9pbS8iOiIiKSYmKGM9IiIpO3ZhciBmPVQoImlmcmFtZXMvOnNvY2lhbGhvc3Q6IiksZz1UKCJpZnJhbWVzLzppbV9zb2NpYWxob3N0OiIpO3JldHVybiB1Yj17c29jaWFsaG9zdDpmLGN0eF9zb2NpYWxob3N0OmQ/ZzpmLHNlc3Npb25faW5kZXg6YSxzZXNzaW9uX2RlbGVnYXRlOmIsc2Vzc2lvbl9wcmVmaXg6YyxpbV9wcmVmaXg6ZX19LFpiPWZ1bmN0aW9uKGEsYil7cmV0dXJuIFliKClbYl18fCIifSwkYj1mdW5jdGlvbihhKXtyZXR1cm4gZnVuY3Rpb24oYixjKXtyZXR1cm4gYT9ZYigpW2NdfHxhW2NdfHwiIjpZYigpW2NdfHwiIn19O3ZhciBhYz17IlxiIjoiXFxiIiwiXHQiOiJcXHQiLCJcbiI6IlxcbiIsIlxmIjoiXFxmIiwiXHIiOiJcXHIiLCciJzonXFwiJywiXFwiOiJcXFxcIn0sYmM9ZnVuY3Rpb24oYSl7dmFyIGIsYyxkO2I9L1tcIlxcXHgwMC1ceDFmXHg3Zi1ceDlmXS9nO2lmKHZvaWQgMCE9PWEpe3N3aXRjaCh0eXBlb2YgYSl7Y2FzZSAic3RyaW5nIjpyZXR1cm4gYi50ZXN0KGEpPyciJythLnJlcGxhY2UoYixmdW5jdGlvbihhKXt2YXIgYj1hY1thXTtpZihiKXJldHVybiBiO2I9YS5jaGFyQ29kZUF0KCk7cmV0dXJuIlxcdTAwIitNYXRoLmZsb29yKGIvMTYpLnRvU3RyaW5nKDE2KSsoYiUxNikudG9TdHJpbmcoMTYpfSkrJyInOiciJythKyciJztjYXNlICJudW1iZXIiOnJldHVybiBpc0Zpbml0ZShhKT9TdHJpbmcoYSk6Im51bGwiO2Nhc2UgImJvb2xlYW4iOmNhc2UgIm51bGwiOnJldHVybiBTdHJpbmcoYSk7Y2FzZSAib2JqZWN0IjppZighYSlyZXR1cm4ibnVsbCI7Yj1bXTtpZigibnVtYmVyIj09PQp0eXBlb2YgYS5sZW5ndGgmJiFhLnByb3BlcnR5SXNFbnVtZXJhYmxlKCJsZW5ndGgiKSl7ZD1hLmxlbmd0aDtmb3IoYz0wO2M8ZDtjKz0xKWIucHVzaChiYyhhW2NdKXx8Im51bGwiKTtyZXR1cm4iWyIrYi5qb2luKCIsIikrIl0ifWZvcihjIGluIGEpIS9fX18kLy50ZXN0KGMpJiZ4KGEsYykmJiJzdHJpbmciPT09dHlwZW9mIGMmJihkPWJjKGFbY10pKSYmYi5wdXNoKGJjKGMpKyI6IitkKTtyZXR1cm4ieyIrYi5qb2luKCIsIikrIn0ifXJldHVybiIifX0sY2M9ZnVuY3Rpb24oYSl7aWYoIWEpcmV0dXJuITE7aWYoL15bXF0sOnt9XHNdKiQvLnRlc3QoYS5yZXBsYWNlKC9cXFsiXFxcL2ItdV0vZywiQCIpLnJlcGxhY2UoLyJbXiJcXFxuXHJdKiJ8dHJ1ZXxmYWxzZXxudWxsfC0/XGQrKD86XC5cZCopPyg/OltlRV1bK1wtXT9cZCspPy9nLCJdIikucmVwbGFjZSgvKD86Xnw6fCwpKD86XHMqXFspKy9nLCIiKSkpdHJ5e3JldHVybiBldmFsKCIoIithKyIpIil9Y2F0Y2goYil7fXJldHVybiExfSwKZGM9ITE7dHJ5e2RjPSEhd2luZG93LkpTT04mJidbImEiXSc9PT13aW5kb3cuSlNPTi5zdHJpbmdpZnkoWyJhIl0pJiYiYSI9PT13aW5kb3cuSlNPTi5wYXJzZSgnWyJhIl0nKVswXX1jYXRjaChlYyl7fXZhciBmYz1mdW5jdGlvbihhKXt0cnl7cmV0dXJuIHdpbmRvdy5KU09OLnBhcnNlKGEpfWNhdGNoKGIpe3JldHVybiExfX0sZ2M9ZGM/d2luZG93LkpTT04uc3RyaW5naWZ5OmJjLGhjPWRjP2ZjOmNjO3ZhciBpYz1mdW5jdGlvbihhKXt2YXIgYjthLm1hdGNoKC9eaHR0cHM/JTNBL2kpJiYoYj1kZWNvZGVVUklDb21wb25lbnQoYSkpO3JldHVybiB1YShkb2N1bWVudCxiP2I6YSl9LGpjPWZ1bmN0aW9uKGEpe2E9YXx8ImNhbm9uaWNhbCI7Zm9yKHZhciBiPWRvY3VtZW50LmdldEVsZW1lbnRzQnlUYWdOYW1lKCJsaW5rIiksYz0wLGQ9Yi5sZW5ndGg7YzxkO2MrKyl7dmFyIGU9YltjXSxmPWUuZ2V0QXR0cmlidXRlKCJyZWwiKTtpZihmJiZmLnRvTG93ZXJDYXNlKCk9PWEmJihlPWUuZ2V0QXR0cmlidXRlKCJocmVmIikpJiYoZT1pYyhlKSkmJm51bGwhPWUubWF0Y2goL15odHRwcz86XC9cL1tcd1wtXF9cLl0rL2kpKXJldHVybiBlfXJldHVybiB3aW5kb3cubG9jYXRpb24uaHJlZn07dmFyIGtjPXtzZToiMCJ9LGxjPXtwb3N0OiEwfSxtYz17c3R5bGU6InBvc2l0aW9uOmFic29sdXRlO3RvcDotMTAwMDBweDt3aWR0aDo0NTBweDttYXJnaW46MHB4O2JvcmRlci1zdHlsZTpub25lIn0sbmM9Im9uUGx1c09uZSBfcmVhZHkgX2Nsb3NlIF9vcGVuIF9yZXNpemVNZSBfcmVuZGVyc3RhcnQgb25jaXJjbGVkIGRyZWZyZXNoIGVyZWZyZXNoIi5zcGxpdCgiICIpLG9jPXYoSCwiV0kiLHcoKSkscGM9ZnVuY3Rpb24oYSxiLGMpe3ZhciBkLGU7ZD17fTt2YXIgZj1lPWE7InBsdXMiPT1hJiZiLmFjdGlvbiYmKGU9YSsiXyIrYi5hY3Rpb24sZj1hKyIvIitiLmFjdGlvbik7KGU9VCgiaWZyYW1lcy8iK2UrIi91cmwiKSl8fChlPSI6aW1fc29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4OjppbV9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyLyIrZisiP3VzZWdhcGk9MSIpO2Zvcih2YXIgZyBpbiBrYylkW2ddPWcrIi8iKyhiW2ddfHxrY1tnXSkrIi8iO2Q9dWEocCxlLnJlcGxhY2UoWGIsCiRiKGQpKSk7Zz0iaWZyYW1lcy8iK2ErIi9wYXJhbXMvIjtmPXt9O0IoYixmKTsoZT1UKCJsYW5nIil8fFQoImd3aWRnZXQvbGFuZyIpKSYmKGYuaGw9ZSk7bGNbYV18fChmLm9yaWdpbj13aW5kb3cubG9jYXRpb24ub3JpZ2lufHx3aW5kb3cubG9jYXRpb24ucHJvdG9jb2wrIi8vIit3aW5kb3cubG9jYXRpb24uaG9zdCk7Zi5leHA9VChnKyJleHAiKTtpZihnPVQoZysibG9jYXRpb24iKSlmb3IoZT0wO2U8Zy5sZW5ndGg7ZSsrKXt2YXIgaz1nW2VdO2Zba109bi5sb2NhdGlvbltrXX1zd2l0Y2goYSl7Y2FzZSAicGx1cyI6Y2FzZSAiZm9sbG93IjpnPWYuaHJlZjtlPWIuYWN0aW9uP3ZvaWQgMDoicHVibGlzaGVyIjtnPShnPSJzdHJpbmciPT10eXBlb2YgZz9nOnZvaWQgMCk/aWMoZyk6amMoZSk7Zi51cmw9ZztkZWxldGUgZi5ocmVmO2JyZWFrO2Nhc2UgInBsdXNvbmUiOmc9KGc9Yi5ocmVmKT9pYyhnKTpqYygpO2YudXJsPWc7Zz1iLmRiO2U9VCgpO251bGw9PWcmJmUmJihnPWUuZGIsCm51bGw9PWcmJihnPWUuZ3dpZGdldCYmZS5nd2lkZ2V0LmRiKSk7Zi5kYj1nfHx2b2lkIDA7Zz1iLmVjcDtlPVQoKTtudWxsPT1nJiZlJiYoZz1lLmVjcCxudWxsPT1nJiYoZz1lLmd3aWRnZXQmJmUuZ3dpZGdldC5lY3ApKTtmLmVjcD1nfHx2b2lkIDA7ZGVsZXRlIGYuaHJlZjticmVhaztjYXNlICJzaWduaW4iOmYudXJsPWpjKCl9SC5JTEkmJihmLmlsb2FkZXI9IjEiKTtkZWxldGUgZlsiZGF0YS1vbmxvYWQiXTtkZWxldGUgZi5yZDtmb3IodmFyIGggaW4ga2MpZltoXSYmZGVsZXRlIGZbaF07Zi5nc3JjPVQoImlmcmFtZXMvOnNvdXJjZToiKTtoPVQoImlubGluZS9jc3MiKTsidW5kZWZpbmVkIiE9PXR5cGVvZiBoJiYwPGMmJmg+PWMmJihmLmljPSIxIik7aD0vXiN8XmZyLS87Yz17fTtmb3IodmFyIHEgaW4gZil4KGYscSkmJmgudGVzdChxKSYmKGNbcS5yZXBsYWNlKGgsIiIpXT1mW3FdLGRlbGV0ZSBmW3FdKTtxPSJxIj09VCgiaWZyYW1lcy8iK2ErIi9wYXJhbXMvc2kiKT9mOgpjO2g9bWIoKTtmb3IodmFyIGwgaW4gaCkheChoLGwpfHx4KGYsbCl8fHgoYyxsKXx8KHFbbF09aFtsXSk7bD1bXS5jb25jYXQobmMpOyhxPVQoImlmcmFtZXMvIithKyIvbWV0aG9kcyIpKSYmIm9iamVjdCI9PT10eXBlb2YgcSYmZWEudGVzdChxLnB1c2gpJiYobD1sLmNvbmNhdChxKSk7Zm9yKHZhciBtIGluIGIpeChiLG0pJiYvXm9uLy50ZXN0KG0pJiYoInBsdXMiIT1hfHwib25jb25uZWN0IiE9bSkmJihsLnB1c2gobSksZGVsZXRlIGZbbV0pO2RlbGV0ZSBmLmNhbGxiYWNrO2MuX21ldGhvZHM9bC5qb2luKCIsIik7cmV0dXJuIHRhKGQsZixjKX0scWM9WyJzdHlsZSIsImRhdGEtZ2FwaXNjYW4iXSxzYz1mdW5jdGlvbihhKXtmb3IodmFyIGI9dygpLGM9MCE9YS5ub2RlTmFtZS50b0xvd2VyQ2FzZSgpLmluZGV4T2YoImc6IiksZD0wLGU9YS5hdHRyaWJ1dGVzLmxlbmd0aDtkPGU7ZCsrKXt2YXIgZj1hLmF0dHJpYnV0ZXNbZF0sZz1mLm5hbWUsaz1mLnZhbHVlOzA8PWZhLmNhbGwocWMsCmcpfHxjJiYwIT1nLmluZGV4T2YoImRhdGEtIil8fCJudWxsIj09PWt8fCJzcGVjaWZpZWQiaW4gZiYmIWYuc3BlY2lmaWVkfHwoYyYmKGc9Zy5zdWJzdHIoNSkpLGJbZy50b0xvd2VyQ2FzZSgpXT1rKX1hPWEuc3R5bGU7KGM9cmMoYSYmYS5oZWlnaHQpKSYmKGIuaGVpZ2h0PVN0cmluZyhjKSk7KGE9cmMoYSYmYS53aWR0aCkpJiYoYi53aWR0aD1TdHJpbmcoYSkpO3JldHVybiBifSxyYz1mdW5jdGlvbihhKXt2YXIgYj12b2lkIDA7Im51bWJlciI9PT10eXBlb2YgYT9iPWE6InN0cmluZyI9PT10eXBlb2YgYSYmKGI9cGFyc2VJbnQoYSwxMCkpO3JldHVybiBifSx1Yz1mdW5jdGlvbigpe3ZhciBhPUguZHJ3O3NiKGZ1bmN0aW9uKGIpe2lmKGEhPT1iLmlkJiY0IT1iLnN0YXRlJiYic2hhcmUiIT1iLnR5cGUpe3ZhciBjPWIuaWQsZD1iLnR5cGUsZT1iLnVybDtiPWIudXNlclBhcmFtczt2YXIgZj1wLmdldEVsZW1lbnRCeUlkKGMpO2lmKGYpe3ZhciBnPXBjKGQsYiwwKTtnPyhmPWYucGFyZW50Tm9kZSwKZS5yZXBsYWNlKC9cIy4qLywiIikucmVwbGFjZSgvKFw/fCYpaWM9MS8sIiIpIT09Zy5yZXBsYWNlKC9cIy4qLywiIikucmVwbGFjZSgvKFw/fCYpaWM9MS8sIiIpJiYoYi5kb250Y2xlYXI9ITAsYi5yZD0hMCxiLnJpPSEwLGIudHlwZT1kLHRjKGYsYiksKGQ9VVtmLmxhc3RDaGlsZC5pZF0pJiYoZC5vaWQ9YyksdGIoYyw0KSkpOmRlbGV0ZSBVW2NdfWVsc2UgZGVsZXRlIFVbY119fSl9O3ZhciBXLFgsWSx2Yyx3Yyx4Yz0vKD86XnxccylnLSgoXFMpKikoPzokfFxzKS8seWM9e3BsdXNvbmU6ITAsYXV0b2NvbXBsZXRlOiEwLHByb2ZpbGU6ITAsc2lnbmluOiEwLHNpZ25pbjI6ITB9O1c9dihILCJTVyIsdygpKTtYPXYoSCwiU0EiLHcoKSk7WT12KEgsIlNNIix3KCkpO3ZjPXYoSCwiRlciLFtdKTt3Yz1udWxsOwp2YXIgQWM9ZnVuY3Rpb24oYSxiKXt6Yyh2b2lkIDAsITEsYSxiKX0semM9ZnVuY3Rpb24oYSxiLGMsZCl7SygicHMwIiwhMCk7Yz0oInN0cmluZyI9PT10eXBlb2YgYz9kb2N1bWVudC5nZXRFbGVtZW50QnlJZChjKTpjKXx8cDt2YXIgZTtlPXAuZG9jdW1lbnRNb2RlO2lmKGMucXVlcnlTZWxlY3RvckFsbCYmKCFlfHw4PGUpKXtlPWQ/W2RdOnooVykuY29uY2F0KHooWCkpLmNvbmNhdCh6KFkpKTtmb3IodmFyIGY9W10sZz0wO2c8ZS5sZW5ndGg7ZysrKXt2YXIgaz1lW2ddO2YucHVzaCgiLmctIitrLCJnXFw6IitrKX1lPWMucXVlcnlTZWxlY3RvckFsbChmLmpvaW4oIiwiKSl9ZWxzZSBlPWMuZ2V0RWxlbWVudHNCeVRhZ05hbWUoIioiKTtjPXcoKTtmb3IoZj0wO2Y8ZS5sZW5ndGg7ZisrKXtnPWVbZl07dmFyIGg9ZyxrPWQscT1oLm5vZGVOYW1lLnRvTG93ZXJDYXNlKCksbD12b2lkIDA7aC5nZXRBdHRyaWJ1dGUoImRhdGEtZ2FwaXNjYW4iKT9rPW51bGw6KDA9PXEuaW5kZXhPZigiZzoiKT8KbD1xLnN1YnN0cigyKTooaD0oaD1TdHJpbmcoaC5jbGFzc05hbWV8fGguZ2V0QXR0cmlidXRlKCJjbGFzcyIpKSkmJnhjLmV4ZWMoaCkpJiYobD1oWzFdKSxrPSFsfHwhKFdbbF18fFhbbF18fFlbbF0pfHxrJiZsIT09az9udWxsOmwpO2smJih5Y1trXXx8MD09Zy5ub2RlTmFtZS50b0xvd2VyQ2FzZSgpLmluZGV4T2YoImc6Iil8fDAhPXooc2MoZykpLmxlbmd0aCkmJihnLnNldEF0dHJpYnV0ZSgiZGF0YS1nYXBpc2NhbiIsITApLHYoYyxrLFtdKS5wdXNoKGcpKX1pZihiKWZvcih2YXIgbSBpbiBjKWZvcihiPWNbbV0sZD0wO2Q8Yi5sZW5ndGg7ZCsrKWJbZF0uc2V0QXR0cmlidXRlKCJkYXRhLW9ubG9hZCIsITApO2Zvcih2YXIgdCBpbiBjKXZjLnB1c2godCk7SygicHMxIiwhMCk7aWYoKG09dmMuam9pbigiOiIpKXx8YSl0cnl7RC5sb2FkKG0sYSl9Y2F0Y2goQSl7cGIoQSk7cmV0dXJufWlmKEJjKHdjfHx7fSkpZm9yKHZhciByIGluIGMpe2E9Y1tyXTt0PTA7Zm9yKGI9YS5sZW5ndGg7dDwKYjt0KyspYVt0XS5yZW1vdmVBdHRyaWJ1dGUoImRhdGEtZ2FwaXNjYW4iKTtDYyhyKX1lbHNle2Q9W107Zm9yKHIgaW4gYylmb3IoYT1jW3JdLHQ9MCxiPWEubGVuZ3RoO3Q8Yjt0KyspZT1hW3RdLERjKHIsZSxzYyhlKSxkLGIpO0VjKG0sZCl9fSxGYz1mdW5jdGlvbihhKXt2YXIgYj12KEQsYSx7fSk7Yi5nb3x8KGIuZ289ZnVuY3Rpb24oYil7cmV0dXJuIEFjKGIsYSl9LGIucmVuZGVyPWZ1bmN0aW9uKGIsZCl7dmFyIGU9ZHx8e307ZS50eXBlPWE7cmV0dXJuIHRjKGIsZSl9KX0sR2M9ZnVuY3Rpb24oYSl7V1thXT0hMH0sSGM9ZnVuY3Rpb24oYSl7WFthXT0hMH0sSWM9ZnVuY3Rpb24oYSl7WVthXT0hMH07dmFyIENjPWZ1bmN0aW9uKGEsYil7dmFyIGM9RGEoYSk7YiYmYz8oYyhiKSwoYz1iLmlmcmFtZU5vZGUpJiZjLnNldEF0dHJpYnV0ZSgiZGF0YS1nYXBpYXR0YWNoZWQiLCEwKSk6RC5sb2FkKGEsZnVuY3Rpb24oKXt2YXIgYz1EYShhKSxlPWImJmIuaWZyYW1lTm9kZSxmPWImJmIudXNlclBhcmFtcztlJiZjPyhjKGIpLGUuc2V0QXR0cmlidXRlKCJkYXRhLWdhcGlhdHRhY2hlZCIsITApKTooYz1EW2FdLmdvLCJzaWduaW4yIj09YT9jKGUsZik6YyhlJiZlLnBhcmVudE5vZGUsZikpfSl9LEJjPWZ1bmN0aW9uKCl7cmV0dXJuITF9LEVjPWZ1bmN0aW9uKCl7fSxEYz1mdW5jdGlvbihhLGIsYyxkLGUsZixnKXtzd2l0Y2goSmMoYixhLGYpKXtjYXNlIDA6YT1ZW2FdP2ErIl9hbm5vdGF0aW9uIjphO2Q9e307ZC5pZnJhbWVOb2RlPWI7ZC51c2VyUGFyYW1zPWM7Q2MoYSxkKTticmVhaztjYXNlIDE6dmFyIGs7aWYoYi5wYXJlbnROb2RlKXtmb3IodmFyIGggaW4gYyl7aWYoZj14KGMsaCkpZj0KY1toXSxmPSEhZiYmIm9iamVjdCI9PT10eXBlb2YgZiYmKCFmLnRvU3RyaW5nfHxmLnRvU3RyaW5nPT09T2JqZWN0LnByb3RvdHlwZS50b1N0cmluZ3x8Zi50b1N0cmluZz09PUFycmF5LnByb3RvdHlwZS50b1N0cmluZyk7aWYoZil0cnl7Y1toXT1nYyhjW2hdKX1jYXRjaChxKXtkZWxldGUgY1toXX19Zj0hMDtjLmRvbnRjbGVhciYmKGY9ITEpO2RlbGV0ZSBjLmRvbnRjbGVhcjtyYigpO2g9cGMoYSxjLGUpO2U9Z3x8e307ZS5hbGxvd1Bvc3Q9MTtlLmF0dHJpYnV0ZXM9bWM7ZS5kb250Y2xlYXI9IWY7Zz17fTtnLnVzZXJQYXJhbXM9YztnLnVybD1oO2cudHlwZT1hO3ZhciBsO2MucmQ/bD1iOihsPWRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoImRpdiIpLGIuc2V0QXR0cmlidXRlKCJkYXRhLWdhcGlzdHViIiwhMCksbC5zdHlsZS5jc3NUZXh0PSJwb3NpdGlvbjphYnNvbHV0ZTt3aWR0aDo0NTBweDtsZWZ0Oi0xMDAwMHB4OyIsYi5wYXJlbnROb2RlLmluc2VydEJlZm9yZShsLGIpKTtnLnNpdGVFbGVtZW50PQpsO2wuaWR8fChiPWwsdihvYyxhLDApLGY9Il9fXyIrYSsiXyIrb2NbYV0rKyxiLmlkPWYpO2I9dygpO2JbIj50eXBlIl09YTtCKGMsYik7Zj1oO2M9bDtoPWV8fHt9O2I9aC5hdHRyaWJ1dGVzfHx7fTtDKCFoLmFsbG93UG9zdHx8IWIub25sb2FkLCJvbmxvYWQgaXMgbm90IHN1cHBvcnRlZCBieSBwb3N0IGlmcmFtZSIpO2U9Yj1mO1diLnRlc3QoYikmJihlPVQoImlmcmFtZXMvIitlLnN1YnN0cmluZygxKSsiL3VybCIpLEMoISFlLCJVbmtub3duIGlmcmFtZSB1cmwgY29uZmlnIGZvciAtICIrYikpO2Y9dWEocCxlLnJlcGxhY2UoWGIsWmIpKTtiPWMub3duZXJEb2N1bWVudHx8cDtsPTA7ZG8gZT1oLmlkfHxbIkkiLFRiKyssIl8iLChuZXcgRGF0ZSkuZ2V0VGltZSgpXS5qb2luKCIiKTt3aGlsZShiLmdldEVsZW1lbnRCeUlkKGUpJiY1PisrbCk7Qyg1PmwsIkVycm9yIGNyZWF0aW5nIGlmcmFtZSBpZCIpO2w9e307dmFyIG09e307Yi5kb2N1bWVudE1vZGUmJjk+Yi5kb2N1bWVudE1vZGUmJgoobC5ob3N0aWVtb2RlPWIuZG9jdW1lbnRNb2RlKTtCKGgucXVlcnlQYXJhbXN8fHt9LGwpO0IoaC5mcmFnbWVudFBhcmFtc3x8e30sbSk7dmFyIHQ9aC5jb25uZWN0V2l0aFF1ZXJ5UGFyYW1zP2w6bSxBPWgucGZuYW1lLHI9dygpO3IuaWQ9ZTtyLnBhcmVudD1iLmxvY2F0aW9uLnByb3RvY29sKyIvLyIrYi5sb2NhdGlvbi5ob3N0O3ZhciB5PUUoYi5sb2NhdGlvbi5ocmVmLCJwYXJlbnQiKSxBPUF8fCIiOyFBJiZ5JiYoeT1FKGIubG9jYXRpb24uaHJlZiwiaWQiLCIiKSxBPUUoYi5sb2NhdGlvbi5ocmVmLCJwZm5hbWUiLCIiKSxBPXk/QSsiLyIreToiIik7ci5wZm5hbWU9QTtCKHIsdCk7KHI9RShmLCJycGN0b2tlbiIpfHxsLnJwY3Rva2VufHxtLnJwY3Rva2VuKXx8KHI9dC5ycGN0b2tlbj1oLnJwY3Rva2VufHxTdHJpbmcoTWF0aC5yb3VuZCgxRTgqKERiP01iKCk6TGIoKSkpKSk7aC5ycGN0b2tlbj1yO3I9Yi5sb2NhdGlvbi5ocmVmO3Q9dygpOyh5PUUociwiX2JzaCIsSC5ic2gpKSYmCih0Ll9ic2g9eSk7KHI9SShyKSkmJih0LmpzaD1yKTtoLmhpbnRJbkZyYWdtZW50P0IodCxtKTpCKHQsbCk7Zj10YShmLGwsbSxoLnBhcmFtc1NlcmlhbGl6ZXIpO209dygpO0IoUmIsbSk7QihoLmF0dHJpYnV0ZXMsbSk7bS5uYW1lPW0uaWQ9ZTttLnNyYz1mO2guZXVybD1mO2lmKChofHx7fSkuYWxsb3dQb3N0JiYyRTM8Zi5sZW5ndGgpe2w9cWEoZik7bS5zcmM9IiI7bVsiZGF0YS1wb3N0b3JpZ2luIl09ZjtmPVZiKGIsYyxtLGUpOy0xIT1uYXZpZ2F0b3IudXNlckFnZW50LmluZGV4T2YoIldlYktpdCIpJiYoaz1mLmNvbnRlbnRXaW5kb3cuZG9jdW1lbnQsay5vcGVuKCksbT1rLmNyZWF0ZUVsZW1lbnQoImRpdiIpLHQ9e30scj1lKyJfaW5uZXIiLHQubmFtZT1yLHQuc3JjPSIiLHQuc3R5bGU9ImRpc3BsYXk6bm9uZSIsVmIoYixtLHQscixoKSk7bT0oaD1sLmxbMF0pP2guc3BsaXQoIiYiKTpbXTtoPVtdO2Zvcih0PTA7dDxtLmxlbmd0aDt0Kyspcj1tW3RdLnNwbGl0KCI9IiwyKSwKaC5wdXNoKFtkZWNvZGVVUklDb21wb25lbnQoclswXSksZGVjb2RlVVJJQ29tcG9uZW50KHJbMV0pXSk7bC5sPVtdO209cmEobCk7Qyh2YS50ZXN0KG0pLCJJbnZhbGlkIFVSTDogIittKTtsPWIuY3JlYXRlRWxlbWVudCgiZm9ybSIpO2wuYWN0aW9uPW07bC5tZXRob2Q9IlBPU1QiO2wudGFyZ2V0PWU7bC5zdHlsZS5kaXNwbGF5PSJub25lIjtmb3IoZT0wO2U8aC5sZW5ndGg7ZSsrKW09Yi5jcmVhdGVFbGVtZW50KCJpbnB1dCIpLG0udHlwZT0iaGlkZGVuIixtLm5hbWU9aFtlXVswXSxtLnZhbHVlPWhbZV1bMV0sbC5hcHBlbmRDaGlsZChtKTtjLmFwcGVuZENoaWxkKGwpO2wuc3VibWl0KCk7bC5wYXJlbnROb2RlLnJlbW92ZUNoaWxkKGwpO2smJmsuY2xvc2UoKTtrPWZ9ZWxzZSBrPVZiKGIsYyxtLGUsaCk7Zy5pZnJhbWVOb2RlPWs7Zy5pZD1rLmdldEF0dHJpYnV0ZSgiaWQiKTtrPWcuaWQ7Yz13KCk7Yy5pZD1rO2MudXNlclBhcmFtcz1nLnVzZXJQYXJhbXM7Yy51cmw9Zy51cmw7CmMudHlwZT1nLnR5cGU7Yy5zdGF0ZT0xO1Vba109YztrPWd9ZWxzZSBrPW51bGw7ayYmKChnPWsuaWQpJiZkLnB1c2goZyksQ2MoYSxrKSl9fSxKYz1mdW5jdGlvbihhLGIsYyl7aWYoYSYmMT09PWEubm9kZVR5cGUmJmIpe2lmKGMpcmV0dXJuIDE7aWYoWVtiXSl7aWYoQmFbYS5ub2RlTmFtZS50b0xvd2VyQ2FzZSgpXSlyZXR1cm4oYT1hLmlubmVySFRNTCkmJmEucmVwbGFjZSgvXltcc1x4YTBdK3xbXHNceGEwXSskL2csIiIpPzA6MX1lbHNle2lmKFhbYl0pcmV0dXJuIDA7aWYoV1tiXSlyZXR1cm4gMX19cmV0dXJuIG51bGx9LHRjPWZ1bmN0aW9uKGEsYil7dmFyIGM9Yi50eXBlO2RlbGV0ZSBiLnR5cGU7dmFyIGQ9KCJzdHJpbmciPT09dHlwZW9mIGE/ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoYSk6YSl8fHZvaWQgMDtpZihkKXt2YXIgZT17fSxmO2ZvcihmIGluIGIpeChiLGYpJiYoZVtmLnRvTG93ZXJDYXNlKCldPWJbZl0pO2UucmQ9MTsoZj0hIWUucmkpJiZkZWxldGUgZS5yaTsKdmFyIGc9W107RGMoYyxkLGUsZywwLGYsdm9pZCAwKTtFYyhjLGcpfWVsc2UgcGIoInN0cmluZyI9PT0iZ2FwaS4iK2MrIi5yZW5kZXI6IG1pc3NpbmcgZWxlbWVudCAiK3R5cGVvZiBhP2E6IiIpfTt2KEQsInBsYXRmb3JtIix7fSkuZ289QWM7dmFyIEJjPWZ1bmN0aW9uKGEpe2Zvcih2YXIgYj1bIl9jIiwianNsIiwiaCJdLGM9MDtjPGIubGVuZ3RoJiZhO2MrKylhPWFbYltjXV07Yj1JKHUuaHJlZik7cmV0dXJuIWF8fDAhPWEuaW5kZXhPZigibjsiKSYmMCE9Yi5pbmRleE9mKCJuOyIpJiZhIT09Yn0sRWM9ZnVuY3Rpb24oYSxiKXtLYyhhLGIpfSx4YT1mdW5jdGlvbihhKXt6YyhhLCEwKX0sTGM9ZnVuY3Rpb24oYSxiKXtmb3IodmFyIGM9Ynx8W10sZD0wO2Q8Yy5sZW5ndGg7KytkKWEoY1tkXSk7Zm9yKGQ9MDtkPGMubGVuZ3RoO2QrKylGYyhjW2RdKX07Ck0ucHVzaChbInBsYXRmb3JtIixmdW5jdGlvbihhLGIsYyl7d2M9YztiJiZ2Yy5wdXNoKGIpO0xjKEdjLGEpO0xjKEhjLGMuX2MuYW5ub3RhdGlvbik7TGMoSWMsYy5fYy5iaW1vZGFsKTtpYigpO2diKCk7aWYoImV4cGxpY2l0IiE9VCgicGFyc2V0YWdzIikpe0NhKGEpO25iKG1iKCkpJiYhVCgiZGlzYWJsZVJlYWx0aW1lQ2FsbGJhY2siKSYmcmIoKTt2YXIgZDtjJiYoYT1jLmNhbGxiYWNrKSYmKGQ9bmEoYSksZGVsZXRlIGMuY2FsbGJhY2spO3phKGZ1bmN0aW9uKCl7eGEoZCl9KX19XSk7RC5fcGw9ITA7dmFyIE1jPWZ1bmN0aW9uKGEpe2E9KGE9VVthXSk/YS5vaWQ6dm9pZCAwO2lmKGEpe3ZhciBiPXAuZ2V0RWxlbWVudEJ5SWQoYSk7YiYmYi5wYXJlbnROb2RlLnJlbW92ZUNoaWxkKGIpO2RlbGV0ZSBVW2FdO01jKGEpfX07dmFyIE5jPS9eXHtoXDonLyxPYz0vXiFfLyxQYz0iIixLYz1mdW5jdGlvbihhLGIpe2Z1bmN0aW9uIGMoKXtGKCJtZXNzYWdlIixkLCJyZW1vdmUiLCJkZSIpfWZ1bmN0aW9uIGQoZCl7dmFyIGc9ZC5kYXRhLGs9ZC5vcmlnaW47aWYoUWMoZyxiKSl7dmFyIGg9ZTtlPSExO2gmJksoInJxZSIpO1JjKGEsZnVuY3Rpb24oKXtoJiZLKCJycWQiKTtjKCk7Zm9yKHZhciBhPXYoSCwiUlBNUSIsW10pLGI9MDtiPGEubGVuZ3RoO2IrKylhW2JdKHtkYXRhOmcsb3JpZ2luOmt9KX0pfX1pZigwIT09Yi5sZW5ndGgpe1BjPUUodS5ocmVmLCJwZm5hbWUiLCIiKTt2YXIgZT0hMDtGKCJtZXNzYWdlIixkLCJhZGQiLCJhdCIpO1AoYSxjKX19LFFjPWZ1bmN0aW9uKGEsYil7YT1TdHJpbmcoYSk7aWYoTmMudGVzdChhKSlyZXR1cm4hMDt2YXIgYz0hMTtPYy50ZXN0KGEpJiYoYz0hMCxhPWEuc3Vic3RyKDIpKTtpZighL15cey8udGVzdChhKSlyZXR1cm4hMTt2YXIgZD1oYyhhKTtpZighZClyZXR1cm4hMTsKdmFyIGU9ZC5mO2lmKGQucyYmZSYmLTEhPWZhLmNhbGwoYixlKSl7aWYoIl9yZW5kZXJzdGFydCI9PT1kLnN8fGQucz09PVBjKyIvIitlKyI6Ol9yZW5kZXJzdGFydCIpe3ZhciBmPWQuYSYmZC5hW2M/MDoxXSxjPXAuZ2V0RWxlbWVudEJ5SWQoZSk7dGIoZSwyKTtpZihmJiZjJiZmLndpZHRoJiZmLmhlaWdodCl7YTp7ZD1jLnBhcmVudE5vZGU7ZT1mfHx7fTtpZihxYigpKXt2YXIgZz1jLmlkO2lmKGcpe2Y9KGY9VVtnXSk/Zi5zdGF0ZTp2b2lkIDA7aWYoMT09PWZ8fDQ9PT1mKWJyZWFrIGE7TWMoZyl9fShmPWQubmV4dFNpYmxpbmcpJiZmLmdldEF0dHJpYnV0ZSYmZi5nZXRBdHRyaWJ1dGUoImRhdGEtZ2FwaXN0dWIiKSYmKGQucGFyZW50Tm9kZS5yZW1vdmVDaGlsZChmKSxkLnN0eWxlLmNzc1RleHQ9IiIpO3ZhciBmPWUud2lkdGgsaz1lLmhlaWdodCxoPWQuc3R5bGU7aC50ZXh0SW5kZW50PSIwIjtoLm1hcmdpbj0iMCI7aC5wYWRkaW5nPSIwIjtoLmJhY2tncm91bmQ9InRyYW5zcGFyZW50IjsKaC5ib3JkZXJTdHlsZT0ibm9uZSI7aC5jc3NGbG9hdD0ibm9uZSI7aC5zdHlsZUZsb2F0PSJub25lIjtoLmxpbmVIZWlnaHQ9Im5vcm1hbCI7aC5mb250U2l6ZT0iMXB4IjtoLnZlcnRpY2FsQWxpZ249ImJhc2VsaW5lIjtkPWQuc3R5bGU7ZC5kaXNwbGF5PSJpbmxpbmUtYmxvY2siO2g9Yy5zdHlsZTtoLnBvc2l0aW9uPSJzdGF0aWMiO2gubGVmdD0wO2gudG9wPTA7aC52aXNpYmlsaXR5PSJ2aXNpYmxlIjtmJiYoZC53aWR0aD1oLndpZHRoPWYrInB4Iik7ayYmKGQuaGVpZ2h0PWguaGVpZ2h0PWsrInB4Iik7ZS52ZXJ0aWNhbEFsaWduJiYoZC52ZXJ0aWNhbEFsaWduPWUudmVydGljYWxBbGlnbik7ZyYmdGIoZywzKX1jWyJkYXRhLWNzaS13ZHQiXT0obmV3IERhdGUpLmdldFRpbWUoKX19cmV0dXJuITB9cmV0dXJuITF9LFJjPWZ1bmN0aW9uKGEsYil7UChhLGIpfTt2YXIgU2M9ZnVuY3Rpb24oYSxiKXt0aGlzLlA9YTt2YXIgYz1ifHx7fTt0aGlzLlo9TnVtYmVyKGMubWF4QWdlKXx8MDt0aGlzLk09Yy5kb21haW47dGhpcy5SPWMucGF0aDt0aGlzLmFhPSEhYy5zZWN1cmV9LFRjPS9eWy0rL189Ljp8JSZhLXpBLVowLTlAXSokLyxVYz0vXltBLVpfXVtBLVowLTlfXXswLDYzfSQvOwpTYy5wcm90b3R5cGUud3JpdGU9ZnVuY3Rpb24oYSxiKXtpZighVWMudGVzdCh0aGlzLlApKXRocm93IkludmFsaWQgY29va2llIG5hbWUiO2lmKCFUYy50ZXN0KGEpKXRocm93IkludmFsaWQgY29va2llIHZhbHVlIjt2YXIgYz10aGlzLlArIj0iK2E7dGhpcy5NJiYoYys9Ijtkb21haW49Iit0aGlzLk0pO3RoaXMuUiYmKGMrPSI7cGF0aD0iK3RoaXMuUik7dmFyIGQ9Im51bWJlciI9PT10eXBlb2YgYj9iOnRoaXMuWjtpZigwPD1kKXt2YXIgZT1uZXcgRGF0ZTtlLnNldFNlY29uZHMoZS5nZXRTZWNvbmRzKCkrZCk7Yys9IjtleHBpcmVzPSIrZS50b1VUQ1N0cmluZygpfXRoaXMuYWEmJihjKz0iO3NlY3VyZSIpO2RvY3VtZW50LmNvb2tpZT1jO3JldHVybiEwfTtTYy5pdGVyYXRlPWZ1bmN0aW9uKGEpe2Zvcih2YXIgYj1kb2N1bWVudC5jb29raWUuc3BsaXQoLztccyovKSxjPTA7YzxiLmxlbmd0aDsrK2Mpe3ZhciBkPWJbY10uc3BsaXQoIj0iKSxlPWQuc2hpZnQoKTthKGUsZC5qb2luKCI9IikpfX07dmFyIFZjPWZ1bmN0aW9uKGEpe3RoaXMuWT1hfSxXYz17fTtWYy5wcm90b3R5cGUud3JpdGU9ZnVuY3Rpb24oYSl7V2NbdGhpcy5ZXT1hO3JldHVybiEwfTtWYy5pdGVyYXRlPWZ1bmN0aW9uKGEpe2Zvcih2YXIgYiBpbiBXYylXYy5oYXNPd25Qcm9wZXJ0eShiKSYmYShiLFdjW2JdKX07dmFyIFhjPSJodHRwczoiPT09d2luZG93LmxvY2F0aW9uLnByb3RvY29sLFljPVhjfHwiaHR0cDoiPT09d2luZG93LmxvY2F0aW9uLnByb3RvY29sP1NjOlZjLFpjPWZ1bmN0aW9uKGEpe3ZhciBiPWEuc3Vic3RyKDEpLGM9IiIsZD13aW5kb3cubG9jYXRpb24uaG9zdG5hbWU7aWYoIiIhPT1iKXtjPXBhcnNlSW50KGIsMTApO2lmKGlzTmFOKGMpKXJldHVybiBudWxsO2I9ZC5zcGxpdCgiLiIpO2lmKGIubGVuZ3RoPGMtMSlyZXR1cm4gbnVsbDtiLmxlbmd0aD09Yy0xJiYoZD0iLiIrZCl9ZWxzZSBkPSIiO3JldHVybntnOiJTIj09YS5jaGFyQXQoMCksZG9tYWluOmQsaTpjfX0sJGM9ZnVuY3Rpb24oKXt2YXIgYSxiPW51bGw7WWMuaXRlcmF0ZShmdW5jdGlvbihjLGQpe2lmKDA9PT1jLmluZGV4T2YoIkdfQVVUSFVTRVJfIikpe3ZhciBlPVpjKGMuc3Vic3RyaW5nKDExKSk7aWYoIWF8fGUuZyYmIWEuZ3x8ZS5nPT1hLmcmJmUuaT5hLmkpYT1lLGI9ZH19KTtyZXR1cm57WDphLEI6Yn19O3ZhciBhZD1mdW5jdGlvbihhKXtpZigwIT09YS5pbmRleE9mKCJHQ1NDIikpcmV0dXJuIG51bGw7dmFyIGI9e086ITF9O2E9YS5zdWJzdHIoNCk7aWYoIWEpcmV0dXJuIGI7dmFyIGM9YS5jaGFyQXQoMCk7YT1hLnN1YnN0cigxKTt2YXIgZD1hLmxhc3RJbmRleE9mKCJfIik7aWYoLTE9PWQpcmV0dXJuIGI7dmFyIGU9WmMoYS5zdWJzdHIoZCsxKSk7aWYobnVsbD09ZSlyZXR1cm4gYjthPWEuc3Vic3RyaW5nKDAsZCk7aWYoIl8iIT09YS5jaGFyQXQoMCkpcmV0dXJuIGI7ZD0iRSI9PT1jJiZlLmc7cmV0dXJuIWQmJigiVSIhPT1jfHxlLmcpfHxkJiYhWGM/Yjp7TzohMCxnOmQsZGE6YS5zdWJzdHIoMSksZG9tYWluOmUuZG9tYWluLGk6ZS5pfX0sYmQ9ZnVuY3Rpb24oYSl7aWYoIWEpcmV0dXJuW107YT1hLnNwbGl0KCI9Iik7cmV0dXJuIGFbMV0/YVsxXS5zcGxpdCgifCIpOltdfSxjZD1mdW5jdGlvbihhKXthPWEuc3BsaXQoIjoiKTtyZXR1cm57RDphWzBdLnNwbGl0KCI9IilbMV0sY2E6YmQoYVsxXSksCmZhOmJkKGFbMl0pLGVhOmJkKGFbM10pfX0sZGQ9ZnVuY3Rpb24oKXt2YXIgYT0kYygpLGI9YS5YLGE9YS5CO2lmKG51bGwhPT1hKXt2YXIgYztZYy5pdGVyYXRlKGZ1bmN0aW9uKGEsZCl7dmFyIGU9YWQoYSk7ZSYmZS5PJiZlLmc9PWIuZyYmZS5pPT1iLmkmJihjPWQpfSk7aWYoYyl7dmFyIGQ9Y2QoYyksZT1kJiZkLmNhW051bWJlcihhKV0sZD1kJiZkLkQ7aWYoZSlyZXR1cm57QjphLGJhOmUsRDpkfX19cmV0dXJuIG51bGx9O3ZhciBaPWZ1bmN0aW9uKGEpe3RoaXMuTD1hfTtaLnByb3RvdHlwZS5vPTA7Wi5wcm90b3R5cGUuSD0yO1oucHJvdG90eXBlLkw9bnVsbDtaLnByb3RvdHlwZS5GPSExO1oucHJvdG90eXBlLlU9ZnVuY3Rpb24oKXt0aGlzLkZ8fCh0aGlzLm89MCx0aGlzLkY9ITAsdGhpcy5TKCkpfTtaLnByb3RvdHlwZS5TPWZ1bmN0aW9uKCl7dGhpcy5GJiYodGhpcy5MKCk/dGhpcy5vPXRoaXMuSDp0aGlzLm89TWF0aC5taW4oMioodGhpcy5vfHx0aGlzLkgpLDEyMCksd2luZG93LnNldFRpbWVvdXQoY2EodGhpcy5TLHRoaXMpLDFFMyp0aGlzLm8pKX07Zm9yKHZhciBlZD0wOzY0PmVkOysrZWQpO3ZhciBmZD1udWxsLHFiPWZ1bmN0aW9uKCl7cmV0dXJuIEgub2E9ITB9LHJiPWZ1bmN0aW9uKCl7SC5vYT0hMDt2YXIgYT1kZCgpOyhhPWEmJmEuQikmJmhiKCJnb29nbGVhcGlzLmNvbmZpZy9zZXNzaW9uSW5kZXgiLGEpO2ZkfHwoZmQ9dihILCJzcyIsbmV3IFooZ2QpKSk7YT1mZDthLlUmJmEuVSgpfSxnZD1mdW5jdGlvbigpe3ZhciBhPWRkKCksYj1hJiZhLmJhfHxudWxsLGM9YSYmYS5EO1AoImF1dGgiLHtjYWxsYmFjazpmdW5jdGlvbigpe3ZhciBhPW4uZ2FwaS5hdXRoLGU9e2NsaWVudF9pZDpjLHNlc3Npb25fc3RhdGU6Yn07YS5jaGVja1Nlc3Npb25TdGF0ZShlLGZ1bmN0aW9uKGIpe3ZhciBjPWUuc2Vzc2lvbl9zdGF0ZSxrPVQoImlzTG9nZ2VkSW4iKTtiPVQoImRlYnVnL2ZvcmNlSW0iKT8hMTpjJiZifHwhYyYmIWI7aWYoaz1rIT1iKWhiKCJpc0xvZ2dlZEluIixiKSxyYigpLHVjKCksYnx8KChiPWEuc2lnbk91dCk/YigpOihiPWEuc2V0VG9rZW4pJiZiKG51bGwpKTtiPQptYigpO3ZhciBoPVQoInNhdmVkVXNlclN0YXRlIiksYz1hLl9ndXNzKGIuY29va2llcG9saWN5KSxoPWghPWMmJiJ1bmRlZmluZWQiIT10eXBlb2YgaDtoYigic2F2ZWRVc2VyU3RhdGUiLGMpOyhrfHxoKSYmbmIoYikmJiFUKCJkaXNhYmxlUmVhbHRpbWVDYWxsYmFjayIpJiZhLl9waW1mKGIsITApfSl9fSk7cmV0dXJuITB9O0soImJzMCIsITAsd2luZG93LmdhcGkuX2JzKTtLKCJiczEiLCEwKTtkZWxldGUgd2luZG93LmdhcGkuX2JzO30pKCk7CmdhcGkubG9hZCgiIix7Y2FsbGJhY2s6d2luZG93WyJnYXBpX29ubG9hZCJdLF9jOnsianNsIjp7ImNpIjp7ImRldmljZVR5cGUiOiJkZXNrdG9wIiwib2F1dGgtZmxvdyI6eyJhdXRoVXJsIjoiaHR0cHM6Ly9hY2NvdW50cy5nb29nbGUuY29tL28vb2F1dGgyL2F1dGgiLCJwcm94eVVybCI6Imh0dHBzOi8vYWNjb3VudHMuZ29vZ2xlLmNvbS9vL29hdXRoMi9wb3N0bWVzc2FnZVJlbGF5IiwiZGlzYWJsZU9wdCI6dHJ1ZSwiaWRwSWZyYW1lVXJsIjoiaHR0cHM6Ly9hY2NvdW50cy5nb29nbGUuY29tL28vb2F1dGgyL2lmcmFtZSIsInVzZWdhcGkiOmZhbHNlfSwiZGVidWciOnsicmVwb3J0RXhjZXB0aW9uUmF0ZSI6MC4wNSwiZm9yY2VJbSI6ZmFsc2UsInJldGhyb3dFeGNlcHRpb24iOmZhbHNlLCJob3N0IjoiaHR0cHM6Ly9hcGlzLmdvb2dsZS5jb20ifSwibGV4cHMiOls4MSw5NywxMDAsMTIyLDEyNCw0NSwzMCw3OSwxMjddLCJlbmFibGVNdWx0aWxvZ2luIjp0cnVlLCJnb29nbGVhcGlzLmNvbmZpZyI6eyJhdXRoIjp7InVzZUZpcnN0UGFydHlBdXRoVjIiOmZhbHNlfX0sImlzUGx1c1VzZXIiOmZhbHNlLCJpbmxpbmUiOnsiY3NzIjoxfSwiZGlzYWJsZVJlYWx0aW1lQ2FsbGJhY2siOmZhbHNlLCJkcml2ZV9zaGFyZSI6eyJza2lwSW5pdENvbW1hbmQiOnRydWV9LCJjc2kiOnsicmF0ZSI6MC4wMX0sInJlcG9ydCI6eyJhcGlSYXRlIjp7ImdhcGlcXC5zaWduaW5cXC4uKiI6MC4wNSwiZ2FwaVxcLnNpZ25pbjJcXC4uKiI6MC4wNX0sImFwaXMiOlsiaWZyYW1lc1xcLi4qIiwiZ2FkZ2V0c1xcLi4qIiwiZ2FwaVxcLmFwcGNpcmNsZXBpY2tlclxcLi4qIiwiZ2FwaVxcLmF1dGhcXC4uKiIsImdhcGlcXC5jbGllbnRcXC4uKiJdLCJyYXRlIjowLjAwMSwiaG9zdCI6Imh0dHBzOi8vYXBpcy5nb29nbGUuY29tIn0sImNsaWVudCI6eyJoZWFkZXJzIjp7InJlcXVlc3QiOlsiQWNjZXB0IiwiQWNjZXB0LUxhbmd1YWdlIiwiQXV0aG9yaXphdGlvbiIsIkNhY2hlLUNvbnRyb2wiLCJDb250ZW50LURpc3Bvc2l0aW9uIiwiQ29udGVudC1FbmNvZGluZyIsIkNvbnRlbnQtTGFuZ3VhZ2UiLCJDb250ZW50LUxlbmd0aCIsIkNvbnRlbnQtTUQ1IiwiQ29udGVudC1SYW5nZSIsIkNvbnRlbnQtVHlwZSIsIkRhdGUiLCJHRGF0YS1WZXJzaW9uIiwiSG9zdCIsIklmLU1hdGNoIiwiSWYtTW9kaWZpZWQtU2luY2UiLCJJZi1Ob25lLU1hdGNoIiwiSWYtVW5tb2RpZmllZC1TaW5jZSIsIk9yaWdpbiIsIk9yaWdpblRva2VuIiwiUHJhZ21hIiwiUmFuZ2UiLCJTbHVnIiwiVHJhbnNmZXItRW5jb2RpbmciLCJYLUNsaWVudERldGFpbHMiLCJYLUdEYXRhLUNsaWVudCIsIlgtR0RhdGEtS2V5IiwiWC1Hb29nLUF1dGhVc2VyIiwiWC1Hb29nLVBhZ2VJZCIsIlgtR29vZy1FbmNvZGUtUmVzcG9uc2UtSWYtRXhlY3V0YWJsZSIsIlgtR29vZy1Db3JyZWxhdGlvbi1JZCIsIlgtR29vZy1SZXF1ZXN0LUluZm8iLCJYLUdvb2ctRXhwZXJpbWVudHMiLCJ4LWdvb2ctaWFtLWF1dGhvcml0eS1zZWxlY3RvciIsIngtZ29vZy1pYW0tYXV0aG9yaXphdGlvbi10b2tlbiIsIlgtR29vZy1TcGF0dWxhIiwiWC1Hb29nLVVwbG9hZC1Db21tYW5kIiwiWC1Hb29nLVVwbG9hZC1Db250ZW50LURpc3Bvc2l0aW9uIiwiWC1Hb29nLVVwbG9hZC1Db250ZW50LUxlbmd0aCIsIlgtR29vZy1VcGxvYWQtQ29udGVudC1UeXBlIiwiWC1Hb29nLVVwbG9hZC1GaWxlLU5hbWUiLCJYLUdvb2ctVXBsb2FkLU9mZnNldCIsIlgtR29vZy1VcGxvYWQtUHJvdG9jb2wiLCJYLUdvb2ctVmlzaXRvci1JZCIsIlgtSFRUUC1NZXRob2QtT3ZlcnJpZGUiLCJYLUphdmFTY3JpcHQtVXNlci1BZ2VudCIsIlgtUGFuLVZlcnNpb25pZCIsIlgtT3JpZ2luIiwiWC1SZWZlcmVyIiwiWC1VcGxvYWQtQ29udGVudC1MZW5ndGgiLCJYLVVwbG9hZC1Db250ZW50LVR5cGUiLCJYLVVzZS1IVFRQLVN0YXR1cy1Db2RlLU92ZXJyaWRlIiwiWC1Zb3VUdWJlLVZWVCIsIlgtWW91VHViZS1QYWdlLUNMIiwiWC1Zb3VUdWJlLVBhZ2UtVGltZXN0YW1wIl0sInJlc3BvbnNlIjpbIkNhY2hlLUNvbnRyb2wiLCJDb250ZW50LURpc3Bvc2l0aW9uIiwiQ29udGVudC1FbmNvZGluZyIsIkNvbnRlbnQtTGFuZ3VhZ2UiLCJDb250ZW50LUxlbmd0aCIsIkNvbnRlbnQtTUQ1IiwiQ29udGVudC1SYW5nZSIsIkNvbnRlbnQtVHlwZSIsIkRhdGUiLCJFVGFnIiwiRXhwaXJlcyIsIkxhc3QtTW9kaWZpZWQiLCJMb2NhdGlvbiIsIlByYWdtYSIsIlJhbmdlIiwiU2VydmVyIiwiVHJhbnNmZXItRW5jb2RpbmciLCJXV1ctQXV0aGVudGljYXRlIiwiVmFyeSIsIlVuemlwcGVkLUNvbnRlbnQtTUQ1IiwiWC1Hb29nLVNhZmV0eS1Db250ZW50LVR5cGUiLCJYLUdvb2ctU2FmZXR5LUVuY29kaW5nIiwiWC1Hb29nLVVwbG9hZC1DaHVuay1HcmFudWxhcml0eSIsIlgtR29vZy1VcGxvYWQtQ29udHJvbC1VUkwiLCJYLUdvb2ctVXBsb2FkLVNpemUtUmVjZWl2ZWQiLCJYLUdvb2ctVXBsb2FkLVN0YXR1cyIsIlgtR29vZy1VcGxvYWQtVVJMIiwiWC1Hb29nLURpZmYtRG93bmxvYWQtUmFuZ2UiLCJYLUdvb2ctSGFzaCIsIlgtR29vZy1VcGRhdGVkLUF1dGhvcml6YXRpb24iLCJYLVNlcnZlci1PYmplY3QtVmVyc2lvbiIsIlgtR3VwbG9hZGVyLUN1c3RvbWVyIiwiWC1HdXBsb2FkZXItVXBsb2FkLVJlc3VsdCIsIlgtR3VwbG9hZGVyLVVwbG9hZGlkIl19LCJybXMiOiJtaWdyYXRlZCIsImNvcnMiOmZhbHNlfSwiaXNMb2dnZWRJbiI6ZmFsc2UsInNpZ25JbkRlcHJlY2F0aW9uIjp7InJhdGUiOjAuMH0sImluY2x1ZGVfZ3JhbnRlZF9zY29wZXMiOnRydWUsImxsYW5nIjoiZW4iLCJwbHVzX2xheWVyIjp7ImlzRW5hYmxlZCI6ZmFsc2V9LCJpZnJhbWVzIjp7InlvdXR1YmUiOnsicGFyYW1zIjp7ImxvY2F0aW9uIjpbInNlYXJjaCIsImhhc2giXX0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyL3lvdXR1YmU/dXNlZ2FwaVx1MDAzZDEiLCJtZXRob2RzIjpbInNjcm9sbCIsIm9wZW53aW5kb3ciXX0sInl0c3Vic2NyaWJlIjp7InVybCI6Imh0dHBzOi8vd3d3LnlvdXR1YmUuY29tL3N1YnNjcmliZV9lbWJlZD91c2VnYXBpXHUwMDNkMSJ9LCJwbHVzX2NpcmNsZSI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6OnNlOl8vd2lkZ2V0L3BsdXMvY2lyY2xlP3VzZWdhcGlcdTAwM2QxIn0sInBsdXNfc2hhcmUiOnsicGFyYW1zIjp7InVybCI6IiJ9LCJ1cmwiOiI6c29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4OjpzZTpfLysxL3NoYXJlYnV0dG9uP3BsdXNTaGFyZVx1MDAzZHRydWVcdTAwMjZ1c2VnYXBpXHUwMDNkMSJ9LCJyYnJfcyI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6OnNlOl8vd2lkZ2V0L3JlbmRlci9yZWNvYmFyc2ltcGxlc2Nyb2xsZXIifSwidWRjX3dlYmNvbnNlbnRmbG93Ijp7InBhcmFtcyI6eyJ1cmwiOiIifSwidXJsIjoiaHR0cHM6Ly93d3cuZ29vZ2xlLmNvbS9zZXR0aW5ncy93ZWJjb25zZW50P3VzZWdhcGlcdTAwM2QxIn0sIjpzb3VyY2U6IjoiM3AiLCJibG9nZ2VyIjp7InBhcmFtcyI6eyJsb2NhdGlvbiI6WyJzZWFyY2giLCJoYXNoIl19LCJ1cmwiOiI6c29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4Ol8vd2lkZ2V0L3JlbmRlci9ibG9nZ2VyP3VzZWdhcGlcdTAwM2QxIiwibWV0aG9kcyI6WyJzY3JvbGwiLCJvcGVud2luZG93Il19LCJldndpZGdldCI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy9ldmVudHMvd2lkZ2V0P3VzZWdhcGlcdTAwM2QxIn0sIjpzb2NpYWxob3N0OiI6Imh0dHBzOi8vYXBpcy5nb29nbGUuY29tIiwic2hvcnRsaXN0cyI6eyJ1cmwiOiIifSwiaGFuZ291dCI6eyJ1cmwiOiJodHRwczovL3RhbGtnYWRnZXQuZ29vZ2xlLmNvbS86c2Vzc2lvbl9wcmVmaXg6dGFsa2dhZGdldC9fL3dpZGdldCJ9LCJwbHVzX2ZvbGxvd2VycyI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi9fL2ltL18vd2lkZ2V0L3JlbmRlci9wbHVzL2ZvbGxvd2Vycz91c2VnYXBpXHUwMDNkMSJ9LCJwb3N0Ijp7InBhcmFtcyI6eyJ1cmwiOiIifSwidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDo6aW1fcHJlZml4Ol8vd2lkZ2V0L3JlbmRlci9wb3N0P3VzZWdhcGlcdTAwM2QxIn0sInBob3RvY29tbWVudHMiOnsidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvcGhvdG9jb21tZW50cz91c2VnYXBpXHUwMDNkMSJ9LCI6Z3BsdXNfdXJsOiI6Imh0dHBzOi8vcGx1cy5nb29nbGUuY29tIiwic2lnbmluIjp7InBhcmFtcyI6eyJ1cmwiOiIifSwidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvc2lnbmluP3VzZWdhcGlcdTAwM2QxIiwibWV0aG9kcyI6WyJvbmF1dGgiXX0sInJicl9pIjp7InBhcmFtcyI6eyJ1cmwiOiIifSwidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDo6c2U6Xy93aWRnZXQvcmVuZGVyL3JlY29iYXJpbnZpdGF0aW9uIn0sInNoYXJlIjp7InVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6OmltX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvc2hhcmU/dXNlZ2FwaVx1MDAzZDEifSwicGx1c29uZSI6eyJwYXJhbXMiOnsiY291bnQiOiIiLCJzaXplIjoiIiwidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6OnNlOl8vKzEvZmFzdGJ1dHRvbj91c2VnYXBpXHUwMDNkMSJ9LCJjb21tZW50cyI6eyJwYXJhbXMiOnsibG9jYXRpb24iOlsic2VhcmNoIiwiaGFzaCJdfSwidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvY29tbWVudHM/dXNlZ2FwaVx1MDAzZDEiLCJtZXRob2RzIjpbInNjcm9sbCIsIm9wZW53aW5kb3ciXX0sIjppbV9zb2NpYWxob3N0OiI6Imh0dHBzOi8vcGx1cy5nb29nbGVhcGlzLmNvbSIsImJhY2tkcm9wIjp7InVybCI6Imh0dHBzOi8vY2xpZW50czMuZ29vZ2xlLmNvbS9jYXN0L2Nocm9tZWNhc3QvaG9tZS93aWRnZXQvYmFja2Ryb3A/dXNlZ2FwaVx1MDAzZDEifSwidmlzaWJpbGl0eSI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyL3Zpc2liaWxpdHk/dXNlZ2FwaVx1MDAzZDEifSwiYXV0b2NvbXBsZXRlIjp7InBhcmFtcyI6eyJ1cmwiOiIifSwidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvYXV0b2NvbXBsZXRlIn0sImFkZGl0bm93Ijp7InVybCI6Imh0dHBzOi8vYXBpcy5nb29nbGUuY29tL2FkZGl0bm93L2FkZGl0bm93Lmh0bWw/dXNlZ2FwaVx1MDAzZDEiLCJtZXRob2RzIjpbImxhdW5jaHVybCJdfSwiOnNpZ251cGhvc3Q6IjoiaHR0cHM6Ly9wbHVzLmdvb2dsZS5jb20iLCJhcHBjaXJjbGVwaWNrZXIiOnsidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvYXBwY2lyY2xlcGlja2VyIn0sImZvbGxvdyI6eyJ1cmwiOiI6c29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4Ol8vd2lkZ2V0L3JlbmRlci9mb2xsb3c/dXNlZ2FwaVx1MDAzZDEifSwiY29tbXVuaXR5Ijp7InVybCI6IjpjdHhfc29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4OjppbV9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyL2NvbW11bml0eT91c2VnYXBpXHUwMDNkMSJ9LCJzaGFyZXRvY2xhc3Nyb29tIjp7InVybCI6Imh0dHBzOi8vd3d3LmdzdGF0aWMuY29tL2NsYXNzcm9vbS9zaGFyZXdpZGdldC93aWRnZXRfc3RhYmxlLmh0bWw/dXNlZ2FwaVx1MDAzZDEifSwieXRzaGFyZSI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyL3l0c2hhcmU/dXNlZ2FwaVx1MDAzZDEifSwicGx1cyI6eyJ1cmwiOiI6c29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4Ol8vd2lkZ2V0L3JlbmRlci9iYWRnZT91c2VnYXBpXHUwMDNkMSJ9LCJyZXBvcnRhYnVzZSI6eyJwYXJhbXMiOnsidXJsIjoiIn0sInVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyL3JlcG9ydGFidXNlP3VzZWdhcGlcdTAwM2QxIn0sImNvbW1lbnRjb3VudCI6eyJ1cmwiOiI6c29jaWFsaG9zdDovOnNlc3Npb25fcHJlZml4Ol8vd2lkZ2V0L3JlbmRlci9jb21tZW50Y291bnQ/dXNlZ2FwaVx1MDAzZDEifSwiY29uZmlndXJhdG9yIjp7InVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy9wbHVzYnV0dG9uY29uZmlndXJhdG9yP3VzZWdhcGlcdTAwM2QxIn0sInpvb21hYmxlaW1hZ2UiOnsidXJsIjoiaHR0cHM6Ly9zc2wuZ3N0YXRpYy5jb20vbWljcm9zY29wZS9lbWJlZC8ifSwic2F2ZXRvd2FsbGV0Ijp7InVybCI6Imh0dHBzOi8vY2xpZW50czUuZ29vZ2xlLmNvbS9zMncvby9zYXZldG93YWxsZXQifSwicGVyc29uIjp7InVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy93aWRnZXQvcmVuZGVyL3BlcnNvbj91c2VnYXBpXHUwMDNkMSJ9LCJzYXZldG9kcml2ZSI6eyJ1cmwiOiJodHRwczovL2RyaXZlLmdvb2dsZS5jb20vc2F2ZXRvZHJpdmVidXR0b24/dXNlZ2FwaVx1MDAzZDEiLCJtZXRob2RzIjpbInNhdmUiXX0sInBhZ2UiOnsidXJsIjoiOnNvY2lhbGhvc3Q6LzpzZXNzaW9uX3ByZWZpeDpfL3dpZGdldC9yZW5kZXIvcGFnZT91c2VnYXBpXHUwMDNkMSJ9LCJjYXJkIjp7InVybCI6Ijpzb2NpYWxob3N0Oi86c2Vzc2lvbl9wcmVmaXg6Xy9ob3ZlcmNhcmQvY2FyZCJ9fX0sImgiOiJtOy9fL3Njcy9hcHBzLXN0YXRpYy9fL2pzL2tcdTAwM2Rvei5nYXBpLmVuX0dCLjNzajlXZDBBaVRVLk8vbVx1MDAzZF9fZmVhdHVyZXNfXy9hbVx1MDAzZEFRL3J0XHUwMDNkai9kXHUwMDNkMS90XHUwMDNkemNtcy9yc1x1MDAzZEFHTFRjQ01EenpnR24zSUdibFdfVWppbFlTTkV4cjNkOGciLCJ1IjoiaHR0cHM6Ly9hcGlzLmdvb2dsZS5jb20vanMvcGxhdGZvcm0uanMiLCJoZWUiOnRydWUsImZwIjoiYThmNzY3YjZmMGQ1MjA4ZGJmMjRmYWIzNjhiMjc0MWNiY2JiYzE0ZSIsImRwbyI6ZmFsc2V9LCJwbGF0Zm9ybSI6WyJhZGRpdG5vdyIsImJhY2tkcm9wIiwiYmxvZ2dlciIsImNvbW1lbnRzIiwiY29tbWVudGNvdW50IiwiY29tbXVuaXR5IiwiZm9sbG93IiwicGFnZSIsInBlcnNvbiIsInBsYXlyZXZpZXciLCJwbHVzIiwicGx1c29uZSIsInBvc3QiLCJyZXBvcnRhYnVzZSIsInNhdmV0b2RyaXZlIiwic2F2ZXRvd2FsbGV0Iiwic2hvcnRsaXN0cyIsInNpZ25pbjIiLCJ1ZGNfd2ViY29uc2VudGZsb3ciLCJ2aXNpYmlsaXR5IiwieW91dHViZSIsInl0c3Vic2NyaWJlIiwiem9vbWFibGVpbWFnZSIsInBob3RvY29tbWVudHMiLCJoYW5nb3V0Iiwic2hhcmV0b2NsYXNzcm9vbSJdLCJmcCI6ImE4Zjc2N2I2ZjBkNTIwOGRiZjI0ZmFiMzY4YjI3NDFjYmNiYmMxNGUiLCJhbm5vdGF0aW9uIjpbImludGVyYWN0aXZlcG9zdCIsInJlY29iYXIiLCJzaWduaW4yIiwiYXV0b2NvbXBsZXRlIiwicHJvZmlsZSJdLCJiaW1vZGFsIjpbInNpZ25pbiIsInNoYXJlIl19fSk7";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();</script>
	</li>
	</ul>
	</div>
	</div><div class="divider"></div>
	<div class="respond">
	<div style="text-align:center">
	<?php echo $GetAdverts -> SmallSideAds("Index Small SideAds","Index");?>
	</div>
	</div>
	<div class="divider"></div>
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h3 style="font-size:13px">News / Updates</h3></div>
	</div>
	<ul class="listItem" id="get_news">
	</ul>
	<div class="divider"></div>
	</div>
	<div class="divider"></div>
	<div class="respond">
	<div style="text-align:center">
	<?php echo $GetAdverts -> SideMenus("Index SideBanner 1","Index");?>
	</div>
	</div>
	<div class="divider"></div>
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h4 style="font-size:13px">From Our Blog</h4></div>
	</div>
	<ul class="listItem blog-post" id="fetchedBlogContent">	
		<?php
		$blog_feed = new RssFeed('http://blog.nigerianseminarsandtrainings.com/rss');
		$blog_feed->getItems(5);
		?>
	</ul>
	<div class="divider"></div>
	</div>

	<div class="addshadow" id="articles">
	<div class="sneak_peak2">
	<div class="button_class"><h4 style="font-size:13px">Articles</h4></div>
	</div>
	<ul class="listItem" id="get_article">
	</ul>
	<div class="divider"></div>
	</div>
	<div class="divider"></div>
	<div>
	<div class="respond">
	<div style="text-align:center">
	<?php echo $GetAdverts -> SideMenus("Index SideBanner 2","Index");?>
	</div>
	</div>
	<?php $result=MysqlSelectQuery("select * from quarterly_guide where year='".date("Y")."' order by guide_id desc limit 0, 4");if(NUM_ROWS($result)>0){?>
	<div class="divider"> </div>
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h5 style="font-size:13px">Download Quarterly Guide</h5></div>
	</div>
	<ul>
	<?php while($rows=SqlArrays($result)){$link=SITE_URL.'download-guide/'.str_replace($title_link,"-",$rows['name']);?>
	<li><a href="<?php echo $link;?>" title="<?php echo $rows['name'];?> Conferences and Training Guide"> <i class="fa fa-square" style=font-size:6px></i> &nbsp; <?php echo $rows['name'];?> Conferences and Training Guide</a></li>
	<?php }?>
	</ul>
	</div>
	<?php }?>
	<div class="divider"></div>
	<div class="respond">
	<div style="text-align:center">
	<?php echo $GetAdverts -> SideMenus("Index SideBanner 3","Index");?>
	</div>
	</div>
	<div class="quoteContainer addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h5 style="font-size:13px">Quote of the Day</h5></div>
	</div>
	<ul class="bjqs">
	<li>
	<div class="TabbedPanelsContent" style="color:#33454e;text-align:center;height:150px">
	<table>
	<tr>
	<td>
	<div class="fb-like" data-href="<?php echo SITE_URL.'quotespg/'.$newFile;?>" data-layout=button_count data-action=like data-show-faces=true></div>
	</td>
	</tr>
	</table>
	<br /><a href="<?php echo SITE_URL.'quotespg/'.$newFile;?>">"<?php echo $row['quote']; ?>"<br /><span style=font-weight:normal;color:#000><i><?php echo $row['authur'];?></i></span></a>
	</div>
	</li>
	</ul>
	</div>
	<div class="respond">
	<div class="divider"></div>
	<div style="text-align:center"><div class="fb-like-box" data-href="https://www.facebook.com/nigerianseminars" data-width="100%" data-height="400" data-show-faces="true" data-stream="false" data-show-border="true" data-header="true"></div></div>
	<div class="divider"></div>
	</div>
	<div style="text-align:center;margin-top:10px"></div>
	<div class="searchTable">
	<div style="text-align:center"></div>
	<div class="respond">
	<div style="text-align:center"> <div class="fb-recommendations" data-app-id="Recommendations on Nigerian Seminars and Trainings.com" data-site="nigerianseminarsandtrainings.com" data-action="likes, recommends" data-width="300" data-colorscheme="light" data-header="true"></div></div>
	</div>
	</div>
	<div class="tags respond" id="tags">
	<div class="sneak_peak2">
	<div class="button_class"><h6 style="font-size:13px">Search Events by Tags</h6></div>
	</div>
	<span style="max-height:900px;overflow:scroll" id="EvtTags"></span>
	</div>
	</div>
	<br /><div style="text-align:center" class="ad_float"></div>
	</div> <div class="clearfix"></div> <div class="clearfix"></div> <div class="clearfix"></div>
</div>		
<footer>
	<div id="footer_content">
	<div id="footer">
	<div class="menu_container menu_footer" style="background-color:#33454e;border:0">
	<div style="width:70%;margin-left:auto">
	<ul class="orion-menu kerosine">
	<li><a href="<?php echo SITE_URL;?>about" title="About Us">About Us</a></li>
	<li><a href="<?php echo SITE_URL;?>all-vacancies" title="Find Jobs">Find Jobs</a></li>
	<li><a href="<?php echo SITE_URL;?>sitemap-page" title=Sitemap>Sitemap</a></li>
	<li><a href="<?php echo SITE_URL;?>videos-all" title="Watch Training Videos">Watch Training Videos</a></li>
	<li><a href="<?php echo SITE_URL;?>faq" title=FAQ>FAQ</a></li>
	</ul>
	</div>
	<div class="clearfix"></div>
	</div>
	<div class="copyright">
	<p style="width:40%; margin-left: -17%;">Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp; </p>
	<p class="respond" style="margin-left: -3.5%;">
	<a href="<?php echo SITE_URL;?>terms-of-use" title="Terms of Use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="<?php echo SITE_URL;?>privacy-policy" title="Privacy Policy">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	</p>
	<!--<span style=margin-top:20px id=siteseal><script type=text/javascript src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>-->
	<a href="https://play.google.com/store/apps/details?id=com.kaisteventures.nigerianseminars&amp;hl=en" target="_blank" rel="nofollow"><img src="<?php echo SITE_URL;?>/images/googleplay.jpg" alt="Nigerian Seminars App" style="margin-right: 1%;height:50%;margin-top:10px;"></a>
  <img src="images/interswitch.png" alt="payment method" style="height:50%; margin-right: 1%;">
	<img src="images/paypal_accepted.jpg" alt="paypal accepted button-image" style=" margin-right:1%" class="paypal-img" />
	<a class="mobile-hide" href="https://validator.w3.org/nu/?useragent=Validator.nu%2FLV+http%3A%2F%2Fvalidator.w3.org%2Fservices&amp;doc=https%3A%2F%2Fwww.nigerianseminarsandtrainings.com" target=_blank title="nigerian seminars W3C badge" rel="nofollow" style="position: relative; top: -2%; left: 1%;"><img src="images/w3c-html.png" style="height: 50%; width: 11%;" alt="nigerian seminars W3C badge" width=88 height=31 /></a>
	</div>
	</div>
	</div>
	<a href=# title="back to top" class="back-to-top" style="display:none">
	<i class="fa fa-arrow-circle-up"></i>
	</a>
</footer>
</div>
</div>
<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=css/smartforms/js/jquery-1.9.1.min.js,css/smartforms/js/jquery-ui-1.10.4.custom.min.js,css/smartforms/js/jquery-ui-monthpicker.min.js,css/menu/js/orion-menu.js,js/mostslider.js,js/jquery.sticky.js,js/jquery.currency.js,js/jquery.currency.localization.en_US.js,js/contact-form.js,js/scroller.js"></script>
<script type="text/javascript">$(document).ready(function(){$("#currency-widget").currency({localRateProvider:"<?php echo SITE_URL;?>api_currency.php",loadingImage:"<?php echo SITE_URL;?>images/img/loader.gif"})});</script>
<script>$(document).ready(function(){$(".menu_float").sticky({topSpacing:0})});</script>
<script type="text/javascript">$(document).ready(function(){var a=$("#slider_video").mostSlider();$.post("<?php echo SITE_URL;?>tools/loadVenueProviders.php",function(b){$("#venuProviders").html(b)})});$(document).ready(function(){$("#EvtTags").html("Loading....");$.post("tools/loadTags.php",function(a){$("#EvtTags").html(a)})});</script>
<script type="text/javascript">$(document).ready(function(a){$("#email_login").keypress(function(c){var b=$(this).val().length;if(b>0){$("#forgot").text("?")}else{$("#forgot").text("Forgot?")}});$("#password").keypress(function(c){var b=$(this).val().length;if(b>0){$("#password_forget").text("?")}else{$("#password_forget").text("Forgot?")}})});</script>
<script>$(document).ready(function(){$(".prompt").click(function(b){b.preventDefault();var d=$(this).attr("href");var g=$(document).height();var c=$(window).width();$("#mask").css({width:c,height:g});$("#mask").fadeIn(1000);$("#mask").fadeTo("slow",0.8);var a=$(window).height();var f=$(window).width();$(d).css("top",a/2-$(d).height()/2);$(d).css("left",f/2-$(d).width()/2);$(d).fadeIn(2000)});$(".window_currency #closeBox").click(function(a){a.preventDefault();$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow")});$("#mask").click(function(){$(this).fadeOut("slow");$(".window_currency").fadeOut("slow")});$(window).resize(function(){var a=$("#boxes .window_currency");var e=$(document).height();var c=$(window).width();$("#mask").css({width:c,height:e});var b=$(window).height();var d=$(window).width();a.css("top",b/2-a.height()/2);a.css("left",d/2-a.width()/2)})});function Subscriber(){window.location="subscribers"}function Account(){window.location="login"}$(document).ready(function(){$(window).resize(function(){$("#clock-show").text($(window).width())})});</script>
<script type="text/javascript">$(function(){$("#month-picker1").monthpicker({changeYear:false,stepYears:1,prevText:'<i class="fa fa-chevron-left"></i>',nextText:'<i class="fa fa-chevron-right"></i>',showButtonPanel:true,dateFormat:"MM yy"})});function GetState(){if($("#country").val()==38){$("#stateSelect").fadeIn("slow")}else{$("#stateSelect").fadeOut("slow")}}$("#textInput").keyup(function(){$("#output").fadeIn("slow");$("#output").html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>');$.post("<?php echo SITE_URL;?>tools/search.php",{query:$(this).val()},function(a){$("#output").html(a)})});$("#textInput").blur(function(){$("#output").fadeOut()});$("#textInput").focus(function(){$("#output").fadeIn("slow");$("#output").html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>');if($(this).val()==""){$.post("<?php echo SITE_URL;?>tools/search.php",{queryFocus:$(this).val()},function(a){$("#output").html(a)})}else{$.post("<?php echo SITE_URL;?>tools/search.php",{query:$(this).val()},function(a){$("#output").html(a)})}});$(document).ready(function(a){$(".basic a").click(function(b){$(".basic").fadeOut("slow",function(){$(".advanced").fadeIn("slow")});b.preventDefault()})});$(document).ready(function(a){$(".advanced a").click(function(b){$(".advanced").fadeOut("slow",function(){$(".basic").fadeIn("slow")});b.preventDefault()})});</script>
<script type="text/javascript">$(document).ready(function(a){$("#evtsearch").keyup(function(){$("#output_events").fadeIn("slow");$("#output_events").html('<center"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>');$.post("<?php echo SITE_URL;?>tools/searchEvents.php",{query:$(this).val(),type:"Training"},function(b){$("#output_events").html(b)})});$("#evtsearch").blur(function(){$("#output_events").fadeOut()})});function GetEvtVal(b){var a=$("#"+b).attr("data");$("#evtsearch").val($("#"+b).text());$("#output_events").hide();$("#searchform_basic").attr("action",a)}$(document).ready(function(a){$(".currency").click(function(f){f.preventDefault();var h=$(this).attr("data-id");var c=$(document).height();var g=$(window).width();$("#mask").css({width:g,height:c});$("#mask").fadeIn(1000);$("#mask").fadeTo("slow",0.8);var d=$(window).height();var b=$(window).width();$(h).css("top",d/2-$(h).height()/2);$(h).css("left",b/2-$(h).width()/2);$(h).fadeIn(2000)});$(".currency-footer #closeBoxCurr").click(function(b){b.preventDefault();$("#msgbox").fadeOut("slow");$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow")});$("#mask").click(function(){$(this).fadeOut("slow");$("#msgbox").fadeOut("slow");$(".window_currency").fadeOut("slow")});$(window).resize(function(){var d=$("#boxes .window_currency");var c=$(document).height();var f=$(window).width();$("#mask").css({width:f,height:c});var e=$(window).height();var b=$(window).width();d.css("top",e/2-d.height()/2);d.css("left",b/2-d.width()/2)})});function Close(){$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow")}</script>
<script>function shuffleDisplay(e,d,f){setInterval(function(){var a=$(e).get().sort(function(){return Math.round(Math.random())-0.5}).slice(0,e.length-1);$(a).hide();$(a).appendTo(a[0].parentNode).fadeIn(d)},f)}$(document).ready(function(){shuffleDisplay("div.shuffleproviders",1000,75000);shuffleDisplay("div.shufflesupplier",1000,75000);shuffleDisplay("div.shufflevenuepro",1000,75000)});</script>
<script>$(document).ready(function(b){var c=250;var a=300;$(window).scroll(function(){if($(this).scrollTop()>c){$(".back-to-top").fadeIn(a)}else{$(".back-to-top").fadeOut(a)}});$(".back-to-top").click(function(d){d.preventDefault();$("html, body").animate({scrollTop:0},a);return false})});</script>
<script>$(document).ready(function(){$("#get_news").load("<?php echo SITE_URL;?>tools/get_resources.php?news");$("#get_article").load("<?php echo SITE_URL;?>tools/get_resources.php?articles");$("#hotel").html('<a href="http://www.nsthotels.com" title="Book hotel here" target=_blank rel=nofollow"><img src="images/hotelIMG.gif" alt="book hotel" /></a>')});</script>
<script src="js/classie.js"></script>
<script async src="js/app.js?<?php echo time(); ?>"></script>
</body>
</html>	