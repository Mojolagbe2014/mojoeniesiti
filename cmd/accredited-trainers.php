<?php
    session_start();
    @require_once("../scripts/config.php");
    @require_once("../scripts/functions.php");
    
    if(connection());
   
    global $sql_connection;
    $filterParam = filter_input(INPUT_GET, "filter") ? mysqli_real_escape_string($sql_connection, filter_input(INPUT_GET, "filter")) :  '';
    $thisPageHead = ''; 
    if($filterParam!=''){
        $splitFilterParam = explode('-', $filterParam); $thisPageHead = ' '.str_replace($splitFilterParam[0].'-', '', $filterParam);
        if($splitFilterParam[0] !=2) $thisPageHead .= ' state,';  else $thisPageHead .= ', ';
    }
?>
<link href="css/cmd.css" rel="stylesheet" type="text/css"/>
<div id="cmd-body">
    <div id="content">
        <div id="content_left">
            <div id="subpage">
                <ul id="tabs">
                    <?php 
                        $alphas = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                        $tabsIdHolder = array();
                        foreach($alphas as $alpha){ 
                            $alphaStyle = '';
                            if($filterParam!=''){
                                $splitFilterParam = explode('-', $filterParam);
                                $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' AND cmd_accr_number !='' AND state = ".$splitFilterParam[0]." ORDER BY premium DESC ";
                            }
                            else{ $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' AND cmd_accr_number !='' ORDER BY premium DESC "; }
                            $result = MysqlSelectQuery($sqlCmdTr);
                            $num = NUM_ROWS($result);
                            if($num != 0) {$alphaStyle = 'color:#000;';
                            array_push($tabsIdHolder, "tab$alpha");
                            echo '<li><a href="#" data-name="tab'.$alpha.'" style="'.$alphaStyle.'">'.$alpha.'</a></li>'; 
                            }
                        }
                    ?>

                </ul>
                <div id="this-content">
                    <?php  
                    //global $sql_connection;
                    //$filterParam = filter_input(INPUT_GET, "filter") ? mysqli_real_escape_string($sql_connection, filter_input(INPUT_GET, "filter")) :  '';

                    foreach($alphas as $alpha){
                        if($filterParam!=''){
                            $splitFilterParam = explode('-', $filterParam);
                            $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' AND cmd_accr_number !='' AND state = ".$splitFilterParam[0]." ORDER BY premium DESC ";
                        }
                        else{ $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' AND cmd_accr_number !='' ORDER BY premium DESC "; }
                        $result = MysqlSelectQuery($sqlCmdTr);
                        echo '<div id="tab'.$alpha.'">';
                        $count =1;
                        while($rows = SqlArrays($result)){ 
                            echo '<a href="'.SITE_URL.'tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" title="'. $rows['business_name'].'"><div class="cmd-list eventListing"><div><span class="spanTitle" style="display:block; padding:3px;">'. $rows['business_name'].'</span></div><div style="color:#000; font-size:12px; text-align:justify;"  class="description" >'.trimStringToFullWord(150, stripslashes(strip_tags($rows['description']))).'...'.'</div><div class="trainingProviders"><span class="provider">Contact:&nbsp;</span><span class="provider_name"><span style="color:#000;">'.substr($rows['address'],0,100).'</span></span></div></div></a>';
                        } 
                        echo '</div>';
                    }
                    ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() { $("#this-content").find("[id^='tab']").hide(); $("#tabs li:first").attr("id","current"); <?php if(count($tabsIdHolder)!=0){ ?> $("#this-content <?php echo '#'.$tabsIdHolder[0]; ?>").slideToggle('slow');  <?php } ?> $('#tabs a').click(function(e) { e.preventDefault(); if ($(this).closest("li").attr("id") == "current"){  return;  } else{ $("#this-content").find("[id^='tab']").hide(); $("#tabs li").attr("id",""); $(this).parent().attr("id","current"); $('#' + $(this).attr('data-name')).slideToggle('slow'); } }); });
</script>
