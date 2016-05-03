<div class="video_box">
<?php
$year = (isset($_GET['year']) && is_numeric($_GET['year'])) ? $_GET['year'] : date('Y');
$thisYearMonth = (isset($_GET['year']) && is_numeric($_GET['year'])) ? $_GET['year']."-01" : date('Y-m');
$next_year = $year + 1; 
$last_year = $year - 1;
$months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
$loadEvent = (date('Y') == $year) ? "true" : "false";
?>
<table style="width:100%; margin-bottom: 5px;">
<tr>
<td style="text-align:left;">
<button class="navButton" onClick="NavigateYear('<?php echo $last_year;?>')" >
<i class="fa fa-angle-double-left" style="font-size:16px;"></i>
<?php echo $last_year." Events";?>
</button>
</td>
<td style="text-align:center;">
<?php echo '<h2 style="font-weight:normal; font-size: 18px;">'.$year." Events </h2>";?>
</td>
<td style="text-align:right;">
<h3 style="font-weight:normal; font-size: 13px;">
<button class="navButton" onClick="NavigateYear('<?php echo $next_year;?>')" >
<?php echo $next_year." Events ";?>
<i class="fa fa-angle-double-right" style="font-size:16px;"></i>
</button>
</h3>
</td>
</tr>
</table>
<ul id="tabs">
<?php
$i = 0;
$querySupp = "";
if(isset($rowsState['id_state'])){ $querySupp = " and state=".$rowsState['id_state']; }
if(isset($rowStateDivs['id'])){ $querySupp = " AND state=".$rowsState['id_state']." AND division = ".$rowStateDivs['id']; }
else if(isset($lagSubDivParam) && $lagSubDivParam!=''){$querySupp = " AND state=".$rowsState['id_state']." AND ($lagSubDivParam) "; }
else if(isset($url_country)){ $querySupp = " and country=".$val; }
else if(isset($url_category)){ $querySupp = " and category=".$val; }
$tabsIdHolder = []; 
foreach($months as $mon){
    $monconverted = date("m",strtotime($mon));
    $result = MysqlSelectQuery("SELECT count(event_id) as numrows FROM `events` WHERE status = 1 and SortDate like '%".$year."-".$monconverted."%' $querySupp");
    $row = SqlArrays($result);
    $currMon = date("Y-m",strtotime($year."-".$mon));
    $current = '';//(date("Y-m",strtotime($mon."-".$year)) == date("Y-m")) ? 'class="current" id="current"' : '';
    if($row['numrows'] > 0) { 
        array_push($tabsIdHolder, $currMon);  
        $monthShow = "<u>".$mon."</u>";
        $current = (date("Y-m",strtotime($mon."-".$year)) == date("Y-m")) ? 'class="current" id="current"' : '';
    } 
    else {$monthShow = $mon;}
    echo '<li '.$current.' ><a title="Events for '.$mon.'" href="#" id="'.$currMon.'">'.$monthShow.'</a></li>'; $i++;
}
function yearMonthHandler($thisYearMonth, $allYearMonths){
    if(count($allYearMonths)>0){
        if(!in_array($thisYearMonth, $allYearMonths)){
            $yearMonthArr = explode('-', $thisYearMonth);
            $monthVal = intval($yearMonthArr[1]) < 10 ? "0".intval($yearMonthArr[1]+1) : intval($yearMonthArr[1]+1);
            $thisYearMonth = ($monthVal<13) ? yearMonthHandler($yearMonthArr[0]."-".$monthVal, $allYearMonths) : end($allYearMonths);
        }
        return $thisYearMonth;
    } else{ return false; }
}

?>
</ul>
<div id="content-tab" > 
<div id="tab1"><span class="preloader"><img src="<?php echo SITE_URL;?>images/preloader2.gif" alt="header logo" /> Loading events...</span></div>
</div>
<script>
function NavigateYear(year){ window.location="?year="+year; }
</script>
</div>