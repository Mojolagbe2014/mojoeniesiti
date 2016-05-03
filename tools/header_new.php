<script type="text/javascript"> (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk')); </script>
<!-- Quantcast Tag -->
<script type="text/javascript"> var _qevents = _qevents || []; (function() { var elem = document.createElement('script'); elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js"; elem.async = true; elem.type = "text/javascript"; var scpt = document.getElementsByTagName('script')[0]; scpt.parentNode.insertBefore(elem, scpt); })(); _qevents.push({ qacct:"p-2fH5lI6K2ceJA" }); </script> <noscript> <div style="display:none;"> <img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif"  height="1" width="1" alt="Quantcast site statistics"/> </div> </noscript>
<!-- End Quantcast tag -->
<!-- Google Tag Manager -->
<script> (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-5JM3HJ'); </script>
<!-- End Google Tag Manager -->
<?php if ($handle = opendir('.')) { $scriptArr = array(); while (false !== ($entry = readdir($handle))) { if ($entry != "." && $entry != "..") { $path_parts = pathinfo($entry); $ext = @$path_parts['extension']; if($ext == 'php') $scriptArr [] = $entry; } } closedir($handle); }
function active($script){ if(strpos($_SERVER['SCRIPT_NAME'], $script) != false){ return 'style="background-color:#e3ebee; color:#435a65;"';} } ?>
<script type="text/javascript">
function makeArray() { for (i = 0; i<makeArray.arguments.length; i++) this[i + 1] = makeArray.arguments[i]; } function renderTime() { var currentTime = new Date(); var diem = "AM"; var h = currentTime.getHours(); var m = currentTime.getMinutes(); var s = currentTime.getSeconds(); setTimeout('renderTime()',1000); if (h == 0) { h = 12; } else if (h >= 12) {h = h - 12; diem="PM"; } if (h < 10) { h = "0" + h; } if (m < 10) { m = "0" + m; } if (s < 10) { s = "0" + s; } var months = new makeArray('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'); var day = currentTime.getDate(); var month = currentTime.getMonth() + 1; var yy = currentTime.getYear(); var year = (yy < 1000) ? yy + 1900 : yy; var myClock = document.getElementById('clockDisplay'); myClock.textContent = day + " " + months[month] + ", " + year +" "+ h + ":" + m + ":" + s + " " + diem; }
Spry.Widget.TabbedPanels.prototype.getTabGroup = function() { if (this.element) { var children = this.getElementChildren(this.element); if (children.length) return children[1]; } return null; }; Spry.Widget.TabbedPanels.prototype.getContentPanelGroup = function() { if (this.element) { var children = this.getElementChildren(this.element); if (children.length > 1) return children[0]; } return null; };
</script>
<div id="fb-root"></div>
<script type="text/javascript"> (function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
<?php $GetAdverts = new Adverts; ?>
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
 </div>
<div id="main_content">
<header>
<div id="top_element">
<div id="TopNav">
<div class="topmenu_options">
    <div class="top_login_form">
    <?php if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])){ ?>

	<form action="<?php echo SITE_URL;?>logout" method="post">
			<table style="width:auto;">
			<tr>
			<td><button type="submit" name="submit_login2" class="sml-btn">Logout</button></td>
			<td><button type="button" title="Back to Profile" name="subject2" class="sml-btn" onClick="Account()">Profile</button></td>
			</tr>
			</table>
		</form>

    <?php }else{?>
    <div class="btn-control">
        <form id="form1">
            <?php if(!isset($_SESSION['login_business'])){?>
            <a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>upload-business-info" title="Add Business"> Add Business</a>
            <?php }?>
            <a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>contact-us">Contact Us</a>
            <a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>login">Login</a>
            <a class="cssButton_roundedLow cssButton_aqua" href="<?php echo SITE_URL;?>subscribers">Subscribe</a>
        </form>
        <div class="clear"></div>
    </div><!-- top_login_form  if not loged in-->
	
    <?php }?>
    </div>
</div>
<div class="topmenu_options_left" >
<?php $display = ''; if(isset($_SESSION['login_business']) || isset($_SESSION['login_subcriber'])) $display = 'Hello '.$_SESSION['name']; ?>
<div class="welcomeNote" id="clockDisplay"><?php echo $display;?></div>
<?php echo ($display=="" ? '<div class="welcomeNote">': ''); ?> 
<p id="google_translate_element" style="float:right;padding-top: 5px;">
<script type="text/javascript"> function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-23693392-1'}, 'google_translate_element'); } var googleTranslateScript = document.createElement('script'); googleTranslateScript.type = 'text/javascript'; googleTranslateScript.async = true; googleTranslateScript.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit'; ( document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0] ).appendChild(googleTranslateScript); </script>
</p>
<?php echo ($display=="" ? '</div>': ''); ?>
</div>
<div class="clearfix"></div>    
</div>
<div class="clearfix"></div>
</div>
<div class="top_content">
<div id="slider">
<div class="logoClass" >
<img src="<?php echo SITE_URL;?>images/logo2.png" alt="Nigerian Seminars and Trainings" />
<div class="clearfix"></div>
</div>
<div class="Adbanner" id="topSearchBox">
<div class="searchSite smart-forms" style="padding-top: 10px;">
<?php if (strpos($_SERVER['SCRIPT_NAME'],'training') != false || strpos($_SERVER['REQUEST_URI'],'tprovider') != false || strpos($_SERVER['REQUEST_URI'],'supplier') != false || strpos($_SERVER['REQUEST_URI'],'venue') != false || strpos($_SERVER['REQUEST_URI'],'event-managers') != false || strpos($_SERVER['REQUEST_URI'],'facilitator') != false) { ?>
<p class="mobile-hide" id="use-advance" style="text-align:left;margin:0px 5px 5px 0px;">Search training providers / event managers / training venues / facilitators in Nigeria and around the world</p>
<div class="basic" style="display:block">
<form action="#" method="post" id="searchProvider" autocomplete="off" style="width:100%; margin-top:0px;">
<div class="smart-widget sm-right smr-80"> 
<label class="field prepend-icon">
<input type="text" name="sub2" id="tsearch" class="gui-input" placeholder="Enter keywords to search for training providers / institutions / firms ">
<span  class="field-icon"><i class="fa fa-search"></i></span> 
</label>
<button type="submit" class="button btn-primary"> Search </button>
</div>
</form>
<div class="clearfix"></div>
<div id="output_providers" style="position:relative; overflow:auto;z-index:9999; margin-top: -5%; border-radius:4px/8px; overflow-wrap: break-word"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></div>
</div>
<?php } elseif ((strpos($_SERVER['SCRIPT_NAME'],'event') && !strpos($_SERVER['SCRIPT_NAME'],'event-manager')) || (strpos($_SERVER['REQUEST_URI'],'event') && !strpos($_SERVER['SCRIPT_NAME'],'event-manager'))){ ?>
<p class="mobile-hide" id="use-advance" style="text-align:left;margin:0px 5px 5px 0px;">Search conferences, training, seminars, courses and workshops in Nigeria and around the world</p>
<div class="basic">
<form action="#" method="post" id="searchform_basic" autocomplete="off" style="width:100%; margin-top:0px;">
<div class="smart-widget sm-right smr-80"> 
<label class="field prepend-icon">
<input type="text" name="sub2" id="evtsearch" class="gui-input" placeholder="Enter keywords to search for events - conferences, training seminars...">
<span  class="field-icon"><i class="fa fa-search"></i></span> 
</label>
<button type="submit" class="button btn-primary"> Search </button>
<span><a href="javascript:void(0)" class="mobile_res" title="Advanced search">Use Advanced search</a></span>
</div>
</form>
<div class="clearfix"></div>
<div id="output_events" style="position:relative; overflow:auto;z-index:9999; margin-top: -5%; border-radius:4px/8px; overflow-wrap: break-word"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader" width="20" height="14" style="text-align:center" /></div>
</div>
<div class="advanced">
<form action="<?php echo SITE_URL;?>search" method="get" id="searchform" autocomplete="off" style="width:auto">
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
<div id="lagDivs" style="display:none" class="lagDivs">
<label class="field select">
<select name="stateDivision" id="statelagDivision"><option value>Select a sub-division</option>
</select><i class="arrow double"></i>
</label>
</div>
</div>
<div class="search_inputs">
<label class="field prepend-icon" for="textInput">
<input type="text" name="provider" id="textInput" class="gui-input" placeholder="Select Training Provider">
<span class=field-icon><i class="fa fa-user"></i></span>
<span id="output" style="z-index:9999" ><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader"/></span>
</label>
    
<div id="lagMainDivs" style="display:none" class="lagDivs">
<label class="field select">
<select name="stateMainDivision" id="statelagMainDivision" onchange="getLagosSubDivions($(this).val(), 'select#statelagDivision')">
    <option value="">Select a division (Lagos State only)</option>
    <option value="1">Badagry</option>
    <option value="2">Epe</option>
    <option value="3">Ikeja</option>
    <option value="4">Ikorodu</option>
    <option value="5">Lagos</option>
</select><i class="arrow double"></i>
</label>
</div>
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
<label class="field select" id="stateSelect" style="display:none">
<select name="state" id="state" onchange="showLagosDivisions()"><option value>Select state (Nigeria only)</option><?php echo GetState()?>
</select><i class="arrow double"></i>
</label>
</div>
<p><a href="javascript:void(0)" id="use-basic" title="Use Basic Search">Use Basic Search</a></p>
</div>
</form>
</div>
<?php } else{ ?>
<p class="mobile-hide" id="use-advance" style="text-align:left;margin:0px 5px 5px 0px;">Search conferences, training, seminars, courses and workshops in Nigeria and around the world</p>
<div class="basic">
<form action="#" method="post" id="searchform_basic" autocomplete="off" style="width:100%; margin-top:0px;">
<div class="smart-widget sm-right smr-80"> 
<label class="field prepend-icon">
<input type="text" name="sub2" id="evtsearch" class="gui-input" placeholder="Enter keywords to search for events - conferences, training seminars...">
<span  class="field-icon"><i class="fa fa-search"></i></span> 
</label>
<button type="submit" class="button btn-primary"> Search </button>
<span><a href="javascript:void(0)" class="mobile_res" title="Advanced search">Use Advanced search</a></span>
</div>
</form>
<div class="clearfix"></div>
<div id="output_events" style="position:relative; overflow:auto;z-index:9999; margin-top: -5%; border-radius:4px/8px; overflow-wrap: break-word"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader" width="20" height="14" style="text-align:center" /></div>
</div>
<div class="advanced">
<form action="<?php echo SITE_URL;?>search" method="get" id="searchform" autocomplete="off" style="width:auto">
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
<div id="lagDivs" style="display:none" class="lagDivs">
<label class="field select">
<select name="stateDivision" id="statelagDivision"><option value>Select a sub-division</option>
</select><i class="arrow double"></i>
</label>
</div>
</div>
<div class="search_inputs">
<label class="field prepend-icon" for="textInput">
<input type="text" name="provider" id="textInput" class="gui-input" placeholder="Select Training Provider">
<span class=field-icon><i class="fa fa-user"></i></span>
<span id="output" style="z-index:9999" ><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="training search pre-loader"/></span>
</label>
    
<div id="lagMainDivs" style="display:none" class="lagDivs">
<label class="field select">
<select name="stateMainDivision" id="statelagMainDivision" onchange="getLagosSubDivions($(this).val(), 'select#statelagDivision')">
    <option value="">Select a division (Lagos State only)</option>
    <option value="1">Badagry</option>
    <option value="2">Epe</option>
    <option value="3">Ikeja</option>
    <option value="4">Ikorodu</option>
    <option value="5">Lagos</option>
</select><i class="arrow double"></i>
</label>
</div>
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
<label class="field select" id="stateSelect" style="display:none">
<select name="state" id="state" onchange="showLagosDivisions()"><option value>Select state (Nigeria only)</option><?php echo GetState()?>
</select><i class="arrow double"></i>
</label>
</div>
<p><a href="javascript:void(0)" id="use-basic" title="Use Basic Search">Use Basic Search</a></p>
</div>
</form>
</div>
<?php } ?>
<div class="clearfix"></div>
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
<div class="menu_container">
<div style="width:100%; margin-right:auto; margin-left:auto; height:45px; float:left;">
<nav>
<div id="hamburger">
	<a href="<?php echo SITE_URL;?>" id="nav"><i class="fa fa-home fa-2x"></i></a>
	<span id="showNav">Show Navigation</span>
	<i id="menu" class="fa fa-bars fa-3x"></i>
</div>
<ul class="orion-menu petrol mobile-hide" id="main-menu">
<li class="mobile-hide"><a href="<?php echo SITE_URL;?>" title="Home">Home</a></li>
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
	<ul id="dropdown-menu">
		<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>all-event">All Events</a></li>
		<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>events/categories">Events By Category</a></li>
		<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>events/countries">Events By Country</a></li>
		<li><a class="mobile-enabled" data-href="<?php echo SITE_URL;?>nigeria">Events In Nigeria</a></li>
	</ul>
</li>
<li class="mobile-hide"><?php if (strpos($_SERVER['SCRIPT_NAME'],'all-event')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('all-event');?> href="<?php echo SITE_URL;?>all-event" title="All Events">All Events</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'all-event')) echo '</h1>'; ?></li>
<li class="mobile-hide"><?php if (strpos($_SERVER['SCRIPT_NAME'],'training-provider') && !strpos($_SERVER['SCRIPT_NAME'],'cmd-accr-training-providers')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a  <?php if (strpos($_SERVER['SCRIPT_NAME'],'training-provider') && !strpos($_SERVER['SCRIPT_NAME'],'cmd-accr-training-providers')) echo active('training-providers');?>  href="<?php echo SITE_URL;?>training-providers" title="Training providers">Training Providers</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'training-provider') && !strpos($_SERVER['SCRIPT_NAME'],'cmd-accr-training-providers')) echo '</h1>'; ?></li>
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
<li><?php if (strpos($_SERVER['SCRIPT_NAME'],'suppliers')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('suppliers');?>  href="<?php echo SITE_URL;?>suppliers" title="Find Suppliers">Equipment Suppliers</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'suppliers')) echo '</h1>'; ?></li>
<li><?php if (strpos($_SERVER['SCRIPT_NAME'],'venue')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('venues');?>  href="<?php echo SITE_URL;?>venues" title="Find Event Venue ">Event Venue Providers</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'venues')) echo '</h1>'; ?></li>
<li><?php if (strpos($_SERVER['SCRIPT_NAME'],'manager')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('event-managers');?>  href="<?php echo SITE_URL;?>event-managers" title="Event Managers">Event Managers</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'manager')) echo '</h1>'; ?></li>
<li><?php if (strpos($_SERVER['SCRIPT_NAME'],'facilitator')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('facilitators');?>  href="<?php echo SITE_URL;?>facilitators" title="Facilitators">Facilitators</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'facilitators')) echo '</h1>'; ?></li>

<li><?php if (strpos($_SERVER['SCRIPT_NAME'],'advertise')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('advertise');?> href="<?php echo SITE_URL;?>advertise" title="Advertise">Advertise with Us</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'advertise')) echo '</h1>'; ?></li>
<li><?php if (strpos($_SERVER['SCRIPT_NAME'],'premium-listing')) echo '<h1 style="font-weight:normal;font-size: 14px;">'; ?><a <?php echo active('premium-listing');?> href="<?php echo SITE_URL;?>premium-listing" title="Premium Listing">Premium Listing</a><?php if (strpos($_SERVER['SCRIPT_NAME'],'premium-listing')) echo '</h1>'; ?></li>
<li class="mobile-hide more">
			<div class="icon-menu">
				<span id="menu-text">More Menu</span>
        <i class="fa fa-bars fa-2x"></i>
      </div>
</li>
</ul>
</nav>
<div>
<div class="clearfix"></div>
</div>
</div>		
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</header>
