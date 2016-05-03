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
		
	$month = @$_GET['month'];
$contquery = ($month == '' ) ? "and SortDate >= '$today'" : '';

if($rows_state['name'] == 'Abuja') $location = $rows_state['name']." FCT, Nigeria"; 
		else
$location = $rows_state['name']." State, Nigeria";

if(isset($_GET['category']) || isset($_GET['month']) || isset($_GET['provider']) || isset($_GET['country']) || isset($_GET['state'])){
	
	$country_search = strip_tags($_GET['country']);
	$country_search = mysqli_real_escape_string($sql_connection,$country_search);
			
if(!empty($_GET['category']) && empty($_GET['month']) && empty($_GET['provider']) && empty($_GET['country'])){
	
		$query = "AND category=".$_GET['category'];
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


	$meta_content = " Search for ".$rows_cat['meta_description'];
	$title = 'Conferences, training seminars and workshops in '.$rows_cat['category_name']." - ".@$_GET['page'];

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em></span>';

		}

else if(!empty($_GET['month']) && empty($_GET['category']) && empty($_GET['provider']) && empty($_GET['country'])){
	
		$query = "AND startDate like '%".$_GET['month']."%'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'];


		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em></span>';
}


else if(!empty($_GET['provider']) && empty($_GET['category']) && empty($_GET['month']) && empty($_GET['country'])){
	
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);
	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'];


		$pageInnerTitle = $number.' Event(s) <span > by <em>'.$_GET['provider'].'</em></span>';
}
else if(!empty($_GET['country'])&&!empty($_GET['state']) && empty($_GET['category']) && empty($_GET['provider'])&& empty($_GET['month'])){
		$query = "AND state =".$_GET['state'];
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$location;
	
		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$location.'</em></span>';
}
else if(!empty($_GET['country']) && empty($_GET['month']) && empty($_GET['category']) && empty($_GET['provider'])&&!isset($_GET['state'])){
	
		$query = "AND country='".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$rows_country['countries'].'</em></span>';							
		
}
else if(!empty($_GET['country']) && empty($_GET['month']) && empty($_GET['category']) && empty($_GET['provider'])&& empty($_GET['state'])){

		$query = "AND country='".$country_search."'";
							$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$rows_country['countries'].'</em></span>';	
}
else if(!empty($_GET['category'])&&!empty($_GET['month']) && empty($_GET['provider']) && empty($_GET['country'])){
		$query = " AND category =".$_GET['category']."  AND  startDate like '%".$_GET['month']."%'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em></span>';

}

else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&empty($_GET['country'])&&empty($_GET['month'])){
		$query = " AND category =".$_GET['category']."  AND organiser like '%".addslashes($_GET['provider'])."%'";
		$pageInnerTitle = "category,provider";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted  by '.$_GET['provider'];

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em></span>';
}

else if(!empty($_GET['category'])&&!empty($_GET['country'])&&empty($_GET['provider'])&&empty($_GET['month']) && !isset($_GET['state'])){
		$query = " AND category =".$_GET['category']."  AND country = '".$country_search."'";
		
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
	
	$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions posted  by '.$_GET['provider'];

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}
else if(!empty($_GET['category'])&&!empty($_GET['country'])&&empty($_GET['provider'])&&empty($_GET['month']) && empty($_GET['state'])){
		$query = " AND category =".$_GET['category']."  AND country = '".$country_search."'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);
	
$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}


else if(!empty($_GET['category'])&&!empty($_GET['state']) &&empty($_GET['provider'])&&empty($_GET['month'])){
		$query = " AND category =".$_GET['category']."  AND state = '".$_GET['state']."'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$location;
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$location;

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> in <em>'.$location.'</em></span>';
}


else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['provider'])&& empty($_GET['country'])){
		$query = " AND category =".$_GET['category']." AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%'";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);
				
$meta_content = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'];
	
	$title = $rows_cat['category_name'].' Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em></span>';
}

else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& !isset($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND startDate like '%".$_GET['month']."%' AND country = '".$country_search."'";
		
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

	
	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];


		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}
else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& empty($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND startDate like '%".$_GET['month']."%' AND country = '".$country_search."'";
		
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);

	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$rows_country['countries'];
	

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}


else if(!empty($_GET['category'])&&!empty($_GET['month'])&&!empty($_GET['state'])&&empty($_GET['provider'])){
		$query = " AND category =".$_GET['category']."  AND startDate like '%".$_GET['month']."%' AND state= '".$_GET['state']."'";
		$pageInnerTitle = "category,month, state";
		
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);

	
	$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' in '.$location;


		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> in <em>'.$location.'</em></span>';
}

else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&&empty($_GET['month'])&&!isset($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' by '.$_GET['provider'];
	

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em> by <em>'.$_GET['provider'].'</em></span>';
}
else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&&empty($_GET['month'])&& empty($_GET['state'])){
		$query = " AND category =".$_GET['category']." AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' in '.$rows_country['countries'].' by '.$_GET['provider'];


		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> in <em>'.$rows_country['countries'].'</em> by <em>'.$_GET['provider'].'</em></span>';
}

else if(!empty($_GET['category'])&&!empty($_GET['provider'])&&!empty($_GET['state'])&&empty($_GET['month'])){
		$query = " AND category =".$_GET['category']." AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' in '.$location.' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' in '.$location.' by '.$_GET['provider'];

		$pageInnerTitle = $number.' Event(s) <span > for <em>'.$rows_cat['category_name'].'</em> in <em>'.$location.'</em> by <em>'.$_GET['provider'].'</em></span>';
}

else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&empty($_GET['category'])&&empty($_GET['country'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

	
$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'];


		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em></span>';
}

else if(!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& empty($_GET['category'])&& !isset($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%'  AND country = '".$country_search."'";
								$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
								$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' in '.$rows_country['countries'];

	$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}
else if(!empty($_GET['month'])&&!empty($_GET['country'])&&empty($_GET['provider'])&& empty($_GET['category'])&& empty($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%'  AND country = '".$country_search."'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}

else if(!empty($_GET['month'])&&!empty($_GET['state']) && empty($_GET['provider'])&& empty($_GET['category'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND state = '".$_GET['state']."'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' in '.$location;

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> in <em>'.$location.'</em></span>';
}
else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&&empty($_GET['category'])&&!isset($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
		$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
		$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'].' in '.$rows_country['countries'];


		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}
else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&!empty($_GET['country'])&& empty($_GET['category'])&& empty($_GET['state'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
				$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
				$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'].' in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}

else if(!empty($_GET['month'])&&!empty($_GET['provider'])&&!empty($_GET['state'])&& empty($_GET['category'])){
		$query = " AND startDate like '%".$_GET['month']."%' AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' posted by '.$_GET['provider'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' by '.$_GET['provider'].' in '.$location;

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$location.'</em></span>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country'])&& empty($_GET['category']) && empty($_GET['month'])&&!isset($_GET['state'])){
		$query = " AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'].' in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country'])&& empty($_GET['category']) && empty($_GET['month'])&& empty($_GET['state'])){
		$query = " AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'].' in '.$rows_country['countries'];


		$pageInnerTitle = $number.' Event(s) <span > by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}

else if(!empty($_GET['provider'])&&!empty($_GET['state']) &&empty($_GET['category'])&&empty($_GET['month'])){
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."'";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);

$meta_content = 'Conferences, trainings seminars, workshops, exhibitions posted by '.$_GET['provider'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops by '.$_GET['provider'].' in '.$location;



		$pageInnerTitle = $number.' Event(s) <span > by <em>'.$_GET['provider'].'</em> in <em>'.$location.'</em></span>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['state']) && !empty($_GET['category'])&& !empty($_GET['month'])){
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND state = '".$_GET['state']."' AND startDate like '%".$_GET['month']."%'  AND category = '".$_GET['category']."' ";
						$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
						$number = NUM_ROWS($total);


$meta_content = 'Conferences, trainings seminars, workshops, exhibitions in '.$_GET['month'].' for '.$rows_cat['category_name'].' posted by '.$_GET['provider'].' in '.$location;
	
	$title = 'Conferences, training seminars and workshops in '.$_GET['month'].' for '.$rows_cat['category_name'].' by '.$_GET['provider'].' in '.$location;

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$location.'</em></span>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country']) && !empty($_GET['category'])&& !empty($_GET['month'])&& !isset($_GET['state'])){
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."' AND startDate like '%".$_GET['month']."%'  AND category = '".$_GET['category']."' ";
								$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
								$number = NUM_ROWS($total);




$meta_content = 'Conferences, trainings seminars, workshops, exhibitions for '.$rows_cat['category_name'].' posted by '.$_GET['provider'].' in '.$rows_country['countries'];
	
	$title = 'Conferences, training seminars and workshops for '.$rows_cat['category_name'].' by '.$_GET['provider'].' in '.$rows_country['countries'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].' for '.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
}
else if(!empty($_GET['provider'])&&!empty($_GET['country']) && !empty($_GET['category'])&& !empty($_GET['month'])&& empty($_GET['state'])){
		$query = "AND organiser like '%".addslashes($_GET['provider'])."%' AND country = '".$country_search."' AND startDate like '%".$_GET['month']."%'  AND category = '".$_GET['category']."' ";
										$total = MysqlSelectQuery("select * from events where status = 1 $contquery $query ");
										$number = NUM_ROWS($total);

$meta_content = "Conferences, trainings seminars, workshops, exhibitions in ".$rows_cat['category_name']." posted by ".$_GET['provider'];
	
	$title = "Conferences, training seminars and workshops in ".$rows_cat['category_name']. " posted by ".$_GET['provider'];

		$pageInnerTitle = $number.' Event(s) <span > in <em>'.$_GET['month'].'</em> for <em>'.$rows_cat['category_name'].'</em> by <em>'.$_GET['provider'].'</em> in <em>'.$rows_country['countries'].'</em></span>';
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

	<title><?php echo $title; if (isset($_GET['page'])) echo " Page - ".$_GET['page'];?></title>

<meta name="description" content="<?php echo $meta_content;?> on Nigerians Seminars and trainings<?php if (isset($_GET['page'])) echo " Page - ".$_GET['page'];?>"/>

	

	<!--<link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->
 
<?php include("scripts/headers_new.php");?>

	

</head>



<body>
<script type="text/javascript">
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"BdEse1a8Dq00M9", domain:"nigerianseminarsandtrainings.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=BdEse1a8Dq00M9" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->




<!-- Quantcast Tag -->
<script type="text/javascript">
var _qevents = _qevents || [];

(function() {
var elem = document.createElement('script');
elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js";
elem.async = true;
elem.type = "text/javascript";
var scpt = document.getElementsByTagName('script')[0];
scpt.parentNode.insertBefore(elem, scpt);
})();

_qevents.push({
qacct:"p-2fH5lI6K2ceJA"
});
</script>
<noscript>

<div style="display:none;">

<img src="//pixel.quantserve.com/pixel/p-2fH5lI6K2ceJA.gif" border="0" height="1" width="1" alt="Quantcast"/>

</div>

</noscript>


<?php include("tools/header_new.php");?>



<div id="main">

	

	<div id="content">
    
  <?php include("tools/categories_new.php");?>

		<div id="content_left">

				<div class="sub_links">
                
                <div class="event_table_inner event_bg">

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
<?php include("tools/search_box.php");?>

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
<div class="button_class_right smart-forms" ><a href="<?php echo SITE_URL;?>past_event?business=<?php echo $biz_name['business_id'].'-'.$biz_name['business_name'];?>" class="button btn-primary" ><?php echo 'Past events by '. $biz_name['business_name'];?></a></div><bt />
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