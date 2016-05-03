<?php
function PageMain() {
	global $TMPL;
	$resultSettings = mysql_fetch_row(mysql_query(getSettings($querySettings)));
	
	# Detecteaza locatia IP-ului vizitatorului
	include("Weather/includes/geoipcity.inc");
	include("Weather/includes/geoipregionvars.php");

	$ip = $_SERVER['REMOTE_ADDR'];
	$gi = geoip_open("Weather/includes/GeoLiteCity.dat", GEOIP_STANDARD);
	$record = geoip_record_by_addr($gi, $ip);
	geoip_close($gi);

	$city = $record->city;
	
	# Hotaraste ce oras este folosit
	if(isset($_GET['city'])) { # Daca e setat ?city schimba
		$city = htmlspecialchars($_GET['city']);
	} elseif (empty($city)) { # Daca nu deteacteaza locatia IP-ului, pune default
		$city = 'Lagos, Nigeria';//$resultSettings[1];
	}

	# Preia informatia (cURL pentru formatul UTF-8)
	$city = urlencode($city);
	$city = utf8_encode($city);
	$url = 'http://weather.service.msn.com/data.aspx?weasearchstr='.$city.'&weadegreetype=F&culture=en-US';
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
	$utf8 = curl_exec($ch);
	curl_close($ch);

	$xml = simplexml_load_string($utf8);
	# Seteaza preferinta formatului temperaturii
	if($_GET['f'] == 'f') {
		setcookie("format", 'fahrenhite', time() + 10080);	
		$TMPL['cf'] = 'f';
		$TMPL['f'] = 'c';
	} elseif($_GET['f'] == 'c') {
		setcookie("format", 'celsius', time() + 10080);	
		$TMPL['cf'] = 'c';
		$TMPL['f'] = 'f';
	} elseif($_COOKIE['format'] == '') {
		$TMPL['cf'] = 'c';
		$TMPL['f'] = 'f';
	} elseif($_COOKIE['format'] == 'fahrenhite') {
		$TMPL['cf'] = 'f';
		$TMPL['f'] = 'c';
	} elseif($_COOKIE['format'] == 'celsius') {
		$TMPL['cf'] = 'c';
		$TMPL['f'] = 'f';
	}
	
	# Defineste radacinile in variabile cu xpath
	$information = $xml->xpath("/weatherdata/weather");
	$current = $xml->xpath("/weatherdata/weather/current");
	$forecast = $xml->xpath("/weatherdata/weather/forecast");
	
	if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
		$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', 
		mysql_real_escape_string($_COOKIE['username']), 
		mysql_real_escape_string($_COOKIE['password']));
		if(mysql_fetch_row(mysql_query($query))) {
			$user = $_COOKIE['username'];		
			if($_GET['fav'] == '1') {
				$query = sprintf("INSERT INTO favorites (`username`, `location`) values ('%s', '%s')",
				mysql_real_escape_string($user),
				mysql_real_escape_string($city));
				mysql_query($query);
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
	
	$cookieFormat = $TMPL['cf']; # Seteaza variabila cookies format, ca s-o pot folosi si in rows
	
	$TMPL_old = $TMPL; $TMPL = array();
	$skin = new skin('welcome/rows'); $all = '';
	
	# Citeste formatul ales de user, si arata-i informatiile in formatul ales de el
	if($cookieFormat == 'f') {
		$i = 0;
		foreach($forecast as $foreca) {
			$TMPL['day'] = $foreca['shortday'];
			$TMPL['low'] = $foreca['low'].'&deg;';
			$TMPL['high'] = $foreca['high'].'&deg;';
			$TMPL['icon'] = /*$resultSettings[2]*/'https://www.nigerianseminarsandtrainings.com/Weather/images/weather/'.$foreca['skycodeday'].'.gif';
			$TMPL['condition'] = $foreca['skytextday'];
			if($i == 5) break; $i++;
			$all .= $skin->make();
		}
	} else {
		$i = 0;
		foreach($forecast as $foreca) {
			$TMPL['day'] = $foreca['shortday'];
			$TMPL['low'] = round(($foreca['low'] - 32) /1.8, 0).'&deg;'; # Converteste din Fahrenhite in Celsius
			$TMPL['high'] = round(($foreca['high'] - 32) /1.8, 0).'&deg;'; # Converteste din Fahrenhite in Celsius
			$TMPL['icon'] = /*$resultSettings[2]*/'https://www.nigerianseminarsandtrainings.com/Weather/images/weather/'.$foreca['skycodeday'].'.gif';
			$TMPL['condition'] = $foreca['skytextday'];
			if($i == 5) break; $i++;
			$all .= $skin->make();
		}
	}
	
	$TMPL = $TMPL_old; unset($TMPL_old);
	$TMPL['rows'] = $all;
	
	if($cookieFormat == 'f') {
		$TMPL['city'] = $information[0]['weatherlocationname'];
		$TMPL['temp'] = $current[0]['temperature'].'&deg;';

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
		$TMPL['city'] = $information[0]['weatherlocationname'];
		$TMPL['temp'] = round(($current[0]['temperature'] - 32) /1.8, 0).'&deg;';
		
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
	
	$TMPL['humidity'] = str_replace('Humidity: ', '', $current[0]['humidity']);
	$TMPL['wind'] = str_replace('Wind: ', '', $current[0]['winddisplay']);	
		
	# Seteaza formatul pentru Tipsy
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