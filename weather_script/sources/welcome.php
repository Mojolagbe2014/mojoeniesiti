<?php
function PageMain() {
	global $TMPL, $CONF, $db;
	$resultSettings = mysqli_fetch_row(mysqli_query($db, getSettings($querySettings)));
	
	# Detecteaza locatia IP-ului vizitatorului
	include("weather_script/includes/geoipcity.inc");
	include("weather_script/includes/geoipregionvars.php");

	$ip = $_SERVER['REMOTE_ADDR'];
	$gi = geoip_open("weather_script/includes/GeoLiteCity.dat", GEOIP_STANDARD);
	$record = geoip_record_by_addr($gi, $ip);
	geoip_close($gi);

	$city = $record->city;
	
	// Decide what value is used
	if(isset($_GET['city'])) { // If city is set
		$city = htmlspecialchars($_GET['city']);
	} elseif (empty($city)) { // If there is no IP detected, use the default city
		$city = "Lagos";
	}

	// Set the format preference, 0 metrics, 1 imperial
	if($_GET['f'] == 1 && isset($_GET['f'])) {
		setcookie("format", "1", $time);	
		$TMPL['cf'] = 'f';
		$TMPL['f'] = '0';
	} elseif($_GET['f'] == 0 && isset($_GET['f'])) {
		setcookie("format", "0", $time);	
		$TMPL['cf'] = 'c';
		$TMPL['f'] = '1';
	} elseif($_COOKIE['format'] == '') {
		$TMPL['cf'] = 'c';
		$TMPL['f'] = '1';
	} elseif($_COOKIE['format'] == 1) {
		$TMPL['cf'] = 'f';
		$TMPL['f'] = '0';
	} elseif($_COOKIE['format'] == 0) {
		$TMPL['cf'] = 'c';
		$TMPL['f'] = '1';
	}
	
	$weather = new Weather($CONF['apikey'], (isset($_GET['f']) ? $_GET['f'] : $_COOKIE['format']));
	$weather_current = $weather->get($city, 0, 0, null, null);
	$weather_forecast = $weather->get($city, 1, 0, 5, null);

	$now = $weather->data(0, $weather_current);
	$forecast = $weather->data(1, $weather_forecast);
	
	if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$query = sprintf('SELECT * FROM `users` WHERE `username` = "%s" AND `password` = "%s"', 
		mysqli_real_escape_string($db, $_COOKIE['username']), 
		mysqli_real_escape_string($db, $_COOKIE['password']));
		if(mysqli_fetch_row(mysqli_query($db, $query))) {
			$user = $_COOKIE['username'];		
			if($_GET['fav'] == '1') {
				$favorite = sprintf('SELECT * FROM `favorites` WHERE `username` = "%s" AND `location` ="%s"', 
				mysqli_real_escape_string($db, $user), 
				mysqli_real_escape_string($db, $city));
				if(mysqli_fetch_row(mysqli_query($db, $favorite)) == null) {
					$query = sprintf("INSERT INTO `favorites` (`username`, `location`) VALUES ('%s', '%s')",
					mysqli_real_escape_string($db, $user),
					mysqli_real_escape_string($db, $city));
					mysqli_query($db, $query);
				} else {
					$query = sprintf("DELETE FROM `favorites` WHERE `username` = '%s' AND `location` = '%s'",
					mysqli_real_escape_string($db, $user),
					mysqli_real_escape_string($db, $city));
					mysqli_query($db, $query);
				}
			}
			if(isset($_GET['city'])) {
				$TMPL['fav'] = '?city='.$_GET['city'].'&fav=1';
			} else {
				$TMPL['fav'] = '?fav=1';
			}
		} else {
			$user = 'anonymous';
			$TMPL['notLogged'] = '<despartitor></despartitor>You must be logged in to add favorites';
		}
	} else { 
		$user = 'anonymous';
		$TMPL['notLogged'] = '<despartitor></despartitor>You must be logged in to add a city to favorites.';
	}
	
	$cookieFormat = $TMPL['cf'];
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('welcome/rows'); $all = '';
	
	// Output the forecast
	$i = 1;
	foreach($forecast as $foreca) {
		$TMPL['day'] = $foreca['day'];
		$TMPL['low'] = $foreca['min'].'&deg;';
		$TMPL['high'] = $foreca['max'].'&deg;';
		$TMPL['icon'] = $CONF['url'].'/images/weather/'.$foreca['icon'].'.png';
		$TMPL['condition'] = $foreca['description'];
		$all .= $skin->make();
		if($i == 4) break; $i++;
	}
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $all;
	
	$TMPL['city'] = $now['location'].', '.$now['country_code'];
	$TMPL['temp'] = $now['temperature'].'&deg;';
	$TMPL['humidity'] = $now['humidity'].'%';
	$TMPL['wind'] = $now['windspeed'];
	
	if($cookieFormat == 'f') {
		if($TMPL['temp'] < 32) {
		$TMPL['weather'] = 'Freeze';
		} elseif($TMPL['temp'] > 32 && $TMPL['temp'] <= 50) {
			$TMPL['weather'] = 'Cold';
		} elseif ($TMPL['temp'] > 50 && $TMPL['temp'] <= 68) {
			$TMPL['weather'] = 'Average';
		} elseif ($TMPL['temp'] > 68 && $TMPL['temp'] <= 86) {
			$TMPL['weather'] = 'Warm';
		} elseif ($TMPL['temp'] > 86) {
			$TMPL['weather'] = 'Hot';
		}
	} else {
		if($TMPL['temp'] < 0) {
		$TMPL['weather'] = 'Freeze';
		} elseif($TMPL['temp'] > 0 && $TMPL['temp'] <= 10) {
			$TMPL['weather'] = 'Cold';
		} elseif ($TMPL['temp'] > 10 && $TMPL['temp'] <= 20) {
			$TMPL['weather'] = 'Average';
		} elseif ($TMPL['temp'] > 20 && $TMPL['temp'] <= 30) {
			$TMPL['weather'] = 'Warm';
		} elseif ($TMPL['temp'] > 30) {
			$TMPL['weather'] = 'Hot';
		}
	}
	
	// Set the format for the tooltip
	$TMPL['cfname'] = str_replace(array('c', 'f'), array('celsius', 'fahrenhite'), $cookieFormat);
	if($TMPL['cfname'] == 'celsius') {
		$TMPL['fname'] = str_replace(array('f', 'c'), array('celsius', 'fahrenhite'), $cookieFormat);
	} else {
		$TMPL['fname'] = str_replace(array('c', 'f'), array('fahrenhite', 'celsius'), $cookieFormat);
	}
		
	$TMPL['title'] = $resultSettings[0];

	$skin = new skin('welcome/content');
	return $skin->make();
}
?>