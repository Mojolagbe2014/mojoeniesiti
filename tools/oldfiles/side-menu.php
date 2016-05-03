<div id="sidebar">
<?php 
$query="select * from dailyquote where day_of_quote='$today' and status=1";
$selected=MysqlSelectQuery($query);
$nums=NUM_ROWS($selected);
if($nums>0){
	$row=SqlArrays($selected);
	}
	else{
		
		$query="select * from dailyquote where day_of_quote='$yesterday' and status=1";
		$selected=MysqlSelectQuery($query);
		$row=SqlArrays($selected);
		
	}
	
	?>
<script type="text/javascript">
var fb_param = {};
fb_param.pixel_id = '6006487826059';
fb_param.value = '0.00';
(function(){
  var fpw = document.createElement('script');
  fpw.async = true;
  fpw.src = '//connect.facebook.net/en_US/fp.js';
  var ref = document.getElementsByTagName('script')[0];
  ref.parentNode.insertBefore(fpw, ref);
})();
</script>

<div align="center"><?php echo $GetAdverts -> SmallSideAds("Small SideAds",$advert);?></div>
<div class="divider"></div>
<div align="center"> <?php echo $GetAdverts -> SideMenus("Side Banner 1",$advert);?></div>
   <!-- <div class="divider"></div>

		        <div class="divider"></div>
        <div class="sneak_peak2"><div class="button_class">Recently uploaded courses</div></div>
          <div>
       
			
            <?php // Get_Recent_Event(); ?>

             <p><a href="<?php // echo SITE_URL;?>all_event">View More</a></p>
             
          </div>-->
<div class="divider"></div>
		  <div id="sneak_peak2"><div class="button_class">News / Updates</div></div>
          <div>
         <ul>
			
            <?php Get_News(); ?>
</ul>
             
             <p><a href="<?php echo SITE_URL;?>archive">Read More</a></p>
  </div>
 
   
   
            <div class="divider"></div>
            <div>
           
            
            <div align="center">  <?php echo $GetAdverts -> SideMenus("Side Banner 2",$advert);?></div>
            
           
           </div> 
         
		<div class="divider"></div>
 <div class="sneak_peak2"><div class="button_class">Articles</div></div>
          <div>
         <ul>
			
            <?php Get_Articles(); ?>
</ul>
             <p><a href="<?php echo SITE_URL;?>articles">Read More</a></p>
             <br />
             
          </div>
  <div>
      
             <div class="sneak_peak2"><div class="button_class">Quote of the Day</div></div>
           <div class="quoteContainer">
            <div class="TabbedPanelsContent" style="color: #090; font-weight:bold; text-align:center; height:150px" ><div class="fb-like" data-href="<?php echo SITE_URL;?>quoteFull?quoteID=<?php echo $row['quote_id'];?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true" style="width:240px; float:left"></div><br /><br /> "<?php echo $row['quote']; ?>"<br /><span style="font-weight:normal; color: #000"><i><?php  echo $row['authur'];?></i></span>
            
            </div>
            <span style="display:block;padding:0 5px 0 5px; font-weight:bold;"><a href="<?php echo SITE_URL;?>quoteArchive" >...more quotes</a></span>
             </div>
     
  </div>

<div class="searchTable">
  

   <div class="divider"></div><br />
    <div align="center"><a href="<?php echo SITE_URL;?>weather"><img src="<?php echo SITE_URL;?>images/weather_logo_large.gif" width="287" height="90" alt="nigerianseminarand training" /></a></div>        <br /><br />      
</div>
			
		</div>