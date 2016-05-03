<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
?>
<div class="respond">
		<div class="featuredVenue">
         	<span class="span_cat addshadow"><i class="fa fa-star"></i>Featured Training Providers </span>
          		<?php echo GetFeaturedTrainingProvider();?>
         	</div>
       <div class="featuredVenue " style="margin-top:5px;">
         <span class="span_cat addshadow"><i class="fa fa-star"></i>Featured Venue Providers</span>
      
          <?php echo GetFeaturedVenue();?>
         </div>
         
         <div class="featuredVenue">
         <span class="span_cat addshadow"><i class="fa fa-star"></i>Featured Equipment Suppliers</span>
        
          <?php echo GetFeaturedSupplier();?>
         </div>
 </div>
                  
         
        