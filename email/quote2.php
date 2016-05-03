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
	 <table bgcolor="#fff" cellspacing="0" border="0" align="center" style="max-width:684px;">
	<tr>
	  <td valign="middle" align="center" height="5" style="font-size:12px;"></td>
	  </tr>
	<tr>
		<td valign="middle" align="center" height="15" style="font-size:12px;">&nbsp;</td>
	</tr>
</table>
   <!--header-->
   <table style="background-repeat: no-repeat; background-position: center; background-color:#F4F4F4;" width="684" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
    <td><a href="'.SITE_URL.'" style="text-decoration:none;"><img width="684" border="0" height="155" alt="" style="border:none; outline:none; text-decoration:none;" src="'.SITE_URL.'images/email_logo.png" class="logo"></a></td>
    </tr>
</table>
	</td>
    </tr>
</table><!--/header-->
    <!--email container-->
    <table bgcolor="#fff" cellspacing="0" border="0" align="center" cellpadding="30" width="684">
  <tr>
    <td>
    <!--email content-->
    <table cellspacing="0" border="0" id="email-content" cellpadding="0" width="624">
  <tr>
    <td>
    <!--section 1-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td valign="top" style="text-align:justify;">
	<span style="font-weight:bold; display:block; padding:4px 4px 4px 0; font-size:16px;">'.$subject.'</span><br />
    <p style="font-size: 12px; line-height: 22px; font-family: Georgia, \'Times New Roman\', Times, serif; color: #333; margin: 0px;">';
	$message.= $innerMsg;
	$message.= '</p>
    </td>
  </tr>
</table><!--/section 1-->
<!--line break-->
 <!--/line break-->
    <!--section 2-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%">
  <tr>
    <td>
    <table cellspacing="0" border="0" cellpadding="8" width="100%" style="margin-top: 5px;">
  <tr>
    <td valign="top">
	<table style="max-width:680px; width:99.7067%;" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="35%" valign="top">&nbsp;</td>
    <td width="11%" align="center" valign="top"><a href="https://www.facebook.com/nigerianseminars" style="text-decoration:none;"><img src="'.SITE_URL.'images/facebook7.png" width="32" height="32" ></a><span style="font-size:11px; text-align:center;">Facebook</span></td>
    <td width="10%" valign="top"><a href="http://www.pinterest.com/nigerianseminar/" style="text-decoration:none;"><img src="'.SITE_URL.'images/pinterest6.png" width="32" height="32" ></a><span style="font-size:11px; text-align:center;">Pinterest</span></td>
    <td width="9%" valign="top"><a href="https://twitter.com/NigerianSeminar" style="text-decoration:none;" ><img src="'.SITE_URL.'images/social71.png" width="32" height="32" ></a><span style="font-size:11px; text-align:center;">Twitter</span></td>
    <td width="11%" align="center" valign="top"><a href="https://plus.google.com/+nigerianseminarsandtrainings" style="text-decoration:none;" ><img src="'.SITE_URL.'images/social5.png" width="32" height="32" longdesc="http://#"></a><span style="font-size:11px; text-align:center;">Google +</span></td>
    <td width="24%" valign="top"><a href="https://plus.google.com/+nigerianseminarsandtrainings" style="text-decoration:none;" ><img src="'.SITE_URL.'images/rss.png" width="32" height="32" ></a><span style="font-size:11px; display:block;">RSS</span></td>
  </tr>
	</table>
	
	<div style="text-align:center; display:block;padding:5px;  font-size:14px; font-family: Georgia, \'Times New Roman\', Times, serif;">
  <a href="http://www.nsthotels.com/" target="_blank" rel="nofollow"><img src="https://assets.portalhc.com/banners/affiliate/en/simple_468x60.gif?cdn=3" alt="Finding the right hotel just got a whole lot easier - www.hotelscombined.com" title="Finding the right hotel just got a whole lot easier - www.hotelscombined.com" border="0" /></a>
                              </div>
	
	 <div style="text-align:center; display:block; padding:10px;  font-size:14px; font-family: Georgia, \'Times New Roman\', Times, serif; line-height:30px;">
     <a href="'.SITE_URL.'" style="margin:0 5px 0 5px; text-decoration: none; color:#000000;">Visit site &nbsp;&nbsp;&nbsp;| </a> 
                                 <a href="'.SITE_URL.'contact-us" style="margin:0 3px 0 3px; text-decoration: none; color:#000000;">Contact Us &nbsp; |</a> 
                                 <a href="'.SITE_URL.'advertise" style="margin:0 3px 0 3px; text-decoration: none; color:#000000;">Advertise &nbsp; | </a>  
                                 <a href="'.SITE_URL.'subscribers" style="margin:0 3px 0 3px; text-decoration: none; color:#000000;">Subscribe | </a> 
								 <a href="http://blog.nigerianseminarsandtrainings.com/" style="margin:0 3px 0 3px; text-decoration: none; color:#000000;">Blog | </a> 
								  <a href="http://forum.nigerianseminarsandtrainings.com/" style="margin:0 3px 0 3px; text-decoration: none;color:#000000;">Forum | </a> 
								  <a href="http://www.nsthotels.com/" style="margin:0 3px 0 3px; text-decoration: none;color:#000000;">Find Hotels</a> 
                                 </div>
	
   <h1 style="font-size: 20px; font-weight: normal; color: #00A859; font-family: Georgia, \'Times New Roman\', Times, serif; margin-top: 10px; margin-bottom: 17px;"><img src="'.SITE_URL.'images/email_title.png" ></h1>';
$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where premium = 3 and status = 1 and logos != '' order by rand()");
	 while($biz_name = SqlArrays($business)){
		 
		$url = SITE_URL.'tprovider/'.$biz_name['business_id'].'/'.str_replace($title_link,"-",$biz_name['business_name']);
		 
		
         $message.= '<a href="'.$url.'" style="width:138px; margin:0 6px 0 6px; display:block; float:left; height:170px; text-decoration:none;">
  
    <p style="font-size: 17px; line-height: 22px; font-family: Georgia, \'Times New Roman\', Times, serif; color: #333; margin: 0px; text-align:center;"><img src="'.SITE_URL.'premium/logos/thumbs/'.$biz_name['logos'].'" height="80" alt="img2" style="border: solid 1px #FFF; box-shadow: 1px 1px 5px #333; -webkit-box-shadow: 2px 2px 6px #333; -khtml-box-shadow: 1px 1px 5px #333; -moz-box-shadow: 1px 1px 5px #333;" width="80" /></p>
    <p style="color: #333333; font-size: 11px; font-family: Georgia, \'Times New Roman\', Times, serif; margin: 12px 0px; font-weight: bold; text-align:center;">'.$biz_name['business_name'].'</p>

    </a>';
	
	 }
	
   $message.=' </td>
    
    
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
    <p style="font-size: 14px; font-family: Georgia, \'Times New Roman\', Times, serif; color: #000; margin: 0px; text-align:center;"> 18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria</p>
          </td>
    </tr>
  <tr>
    <td colspan="6" valign="top"> <p style="font-size: 14px; font-family: Georgia, \'Times New Roman\', Times, serif; color: #000; margin: 0px; text-align:center;">
        You’re receiving this newsletter because you’ve subscribed to our newsletter. Please add info@nigerianseminarsandtrainings.com to your email address book to ensure delivery.<br> 
        Not interested anymore? <a style="color: #bc1f31; text-decoration: none;" href="'.SITE_URL.'unsubscribe?user='.$to.'&token='.md5($to).'">Unsubscribe instantly.</a><br><a href="'.SITE_URL.'forwardTofriend?user='.$to.'&token='.md5($to).'&msgid='.$msgID.'&action=sendtofriend&seq='.md5('sendtofriend').'" style="color:#090; text-decoration:none">Send to a friend</a></p></td>
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