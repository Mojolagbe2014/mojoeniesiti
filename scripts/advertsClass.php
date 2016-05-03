<?php
class Adverts{
	function LandScapeAds($position, $page){
		$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = '<div class="adverts">'.stripslashes($rows['content']).'</div>';
			}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
			$url = $rows['advert_link'];
		$content = '<a href="'.$rows['advert_link'].'" '.$this->NoFollow($rows['follow_link']).' target="_blank" onclick="trackOutboundLink(\''.$url.'\')" title="N.S.T Landscape Banner"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Landscape Banner" width="728" height="90" /></a>';
		}
	}
	else{
		if(($position == 'Index PageBanner 2') || ($position == 'Page Banner 1') || ($page == 'Index')  ){
			$content="";
		}
		else{
		$content = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- GoogleResponsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="2047505479"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
';
	}
		}
	return $content;
	}
	
	function LandScapeAds460($position, $page){
		$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = stripslashes($rows['content']);
			}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
			$url = $rows['advert_link'];
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="trackOutboundLink(\''.$url.'\')" '.$this->NoFollow($rows['follow_link']).' onmouseout="GetImp('.$rows['advert_id'].')" title="N.S.T Banner"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Banner" /></a>';
		}
	}
	else if($page == 'Index' ){
			$content="";
		}
	else{
		$content = '';
		}
	return $content;
	}
	
	
	function SideMenus($position, $page){
			$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = stripslashes($rows['content']);
	}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			$url = $rows['advert_link'];
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="trackOutboundLink(\''.$url.'\')" '.$this->NoFollow($rows['follow_link']).' onmouseout="GetImp('.$rows['advert_id'].')" title="N.S.T Landscape Banner"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Landscape Banner" /></a>';
		}
	}
	else if($page == 'Index' ){
			$content="";
		}
	else{
		if($position == 'Side Banner 2'){
		$content = '';
		}
		else{
	$content = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- GoogleResponsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="2047505479"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
		}
	}
	return $content;
	}
	
	function BottomSideMenusIndex($position, $page){
			$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = stripslashes($rows['content']);
	}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			$url = $rows['advert_link'];
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="trackOutboundLink(\''.$url.'\')"  '.$this->NoFollow($rows['follow_link']).' onmouseout="GetImp('.$rows['advert_id'].')" title="N.S.T Landscape Banner"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Landscape Banner" /></a>';
		}
	}
	else if($page == 'Index' ){
			$content="";
		}
	else{
		$content = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- GoogleResponsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="2047505479"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';

	}
	return $content;
	}
	
	function SkyScrapper($position, $page){
			$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = stripslashes($rows['content']);
	}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			$url = $rows['advert_link'];
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="trackOutboundLink(\''.$url.'\')"  '.$this->NoFollow($rows['follow_link']).' onmouseout="GetImp('.$rows['advert_id'].')" title="N.S.T Landscape Banner"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Landscape Banner" /></a>';
		}
	}
	else if($page == 'Index' ){
			$content='';
		}
	else{
	
	$content = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- GoogleResponsive -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="2047505479"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
	}
	return $content;
	}
	
	function SmallAds($position, $page){
			$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = stripslashes($rows['content']);
	}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			$url = $rows['advert_link'];
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="trackOutboundLink(\''.$url.'\')"  '.$this->NoFollow($rows['follow_link']).' onmouseout="GetImp('.$rows['advert_id'].')" title="N.S.T Advert Banner"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Advert Banner" width="234" height="90" /></a>';
		}
	}
	return $content;
	}
	
	function SmallSideAds($position, $page){
		$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1 order by advert_id desc ");
	if(NUM_ROWS($result) > 0){
		while($rows = SqlArrays($result)){
			if($rows['type'] == "PPC (Pay Per Click)"){
				$content .= '<div style="text-align:center;">'.stripslashes($rows['content']).'</div>';
			}else{
				$url = $rows['advert_link'];
				$content .= '<div style="margin-bottom:10px; margin-top:2px; text-align:center;">
		<a href="'.$rows['advert_link'].'" target="_blank" onclick="trackOutboundLink(\''.$url.'\')" '.$this->NoFollow($rows['follow_link']).' onmouseout="GetImp('.$rows['advert_id'].')" title="N.S.T Landscape Banner">
		<img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="N.S.T Landscape Banner" /></a></div>';
			}
		}
	}
	return $content;
	}
	function NoFollow($val){
		$nofollow = ($val == 0) ? 'rel="nofollow"' : '';
		return $nofollow;
	}
}
?>