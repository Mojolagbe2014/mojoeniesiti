<?php
function PageMain() {
	global $TMPL, $CONF, $db;
	
	$resultSettings = mysqli_fetch_row(mysqli_query($db, getSettings($querySettings)));
	
	$time = time()+86400;
	$exp_time = time()-86400;
	
	$TMPL['loginForm'] = '<h1>Login or Register</h1><div class="halfContent">
	<form action="'.$CONF['url'].'/index.php?a=user" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br /><br />
	<input type="submit" value="Log In" name="login"/>
	</form>
	<div class="small">Note: The password is case-sensitive.</div></div>';
	
	$TMPL['registerForm'] = '<div class="halfContent">
	<form action="'.$CONF['url'].'/index.php?a=user" method="post">
	Username: <input type="text" name="regName" /><br />
	Password: <input type="text" name="regPass" /><br />
	Sum 4 + 5: <input type="text" name="regSum" /><br /><br />
	<input type="submit" value="Register" name="register"/>
	</form>
	<div class="small">Note: The password is case-sensitive.</div></div>';
	
	if(isset($_POST['register'])) {
		if(!empty($_POST['regName']) && !empty($_POST['regPass']) && ($_POST['regSum']) == 9) {
			$querySearch = sprintf("SELECT username from users where username = '%s'",
			mysqli_real_escape_string($db, $_POST['regName']));
			$resultSearch = mysqli_fetch_row(mysqli_query($db, $querySearch));
			if($resultSearch[0] != $_POST['regName'] AND $_POST['regName'] != 'anonymous') {
				$TMPL['success'] = '<div class="success">Account created successfully. You can now Log-in.</div>';
				$createQuery = sprintf("INSERT into `users` (`username`, `password`) VALUES ('%s', '%s');",
				mysqli_real_escape_string($db, $_POST['regName']),
				md5(mysqli_real_escape_string($db, $_POST['regPass'])));
				mysqli_query($db, $createQuery);
			} else {
				$TMPL['error'] = '<div class="error">Username already exist, please chose another one.</div>';
			}
		} else {
			$TMPL['error'] = '<div class="error">You are not that good at math, aren\'t you?</div>';
		}
	}
	
	if(isset($_POST['login'])) {
		header("Location: ".$CONF['url']."/index.php?a=user");
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		setcookie("username", $username, $time);
		setcookie("password", $password, $time);
				
		$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', mysqli_real_escape_string($db, $_COOKIE['username']), mysqli_real_escape_string($db, $_COOKIE['password']));
	} elseif(isset($_COOKIE['username']) && isset($_COOKIE['password'])) { 
		$query = sprintf('SELECT * from users where username = "%s" and password ="%s"', mysqli_real_escape_string($db, $_COOKIE['username']), mysqli_real_escape_string($db, $_COOKIE['password']));
		if(mysqli_fetch_row(mysqli_query($db, $query))) {
			$TMPL['success'] = '<div class="neutral">Welcome <strong>'.$_COOKIE['username'].'</strong>, How\'s the weater? <a href="'.$CONF['url'].'/index.php?a=user&logout=1">Log Out</a></div>';
			$TMPL['rowsTitle'] = '<h3>My Locations</h3>';
			$TMPL['loginForm'] = '';
			$TMPL['registerForm'] = '';
			
			$TMPL_old = $TMPL; $TMPL = array();

			$skin = new skin('user/rows'); $all = '';
		    $query = 'SELECT * from favorites where `username` = \''.$_COOKIE['username'].'\' ORDER BY `id` DESC LIMIT 0,5';
			$result = mysqli_query($db, $query);
			while($TMPL = mysqli_fetch_assoc($result)) {
				$city = $TMPL['location'];
				$city = htmlspecialchars($city);
				$city = utf8_encode($city);
				
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
				
				$weather = new Weather($CONF['apikey'], $_COOKIE['format']);
				$weather_current = $weather->get($city, 0, 0, null, null);
				$weather_forecast = $weather->get($city, 1, 0, 5, null);

				$now = $weather->data(0, $weather_current);
				$forecast = $weather->data(1, $weather_forecast);
				
				$cookieFormat = $TMPL['cf'];
				
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
				$all .= $skin->make();
			}
									
			$skin = new skin('user/password'); $password = '';
			if(isset($_POST['pwd'])) {
				$pwd = md5($_POST['pwd']);
				$query = 'UPDATE `users` SET password = \''.$pwd.'\' WHERE username = \''.$_COOKIE['username'].'\'';
				mysqli_query($db, $query);
				header("Location: ".$CONF['url']."/index.php?a=user");
			}
			$password .= $skin->make();
		
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['rows'] = $all;
			$TMPL['password'] = $password;
			
			if(isset($_GET['logout']) == 1) {
				setcookie('username', '', $exp_time);
				setcookie('password', '', $exp_time);
				header("Location: ".$CONF['url']."/index.php?a=user");
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