<?php
//class Adverts{
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
		<script type="text/javascript">
	<!--
	var _adynamo_client = "0ca9decb-8776-495b-8af8-af5a39f5cff3";
	var _adynamo_width = 728;
	var _adynamo_height = 90;
	//-->
</script>
<script type="text/javascript" src="https://static-ssl.addynamo.net/ad/js/deliverAds.js"></script>
</div>
';
	}
		}
	return $content;
	}

//}
?>