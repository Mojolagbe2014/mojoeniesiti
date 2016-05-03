<div id="contact-wrapper-inner" class="rounded" style="background-color:#FDFCCE; color:#FF5C0F">
                    <?php
                     $resultEmail = MysqlSelectQuery("select * from subscribers where email='".$_SESSION['email']."'");
	$rowsEmail = SqlArrays($result);
	?>
						 <div class="Edit" style="margin-bottom:5px;">
<span>Account Menu</span>
<ul >
       
        <li><a href="<?php echo SITE_URL;?>business/profile" class="profile">Veiw Profile</a></li>
         <li><a href="<?php echo SITE_URL;?>business/profile_edit" class="editprofile">Edit Profile</a></li>
        <li><a href="<?php echo SITE_URL;?>business/profile_change_password" class="password" >Change Password</a></li>
        <li><a href="<?php echo SITE_URL;?>business/logout?status=true" class="logout" >Logout</a></li>
        <?php if(NUM_ROWS($resultEmail)>0){ ; ?>
        <li style="width:150px;"><a href="<?php echo SITE_URL;?>business/subscriber_veiw" class="profile" >Subscriber info</a></li>
        <?php ;}?>
        </ul>
        </div>
				         </div>