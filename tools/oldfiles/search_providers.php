<?php 
include("../scripts/config.php");
include("../scripts/functions.php");
$type=$_POST["type"];
if(isset($_POST["query"])){
$term=$_POST["query"];

 
 $query=MysqlSelectQuery("SELECT * FROM businessinfo where business_name like '%".$term."%' and status=1 and business_type='".$type."' order by business_name");
 
 if(NUM_ROWS($query) > 0){
    while($rows=SqlArrays($query)){
		$result = preg_replace("/".$term."/i", "<strong style=\"color:#090\">".$term."</strong>", $rows['business_name']);
        echo '<div class="result" onclick="GetValProvider('.$rows['business_id'].')"><span id="'.$rows['business_id'].'">'.str_replace('&amp;','&',$rows['business_name']).'</span></div>';
    }
 }
 else{
	 echo '<div class="result"><center><span style="color:#090">--- No result ---</span></center></div>';
 }
}
if(isset($_POST["queryFocus"])){
	$query=MysqlSelectQuery("SELECT * FROM businessinfo where status=1 and business_type='".$type."' order by business_name");

    while($rows=SqlArrays($query)){
        echo '<div class="result" onclick="GetValProvider('.$rows['business_id'].')"><span id="'.$rows['business_id'].'">'.str_replace('&amp;','&',$rows['business_name']).'</span></div>';
    }
}
?>