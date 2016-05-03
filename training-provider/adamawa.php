<?php
session_start();
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
$paged = ""; $category_query = ""; $title = ""; $meta =""; $pageInnerTitle = ""; $pastLink =""; $pastEvent =""; $today = date("Y-m-d"); $dtds3=date("F"); $advert = "Training Providers"; $pg = "";$recordperpage = 30;$pagenum = 1;
 if(isset($_GET['page'])){ $pg = " - Pg-".$_GET['page']; $pagenum = $_GET['page']; }
 $url = $_SERVER['REQUEST_URI'];//request the url
 $CountryVal = explode('/',$url);//remove forward slashes from the url 

//get the last string from the url
if(isset($_GET['page'])){$urlVal = explode('?',end($CountryVal));$url_t_state = $urlVal[0];}
else{$url_t_state = end($CountryVal);}

//check if the string has the .php extension, add it if it does not have
if(!strpos($url_t_state,'.php')) $searchVar = $url_t_state.".php"; else $searchVar = $url_t_state;
$newFile = 'urlConfigState.txt';//file where to the countries ids exists
$metaFile = '../nstlogin/scripts/state_meta_title_description_training.txt';//load title / description file admin 
$Content = file($newFile); //read the file content
//looping through the file content array
foreach($Content as $Contents){$FileContent = explode("=>",$Contents);if($searchVar == $FileContent[0])$val = $FileContent[1];}
$offset = ($pagenum - 1) * $recordperpage;
if(isset($val) && isset($url_t_state)){
    $resultCT = MysqlSelectQuery("SELECT * FROM `states` WHERE id_state = '".$val."'");
    $rowsCT = SqlArrays($resultCT);
    $query = "and state=".$val; 
    if($rowsCT['name'] == 'Abuja') { $location = $rowsCT['name']." - FCT "; }
    else {$location = $rowsCT['name']." State"; }
    $pageInnerTitle = "List of training providers | training institutions |training firms / consultants | professional associations / bodies in ".$location.", Nigeria";
    if($val==2) {$pageInnerTitle = "Training Providers in ".$location.", Nigeria";}
    $paged = SITE_URL."training-provider/".$url_t_state;
    $file_content = file($metaFile);
    $meta_content = explode('=>',str_replace('[state]',$location,$file_content[0]));
    $meta = trimStringToFullWord(150, stripslashes(strip_tags($meta_content[1])));
    $title = trimStringToFullWord(60, stripslashes(strip_tags($meta_content[0])));
}
$result = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium=3 $query order by rand() limit $offset , $recordperpage");
$num = NUM_ROWS($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title><?php echo $title;?></title>
<meta name="description" content="<?php echo $meta;?>"/>
<meta name="keywords" content="training providers, training houses in nigeria, professional institutes, associations, management consultants,facilitators, training bodies ">
<meta name="dcterms.description" content="<?php echo $meta;?>" />
<meta property="og:title" content="<?php echo $title;?>" />
<meta property="og:description" content="<?php echo $meta;?>" />
<meta property="twitter:title" content="<?php echo $title;?>" />
<meta property="twitter:description" content="<?php echo $meta;?>" />
<?php include("../scripts/headers_new.php");?>
<style>#tabs{overflow:hidden;width:100%;margin:0;padding:0;list-style:none}#tabs li{float:left;margin:0 .5em 0 0}#tabs a{position:relative;background:#ddd;background-image:linear-gradient(to bottom,#fff,#ddd);padding:.08em .45em;padding-right:.4em;float:left;text-decoration:none;color:#444;text-shadow:0 1px 0 rgba(255,255,255,.8);border-radius:5px 0 0 0;box-shadow:0 2px 2px rgba(0,0,0,.4)}#tabs a:hover,#tabs a:hover::after,#tabs a:focus,#tabs a:focus::after{background:#fff}#tabs a:focus{outline:0}#tabs a::after{content:'';position:absolute;z-index:1;top:0;right:-.5em;bottom:0;width:.7em;background:#ddd;background-image:linear-gradient(to bottom,#fff,#ddd);box-shadow:2px 2px 2px rgba(0,0,0,.4);transform:skew(10deg);border-radius:0 5px 0 0}#tabs #current a,#tabs #current a::after{background:#fff;z-index:3}#this-content{background:#fff;padding:2em;border-left:solid 1px #ddd;border-right:solid 1px #ddd;height:400px;position:relative;z-index:2;border-radius:0 5px 5px 5px;box-shadow:0 -2px 3px -2px rgba(0,0,0,.5)}.cmd-list{overflow:hidden}</style>
</head>

<body>
<div>
<?php include("../tools/header_new.php");?>
<div id="main">
<div id="content">
<div class="category_content responsiveCategoryMain">
    <div style="margin-top:3%;">
        <div class="tprovider_search smart-forms" style="margin-bottom:10px;padding-top:0px;">
            <table style="width:100%;">
                <tr>
                    <td>   
                        <div class="smart-widget sm-right smr-80">
                            <form action="#" method="post" id="searchProvider" autocomplete="off">
                                <label class="field prepend-icon">
                                <input type="text" name="sub2" id="tsearch" class="gui-input " style="height:30px;margin:0px;padding: 2px" placeholder="Enter keyword to search">
                                <span id="output_providers"><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20" height="14" style="text-align:center" /></span>
<!--                                <span class="field-icon"><i class="fa fa-search" style="font-size:10px;top: -6px;"></i></span> -->
                                </label>
                                <button type="submit" class="button btn-primary" style="height: 30px;padding:0px"> Search </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </table>    
        </div>
    </div>
    <div class='addshadow' style="float:left;margin-top:10px; min-width:100%;">
        <div class="sneak_peak2_category" style="margin-bottom: 0px;">
            <div class="button_class_category"><h2 style="font-size:14px; margin-left: 10%;">Filter by states in Nigeria</h2></div>
        </div>
        <div class="state_filter" style="overflow: auto; margin-top: 0px;">
            <ul>
                <?php
                    $state =  MysqlSelectQuery("select * from states");
                     while($rowsState = SqlArrays($state)){
                        $strip = str_replace($title_link,"-",$rowsState['name']);
                        $final = strtolower(str_replace("--","-",$strip));
                        if($final== 'niger') $final .= "-st";
                     
                        echo '<li><a href="'.SITE_URL."training-provider/".$final.'">'.$rowsState['name'].'</a></li>';
                  } ?>
            </ul>
        </div>
    </div>
    <div class="featuredVenue addshadow" style="float:left;margin-bottom:5px">
<!--        <div class="sneak_peak2_category">-->
            <div class="button_class_category"><h3 style="font-size:14px; padding-left:4px;margin-left:5%;">Find Training Providers</h3></div>
<!--        </div>-->
        <ul>
            <li><h3 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>cmd-accr-training-providers" title="CMD Accredited Training providers"> <i class="fa fa-square" style="font-size:6px;"></i> CMD Accredited Training Providers</a></h3></li>
            <li><h3 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>training-provider/nigeria" title="Training Providers in  Nigeria"> <i class="fa fa-square" style="font-size:6px;"></i> Training Providers in Nigeria</a></h3></li>
            <li><h3 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" title="Training Providers by Category"> <i class="fa fa-square" style="font-size:6px;"></i> Training Providers by Category</a></h3></li>
            <li><h3 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>training-providers/countries" title="Training Providers by Countries"> <i class="fa fa-square" style="font-size:6px;"></i> Training Providers by Countries</a></h3></li>
        </ul>
    
<!--        <div class="sneak_peak2_category">-->
            <div class="button_class_category"><h3 style="font-size:14px; padding-left:4px;margin-left:5%;">Other Links</h3></div>
<!--        </div>-->
        <ul>
            <li><h4 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>articles" title="Articles"> <i class="fa fa-square" style="font-size:6px;"></i> Articles</a></h4></li>
            <li><h4 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>archive" title="News and Updates"> <i class="fa fa-square" style="font-size:6px;"></i> News and Updates</a></h4></li>
            <li><h4 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>quoteArchive" title="Quotes"> <i class="fa fa-square" style="font-size:6px;"></i> Quotes</a></h4></li>
            <li><h4 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>contact-us" title="Contact Us"> <i class="fa fa-square" style="font-size:6px;"></i> Contact Us</a></h4></li>
            <li><h4 style="font-size:12px;font-weight:normal;margin-left:5%;"><a href="<?php echo SITE_URL;?>advertise" title="Advertise"> <i class="fa fa-square" style="font-size:6px;"></i> Advertise</a></h4></li>
        </ul>
    </div>
    <div class="clearfix"></div>
<div style="text-align:center; padding-top:15px;">
<?php echo $GetAdverts -> SkyScrapper("Page Skyscapper Left",$advert);?>
</div>
<!--<div style="text-align:center;margin-top:10px;margin-bottom:10px;" id="play-games"></div>-->
</div>

<?php //include("../tools/categories_new.php");?>
<div id="content_left">

<div class="event_table_inner">

<form action="../search_venuproviders" method="get" id="searchform" autocomplete="off">
<table style="width:100%;border:0px;">
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td style="padding-left:8px"><h2 style="font-size:23px; padding:5px;"><?php echo $pageInnerTitle;?></h2></td>
</tr>
<tr><td style="font-size:11px;"><div style="margin-top:2%;text-align:center;color:#fff"><i>(Search training providers alphabetically)</i></div></td></tr>
</table>
</form>
</div>

<div id="subpage">

                <div id="subpage_content">
                    <div>
                        <ul id="tabs">
                            <?php 
                                global $sql_connection;
                                $alphas = ['PREMIUM','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                                $tabsIdHolder = [];
                                foreach($alphas as $alpha){ 
                                    $sqlCmdTr = ''; $alphaStyle = '';
                                    switch($alpha){
                                        case 'PREMIUM': $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium !=0 $query ORDER BY RAND() "; break;
                                        default: $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium =0  AND  business_name LIKE '".$alpha."%' $query ORDER BY business_name ASC "; 
                                                 break;
                                    }
                                    //$sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' $query ORDER BY premium DESC "; 
                                    $result = MysqlSelectQuery($sqlCmdTr);
                                    $num = NUM_ROWS($result);
                                    if($num != 0) {
                                        array_push($tabsIdHolder, "tab$alpha");
                                        $alphaStyle = 'text-decoration:underline; font-weight: bolder; color:#000;';
                                        echo '<li><a href="#" data-name="tab'.$alpha.'" style="'.$alphaStyle.'">'.$alpha.'</a></li>'; 
                                    }
                                }
                            ?>
                            
                        </ul>
                        <div id="this-content">
                            <?php  
                            
                            foreach($alphas as $alpha){
                                //$sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' $query ORDER BY premium DESC "; 
                                $sqlCmdTr = ''; 
                                switch($alpha){
                                    case 'PREMIUM': $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium !=0 $query ORDER BY RAND() "; break;
                                    default: $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium =0  AND  business_name LIKE '".$alpha."%' $query ORDER BY business_name ASC "; 
                                             break;
                                }
                                $result = MysqlSelectQuery($sqlCmdTr);
                                echo '<div id="tab'.$alpha.'">';
                                $count =1; 
                                while($rows = SqlArrays($result)){ 
                                    $cmdStatus = '';
                                    $logo = MysqlSelectQuery("SELECT * FROM logos WHERE user_id ='".$rows['user_id']."' AND user_id !=0");
                                    $biz_logo = SqlArrays($logo);$logoNum = NUM_ROWS($logo);
                                    if($logoNum > 0){
                                        $biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
					$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="50" height="50" style="margin-top:2%;" />';
                                    }else{ $image = '<img src="'.SITE_URL.'images/blank.png" alt="business logo"  width="50" height="50" style="margin-top:2%;"/>';	}
                                    if(!empty($rows['cmd_accr_number'])){ $cmdStatus ='<div style="margin-bottom:4px; width:200px; height:33px; background-image: url('.SITE_URL.'images/accreditation.png); background-repeat: no-repeat;"></div>'; }
                                    echo '<a href="'.SITE_URL.'tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" title="'. $rows['business_name'].'"><div class="cmd-list eventListing">'.$cmdStatus.'<div style="text-align:center">'.$image.'</div><div><span class="spanTitle" style="display:block; padding:3px;">'. $rows['business_name'].'</span></div><div style="color:#000; font-size:12px; text-align:justify;"  class="description" >'.trimStringToFullWord(150, stripslashes(strip_tags($rows['description']))).' ...'.'</div><div class="trainingProviders"><span class="provider">Contact:&nbsp;</span><span class="provider_name"><span style="color:#000;">'.trimStringToFullWord(100, stripslashes(strip_tags($rows['address']))).'</span></span></div></div></a>';
                                } 
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <div class="clearfix"></div><br><br>
                    </div>
                </div>
            </div>
<div id="sub_links2_middle"><!-- Begin BidVertiser code -->
<?php echo $GetAdverts -> LandScapeAds("Page Banner 2",$advert);?>
<div class="clearfix"></div>
</div>
</div>
<?php include("../tools/side-menu_new.php");?>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
<?php include ("../tools/footer_new.php");?>
<script>
    $(document).ready(function() {
        $("#this-content").find("[id^='tab']").hide(); // Hide all content
        $("#tabs li:first").attr("id","current"); // Activate the first tab
        <?php if(count($tabsIdHolder)!=0){ ?>
        $("#this-content <?php echo '#'.$tabsIdHolder[0]; ?>").slideToggle('slow') // Show first tab's content
        <?php } ?>
            
        $('#tabs a').click(function(e) {
            e.preventDefault();
            if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
             return;       
            }
            else{             
              $("#this-content").find("[id^='tab']").hide(); // Hide all content
              $("#tabs li").attr("id",""); //Reset id's
              $(this).parent().attr("id","current"); // Activate this
              $('#' + $(this).attr('data-name')).slideToggle('slow'); // Show content for the current tab
            }
        });
    });
</script>
<script type="text/javascript">
$(document).ready(function(e) {
/*********** script to show the training providers on the search form **************/
//fires up the training providers when the keboard is pressed
$('#tsearch').keyup(function(){
$('#output_providers').fadeIn('slow');
$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader"  /></center>')
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Training'}, function(data) {$('#output_providers').html(data)
});
})
//disappears the training providers when the text box looses focus
$('#tsearch').blur(function(){
$('#output_providers').fadeOut();})
//displays the training providers when the text box gains focus
$('#tsearch').focus(function(){
$('#output_providers').fadeIn('slow');
$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
if($(this).val() == ""){
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {queryFocus:$(this).val(),type:'Training'}, function(data) {$('#output_providers').html(data)			
});
}
else{
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Training'}, function(data) {$('#output_providers').html(data)
});
}
})
});
//funtion to retrieve the value from the training providers drop down
function GetProVal(elem){
var URL = $('#'+elem).attr('data');$('#tsearch').val($('#'+elem).text());
$('#output_providers').hide();$('#searchProvider').attr('action',URL)
}
</script>
</body>
</html>