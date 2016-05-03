<?php
//error_reporting(0);
date_default_timezone_set('Africa/Lagos');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
include("timeinterval.php");
include("advertsClass.php");
include("htmlEmail.php");

if(!strpos($_SERVER['SCRIPT_NAME'], 'payment'))
header('Content-type: text/html; charset=UTF-8') ;
//$_SESSION['action_url'] = "";
//array for the add event form field
function normalize_str($str)
{
$invalid = array('�'=>'S', '�'=>'s','�'=>'Dj','�'=>'Z','�'=>'z',
'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c', '�'=>'A', '�'=>'A', '�'=>'A', '�'=>'A',
'�'=>'A', '�'=>'A', '�'=>'A', '�'=>'C', '�'=>'E', '�'=>'E', '�'=>'E', '�'=>'E',
'�'=>'I', '�'=>'I', '�'=>'I', '�'=>'I', '�'=>'N', '�'=>'O', '�'=>'O', '�'=>'O',
'�'=>'O', '�'=>'O', '�'=>'O', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'U', '�'=>'Y',
'�'=>'B', '�'=>'Ss', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a', '�'=>'a',
'�'=>'a', '�'=>'c', '�'=>'e', '�'=>'e', '�'=>'e',  '�'=>'e', '�'=>'i', '�'=>'i',
'�'=>'i', '�'=>'i', '�'=>'o', '�'=>'n', '�'=>'o', '�'=>'o', '�'=>'o', '�'=>'o',
'�'=>'o', '�'=>'o', '�'=>'u', '�'=>'u', '�'=>'u', '�'=>'y',  '�'=>'y', '�'=>'b',
'�'=>'y', 'R'=>'R', 'r'=>'r', "`" => "'", "�" => "'", "�" => ",", "`" => "'",
"�" => "'", "�" => "\"", "�" => "\"", "�" => "'", "&acirc;��" => "'", "{" => "",
"~" => "", "�" => "-", "�" => "'"," "=>"-",":"=>"-",","=>"-","/"=>"-"," "=>"-");
 
$str = str_replace(array_keys($invalid), array_values($invalid), $str);
 
return $str;
}
$title_link = array(",","]","[","/","'","�", "&", "%", ")", "(","+","=",":"," ","-","'","|","@","#","!","$","*","^",";","<",">","?","~","'\'",".","_","�",'"',"�","�","?","�");

$AfricaRegion = array("Eastern Africa"=>"1","Central Africa"=>"2","Northern Africa"=>"3","Southern Africa"=>"4","Western Africa"=>"5");

$add_event = array('entrant_name'=>'','email'=>'','phone'=>'','title'=>'','description'=>'','venue'=>'','category'=>'','cost'=>'','organizer'=>'','facilitator'=>'','start_date'=>'','end_date'=>'','website'=>'','country'=>"",'state'=>"",'verify'=>"","verifyHidden"=>"","tags"=>"","vat"=>"", "division"=>"");
$business = array("business_name"=>"","email"=>"","description"=>"","address"=>"","size"=>"","capacity"=>"","contact_person"=>"","telephone"=>"","website"=>"","buz_type"=>"",'verify'=>"","verifyHidden"=>"","price"=>"","category"=>"",'country'=>"","designation"=>"","cmd-accr-number"=>"","cmd-accr-year"=>"");
$vacancies = array("title"=>"","experience"=>"","type"=>"","country"=>"","category"=>"","city"=>"","description"=>"","company_name"=>"","contact_person"=>"","telephone"=>"","email"=>"",'verify'=>"","verifyHidden"=>"");
$subscribers = array("email_sub"=>"","fname"=>"","lname"=>"","phone"=>"","organization"=>"","address"=>"","city"=>"","state"=>"","country"=>"","category"=>"",'verify'=>"","verifyHidden"=>"","username"=>"","designation"=>"", "password"=>"");
$news = array('title'=>'','description'=>'');
$articles = array('title'=>'','description'=>'','author'=>'','authorEmail'=>"","detail"=>"","tags");
$video = array("video_title"=>"","video_id"=>"","email"=>"","description"=>"","posted_by"=>"","website"=>"","telephone"=>"",'verify'=>"");
$adverts = array("title"=>"","size"=>"","adType"=>"","pageType"=>"","location"=>"","adposition"=>"","ppcCode"=>"");
$payments = array("business_name"=>"","contact_person"=>"","email"=>"","teller_no"=>"","amount_deposited"=>"","date_deposit"=>"","business_type"=>"","plan"=>"");
$paymentsTrainers = array("jobTitle"=>"","facilitatorsName"=>"","email"=>"","telephone"=>"","address"=>"");
$pages = array("Index"=>"","Event Detail"=>"","All Events"=>"","Event Managers"=>"","Suppliers"=>"","Training Providers"=>"","All Vacancies"=>"","Search"=>"","Venues"=>"","News"=>"","Articles"=>"","Vacancy Detail"=>"","Subscribers"=>"","Add Event"=>"","Add Business Info"=>"","Add Vacancies"=>"","About Us"=>"","Login"=>"","Privacy Policy"=>"","Terms Of Use"=>"", "Facilitators"=>"", "Premium Listing"=>"", "Advertise"=>"", "Quotes"=>"");
$Indexpositions = array("Index TopBanner 1"=>"","Index TopBanner 2"=>"","Index TopBanner Small"=>"","Index SideBanner 1"=>"","Index SideBanner 2"=>"", "Index SideBanner 3"=>"", "Index SideBanner 4"=>"","Index PageBanner 1"=>"", "Index PageBanner 2"=>"","Index Small SideAds"=>"","Index Skyscrapper"=>"","Logo Banner"=>"","Right Banner"=>"","Left Banner"=>"","Index Skyscrapper Left"=>"","Index Skyscrapper Left 2"=>"","Index Skyscrapper Right"=>"", "Index Skyscrapper RightBottom"=>"");
$otherPages = array("Top Banner"=>"","Page Banner 1"=>"","Page Banner 2"=>"","Side Banner 1"=>"","Side Banner 2"=>"","Small SideAds"=>"","TopBanner Small"=>"","Logo Banner"=>"","Page Skyscapper Left"=>"");
// general insert, delete, update query function
function MysqlQuery($Insertquery){
	global $sql_connection;
	$query = $Insertquery;
	$result = mysqli_query($sql_connection,$query) or die("Invalid Query: ".mysqli_error($sql_connection));
	if($result){
		return true;
	}
}

function EscapeStrings($string){
	global $sql_connection;
	$escaped = mysqli_real_escape_string($sql_connection,$string);
	return $escaped;
}
function MysqlInsertQuery($Insertquery){
	global $sql_connection;
	$query = $Insertquery;
	$result = mysqli_query($sql_connection,$query) or die("Invalid Query: ".mysqli_error($sql_connection));
		return $result ;
}
function NUM_ROWS($result){
	$number = mysqli_num_rows($result);
	return $number;
}
function SqlArrays ($result){
	$array = mysqli_fetch_array($result);
	return $array;
}
function NewlyInsertedId (){
	$id = $sql_connection->insert_id;
	return $id;
}
// retrieving query
function MysqlSelectQuery($Insertquery){
	$query = $Insertquery;
	global $sql_connection;
	$result = mysqli_query($sql_connection,$query) or die("Invalid Query: ".mysqli_error($sql_connection));
		return $result;
}
function CatchViews($id){
	MysqlQuery("update events set no_views=no_views + 1 where event_id='$id'");
}

function CatchBusinessViews($id){
	MysqlQuery("update businessinfo set view_counter=view_counter + 1 where business_id='$id'");
}

function CatchDailyViews($id){
	$result = MysqlSelectQuery("select * from event_views_stats where event_id=$id and date_view='".date('Y-m-d')."'");
	//update views if event and todays date match
	if(NUM_ROWS($result) > 0){
		MysqlQuery("update event_views_stats set views=views + 1 where event_id='$id' and date_view='".date('Y-m-d')."'");
	}
	else{
		//insert new record for the view 
		MysqlQuery("insert into event_views_stats (event_id,date_view, views) values ($id, '".date('Y-m-d')."', 1)");
	}
}

function successMsg($message){
	$msg = '<div id="successMsg"><img src="'.SITE_URL.'images/sucicon.png" alt="Nigerian seminars and training success icon"/>'.$message.'</div>';
	return $msg;
}
function warningMsg($message){
	$msg = '<div id="warningMsg"><img src="'.SITE_URL.'nstlogin/images/adminicons/warning.png" alt="Nigerian seminars and training warning icon"/>'.$message.'</div>';
	return $msg;
}
function errorMsg($message){
	$msg = '<div id="errorMsg">
	<img src="'.SITE_URL.'images/erroricon.png" alt="Nigerian seminars and training error icon"/>'.$message.'</div>';
	return $msg;
}
function isValidURL($url)
{
return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
}
function CountReplies($comment_id,$article_id){
$result = MysqlSelectQuery("select count(reply_id) as numRows from comment_reply where comment_id='$comment_id' and article_id='$article_id'");
	$rows = SqlArrays($result);
	$count = ($rows['numRows'] == 0) ? $count = "" : $count = $rows['numRows'];
	return $count;
}
function CommentCount($id){
	$result = MysqlSelectQuery("select count(comment_id) as numRows from comment where article_id='$id'");
	$rows = SqlArrays($result);
	$count = $rows['numRows'];
	return $count;
}

function GetBusinessLogo($id){
$logo = MysqlSelectQuery("select * from logos where user_id='".$id."'");
$logoImage = SqlArrays($logo);
return $logoImage['logos'];
}
/***************************************************** Country Categorization Function************************************************************/
function RegionListing($type,$id){
	 global $AfricaRegion;
	 if($id == 1){
	 ?>
	           
                        <ul>
                        <?php
						krsort($AfricaRegion);
						foreach($AfricaRegion as $key => $val){
						?>
                        <li><a href="#" class="parent" ><span><?php echo $key;?></span></a>
                        
                        <ul>
                        <?php $region = MysqlSelectQuery("select * from countries where africRegion='$val' order by countries='Nigeria' desc ");
						while($rowsRegion = SqlArrays($region)){
							if($rowsRegion['countries'] == 'Nigeria' ){
                            $states = MysqlSelectQuery("select * from states order by name ='Lagos' desc");
							echo '<li><a href="'.SITE_URL.$type.'/countries/'.$rowsRegion['id'].'/'.str_replace(" ","-",$rowsRegion['countries']).'" class="parent" ><span>'.$rowsRegion['countries'].'</span></a> 
							
                        <ul>';
									while($rows_states = SqlArrays($states)){?>
                                    <li><a href="<?php echo SITE_URL.$type.'/state/'.$rows_states['id_state'].'/'.$rows_states['name'];?>" ><span><?php echo $rows_states['name'];?></span></a></li>
							<?php
                            }
							echo '</ul></li>';
						
						}
						else{
							?>
                             <li><a href="<?php echo SITE_URL.$type.'/countries/'.$rowsRegion['id'].'/'.str_replace(" ","-",$rowsRegion['countries']);?>"><span><?php echo $rowsRegion['countries'];?></span></a></li>
                             <?php
						}
					}
						?>
                        </ul>
                        
                        </li>
                        <?php
						}
						?>
                        </ul>
                       
                        <?php
	 }
						else{
							?>
                           
                             <ul>
                               <?php $region = MysqlSelectQuery("select * from countries where continent = $id ");
						while($rowsRegion = SqlArrays($region)){
							?>
                             <li><a href="<?php echo SITE_URL.$type.'/countries/'.$rowsRegion['id'].'/'.str_replace(" ","-",$rowsRegion['countries']);?>" ><span><?php echo $rowsRegion['countries'];?></span></a></li>
                             <?php
						}
						?>
                       </ul>
                      
					<?php		
					}
 }
/*****************************************************************************************************************/
/********************************************************************************************************
Url Rewrite Paging
*******************************************************************/
function Pages_rewrite($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="prev" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }
		
	  if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $maxpage) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="next" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}
function Pages_rewrite_mobile($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);
	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="prev" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
           // echo '<span class="prn">...</span>&nbsp;';
        }
		
	 /* if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }*/

        if($current < $maxpage) {
            $i = $current+1;
           // echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="next" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p>(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}
/****************************************
End Url Rewrite Paging
*******************************/
function Pages_users($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="prev" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }
		
	  if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'page/'.$i.'/" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $maxpage) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="next" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}
/********************************************************************************************************
Url Rewrite Paging
*******************************************************************/
function Paging($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'&amp;page='.$i.'" class="prn" rel="prev" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }
		
	  if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'&amp;page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$pagelink.'&amp;page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'&amp;page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $maxpage) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$pagelink.'&amp;page='.$i.'" class="prn" rel="next" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p>
			<div class="clearfix"></div>
			</div>';
        }
}
/****************************************
End Url Rewrite Paging
*******************************/

/********************************************************************************************************
Url Rewrite Paging
*******************************************************************/
function Pages_admin($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 25;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="pagination">';

        if($current==1) {
            echo '<span class="disabled">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="prev" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }
		
	  if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo '<span class="current">'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $maxpage) {
            $i = $current+1;
            echo '<span>...</span>&nbsp;';
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="next" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="disabled">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}

function PagingMobile($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="paging">';

        if($current==1) {
            echo '<span class="prn">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'&amp;page='.$i.'" class="prn" rel="prev" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
        }
		
	 /* if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo '<span>'.$i.'</span>&nbsp;';
            } else {
                echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }
*/
        if($current < $maxpage) {
            $i = $current+1;
            echo '<a href="'.$pagelink.'&amp;page='.$i.'" class="prn" rel="next" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p>(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}
/****************************************
End Url Rewrite Paging
*******************************/
function nicetime($date)

{

if(empty($date)) {

return "No date provided";

}

$periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");

$lengths = array("60","60","24","7","4.35","12","10");

$now = time();

$unix_date = strtotime($date);

// check validity of date

if(empty($unix_date)) {

return "Bad date";

}

// is it future date or past date

if($now > $unix_date) {

$difference = $now - $unix_date;

$tense = "ago";

} else {

$difference = $unix_date - $now;
$tense = "from now";}

for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {

$difference /= $lengths[$j];

}

$difference = round($difference);

if($difference != 1) {

$periods[$j].= "s";

}

return "$difference $periods[$j] {$tense}";

}

function smcf_validate_email($email) {
	$at = strrpos($email, "@");

	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen($email)))
		return false;

	// Make sure there aren't multiple periods together
	if (preg_match("/(\.{2,})/", $email))
		return false;

	// Break up the local and domain portions
	$local = substr($email, 0, $at);
	$domain = substr($email, $at + 1);


	// Check lengths
	$locLen = strlen($local);
	$domLen = strlen($domain);
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
		return false;

	// Make sure local and domain don't start with or end with a period
	if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
		return false;

	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (!preg_match('/^"(.+)"$/', $local)) {
		// It's a dot-string address...check for valid characters
		if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
			return false;
	}

	// Make sure domain contains only valid characters and at least one period
	if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
		return false;	

	return true;
}

/*Created by Barrett at RRPowered.com*/
//Call the function

function time_ago($cur_time){
	if($cur_time == "")return "No date provided";
	else
$time_ = time() - strtotime($cur_time);

$seconds =$time_;
$minutes = round($time_ / 60);
$hours = round($time_ / 3600);
$days = round($time_ / 86400);
$weeks = round($time_ / 604800);
$months = round($time_ / 2419200);
$years = round($time_ / 29030400);

//Seconds

if($seconds <= 60){

   $time="Today";//"$seconds seconds ago";   

//Minutes

}else if($minutes <= 60){

   //if($minutes == 1){
   $time="Today";//"one minute ago";
  // }else{
//   $time="$minutes minutes ago";
//   }

//Hours

}else if($hours <= 24){

 // if($hours == 1){
  $time="Today";//"one hour ago";
 /* }else{
  $time="$hours hours ago";
  }*/

//Days

}else if($days <= 7){

   if($days == 1){
   $time="Yesterday";
   }else{
   $time="$days days ago";
   }

//Weeks

}else if($weeks <= 4){

  if($weeks == 1){
  $time="A week ago";
  }else{
  $time="$weeks weeks ago";
  }

//Months

}else if($months <= 12){

  if($months == 1){
  $time="A month ago";
  }else{
  $time="$months months ago";
  }

//Years

}else{  

  if($years == 1){
  $time="A year ago";
  }else{
  $time="$years years ago";
  }  

}
return $time;
}
function Get_News(){
	global $title_link;
	if(connection()){
		$date = date("Y-m-d");
		
		$result_1 = MysqlSelectQuery("select * from news where status = 1");
		while($check_exp_stat = SqlArrays($result_1)){
			if($date > $check_exp_stat['exp_date']){
				MysqlQuery("update news set archive=1 where news_id ='".$check_exp_stat['News_id']."'");
			}
		}
		$result = MysqlSelectQuery("select * from news where status = 1 order by news_id desc limit 0, 5");
		if(NUM_ROWS($result) > 0){
		while($rows = SqlArrays($result)){
			//this gets title stores it in $newFile
			$newFile = trim(WordTruncate($rows['newsTitle'], 50)); //Use seven words as file name
			$newFile = str_replace(" ", "000", $newFile);
			//Remove special Characters
			$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
			//Replace spaces with dash/hyphen
			$newFile = str_replace("000", "-", $newFile);
			$newFile = str_replace("--", "-", $newFile);
			//Covert d name to lowercase
			$newFile = strtolower($rows['News_id']."-".$newFile);//.".php"
			$description = substr(strip_tags(stripslashes($rows['description'])),0,160).'... ';
			$image = ($rows['image'] == "") ? SITE_URL.'images/news_image_BIG.png' : SITE_URL.'nstlogin/articles_images/'.$rows['image'];
			echo '<li onclick="javascript:url_location(\''.SITE_URL.'newspg/'.$newFile.'\')"><h4 style="font-size:13px; font-weight:normal;"><img src="'.$image.'" style="width:50px; height:50px; float:left; margin-right:5px;" /><a href="'.SITE_URL.'newspg/'.$newFile.'" title="'.$rows['newsTitle'].'" ><span style="color:#0C8EB9;">'.$rows['newsTitle'].'</span></a></h4>
			<div class="clearfix"></div>
			</li>';
			}
			
		}
		else{
			echo "<li> ---- No current news ---- </li>";
		}
	}
}

/*******************************************************************************************************************************************/
function Get_Articles(){
	global $title_link;
	if(connection()){
		$date = date("Y-m-d");
		
	
		$result = MysqlSelectQuery("select * from articles where status =1 order by article_id desc limit 0, 5");
		if(NUM_ROWS($result) > 0){
		while($rows = SqlArrays($result)){
			//this gets the characters 0 to the period and stores it in $newFile
			$newFile = substr(trim($rows['article_title']), 0, 45);
			$newFile = str_replace(" ", "000", $newFile);
			//Remove special Characters
			$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
			//Replace spaces with dash/hyphen
			$newFile = str_replace("000", "-", $newFile);
			$newFile = str_replace("--", "-", $newFile);
			//Covert d name to lowercase
			$newFile = strtolower($rows['article_id']."-".$newFile);//.".php"
			$description = substr(strip_tags(stripslashes($rows['article_description'])),0,160).'... ';
			$image = ($rows['articleImage'] == "") ? SITE_URL.'images/nigerianseminars_logo.jpg' : SITE_URL.'nstlogin/articles_images/'.$rows['articleImage'];
			echo '<li onclick="javascript:url_location(\''.SITE_URL.'articlespg/'.$newFile.'\')"><h4 style="font-size:13px; font-weight:normal;"><img src="'.$image.'" style="width:50px; height:50px; float:left; margin-right:5px;" /><a href="'.SITE_URL.'articlespg/'.$newFile.'" title="'.$rows['article_title'].'" ><span style="color:#0C8EB9;">'.$rows['article_title'].'</span><br> <span style="color:#000; font-size:10px; margin-top:-0.05%;">By: '.substr($rows['author'], 0, 30).'</span></a></h4><div class="clearfix"></div>
			</li>';
		
			}
			
		}
	}
}

/*******************************************************************************************************************************************/

/*******************************************************************************************************************************************/
function Get_Recent_Event(){
	global $title_link;
	if(connection()){
		$date = date("Y-m-d");
		//where posted_date between '".date('Y-m-d')."' and '".date("Y-m-d", strtotime('1 week ago'))."'
		echo '<ul id="vertical-ticker">';
	
		$result = MysqlSelectQuery("select * from events where posted_date between '".date('Y-m-d', strtotime('2 week ago'))."' and '".date("Y-m-d")."' and status =1  order by RAND() ");
	
		while($rows = SqlArrays($result)){
			echo '<li><a href="'.SITE_URL.'event_detail?id='.$rows['event_id'].'">'.$rows['event_title'].'</a><br /><span>Posted : '.time_ago($rows['posted_date']).'</span></li>';
		
			}
			
echo '</ul>';
	}
}

/*******************************************************************************************************************************************/

function Get_Newsletter(){
	global $title_link;
	if(connection()){
		$date = date("m");
		$result = MysqlSelectQuery("select * from newsletters where date_posted like'%$date%' and type='Write Up' order by date_posted desc limit 0, 5");
		if(NUM_ROWS($result) > 0){
		while($rows = SqlArrays($result)){
			echo '<li><a href="'.SITE_URL.'newsletter/'.$rows['news_art_ID'].'/'.date("F,Y",strtotime($rows['date_posted'])).'">'.date("F,Y",strtotime($rows['date_posted'])).'</a></li>';
		
			}
			
		}
		else{
			echo "<li> ---- No current newsletter ---- </li>";
		}
	}
}
/********************************************************************************************************************************************/

function Get_News_s(){
	global $title_link;
	if(connection()){
		$date = date("Y-m-d");
		
		$result_1 = MysqlSelectQuery("select * from news where status = 1");
		while($check_exp_stat = SqlArrays($result_1)){
			if($date > $check_exp_stat['exp_date']){
				MysqlQuery("update news set archive=1 where news_id ='".$check_exp_stat['News_id']."'");
			}
		}
		$result = MysqlSelectQuery("select * from news where archive=0 and status = 1 order by news_id desc limit 0, 5");
		if(NUM_ROWS($result) > 0){
		while($rows = SqlArrays($result)){
			echo '<li><a href="http://www.nigerianseminarsandtrainings.com/news/'.$rows['News_id'].'/'.str_replace($title_link,"-",substr($rows['newsTitle'],0,150)).'/">'.$rows['newsTitle'].'</a></li>';
		
			}
		}
		else{
			echo "<li> ---- No current news ---- </li>";
		}
	}
}

function Get_News_Archive(){

if(connection()){

    // Fetch all the data
    $result = MysqlSelectQuery("select * from news where archive =1 order by posted_date desc limit 0, 5");
    if(NUM_ROWS($result) > 0)
    {
    // An array to store the data in a more managable order.
    $data = array();
    // Add each entry to the $data array, sorted by Year and Month
	
    while($row = SqlArrays($result))
    {
    $year = date('Y', strtotime($row['exp_date']));
    $month = date('F', strtotime($row['exp_date']));
    $data[$year][$month][] = $row;
    }
   // $result->free();
    // Go through each Year and Month and print a list of entries, sorted by month.
	 echo '<ul class="treeview" id="tree">';
    foreach($data as $_year => $_months)
    {
   
	echo '<li class="expandable"><div class="hitarea expandable-hitarea"></div><a href="#">'.$_year.'</a><ul style="display: none;">';
    foreach($_months as $_month => $_entries)
    {
    echo '<li class="expandable"><div class="hitarea expandable-hitarea"></div><a href="#">'.$_month.'</a>';
    echo '<ul style="display: none;">';
    foreach($_entries as $_entry)
    {
    echo '<li><a href="'.SITE_URL.'news/'.$_entry['News_id'].'/'.str_replace($title_link,"-",substr($_entry['newsTitle'],0,150)).'/">'.$_entry['newsTitle'].'</a></li>';
    }
    echo "</ul></li>";
    }
	echo "</ul></li>";
    }
	echo "</ul>";
    }
}
   

	
	/*global $title_link;
	if(connection()){
		$date = date("Y-m-d", strtotime("+ 1 week"));
		$result = MysqlSelectQuery("select * from news where posted_date >='$date' order by news_id desc limit 0, 5");
		if(NUM_ROWS($result) > 0){
		while($rows = SqlArrays($result)){
			echo '<li><a href="https://www.nigerianseminarsandtrainings.com/news/'.$rows['News_id'].'/'.str_replace($title_link,"-",substr($rows['newsTitle'],0,150)).'">'.$rows['newsTitle'].'</a></li>';
		
			}
		}
		else{
			echo "<li> ---- No current news ---- </li>";
		}
		
	}*/
}

function AdminNotificationMail($title, $provider, $date){
// Add Email Address
$to = 'info@nigerianseminarsandtrainings.com';
$subject = "New and unapproved Event notification";
$message .= "You have one new event ";
$message .= "\n";
$message .= "Event Title: $title";
$message .= "\n";
$message .= "Provider: $provider";
$message .= "\n";
$message .= "Posted Date: $date";

$headers = "From: <no_reply@nigerianseminarsandtrainings.com> ";

	mail($to, $subject, $message, $headers);

}
function AdminContactMail($title, $provider, $date){
// Add Email Address
$to = 'info@nigerianseminarsandtrainings.com';
$subject = "Enquiry";
$message .= "You have one new event ";
$message .= "\n";
$message .= "Event Title: $title";
$message .= "\n";
$message .= "Provider: $provider";
$message .= "\n";
$message .= "Posted Date: $date";

$headers = "From: no_reply <no_reply@nigerianseminarsandtrainings.com>";

	mail($to, $subject, $message, $headers);

}

function random($lenght){
	$characters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$name = "";
	for($i = 0; $i< $lenght; $i++){
		$name.= $characters[mt_rand(0, strlen ($characters) - 1)];
	}
	return $name;
}
// Credits: http://www.bitrepository.com/
function highlight($str, $keywords = '')
{
$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter

$style = 'highlight';
$style_i = 'highlight_important';

/* Apply Style */

$var = '';

foreach(explode(' ', $keywords) as $keyword)
{
$replacement = "<span class='".$style."'>".$keyword."</span>";
$var .= $replacement." ";

$str = str_ireplace($keyword, $replacement, $str);
}

/* Apply Important Style */

$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str);

return $str;
}
function thumbnail($source,$thumb_width,$destination){
	//$image="";
	$ext = substr(strrchr($source, "."), 1); 	
	$size = getimagesize($source);
	$width = $size[0];
	$height = $size[1];
	$x = 0;
	$y = 0;
	if ($width > $height){
		$x = ceil(($width - $height) / 2 );
		$width = $height;
	}
	elseif($height > $width ){
		$y = ceil(($height - $width) / 2);
		$height = $width;
	}
	$newimage = @imagecreatetruecolor($thumb_width,$thumb_width) or die("Cannot GD image stream");
	switch ($ext){
		case"jpg":
		$image = imagecreatefromjpeg($source);
		break;
		case"JPG":
		$image = imagecreatefromjpeg($source);
		break;
		case"JPEG":
		$image = imagecreatefromjpeg($source);
		break;
		case"jpeg":
		$image = imagecreatefromjpeg($source);
		break;
		case"gif":
		$image = imagecreatefromgif($source);
		break;
		case"png":
		$image = imagecreatefrompng($source);
		break;
	}
	imagecopyresampled($newimage,$image,0,0,$x,$y,$thumb_width,$thumb_width,$width,$height);
	//imageantialias($destination, TRUE);
		
		switch ($ext){
		case"jpg":
		imagejpeg($newimage,$destination);
		break;
		case"JPG":
		imagejpeg($newimage,$destination);
		break;
		case"JPEG":
		imagejpeg($newimage,$destination);
		break;
		case"jpeg":
		imagejpeg($newimage,$destination);
		break;
		case"gif":
		imagegif($newimage,$destination);
		break;
		case"png":
		imagepng($newimage,$destination);
		break;
	}
	
}
function getLatLng($opts) {
	
	/* grab the XML */
	$url = 'http://maps.googleapis.com/maps/api/geocode/xml?' 
		. 'address=' . $opts['address'] . '&sensor=' . $opts['sensor'];
	
	$dom = new DomDocument();
	$dom->load($url);
	
	/* A response containing the result */
	$response = array();
	
	$xpath = new DomXPath($dom);
	$statusCode = $xpath->query("//status");

	/* ensure a valid StatusCode was returned before comparing */
	if ($statusCode != false && $statusCode->length > 0 
		&& $statusCode->item(0)->nodeValue == "OK") {
	
		$latDom = $xpath->query("//location/lat");
		$lonDom = $xpath->query("//location/lng");
		$addressDom = $xpath->query("//formatted_address");
		
		/* if there's a lat, then there must be lng :) */
		if ($latDom->length > 0) {
			
			$response = array (
				'status' 	=> true,
				'message' 	=> 'Success',
				'lat' 		=> $latDom->item(0)->nodeValue,
				'lon' 		=> $lonDom->item(0)->nodeValue,
				'address'	=> $addressDom->item(0)->nodeValue
			);

			return $response;
		}	
		
	}

	$response = array (
		'status' => false,
		'message' => "Oh snap! Error in Geocoding. Please check Address"
	);
	return $response;
}
function GetFilename($path){
$file = basename($path);         // $file is set to "index.php"
$file = basename($path, ".php"); // $file is set to "index"
return $file;
}


function GetCategory(){
	$query = 'select * from categories';
	$result=MysqlSelectQuery($query);
	$list = '<option value="">Please select a category</option>';
	while ($rows = SqlArrays($result)){
	$list.='<option value="'.$rows['category_id'].'">'.str_replace("/"," / ",$rows['category_name']).'</option>';
	}
	return  $list;
	}
	
	function GetCategoryByID($id){
	$query = 'select * from categories where category_id='.$id;
	$result=MysqlSelectQuery($query);
	$rows = SqlArrays($result);
	return str_replace("/"," / ",$rows['category_name']);
	}
	
	
	function GetContries(){
	$query = 'select * from countries order by countries';
	$result=MysqlSelectQuery($query);
	$list = '<option value="">Select Country</option>';
	while ($rows = SqlArrays($result)){
	$list.='<option value="'.$rows['id'].'">'.$rows['countries'].'</option>';
	}
	return  $list;
	}
	
	function GetTrainingProvider(){
	$query = 'select organiser from events group by organiser ';
	$result=MysqlSelectQuery($query);
	$list = '<option value="">Please select a Training Provider (optional)</option>';
	while ($rows = SqlArrays($result)){
	$list.='<option value="'.$rows['organiser'].'" style="width:200px">'.$rows['organiser'].'</option>';
	}
	return  $list;
	}
	
	function GetState(){
	$query = 'select * from states where state_id=38';
	$result=MysqlSelectQuery($query);
	$list = '';
	while ($rows = SqlArrays($result)){
	$list.='<option value="'.$rows['id_state'].'">'.$rows['name'].'</option>';
	}
	return  $list;
	}
        
        function getLagosDivisions($selected=''){
            $availRegions = array("Badagry"=>1, "Epe"=>2, "Ikeja"=>3, "Ikorodu"=>4, "Lagos"=>5);
            $list = '<option value = ""> -- Select a Division (Lagos State Only) -- </option>';
            
            foreach ($availRegions as $key => $value) {
                $list .= '<option style="color:red" disabled="disabled">'.$key.' Division</option>';
                $result = MysqlSelectQuery("SELECT * FROM lagos_divisions WHERE region = $value ");
                while($rows = SqlArrays($result)){
                    $currSel = !empty($selected) && is_numeric($selected) && $rows['id']==$selected ? 'selected="selected"' : "";
                    $list.= '<option value="'.$rows['id'].'" '.$currSel.'>'.$rows['name'].'</option>';
                }
            }
            return  $list;
	}
	
	function GetEventLocation($eventID){
						$result= MysqlSelectQuery("SELECT * FROM `events` WHERE event_id=$eventID");
						$rows = SqlArrays($result);
						if($rows['country'] == 38){
							$location ="";
							$query = 'select * from states where id_state='.$rows['state'];
							$resultstate=MysqlSelectQuery($query);
						$rows_state = SqlArrays($resultstate);
							if($rows_state['name'] == 'Abuja') $location = $rows_state['name']." FCT, Nigeria"; 
							else
							$location = $rows_state['name']." State, Nigeria";
							return $location;
						}
						else{
							$query = 'select * from countries where id='.$rows['country'];
							$resultcountry=MysqlSelectQuery($query);
							$rows_country = SqlArrays($resultcountry);
							$location = $rows_country['countries'];
							return $location;
						}
						
					}
					
					function GetFeaturedVenue(){
						global $title_link;
						$result= MysqlSelectQuery("SELECT * FROM `businessinfo` WHERE status=1 and premium=2 and business_type='Venue' order by rand() ");
						
						
						$image='';
						while($rows = SqlArrays($result)){
							//get the logos from the logo table
							$resultLogo = MysqlSelectQuery("SELECT * FROM `logos` WHERE user_id = '".$rows['user_id']."'");
							$rowLogo = SqlArrays($resultLogo);
							//check if user already has a logo uploaded
							if(NUM_ROWS($resultLogo) == 0) $img = 'images/no_icon.gif'; else $img='premium/logos/thumbs/'.$rowLogo['logos'];
							
							
							$image.='<div class="providers_Image addshadow shufflevenuepro"><h2 style="font-size:12px; font-weight:normal;">
        <a href="'.SITE_URL.'venues/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" > 
		<div class="providers_Image_img" style="background-image:url('.SITE_URL.$img.'); background-repeat:no-repeat; background-position:center;"></div>
		</a></h2>
         <p style="color:#006600;">'.$rows['business_name'].'</p>
         </div>';
				
							
						}
						$image.='';
						return $image;
					
						
					}
					
					
					function GetFeaturedSupplier(){
						global $title_link;
						$result= MysqlSelectQuery("SELECT * FROM `businessinfo` WHERE status=1 and premium=2 and business_type='Suppliers' order by rand() ");
						
					
						$image='';
						while($rows = SqlArrays($result)){
							
							//get the logos from the logo table
							$resultLogo = MysqlSelectQuery("SELECT * FROM `logos` WHERE user_id = '".$rows['user_id']."'");
							$rowLogo = SqlArrays($resultLogo);
							//check if user already has a logo uploaded
							if(NUM_ROWS($resultLogo) == 0) $img = 'images/no_icon.gif'; else $img='premium/logos/thumbs/'.$rowLogo['logos'];
							
							$image.='<div class="providers_Image addshadow shufflesupplier"><h2 style="font-size:12px; font-weight:normal;">
        <a href="'.SITE_URL.'suppliers/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" > 
		<div class="providers_Image_img" style="background-image:url('.SITE_URL.$img.'); background-repeat:no-repeat; background-position:center;"></div>
		</a>
		</h2>
         <p style="color:#006600;">'.$rows['business_name'].'</p>
         </div>';
				
							
						}
						$image.='';
						return $image;
					
						
					}
					function GetFeaturedTrainingProvider(){
						global $title_link;
						$result= MysqlSelectQuery("SELECT * FROM `businessinfo` WHERE status=1 and premium=3 and business_type='Training' order by rand() ");
						
					
						$image='';
						while($rows = SqlArrays($result)){
							
							//get the logos from the logo table
							$resultLogo = MysqlSelectQuery("SELECT * FROM `logos` WHERE user_id = '".$rows['user_id']."'");
							$rowLogo = SqlArrays($resultLogo);
							//check if user already has a logo uploaded
							if(NUM_ROWS($resultLogo) == 0) $img = 'images/no_icon.gif'; else $img='premium/logos/thumbs/'.$rowLogo['logos'];
							
							$image.='<div class="providers_Image addshadow shuffleproviders">
							<h2 style="font-size:12px; font-weight:normal;">
        <a href="'.SITE_URL.'tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" >
		<div class="providers_Image_img" style="background-image:url('.SITE_URL.$img.'); background-repeat:no-repeat; background-position:center;"></div>
		</a>
		</h2>
         <p style="color:#006600;">'.$rows['business_name'].'</p>
         </div>';
				
							
						}
						$image.='';
						return $image;
					
						
					}
					
	function ErrorCall($errors = array()){
		$msg='<div class="alert notification spacer-b30 alert-error">';
		$msg.='<span><strong>Please attend to the following errors:</strong></span>';
			$msg.='<ul style="margin-left:10px;margin-top:10px">';
		foreach ($errors as $error){
			$msg.='<li>'.$error.'</li>';
		}
		$msg.='</ul></div>';
		return $msg;
	}
	
	function EventsTags(){
		$TagArray = array();
		 $tagResult = MysqlSelectQuery("select * from events where tags != '' order by rand()");
					while($rowsTag = SqlArrays($tagResult)){
						 $getTags = explode(",", $rowsTag['tags']);
						 foreach($getTags as $tags){
							$TagArray[] = $tags;
						}
					}
		$newTag = array_unique($TagArray);
		foreach($newTag as $arrTags){
			echo tags($arrTags,'all-event-tag-search');
		}
	}
	
	function tags($tag,$url){
	if($tag){
	$getTags = explode(",",$tag);
	$link ="";
	$max = 5;
	$colors = array("color1","color2","color3","color4","color5","color6");
	for($i = 0; $i <  sizeof($getTags); $i++){
		 $col = rand(0, $max);
		 if($getTags[$i] != ''){
		$link .= '<a href="'.SITE_URL.$url.'?tag='.str_replace(" ","-",trim($getTags[$i])).'" style="font-size:12px;font-weight:normal;" class="'.$colors[$col].'" >'.ucfirst($getTags[$i]).'</a> ';
		 }
			
	}
	return $link;
	}
}
function renderDate($startDate,$endDate){
						   $startMonth = date('M',strtotime($startDate));
						   $endMonth =  date('M',strtotime($endDate));
						   if($startMonth != $endMonth){
							 $render = date('M d',strtotime($startDate))." - ".date('d M, Y',strtotime($endDate));
						   }
						   else{
							  $render =  date('d',strtotime($startDate))." - ".date('d M, Y',strtotime($endDate));
						   }
						   return  $render;
		}
		
	function GetFeed($url){
		$rss = new DOMDocument();
		$rss->load($url);
			$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node) {
			$item = array (
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
		);
			array_push($feed, $item);
		}
			$limit = 5;
		for($x=0;$x<$limit;$x++) {
				$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
				$link = $feed[$x]['link'];
				$description = $feed[$x]['desc'];
				$date = date('l F d, Y', strtotime($feed[$x]['date']));
			echo '<li><a href="'.$link.'" title="'.$title.'" target="_blank"> '.$title.'</a></li>';
}
	}

/** It gets the first few words delimited by @param $numWords */
function WordTruncate($input, $numWords) {
    if(str_word_count($input,0)>$numWords){
        $WordKey = str_word_count($input,1);
        $WordIndex = array_flip(str_word_count($input,2));
        return substr($input,0,$WordIndex[$WordKey[$numWords]]);
    }
    else {return $input;}
} 

// function mb_strlen($str, $encoding = 'iso-8859-1') {
//    switch (str_replace('-', '', strtolower($encoding))) {
//      case "utf8": return strlen(utf8_encode($str));
//      case "8bit": return strlen($str);
//      default:     return strlen(utf8_decode($str));
//    }
//  }
// function mb_substr($string, $start, $length = null, $encoding = 'iso-8859-1') {
//    if ( is_null($length) )
//      return substr($string, $start);
//    else
//      return substr($string, $start, $length);
// }
function trimStringToFullWord($length, $string) {
    if (mb_strlen($string) <= $length) {
        $string = $string; //do nothing
    }
    else {
        $string = preg_replace('/\s+?(\S+)?$/u', '', mb_substr($string, 0, $length));
    }
    return $string;
}

/** createArticles method creates articles from a template 
*	@param $howMany
*	@param $templateName 
*	@param $outputLoc
*/
function createArticles($howMany, $templateName, $outputLoc){
	// Query String for selecting articles 
	if($howMany=='all') $result =  MysqlSelectQuery("SELECT * FROM articles");// WHERE article_id=1
	else $result =  MysqlSelectQuery("SELECT * FROM articles WHERE article_id=$howMany");
	
	//Specify advert type to show
	$advert = "Articles";
	
	//Specify the location of the generated files
	$genFilesLoc = $outputLoc."/";
	
	// Full Article Sample file
	$sampleFile = $templateName;
	
	//Loop through the article_ids 
	while($rows = SqlArrays($result)){
		//this gets the characters 0 to the period and stores it in $newFile
		$newFile = substr(trim($rows['article_title']), 0, 45);
		$newFile = str_replace(" ", "000", $newFile);
		//Remove special Characters
		$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
		//Replace spaces with dash/hyphen
		$newFile = str_replace("000", "-", $newFile);
		$newFile = str_replace("--", "-", $newFile);
		//Covert d name to lowercase
		$fileNameAsLink =  strtolower($rows['article_id']."-".$newFile);
		$newFile = strtolower($rows['article_id']."-".$newFile.".php");
		
		//Specify the images to be used on the article
		$image=""; $imgFB = "";
		if($rows['articleImage']==""){
			$image='<img src="'.SITE_URL.'images/nigerianseminars_logo.jpg" width="100" height="100" alt="nigerian seminars article logo" class="articleImg shadow" />';
			$imgFB = 'images/nigerianseminars_logo.png';
		}
		else{
			$image='<img src="'.SITE_URL.'nstlogin/articles_images/'.$rows['articleImage'].'" width="100" height="100" alt="nigerianseminarsand trainings" class="articleImg shadow"/>';
			$imgFB = 'nstlogin/articles_images/'.$rows['articleImage'];
		}
		//specify Actions Links if author is nstloginistrator
		$articleActionsLinks=""; //Holds actions to be displayed at the bottom of the article
		if($rows['author']=="nstloginistrator"){
			$articleActionsLinks = '
			<div>
				<p>Our service offerings include the following:</p><br />
				<ul>
				<li><a href="http://www.nigerianseminarsandtrainings.com/add-event" target="_blank" title="Free course listing">Free course listing</a></li>
				<li><a href="http://www.nigerianseminarsandtrainings.com/upload-business-info.php" target="_blank" title="Free business listing">Free business listing</a></li>
				<li><a href="http://www.nigerianseminarsandtrainings.com/premium-listing.php" target="_blank" title="Premium course/business listing">Premium course/business listing (paid service)</a></li>
				<li><a href="http://www.nigerianseminarsandtrainings.com/advertise.php" target="_blank" title="Banner advert placement">Banner advert placement (paid service)</a></li>
				<li>Free training search - we help prospective trainees search for courses /training providers free.</li>
				</ul><br />
				<p>The nigerianseminarsandtraining.com&quot;Administrator&quot; is the profile for general support staff at  Nigerian Seminars and Trainings.</p>
			</div>
			';
		} else{
			$articleActionsLinks='<div style="text-align:justify;  font-size:12px">'.$rows['author_detail'].'</div>';
		}
		//Make Articles folder if not exist
		if(!file_exists($genFilesLoc)) mkdir($genFilesLoc);
		//check if the article already exist then delete it and use the latest
		if(file_exists($genFilesLoc.$newFile)) unlink($genFilesLoc.$newFile);
		//copy d sample file
		if (copy($sampleFile, $genFilesLoc.$newFile)) {
			
			//Open the copied file
			$newdata = file_get_contents($genFilesLoc.$newFile);
			
			//insert article id where needed and appropriate
			$newdata = str_replace("'this-article-id'", $rows['article_id'], $newdata);
			//insert article pdf file name where needed and appropriate
			$newdata = str_replace("'this-article-filename'", $rows['filename'], $newdata);
			//insert article tags where needed and appropriate
			$newdata = str_replace("'this-article-tags'", $rows['tags'], $newdata);
			//insert author email where needed and appropriate
			$newdata = str_replace("'this-article-email'", $rows['email'], $newdata);
			//insert article advert name where needed and appropriate
			$newdata = str_replace("'this-article-advert-name'", $advert, $newdata);
			//Insert article image by replacing the image string
			$newdata = str_replace("'article-image-icon'", SITE_URL.$imgFB, $newdata);
			//Insert the site url string
			$newdata = str_replace("'site-url'", SITE_URL, $newdata);
			//Insert webpage title and article title where appropriate
			$newdata = str_replace("'this-article-title'", $rows['article_title'], $newdata);
			//Insert Meta Description
			$newdata = str_replace("'meta-description'", substr(strip_tags($rows['article_description']), 0, strpos(strip_tags($rows['article_description']), ' ', 130) )." - ".$rows['article_id'], $newdata); 
			//Insert article logo and if not present use nst logo
			$newdata = str_replace("'this-article-image'", $image, $newdata);
			//Insert Article Author where needed
			$newdata = str_replace("'this-article-author'", ucwords($rows['author']), $newdata);
			//Insert Article Description where required
			$newdata = str_replace("'this-article-description'", stripslashes($rows['article_description']), $newdata);
			//Insert Actions Links if author is nstloginistrator
			$newdata = str_replace("'this-article-action-links'", $articleActionsLinks, $newdata);
			//Insert author name as link
			$newdata = str_replace("'this-article-author-as-link'", SITE_URL."author/".str_replace(" ","-",ucwords($rows['author'])), $newdata);
			//Insert the Page name modified as link without .php where needed
			$newdata = str_replace("'this-article-page-name'", $genFilesLoc.$fileNameAsLink, $newdata);
			
			//Put the edited content back into d file
			file_put_contents($genFilesLoc.$newFile, $newdata);
		}
	}
}

/** createNews method creates news from a template 
*	@param $howMany
*	@param $templateName 
*	@param $outputLoc
*/
function createNews($howMany, $templateName, $outputLoc){
	// Query String for selecting news 
	if($howMany=='all') $result =  MysqlSelectQuery("SELECT * FROM news");// WHERE News_id=1
	else $result =  MysqlSelectQuery("SELECT * FROM news WHERE News_id=$howMany");
	
	//Specify advert type to show
	$advert = "News";
	
	//Specify the location of the generated files
	$genFilesLoc = $outputLoc."/";
	
	// Full Article Sample file
	$sampleFile = $templateName;
	
	//Loop through the News_ids 
	while($rows = SqlArrays($result)){
		//this gets the characters 0 to the period and stores it in $newFile
		$newFile = trim(WordTruncate($rows['newsTitle'], 50)); //Use seven words as file name
		$newFile = str_replace(" ", "000", $newFile);
		//Remove special Characters
		$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
		//Replace spaces with dash/hyphen
		$newFile = str_replace("000", "-", $newFile);
		$newFile = str_replace("--", "-", $newFile);
		//Covert d name to lowercase
		$fileNameAsLink = strtolower($rows['News_id']."-".$newFile);
		$newFile = strtolower($rows['News_id']."-".$newFile.".php");
		//Specify the images to be used on the news
		$image=""; $imgFB = "";
		if($rows['image']==""){
			$image='<img src="'.SITE_URL.'images/news_image_BIG.png" width="100" height="100" alt="nigerian seminars logo" class="articleImg shadow" />';
			$imgFB = 'images/news_image_BIG.png';
		}
		else{
			$image='<img src="'.SITE_URL.'nstlogin/articles_images/'.$rows['image'].'" width="100" height="100" alt="nigerianseminarsand trainings" class="articleImg shadow"/>';
			$imgFB = 'nstlogin/articles_images/'.$rows['image'];
		}
		//Make Articles folder if not exist
		if(!file_exists($genFilesLoc)) mkdir($genFilesLoc);
		//check if the news already exist then delete it and use the latest
		if(file_exists($genFilesLoc.$newFile)) unlink($genFilesLoc.$newFile);
		//copy d sample file
		if (copy($sampleFile, $genFilesLoc.$newFile)) {
			
			//Open the copied file
			$newdata = file_get_contents($genFilesLoc.$newFile);
			
			//insert news id where needed and appropriate
			$newdata = str_replace("'this-news-id'", $rows['News_id'], $newdata);
			//insert news tags where needed and appropriate
			$newdata = str_replace("'this-news-tags'", tags($rows['tags'],'newstagSearch'), $newdata);
			//insert author email where needed and appropriate
			$newdata = str_replace("'this-news-email'", $rows['email'], $newdata);
			//insert news advert name where needed and appropriate
			$newdata = str_replace("'this-news-advert-name'", $advert, $newdata);
			//Insert facebook image url by replacing the image string
			$newdata = str_replace("'news-fb-icon'", SITE_URL.$imgFB, $newdata);
			//Insert the site url string
			$newdata = str_replace("'site-url'", SITE_URL, $newdata);
			//Insert webpage title and news title where appropriate
			$newdata = str_replace("'this-news-title'", $rows['newsTitle'], $newdata);
			//Insert Meta Description 
			$newdata = str_replace("'meta-description'", substr(strip_tags($rows['description']), 0, strpos(strip_tags($rows['description']), ' ', 130) )." - ".$rows['News_id'], $newdata); 
			//Insert news logo and if not present use nst logo
			$newdata = str_replace("'this-news-image'", $image, $newdata);
			//Insert Article Author where needed
			$newdata = str_replace("'this-news-author'", ucwords($rows['author']), $newdata);
			//Insert Article Description where required
			$newdata = str_replace("'this-news-description'", stripslashes($rows['description']), $newdata);
			//Insert author name as link
			$newdata = str_replace("'this-news-author-as-link'", SITE_URL."author/".str_replace(" ","-",ucwords($rows['author'])), $newdata);
			//Insert the Page name modified as link without .php where needed
			$newdata = str_replace("'this-news-page-link'", SITE_URL.$genFilesLoc.$fileNameAsLink, $newdata);
			//Insert the Page name modified as link without .php where needed
			$newdata = str_replace("'this-news-page-title'", substr(trim($rows['newsTitle']), 0, 65), $newdata);
			//Insert posted date
			$newdata = str_replace("'this-news-posted-date'", time_ago($rows['posted_date']), $newdata);
			
			//Put the edited content back into d file
			file_put_contents($genFilesLoc.$newFile, $newdata);
		}
	}
}
/** createQuotes method creates quote from a template 
*	@param $howMany
*	@param $templateName 
*	@param $outputLoc
*/
function createQuotes($howMany, $templateName, $outputLoc){
	// Query String for selecting quote 
	if($howMany=='all') $result =  MysqlSelectQuery("SELECT * FROM dailyquote");// WHERE quote_id=1
	else $result =  MysqlSelectQuery("SELECT * FROM dailyquote WHERE status=1 AND quote_id=$howMany");
	
	//Specify advert type to show
	$advert = "Quotes";
	
	//Specify the location of the generated files
	$genFilesLoc = $outputLoc."/";
	
	// Full Quote Sample file
	$sampleFile = $templateName;
	
	//Loop through the quote_ids 
	while($rows = SqlArrays($result)){
		//this gets the characters 0 to the period and stores it in $newFile
		$newFile = trim(WordTruncate($rows['quote'], 50)); //Use seven words as file name
		$newFile = str_replace(" ", "000", $newFile);
		//Remove special Characters
		$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
		//Replace spaces with dash/hyphen
		$newFile = str_replace("000", "-", $newFile);
		$newFile = str_replace("--", "-", $newFile);
		//Covert d name to lowercase
		$fileNameAsLink = strtolower($rows['quote_id']."-".$newFile);
		$newFile = strtolower($rows['quote_id']."-".$newFile.".php");
		//Specify the images to be used on the quote
		$image=""; $imgFB = "";
		if($rows['quoteImage']==""){
			$image='<img src="'.SITE_URL.'images/quoteLogo.png" width="100" height="100" alt="nigerian seminars logo" class="articleImg shadow" />';
			$imgFB = 'images/quoteLogo.png';
		}
		else{
			$image='<img src="'.SITE_URL.'nstlogin/quoteImages/'.$rows['quoteImage'].'" width="100" height="100" alt="nigerian seminars and trainings" class="articleImg shadow"/>';
			$imgFB = 'nstlogin/quoteImages/'.$rows['quoteImage'];
		}
		//Make Quotes folder if not exist
		if(!file_exists($genFilesLoc)) mkdir($genFilesLoc);
		//check if the quote already exist then delete it and use the latest
		if(file_exists($genFilesLoc.$newFile)) unlink($genFilesLoc.$newFile);
		//copy d sample file
		if (copy($sampleFile, $genFilesLoc.$newFile)) {
			
			//Open the copied file
			$newdata = file_get_contents($genFilesLoc.$newFile);
			
			//insert quote id where needed and appropriate
			$newdata = str_replace("'this-quote-id'", $rows['quote_id'], $newdata);
			//insert quote tags where needed and appropriate
			$newdata = str_replace("'this-quote-tags'", tags($rows['tags'],'quotetagSearch'), $newdata);
			//insert quote advert name where needed and appropriate
			$newdata = str_replace("'this-quote-advert-name'", $advert, $newdata);
			//Insert facebook image url by replacing the image string
			$newdata = str_replace("'quote-fb-icon'", SITE_URL.$imgFB, $newdata);
			//Insert the site url string
			$newdata = str_replace("'site-url'", SITE_URL, $newdata);
			//Insert webpage title and quote title where appropriate
			$newdata = str_replace("'this-quote-title'", $rows['quote'], $newdata);
			//Insert Meta Description
			$newdata = str_replace("'meta-description'", substr(strip_tags($rows['quote']),0,100)." - ".$rows['authur'], $newdata); 
			//Insert quote logo and if not present use nst logo
			$newdata = str_replace("'this-quote-image'", $image, $newdata);
			//Insert Quote Author where needed
			$newdata = str_replace("'this-quote-author'", ucwords($rows['authur']), $newdata);
			//Insert author name as link
			$newdata = str_replace("'this-quote-author-as-link'", SITE_URL."author/".str_replace(" ","-",ucwords($rows['authur'])), $newdata);
			//Insert the Page name modified as link without .php where needed
			$newdata = str_replace("'this-quote-page-link'", SITE_URL.$genFilesLoc.$fileNameAsLink, $newdata);
			//Insert the Page title 
			$newdata = str_replace("'this-quote-page-title'", substr(trim($rows['quote']), 0, 59), $newdata);
			//Insert showing date
			$newdata = str_replace("'this-quote-day'", date("F j, Y",strtotime($rows['day_of_quote'])), $newdata);
			
			//Put the edited content back into d file
			file_put_contents($genFilesLoc.$newFile, $newdata);
		}
	}
} 


function getWebPayResponse($product_id, $amount, $txnref, $mackey){
    $unsave_hash = $product_id.$txnref.$mackey;
    $save_hash = hash("sha512", $unsave_hash, false);
    // set HTTP header
    $headers = array(
        'method'=>"GET",
        'header' => "UserAgent: Mozilla/4.0 (compatible; MSIE 6.0; MS Web Services Client Protocol 4.0.30319.239)\r\n" .
                "Hash:$save_hash\r\n",
        'protocol_version' => 1.1
    );
    $url = "https://stageserv.interswitchng.com/test_paydirect/api/v1/gettransaction.json?productid=".$product_id."&transactionreference=".$txnref."&amount=".$amount."";
    $ch = curl_init(); // Open connection
    // Set the url, number of GET vars, GET data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, 1.1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);// Execute request
    curl_close($ch);// Close connection
    $transacObj = json_decode($result, true);// get the result and parse to JSON
    return $transacObj;
}

function currency_convert($Amount,$currencyfrom,$currencyto){
    $buffer=file_get_contents('http://finance.yahoo.com/currency-converter');
    preg_match_all('/name=(\"|\')conversion-date(\"|\') value=(\"|\')(.*)(\"|\')>/i',$buffer,$match);
    $date=preg_replace('/name=(\"|\')conversion-date(\"|\') value=(\"|\')(.*)(\"|\')>/i','$4',$match[0][0]);
    unset($buffer);
    unset($match);
    $buffer=file_get_contents('http://finance.yahoo.com/currency/converter-results/'.$date.'/'.$Amount.'-'.strtolower($currencyfrom).'-to-'.strtolower($currencyto).'.html');
    preg_match_all('/<span class=\"converted-result\">(.*)<\/span>/i',$buffer,$match);
    $match[0]=preg_replace('/<span class=\"converted-result\">(.*)<\/span>/i','$1',$match[0]);
    unset ($buffer);
    return $match[0][0];
}
?>