<?php
if(isset($_SESSION['premium'])){
?>
<div id="floatMenu">
<ul>
	<li><a href="<?php echo SITE_URL;?>user/profile"><img src="<?php echo SITE_URL;?>images/user.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Profile</a></li>
	<li><a href="<?php echo SITE_URL;?>user/change_password"><img src="<?php echo SITE_URL;?>images/settings.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Change Password</a></li>
	<li><a href="<?php echo SITE_URL;?>user/event"><img src="<?php echo SITE_URL;?>images/calendar-icon-add.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Add new event</a></li>
	<li><a href="<?php echo SITE_URL;?>user/posted_events"><img src="<?php echo SITE_URL;?>images/calendar-icon.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Posted Events</a></li>
	<li><a  href="<?php echo SITE_URL;?>user/gallery"><img src="<?php echo SITE_URL;?>images/pic-icon.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Images</a></li>
    <li><a  href="<?php echo SITE_URL;?>user/add_image">My Logo</a></li>
     <li><a  href="<?php echo SITE_URL;?>user/logout?status=true">Logout</a></li>
      <li><a  href="https://webmail.nigerianseminarsandtrainings.com">Access webmail</a></li>
</ul>
</div>
<?php
}
?>