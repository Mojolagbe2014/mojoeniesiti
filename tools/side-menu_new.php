<div id="sidebar" style="padding-top:10px;">
<?php
$today = date("Y-m-d"); $yesterday=date('Y-m-d',strtotime("-1 days"));
$query="select * from dailyquote where status=1 order by quote_id desc ";
$selected=MysqlSelectQuery($query); $nums=NUM_ROWS($selected); if($nums>0){ $row=SqlArrays($selected); }
?>
<script type="text/javascript">
var fb_param = {}; fb_param.pixel_id = '6006487826059'; fb_param.value = '0.00';
(function(){ var fpw = document.createElement('script'); fpw.async = true; fpw.src = '//connect.facebook.net/en_US/fp.js';
var ref = document.getElementsByTagName('script')[0]; ref.parentNode.insertBefore(fpw, ref);
})();
</script>
<div class="respond">
<div class="addshadow">
<ul>
<li>
<a href="https://twitter.com/nigerianseminar" class="twitter-follow-button" data-show-count="true" data-lang="en">Follow @twitterapi</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</li>
<li style="margin-bottom:5px; margin-top:5px;" class="remove">
  <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/" data-width="250" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
</li>
<!-- Place this tag where you want the +1 button to render. -->
<li>
<div class="g-plusone" data-annotation="inline" data-width="300"></div>
<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
(function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/platform.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
</li>
</ul>
</div>
</div>
<div class="divider"></div>
<div style="text-align:center;">
<?php echo $GetAdverts -> SmallSideAds("Small SideAds",$advert);?>
</div>
<div class="respond">
<div style="text-align:center;">
<?php echo $GetAdverts -> SideMenus("Side Banner 1",$advert);?>
</div>
</div>
<div class="divider"></div>
<div class="respond">
<div style="text-align:center;">
<div class="fb-page" data-href="https://www.facebook.com/nigerianseminars" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/nigerianseminars"><a href="https://www.facebook.com/nigerianseminars">Nigeria Seminars and Trainings.com</a></blockquote></div></div></div>
<div class="divider"></div>
</div>
<!--quarterly guide-->
<div class="divider"></div>
<?php
$result = MysqlSelectQuery("select * from quarterly_guide where year='".date("Y")."' order by guide_id desc limit 0, 4");
if(NUM_ROWS($result) > 0){
?>
<div  class="quoteContainer addshadow">
<div class="sneak_peak2">
<div class="button_class"><h5 style="font-size:13px">Download Quarterly Guide</h5></div>
</div>
<div>
<ul>
<?php while($rows = SqlArrays($result)){ $link = SITE_URL.'download-guide/'.str_replace($title_link,"-",$rows['name']); ?>
<li>
<a href="<?php echo $link ;?>" title="Quaterly Training Guide">
<i class="fa fa-square" style="font-size:6px;"></i> <?php echo $rows['name'];?> Conferences and Training Guide</a>
</li>
<?php } ?>
</ul>
</div>
</div>
<?php } ?>
<div class="respond">
<div class="clearfix"></div>
<div style="text-align:center;margin-top:10px;margin-bottom:10px;"></div>
<div class="clearfix"></div>
<div class="divider"></div>
<div>
<div style="text-align:center;">
<?php echo $GetAdverts -> SideMenus("Side Banner 2",$advert);?>
</div>
</div>
</div>
<!--end quarterly guide-->
<div>
<div class="quoteContainer addshadow">
<div class="sneak_peak2">
<div class="button_class"><h6 style="font-size:13px">Quote of the Day</h6></div>
</div>
<div class="TabbedPanelsContent" style="color: #33454E; text-align:center; height:150px" >
<?php $newFile = trim(WordTruncate($row['quote'], 50));  $newFile = str_replace(" ", "000", $newFile); $newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile); $newFile = str_replace("000", "-", $newFile); $newFile = str_replace("--", "-", $newFile); $fileNameAsLink = strtolower($row['quote_id']."-".$newFile); $newFile = strtolower($row['quote_id']."-".$newFile); ?>
<table>
<tr>
<td> <div class="fb-like" data-href="https://www.nigerianseminarsandtrainings.com/quotespg/<?php echo $newFile;?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div></td>
</tr>
</table>
<br /><a href="<?php echo SITE_URL.'quotespg/'.$newFile;?>" style="text-decoration:none;">"<?php echo $row['quote']; ?>"<br /><span style="font-weight:normal; color: #000"><i><?php  echo $row['authur'];?></i></span></a>
</div>
</div>
</div>
<div class="searchTable">
<?php //echo $GetAdverts -> LandScapeAds("Top Banner",$advert);?>
<div class="divider"></div><br />
<br /><br />
</div>
