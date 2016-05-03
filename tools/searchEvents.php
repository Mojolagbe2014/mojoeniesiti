<?php 
include("../scripts/config.php");
include("../scripts/functions.php");
if(isset($_POST["query"])){
$term=$_POST["query"];
$today = date("Y-m-d");
 $category = "";
 if($term != ''){
	 if(isset($_POST["cat"])) $category = " and category=".$_POST["cat"];
	 /*** Premium Events Query */
	  $queryPremium=MysqlSelectQuery("SELECT * FROM events where event_title like '%".$term."%' and SortDate >= '$today' $category and status=1 and premium = 1 order by sortDate ");
	 
	 /*** Regular Events Query */
 $query=MysqlSelectQuery("SELECT * FROM events where event_title like '%".$term."%' and SortDate >= '$today' $category and status=1 and premium = 0 order by sortDate ");
 
  /*** Premium Events Listing */
	 $j = 0;
	  while($rowsPremium=SqlArrays($queryPremium)){
		  
		  $business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rowsPremium['organiser']."%' and premium > 0");
		$biz_name = SqlArrays($business);
		if($biz_name['logos'] == '') $logo = 'images/star-premium.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
		  
		if($j % 2 == 0) $class = 'odd'; else $class = '';
		$result = preg_replace("/".$term."/i", "<strong style=\"color:#FF0000\">".$term."</strong>", $rowsPremium['event_title']);
        echo '<div class="result" onclick="GetEvtVal('.$rowsPremium['event_id'].')"><span id="'.$rowsPremium['event_id'].'" class="'.$class.'" data="'.SITE_URL.'events/'. $rowsPremium['event_id'].'/'.str_replace($title_link,"-",$rowsPremium['event_title']).'" ><img src="'.SITE_URL.$logo.'" width=20 height=20 />'.str_replace('&amp;','&',$result).' <em style="color:#090;"> - '.date('M d',strtotime($rowsPremium['startDate']))." - ".date('d M, Y',strtotime($rowsPremium['endDate'])).' - '. GetEventLocation($rowsPremium['event_id']).'</em></span></div>';
	$j ++;
    }
	
	 /*** Regular Events Listing */
	 $i = 0;
	 while($rows=SqlArrays($query)){
		if($i % 2 == 0) $class = 'odd'; else $class = '';
		$result = preg_replace("/".$term."/i", "<strong style=\"color:#FF0000\">".$term."</strong>", $rows['event_title']);
        echo '<div class="result" onclick="GetEvtVal('.$rows['event_id'].')"><span id="'.$rows['event_id'].'" class="'.$class.'" data="'.SITE_URL.'events/'. $rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']).'" >'.str_replace('&amp;','&',$result).' <em style="color:#090;"> - '.date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate'])).' - '. GetEventLocation($rows['event_id']).'</em></span></div>';
	$i ++;
    }

 }
}
if(isset($_POST["queryFocus"])){
	$query=MysqlSelectQuery("SELECT organiser,event_id FROM events where status=1 group by organiser order by organiser");

    while($rows=SqlArrays($query)){
        echo '<div class="result" onclick="GetVal('.$rows['event_id'].')"><span id="'.$rows['event_id'].'">'.str_replace('&amp;','&',$rows['organiser']).'</span></div>';
    }
}
?>