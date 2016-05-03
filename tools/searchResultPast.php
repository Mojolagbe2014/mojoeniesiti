

<?php
		if(NUM_ROWS($result) > 0){

?>
                    <?php 
					$logo = "";
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

						}

			?>

                        <div class="eventListing" onClick="javascript:url_location('<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>')">
                       		<div class="eventListingInner">
                      			<a href="<?php echo SITE_URL.'events/'.$rows['event_id'].'/'.str_replace($title_link,"-",$rows['event_title']);?>"  style="display:block; padding:3px;" title="<?php echo $rows['event_title'];?>">
                                	<span class="spanTitle" itemprop="name" ><?php echo $rows['event_title'];?></span>
                                 </a> 
                      <div class="innerHeadingPropEvent">
     <p ><?php echo dateDiff($rows['startDate'], $rows['endDate']);?>, 
                       <?php echo date('M d',strtotime($rows['startDate']))." - ".date('d M, Y',strtotime($rows['endDate']));?> &nbsp;</p>
                         <span style="display:none;" itemprop="startDate" content="<?php echo date('Y-m-d h:m:s',strtotime($rows['startDate']));?>"><?php echo date('Y-m-d h:m:s',strtotime($rows['startDate']));?>
                         </span>
                 
                        <div class="clearfix"></div>   
                       </div>  
                    
                      <span style="text-align:center; display:block;">
					   <?php echo GetEventLocation($rows['event_id']);?>
                     </span>

                        <br />
                       
                      
<p style="text-align:center; font-size:14px; color: #105773; margin:5px 0 5px 0;" >
	<?php echo $rows['organiser'];?>
</p>

                        <div class="trainingProviders" style="width:100%;">
                        <div style="color:#000; font-size:12px; text-align:left;"  class="description"  ><?php echo substr(stripslashes(strip_tags($rows['description'])),0,100).'...';?> </div>

                       </div> 
                     </div>
                        
                       <div class="clearfix"></div>   
                       </div>
  <?php

						}
					}
					?>
  <script type="text/javascript">
					function url_location(data){
						window.location = data
					}
					</script>
