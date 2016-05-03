<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$msg = '';
$title_link = array("&rsquo;","&nbsp;","&#39;","&ldquo;","&ndash;","&acirc;","&euro;","&cent;","&eacute;","&bull;","&quot","&deg;","&lsquo;");
if(connection());
	$today = date("Y-m-d");
	$month = date("Y-m");
	$oneMonth = date("Y-m-d", strtotime('+ 1 month'));
	$year = date("Y");
	$currMonth = date("m");
	$num = cal_days_in_month(CAL_GREGORIAN, $currMonth, $year);
	$from = $year."-".$currMonth."-".$num;
	$to  =  $year."-".$currMonth."-"."1";
	//and SortDate like '%".$month."%' 
	$result = MysqlSelectQuery("SELECT * FROM `events` WHERE  SortDate between '$today' and '$oneMonth' and status = 1 order by rand() limit 0, 20");
	
header('Content-type: text/xml; charset=UTF-8');	
$output = '<rss version="2.0" encoding="UTF-8">';
    $output .= '<channel>';
    $output .= '<title>Nigerian Seminars and Trainings RSS Feed</title>';
    $output .= '<description>My Feed at http://www.nigerianseminarsandtrainings.com/</description>';
    $output .= '<link>http://www.nigerianseminarsandtrainings.com/</link>';
    $output .= '<copyright>copyright 2010 Nigerian Seminars and Trainings</copyright>';
	
	//BODY OF RSS FEED
	while($rows = SqlArrays($result)){
   $output .= '<item>';
        $output .= '<title>'.$rows['event_title'].'</title>';
        //$output .= '<description>'.strip_tags(stripslashes($rows['description'])).'</description>';
        $output .= '<link>http://www.nigerianseminarsandtrainings.com/event_detail?id='.$rows['event_id'].'</link>';
       $output .= '<pubDate>'.$rows['startDate'].'</pubDate>';
   $output .= '</item>';
	}

    //CLOSE RSS FEED
   $output .= '</channel>';
   $output .= '</rss>';
 
    //SEND COMPLETE RSS FEED TO BROWSER
    echo($output);
?>