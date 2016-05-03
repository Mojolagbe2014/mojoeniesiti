<?php 
include("../scripts/config.php");
include("../scripts/functions.php");
$type = $_POST["type"];
if($type == 'All') $query_statement = ''; else $query_statement = "and business_type = '".$type."'";
function BuildUrl($type){
	switch($type){
		case 'Training':
		$urlPrefix = 'tprovider';
		break;
		case 'Managers':
		$urlPrefix = 'emanagers';
		break;
		case 'Venue':
		$urlPrefix = 'venues';
		break;
		case 'Suppliers':
		$urlPrefix = 'suppliers';
		break;
		default:
		$urlPrefix = "";
	}
	return $urlPrefix;
}
if(isset($_POST["query"])){
$term=$_POST["query"];

 
 
 $query=MysqlSelectQuery("SELECT * FROM businessinfo where business_name like '%".$term."%' and status=1 $query_statement order by business_name");
 
 if(NUM_ROWS($query) > 0){
    while($rows=SqlArrays($query)){
		$result = preg_replace("/".$term."/i", "<strong style=\"color:#090\">".$term."</strong>", $rows['business_name']);
        echo '<div class="result" onclick="GetProVal('.$rows['business_id'].')"><span id="'.$rows['business_id'].'" data="'.SITE_URL.BuildUrl($rows['business_type']).'/'. $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'">'.str_replace('&amp;','&',$result).'</span></div>';
    }
 }
 else{
	 echo '<div class="result"><center><span style="color:#090">--- No result ---</span></center></div>';
 }
}
if(isset($_POST["queryFocus"])){
	/*Premum Listing Display*/
	if($type == 'All'){
		$premiumQuery = 'premium > 0';
	}
	else if($type == 'Training') 
	{
		$premiumQuery = 'premium = 3';
		} 
		else {
			$premiumQuery = 'premium = 2';
		}
	
	$queryPremium=MysqlSelectQuery("SELECT * FROM businessinfo where status=1 $query_statement and $premiumQuery order by rand()");
    while($rowsPremium=SqlArrays($queryPremium)){
        echo '<div class="result resultPremium" onclick="GetProVal('.$rowsPremium['business_id'].')"><span id="'.$rowsPremium['business_id'].'"  data="'.SITE_URL.BuildUrl($rowsPremium['business_type']).'/'. $rowsPremium['business_id'].'/'.str_replace($title_link,"-",$rowsPremium['business_name']).'" >'.str_replace('&amp;','&',$rowsPremium['business_name']).'</span></div>';
	}
	
	/*Regular Listing Display*/
		$query=MysqlSelectQuery("SELECT * FROM businessinfo where status=1 $query_statement and premium = 0 order by business_name");

    while($rows=SqlArrays($query)){
        echo '<div class="result" onclick="GetProVal('.$rows['business_id'].')"><span id="'.$rows['business_id'].'"  data="'.SITE_URL.BuildUrl($rows['business_type']).'/'. $rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" >'.str_replace('&amp;','&',$rows['business_name']).'</span></div>';
    }
}
?>