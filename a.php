<?php session_start();
	require_once("scripts/config.php"); 
	require_once("scripts/functions.php"); 
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
<html lang="en">
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
	<meta property="og:image" content="<?php echo SITE_URL;?>images/facebookIMG.png"/>
	<meta property="og:image:type" content="image/jpeg"/>
	<meta property="og:image:width" content="200"/>
	<meta property="og:image:height" content="200"/>
	<meta property="og:url" content="https://nigerianseminarsandtrainings.com"/>
	<meta property="og:sitename" content="nigerianseminarsandtrainings"/>
	<meta property="fb:admins" content="724927989" />
	<meta property="fb:app_id" content="139788739390395"/>
	<meta name="twitter:card" content="summery">
	<meta name="twitter:site" content="@nst" />
	<meta name="twitter:title" content="Nigerian Seminars and Trainings - Training | Conferences |Courses" >
	<meta name="twitter:description" content="Find training in Nigeria |seminars in Nigeria |workshops |conferences | management training courses in Nigeria | Africa | Asia |North/South America |Europe" >
	<meta name="twitter:site:id" content="337259573">
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
	<script type="text/javascript">function makeArray(){for(i=0;i<makeArray.arguments.length;i++){this[i+1]=makeArray.arguments[i]}}function renderTime(){var w=new Date();var m="AM";var s=w.getHours();var t=w.getMinutes();var h=w.getSeconds();setTimeout("renderTime()",1000);if(s==0){s=12}else{if(s>=12){s=s-12;m="PM"}}if(s<10){s="0"+s}if(t<10){t="0"+t}if(h<10){h="0"+h}var v=new makeArray("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");var o=w.getDate();var r=w.getMonth()+1;var q=w.getYear();var p=(q<1000)?q+1900:q;var u=document.getElementById("clockDisplay");u.textContent=o+" "+v[r]+", "+p+" "+s+":"+t+":"+h+" "+m}</script>
	<?php include('tools/analytics.php');?>
</head>
<body id="home">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5JM3HJ');</script>
<!-- End Google Tag Manager -->
<script type=text/javascript>(function(b,e,c){var a,f=b.getElementsByTagName(e)[0];if(b.getElementById(c)){return}a=b.createElement(e);a.id=c;a.src="//connect.facebook.net/en_US/all.js#xfbml=1";f.parentNode.insertBefore(a,f)}(document,"script","facebook-jssdk"));</script>
<script type=text/javascript>_atrk_opts={atrk_acct:"BdEse1a8Dq00M9",domain:"nigerianseminarsandtrainings.com",dynamic:true};(function(){var a=document.createElement("script");a.type="text/javascript";a.async=true;a.src="https://d31qbv1cthcecs.cloudfront.net/atrk.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" id="alexa" alt="Alexa Website Audit Image" /></noscript>
<script type=text/javascript>var _qevents=_qevents||[];(function(){var b=document.createElement("script");b.src=(document.location.protocol=="https:"?"https://secure":"http://edge")+".quantserve.com/quant.js";b.async=true;b.type="text/javascript";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)})();_qevents.push({qacct:"p-2fH5lI6K2ceJA"});</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4ed92030268ec343" async="async"></script>
<div class="menu">
      <!-- Menu icon -->
      <div class="icon-close">
        <img src="<?php echo SITE_URL?>/images/close.png" alt="close">
      </div>
      <div itemscope itemtype=http://schema.org/WebSite class="custom-search">
				<meta itemprop=url content="https://www.nigerianseminarsandtrainings.com/"/>
				<form method=get action="<?php echo SITE_URL;?>content_search" itemprop=potentialAction itemscope itemtype=http://schema.org/SearchAction>
				<meta itemprop=target content="https://www.nigerianseminarsandtrainings.com/content-search?query={query}"/>
					<label for="query">
						<input name="query" type=text id="query" placeholder="Google&trade; Custom Search" itemprop="query-input" required />
					</label>
					<button type=submit class="cssButton_aqua">Search</button>
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
					<li><a href="<?php echo SITE_URL;?>events/categories" title="Events by category">Events by Category <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>events/countries" title="Events by Countries">Events by Countries <i class="fa fa-square"></i></a></li>
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
					<li><a href="<?php echo SITE_URL;?>about" title="About Us">About Us <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>articles" title="Articles">Articles <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>faq" title=FAQ>FAQ <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>all-vacancies" title="Find Jobs">Find Jobs <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>archive" title="News and Updates">News and Updates <i class="fa fa-square"></i></a></li>
          <li><a href="<?php echo SITE_URL;?>quoteArchive" title="Quotes">Quotes <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>sitemap-page" title=Sitemap>Sitemap <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>article-submission" title="Submit Articles"> Submit Articles <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>videos-all" title="Watch Training Videos">Watch Training Videos <i class="fa fa-square"></i></a></li>
	      </ul>	
	      <p class="menu-text-head">Useful Web Links</p>
				<ul class="useful-weblink">
	      	<li><a href="weather" title="Check Weather Report">  Check Weather Report <i class="fa fa-square"></i></a></li>
					<li><a href="javascript:void(0)" class="currency" data-id="#currency" title="Currency Converter">  Currency Converter <i class="fa fa-square"></i></a></li>
					<li><a href="domain-checker" title="Domain Name Checker">  Domain Name Checker <i class="fa fa-square"></i></a></li>
					<li><a href="favicon-generator" title="Favicon Generator">  Favicon Generator <i class="fa fa-square"></i></a></li>
					<li><a href="<?php echo SITE_URL;?>install-widget" title="Install Widget" target=_blank> Install Training Widget <i class="fa fa-square"></i></a></li>
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
			<table id="profile-table">
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
				<a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>contact-us" title="Contact Us">Contact Us</a>
				<a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>login" title="Login">Login</a>
				<a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>subscribers" title="Subscribe">Subscribe</a>
			</form>
			<div class="clear"></div>
		</div><!-- top_login_form  if not loged in-->
	</div>
	<?php }?>
	</div>
	<div class="topmenu_options_left">
	<?php $display='';if(isset($_SESSION['login_business'])||isset($_SESSION['login_subcriber']))$display='Hello '.$_SESSION['name'];else $display='<script type=text/javascript>renderTime();</script>';?>
	<div class=welcomeNote id="clockDisplay">
	<?php echo $display;?>
	</div>
	<p id="google_translate_element">
	<script type="text/javascript">function googleTranslateElementInit(){new google.translate.TranslateElement({pageLanguage:"en",layout:google.translate.TranslateElement.InlineLayout.SIMPLE,gaTrack:true,gaId:"UA-23693392-1"},"google_translate_element")}var googleTranslateScript=document.createElement("script");googleTranslateScript.type="text/javascript";googleTranslateScript.async=true;googleTranslateScript.src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit";(document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0]).appendChild(googleTranslateScript);</script>
	</p>
	</div><div class=clearfix></div>
	</div><div class=clearfix></div>
	</div>
	<div class="top_content">
	<div id="slider">
	<div class="logoClass">
	<img src=images/logo2.png alt="N.S.T corporate Logo" width=420 height=60 />
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
			<a id="nav"><i class="fa fa-home fa-2x"></i></a>
			<span id="showNav">Show Menu</span>
			<i class="fa fa-bars fa-2x" id="menu"></i>
		    <form action="<?php echo SITE_URL;?>content_search" method="get" class="wrap">
		    <label for="search_input">
		    	<input id="search_input" name="query" type="text" placeholder="What're You looking for ?">
		    </label>
		    <input type="button" id="search_submit" value=" " />
		    </form>
		</div>
		<ul class="orion-menu petrol mobile-hide" id="main-menu">
		<li class="mobile-hide"><h1><a href="<?php echo SITE_URL;?>" title=Home>Home</a></h1></li>
		<li class="mobile-show-me" id="most-hide"><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>add-event" title="Add Event">Add Event</a></li>
		<li class="mobile-show-me" id="hide-me"><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>upload-business-info" title="Add Business">Add Business</a></li>
		<li class="mobile-show-me" id="shuld-hide"><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>upload-vacancies" title="Add Vacancy">Add Vacancy</a></li>
		<?php if(!isset($_SESSION['login_business'])){?>
		<?php }?>
		<li class="mobile-show" id="for-mobile">
			<a >
				Events
				<i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>all-event">All Events</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>events/categories">Events By Category</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>events/countries">Events By Country</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>nigeria">Events In Nigeria</a></li>
			</ul>
		</li>
		<li class="mobile-hide"><a href="<?php echo SITE_URL;?>all-event" title="All Events">All Events</a></li>
		<li class="mobile-hide"><a href="<?php echo SITE_URL;?>training-providers" title="Training providers">Training Providers</a></li>
		<li class="mobile-show" id="hide">
			<a >
				Training Providers
				<i class="fa fa-caret-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>training-providers">All Providers</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>cmd-accr-training-providers">CMD Accredited Training Providers</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>trainingCategory/spe?categories">Training Providers By Category</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>training-providers/countries">Training Providers By Country</a></li>
				<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>training-provider/nigeria">Training Providers In Nigeria</a></li>
			</ul>
		</li>
		<li><a href="<?php echo SITE_URL;?>suppliers" title="Find Suppliers">Equipment Suppliers</a></li>
		<li><a href="<?php echo SITE_URL;?>venues" title="Find Event Venue ">Event Venue Providers</a></li>
		<li><a href="<?php echo SITE_URL;?>event-managers" title="Event Managers">Event Managers</a></li>
		<li><a href="<?php echo SITE_URL;?>facilitators" title="Find Suppliers">Facilitators</a></li>
		<li><a href="<?php echo SITE_URL;?>advertise" title="Advertise">Advertise with Us</a></li>
		<li><a href="<?php echo SITE_URL;?>premium-listing" title="Premium Listing">Premium Listing</a></li>
                <li><a target="_blank" href="http://blog.nigerianseminarsandtrainings.com" title="Blog" id="blog-link">Blog</a></li>
		<li class="mobile-hide more">
			<div class="icon-menu">
				<span id="menu-text" title="More Menu">More Menu</span>
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
	<div class="basic">
	<form action="#" method=post id="searchform_basic" autocomplete="off">
	<table>
	<tr>
	<td><label class="field prepend-icon" for="evtsearch">
	<input type="text" name="sub2" id="evtsearch" class="gui-input" placeholder="Enter keywords to search">
	</label>
	<span><a href="javascript:void(0)" class="mobile_res" title="Advanced search">Use Advanced search</a></span>
	</td>
	<td id="search_now"><button type="submit" class="cssButton_roundedLow cssButton_aqua">Search</button>
	</td>
	</tr>
	</table>
	</form> <div class="clearfix"></div>
	</div>
	<div class="clearfix"></div>
	<div  id="side-add1">
	<?php echo $GetAdverts -> SkyScrapper("Index Skyscrapper Left","Index");?>
	</div>
	<div class="addshadow" id="hotel"></div>
	<div id="venuProviders"></div>
	<div class="align-center">
	<?php echo $GetAdverts -> SkyScrapper("Index Skyscrapper Left 2","Index");?>
	</div>
	</div>
	</div>
	<div id="content_left">
	<div class="CenterAdd" >
	<?php echo $GetAdverts -> LandScapeAds("Index PageBanner 1","Index");?>
	</div>
	<div class="searchSite smart-forms">
	<div class="advanced">
	<p class="mobile-hide" id="use-advance">Use our advanced search function to find events faster</p>
	<form action="<?php echo SITE_URL;?>search" method="get" id="searchform" autocomplete="off">
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
	<label class="field prepend-icon" for="month-picker1">
	<input type="text" id="month-picker1" name="month" class="gui-input" placeholder="Select Month">
	<span class=field-icon><i class="fa fa-calendar-o"></i></span>
	</label>
	</div>
	<div class="search_inputs">
	<label class="field prepend-icon" for="textInput">
	<input type="text" name="provider" id="textInput" class="gui-input" placeholder="Select Training Provider">
	<span class=field-icon><i class="fa fa-user"></i></span>
	<span id="output"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader" /></span>
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
	<div class="search_inputs">
	<label class="field select" id="stateSelect">
	<select name="state" id="state"><option value>Select state (Nigeria only)</option><?php echo GetState()?>
	</select><i class="arrow double"></i>
	</label>
	</div>
	<p><a href="javascript:void(0)" id="use-basic" title="Use Basic Search">Use Basic Search</a></p>
	</div>
	</form>
	</div>
	<div id="output_events"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader" /></div>
	</div>
	<script type="text/javascript">function url_location(a){window.location=a}</script>
	<div class="sub_links">
	<div class="highlights">
	<h2 class="highlights_mobile"><strong >Highlights of upcoming <u><a href="all-event-tag-search?tag=conferences" class=highlights_mobile>conferences,</a></u>
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
	<a href="<?php echo SITE_URL.'events/'.$rows_pre['event_id'].'/'.str_replace($title_link,"-",$rows_pre['event_title']);?>" itemprop="url" class="title" title="<?php echo $rows_pre['event_title'];?>"><span class="spanTitle" itemprop="name"><?php echo $rows_pre['event_title'];?></span></a>
	<div class="innerHeadingPropEvent">
	<p itemprop="doorTime"><?php echo dateDiff($rows_pre['startDate'],$rows_pre['endDate']);?>,
	<?php echo date('M d',strtotime($rows_pre['startDate']))." - ".date('d M, Y',strtotime($rows_pre['endDate']));?> &nbsp;</p>
	<span class="state-date" itemprop="startDate" ><?php echo date('Y-m-d h:m:s',strtotime($rows_pre['startDate']));?></span>
	<div class="clearfix"></div>
	</div>
	<span itemprop="location" class="location">
	<?php echo GetEventLocation($rows_pre['event_id']);?>
	</span>
	<div class="respond">
	<div class="testImg" >
		<img src="<?php echo SITE_URL.$logo;?>" alt="logo-<?php echo $rows_pre['organiser'];?>">
	</div>
	</div>
	<p class="organiser">
	<?php echo $rows_pre['organiser'];?>
	</p>
	<div class="trainingProviders">
	<div class="description" itemprop="description"><?php echo trim(trimStringToFullWord(145, stripslashes(strip_tags(preg_replace('/\s+/', ' ',$rows_pre['description']))))).'<span> ...</span>';?> </div>
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
	<div id="currency" class="window_currency boxContent">
	<div id="currency-widget"></div>
	</div>
	</div>
	<div class="clearfix"></div>
	</div>
	</div>
	<div id="sidebar">
	<div class="respond">
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h3>Socialize with us</h3></div>
	</div>
	<ul>
	<li>
	<a href="https://twitter.com/nigerianseminar" class="twitter-follow-button" data-show-count="true" data-lang="en" title="Follow @twitterapi">Follow @twitterapi</a>
	<script>!function(b,e,c){var a,f=b.getElementsByTagName(e)[0];if(!b.getElementById(c)){a=b.createElement(e);a.id=c;a.src="//platform.twitter.com/widgets.js";f.parentNode.insertBefore(a,f)}}(document,"script","twitter-wjs");</script>
	</li>
	<li class="remove">
	<div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com" data-layout="button_count" data-action="like" data-show-faces="false"></div>
	</li>
	<li>
	<div class="g-plusone" data-annotation="inline" data-width="300"></div>
	<script type=text/javascript>(function(){var a=document.createElement("script");a.type="text/javascript";a.async=true;a.src="https://apis.google.com/js/platform.js";var b=document.getElementsByTagName("script")[0];b.parentNode.insertBefore(a,b)})();</script>
	</li>
	</ul>
	</div>
	</div><div class="divider"></div>
	<div class="respond">
	<div class="align-center">
	<?php echo $GetAdverts -> SmallSideAds("Index Small SideAds","Index");?>
	</div>
	</div>
	<div class="divider"></div>
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h3>News / Updates</h3></div>
	</div>
	<ul class="listItem" id="get_news">
	</ul>
	<div class="divider"></div>
	</div>
	<div class="divider"></div>
	<div class="respond">
	<div class="align-center">
	<?php echo $GetAdverts -> SideMenus("Index SideBanner 1","Index");?>
	</div>
	</div>
	<div class="divider"></div>
	
	<div class="addshadow" id="articles">
	<div class="sneak_peak2">
	<div class="button_class"><h4>Articles</h4></div>
	</div>
	<ul class="listItem" id="get_article">
	</ul>
	<div class="divider"></div>
	</div>
	<div class="divider"></div>
	<div>
	<div class="respond">
	<div class="align-center">
	<?php echo $GetAdverts -> SideMenus("Index SideBanner 2","Index");?>
	</div>
	</div>
	<?php $result=MysqlSelectQuery("select * from quarterly_guide where year='".date("Y")."' order by guide_id desc limit 0, 4");if(NUM_ROWS($result)>0){?>
	<div class="divider"> </div>
	<div class="addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h5>Download Quarterly Guide</h5></div>
	</div>
	<ul>
	<?php while($rows=SqlArrays($result)){$link=SITE_URL.'download-guide/'.str_replace($title_link,"-",$rows['name']);?>
	<li><a href="<?php echo $link;?>" title="<?php echo $rows['name'];?> Conferences and Training Guide"> <i class="fa fa-square name"></i> &nbsp; <?php echo $rows['name'];?> Conferences and Training Guide</a></li>
	<?php }?>
	</ul>
	</div>
	<?php }?>
	<div class="divider"></div>
	<div class="respond">
	<div class="align-center">
	<?php echo $GetAdverts -> SideMenus("Index SideBanner 3","Index");?>
	</div>
	</div>
	<div class="quoteContainer addshadow">
	<div class="sneak_peak2">
	<div class="button_class"><h5>Quote of the Day</h5></div>
	</div>
	<ul class="bjqs">
	<li>
	<div class="TabbedPanelsContent">
	<table>
	<tr>
	<td>
    <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/quotespg/&#039;.$newFile" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
	</td>
	</tr>
	</table>
	<br /><a href="<?php echo SITE_URL.'quotespg/'.$newFile;?>">"<?php echo $row['quote']; ?>"<br /><span><i><?php echo $row['authur'];?></i></span></a>
	</div>
	</li>
	</ul>
	</div>
	<div class="respond">
	<div class="divider"></div>
	<div class="divider"></div>
	</div>
	<div id="fb-connect"></div>
	<div class="searchTable">
	<div class="align-center"></div>
	<div class="respond">
	</div>
	</div>
	<div class="tags respond" id="tags">
	<div class="sneak_peak2">
	<div class="button_class"><h6>Search Events by Tags</h6></div>
	</div>
	<span id="EvtTags"></span>
	</div>
	</div>
	<br /><div class="align-center ad_float"></div>
	</div> <div class="clearfix"></div> <div class="clearfix"></div> <div class="clearfix"></div>
</div>		
<footer>
	<div id="footer_content">
	<div id="footer">
	<div class="menu_container menu_footer">
	<div id="tp-bottom">
	<div class="TopBottomMenu">
		<ul class="orion-menu">
			<li class="social">
				<div class="hidele">
				<a href="https://www.facebook.com/nigerianseminars" target="_blank" id="fb" title="Facebook"><i class="fa fa-facebook"></i><span class="tooltip">Facebook</span></a>
				<a href="https://twitter.com/NigerianSeminar" target="_blank" id="twitter" title="Twitter"><i class="fa fa-twitter "></i><span class="tooltip">Twitter</span></a>
				<a href="https://www.nigerianseminarsandtrainings.com/rss" target="_blank" id="rssfeed" title="RSS Feeds"><i class="fa fa-rss"></i><span class="tooltip">RSS Feeds</span></a>
				<a href="https://plus.google.com/+Nigerianseminarsandtrainings" target="_blank"  class="gplus" rel="publisher" title="Google Plus"><i class="fa fa-google"></i><span class="tooltip">Google Plus</span></a>
				<a href="https://www.pinterest.com/nigerianseminar" target="_blank" id="pint" title="Pinterest"><i class="fa fa-pinterest"></i><span class="tooltip">Pinterest</span></a>
				<a href="https://www.youtube.com/user/nigerianseminars" target="_blank" rel="nofollow" class="gplus" title="Youtube"><i class="fa fa-youtube"></i><span class="tooltip">Youtube</span></a>
				</div>
			</li>
		</ul>
	</div>
	</div>
	<div class="clearfix"></div>
	</div>
	<div class="copyright">
	<p id="copyright-text">Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp; </p>
	<p class="respond">
	<a href="<?php echo SITE_URL;?>terms-of-use" title="Terms of Use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="<?php echo SITE_URL;?>privacy-policy" title="Privacy Policy">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	</p>
	<a  id="googleplay" href="https://play.google.com/store/apps/details?id=com.kaisteventures.nigerianseminars&amp;hl=en" target="_blank" rel="nofollow"><img src="<?php echo SITE_URL;?>/images/googleplay.jpg" alt="Nigerian Seminars App" ></a>
  <img src="images/interswitch.png" alt="payment method" id="inter">
	<img src="images/paypal_accepted.jpg" alt="paypal accepted button-image" class="paypal-img" />
	<a class="mobile-hide" id="w3c" href="https://validator.w3.org/nu/?useragent=Validator.nu%2FLV+http%3A%2F%2Fvalidator.w3.org%2Fservices&amp;doc=https%3A%2F%2Fwww.nigerianseminarsandtrainings.com" target=_blank title="nigerian seminars W3C badge" rel="nofollow" ><img src="images/w3c-html.png"  alt="nigerian seminars W3C badge" width=88 height=31 /></a>
	</div>
	</div>
	</div>
</footer>
</div>
</div>
<script type="text/javascript" src="https://www.nigerianseminarsandtrainings.com/min/f=css/smartforms/js/jquery-1.9.1.min.js,css/smartforms/js/jquery-ui-1.10.4.custom.min.js,css/smartforms/js/jquery-ui-monthpicker.min.js,css/menu/js/orion-menu.js,js/mostslider.js,js/jquery.sticky.js,js/jquery.currency.js,js/jquery.currency.localization.en_US.js,js/contact-form.js,js/scroller.js"></script>
<script src="js/apps.js" type="text/javascript"></script>
<script async src="js/app.js?<?php echo time(); ?>"></script>
<script src="<?php echo SITE_URL;?>/js/dwsee.top.bottom.menu.min.js?<?php echo time(); ?>" ></script>
</body>
</html>	