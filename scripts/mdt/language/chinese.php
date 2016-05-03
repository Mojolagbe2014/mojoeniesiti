<?php


    /*** User Definition Section ****************
     *
     * User may change date and time format and translate to their language
     */

// Define time zone format and preference
	define('timezone',  'Asia/Hong_Kong');  // You may check your timezone in http://www.php.net/manual/en/timezones.php
	ini_set('date.timezone', timezone);
	define('calendar',CAL_GREGORIAN);
	define('start_day_of_year',1); // 0 for 0-365th day and 1 for 1-366th day
	define('input_date_format',  'm-d-Y'); // For parameters with dd-mm-YYYY or mm-dd-YYYY pattern ONLY
	define('output_date_format',  'Y-m-d'); // For date output
	define('time_format',  'H:i:s');
// End define time zone format and preference

// Define language
// Chinese Translation
    define('date_time_format_error', '<p class="error"><b>操作錯誤：</b>日期或時間格式錯誤。</p>');
    define('year', '年');
    define('month', '個月');
    define('biweek', '兩週');
    define('week', '週');
    define('day', '日');
    define('hour', '小時');
    define('min', '分');
    define('sec', '秒');
	
	$dateinfo =array('l_month' => array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'),	's_month' =>array('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'),
	'l_weekday' =>array('星期日','星期一','星期二','星期三','星期四','星期五','星期六'),'s_weekday' =>array('日','一','二','三','四','五','六'));

// End of Chinese Translation	
?>