<?php 
include("../../scripts/config.php");
include("../../scripts/functions.php");
connection();
if(!isset($_POST['generate'])) header("location: ../quaterly_guide");
$from  = date("Y-m-d", strtotime($_POST['from']));
$to  = date("Y-m-d", strtotime($_POST['to']));
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="pdfstyle.css" />

</head>

<body>
<div class="main_content">
  <div class="header"><img src="../../images/logo2.png" width="435" height="60" />
   
  </div>
  <div class="innerBar"><?php echo $_POST['name'];?> Conferences, Seminars and Training Guide</div>
  <div class="social">
  <table width="100%">
  <tr>
    <td width="73%" align="center" valign="middle"></td>
    <td width="10%" align="right" valign="middle">Follow us on</td>
    <td width="6%"><a href="#"><img src="../../images/social_icons/twitter.png" width="25" height="25" /></a></td>
    <td width="6%"><a href="#"><img src="../../images/social_icons/google.png" width="25" height="25" /></a></td>
    <td width="5%"><a href="#"><img src="../../images/social_icons/facebook.png" width="25" height="25" style="margin-right:0px;" /></a></td>
  </tr>
</table>
  <div class="clear"></div>
  </div> 
  <div class="info"><span style="color:#F00;">(Premium subscribers only)</span><br />Please click on your prefered course for more information</div> 
  <table class="pdfTable"> 
  <tr align="center" >
    <th align="center" style="background-color: #CCC; color: #333;">Date</th>
    <th align="center" style="background-color: #CCC; color: #333;">Course Title</th>
    <th align="center" style="background-color: #CCC; color: #333;">Training Provider</th>
  </tr>
   <?php
   function GetEventCategory($id){
	   $result = mysql_query("select * from categories where category_id = $id ");
	$rows = mysql_fetch_array($result);
	return $rows['category_name'];
   }
	$result = mysql_query("select category from events where SortDate between '".$from."' and '".$to."' and status = 1 and premium > 0 and premium !=8 group by(category)");
	while ($rows = mysql_fetch_array($result)){
	?>
 
  <tbody>
 
    <tr align="center">  <th colspan="3"><?php echo GetEventCategory($rows['category']);?></th>
    </tr>
    <?php
	$resultEvent = mysql_query("select * from events where SortDate between '".$from."' and '".$to."' and status = 1 and premium > 0 and premium !=8 and category ='".$rows['category']."'");
	while ($rowsEvent = mysql_fetch_array($resultEvent)){
	?>
  <tr>
    <td height="48" align="left" valign="middle" ><?php echo $rowsEvent['startDate']." - ".$rowsEvent['endDate'];?></td>
    <td ><a href="<?php echo SITE_URL ?>event_detail?id=<?php echo $rowsEvent['event_id'];?>"><?php echo stripslashes($rowsEvent['event_title']);?></a></td>
    <td valign="middle" ><?php echo stripslashes($rowsEvent['organiser']);?></td>
  </tr>
  <?php
	}
  ?>
  </tbody>
  
  <?php
	}
	?>
     <tr align="center" >
    <th colspan="3" style="background-color: #CCC; color: #333; font-size:small">To view more courses click <a href="<?php echo SITE_URL ?>all_event">here</a></th>
    </tr>
</table>
 
  <div class="clear"></div>
  
</div>
</body>
</html>
<?php
    $content = ob_get_clean();

   require_once("../../scripts/html2pdf/html2pdf.class.php");
   try
   {
	   $fileName = str_replace(" ","_",$_POST['name']);
	   $result = mysql_query("select * from quarterly_guide where name ='".$_POST['name']."'")or die(mysql_error());
	   if(mysql_num_rows($result) == 0){
		   mysql_query("insert into quarterly_guide (name,year) values ('".$_POST['name']."','".date("Y")."')");
	   }
       $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
       $html2pdf->pdf->SetDisplayMode('fullpage');
       $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
       $html2pdf->Output('../../QuarterlyGuide/'.$fileName.'_Conferences_and_Trainings_Guide.pdf','F');
	  header("location: ../quaterly_guide?confirmation=success");
	   
   }
   catch(HTML2PDF_exception $e) {
    echo $e;
       exit;
    }
?>