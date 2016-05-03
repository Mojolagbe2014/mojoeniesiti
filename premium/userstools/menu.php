         
         <div id="users_menu" style="margin-top:10px;">
                                    <span><i class="icon-prepend fa fa-navicon"></i>Account Menu</span>
                                    <ul>
	<li><a href="<?php echo SITE_URL;?>premium/profile"><img src="<?php echo SITE_URL;?>images/user.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Profile</a></li>
	<li><a href="<?php echo SITE_URL;?>premium/change_password"><img src="<?php echo SITE_URL;?>images/settings.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Change Password</a></li>
	<li><a href="<?php echo SITE_URL;?>premium/event"><img src="<?php echo SITE_URL;?>images/calendar-icon-add.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Add new event</a></li>
	<li><a href="<?php echo SITE_URL;?>premium/posted_events"><img src="<?php echo SITE_URL;?>images/calendar-icon.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Posted Events</a></li>
    <li><a href="<?php echo SITE_URL;?>premium/all-events-stat"><img src="<?php echo SITE_URL;?>images/stat.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Events Statistics</a></li>
	<li><a  href="<?php echo SITE_URL;?>premium/gallery"><img src="<?php echo SITE_URL;?>images/pic-icon.png" width="17" height="19" alt="edit-icon" style="float:left; margin-right:5px" />Images</a></li>
    <li><a  href="<?php echo SITE_URL;?>premium/add_image"><i class="fa fa-image"></i>My Logo</a></li>
     <li><a  href="<?php echo SITE_URL;?>premium/logout?status=true"><i class="icon-prepend fa fa-sign-out"></i>Logout</a></li>
      <li><a  href="https://mail.nigerianseminarsandtrainings.com:2096" target="_blank"><i class="icon-prepend fa fa-envelope"></i>Access webmail</a></li>
</ul>
                  
<div style="margin-top:10px;">
    <div class="source-code-box event_table_inner container">
       Link your site visitors to your course listing on Nigerian Seminars and Trainings by placing this code on your site
       
       <?php
	   	$bizname = $_SESSION['name'];
	   	$bizname = str_replace(" ", "000", $bizname);
		//Remove special Characters
		$bizname = preg_replace("/[^A-Za-z0-9\-]/","", $bizname);
		//Replace spaces with dash/hyphen
		$bizname = str_replace("000", "-", $bizname);
		$bizname = str_replace("--", "-", $bizname);
	   ?>
       <br><br>
       <textarea name="" cols="26" rows="5" id="code" onclick="selectCode()" contenteditable="false">
        <!-- code start -->
        <a href="<?php echo SITE_URL;?>courses/business/<?php echo $_SESSION['BIZ_ID'].'-'.$bizname;?>" target="_blank"><img src="<?php echo SITE_URL;?>images/button.png"  /></a>
        <!-- code start -->
        </textarea>
        <script>
		function selectCode(){
			$('#code').select();
		}
	</script>
        </div>
    	<div>
        <br />
         <p style="text-align:center; margin-bottom:8px;"><strong><a href="<?php echo SITE_URL;?>courses/business/<?php echo $_SESSION['BIZ_ID'].'-'.$bizname;?>" data-type="iframe" class="preview">Preview</a></strong></p>
        <img src="<?php echo SITE_URL;?>images/button.png"  />
 <br/>
        
        </div>
       </div>
         </div>