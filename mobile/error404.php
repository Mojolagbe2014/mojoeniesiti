<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
  <meta http-equiv="content-language" content="en">
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico"/>
 
<!-- Website Title --> 
<title>Error Page</title>

<!-- Meta data for SEO -->
<meta name="description" content="Error Page"/>
<meta name="keywords" content=""/>

<!-- Template stylesheet -->
<link rel="stylesheet" href="http://m.nigerianseminarsandtrainings.com/css/screen.css" type="text/css" media="all"/>

<!-- Jquery and plugins -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.img.preload.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

</head>
<body>

	<!-- Begin page wrapper -->
	<div id="wrapper">
		
<?php include("script/header_file.php"); ?>
		
		
		<div id="content_wrapper">
			<div class="inner">
				<div id="content" class="rounded">
                <h1 class="title">Error Page</h1>
                 <h4 style="font-size:20px;">Sorry! The page you requested no longer exists or page has been moved!<br />
					    Please continue your search from here.</h4>
                  <div class="search">
                <h2 class="title">Search Events</h2>
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