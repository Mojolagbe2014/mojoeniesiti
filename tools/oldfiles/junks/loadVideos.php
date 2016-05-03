<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
?>
          <div id="slider_video">
		        <?php
				$result = MysqlSelectQuery("select * from videos order by id desc limit 0 , 6");
					if(NUM_ROWS($result) > 0){
					$i = 0;
					while($rows = SqlArrays($result)){
						if($i % 2 == 0){$bg ="#F7F7F7";} else {$bg ="";}
					?>
                    <a href="video-watch?id=<?php echo $rows['id'];?>" rel="nofollow">
                    <h2 class="content from-left" style="position:absolute;top:70%; font-size:16px;"><?php echo $rows['video_title'];?></h2>
                    <img src="http://img.youtube.com/vi/<?php echo $rows['video_id'];?>/0.jpg" class="youTube" alt="nigerian seminars and training youtube "/></a>
                   
                    <?php
					}
				}
					?>
	        </div>	 
            <p><a href="<?php echo SITE_URL;?>videos-all" rel="nofollow">View all videos</a></p>