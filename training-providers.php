<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
if($_SERVER['REQUEST_URI'] == "/training_providersTraining"){
header("location: training_providers");
}
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
$offset = ($pagenum - 1) * $recordperpage;
$view = '';
$paging = SITE_URL."training-providers?get";
$result = MysqlSelectQuery("select * from businessinfo where business_type='Training' and status =1 and premium = 3 order by rand() limit $offset , $recordperpage");
$num = NUM_ROWS($result);
$advert = "Training Providers";
global $sql_connection;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('tools/analytics.php');?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="<?php echo SITE_URL;?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<title> Training Providers - Nigerian Seminars and Trainings <?php echo $pageSuffix;?></title>
<meta name="description" content="Find training providers | training institutions |consultants | professional associations / bodies in Nigeria | Africa | Asia | North/South America | Europe <?php echo $pageSuffix;?>"/>
<meta name="keywords" content="training providers, training houses, in nigeria, professional institutes, consultants, associations, management consultants,facilitators, training bodies ">
<meta name="dcterms.description" content="Find training providers | training institutions |consultants | professional associations / bodies in Nigeria | Africa | Asia | North/South America | Europe <?php echo $pageSuffix;?>" />
<meta property="og:title" content=" Training Providers - Nigerian Seminars and Trainings " />
<meta property="og:description" content="Find training providers | training institutions |consultants | professional associations / bodies in Nigeria | Africa | Asia | North/South America | Europe <?php echo $pageSuffix;?>" />
<meta property="twitter:title" content=" Training Providers - Nigerian Seminars and Trainings " />
<meta property="twitter:description" content="Find training providers | training institutions |consultants | professional associations / bodies in Nigeria | Africa | Asia | North/South America | Europe <?php echo $pageSuffix;?>" />
<?php include("scripts/headers_new.php");?>
</head>

<body>
<?php include("tools/headers_new.php");?>
<div id="main">
<div id="content">
<?php include("tools/categories_new.php");?>
<div id="content_left">
    <div class="event_table_inner">
        <form action="search_venuproviders" method="get" id="searchform" autocomplete="off">
            <table >
                <tr>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td style="padding-left:8px;"><h2 style="font-size:23px; font-weight: normal; padding:0px;">Training providers in Nigeria, Africa, Asia, North/South America, Europe and Oceania</h2></td>
                </tr>
                <tr><td><div style="margin-top:2%;text-align:center"><h3 style="font-weight:normal; font-size:11px;"><i>(Search training providers alphabetically)</i></h3></div></td></tr>
            </table>
        </form>
    </div>
    <div id="subpage">
        <div>
            <div>
                <ul id="tabs">
                    <?php 
                        $alphas = ['PREMIUM','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
                        $tabsIdHolder = [];
                        foreach($alphas as $alpha){ 
                            $sqlCmdTr = ''; $alphaStyle = '';
                            switch($alpha){
                                case 'PREMIUM': $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium !=0 ORDER BY RAND() "; break;
                                default: $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium =0 AND  business_name LIKE '$alpha%' ORDER BY business_name ASC "; 
                                         break;
                            }
                            
                            $result = MysqlSelectQuery($sqlCmdTr);
                            $num = NUM_ROWS($result);
                            if($num != 0) {
                                array_push($tabsIdHolder, "tab$alpha");
                                $alphaStyle = 'text-decoration:underline;font-weight: bolder; color:#000;';
                                echo '<li><a href="#" title="Training Providers in '.$alpha.'" data-name="tab'.$alpha.'" style="'.$alphaStyle.'">'.$alpha.'</a></li>'; 
                            }
                        }
                    ?>
                    
                </ul>
                <div id="this-content">
                    <?php  
                    
                    foreach($alphas as $alpha){
                        $sqlCmdTr = "";
                        switch($alpha){
                                case 'PREMIUM': $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium !=0 ORDER BY RAND() "; 
                                    break;
                                default: $sqlCmdTr = "SELECT * FROM businessinfo WHERE business_type='Training' AND status=1 AND  premium =0 AND  business_name LIKE '".$alpha."%' ORDER BY business_name ASC "; 
                                    break;
                        }
                        $result = MysqlSelectQuery($sqlCmdTr);
                        echo '<div id="tab'.$alpha.'">';
                        $count =1; 
                        while($rows = SqlArrays($result)){ 
                            $cmdStatus = '';
                            $logo = MysqlSelectQuery("SELECT * FROM logos WHERE user_id ='".$rows['user_id']."' AND user_id !=0");
                            $biz_logo = SqlArrays($logo);$logoNum = NUM_ROWS($logo);
                            if($logoNum > 0 && $rows['premium']>0){
                                $biz_logo = 'premium/logos/thumbs/'.$biz_logo['logos'];
			$image = '<img src="'.SITE_URL.$biz_logo.'" alt="business logo" width="50" height="50" style="margin-top:2%;" />';
                            }else{ $image = '<img src="'.SITE_URL.'images/blank.png" alt="business logo"  width="50" height="50" style="margin-top:2%;"/>';	}
                            if(!empty($rows['cmd_accr_number'])){ $cmdStatus ='<div style="margin-bottom:4px; width:200px; height:33px; background-image: url('.SITE_URL.'images/accreditation.png); background-repeat: no-repeat;"></div>'; }
                            echo '<a href="'.SITE_URL.'tprovider/'.$rows['business_id'].'/'.str_replace($title_link,"-",$rows['business_name']).'" title="'. $rows['business_name'].'"><div class="cmd-list eventListing">'.$cmdStatus.'<div style="text-align:center">'.$image.'</div><div><span class="spanTitle" style="display:block; padding:3px;">'. $rows['business_name'].'</span></div><div style="color:#000; font-size:12px; text-align:justify;"  class="description" >'.trimStringToFullWord(150, stripslashes(strip_tags($rows['description']))).' ...'.'</div><div class="trainingProviders"><span class="provider">Contact:&nbsp;</span><span class="provider_name"><span style="color:#000;">'.substr($rows['address'],0,100).'</span></span></div></div></a>';
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

<!-- end subpage -->

</div>

<?php include("tools/side-menu_new.php");?>
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
        
        if(sessionStorage.selTrainerBox == 'undefined' || sessionStorage.selTrainerBox =='' || sessionStorage.selTrainerBox ==null){
            <?php if(count($tabsIdHolder)!=0){ ?>
            $("#this-content <?php echo '#'.$tabsIdHolder[0]; ?>").slideToggle('slow'); // Show first tab's content
            <?php } ?>
        }else{
            if($("#tabs a[data-name='"+sessionStorage.selTrainerBox+"']").parents("li:first").attr('id') != "current"){ 
                $('#current').removeClass('current'); 
                $('#current').attr('id',""); 
                $("#tabs a[data-name='"+sessionStorage.selTrainerBox+"']").parents("li:first").addClass('current').attr('id', 'current');
            }
            $("#this-content #"+sessionStorage.selTrainerBox).slideToggle('slow'); // Show first tab's content
            sessionStorage.clear();
        }
        
        $('#tabs a').click(function(e) {
            e.preventDefault();
            if ($(this).closest("li").attr("id") !== "current"){              
                $("#this-content").find("[id^='tab']").hide(); // Hide all content
                $("#tabs li").attr("id",""); //Reset id's
                $(this).parent().attr("id","current"); // Activate this
                //if(typeof(Storage) !== "undefined") {
                if(typeof(Storage) !== "undefined"){
                    $("#this-content").find("[id='"+$(this).attr('data-name')+"']").show().html('<p style="text-align:center;margin-top:10px;font-size:20px"><em>loading..</em></p>');; 
                    sessionStorage.selTrainerBox = $(this).attr('data-name');
                    window.location.reload();
                } else {
                    $('#' + $(this).attr('data-name')).slideToggle('slow'); // Show content for the current tab
                }
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
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Training'}, function(data) {

$('#output_providers').html(data)


});
})
//disappears the training providers when the text box looses focus
$('#tsearch').blur(function(){
$('#output_providers').fadeOut();

})
//displays the training providers when the text box gains focus
$('#tsearch').focus(function(){
$('#output_providers').fadeIn('slow');
$('#output_providers').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader" width="20px" height="14px" /></center>')
if($(this).val() == ""){
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {queryFocus:$(this).val(),type:'Training'}, function(data) {

$('#output_providers').html(data)


});
}
else{
$.post("<?php echo SITE_URL;?>tools/searchProviders.php", {query:$(this).val(),type:'Training'}, function(data) {

$('#output_providers').html(data)


});
}
})


});
//funtion to retrieve the value from the training providers drop down
function GetProVal(elem){
var URL = $('#'+elem).attr('data');

$('#tsearch').val($('#'+elem).text());
$('#output_providers').hide();

$('#searchProvider').attr('action',URL)


}
</script>
</body>
</html>