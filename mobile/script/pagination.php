<?php
function Pagination($query1,$recordperpage,$pagenum,$pagelink){
	$result = MysqlSelectQuery($query1) or die ("Invalid Query:".mysql_error());
	$row = SqlArrays($result);
	$total_record = $row ['numrows'];
	$maxpage = ceil($total_record / $recordperpage);

	//$nav ="";
	$current = "";
	$current = $pagenum;
	$index_limit = 10;
	$start=max($current-intval($index_limit/2), 1);
    $end=$start+$index_limit-1;	 
	echo '<br /><br /><div class="pagination">';

        if($current==1) {
            echo '<span class="disabled">«</span>&nbsp;';
        } else {
            $i = $current-1;
            echo '<a href="'.$pagelink.'&page='.$i.'" rel="nofollow" title="go to page'.$i.'">«</a>&nbsp;';
            //echo '<span class="prn">...</span>&nbsp;';
        }
		
	  if($start > 1) {
            $i = 1;
            echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        for ($i = $start; $i <= $end && $i <= $maxpage; $i++){
            if($i==$current) {
                echo ' <a href="#" class="active">'.$i.'</a>';
            } else {
                echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
            }
        }
		   if($maxpage > $end){
            $i = $maxpage;
            echo '<a href="'.$pagelink.'&page='.$i.'" title="go to page '.$i.'">'.$i.'</a>&nbsp;';
        }

        if($current < $maxpage) {
            $i = $current+1;
            //echo '<span>...</span>&nbsp;';
            echo '<a href="'.$pagelink.'&page='.$i.'" rel="nofollow" title="go to page '.$i.'">»</a>&nbsp;';
        } else {
            echo '<span class="disabled">»</span>&nbsp;';
        }
        
        //if nothing passed to method or zero, then dont print result, else print the total count below:
        if ($maxpage != 0){
            //prints the total result count just below the paging
			echo '<p id="total_count" style="font-size:11px; margin-top:5px;">(Viewing Page '.$pagenum.' of '.$maxpage.') | (Total '.$total_record.' Result (s))</p></div>';
        }
}


?>