<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
include 'calendar.php';
 
$calendar = new Calendar(1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- Add jQuery library -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<!-- Add venobox -->
<!--<link rel="stylesheet" href="bootstrap.min.css" type="text/css" media="screen" />-->
<link rel="stylesheet" href="font-awesome/css/font-awesome.css" type="text/css" media="screen" />
<link rel="stylesheet" href="venobox/venobox.css" type="text/css" media="screen" />
<script type="text/javascript" src="venobox/venobox.min.js"></script>
<style>

@import url(http://fonts.googleapis.com/css?family=Open+Sans);
a,ul,li,div,span,p,table{
	margin:0px;
	padding:0px;
}
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
	margin-bottom:7px;
	width:100%;
	height:170px;
	border:1px solid #f3f3f3;
	-webkit-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	-moz-box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	box-shadow:0 0 1px 0 rgba(50,50,50,0.57);
	background-color:#F5F5F5;
	font-family:"Open Sans", Times, serif;
}
.testCalendar .providerImg{
	height:150px;
	width:60px;
	line-height:50px;
	float:left;
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
	margin-bottom:3px;
}
.testCalendar .description{
	float:left;
	padding-left: 2%;
	width:92%;
	font-size:12px;
	text-align:justify;
}
.testCalendar .title h2{
	font-size:18px;
	margin:0px;
}
.testCalendar .icons{
	float:left;
	padding-left: 2%;
	width:92%;
	font-size:12px;
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
	float:left;
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
<?php 
echo $calendar->show();
?>
</body>
<script>
$(document).ready(function(){

	/* default settings */
	$('.venobox').venobox(); 


	/* open content with custom settings */
	$('.calendar').venobox({
		framewidth: '68%',
		frameheight: 'auto',
		border: '6px',
		bordercolor: '#ba7c36',
		numeratio: true
	});

	/* auto-open #firstlink on page load */
	$("#firstlink").venobox().trigger('click');
});
</script>
</html>