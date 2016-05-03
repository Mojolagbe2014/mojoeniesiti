<?php

require_once("scripts/config.php");

require_once("scripts/functions.php");

$paged = "";

$category_query = "";

$title = "";

$pageInnerTitle = "";

$today = date("Y-m-d");

$advert = "Search";

if(connection());
	$recordperpage =  60;
	$pagenum = 1;
	if(isset($_GET['page'])){
	$pagenum = $_GET['page'];

	}
	$offset = ($pagenum - 1) * $recordperpage;
	
	$categories = MysqlSelectQuery("select * from categories where category_id = '".@$_GET['category']."'");
		$rows_cat = SqlArrays($categories);
		
		$country = MysqlSelectQuery("select * from countries where id = '".@$_GET['country']."'");
		$rows_country = SqlArrays($country);
		
		$state = MysqlSelectQuery("select * from states where id_state = '".@$_GET['state']."'");
		$rows_state = SqlArrays($state);
                
                if(filter_input(INPUT_GET, 'stateDivision')!=NULL && filter_input(INPUT_GET, 'stateMainDivision')!=NULL){
                    $stateDivs = MysqlSelectQuery("SELECT * FROM lagos_divisions WHERE id = '".@$_GET['stateDivision']."'");
                    $rowsStateDivs = SqlArrays($stateDivs);
                }
                $lagSubDivParam = '';$thisLagRegion = '';$availRegions = array(1=>"Badagry", 2=>"Epe", 3=>"Ikeja", 4=>"Ikorodu", 5=>"Lagos");
                if(filter_input(INPUT_GET, 'stateDivision')==NULL && filter_input(INPUT_GET, 'stateMainDivision')!=NULL){
                    $relatedSubDivs = MysqlSelectQuery("SELECT id FROM lagos_divisions WHERE region = '".@$_GET['stateMainDivision']."'");
                    $totalSubDivs = NUM_ROWS($relatedSubDivs);
                    $itemCounter = 1;
                    while ($rowsRelSubDivs = SqlArrays($relatedSubDivs)){
                        $lagSubDivParam .= " division = '".$rowsRelSubDivs[0]. ($itemCounter < $totalSubDivs ? "' OR " : "' ");
                        $itemCounter++;
                    }
                    $thisLagRegion = $availRegions[$_GET['stateMainDivision']]." Division";
                }
	

                
$month = @$_GET['month'];
$contquery = ($month == '' ) ? "and SortDate >= '$today'" : '';

if($rows_state['name'] == 'Abuja') $location = $rows_state['name']." FCT, Nigeria"; 
else $location = (isset($_GET['stateMainDivision']) && $_GET['stateMainDivision']!=NULL ? (isset($_GET['stateDivision']) && $_GET['stateDivision']!=NULL ? $rowsStateDivs['name'].", " : $thisLagRegion.", ") : "").$rows_state['name']." State, Nigeria";

if(isset($_GET['category']) || isset($_GET['month']) || isset($_GET['provider']) || isset($_GET['country']) || isset($_GET['state'])){
	
	$country_search = strip_tags($_GET['country']);
	$country_search = mysqli_real_escape_string($sql_connection,$country_search);
			
if(!empty($_GET['category']) && empty($_GET['month']) && empty($_GET['provider']) && empty($_GET['country'])){
	
		$query = "AND category=".$_GET['category'];
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


	$meta_content = " Search for ".$rows_cat['meta_description'];
	$title = 'Conferences, training seminars and workshops in '.$rows_cat['category_name']." - ".@$_GET['page'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$rows_cat['category_name'].'</em>';

		}

else if(!empty($_GET['month']) && empty($_GET['category']) && empty($_GET['provider']) && empty($_GET['country'])){
	
		$query = "AND startDate like '%".$_GET['month']."%'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'];


		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em>';
}


else if(!empty($_GET['provider']) && empty($_GET['category']) && empty($_GET['month']) && empty($_GET['country'])){
	
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);
	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'];


		$pageInnerTitle = 'Conferences, training seminars and workshops by <em>'.$_GET['provider'].'</em>';
}
else if(!empty($_GET['country'])&&!empty($_GET['state']) && empty($_GET['category']) && empty($_GET['provider'])&& empty($_GET['month'])){
    $divsParam = ($_GET['state'] == 25 && $_GET['stateDivision']!='') ? ' AND division = '.$_GET['stateDivision'] : (($_GET['state'] == 25 && $_GET['stateDivision']=='' && $_GET['stateMainDivision']!='') ? " AND ( $lagSubDivParam ) "  : "");
		$query = "AND state =".$_GET['state']." $divsParam ";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$location;
	
		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$location.'</em>';
}
else if(!empty($_GET['country']) && empty($_GET['month']) && empty($_GET['category']) && empty($_GET['provider'])&&!isset($_GET['state'])){
	
		$query = "AND country='".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$rows_country['countries'].'</em>';							
		
}
else if(!empty($_GET['country']) && empty($_GET['month']) && empty($_GET['category']) && empty($_GET['provider'])&& empty($_GET['state'])){

		$query = "AND country='".$country_search."'";
							$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$rows_country['countries'].'</em>';	
}
else if(!empty($_GET['category'])&&!empty($_GET['month']) && empty($_GET['provider']) && empty($_GET['country'])){
		$query = " AND category =".$_GET['category']."  AND  startDate like '%".$_GET['month']."%'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em>';

}

else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&empty($_GET['country'])&&empty($_GET['month'])){
		$query = " AND category =".$_GET['category']."  AND organiser like '%".addslashes($_GET['provider'])."%'";
		$pageInnerTitle = "category,provider";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted  by '.$_GET['provider'];

		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em>';
}

else if(!empty($_GET['category'])&&!empty($_GET['country'])&&empty($_GET['provider'])&&empty($_GET['month']) && !isset($_GET['state'])){
		$query = " AND category =".$_GET['category']."  AND country = '".$country_search."'";
		
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
	
	$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted  by '.$_GET['provider'];

		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
else if(!empty($_GET['category'])&&!empty($_GET['country'])&&empty($_GET['provider'])&&empty($_GET['month']) && empty($_GET['state'])){
		$query = " AND category =".$_GET['category']."  AND country = '".$country_search."'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);
	
$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em>';
}


else if(!empty($_GET['category'])&&!empty($_GET['state']) &&empty($_GET['provider'])&&empty($_GET['month'])){
    $divsParam = ($_GET['state'] == 25 && $_GET['stateDivision']!='') ? ' AND division = '.$_GET['stateDivision'] : (($_GET['state'] == 25 && $_GET['stateDivision']=='' && $_GET['stateMainDivision']!='') ? " AND ( $lagSubDivParam ) "  : "");
		$query = " AND category =".$_GET['category']."  AND state = '".$_GET['state']."' $divsParam ";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$location;
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$location;

		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> in <em>'.$location.'</em>';
}


else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['provider'])&& empty($_GET['country'])){
		$query = " AND category =".$_GET['category']." AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%'";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);
				
$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em>';
}

else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& !isset($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND startDate like '%".$_GET['month']."%' AND country = '".$country_search."'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];


		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& empty($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND startDate like '%".$_GET['month']."%' AND country = '".$country_search."'";
		
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);

	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];
	

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em>';
}


else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['state'])&&empty($_GET['provider'])){
    $divsParam = ($_GET['state'] == 25 && $_GET['stateDivision']!='') ? ' AND division = '.$_GET['stateDivision'] : (($_GET['state'] == 25 && $_GET['stateDivision']=='' && $_GET['stateMainDivision']!='') ? " AND ( $lagSubDivParam ) "  : "");
		$query = " AND category =".$_GET['category']."  AND startDate like '%".$_GET['month']."%' AND state= '".$_GET['state']."' $divsParam ";
		$pageInnerTitle = "category,month, state";
		
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);

	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$location;


		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> in <em>'.$location.'</em>';
}

else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&&empty($_GET['month'])&&!isset($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' by '.$_GET['provider'];
	

		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em> by <em>'.$_GET['provider'].'</em>';
}
else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&&empty($_GET['month'])&& empty($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' by '.$_GET['provider'];


		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em> by <em>'.$_GET['provider'].'</em>';
}

else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&!empty($_GET['state'])&&empty($_GET['month'])){
		$query = " AND category =".$_GET['category']." AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' in '.$location.' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' in '.$location.' by '.$_GET['provider'];

		$pageInnerTitle = 'Conferences, training seminars and workshops for <em>'.$rows_cat['category_name'].'</em> in <em>'.$location.'</em> by <em>'.$_GET['provider'].'</em>';
}

else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&empty($_GET['category'])&&empty($_GET['country'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

	
$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'];


		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em>';
}

else if(!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& empty($_GET['category'])&& !isset($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%'  AND country = '".$country_search."'";
								$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
								$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' in '.$rows_country['countries'];

	$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
else if(!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& empty($_GET['category'])&& empty($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%'  AND country = '".$country_search."'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> in <em>'.$rows_country['countries'].'</em>';
}

else if(!empty($_GET['month'])&&!empty($_GET['state']) && empty($_GET['provider'])&& empty($_GET['category'])){
    $divsParam = ($_GET['state'] == 25 && $_GET['stateDivision']!='') ? ' AND division = '.$_GET['stateDivision'] : (($_GET['state'] == 25 && $_GET['stateDivision']=='' && $_GET['stateMainDivision']!='') ? " AND ( $lagSubDivParam ) "  : "");
		$query = " AND startDate like '%".$_GET['month']."%' AND state = '".$_GET['state']."' $divsParam ";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' in '.$location;

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> in <em>'.$location.'</em>';
}
else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&&empty($_GET['category'])&&!isset($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'].' in '.$rows_country['countries'];


		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&& empty($_GET['category'])&& empty($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'].' in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em>';
}

else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&!empty($_GET['state'])&& empty($_GET['category'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'].' in '.$location;

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$location.'</em>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country'])&& empty($_GET['category']) && empty($_GET['month'])&&!isset($_GET['state'])){
		$query = " AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'].' in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country'])&& empty($_GET['category']) && empty($_GET['month'])&& empty($_GET['state'])){
		$query = " AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'].' in '.$rows_country['countries'];


		$pageInnerTitle = 'Conferences, training seminars and workshops by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em>';
}

else if(!empty($_GET['provider'])&&!empty($_GET['state']) &&empty($_GET['category'])&&empty($_GET['month'])){
    $divsParam = ($_GET['state'] == 25 && $_GET['stateDivision']!='') ? ' AND division = '.$_GET['stateDivision'] : (($_GET['state'] == 25 && $_GET['stateDivision']=='' && $_GET['stateMainDivision']!='') ? " AND ( $lagSubDivParam ) "  : "");
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."' $divsParam ";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'].' in '.$location;



		$pageInnerTitle = 'Conferences, training seminars and workshops by <em>'.$_GET['provider'].'</em> in <em>'.$location.'</em>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['state']) && !empty($_GET['category'])&& !empty($_GET['month'])){
                $divsParam = ($_GET['state'] == 25 && $_GET['stateDivision']!='') ? ' AND division = '.$_GET['stateDivision'] : (($_GET['state'] == 25 && $_GET['stateDivision']=='' && $_GET['stateMainDivision']!='') ? " AND ( $lagSubDivParam ) "  : "");
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."' $divsParam AND startDate like '%".$_GET['month']."%'  AND category = '".$_GET['category']."' ";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' posted by '.$_GET['provider'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' by '.$_GET['provider'].' in '.$location;

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$location.'</em>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country']) && !empty($_GET['category'])&& !empty($_GET['month'])&& !isset($_GET['state'])){
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."' AND startDate like '%".$_GET['month']."%'  AND category = '".$_GET['category']."' ";
								$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
								$number = NUM_ROWS($total);




$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' by '.$_GET['provider'].' in '.$rows_country['countries'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].' for '.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country']) && !empty($_GET['category'])&& !empty($_GET['month'])&& empty($_GET['state'])){
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."' AND startDate like '%".$_GET['month']."%'  AND category = '".$_GET['category']."' ";
										$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
										$number = NUM_ROWS($total);

$meta_content = "Conferences, trainings seminars, workshops, exhibitions in ".$rows_cat['category_name']." posted by ".$_GET['provider'];
	
	$title = "Conferences, training seminars and workshops in ".$rows_cat['category_name']. " posted by ".$_GET['provider'];

		$pageInnerTitle = 'Conferences, training seminars and workshops in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em>';
}
$result = MysqlSelectQuery("select * from events where  status = 1 $query $contquery ORDER BY premium desc, SortDate limit $offset, $recordperpage");
}
else{
header("HTTP/1.1 301 Moved Permanently");
			header("location:".SITE_URL);
	}

?>


<!DOCTYPE html>



<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

<?php include('tools/analytics.php');?>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />

	<title><?php echo trimStringToFullWord(60, stripslashes(strip_tags($title))); if (isset($_GET['page'])) echo " Pg-".$_GET['page'];?></title>

<meta name="description" content="<?php echo $meta_content;?> on Nigerians Seminars and trainings<?php if (isset($_GET['page'])) echo " Page - ".$_GET['page'];?>"/>


 
<?php include("scripts/headers_new.php");?>

	

</head>



<body>

<?php include("tools/header_new.php");?>



<div id="main">

	

	<div id="content">
    
  <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">
                
                <div class="event_table_inner">

<form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td style="padding-left:8px"><h2 style="font-size:25px; padding:5px;"><?php echo $pageInnerTitle;?></h2></td>
    </tr>
  <tr>
    <td align="center" style="font-size:11px">&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?php //include("tools/search_box.php");?>

				<div class="video_box">
				  <?php include("tools/searchResult.php");?>
                 
				  <?php
				  if(isset($_GET['page'])) $p = $_GET['page']; else $p='';

		if(NUM_ROWS($result) > 0){

                      Paging("SELECT COUNT(event_id) AS numrows FROM events where status = 1 $query $contquery",$recordperpage,$pagenum,SITE_URL.'search?'.str_replace('&page='.$p,'',$_SERVER['QUERY_STRING']));
		}
		
		if(!empty($_GET['provider'])){
	$business = MysqlSelectQuery("select * from businessinfo where business_name like '%".$_GET['provider']."%'");
	if(NUM_ROWS($business) > 0){
		$biz_name = SqlArrays($business);
				?> 
<div class="button_class_right smart-forms" ><a href="<?php echo SITE_URL;?>past-event?business=<?php echo $biz_name['business_id'].'-'.$biz_name['business_name'];?>" class="button btn-primary" ><?php echo 'Past events by '. $biz_name['business_name'];?></a></div><bt />
<?php 
		}
	} ?>
</div>

		

                           <div id="sub_links2_middle"><!-- Begin BidVertiser code -->

 <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>

	
    
 </div>               
        
<div class="clearfix"></div>

</div>

			</div><!-- end subpage -->

			<?php include("tools/side-menu_new.php");?>		

		</div>
        <div class="clearfix"></div>
	</div>
    
     <div class="clearfix"></div>
	</div>


<?php include ("tools/footer_new.php");?>

</body>
</html>