<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$msg = '';
if(connection());
$recordperpage =  20;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];
	}
	$offset = ($pagenum - 1) * $recordperpage;
$result = MysqlSelectQuery("select * from businessinfo where business_type = 'Suppliers' and status=1 order by premium desc, business_name limit $offset , $recordperpage");

//  Copyright 2009 Google Inc. All Rights Reserved.
 /* $GA_ACCOUNT = "MO-38908551-1";
  $GA_PIXEL = "ga.php";

  function googleAnalyticsGetImageUrl() {
    global $GA_ACCOUNT, $GA_PIXEL;
    $url = "";
    $url .= $GA_PIXEL . "?";
    $url .= "utmac=" . $GA_ACCOUNT;
    $url .= "&utmn=" . rand(0, 0x7fffffff);

    $referer = $_SERVER["HTTP_REFERER"];
    $query = $_SERVER["QUERY_STRING"];
    $path = $_SERVER["REQUEST_URI"];

    if (empty($referer)) {
      $referer = "-";
    }
    $url .= "&utmr=" . urlencode($referer);

    if (!empty($path)) {
      $url .= "&utmp=" . urlencode($path);
    }

    $url .= "&guid=ON";

    return $url;
  }*/
?>
<!DOCTYPE html >
<html lang="en">
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<!-- Website Title --> 
<title>Searching: <?php if(isset($_GET['query'])) echo $_GET['query'];?></title>
<!-- Meta data for SEO -->
<meta name="description" content=""/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
<link rel="stylesheet" href="css/screen.css" type="text/css" media="all"/>

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/custom.js"></script>


<style type="text/css">
  .gsc-control-cse {
    font-family: Arial, sans-serif;
    border-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gsc-control-cse .gsc-table-result {
    font-family: Arial, sans-serif;
  }
  .gsc-tabHeader.gsc-tabhInactive {
    border-color: #CCCCCC;
    background-color: #FFFFFF;
  }
  .gsc-tabHeader.gsc-tabhActive {
    border-color: #CCCCCC;
    border-bottom-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gsc-tabsArea {
    border-color: #CCCCCC;
  }
  .gsc-webResult.gsc-result,
  .gsc-results .gsc-imageResult {
    border-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gsc-webResult.gsc-result:hover,
  .gsc-imageResult:hover {
    border-color: #FFFFFF;
    background-color: #FFFFFF;
  }
  .gs-webResult.gs-result a.gs-title:link,
  .gs-webResult.gs-result a.gs-title:link b,
  .gs-imageResult a.gs-title:link,
  .gs-imageResult a.gs-title:link b {
    color: #1155CC;
  }
  .gs-webResult.gs-result a.gs-title:visited,
  .gs-webResult.gs-result a.gs-title:visited b,
  .gs-imageResult a.gs-title:visited,
  .gs-imageResult a.gs-title:visited b {
    color: #1155CC;
  }
  .gs-webResult.gs-result a.gs-title:hover,
  .gs-webResult.gs-result a.gs-title:hover b,
  .gs-imageResult a.gs-title:hover,
  .gs-imageResult a.gs-title:hover b {
    color: #1155CC;
  }
  .gs-webResult.gs-result a.gs-title:active,
  .gs-webResult.gs-result a.gs-title:active b,
  .gs-imageResult a.gs-title:active,
  .gs-imageResult a.gs-title:active b {
    color: #1155CC;
  }
  .gsc-cursor-page {
    color: #1155CC;
  }
  a.gsc-trailing-more-results:link {
    color: #1155CC;
  }
  .gs-webResult .gs-snippet,
  .gs-imageResult .gs-snippet,
  .gs-fileFormatType {
    color: #333333;
  }
  .gs-webResult div.gs-visibleUrl,
  .gs-imageResult div.gs-visibleUrl {
    color: #009933;
  }
  .gs-webResult div.gs-visibleUrl-short {
    color: #009933;
  }
  .gs-webResult div.gs-visibleUrl-short {
    display: none;
  }
  .gs-webResult div.gs-visibleUrl-long {
    display: block;
  }
  .gs-promotion div.gs-visibleUrl-short {
    display: none;
  }
  .gs-promotion div.gs-visibleUrl-long {
    display: block;
  }
  .gsc-cursor-box {
    border-color: #FFFFFF;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-page {
    border-color: #CCCCCC;
    background-color: #FFFFFF;
    color: #1155CC;
  }
  .gsc-results .gsc-cursor-box .gsc-cursor-current-page {
    border-color: #CCCCCC;
    background-color: #FFFFFF;
    color: #1155CC;
  }
  .gsc-webResult.gsc-result.gsc-promotion {
    border-color: #F6F6F6;
    background-color: #F6F6F6;
  }
  .gsc-completion-title {
    color: #1155CC;
  }
  .gsc-completion-snippet {
    color: #333333;
  }
  .gs-promotion a.gs-title:link,
  .gs-promotion a.gs-title:link *,
  .gs-promotion .gs-snippet a:link {
    color: #1155CC;
  }
  .gs-promotion a.gs-title:visited,
  .gs-promotion a.gs-title:visited *,
  .gs-promotion .gs-snippet a:visited {
    color: #1155CC;
  }
  .gs-promotion a.gs-title:hover,
  .gs-promotion a.gs-title:hover *,
  .gs-promotion .gs-snippet a:hover {
    color: #1155CC;
  }
  .gs-promotion a.gs-title:active,
  .gs-promotion a.gs-title:active *,
  .gs-promotion .gs-snippet a:active {
    color: #1155CC;
  }
  .gs-promotion .gs-snippet,
  .gs-promotion .gs-title .gs-promotion-title-right,
  .gs-promotion .gs-title .gs-promotion-title-right *  {
    color: #333333;
  }
  .gs-promotion .gs-visibleUrl,
  .gs-promotion .gs-visibleUrl-short {
    color: #009933;
  }</style> 
</head>


<body>
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-23693392-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];
(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-2fH5lI6K2ceJA"
});
</script>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none"  alt="Alexa tracker" /></noscript>
<!-- End Alexa Certify Javascript -->

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
		<?php include("script/header_file.php"); ?>
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                
                <h1 class="title"><strong>Search Result</strong></h1>
                <div class="pageInner">
                        	<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'en', style : google.loader.themes.V2_DEFAULT});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};
    var orderByOptions = {};
    orderByOptions['keys'] = [{label: 'Relevance', key: ''},{label: 'Date', key: 'date'}];
    customSearchOptions['enableOrderBy'] = true;
    customSearchOptions['orderByOptions'] = orderByOptions;  var customSearchControl = new google.search.CustomSearchControl(
      '018023445614497645993:gdef74n3eik', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.enableSearchResultsOnly(); 
    customSearchControl.draw('cse', options);
    function parseParamsFromUrl() {
      var params = {};
      var parts = window.location.search.substr(1).split('\x26');
      for (var i = 0; i < parts.length; i++) {
        var keyValuePair = parts[i].split('=');
        var key = decodeURIComponent(keyValuePair[0]);
        params[key] = keyValuePair[1] ?
            decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
            keyValuePair[1];
      }
      return params;
    }

    var urlParams = parseParamsFromUrl();
    var queryParamName = "query";
    if (urlParams[queryParamName]) {
      customSearchControl.execute(urlParams[queryParamName]);
    }
  }, true);
</script>

  </div>
               <div class="search">
                <h1 class="title">Search Events</h1>
		      <form action="search" id="search_form" name="search_form" method="get">
		        <p>
		          <input type="text" id="query" name="query" title="Search" class="search"/><input type="submit" class="button_dark" value="Search"/>
	            </p>
	          </form>
              
	        </div>
            <br class="clear"/>
                </div>
                <?php
				include("script/footer_menu.php");
				?>
              
	</div>
	<!-- End page wrapper -->
	
</body>
</html>