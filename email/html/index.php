<?php
require_once("../../scripts/config.php");
require_once("../../scripts/functions.php");
$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where premium > 0");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Email Template - Classic</title>
<style type="text/css">
a:hover { text-decoration: underline !important; }
</style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #F4F4F4;" bgcolor="#f7f2e4" leftmargin="0">
<!--100% body table-->
<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#F4F4F4">
  <tr>
    <td>
	<!--top links-->
	 <table bgcolor="#fff" cellspacing="0" border="0" align="center" cellpadding="30" style="max-width:684px; width:100%;">
	<tr>
	  <td valign="middle" align="center" height="5" style="font-size:12px;"></td>
	  </tr>
	<tr>
		<td valign="middle" align="center" height="15" style="font-size:12px;"><img src="images/nst_hotel.gif" width="630" height="79"></td>
	</tr>
</table>
   <!--header-->
   <table style="background-repeat: no-repeat; background-position: center; background-color:#F4F4F4; max-width:684px; width:100%;" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    <td><img border="0" height="155" alt="" style="border:none; outline:none; text-decoration:none; max-width:100%; height:auto;" src="../../images/email_logo.png" class="logo"></td>
    </tr>
</table>
	</td>
    </tr>
</table><!--/header-->
    <!--email container-->
    <table bgcolor="#fff" cellspacing="0" border="0" align="center" cellpadding="30" style="max-width:684px; width:100%;">
  <tr>
    <td>
    <!--email content-->
    <table cellspacing="0" border="0" id="email-content" cellpadding="0" style=" width:91.4956%;">
  <tr>
    <td>
    <!--section 1-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td valign="top" style="text-align:justify;">
	<span style="text-align:center; font-weight:bold; display:block; padding:4px;">Subject</span>
    <p style="font-size: 12px; line-height: 22px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px;">Consectetur adipiscing elit. <a style="color: #bc1f31; text-decoration: none;" href="#">Phasellus</a> a ipsum a risus volutpat placerat in nec mauris. Fusce sit amet enim erat, in sagittis arcu. <a style="color: #bc1f31; text-decoration: none;" href="#">Aliquam dolor dolor</a>, semper id tempor et, varius pulvinar tellus. Maurtis commodo urna at dui bibendum quis euismod velit egestas. Vestibulum ante ipsum primis in faucibus orci luctus et.</p>
    </td>
  </tr>
</table><!--/section 1-->
<!--line break-->
 <!-- <table cellspacing="0" border="0" cellpadding="0" width="100%" style="margin-top:5px;">
  <tr>
    <td height="28"><img src="images/line-break.jpg"  height="27">
    </td>
  </tr>
</table>--><!--/line break-->
    <!--section 2-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td>
    <table cellspacing="0" border="0" cellpadding="8" width="100%" style="margin-top:10px;">
  <tr>
    <td valign="top">
    <table style="max-width:680px; width:99.7067%;" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="35%" valign="top">&nbsp;</td>
    <td width="11%" align="center" valign="top"><a href="https://www.facebook.com/nigerianseminars" style="text-decoration:none;"><img src="../../images/facebook7.png" width="32" height="32" longdesc="http://#"></a><span style="font-size:11px; text-align:center;">Facebook</span></td>
    <td width="10%" valign="top"><a href="http://www.pinterest.com/nigerianseminar/" style="text-decoration:none;"><img src="../../images/pinterest6.png" width="32" height="32" longdesc="http://#"></a><span style="font-size:11px; text-align:center;">Pinterest</span></td>
    <td width="9%" valign="top"><a href="https://twitter.com/NigerianSeminar" style="text-decoration:none;" ><img src="../../images/social71.png" width="32" height="32" longdesc="http://#"></a><span style="font-size:11px; text-align:center;">Twitter</span></td>
    <td width="11%" align="center" valign="top"><a href="https://plus.google.com/+nigerianseminarsandtrainings" style="text-decoration:none;" ><img src="../../images/social5.png" width="32" height="32" longdesc="http://#"></a><span style="font-size:11px; text-align:center;">Google +</span></td>
    <td width="24%" valign="top"><a href="https://plus.google.com/+nigerianseminarsandtrainings" style="text-decoration:none;" ><img src="../../images/rss.png" width="32" height="32" longdesc="http://#"></a><span style="font-size:11px; display:block;">RSS</span></td>
  </tr>
	</table>
    
    <div style="text-align:center; display:block;padding:5px;  font-size:14px; font-family: Georgia, 'Times New Roman', Times, serif;">
    <a href="http://www.jdoqocy.com/dp101ft1zt0GONQNQQNGIHONOHLM?sid=NST" target="_blank" onmouseover="window.status='http://www.vayama.com';return true;" onmouseout="window.status=' ';return true;">
<img src="http://www.tqlkg.com/jk122iw-ousDLKNKNNKDFELKLEIJ" alt="Today's best prices on international flights!" border="0"/></a>
                              </div>
    
    <div style="text-align:center; display:block;padding:10px;  font-size:14px; font-family: Georgia, 'Times New Roman', Times, serif; line-height:30px;">
     <a href="#" style="margin:0 5px 0 5px; text-decoration: none; color:#000000;">Visit Our Website &nbsp;&nbsp;&nbsp;|</a> 
                                 <a href="#" style="margin:0 5px 0 5px; text-decoration: none; color:#000000;">Contact Us &nbsp; |</a> 
                                 <a href="#" style="margin:0 5px 0 5px; text-decoration: none; color:#000000;">Advertise &nbsp; |</a>  
                                 <a href="#" style="margin:0 5px 0 5px; text-decoration: none; color:#000000;">Subscribe</a> 
                              </div>
   <h1 style="font-size: 20px; font-weight: normal; color: #00A859; font-family: Georgia, 'Times New Roman', Times, serif; margin-top: 15px; margin-bottom: 17px;"><img src="../../images/email_title.png" ></h1>
    <?php
	 while($biz_name = SqlArrays($business)){
		 ?>
         <a href="#" style="width:138px; margin:0 6px 0 6px; display:block; float:left; height:170px; text-decoration:none;">
  
    <p style="font-size: 17px; line-height: 22px; font-family: Georgia, 'Times New Roman', Times, serif; color: #333; margin: 0px; text-align:center;"><img src="<?php echo SITE_URL.'premium/logos/thumbs/'.$biz_name['logos'];?>" height="80" alt="img2" style="border: solid 1px #FFF; box-shadow: 1px 1px 5px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 1px 1px 5px #333; -moz-box-shadow: 1px 1px 5px #333;" width="80" /></p>
    <p style="color: #333333; font-size: 11px; font-family: Georgia, 'Times New Roman', Times, serif; margin: 12px 0px; font-weight: bold; text-align:center;">Lorem ipsum dolor sit amet</p>

    </a>
	<?php
	 }
	 ?>
    </td>
    
    
  </tr>
</table>
    </td>
  </tr>
</table><!--/section 2-->
    
    </td>
  </tr>
</table><!--/email content-->
    </td>
  </tr>
</table><!--/email container-->
<!--footer-->
    <table style="max-width:680px; width:99.7067%;" border="0" align="center" cellpadding="10" cellspacing="0">
 
  <tr>
    <td colspan="6" valign="top">
    <p style="font-size: 14px; font-family: Georgia, 'Times New Roman', Times, serif; color: #000; margin: 0px; text-align:center;"> 18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria</p>
          </td>
    </tr>
  <tr>
    <td colspan="6" valign="top"> <p style="font-size: 14px; font-family: Georgia, 'Times New Roman', Times, serif; color: #000; margin: 0px; text-align:center;">
        You’re receiving this newsletter because you’ve subscribed to our newsletter. Please add info@nigerianseminarsandtrainings.com to your email address book to ensure delivery.<br> 
        Not interested anymore? <a style="color: #bc1f31; text-decoration: none;" href="#">Unsubscribe instantly.</a> | <a href="'.SITE_URL.'forwardTofriend?user='.$to.'&token='.md5($to).'&msgid='.$msgID.'&action=sendtofriend&seq='.md5('sendtofriend').'" style="color:#090; text-decoration:none">Send to a friend</a></p></td>
  </tr>
  <tr>
  	<td height="30" colspan="4"></td>
  	<td height="30" colspan="2"></td>
  	</tr>
	</table><!--/footer-->
    </td>
  </tr>
</table><!--/100% body table-->
</body>
</html>