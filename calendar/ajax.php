<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(isset($_GET['date'])){
	$decodeDate = base64_decode($_GET['date']);
	$result= MysqlSelectQuery("select * from my_events a, events b where subscriber_id='".$_SESSION['user_id']."' and b.event_id = a.event_id and sortDate = '".$decodeDate."'");
	$num = NUM_ROWS($result);
	$word = ($num > 1) ? 'events' : 'event';
	echo '<div class="pageHeader">'.$num.' Saved '.$word.' starting on '.date('F j, Y',strtotime($decodeDate)).'</div>';
	$i = 1;
	while($rows = SqlArrays($result)){
	//$style = ($i % 2 == 1) ? 'style="float:left;"' : 'style="float:right;"';
?>
<div class="testCalendar">
	
    <div class="title">
    	<h2><?php echo $rows['event_title'];?></h2>
    </div>
    
    <div class="icons">
    <ul>
    	<li><i class="icon-calendar"></i> <?php echo date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate']));?></li>
        <li><i class="icon-money"></i> <?php echo $rows['cost'];?></li>
        <li><i class="fa fa-university"></i> <?php echo $rows['organiser'];?></li>
        <li><i class="icon-link"></i> <a href="<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>" target="_blank">Full Detail</a></li>
    </ul>
    </div>
    <div>
    </div>
</div>
<?php
	}
}
?>