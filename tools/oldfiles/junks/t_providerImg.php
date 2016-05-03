<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");

$getVar = explode("-",$_GET['imgID']);

$event_id = $getVar[1];

$result = MysqlSelectQuery("select organiser from events where event_id='".$event_id."'");

$rows = SqlArrays($result);

$business = MysqlSelectQuery("select * from businessinfo left join logos using (user_id)  where business_name like '%".$rows['organiser']."%' and premium > 0");
						$biz_name = SqlArrays($business);
						if($biz_name['logos'] == '') $logo = 'images/star2.png'; else $logo = 'premium/logos/thumbs/'.$biz_name['logos'];
?>

 <div class="testImg" style="background-image:url(<?php echo SITE_URL.$logo;?>); background-repeat:no-repeat; background-position:center;">
                      <!-- <img src="images/no_icon.gif" alt="business logo" width="50" height="50"/>-->
                       </div>