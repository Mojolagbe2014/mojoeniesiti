<?php 
include("../scripts/config.php");
include("../scripts/functions.php");
if(isset($_POST["query"])){
$term=$_POST["query"];
 
 $query=MysqlSelectQuery("SELECT organiser,event_id FROM events where organiser like '%".$term."%' and status=1 group by organiser order by organiser");
 
 if(NUM_ROWS($query) > 0){
    while($rows=SqlArrays($query)){
		$result = preg_replace("/".$term."/i", "<strong style=\"color:#090\">".$term."</strong>", $rows['organiser']);
        echo '<div class="result" onclick="GetVal('.$rows['event_id'].')"><span id="'.$rows['event_id'].'">'.str_replace('&amp;','&',$rows['organiser']).'</span></div>';
    }
 }
 else{
	 echo '<div class="result"><center><span style="color:#090">--- No result ---</span></center></div>';
 }
}
if(isset($_POST["queryFocus"])){
	$query=MysqlSelectQuery("SELECT organiser,event_id FROM events where status=1 group by organiser order by organiser");

    while($rows=SqlArrays($query)){
        echo '<div class="result" onclick="GetVal('.$rows['event_id'].')"><span id="'.$rows['event_id'].'">'.str_replace('&amp;','&',$rows['organiser']).'</span></div>';
    }
}
?>