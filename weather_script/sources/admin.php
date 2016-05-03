<?php
function PageMain() {
	global $TMPL, $CONF, $db;
	
	$resultSettings = mysqli_fetch_row(mysqli_query($db, getSettings($querySettings)));
	
	$time = time()+86400;
	$exp_time = time()-86400;
	
	$TMPL['loginForm'] = '
	<form action="'.$CONF['url'].'/index.php?a=admin" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br /><br />
	<input type="submit" value="Log In" name="login"/>
	</form>
	<div class="small">Note: The password is case-sensitive.</div>';
	
	if(isset($_POST['login'])) {
		header("Location: ".$CONF['url']."/index.php?a=admin");
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		setcookie("usernameAdmin", $username, $time);
		setcookie("passwordAdmin", $password, $time);
				
		$query = sprintf('SELECT * from admin where username = "%s" and password ="%s"', mysqli_real_escape_string($db, $_COOKIE['usernameAdmin']), mysqli_real_escape_string($db, $_COOKIE['passwordAdmin']));
	} elseif(isset($_COOKIE['usernameAdmin']) && isset($_COOKIE['passwordAdmin'])) { 
		$query = sprintf('SELECT * from admin where username = "%s" and password ="%s"', mysqli_real_escape_string($db, $_COOKIE['usernameAdmin']), mysqli_real_escape_string($db, $_COOKIE['passwordAdmin']));
	
		if(mysqli_fetch_row(mysqli_query($db, $query))) {
			$TMPL['success'] = '<div class="neutral">Welcome <strong>'.$_COOKIE['usernameAdmin'].'</strong>, <a href="'.$CONF['url'].'/index.php?a=admin&logout=1">Log Out</a></div>';
			$TMPL['loginForm'] = '';
			
			$TMPL_old = $TMPL; $TMPL = array();
			
			$skin = new skin('admin/general'); $general = '';
				
			$TMPL['currentTitle'] = $resultSettings[0];
			$TMPL['currentCity'] = $resultSettings[1];
	
			if(isset($_POST['title']) || isset($_POST['city'])) {
				$query = sprintf("UPDATE `settings` SET title = '%s', `city` = '%s'", mysqli_real_escape_string($db, $_POST['title']), mysqli_real_escape_string($db, $_POST['city']));
				mysqli_query($db, $query);
				header("Location: ".$CONF['url']."/index.php?a=admin");
			}
			$TMPL['url'] = $CONF['url'];
			$general .= $skin->make();
						
			$skin = new skin('admin/password'); $password = '';
			if(isset($_POST['pwd'])) {
				$pwd = md5($_POST['pwd']);
				$query = 'UPDATE `admin` SET password = \''.$pwd.'\' WHERE username = \''.$_COOKIE['usernameAdmin'].'\'';
				mysqli_query($db, $query);
				header("Location: ".$CONF['url']."/index.php?a=admin");
			}
			$TMPL['url'] = $CONF['url'];
			$password .= $skin->make();
		
			$TMPL = $TMPL_old; unset($TMPL_old);
			$TMPL['password'] = $password;
			$TMPL['general'] = $general;
			
			if(isset($_GET['logout']) == 1) {
				setcookie('usernameAdmin', '', $exp_time);
				setcookie('password', '', $exp_time);
				header("Location: ".$CONF['url']."/index.php?a=admin");
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