<div class="category_content responsiveCategoryMain">

<!-- Event States -->
<?php if (strpos($_SERVER['SCRIPT_NAME'],'nigeria.php') && !strpos($_SERVER['SCRIPT_NAME'],'training-provider/nigeria.php')) { ?>
<div class='addshadow' style="float:left;margin-top:1px; min-width:100%;margin-bottom:10px">
<div class="sneak_peak2_category" style="margin-bottom: 0px;">
<div class="button_class_category"><strong style="font-size:14px; margin-left: 10%;">Filter by states in Nigeria</strong></div>
</div>
<div class="state_filter" style="overflow: auto; margin-top: 0px;">
<ul>
<?php $stateCMD =  MysqlSelectQuery("select * from states"); while($rowsState = SqlArrays($stateCMD)){ $strip = str_replace($title_link,"-",$rowsState['name']); $final = strtolower(str_replace("--","-",$strip)); if($final== 'niger') $final .= "-st"; echo '<li><a href="'.SITE_URL.$final.'">'.$rowsState['name'].'</a></li>'; } ?>
</ul>
</div>
</div> 
<?php } ?>
<!-- Events in Lagos Divisions -->
<?php 
$thisPageURL = $_SERVER['REQUEST_URI']; $lagDivsVal = explode('/',$thisPageURL);
if(isset($_GET['year'])){ $mainUrlVal = explode('?',end($lagDivsVal)); $urlStateDivs = $mainUrlVal[0]; }
else{ $urlStateDivs = end($lagDivsVal); }
$cleanedURLVal  = str_replace("-"," ", str_replace('-division', '', ucwords($urlStateDivs)));
$resultStatDiv = MysqlSelectQuery("SELECT * FROM `lagos_divisions` WHERE name = '".$cleanedURLVal."'");
$isSubDivision = NUM_ROWS($resultStatDiv) > 0 ? True : False;
if ((strpos($_SERVER['SCRIPT_NAME'],'lagos.php') && !strpos($_SERVER['SCRIPT_NAME'],'training-provider/lagos.php')) || $isSubDivision || strpos($_SERVER['SCRIPT_NAME'],'lagos-division.php')) { 
?>
<div class='addshadow' style="float:left;margin-top:1px; min-width:100%;margin-bottom:10px">
<div class="sneak_peak2_category" style="margin-bottom: 0px;">
<div class="button_class_category"><strong style="font-size:14px; margin-left: 10%;">Filter by Lagos Divisions</strong></div>
</div>
<div class="state_filter" style="overflow: auto; margin-top: 0px;">
<ul>
<?php if(!strpos($_SERVER['SCRIPT_NAME'],'lagos.php')){ ?> <li><a href="<?php echo SITE_URL."lagos"; ?>" title="Events in all Lagos Divisions">All Divisions</a></li> <?php } ?>

<?php 
$availRegions = array("Badagry"=>1, "Epe"=>2, "Ikeja"=>3, "Ikorodu"=>4, "Lagos"=>5);
foreach ($availRegions as $key => $value) {
    echo '<li><a href="'.SITE_URL.strtolower($key."-division").'" style="color:red">'.$key.' Division</a></li>';
    $stateDivs =  MysqlSelectQuery("SELECT * FROM lagos_divisions WHERE region = $value"); 
    while($rowsStateDivs = SqlArrays($stateDivs)){ 
        $strip = str_replace($title_link,"-",$rowsStateDivs['name']); 
        $final = strtolower(str_replace("--","-",$strip));
        echo '<li><a href="'.SITE_URL.$final.'" title="Events in '.$rowsStateDivs['name'].', Lagos Division">'.$rowsStateDivs['name'].'</a></li>'; 
    }
}
?>
</ul>
</div>
</div> 
<?php } ?>
<!-- States -->
<?php if (strpos($_SERVER['SCRIPT_NAME'],'cmd-accr-training-providers.php') != false) { ?>
<div class='addshadow' style="float:left;margin-top:1px; min-width:100%;">
<div class="sneak_peak2_category" style="margin-bottom: 0px;">
<div class="button_class_category"><strong style="font-size:14px; margin-left: 10%;">Filter by states in Nigeria</strong></div>
</div>
<div class="state_filter" style="overflow: auto; margin-top: 0px;">
<ul>
<?php $stateCMD =  MysqlSelectQuery("select * from states"); while($rowsState = SqlArrays($stateCMD)){ $strip = str_replace($title_link,"-",$rowsState['name']); $final = strtolower(str_replace("--","-",$strip)); if($final== 'niger') $final .= "-st"; echo '<li><a href="'.str_replace('.php', '', $_SERVER['PHP_SELF']).'/'.$rowsState['id_state'].'-'.$final.'">'.$rowsState['name'].'</a></li>'; } ?>
</ul>
</div>
</div> 
<?php } ?>

<div style="text-align:center; padding-top:15px; display:block;">
<?php echo $GetAdverts -> SkyScrapper("Page Skyscapper Left",$advert);?>
<div class="clear"></div>
</div>
<div style="text-align:center;margin-top:10px;margin-bottom:10px;" id="hotel"></div>
</div>
