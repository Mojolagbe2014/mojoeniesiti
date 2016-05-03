<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
 <script type="text/javascript" src="css/smartforms/js/jquery-1.9.1.min.js"></script>
<style type="text/css">
a{
	padding:0px;
	margin:0px;
}
.inputBox {
	width: 270px;
	border: thin solid #060;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
}
.inputBox input {
	float: left;
	height: 20px;
	width: 200px;
	border:none;
}
.clear {
	clear: both;
}
.inputBox a {
	display: block;
	height: 20px;
	padding-left: 10px;
	float: left;
	color: #FFF;
	background-color: #CCC;
}
</style>
<script type="text/javascript">
$(document).ready(function(e) {
   $('#email').keypress(function(e){
	   var val = $(this).val().length;
	   if(val > 0){
		  $('#forgot').text('?');
	   }
	   else{
		    $('#forgot').text('Forgot ?');
	   }
   });
 /* $('#email').keyup(function(e){
	   if($(this).length == 0){
		   $('#forgot').text('Forgot ?');
	   }
  });*/
});
</script>
</head>

<body>

<div class="inputBox">
<input name="" type="text" placeholder="Email" id="email"/><a href="#" id="forgot">Forgot</a>
<div class="clear"></div>
</div>
</body>
</html>