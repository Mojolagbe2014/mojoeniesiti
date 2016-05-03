<?php

/********************************************************************************
 Multilingual Date Time Class
  
 Copyright 2012 Future Express Limited. This code is sold exclusively by
 http://www.codecanyon.net/.  It cannot be redistributed without written
 permission from http://www.webexpert-hk.com/
 
 ********************************************************************************/
 

// Define time unit values
    define('yr_unit', 31557600);
    define('mth_unit', 2629800);
    define('biweek_unit', 60*60*24*7*2);
    define('week_unit', 60*60*24*7);
    define('day_unit', 60*60*24);
    define('hr_unit', 60*60);
    define('min_unit', 60);
    define('sec_unit', 1);
// End define time unit values

// Start Multilingual DateTime Class
class MDT
{

   function __construct() {
   }
   
    /*** Converts a date/time string to Unix timestamp
     *
     * @return timestamp
	 * @param: can be string, timestamp, or blank for current time in defined time zone
     */

	public function GetStamp($time='')
	{
		if(is_numeric($time)) {
			$stamp = $time; //timestamp
		} else {
			if ($time == '')
			{
				$stamp= time(); //current time in defined time zone
			} else {
				$pattern='/([0-9]{1,2})[-.\/]{1}([0-9]{1,2})[-.\/]{1}([0-9]{4})/';
				if (preg_match($pattern,$time,$match))
				{
					if (substr(input_date_format,0,1)=='m' ||substr(input_date_format,0,1)=='n')
					{
						$newdate="$match[3]-$match[1]-$match[2]";
					} else {
						$newdate="$match[3]-$match[2]-$match[1]";
					}
					$time= preg_replace($pattern, $newdate, $time);
				}
			
				$stamp = strtotime($time); // string conversion
			}
		}
		
		if (is_numeric($stamp) && checkdate(date('m', $stamp), date('d', $stamp), date('Y', $stamp)))
		{
			return $stamp; // timestamp after checking
		}
		die(date_time_format_error);  // error format handling
	}
	
    /*** Converts a date/time string to SQL Date time format
     *
     * @return time string
     */

	public function GetSQLTime($time='')
	{
		$stamp = $this ->GetStamp($time);
		return date( 'Y-m-d H:i:s', $stamp );
	}
	
    /*** Converts a date/time string to specified date format
     *
     * @return date string
	 * @param: time and format (default format in User Definition section)
     */

	public function GetDate($time='',$format=output_date_format)
	{
		$stamp = $this ->GetStamp($time);
		return date( $format , $stamp );
	}

    /*** Converts a date/time string to specified time format
     *
     * @return time string
	 * @param: time and format (default format in User Definition section)
     */
	public function GetTime($time='',$format=time_format)
	{
		$stamp = $this ->GetStamp($time);
		return date($format, $stamp);
	}

	
    /*** Calculates the length of a time period and return the length in your language
     *
     * @return string
	 * @param: start time, end time
	 * and precision: 1-6 (1=> upto year level and 6=> upto seconds, default is 2)
     */
	public function GetPeriod($fromtime='', $totime='', $precision = 2) {
		$fromstamp = $this ->GetStamp($fromtime);
		$tostamp = $this ->GetStamp($totime);
		$time = abs($tostamp - $fromstamp);
		$tarray = array(year => yr_unit, month => mth_unit, day => day_unit, hour => hr_unit, min => min_unit, sec => sec_unit);
		$i = 0;
		foreach($tarray as $k => $unit) {
			$$k = floor($time/$unit);
			if ($$k) $i++;
			$time = $i >= $precision ? 0 : $time - $$k * $unit;
			$$k = $$k ? $$k.' '.$k.' ' : '';
			@$result .= $$k;
		}
		return $result;
	}

    /*** Calculates the length of a time period and return the length defined time period
     *
     * @return number
	 * @param: start time, end time and unit: week, day (default), hour, min, sec
     */
	public function GetDiff($fromtime='', $totime='', $unit='day',$shownegative=true) {

	$tarray = array('week'=>week_unit,'day' => day_unit, 'hour' => hr_unit, 'min' => min_unit, 'sec' => sec_unit);
		$fromstamp = $this ->GetStamp($fromtime);
		$tostamp = $this ->GetStamp($totime);
		$neg=($shownegative==true && ($tostamp - $fromstamp)<0)?-1:1;
		$time = abs($tostamp - $fromstamp);
		return floor($neg*$time/$tarray[$unit]); 
	}

    /*** Check if a date/time is within a time range
     *
     * @return -1 for before range / 0 for within range / 1 for after range
	 * @param: start time, end time and unit: week, day (default), hour, min, sec
     */
	public function CheckRange($chktime='', $start='', $end='') {
		$chkstamp = $this ->GetStamp($chktime);
		$startstamp = $this ->GetStamp($start);
		$endstamp = $this ->GetStamp($end);
		
		if ($chkstamp < min($startstamp, $endstamp)) {
			return -1;
		} elseif ($chkstamp > max($startstamp, $endstamp)){
			return 1;
		} 
		return 0;
	}
	
    /*** Check if a particular year is leap year
     *
     * @return 0 for not leap / 1 for leap
	 * @param: time, offset (time can be 4 digit year, timestamp or date format) 
     */
	public function isLeap($time='',$offset=0)
	{
		if (is_string($time) || $time >10000) {
			$yr = $this ->GetInfo($time,'year');
		} elseif (!is_int($time) || $time < 0) {
			die(date_time_format_error);
		} else {
			$yr = $time;
		}
		$yr += $offset;
		if ($yr % 4 != 0)
		{
			return 0;
		}else{
			if ($yr % 100 != 0) {
				return 1;
			} else {
				if ($yr % 400 != 0)
				{
                return 0;
				} else{
                return 1;
				}
			}
		}
	} 
	
    /*** Check the number of days in a month
     *
     * @return 28-31
	 * @param: time, offset (months of offset) 
     */
	public function Days_in_month($time='',$offset=0) 
	{
		$time = $this ->GetStamp($time);
		if (is_numeric($offset) &&$offset != 0)
		{
			$time=mktime(0,0,0,(date('n',$time)+$offset),1,date('Y',$time));
		} 
		$mth = date('n',$time);
		$yr =  date('Y',$time);
		
		return cal_days_in_month(calendar, $mth, $yr); 
	}
	
   /*** Check a particular piece of information from a date
     *
     * @return num or text per user request
	 * @param: time, infotype=> info to check, num=>returns number, long=>long text
     */

	public function GetInfo($time='',$type='weekday',$num=true,$longname=true) 
	{
		global $dateinfo;
		/************
		* Get specific date information 
		* $type => weekday - Value: 0-6
		* $type => weeknum - the X-th week in the year / Value: 1-52
		* $type => month - Value: 1-12
		* $type => doyear - the X-th day of year / Value: 1-366
		* $num => true returns number and false for text
		* $long => true returns long name and false for short name
		*************/
		$a = array('weekday'=>'w', 'weeknum'=>'W','month'=>'n','doyear'=>'z','year'=>'Y');
		$time = $this ->GetStamp($time);


		$ans = date($a[$type],$time); 
		if (start_day_of_year===1 && $type == 'doyear') $ans++; // Controls the day of year to start from 0 or 1

		if ($num || $type=='doyear' || $type=='year'|| $type=='weeknum') {
			return $ans; 
		} else {
			if ($type == 'month') $ans--;
			$type=($longname)?'l_'.$type:'s_'.$type;
			return $dateinfo[$type][$ans];
		}
	}
	
   /*** Select all dates within range and convert to specified time format
     *
     * @return time array
	 * @param: dates array, range start date, range end date and format (default format in User Definition section)
	 * Default value for start and end is current time
     */
	public function GetInrange($dates=array(), $start='', $end='',$format=output_date_format) {
		$startstamp = $this ->GetStamp($start);
		$endstamp = $this ->GetStamp($end);

		$result=array();
		if (is_array($dates)) {
			foreach ($dates as $chkdate) {
				$chkstamp = $this ->GetStamp($chkdate);
				if (($chkstamp >= min($startstamp, $endstamp)) && ($chkstamp <= max($startstamp, $endstamp)))
				{
					$result[]=$this ->GetDate($chkstamp,$format);
				}
			}
		} else {
			$chkstamp = $this ->GetStamp($dates);
			if (($chkstamp >= min($startstamp, $endstamp)) && ($chkstamp <= max($startstamp, $endstamp))) 
			{
				$result[]=$this ->GetDate($chkstamp,$format);
			}

		}
		return $result;
	}

   /*** Sort date array and output to specified time format
     *
     * @return time array
	 * @param: dates array, sorting order and format (default format in User Definition section)
	 * order options : SORT_ASC / SORT_DESC
     */

	
	function GetSort($dates=array(), $order=SORT_ASC,$format=output_date_format)
	{
		
		$new_array = array();
		$sortable_array = array();

		if (count($dates) > 0) {
			foreach ($dates as $k => $d) {
				$sortable_array[$k] = $this ->GetStamp($d);
			}
			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
					break;
				case SORT_DESC:
					arsort($sortable_array);
					break;
			}
			foreach ($sortable_array as $k => $d) {
				$sorted_array[$k] = $this ->GetDate($dates[$k],$format);
			}
		}

		return $sorted_array;
	}

   /*** End class routine
     *  Nil
     */

	function __destruct() {
   }

	
	
}
// End POWER DateTime Class




?>
