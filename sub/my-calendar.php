<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
include("../calendar/calendar.php");
$message = '';

if(!isset($_SESSION['login_subcriber']) && ($_SESSION['login_subcriber'] != true)){
	//redirect back to login page if login session is not set
	header("location:".SITE_URL."login");
	exit;
}
	
$result = MysqlSelectQuery("select * from events a, my_events b WHERE b.subscriber_id = '".$_SESSION['user_id']."' and a.event_id = b.event_id ");

if(!isset($_GET['month'])) $month = 01; else $month = $_GET['month'];

$advert = "Training Providers";
$cal = new Calendar($_SESSION['user_id']);
?>
<!DOCTYPE html >

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title>My Events | Nigerian Seminars and Trainings</title>
<meta name="description" content="" />
<meta property="og:image" content=""/>
<meta property="og:image:type" content="image/jpeg"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>

   <?php include("../scripts/headers_new.php");?>
   <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
   <?php echo $cal->headers();?>
   <script>
$(document).ready(function(){

	/* default settings */
	$('.venobox').venobox(); 


	/* open content with custom settings */
	$('.calendar').venobox({
		framewidth: '80%',
		frameheight: 'auto',
		border: '6px',
		bordercolor: '#ba7c36',
		numeratio: true
	});

	/* auto-open #firstlink on page load */
	$("#firstlink").venobox().trigger('click');
	
	
	$('#year_change').change(function(e) {
        window.location='my-calendar?month=<?php echo $month;?>&year='+$(this).val();
    });
});
</script>

<style>

@import url(http://fonts.googleapis.com/css?family=Open+Sans);

div#calendar{
  margin:0px auto;
  padding:0px;
  width: 702px;
  font-family:"Open Sans", Times, serif;
}
 
div#calendar div.box{
    position:relative;
    top:0px;
    left:0px;
    width:100%;
    height:40px;
    background-color:   #787878 ;      
}
 
div#calendar div.header{
    line-height:40px;  
    vertical-align:middle;
    position:absolute;
    left:11px;
    top:0px;
    width:682px;
    height:40px;   
    text-align:center;
}
.months_header{
	width:100%;
	height:40px;
	background-color: #838383;
	color:#FFFFFF;
	font-size:12px;
 }
.months_header ul{
	display:block;
	list-style:none;
	width:auto;
	padding:3px;
	text-align:center;
}
.months_header ul li{
	display:block;
	padding:3px;
	margin-right:1%;
	width:6%;
	float:left;
}
.months_header ul li a{
	color:#FFFFFF;
	text-decoration:none;
}
div#calendar div.header a.prev,div#calendar div.header a.next{ 
    position:absolute;
    top:0px;   
    height: 17px;
    display:block;
    cursor:pointer;
    text-decoration:none;
    color:#FFF;
}
 
div#calendar div.header span.title{
    color:#FFF;
    font-size:18px;
}
 
 
div#calendar div.header a.prev{
    left:0px;
}
 
div#calendar div.header a.next{
    right:0px;
}
 
 
 
 
/*******************************Calendar Content Cells*********************************/
div#calendar div.box-content{
    border:1px solid #787878 ;
    border-top:none;
}
 
 
 
div#calendar ul.label{
    float:left;
    margin: 0px;
    padding: 0px;
    margin-top:5px;
    margin-left: 5px;
	width:100%;
	display:block;
}
 
div#calendar ul.label li{
    margin:0px;
    padding:0px;
    margin-right:5px;  
    float:left;
    list-style-type:none;
    width:80px;
    height:40px;
    line-height:40px;
    vertical-align:middle;
    text-align:center;
    color:#000;
    font-size: 15px;
    background-color: transparent;
}
 
 
div#calendar ul.dates{
    float:left;
    margin: 0px;
    padding: 0px;
    margin-left: 5px;
    margin-bottom: 5px;
	
}
 div#calendar ul.dates li{
	 list-style-type:none;
	 float:left;
	 vertical-align:middle;
 }
/** overall width = width+padding-right**/
div#calendar ul.dates li a{
	margin:0px;
	padding:6px;
	/*margin-right:5px;
	margin-top: 5px;*/
	line-height:50px;
	float:left;
	width:100px;
	height:100px;
	font-size:28px;
	background-color: #FCFCFC;
	color:#000;
	text-align:center;
	border: 1px solid #DDD;
	cursor:pointer;
	text-decoration:none;
}
 div#calendar ul.dates li a:hover{
	border:1px solid #f3f3f3;
	-webkit-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	-moz-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	background-color:#F5F5F5;
 }
:focus{
    outline:none;
}
 
div.clear{
    clear:both;
}   
.event_count{
	width:100%;
	background-color:#E0E0E0;
	font-size:12px;
	padding:0px;
	line-height:25px;
	height:25px;
}
.today{
	background-color:#FFFFCC;
	text-decoration:underline;
}
.day_of_week{
	height:20px;
	font-size:12px;
	line-height:20px;
	padding:3px;
	color: #666;
	background-color: #F5F5F5;
}
.testCalendar{
	display:block;
	padding:10px;
	margin-bottom:3%;
	width:100%;
	border:1px solid #f3f3f3;
	-webkit-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	-moz-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	background-color:#F5F5F5;
	font-family:"Open Sans", Times, serif;
}
.testCalendar .providerImg{
	height:150px;
	width:100%;
	line-height:50px;
	float:left;
}
.testCalendar .clear{
	clear:both;
}
.testCalendar .providerImg img{
	vertical-align:middle;
	margin-top:50%;
	border:2px solid #999999;
	height: 60px;
	width: 60px;
}
.testCalendar .title{
	float:left;
	padding-left: 2%;
	width:92%;
	margin-bottom:3%;
}
.testCalendar .description{
	float:left;
	padding-left: 2%;
	width:92%;
	font-size:12px;
	text-align:justify;
}
.testCalendar .title h2{
	font-size:14px;
	margin:0px;
	text-align:center;
}
.testCalendar .icons{
	float:left;
	padding-left: 2%;
	width:92%;
	font-size:12px;
	text-align:center;
}
.testCalendar .icons ul{
	display:block;
	list-style:none;
	width:auto;
	padding:3px;
}
.testCalendar .icons ul li{
	display:block;
	padding:3px;
	margin-right:5px;
}
.pageHeader{
    line-height:40px;  
    width:100%;
    height:40px;   
    text-align:center;
	background-color: #787878 ;
	border:1px solid #f3f3f3;
	-webkit-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	-moz-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	font-family:"Open Sans", Times, serif;
	margin-bottom:5px;
	color:#FFFFFF;
}
.img-circle{border-radius:50%}
.alert-danger {
    color: #A94442;
    background-color: #F2DEDE;
    border-color: #EBCCD1;
}
.alert {
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
}
</style>
	
</head>

<body>
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript" src="https://d31qbv1cthcecs.cloudfront.net/atrk.js"></script><script type="text/javascript">_atrk_opts = { atrk_acct: "BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com"}; atrk ();</script><noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


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

<noscript>
<div style="display:none;">
<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>
</div>
</noscript>
<!-- End Quantcast tag -->

<?php include("../tools/header_new.php");?>
<div id="main">
	
	<div id="content">
	<?php include("menu.php");?>
	  <div id="content_left">
				<div id="subpage">
               
					<?php echo $cal->show();?>
					
				</div>
                    
                    
		  </div>
		</div><!-- end subpage -->
					<?php include("../tools/side-menu_new.php");?>
		</div>
		<div class="clearfix"></div>
		
	</div>

	<div class="clearfix"></div>
</div>
	
	
	
</div>

</div>
<?php include ("../tools/footers_new.php");?>
<script>
       $(document).ready(function() {
            $("#hamburger").click(function(e) {
            $("#showNav").text()=='Show Navigation' ? $("#showNav").text('Hide Navigation') : $("#showNav").text('Show Navigation');
            $("#main-menu").toggleClass("mobile-hide");
        });
        $(".mobile-show > a").click(function(e) {
            e.preventDefault();
            $(this).parent().children("ul").toggle();
        });

    });
</script>
</body>
</html>