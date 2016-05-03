<?php
session_start();
//Connect to database from here
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

$querySupp = ""; $filterPastDays = '';
if($_GET['month']== date("Y-m")){
    $filterPastDays = ' AND SortDate >= CURRENT_DATE ';
}
if(isset($_GET['category'])){
    $querySupp = " and category=".$_GET['category'];
}
else if(isset($_GET['state']) && !isset($_GET['stateDivision']) && !isset($_GET['stateMainDivision'])){
    $querySupp = " and state=".$_GET['state'];
}
else if(isset($_GET['state']) && isset($_GET['stateDivision']) && !isset($_GET['stateMainDivision'])){
    $querySupp = " AND state=".$_GET['state']." AND division=".$_GET['stateDivision'];
}
else if(isset($_GET['state']) && isset($_GET['stateMainDivision']) && !isset($_GET['stateDivision'])){
    $stateMainDivs = explode(',', $_GET['stateMainDivision']);
    $stateMainDivision='';
    for($count=0; $count<count($stateMainDivs); $count++){
        $stateMainDivision .= " division = ".$stateMainDivs[$count]. ($count < count($stateMainDivs)-1 ? " OR " : " ");
    }
    $querySupp = " AND state=".$_GET['state']." AND ( $stateMainDivision ) ";
}
else if(isset($_GET['country'])){
    $querySupp = " and country=".$_GET['country'];
}
$IsAvailablePremium = false;
$IsAvailableRegular = false;
//regular listing of events	
$query = "and SortDate like '%".$_GET['month']."%'".$querySupp;
$result = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and premium = 0 $query  $filterPastDays ORDER BY rand()");
//echo "SELECT * FROM `events` WHERE status = 1 and premium = 0 $query  $filterPastDays ORDER BY rand()";
?>
<div style="display: block; padding: 1%; text-align: center; font-size: 18px;">Events for <?php echo date("F, Y",strtotime($_GET['month']));?> </div>
<?php
		//select premium events
		$resultPremium = MysqlSelectQuery("SELECT * FROM `events` WHERE status = 1 and premium = 1 $query ORDER BY  rand()");
		if(NUM_ROWS($resultPremium) > 0){
                    $IsAvailablePremium = true;
		# fetch result into the array
					while($rowsPremium = SqlArrays($resultPremium)){	
			if ($rowsPremium['premium'] == 1){
						$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rowsPremium['organiser']."%'");
						$biz_name = SqlArrays($business);
							if($biz_name['logos'] == '') $logo = 'images/star2.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
							$star = '<img src="'.SITE_URL.$logo.'" alt="business logo" width="50" height="50" alt=""/>';

							$clock_icon = '<div class="calendar_time"></div>';

							$bg_class = '';

							$listing_diff = '';

							$start_h1 = '<h2>';

							$end_h1 = '</h2>';
							
							$pre_link = '<a href="'.SITE_URL.'tprovider/'.$biz_name['business_id'].'/'.str_replace($title_link,"-",$biz_name['business_name']).'" target="_blank" style="color:#333; font-weight:normal;">'.$rowsPremium['organiser'].'</a>';

						}
						

			?>
        <div itemscope itemtype="http://schema.org/EducationEvent" class="eventListing <?php echo ($rowsPremium['deals'] != '') ? 'deals' : '' ?>" onClick="javascript:url_location('<?php echo SITE_URL . 'events/' . $rowsPremium['event_id'] . '/' . str_replace($title_link, "-", $rowsPremium['event_title']); ?>')">
        <div class="eventListingInner">
            <a href="<?php echo SITE_URL . 'events/' . $rowsPremium['event_id'] . '/' . str_replace($title_link, "-", $rowsPremium['event_title']); ?>" itemprop="url" style="display:block; padding:3px;" title="<?php echo $rowsPremium['event_title']; ?>">
                <span class="spanTitle" itemprop="name" ><?php echo $rowsPremium['event_title']; ?></span>
            </a> 
            <div class="innerHeadingPropEvent">
                <p itemprop="doorTime" ><?php echo dateDiff($rowsPremium['startDate'], $rowsPremium['endDate']); ?>, 
                    <?php echo date('M d', strtotime($rowsPremium['startDate'])) . " - " . date('d M, Y', strtotime($rowsPremium['endDate'])); ?> &nbsp;</p>
                <span style="display:none;" itemprop="startDate" content="<?php echo date('Y-m-d h:m:s', strtotime($rowsPremium['startDate'])); ?>"><?php echo date('Y-m-d h:m:s', strtotime($rowsPremium['startDate'])); ?>
                </span>

                <div class="clearfix"></div>   
            </div>  

            <span itemprop="location" style="text-align:center; display:block;">
                <?php echo GetEventLocation($rowsPremium['event_id']); ?>
            </span>
            <div class="respond">
                <div class="testImg" style="background-image:url(<?php echo SITE_URL . $logo; ?>); background-repeat:no-repeat; background-position:center;">
                </div>
            </div>
            <p style="text-align:center; font-size:14px; color: #105773; margin:5px 0 5px 0;" >
                <?php echo $rowsPremium['organiser']; ?>
            </p>
            <div class="trainingProviders" style="width:100%;">
                <div style="color:#000; font-size:12px; text-align:left;"  class="description" itemprop="description" ><?php echo trimStringToFullWord(145, $rowsPremium['description']) . ' ...'; ?> </div>
            </div> 
        </div>

        <div class="clearfix"></div>   
    </div>
  <?php

						}
                }
                    include("searchResult.php");
                    
                    //if((!$IsAvailablePremium) && (!$IsAvailableRegular)){
					?>
                    <!--<div style="display: block; padding: 1%; text-align: center; font-size: 14px; color: #D8325D;">Found no event</div>-->
                    <?php 
                  //  }