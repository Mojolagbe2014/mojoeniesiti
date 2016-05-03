<link rel='stylesheet' href='<?php echo SITE_URL;?>css/jquery.ui.all.css'>
    		
            <script src='<?php echo SITE_URL;?>js/jquery.min.js'></script>
			<script src='<?php echo SITE_URL;?>js/jquery-ui.min.js'></script> 
			<script src='<?php echo SITE_URL;?>js/jquery.ui.monthpicker.js'></script>
            <script type="text/javascript">
			$(document).ready(function(){
			$('#searchform').submit(function(){
			var keyword_val = document.getElementById("month")
					if(keyword_val.value == 'Please Select Month'){
						keyword_val.value ='';
					}
				});
			});
				jQuery(document).ready(function() {
					jQuery("#month").monthpicker({
						showOn:     "both",
						buttonImage: "<?php echo SITE_URL;?>images/calendar.png",
						buttonImageOnly: true,
						dateFormat: 'MM yy',
						prevText: 'Prev'

						});
					});
					</script>
                    <script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="header">
<div class="AdvertTop">
 <?php 
 $GetAdverts = new Adverts;
 echo $GetAdverts -> LandScapeAds("Top Banner",$advert);?></div>
</div>

<div id="main_content">
 <div id="top_element">
 <div id="navigation3">
			<ul>
				<li class="active"><a href="<?php echo SITE_URL;?>add_event">Upload Your Event (free)</a></li>
				<li><a href="<?php echo SITE_URL;?>biz_info">Upload Your Business Info</a></li>
				<li><a href="<?php echo SITE_URL;?>add_video">Upload Training Videos</a></li>
				<li><a href="<?php echo SITE_URL;?>vacancies">Upload Training Vacancy</a></li>
				<li><a href="<?php echo SITE_URL;?>contact-us">Contact Us</a></li>
			</ul>
 </div>
 <div class="clearfix"></div>
 </div>

<div id="slider">
	
	<!-- start slideshow -->
	<div id="slideshow">
    
	<div class="logoClass" >
    <div class="clearfix"></div>
    </div>
    <div class="searchTable">
    <form action="<?php echo SITE_URL;?>search" method="get" id="searchform">
            <table width="100%">
  <tr>
    <td colspan="2" align="left"><h2>Find Events:</h2></td>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="53%" align="left"><!--<select name="month" class="Textselect" id="month">
      <option value="">Please Select Month</option>
      <option value="January">January</option>
      <option value="Febuary">Febuary</option>
      <option value="March">March</option>
      <option value="April">April</option>
      <option value="May">May</option>
      <option value="June">June</option>
      <option value="July">July</option>
      <option value="August">August</option>
      <option value="September">September</option>
      <option value="October">October</option>
      <option value="November">November</option>
      <option value="December">December</option>
      </select>-->
      <input name="month" type="text" class="Textinput" id="month" readonly="readonly" value="Please Select Month" onfocus="if(this.value == 'Please Select Month'){this.value = ''}" onblur="if(this.value == ''){this.value = 'Please Select Month'}" /></td>
    <td width="28%" align="left"><select name="category" class="Textselect" id="category">
      <option value="">Choose Category</option>
      <?php if(connection());
	$result_category = MysqlSelectQuery("select * from categories order by category_name");?>
    <?php while ($rows_category = SqlArrays($result_category)){?>
    <option value="<?php echo $rows_category['category_id'];?>"><?php echo $rows_category['category_name'];?></option>
    <?php
		}
	?>
      </select></td>
    <td width="19%" align="left"><input type="submit" class="buttonHome" value="Search" /></td>
  </tr>
</table>

            </form> 
    </div>
    <div class="topmessage">
			<marquee behavior="scroll" direction="left" scrollamount="2">Welcome to Nigerian Seminars and Trainings.com.... Home of conferences, training seminars, workshops, short courses and other learning opportunities around the world</marquee>
            <div class="clearfix"></div>
	  </div>
<?php include("navigation.php");?>
	</div>
		<div class="clearfix"></div>
	</div>