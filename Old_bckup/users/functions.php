<?php
//error_reporting(0);
date_default_timezone_set('Africa/Lagos');
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
include("timeinterval.php");
include("advertsClass.php");
include("htmlEmail.php");
define("SITE_URL_S","https://www.nigerianseminarsandtrainings.com/");
header('Content-type: text/html; charset=UTF-8') ;
//array for the add event form field
function normalize_str($str)
{
$invalid = array('Š'=>'S', 'š'=>'s','Ð'=>'Dj','Ž'=>'Z','ž'=>'z',
'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A',
'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E',
'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y',
'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a',
'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e',  'ë'=>'e', 'ì'=>'i', 'í'=>'i',
'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y',  'ý'=>'y', 'þ'=>'b',
'ÿ'=>'y', 'R'=>'R', 'r'=>'r', "`" => "'", "´" => "'", "„" => ",", "`" => "'",
"´" => "'", "“" => "\"", "”" => "\"", "´" => "'", "&acirc;€™" => "'", "{" => "",
"~" => "", "–" => "-", "’" => "'"," "=>"-",":"=>"-",","=>"-","/"=>"-"," "=>"-");
 
$str = str_replace(array_keys($invalid), array_values($invalid), $str);
 
return $str;
}
$title_link = array(",","]","[","/","'","’", "&", "%", ")", "(","+","=",":"," ","-","'","|","@","#","!","$","*","^",";","<",">","?","~","'\'",".","_","’");

$AfricaRegion = array("Eastern Africa"=>"1","Central Africa"=>"2","Northern Africa"=>"3","Southern Africa"=>"4","Western Africa"=>"5");

$add_event = array('name'=>'','email'=>'','phone'=>'','title'=>'','description'=>'','venue'=>'','category'=>'','cost'=>'','organizer'=>'','facilitator'=>'','start_date'=>'','end_date'=>'','website'=>'','country'=>"",'state'=>"",'verify'=>"","verifyHidden"=>"","tags"=>"");
$business = array("business_name"=>"","email"=>"","description"=>"","address"=>"","size"=>"","capacity"=>"","contact_person"=>"","telephone"=>"","website"=>"","buz_type"=>"",'verify'=>"","verifyHidden"=>"","price"=>"","category"=>"",'country'=>"");
$vacancies = array("title"=>"","experience"=>"","type"=>"","country"=>"","category"=>"","city"=>"","description"=>"","company_name"=>"","contact_person"=>"","telephone"=>"","email"=>"",'verify'=>"","verifyHidden"=>"");
$subscribers = array("email_sub"=>"","fname"=>"","lname"=>"","phone"=>"","organization"=>"","address"=>"","city"=>"","state"=>"","country"=>"","category"=>"",'verify'=>"","verifyHidden"=>"","username"=>"","designation"=>"");
$news = array('title'=>'','description'=>'');
$video = array("video_title"=>"","video_id"=>"","email"=>"","description"=>"","posted_by"=>"","website"=>"","telephone"=>"",'verify'=>"");
$adverts = array("title"=>"","size"=>"","adType"=>"","pageType"=>"","location"=>"","adposition"=>"","ppcCode"=>"");

$payments = array("business_name"=>"","contact_person"=>"","email"=>"","teller_no"=>"","amount_deposited"=>"","date_deposit"=>"","business_type"=>"","plan"=>"");

$paymentsTrainers = array("jobTitle"=>"","facilitatorsName"=>"","email"=>"","telephone"=>"","address"=>"");

$pages = array("Index"=>"","Event Detail"=>"","All Events"=>"","Event Managers"=>"","Suppliers"=>"","Training Providers"=>"","All Vacancies"=>"","Search"=>"","Venues"=>"","News"=>"","Articles"=>"","Vacancy Detail"=>"","Subscribers"=>"","Add Event"=>"","Add Business Info"=>"","Add Vacancies"=>"","About Us"=>"","Login"=>"","Privacy Policy"=>"","Terms Of Use"=>"");

$Indexpositions = array("Index TopBanner 1"=>"","Index TopBanner 2"=>"","Index TopBanner Small"=>"","Index SideBanner 1"=>"","Index SideBanner 2"=>"", "Index SideBanner 3"=>"", "Index SideBanner 4"=>"","Index PageBanner 1"=>"", "Index PageBanner 2"=>"","Index Small SideAds"=>"","Index Skyscrapper"=>"","Logo Banner"=>"");

$otherPages = array("Top Banner"=>"","Page Banner 1"=>"","Page Banner 2"=>"","Side Banner 1"=>"","Side Banner 2"=>"","Small SideAds"=>"","TopBanner Small"=>"","Logo Banner"=>"");
// general inser, delete, update query function
function MysqlQuery($Insertquery){
	$query = $Insertquery;
	$result = mysql_query($query) or die("Invalid Query".mysql_error());
	if($result){
		return true;
	}
}
function NUM_ROWS($result){
	$number = mysql_num_rows($result);
	return $number;
}
function SqlArrays ($result){
	$array = mysql_fetch_array($result);
	return $array;
}
// retrieving query
function MysqlSelectQuery($Insertquery){
	$query = $Insertquery;
	$result = mysql_query($query) or die("Invalid Query".mysql_error());
		return $result;
}
function CatchViews($id){
	MysqlQuery("update events set no_views=no_views + 1 where event_id='$id'");
}

function successMsg($message){
	$msg = '<div id="successMsg"><img src="'.SITE_URL.'images/sucicon.png" alt="Nigerian seminars and training success icon"/>'.$message.'</div>';
	return $msg;
}
function warningMsg($message){
	$msg = '<div id="warningMsg"><img src="'.SITE_URL.'admin/images/adminicons/warning.png" alt="Nigerian seminars and training warning icon"/>'.$message.'</div>';
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
	$result = mysql_query($query1) or die ("Invalid Query:".mysql_error());
	$row = mysql_fetch_array($result);
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
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="nofollow" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
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
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
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
	$result = mysql_query($query1) or die ("Invalid Query:".mysql_error());
	$row = mysql_fetch_array($result);
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
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="nofollow" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
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
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}
/****************************************
End Url Rewrite Paging
*******************************/
function Pages_users($query1,$recordperpage,$pagenum,$pagelink){
	$result = mysql_query($query1) or die ("Invalid Query:".mysql_error());
	$row = mysql_fetch_array($result);
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
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="nofollow" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
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
            echo '<a href="'.$pagelink.'page/'.$i.'/" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
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
	$result = mysql_query($query1) or die ("Invalid Query:".mysql_error());
	$row = mysql_fetch_array($result);
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
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="nofollow" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
            echo '<span class="prn">...</span>&nbsp;';
        }
		
	  if($start > 1) {
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

        if($current < $maxpage) {
            $i = $current+1;
            echo '<span class="prn">...</span>&nbsp;';
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}
/****************************************
End Url Rewrite Paging
*******************************/

/********************************************************************************************************
Url Rewrite Paging
*******************************************************************/
function Pages_admin($query1,$recordperpage,$pagenum,$pagelink){
	$result = mysql_query($query1) or die ("Invalid Query:".mysql_error());
	$row = mysql_fetch_array($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="pagination">';

        if($current==1) {
            echo '<span class="disabled">&lt; Previous</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="nofollow" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
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
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
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
	$result = mysql_query($query1) or die ("Invalid Query:".mysql_error());
	$row = mysql_fetch_array($result);
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
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="nofollow" title="go to page'.$i.'">&lt; Previous</a>&nbsp;';
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
            echo '<a href="'.$pagelink.'&page='.$i.'" class="prn" rel="nofollow" title="go to page '.$i.'">Next &gt;</a>&nbsp;';
        } else {
            echo '<span class="prn">Next &gt;</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
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
		if(mysql_num_rows($result) > 0){
		while($rows = SqlArrays($result)){
			echo '<li><a href="'.SITE_URL.'news/'.$rows['News_id'].'/'.str_replace($title_link,"-",substr($rows['newsTitle'],0,150)).'/">'.$rows['newsTitle'].'</a></li>';
		
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
		
	
		$result = MysqlSelectQuery("select * from articles order by article_id desc limit 0, 5");
		if(mysql_num_rows($result) > 0){
		while($rows = SqlArrays($result)){
			echo '<li><a href="'.SITE_URL.'article/full/'.$rows['article_id'].'/'.str_replace($title_link,"-",substr($rows['article_title'],0,150)).'">'.$rows['article_title'].'</a></li>';
		
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
		if(mysql_num_rows($result) > 0){
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
		if(mysql_num_rows($result) > 0){
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
    if(mysql_num_rows($result) > 0)
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
		if(mysql_num_rows($result) > 0){
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
	$result=mysql_query($query);
	$list = '<option value="">Please select a category</option>';
	while ($rows = mysql_fetch_array($result)){
	$list.='<option value="'.$rows[0].'">'.$rows[1].'</option>';
	}
	return  $list;
	}
	
	
	function GetContries(){
	$query = 'select * from countries order by countries';
	$result=mysql_query($query);
	$list = '<option value="">Please select a country (optional)</option>';
	while ($rows = mysql_fetch_array($result)){
	$list.='<option value="'.$rows[0].'">'.$rows[2].'</option>';
	}
	return  $list;
	}
	
	function GetTrainingProvider(){
	$query = 'select organiser from events group by organiser ';
	$result=mysql_query($query);
	$list = '<option value="">Please select a Training Provider (optional)</option>';
	while ($rows = mysql_fetch_array($result)){
	$list.='<option value="'.$rows['organiser'].'" style="width:200px">'.$rows['organiser'].'</option>';
	}
	return  $list;
	}
	
	function GetState(){
	$query = 'select * from states where state_id=38';
	$result=mysql_query($query);
	$list = '';
	while ($rows = mysql_fetch_array($result)){
	$list.='<option value="'.$rows[0].'">'.$rows[2].'</option>';
	}
	return  $list;
	}
	
	function GetEventLocation($eventID){
						$result= MysqlSelectQuery("SELECT * FROM `events` WHERE event_id=$eventID");
						$rows = mysql_fetch_array($result);
						if($rows['country'] == 38){
							$location ="";
							$query = 'select * from states where id_state='.$rows['state'];
							$resultstate=mysql_query($query);
						$rows_state = mysql_fetch_array($resultstate);
							if($rows_state['name'] == 'Abuja') $location = $rows_state['name']." FCT, Nigeria"; 
							else
							$location = $rows_state['name']." State, Nigeria";
							return $location;
						}
						else{
							$query = 'select * from countries where id='.$rows['country'];
							$resultcountry=mysql_query($query);
							$rows_country = mysql_fetch_array($resultcountry);
							$location = $rows_country['countries'];
							return $location;
						}
						
					}
					
					function GetFeaturedVenue(){
						global $title_link;
						$result= MysqlSelectQuery("SELECT * FROM `businessinfo` WHERE status=1 and premium=2 and business_type='Venue'");
						
						
						$image='<div style="width:100%; float:left;"><div style="width:100%; float:left; margin-bottom:8px">
            <div class="highlights" style="width:100%; font-size:14px;"> <strong>Featured Venue Providers</strong></div>';
						while($rows = mysql_fetch_array($result)){
							//get the logos from the logo table
							$resultLogo = MysqlSelectQuery("SELECT * FROM `logos` WHERE user_id = '".$rows['user_id']."'");
							$rowLogo = SqlArrays($resultLogo);
							//check if user already has a logo uploaded
							if(mysql_num_rows($resultLogo) == 0) $img = 'images/no_icon.gif'; else $img='user/logos/thumbs/'.$rowLogo['logos'];
							
							
							$image.='<div style="float:left; padding-left:10px; width:150px; text-align:center; font-size:13px;" align="center">'.'<a href="'.SITE_URL.'venues/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="blank">'.'<img src="'.SITE_URL.$img.'" width="95" height="95" alt="Venue Provider Logo" />'.'</a>'.'<br /><strong>'.$rows['business_name'].'</strong></div>';
				
							
						}
						$image.='</div> </div> <div style="padding-bottom:15px; padding-top:25px;margin-top:25px"><strong><a style="text-decoration:none; font-weight:normal;font-style:italic;" href="'.SITE_URL_S.'premium-listing" >Click this link to make your business appear here!</a></strong></div>';
						return $image;
					
						
					}
					
					
					function GetFeaturedSupplier(){
						global $title_link;
						$result= MysqlSelectQuery("SELECT * FROM `businessinfo` WHERE status=1 and premium=2 and business_type='Suppliers' ");
						
					
						$image='<div style="width:100%; float:left;height:164px;"><div style="width:100%; float:left; margin-bottom:5px;">
            <div class="highlights" style="width:100%; font-size:14px;"><strong>Featured Equipment Suppliers</strong></div>';
						while($rows = mysql_fetch_array($result)){
							
							//get the logos from the logo table
							$resultLogo = MysqlSelectQuery("SELECT * FROM `logos` WHERE user_id = '".$rows['user_id']."'");
							$rowLogo = SqlArrays($resultLogo);
							//check if user already has a logo uploaded
							if(mysql_num_rows($resultLogo) == 0) $img = 'images/no_icon.gif'; else $img='user/logos/thumbs/'.$rowLogo['logos'];
							
							$image.='<div style="float:left; padding-left:10px; font-size:13px;">'.'<a href="'.SITE_URL.'venues/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" target="blank">'.'<img src="'.SITE_URL.$img.'" width="95" height="95" alt="Equipment Suppliers Logo" />'.'</a>'.'<br /><strong>'.$rows['business_name'].'</strong></div>';
				
							
						}
						$image.='</div> </div><div style="padding-bottom:15px;"><strong><a style="text-decoration:none; font-weight:normal;font-style:italic;" href="'.SITE_URL_S.'premium-listing">Click this link to make your business appear here!</a></strong></div>';
						return $image;
					
						
					}

?>