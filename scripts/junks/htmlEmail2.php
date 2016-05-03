<?php
function Email($to,$subject,$innerMsg){

$headers = "From: Nigerian Seminars and Training <info@nigerianseminarsandtrainings.com> \r\n";
$headers .= "Reply-To: info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

$message = '<html>
<head>
</head>

<body style="background-color:#CCC">
<center>
<table cellpadding="0" style="border-top:1px solid #e4e4e4; text-align:center; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" cellspacing="0" width="600">
</table>
<table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">
<tr>
  <td height="2" width="31" style="border-bottom:1px solid #e4e4e4;">
    <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
    </td>
  <td height="2" width="131">
    <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
    </td>
  <td height="2" width="466" style="border-bottom:1px solid #e4e4e4;">
    <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
    </td>
</tr>
<!--GREEN STRIPE-->
<tr>
	<td background="'.SITE_URL.'images/email/greenback.gif" width="31" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;" height="113">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
	
	<!--WHITE TEXT AREA-->
	<td width="131" bgcolor="#FFFFFF" style="border-top:1px solid #FFF; text-align:center;" height="113" valign="middle">
	<span style="font-size:25px; font-family:Trebuchet MS, Verdana, Arial; color:#2e8a3b;"><img src="'.SITE_URL.'images/email/logo.png" width="60" height="60" /></span>
	</td>
	
	<!--GREEN TEXT AREA-->
	<td background="'.SITE_URL.'images/email/greenback.gif" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF; padding-left:15px;" height="113">
	<span style="color:#FFFFFF; font-size:18px; font-family:Trebuchet MS, Verdana, Arial;"><a href="'.SITE_URL.'" style="text-decoration:none; color:#FFF">Nigerian Seminars and Trainings.com</a></span><br /><em style="color:#FFFFFF; font-size:12px; font-family:Trebuchet MS, Verdana, Arial;">... Nigerias Apex Training Portal</em>
	</td>
</tr>

<!--DOUBLE BORDERS BOTTOM-->
<tr>
	<td height="3" width="31" style="border-top:1px solid #e4e4e4; border-bottom:1px solid #e4e4e4;">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
	<td height="3" width="131">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
	<td height="3" style="border-top:1px solid #e4e4e4; border-bottom:1px solid #e4e4e4;">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
</tr>
<tr style="background-color:#FFF">
	<td colspan="3">
	<!--CONTENT STARTS HERE-->
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	  <td>&nbsp;</td>
	  <td colspan="6" align="center" valign="middle" style="padding-right:10px; padding-top:3px; padding-bottom:3px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="https://plus.google.com/107382097978433122911"><img src="'.SITE_URL.'images/social_icons/google.png" width="20" height="20" style="margin-right:3px; border:0px"/></a>&nbsp; <a href="http://www.facebook.com/nigerianseminars"><img src="'.SITE_URL.'images/social_icons/facebook.png" width="20" height="20" style="margin-right:3px; border:0px" /></a>&nbsp;<a href="https://twitter.com/nigerianseminar"><img src="'.SITE_URL.'images/social_icons/twitter.png" width="20" height="20" style="margin-right:3px; border:0px" /></a>&nbsp;<a href="http://www.nigerianseminarsandtrainings.com/rss/"><img src="'.SITE_URL.'images/social_icons/rss.png" width="20" height="20" style="margin-right:3px; border:0px" /></a></td>
	  </tr>
	<tr align="center" bgcolor="#45A853">
	  <th>&nbsp;</th>
	  <th width="71" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="http://www.nigerianseminarsandtrainings.com/" style="color:#FFFFFF; text-decoration:none">Home</a></th>
	  <th width="108" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="http://www.nigerianseminarsandtrainings.com/advertise" style="color:#FFFFFF; text-decoration:none">Advertise</a></th>
	  <th width="86" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="https://www.nigerianseminarsandtrainings.com/subscribe" style="color:#FFFFFF; text-decoration:none">Subscribe</a></th>
	  <th width="135" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="http://www.nigerianseminarsandtrainings.com/contact-us" style="color:#FFFFFF; text-decoration:none">Contact Us</a></th>
	  <th width="152" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="https://s3.amazonaws.com/com.alexa.toolbar/atbp/NunuTq/download/index.htm" style="color:#FFFFFF; text-decoration:none">Download Our Toolbar</a></th>
	  <th width="24" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">&nbsp;</th>
	  </tr>
	<tr>
	  <td width="20"><div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	    </td>
	  <td colspan="6" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">';
	    $message .= $innerMsg;
	    $message .='
	  <br/>
	    
	    <!--RIGHT COLUMN FIRST BOX-->
	    <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #e4e4e4; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">
	      
	      </table>
	    
	    <!--RIGHT COLUMN SECOND BOX-->
	    
	    <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #e4e4e4; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">
	      
	      </table>
	    
	    <!--RIGHT COLUMN THIRD BOX-->
	    
	    
	    </td>
	  </tr>
	<tr bgcolor="#45A853">
	  <td>&nbsp;</td>
	  <td colspan="4" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">&nbsp;</td>
	  <td colspan="2" align="center" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">&nbsp;</td>
	  </tr>
	</table>
	</td>
</tr>
</table>


</center>
</body>
</html>';
mail($to,$subject,$message,$headers);
}

function SendHtmlEmails($to,$subject,$innerMsg,$msgID,$sendToFriend){

$headers = "From: Nigerian Seminars and Training <info@nigerianseminarsandtrainings.com> \r\n";
$headers .= "Reply-To: info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

 $switcher = '<a href="'.SITE_URL.'subscribers" style="color:#FFFFFF; text-decoration:none">Subscribe</a> | <a href="'.SITE_URL.'unsubscribe?user='.$to.'&token='.md5($to).'" style="color:#FFFFFF; text-decoration:none">Unsubscribe</a> | <a href="'.SITE_URL.'forwardTofriend?user='.$to.'&token='.md5($to).'&msgid='.$msgID.'&action=sendtofriend&seq='.md5('sendtofriend').'" style="color:#FFFFFF; text-decoration:none">Send to a friend</a>';
 
$message = $sendToFriend;
$message.= '<html>
<head>
</head>

<body style="background-color:#CCC">
<center>
<table cellpadding="0" style="border-top:1px solid #e4e4e4; text-align:center; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;" cellspacing="0" width="600">
</table>
<table width="600" background="#FFFFFF" style="text-align:left;" cellpadding="0" cellspacing="0">
<tr>
  <td height="2" width="31" style="border-bottom:1px solid #e4e4e4;">
    <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
    </td>
  <td height="2" width="131">
    <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
    </td>
  <td height="2" width="466" style="border-bottom:1px solid #e4e4e4;">
    <div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
    </td>
</tr>
<!--GREEN STRIPE-->
<tr>
	<td background="'.SITE_URL.'images/email/greenback.gif" width="31" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF;" height="113">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
	
	<!--WHITE TEXT AREA-->
	<td width="131" bgcolor="#FFFFFF" style="border-top:1px solid #FFF; text-align:center;" height="113" valign="middle">
	<span style="font-size:25px; font-family:Trebuchet MS, Verdana, Arial; color:#2e8a3b;"><img src="'.SITE_URL.'images/email/logo.png" width="60" height="60" /></span>
	</td>
	
	<!--GREEN TEXT AREA-->
	<td background="'.SITE_URL.'images/email/greenback.gif" bgcolor="#45a853" style="border-top:1px solid #FFF; border-bottom:1px solid #FFF; padding-left:15px;" height="113">
	<span style="color:#FFFFFF; font-size:18px; font-family:Trebuchet MS, Verdana, Arial;"><a href="'.SITE_URL.'" style="text-decoration:none; color:#FFF">Nigerian Seminars and Trainings.com</a></span><br /><em style="color:#FFFFFF; font-size:12px; font-family:Trebuchet MS, Verdana, Arial;">... Nigerias Apex Training Portal</em>
	</td>
</tr>

<!--DOUBLE BORDERS BOTTOM-->
<tr>
	<td height="3" width="31" style="border-top:1px solid #e4e4e4; border-bottom:1px solid #e4e4e4;">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
	<td height="3" width="131">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
	<td height="3" style="border-top:1px solid #e4e4e4; border-bottom:1px solid #e4e4e4;">
	<div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	</td>
</tr>
<tr style="background-color:#FFF">
	<td colspan="3">
	<!--CONTENT STARTS HERE-->
	<table cellpadding="0" cellspacing="0" width="100%">
	<tr>
	  <td>&nbsp;</td>
	  <td colspan="6" align="center" valign="middle" style="padding-right:10px; padding-top:3px; padding-bottom:3px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="https://plus.google.com/107382097978433122911"><img src="'.SITE_URL.'images/social_icons/google.png" width="20" height="20" style="margin-right:3px; border:0px"/></a>&nbsp; <a href="http://www.facebook.com/nigerianseminars"><img src="'.SITE_URL.'images/social_icons/facebook.png" width="20" height="20" style="margin-right:3px; border:0px" /></a>&nbsp;<a href="https://twitter.com/nigerianseminar"><img src="'.SITE_URL.'images/social_icons/twitter.png" width="20" height="20" style="margin-right:3px; border:0px" /></a>&nbsp;<a href="'.SITE_URL.'rss/"><img src="'.SITE_URL.'images/social_icons/rss.png" width="20" height="20" style="margin-right:3px; border:0px" /></a></td>
	  </tr>
	<tr align="center" bgcolor="#45A853">
	  <th>&nbsp;</th>
	  <th width="71" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="'.SITE_URL.'" style="color:#FFFFFF; text-decoration:none">Home</a></th>
	  <th width="108" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="'.SITE_URL.'advertise" style="color:#FFFFFF; text-decoration:none">Advertise</a></th>
	  <th width="86" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="'.SITE_URL.'subscribers" style="color:#FFFFFF; text-decoration:none">Subscribe</a></th>
	  <th width="135" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="'.SITE_URL.'contact-us" style="color:#FFFFFF; text-decoration:none">Contact Us</a></th>
	  <th width="152" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;"><a href="https://s3.amazonaws.com/com.alexa.toolbar/atbp/NunuTq/download/index.htm" style="color:#FFFFFF; text-decoration:none">Download Our Toolbar</a></th>
	  <th width="24" valign="top" style="padding:5px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">&nbsp;</th>
	  </tr>
	<tr>
	  <td width="20"><div style="line-height: 0px; font-size: 1px; position: absolute;">&nbsp;</div>
	    </td>
	  <td colspan="6" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">';
	  	
	    $message .= $innerMsg;
	    $message .='
	   <br/>
	   
	    <!--RIGHT COLUMN FIRST BOX-->
	    <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #e4e4e4; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">
	      
	      </table>
	    
	    <!--RIGHT COLUMN SECOND BOX-->
	    
	    <table width="100%" cellpadding="0" cellspacing="0" style="border-bottom:1px solid #e4e4e4; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">
	      
	      </table>
	    
	    <!--RIGHT COLUMN THIRD BOX-->
	    
	    
	    </td>
	  </tr>
     
	<tr bgcolor="#45A853">
	  <td>&nbsp;</td>
	  <td colspan="6" align="center" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;color:#FFF;"> 
			  <p>You are currently subscribed to Nigerian Seminars and Trainings as '.$to.', Add <a style="color:#CCC" href="mailto:info@nigerianseminarsandtrainings.com">info@nigerianseminarsandtrainings.com</a> to your email address book to ensure delivery<br />
			 </p> </td>
	  </tr>
	<tr bgcolor="#45A853">
	  <td>&nbsp;</td>
	  <td colspan="6" align="center" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px;">'.$switcher.'</td>
	  </tr>
	<tr bgcolor="#45A853">
	  <td>&nbsp;</td>
	  <td colspan="6" align="center" valign="top" style="padding:10px; font-family:Trebuchet MS, Verdana, Arial; font-size:12px; color:#FFF">
        <p>Nigerianseminarsandtrainings.com<br />
        18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria</p></td>
	  </tr>
     
	</table>
	</td>
</tr>
</table>


</center>
</body>
</html>';
mail($to,$subject,$message,$headers);
}

/******************************************************************************************************************************************/
function SendNewsEmails($to,$subject,$innerMsg,$msgID,$sendToFriend){

$headers = "From: Nigerian Seminars and Training <info@nigerianseminarsandtrainings.com> \r\n";
$headers .= "Reply-To: info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

 $switcher = '<font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong><a href="'.SITE_URL.'subscribers" style="color:#090; text-decoration:none;">Subscribe</a> | <a href="'.SITE_URL.'unsubscribe?user='.$to.'&token='.md5($to).'" style="color:#090; text-decoration:none;">Unsubscribe</a> | <a href="'.SITE_URL.'forwardTofriend?user='.$to.'&token='.md5($to).'&msgid='.$msgID.'&action=sendtofriend&seq='.md5('sendtofriend').'" style="color:#090; text-decoration:none">Send to a friend</a></strong></font>';
 
$message = $sendToFriend;
$message.= '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notification email template</title>
</head>

<body bgcolor="#8d8e90"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
  <tr>
    <td><table width="80%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center"><div style="background-image:url('.SITE_URL.'images/nstemaillogo.jpg); background-repeat:no-repeat; height:80px"><div style="padding:3px; float:right; margin-top:24px; margin-right:5px;"><a href="http://www.facebook.com/nigerianseminars"><img src="'.SITE_URL.'images/PROMO-GREEN2_09_01.jpg" alt="facebook" width="23" height="19" border="0" style="vertical-align:middle; margin-right:3px;" /></a>| <a href="https://twitter.com/nigerianseminar" target="_blank"><img src="'.SITE_URL.'images/PROMO-GREEN2_09_02.jpg" alt="twitter" width="27" height="19" border="0" style="vertical-align:middle; margin-right:3px;" /></a> | <a href="https://plus.google.com/107382097978433122911" target="_blank"><img src="'.SITE_URL.'images/google+.png" alt="google+" width="25" height="19" border="0" style="vertical-align:middle; margin-right:3px;" /></a></div></div></td>
              </tr>
            </table></td>
        </tr>
       
        
        <tr>
          <td style="padding-left:20px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
                <td align="left" valign="top">&nbsp;</td>
                <td align="center" valign="top" style="font-size:11px"></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="12%" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.tomassociatesng.com"><img src="'.SITE_URL.'images/email_ads/tomassociates.png" width="87" height="87" /></a></span></td>
                <td width="69%" rowspan="8" align="left" valign="top" style="padding-left:10px;padding-right:10px;"><font style="font-family: Georgia, Times New Roman , Times, serif; color:#010101; font-size:12px; line-height:20px;">';
				$message .= $innerMsg;
				
				 $message .='</td>
                <td width="16%" align="center" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.businessservicessupport.com"><img src="'.SITE_URL.'images/email_ads/bss_managment_consultancy.png" width="87" height="87" /></a></td>
                <td width="3%" rowspan="8">&nbsp;</td>
              </tr>
			  <tr>
			    <td width="12%" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.thegtcgroup.com"><img src="'.SITE_URL.'images/email_ads/gtc.png" width="87" height="87" /></a></span></td>
                <td align="center" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.fontiniconsulting.com"><img src="'.SITE_URL.'images/email_ads/fontini.jpg" width="87" height="87" /></a></td>
              </tr>
              <tr>
                <td width="12%" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.impactconsultingng.com"><img src="'.SITE_URL.'images/email_ads/impact.png" width="87" height="87" /></a></span></td>
                <td align="center" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.aecogreen.com"><img src="'.SITE_URL.'images/email_ads/acogreen_intl.jpg" width="87" height="87" /></a></td>
              </tr>
              <tr>
                <td width="12%" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.reenelassociates.com/"><img src="'.SITE_URL.'images/email_ads/Reenel-logo.png" width="87" height="87" /></a></span></td>
                <td align="center" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.remoikngltd.com" style="border-bottom:thin; border-bottom-color:#CCC; margin-bottom:2px;"><img src="'.SITE_URL.'images/email_ads/remoik.png" width="128" height="45" ></a></td>
              </tr>
              <tr>
                <td width="12%" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;">
                <span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.sectronicsng.com/" style="border-bottom:thin; border-bottom-color:#CCC; margin-bottom:2px;"><img src="'.SITE_URL.'images/email_ads/sectronics.jpg" width="87" height="87" /></a></span></td>
                <td align="center" valign="top" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"> <span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.cipmnigeria.org/" style="border-bottom:thin; border-bottom-color:#CCC; margin-bottom:2px;"><img src="'.SITE_URL.'images/email_ads/cipm.png" width="87" height="87" /></a></span></td>
              </tr>
             
              <tr>
                <td width="12%" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;">  
                <span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.cirafrica.com/" style="border-bottom:thin; border-bottom-color:#CCC; margin-bottom:2px;"><img src="'.SITE_URL.'images/email_ads/cir.jpg" width="87" height="87" /></a></span></td>
                <td align="center" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;" ><span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><img src="'.SITE_URL.'images/email_ads/wodia.jpg" width="87" height="87" /></span></td>
                <td width="0%" align="right" valign="top"></td>
                <td width="0%" align="right" valign="top"></td>
                <td width="0%">&nbsp;</td>
              </tr>
              <tr>
                <td width="12%" style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><span style="border-bottom:thin; border-bottom-color:#CCC; padding-bottom:2px;"><a href="http://www.dacaconsults.com.ng/" style="border-bottom:thin; border-bottom-color:#CCC; margin-bottom:2px;"><img src="'.SITE_URL.'images/email_ads/dacaConsult.png" width="87" height="87" /></a></span></td>
                <td align="center"></td>
                <td rowspan="2" align="right" valign="top"></td>
                <td rowspan="2" align="right" valign="top"></td>
                <td rowspan="2">&nbsp;</td>
  </tr>
              <tr>
                <td width="12%">&nbsp;</td>
                <td align="center"></td>
              </tr>
  
  
  
  
          </table></td>
        </tr>
        
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><a href="http://www.nsthotels.com"><img src="'.SITE_URL.'images/email_ads/hotel.png" width="680" height="90"></a></td>
        </tr>
        <tr>
          <td align="center"><img src="'.SITE_URL.'images/PROMO-GREEN2_07.jpg" width="598" height="7" style="display:block" border="0" alt=""/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="12%" align="center">&nbsp;</td>
                <td width="14%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "http://www.nigerianseminarsandtrainings.com/" style="color:#010203; text-decoration:none"><strong>HOME </strong></a></font></td>
                <td width="3%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="9%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "http://www.nigerianseminarsandtrainings.com/advertise" style="color:#010203; text-decoration:none"><strong>ADVERTISE</strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="10%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "https://www.nigerianseminarsandtrainings.com/subscribe" style="color:#010203; text-decoration:none"><strong>SUBSCRIBE </strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="11%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "http://www.nigerianseminarsandtrainings.com/contact-us" style="color:#010203; text-decoration:none"><strong>CONTACT US </strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="17%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "https://s3.amazonaws.com/com.alexa.toolbar/atbp/NunuTq/download/index.htm" style="color:#010203; text-decoration:none"><strong>DOWNLOAD  TOOLBAR</strong></a></font></td>
                <td width="4%" align="right"> </td>
                <td width="5%" align="right"></td>
                <td width="4%" align="right"></td>
                <td width="5%">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong>18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria</strong></font></td>
        </tr>
        <tr>
          <td align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong>You are currently subscribed to Nigerian Seminars and Trainings as '.$to.', Add <a style="color:#090" href="mailto:info@nigerianseminarsandtrainings.com">info@nigerianseminarsandtrainings.com</a> to your email address book to ensure delivery</strong></font></td>
        </tr>



        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">'.$switcher.'</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>';
mail($to,$subject,$message,$headers);
return $message;
}
/******************************************************************************************************************************************/
function SendRegularEmails($to,$subject,$innerMsg,$msgID,$sendToFriend){

$headers = "From: Nigerian Seminars and Training <info@nigerianseminarsandtrainings.com> \r\n";
$headers .= "Reply-To: info@nigerianseminarsandtrainings.com \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n".
'X-Mailer: PHP/' . phpversion();

  $switcher = '<font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong><a href="'.SITE_URL.'subscribers" style="color:#090; text-decoration:none;">Subscribe</a> | <a href="'.SITE_URL.'unsubscribe?user='.$to.'&token='.md5($to).'" style="color:#090; text-decoration:none;">Unsubscribe</a> | <a href="'.SITE_URL.'forwardTofriend?user='.$to.'&token='.md5($to).'&msgid='.$msgID.'&action=sendtofriend&seq='.md5('sendtofriend').'" style="color:#090; text-decoration:none">Send to a friend</a></strong></font>';
 
$message = $sendToFriend;
$message.= '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>

<body bgcolor="#8d8e90">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top"><font style="font-family: Verdana, Geneva, sans-serif; color:#666766; font-size:13px; line-height:21px">';
				$message .= $innerMsg;
				
				 $message .='
				</font></td>
                <td width="10%">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right" valign="top"><table width="108" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="right"><font style="font-family: Georgia, \'Times New Roman\', Times, serif; color:#ffffff; font-size:14px"><em><a href="'.SITE_URL.'" target="_blank" style="color:#ffffff; text-decoration: underline"><img src="'.SITE_URL.'images/banner_logo.png" width="50" height="50" /></a></em></font></td>
                  </tr>
                </table></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="right" style=" color:#090;font-family: Georgia, \'Times New Roman\', Times, serif; font-size:15px; padding-right:5px;">Nigerian seminars and trainings .com</td>
          
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><img src="'.SITE_URL.'images/PROMO-GREEN2_07.jpg" width="598" height="7" style="display:block" border="0" alt=""/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="12%" align="center">&nbsp;</td>
                <td width="14%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "http://www.nigerianseminarsandtrainings.com/" style="color:#010203; text-decoration:none"><strong>HOME </strong></a></font></td>
                <td width="3%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="9%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "http://www.nigerianseminarsandtrainings.com/advertise" style="color:#010203; text-decoration:none"><strong>ADVERTISE</strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="10%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "https://www.nigerianseminarsandtrainings.com/subscribe" style="color:#010203; text-decoration:none"><strong>SUBSCRIBE </strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="11%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "http://www.nigerianseminarsandtrainings.com/contact-us" style="color:#010203; text-decoration:none"><strong>CONTACT US </strong></a></font></td>
                <td width="2%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><strong>|</strong></font></td>
                <td width="17%" align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#010203; font-size:9px; text-transform:uppercase"><a href= "https://s3.amazonaws.com/com.alexa.toolbar/atbp/NunuTq/download/index.htm" style="color:#010203; text-decoration:none"><strong>DOWNLOAD  TOOLBAR</strong></a></font></td>
                <td width="4%" align="right"> <a href="http://www.facebook.com/nigerianseminars"><img src="'.SITE_URL.'images/PROMO-GREEN2_09_01.jpg" alt="facebook" width="23" height="19" border="0" /></a></td>
                <td width="5%" align="right"><a href="https://twitter.com/" target="_blank"><img src="'.SITE_URL.'images/PROMO-GREEN2_09_02.jpg" alt="twitter" width="27" height="19" border="0" /></a></td>
                <td width="4%" align="right"><a href="http://www.linkedin.com/" target="_blank"><img src="'.SITE_URL.'images/PROMO-GREEN2_09_03.jpg" alt="linkedin" width="25" height="19" border="0" /></a></td>
                <td width="5%">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong>18b James Ademosu close, off Uncle Oluyeba, off Aladelola street, Ikosi - Ketu, Lagos, Nigeria</strong></font></td>
        </tr>
        <tr>
          <td align="center"><font style="font-family:\'Myriad Pro\', Helvetica, Arial, sans-serif; color:#231f20; font-size:10px"><strong>You are currently subscribed to Nigerian Seminars and Trainings as '.$to.', Add <a style="color:#090" href="mailto:info@nigerianseminarsandtrainings.com">info@nigerianseminarsandtrainings.com</a> to your email address book to ensure delivery</strong></font></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">'.$switcher.'</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
';
mail($to,$subject,$message,$headers);
}

?>