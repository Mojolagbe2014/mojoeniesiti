<?php
require_once("../scripts/config.php");
		require_once("../scripts/functions.php");
		if(connection());


                    $countries = MysqlSelectQuery("select * from states order by name");



					$total_item = NUM_ROWS($countries);



					$colSize = 13;



		 			$column = 0; // init a column counter				



					for($count=0; $count < $total_item; $count++) {



					$rows = SqlArrays($countries);



    				$isStartOfNewColum = 0 === ($count % $colSize); // modulo



    				$isEndOfColumn = ($count && $isStartOfNewColum);



    				$isStartOfNewColum && $column++; // update column counter





					if ($isEndOfColumn) {

		

       					 echo "</ul></div>";

   					 }



					  if ($isStartOfNewColum) {



       					 echo'<div class="link_box">



						 <ul>';



    					}



						$strip = str_replace(" / ","-",$rows['name']);



						$final = str_replace(" ","-",$strip);



						$num = MysqlSelectQuery("select business_id from businessinfo where state='".$rows['state_id']."' and status = 1");



						$totalCat = NUM_ROWS($num);



						echo '<li><a href="'.SITE_URL.'training_providers/state/'.$rows['id_state'].'/'.$final.'">'.$rows['name'].'</a></li>';	

						}



    					echo "</ul></div>";



					?>