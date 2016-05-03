<?php
    /*** User Definition Section ****************
     *
     * User may change date and time format and translate to their language
     */

// Define time zone format and preference
	define('timezone',  'Africa/Lagos');  // You may check your timezone in http://www.php.net/manual/en/timezones.php
	ini_set('date.timezone', timezone);
	define('calendar',CAL_GREGORIAN);
	define('start_day_of_year',1); // 0 for 0-365th day and 1 for 1-366th day
	define('input_date_format',  'm-d-Y'); // For parameters with dd-mm-YYYY or mm-dd-YYYY pattern ONLY
	define('output_date_format',  'Y-m-d'); // For date output
	define('time_format',  'H:i:s');
// End define time zone format and preference

// Define language
// Default language: English
// User may edit this to make their own language version
    define('date_time_format_error', '<p class="error"><b>Fatal Error:</b> Invalid date/time format.</p>');
    define('year', 'year(s)');
    define('month', 'month(s)');
    define('biweek', 'bi-week(s)');
    define('week', 'week(s)');
    define('day', 'day(s)');
    define('hour', 'hour(s)');
    define('min', 'minute(s)');
    define('sec', 'second(s)');
	
	$dateinfo =array('l_month' => array('January','February','March','April','May','June','July','August','September','October','November','December'),	's_month' =>array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'),
	'l_weekday' =>array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'),'s_weekday' =>array('Sun','Mon','Tue','Wed','Thu','Fri','Sat'));
// End English
	
?>