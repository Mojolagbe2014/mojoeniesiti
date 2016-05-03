<?php
    session_start();
    require_once("scripts/config.php");
    require_once("scripts/functions.php");
    if($_SERVER['REQUEST_URI'] == "/training_providersTraining"){
        header("location: training_providers");
    }
    $advert =""; $bg_class='eventListing';
    $pageSuffix  = "";
    function GetCatName($id){
        $result = MysqlSelectQuery("select * from categories where category_id='$id'");
        $rows = SqlArrays($result);
        return $rows['category_name'];
    }
    if(connection());
    $recordperpage =  20;
    $pagenum = 1;
    if(isset($_GET['page'])){
        $pageSuffix  = " Pg ".$_GET['page'];
        $pagenum = $_GET['page'];
    }
    $offset = ($pagenum - 1) * $recordperpage;$view = '';
    $paging = SITE_URL."cmd-accr-training-providers?get";
    $result = MysqlSelectQuery("SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND cmd_accr_number !='' ORDER BY premium DESC LIMIT $offset , $recordperpage");
    $num = NUM_ROWS($result);$advert = "Training Providers";
    
    global $sql_connection;
    $filterParam = filter_input(INPUT_GET, "filter") ? mysqli_real_escape_string($sql_connection, filter_input(INPUT_GET, "filter")) :  '';
    $thisPageHead = ''; 
    if($filterParam!=''){
        $splitFilterParam = explode('-', $filterParam); $thisPageHead = ' '.str_replace($splitFilterParam[0].'-', '', $filterParam);
        if($splitFilterParam[0] !=2) $thisPageHead .= ' state,';  else $thisPageHead .= ', ';
    }
    $title = trimStringToFullWord(60, stripslashes(strip_tags("CMD Accredited Training Institutions / Firms in ".ucwords($thisPageHead). " Nigeria")));
    $description = trimStringToFullWord(150, stripslashes(strip_tags("List and Addresses of Centre for Management Development (CMD) Accredited Training Institutions/Firms, training providers in ".ucwords($thisPageHead)." Nigeria")));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <?php include('tools/analytics.php');?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>"/> 
    <meta name="keywords" content="cmd, accredited, training providers, training houses, professional institutions, consultants, training bodies, firms, centre for management development ">
    <meta name="dcterms.description" content="<?php echo $description; ?>" />
    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo $description; ?>" />
    <meta property="twitter:title" content="<?php echo $title; ?>" />
    <meta property="twitter:description" content="<?php echo $description; ?>" />     
    <?php include("scripts/headers_new.php");?>
    <style> #tabs{overflow:hidden;width:100%;margin:0;padding:0;list-style:none}#tabs li{float:left;margin:0 .5em 0 0}#tabs a{position:relative;background:#ddd;background-image:linear-gradient(to bottom,#fff,#ddd);padding:.1em .55em;float:left;text-decoration:none;color:#444;text-shadow:0 1px 0 rgba(255,255,255,.8);border-radius:5px 0 0 0;box-shadow:0 2px 2px rgba(0,0,0,.4)}#tabs a:hover,#tabs a:hover::after,#tabs a:focus,#tabs a:focus::after{background:#fff}#tabs a:focus{outline:0}#tabs a::after{content:'';position:absolute;z-index:1;top:0;right:-.5em;bottom:0;width:1em;background:#ddd;background-image:linear-gradient(to bottom,#fff,#ddd);box-shadow:2px 2px 2px rgba(0,0,0,.4);transform:skew(10deg);border-radius:0 5px 0 0}#tabs #current a,#tabs #current a::after{background:#fff;z-index:3}#this-content{height:250px;background:#fff;padding:2em;border-left:solid 1px #ddd;border-right:solid 1px #ddd;height:400px;position:relative;z-index:2;border-radius:0 5px 5px 5px;box-shadow:0 -2px 3px -2px rgba(0,0,0,.5)}.cmd-list{overflow:hidden} </style>
    </head>
    <body>
            <?php include("tools/headers_new.php");?>
            <div id="main">
                <?php include("tools/categories_new.php"); ?>
                <div id="content">
                            <div id="content_left">
                                <div class="event_table_inner" >
                                    <form method="POST" id="searchform" autocomplete="off">
                                        <table >
                                        <tr><td>&nbsp;</td></tr>
                                        <tr><td style="padding-left:8px;"><h1 style="font-size:20px; padding:5px;">Centre for Management Development (CMD) Accredited Training Institutions/Firms in <?php echo ucwords($thisPageHead); ?> Nigeria</h1></td></tr>
                                        <tr><td style="font-size:11px;"><div style="margin-top:2%;text-align:center"><h2 style="font-weight:normal; font-size:11px;"><i>(Search training providers alphabetically)</i></h2></div><h3>&nbsp;</h3></td></tr>
                                        </table>
                                    </form>
                                </div>
                                <div id="subpage">
                                    <ul id="tabs">
                                        <?php 
                                            $alphas = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                                            foreach($alphas as $alpha){ 
                                                $alphaStyle = '';
                                                if($filterParam!=''){
                                                    $splitFilterParam = explode('-', $filterParam);
                                                    $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' AND cmd_accr_number !='' AND state = ".$splitFilterParam[0]." ORDER BY premium DESC ";
                                                }
                                                else{ $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  business_name LIKE '".$alpha."%' AND cmd_accr_number !='' ORDER BY premium DESC "; }
                                                $result = MysqlSelectQuery($sqlCmdTr);
                                                $num = NUM_ROWS($result);
                                                if($num != 0) $alphaStyle = 'text-decoration:underline; font-weight: bolder; color:#000;';
                                                echo '<li><a href="#" data-name="tab'.$alpha.'" style="'.$alphaStyle.'">'.$alpha.'</a></li>'; 
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
                                                $logo = MysqlSelectQuery("SELECT * FROM logos WHERE user_id ='".$rows['user_id']."' AND user_id !=0");
                                                $biz_logo = SqlArrays($logo);$logoNum = NUM_ROWS($logo);
                                                if($logoNum > 0){
                                                    $biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
                                                    $image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="50" height="50" style="margin-top:2%;" />';
                                                }else{ $image = '<img src="'.SITE_URL.'images/blank.png" alt="business logo"  width="50" height="50" style="margin-top:2%;"/>';	}

                                                echo '<a href="'.SITE_URL.'tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" title="'. $rows['business_name'].'"><div class="cmd-list eventListing"><div style="text-align:center">'.$image.'</div><div><span class="spanTitle" style="display:block; padding:3px;">'. $rows['business_name'].'</span></div><div style="color:#000; font-size:12px; text-align:justify;"  class="description" >'.trimStringToFullWord(150, stripslashes(strip_tags($rows['description']))).'...'.'</div><div class="trainingProviders"><span class="provider">Contact:&nbsp;</span><span class="provider_name"><span style="color:#000;">'.substr($rows['address'],0,100).'</span></span></div></div></a>';
                                            } 
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div><br><br>

                                </div> <!-- -->
                                <div id="sub_links2_middle"><!-- Begin BidVertiser code -->
                                    <?php echo $GetAdverts -> LandScapeAds("Page Banner 1",$advert);?>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- end subpage -->
                            </div>
                        <?php include("tools/side-menu_new.php"); ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
<?php include ("tools/footer_new.php");?>
<script>
    $(document).ready(function() {
        $("#this-content").find("[id^='tab']").hide(); // Hide all content
        $("#tabs li:first").attr("id","current"); // Activate the first tab
        $("#this-content #tabA").slideToggle('slow') // Show first tab's content

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