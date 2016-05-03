<?php 
include("../scripts/config.php");
include("../scripts/functions.php");
$type = $_POST["type"];
if($type == 'All') $query_statement = ''; else $query_statement = "and business_type = '".$type."'";

if(isset($_POST["query"])){
$term=$_POST["query"];

 
 
 $query=MysqlSelectQuery("SELECT * FROM businessinfo where business_name like '%".$term."%' and status=1 order by business_name");
 
 if(NUM_ROWS($query) > 0){
    while($rows=SqlArrays($query)){
		$result = preg_replace("/".$term."/i", "<strong style=\"color:#090\">".$term."</strong>", $rows['business_name']);
        echo '<div class="result" onclick="GetProVal('.$rows['business_id'].')"><span id="'.$rows['business_id'].'" data="'.$rows['business_name'].'" data-email="'.$rows['email'].'">'.str_replace('&amp;','&',$result).'</span></div>';
    }
 }
 else{
	 echo '<div class="result"><center><span style="color:#090">--- No result ---</span></center></div>';
 }
}
if(isset($_POST["queryFocus"])){
	
	$queryPremium=MysqlSelectQuery("SELECT * FROM businessinfo where status=1 order by business_name");
    while($rowsPremium=SqlArrays($queryPremium)){
        echo '<div class="result resultPremium" onclick="GetProVal('.$rowsPremium['business_id'].')"><span id="'.$rowsPremium['business_id'].'" data="'.$rowsPremium['business_name'].'" data-email="'.$rowsPremium['email'].'">'.str_replace('&amp;','&',$rowsPremium['business_name']).'</span></div>';
	}
}
?>