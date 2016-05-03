<?php
function PageMain() {
	global $TMPL;
	
	$resultSettings = mysql_fetch_row(mysql_query(getSettings($querySettings)));
	
	$time = time()+86400;
	$exp_time = time()-86400;
	
	$TMPL['loginForm'] = '<h1>Login or Register</h1><div class="halfContent">
	<form action="/index.php?a=user" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br /><br />
	<input type="submit" value="Log In" name="login"/>
	</form>
	<div class="small">Note: The password is case-sensitive.</div></div>';
	
	$TMPL['registerForm'] = '<div class="halfContent">
	<form action="/index.php?a=user" method="post">
	Username: <input type="text" name="regName" /><br />
	Password: <input type="text" name="regPass" /><br />
	Sum 4 + 5: <input type="text" name="regSum" /><br /><br />
	<input type="submit" value="Register" name="register"/>
	</form>
	<div class="small">Note: The password is case-sensitive.</div></div>';
	
	if(isset($_POST['register'])) {
		if(!empty($_POST['regName']) && !empty($_POST['regPass']) && ($_POST['regSum']) == 9) {
			$querySearch = sprintf("SELECT username from users where username = '%s'",
			mysql_real_escape_string($_POST['regName']));
			$resultSearch = mysql_fetch_row(mysql_query($querySearch));
			if($resultSearch[0] != $_POST['regName'] AND $_POST['regName'] != 'anonymous') {
				$TMPL['success'] = '<div class="success">Account created successfully. You can now Log-in.</div>';
				$createQuery = sprintf("INSERT into `users` (`username`, `password`) VALUES ('%s', '%s');",
				mysql_real_escape_string($_POST['regName']),
				md5(mysql_real_escape_string($_POST['regPass'])));
				mysql_query($createQuery);
			} else {
				$TMPL['error'] = '<div class="error">Username already exist, please chose another one.</div>';
			}
		} else {
			$TMPL['error'] = '<div class="error">You are not that good at math, aren\'t you?</div>';
		}
	}
	
	if(isset($_POST['login'])) {
		header("Location: /index.php?a=user");
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		setcookie("username", $username, $time);
		setcookie("password", $password, $time);
				
		$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', mysql_real_escape_string($_COOKIE['username']), mysql_real_escape_string($_COOKIE['password']));
	} elseif(isset($_COOKIE['username']) && isset($_COOKIE['password'])) { 
		$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', mysql_real_escape_string($_COOKIE['username']), mysql_real_escape_string($_COOKIE['password']));
		if(mysql_fetch_row(mysql_query($query))) {
			$TMPL['success'] = '<div class="neutral">Welcome <strong>'.$_COOKIE['username'].'</strong>, How\'s the weater? <a href="/index.php?a=user&logout=1">Log Out</a></div>';
			$TMPL['rowsTitle'] = '<h3>My Locations</h3>';
			$TMPL['loginForm'] = '';
			$TMPL['registerForm'] = '';
			
			$TMPL_old = $TMPL; $TMPL = array();

			$skin = new skin('user/rows'); $all = '';
		    $query = 'SELECT * from favorites where `username` = \''.$_COOKIE['username'].'\' ORDER BY `id` DESC LIMIT 0,5';
			$result = mysql_query($query);
			while($TMPL = mysql_fetch_assoc($result)) {
				$city = $TMPL['location'];
				$city = htmlspecialchars($city);
				$city = utf8_encode($city);
				$url = 'http://weather.service.msn.com/data.aspx?weadegreetype=F&culture=en-US&weasearchstr='.$city;
				$ch = curl_init();
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_URL, $url);
				curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
				curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
				curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
				$utf8 = curl_exec($ch);
				curl_close($ch);
				
				$xml = simplexml_load_string($utf8);
				
				$information = $xml->xpath("/weatherdata/weather");
				$current = $xml->xpath("/weatherdata/weather/current");
				$forecast = $xml->xpath("/weatherdata/weather/forecast");
				
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
				$cookieFormat = $TMPL['cf'];
				
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
				
				$all .= $skin->make();
			}
									
			$skin = new skin('user/password'); $password = '';
			if(isset($_POST['pwd'])) {
				$pwd = md5($_POST['pwd']);
				$query = 'UPDATE `users` SET password = \''.$pwd.'\' WHERE username = \''.$_COOKIE['username'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=user");
			}
			$password .= $skin->make();
		
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['rows'] = $all;
			$TMPL['password'] = $password;
			
			if(isset($_GET['logout']) == 1) {
				setcookie('username', '', $exp_time);
				setcookie('password', '', $exp_time);
				header("Location: /index.php?a=user");
				}
			} else { 
			$TMPL['error'] = '<div class="error">Invalid username or password. Remember that the password is case-sensitive.</div>';
			unset($_COOKIE['username']);
			unset($_COOKIE['password']);
		}			
	}
		
	$TMPL['title'] = 'User - '.$resultSettings[0].'';

	$skin = new skin('user/content');
	return $skin->make();
}
?>