<?php

require_once("scripts/config.php");
//require_once("scripts/functions.php");

if(connection()){
?>


<script>
function goLastMonth(months, years){
if(months == 1) {
--years;
months = 13;
}
--months
var monthstring= ""+months+"";
var monthlength = monthstring.length;
if(monthlength <=1){
monthstring = "0" + monthstring;
}
document.location.href ="?months="+monthstring+"&years="+years;
}
function goNextMonth(months, years){
if(months == 12) {
++years;
months = 0;
}
++months
var monthstring= ""+months+"";
var monthlength = monthstring.length;
if(monthlength <=1){
monthstring = "0" + monthstring;
}
document.location.href ="?months="+monthstring+"&years="+years;
}
</script>
<style>
.today

{
background-color: #00ff00; color:#FFF; font-size:14px; font-weight:bold; 

a: color: #FFF; font-weight:bold;  
 
}
.event{
background-color: #FF8080;
}
</style>

<style>

.DefaultTable 

td:hover { background: #00CC00; color:#FFF; font-size:14px; font-weight:bold;    } 
 a:hover {
  color: #FFF; font-weight:bold;  
 
}

</style>

<?php
if (isset($_GET['day'])){
$day = $_GET['day'];
} else {
$day = date("j");
}
if(isset($_GET['months'])){
$month = $_GET['months'];
} else {
$month = date("n");
}
if(isset($_GET['years'])){
$year = $_GET['years'];
}else{
$year = date("Y");
}
$currentTimeStamp = strtotime( "$day-$month-$year");
$monthName = date("F", $currentTimeStamp);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
?>

<table width="300" height="170" border='0'  bgcolor="#eeeeee" class="DefaultTable"  >
<tr bgcolor="#00CC00">
<td align="center" bgcolor="#009900"><input style='width:40px;' type='button' value='&lt;&lt;&lt;'name='previousbutton' onclick ="goLastMonth(<?php echo $month.",".$year?>)"></td>
<td colspan='5' align="center" bgcolor="#009900"><font color="#FFFFFF"><b><?php echo $monthName.", ".$year; ?></b></font></td>
<td align="center" bgcolor="#009900"><input style='width:40px;' type='button' value='&gt;&gt;&gt;'name='nextbutton' onclick ="goNextMonth(<?php echo $month.",".$year?>)"></td>
</tr>
<tr>
<td width='50px' align="center"><font color="#FF0000"> Sun </font></td>
<td width='50px' align="center"><font  color="#0000CC">Mon </font></td>
<td width='50px' align="center"><font color="#0000CC">Tue </font></td>
<td width='50px' align="center"><font color="#0000CC">Wed </font></td>
<td width='50px' align="center"><font color="#0000CC">Thu </font></td>
<td width='50px' align="center"><font color="#0000CC">Fri </font></td>
<td width='50px' align="center"><font color="#0000CC">Sat </font></td>
</tr>
<?php
echo "<tr>";
for($i = 1; $i < $numDays+1; $i++, $counter++){
$timeStamp = strtotime("$year-$month-$i");
if($i == 1) {
$firstDay = date("w", $timeStamp);
for($j = 0; $j < $firstDay; $j++, $counter++) {
echo "<td>&nbsp;</td>";
}
}
if($counter % 7 == 0) {
echo"</tr><tr>";
}
$monthstring = $month;
$monthlength = strlen($monthstring);
$daystring = $i;
$daylength = strlen($daystring);
if($monthlength <= 1){
$monthstring = "0".$monthstring;
}
if($daylength <=1){
$daystring = "0".$daystring;
}
$todaysDate = date("m/d/Y");
$dateToCompare = $monthstring. '/' . $daystring. '/' . $year;
$dateToCompare2 = $year. '-' . $monthstring. '-' . $daystring;
echo "<td  align='center'";
if ($todaysDate == $dateToCompare){
echo "class ='today'";
} else{
$sqlCount = "select * from events where SortDate='".$dateToCompare."'";
$noOfEvent = mysql_num_rows(mysql_query($sqlCount));

}

echo ">";
$sqlCount2 = "select * from events where SortDate='".$dateToCompare2."' and status = 1 ";
$noOfEvent2 = mysql_num_rows(mysql_query($sqlCount2));

echo "<a href='".SITE_URL.'calendar_events?sortdate='.$dateToCompare2."' class='DefaultTable' title = '".$noOfEvent2." Events Available (Click to View)'>".$i."</a>";
}
?>
 
</td>
</tr>

</table>
<table width="300" height="5" border='0'  bgcolor="#00CC00">
<tr><td></td></tr>
</table>

<?php
}
?>