<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");

if(connection());
$advert = "Articles";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include('tools/analytics.php');?>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title>Search <?php echo $_GET['query'];?> : Nigerian Seminars and Trainings.com</title>
<meta name="description" content="Use this tool to search, find and register for conferences, training seminars, workshops and short courses in Nigeria and around the world."/>

	 <meta name="dcterms.description" content="Use this tool to search, find and register for conferences, training seminars, workshops and short courses in Nigeria and around the world." />

<meta property="og:title" content="Search <?php echo $_GET['query'];?> : Nigerian Seminars and Trainings.com" />

<meta property="og:description" content="Use this tool to search, find and register for conferences, training seminars, workshops and short courses in Nigeria and around the world." />

<meta property="twitter:title" content="Search <?php echo $_GET['query'];?> : Nigerian Seminars and Trainings.com" />

<meta property="twitter:description" content="Use this tool to search, find and register for conferences, training seminars, workshops and short courses in Nigeria and around the world." />
    
	<?php include("scripts/headers_new.php");?>

	
</head>

<body>

<?php include("tools/header_new.php");?>
<div id="main">
	
	<div id="content">
		<div id="content_left">
        <div class="event_table_inner" style="border:solid 1px #066;">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;">Search result for <?php echo $_GET['query'];?></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>

        	<div id="cse" style="width: 100%;">Loading</div>
<script>
  (function() {
    var cx = '008762585795982436656:j-elypmn3nm';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:searchresults-only></gcse:searchresults-only>

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
	  </div>
		
		<?php 
		if(connection());
		include("tools/side-menu_new.php");?>
	</div>
	
	<div class="clearfix"></div>
</div>
	
	
	
</div>
</div>
<?php include ("tools/footer_new.php");?>

</body>
</html>