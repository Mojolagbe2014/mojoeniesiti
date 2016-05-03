<?php
function PageMain() {
	global $TMPL;
	
	$resultSettings = mysql_fetch_row(mysql_query(getSettings($querySettings)));
	
	$time = time()+86400;
	$exp_time = time()-86400;
	
	$TMPL['loginForm'] = '
	<form action="/index.php?a=admin" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br /><br />
	<input type="submit" value="Log In" name="login"/>
	</form>
	<div class="small">Note: The password is case-sensitive.</div>';
	
	if(isset($_POST['login'])) {
		header("Location: /index.php?a=admin");
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		setcookie("usernameAdmin", $username, $time);
		setcookie("passwordAdmin", $password, $time);
				
		$query = sprintf('SELECT * from admin where username = "%s" and password ="%s"', mysql_real_escape_string($_COOKIE['usernameAdmin']), mysql_real_escape_string($_COOKIE['passwordAdmin']));
	} elseif(isset($_COOKIE['usernameAdmin']) && isset($_COOKIE['passwordAdmin'])) { 
		$query = sprintf('SELECT * from admin where username = "%s" and password ="%s"', mysql_real_escape_string($_COOKIE['usernameAdmin']), mysql_real_escape_string($_COOKIE['passwordAdmin']));
	
		if(mysql_fetch_row(mysql_query($query))) {
			$TMPL['success'] = '<div class="neutral">Welcome <strong>'.$_COOKIE['usernameAdmin'].'</strong>, <a href="/index.php?a=admin&logout=1">Log Out</a></div>';
			$TMPL['loginForm'] = '';
			
			$TMPL_old = $TMPL; $TMPL = array();
			
			$skin = new skin('admin/title'); $title = '';
				
			$TMPL['currentTitle'] = $resultSettings[0];
			
			if(isset($_POST['title'])) {
				$query = 'UPDATE `settings` SET title = \''.$_POST['title'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$siteTitle .= $skin->make();
			
			$skin = new skin('admin/url'); $url = '';
				
			$TMPL['currentUrl'] = $resultSettings[2];
			
			if(isset($_POST['url'])) {
				$query = 'UPDATE `settings` SET url = \''.$_POST['url'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$url .= $skin->make();
			
			$skin = new skin('admin/city'); $city = '';
			
			$TMPL['currentCity'] = $resultSettings[1];
			
			if(isset($_POST['city'])) {
				$query = 'UPDATE `settings` SET city = \''.$_POST['city'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$city .= $skin->make();
						
			$skin = new skin('admin/password'); $password = '';
			if(isset($_POST['pwd'])) {
				$pwd = md5($_POST['pwd']);
				$query = 'UPDATE `admin` SET password = \''.$pwd.'\' WHERE username = \''.$_COOKIE['usernameAdmin'].'\'';
				mysql_query($query);
				header("Location: /index.php?a=admin");
			}
			$password .= $skin->make();
		
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['city'] = $city;		
			$TMPL['url'] = $url;			
			$TMPL['password'] = $password;
			$TMPL['siteTitle'] = $siteTitle;
			
			if(isset($_GET['logout']) == 1) {
				setcookie('usernameAdmin', '', $exp_time);
				setcookie('password', '', $exp_time);
				header("Location: /index.php?a=admin");
				}
			} else { 
			$TMPL['error'] = '<div class="error">Invalid username or password. Remember that the password is case-sensitive.</div>';
			unset($_COOKIE['usernameAdmin']);
			unset($_COOKIE['passwordAdmin']);
		}			
	}
	
	$TMPL['title'] = 'Admin - '.$resultSettings[0].'';

	$skin = new skin('admin/content');
	return $skin->make();
}
?>