                    

 <?php
		if(NUM_ROWS($result) > 0){

?>
                    <?php 
					
					while($rows = SqlArrays($result)){
						
			if ($rows['premium'] == 1){
								$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rows['organiser']."%'");
						$biz_name = SqlArrays($business);
							if($biz_name['logos'] == '') $logo = 'images/star2.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
							
							$star = '<img src="'.SITE_URL.$logo.'" alt="business logo" width="50" height="50"/>';

							$clock_icon = '<div class="calendar_time"></div>';

							$bg_class = '';

							$listing_diff = '';

							$start_h1 = '<h2>';

							$end_h1 = '</h2>';
							
							$pre_link = '<a href="'.SITE_URL.'tprovider/'.$biz_name['business_id'].'/'.str_replace($title_link,"-",$biz_name['business_name']).'" target="_blank" style="color:#333; font-weight:normal;">'.$rows['organiser'].'</a>';

						}

						else{

							$star = '<div class="star1" style="float:right; margin-right:35px;"></div>';

							$bg_class ='#F7F7F7';

							$clock_icon ='<div class="icon_clock"></div>';

							$listing_diff ='';

							$start_h1 = '';

							$end_h1 = '';
							$pre_link = $rows['organiser'];
							
							$logo = "";

						}

			?>

                        <div class="eventListing vevent" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>')" style="background-color:<?php echo $bg_class;?>">
                       
                       <a href="<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>" class="url" style="background-color:#E3EBEE; display:block; padding:3px;"><h2 style="font-size:16px;"> <span class="spanTitle summary" ><?php echo $rows['event_title'];?></span></h2></a>
                       
                       <span class="spanTitle" style="text-align:center; font-size:14px; color:#000000;margin-top:10px;" ><?php echo $rows['organiser'];?></span>
                      
                       <div class="innerHeadingPropEvent">
     <p ><?php echo dateDiff($rows['startDate'], $rows['endDate']);?> &nbsp;&nbsp; | &nbsp;&nbsp; </p>
                       
                
                       <p ><?php echo date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate']));?> &nbsp;&nbsp; | &nbsp;&nbsp; </p>
                         <span style="display:none;" class="dtstart" content="<?php echo date('Y-m-d h:m:s',strtotime($rows['startDate']));?>"><?php echo date('Y-m-d h:m:s',strtotime($rows['startDate']));?></span>
                         
                      
                       
                       <p class="location"><?php echo GetEventLocation($rows['event_id']);?></p>
                       </div>
 
                       <div class="respond">
                       <?php //echo $image;?>
                       <div class="testImg" style="background-image:url(<?php echo SITE_URL.$logo;?>); background-repeat:no-repeat;">
                      <!-- <img src="images/no_icon.gif" alt="business logo" width="50" height="50"/>-->
                       </div>
                </div>
                        <div class="trainingProviders" style="width:100%;">
                      <!-- <span class="provider">Provider:</span>-->
                         <h2>
                        <span class="provider_name" >
                        <span style="color:#000;" class="description"><?php echo substr(stripslashes(strip_tags($rows['description'])),0,220).'...';?> <em style="color:#F00;"><img src="<?php echo SITE_URL;?>images/viewbutton.png" alt="view more" style="vertical-align:middle; float:right;"></em></span>
                        </span>
                       </h2>
                       </div> 
                       
                       <div class="clearfix"></div>
                       
                       
                    </div>
  <?php


						}
					}
					?>
  