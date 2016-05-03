  <?php
                     $resultEmail = MysqlSelectQuery("select * from subscribers where email='".$_SESSION['email']."'");
	$rowsEmail = SqlArrays($resultEmail);
	?>
						 <div class="Edit" style="margin-bottom:5px;margin-top:10px;">
<span>Account Menu</span>
<ul >
       
        <li><a href="<?php echo SITE_URL;?>business/profile" ><i class="fa fa-user"></i>Veiw Profile</a></li>
         <li><a href="<?php echo SITE_URL;?>business/profile_edit" ><i class="fa fa-edit"></i>Edit Profile</a></li>
         <li><a href="<?php echo SITE_URL;?>business/event" ><i class="fa fa-plus"></i>Add Events</a></li>
          <li><a href="<?php echo SITE_URL;?>business/posted_events" ><i class="fa fa-calendar"></i>Posted Events</a></li>
           <li><a href="<?php echo SITE_URL;?>business/all-events-stat"><i class="fa fa-star"></i>Events Statistics</a></li>
        <li><a href="<?php echo SITE_URL;?>business/profile_change_password" ><i class="fa fa-lock"></i>Change Password</a></li>
        
        <?php if(NUM_ROWS($resultEmail)>0){ ; ?>
        <li><a href="<?php echo SITE_URL;?>business/subscriber_veiw" ><i class="fa fa-user"></i>Subscriber info</a></li>
        <?php ;}?>
        <li><a href="<?php echo SITE_URL;?>business/logout?status=true"><i class="fa fa-sign-out"></i>Logout</a></li>
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