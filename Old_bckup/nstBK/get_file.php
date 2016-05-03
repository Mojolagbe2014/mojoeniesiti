<?php

$record = geoip_record_by_name('www.nigerianseminarsandtrainings.com');
if ($record) {
    print_r($record);
}





/*include("scripts/geoIP/geoipcity.inc");
include("scripts/geoIP/geoipregionvars.php");

$ip = $_SERVER['REMOTE_ADDR'];
$ip = '41.58.180.199';
	$gi = geoip_open("scripts/geoIP/GeoLiteCity.dat",GEOIP_STANDARD);
	$record = geoip_record_by_addr($gi,$ip);
	geoip_close($gi);
 
	$city = $record->city;
 
	echo "City Name: " . $city . "<br>";*/

















/*for($i=0; $i <= 47; $i ++){
	
	$ch = curl_init('http://l.yimg.com/a/i/us/nws/weather/gr/'.$i.'n.png');
     $fp = fopen('images/weather/'.$i.'n.png', 'wb');
     curl_setopt($ch, CURLOPT_FILE, $fp);
     curl_setopt($ch, CURLOPT_HEADER, 0);
     curl_exec($ch);
     curl_close($ch);
     fclose($fp);
}*/

?>