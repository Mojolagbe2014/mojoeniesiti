<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
$msg = '';
$isChrome = false;
if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')){
    $isChrome = true;
}
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
$output = '<?xml version= "1.0"?><?xml-stylesheet type="text/css" href="css/rss.css"?><rss version="2.0" encoding="UTF-8">';
    $output .= '<channel>';
    $output .= '<title> RSS Feed - Nigerian Seminars and Trainings</title>';
    $output .= '<description>Subscribe to Nigerian Seminars and Trainings RSS Feed for up-to-date information on upcoming events around the World</description>';
    $output .= '<link>http://www.nigerianseminarsandtrainings.com/</link>';
    $output .= '<copyright>copyright 2010 Nigerian Seminars and Trainings</copyright>';
	
	//BODY OF RSS FEED
	while($rows = SqlArrays($result)){
   $output .= '<item>';
        $output .= '<title><![CDATA['.$rows['event_title'].']]></title>';
        //$output .= '<description><![CDATA['.substr(strip_tags($rows['description']), 0, 120).'.. <a href="'.SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']).'">Read More</a>]]></description>';
        if($isChrome){
            $output .= '<description><![CDATA['.substr(utf8_encode(strip_tags($rows['description'])), 0, 156).'..]]></description>';
        }else{
            $output .= '<description><![CDATA['.substr($rows['description'], 0, 156).'.. <a href="'.SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']).'">Read More</a>]]></description>';
        }
        $output .= '<link><![CDATA['.SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']).']]></link>';
       $output .= '<pubDate><![CDATA['.date("F j, Y",  strtotime($rows['startDate'])).']]></pubDate>';
   $output .= '</item>';
	}

    //CLOSE RSS FEED
   $output .= '</channel>';
   $output .= '</rss>';
 
    //SEND COMPLETE RSS FEED TO BROWSER
    echo($output);
?>