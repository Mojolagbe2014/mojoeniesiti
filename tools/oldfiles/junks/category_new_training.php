<?php
require_once("../scripts/config.php");
		require_once("../scripts/functions.php");
		if(connection());
					$today = date("Y-m-d");
                    $categories = MysqlSelectQuery("select * from categories order by category_name");

					$total_item = NUM_ROWS($categories);

					$colSize = 11;

		 			$column = 0; // init a column counter

					

					for($count=0; $count< $total_item; $count++) {

					$rows = SqlArrays($categories);

					 

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

					

						$strip = str_replace(" / ","-",$rows['category_name']);

						$final = str_replace(" ","-",$strip);

						$num = MysqlSelectQuery("select specialization from businessinfo where business_type='Training' and specialization='".$rows['category_id']."'");

						$totalCat = NUM_ROWS($num);
						

						echo '<li><a href="'.SITE_URL.'trainingCategory/spe?category='.$rows['category_id'].'-'.$final.'">'.$rows['category_name'].'</a></li>';

						}

					//if ($count && !$isEndOfColumn && --$count === $total_item) {

    					echo "</ul></div>";

						//}

					?>