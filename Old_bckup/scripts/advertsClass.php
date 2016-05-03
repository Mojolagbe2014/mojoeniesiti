<?php
class Adverts{
	function LandScapeAds($position, $page){
		$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1");
	$rows = SqlArrays($result);
	if(NUM_ROWS($result) > 0){
	if($rows['type'] == "PPC (Pay Per Click)"){
		$content = '<div class="adverts" id="ad">'.stripslashes($rows['content']).'</div>';
			}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="GetAds('.$rows['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="Nigerian Seminars and Training Landscape Banner" /></a>';
		}
	}
	else{
		if($position == 'Index PageBanner 2'){
			$content="";
		}
		else{
		$content = '<div class="adverts" id="ad">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Indexpagebanner1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="4933860671"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div>
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
			
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="GetAds('.$rows['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="Nigerian Seminars and Training Banner" /></a>';
		}
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
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="GetAds('.$rows['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="Nigerian Seminars and Training Landscape Banner" /></a>';
		}
	}
	else{
		$content = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- 300x250index_sidead2 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="6270993079"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>';
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
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="GetAds('.$rows['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="Nigerian Seminars and Training Landscape Banner" /></a>';
		}
	}
	else{
		$content = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- indexsidead3 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-8065984041001502"
     data-ad-slot="6923467878"></ins>
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
		$content = '<center>'.stripslashes($rows['content']).'</center>';
	}
		else if($rows['type'] == "DIA (Direct Image Ads)"){
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="GetAds('.$rows['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="Nigerian Seminars and Training Landscape Banner" /></a>';
		}
	}
	else{
	
	$content = '';
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
			//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows['content']));
		$content = '<a href="'.$rows['advert_link'].'" target="_blank" onclick="GetAds('.$rows['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows['content']).'" alt="Nigerian Seminars and Training Landscape Banner" /></a>';
		}
	}
	return $content;
	}
	
	function SmallSideAds($position, $page){
		$content = "";
	$result = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1 order by advert_id asc ");
	$rows = SqlArrays($result);
	$content = "";
	if(NUM_ROWS($result) > 0){
		$result_use = MysqlSelectQuery("select * from adverts where position = '$position' and location = '$page' and status=1 order by advert_id asc ");
		if($rows['type'] == "PPC (Pay Per Click)"){
			
			while($rows_use = SqlArrays($result_use)){
		$content .= '<center>'.stripslashes($rows_use['content']).'</center>';
			}
		}

	else if($rows['type'] == "DIA (Direct Image Ads)"){
	while($rows_use = SqlArrays($result_use)){
		//list($width, $height) = @getimagesize(SITE_URL."images/adverts/".stripslashes($rows_use['content']));
		$content .= '<div style="margin-bottom:10px; margin-top:2px;" align="center"><a href="'.$rows_use['advert_link'].'" target="_blank" onclick="GetAds('.$rows_use['advert_id'].')" onmouseout="GetImp('.$rows['advert_id'].')"><img src="'.SITE_URL."images/adverts/".stripslashes($rows_use['content']).'" alt="Nigerian Seminars and Training Landscape Banner" /></a></div>';
			}
		}	
	}
	return $content;
	}
}
?>