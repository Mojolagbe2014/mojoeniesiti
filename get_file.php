<?php

$city = "Abuja, Nigeria";
 
	$url_post = "http://where.yahooapis.com/v1/places.q('".urlencode($city)."')?appid=foOF4CzV34EFIIW4gz1lx0Ze1em._w1An3QyivRalpXCK9sIXT5de810JWold3ApkdMdCrc-";
	$weather_feed = file_get_contents($url_post);
	$objDOM = new DOMDocument();
	$objDOM->loadXML($weather_feed);
	$woeid = $objDOM->getElementsByTagName("place")->item(0)->getElementsByTagName("woeid")->item(0)->nodeValue;
 
	echo "City Name: " . $city . "<br>";
	echo "WOEID: " . $woeid . "<br>";





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