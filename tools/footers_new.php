<div style="text-align:center;margin-bottom:3%;margin-top:3%;">
<a class="cssButton_roundedLow cssButton_aqua" href="javascript:;" style="padding:7px; font-size:14px; color:#FFF;" rel="nofollow" title="Go Back" onclick="window.history.back();"><i class="fa fa-backward" style="font-size:16px;"></i></a>
<a class="cssButton_roundedLow cssButton_aqua" href="javascript:;" style="padding:7px; font-size:14px; color:#FFF;" rel="nofollow" title="Go Forward" onclick="window.history.forward();"><i class="fa fa-forward" style="font-size:16px;"></i></a>
</div>
<footer>
<div id="footer_content">
<div id="footer">
    <?php include('upper-footer.php'); ?>
<div class="menu_container menu_footer" style="background-color:#33454E; border:none;">
<div style="width:70%; margin-left:auto;">

</div>
<div class="clearfix"></div>
</div>
<div class="copyright">
	<p>Copyright &copy; 2010 - <?php echo date("Y");?> Nigerian Seminars and Trainings.com |&nbsp;&nbsp; </p>
	<p class="respond">
	<a href="<?php echo SITE_URL;?>terms-of-use" title="Terms of Use">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	<a href="<?php echo SITE_URL;?>privacy-policy" title="Privacy Policy">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
	</p>
<!--<span  style="margin-top:20px" id="siteseal" class="respond"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=nwcOWiZo9Yn2nKbAHKSrh2qlvYHiiVifDQNXkWI18aKqthDBJZDgSZn"></script></span>-->
    <a href="https://play.google.com/store/apps/details?id=com.kaisteventures.nigerianseminars&hl=en" target="_blank" rel="nofollow"><img src="<?php echo SITE_URL;?>/images/googleplay.jpg" alt="Nigerian Seminars App" style="margin-right: 10px;height:50%;margin-top:10px;"></a>
<img src="<?php echo SITE_URL;?>images/interswitch.png" alt="payment method" style="height:50%; margin-right: 10px;">
<img src="<?php echo SITE_URL;?>images/paypal_accepted.jpg" alt="paypal accepted" style="height:50%; width:150px; margin-right:10px" />
</div>
</div>
<div class="footer_nav"> </div>
</div>
</footer>
<?php if (!strpos($_SERVER['SCRIPT_NAME'],'subscribers.php') && !strpos($_SERVER['SCRIPT_NAME'],'add-event.php') && !strpos($_SERVER['SCRIPT_NAME'],'vacancies.php') && !strpos($_SERVER['SCRIPT_NAME'],'upload-business-info.php')&& !strpos($_SERVER['SCRIPT_NAME'],'webVacancies.php') && !strpos($_SERVER['SCRIPT_NAME'],'profile.php') && !strpos($_SERVER['SCRIPT_NAME'],'article-submission.php') && !strpos($_SERVER['SCRIPT_NAME'],'authorPage.php') && !strpos($_SERVER['SCRIPT_NAME'],'fullArticle.php')&& !strpos($_SERVER['SCRIPT_NAME'],'profile.php')&& !strpos($_SERVER['SCRIPT_NAME'],'contact-us.php') && !strpos($_SERVER['SCRIPT_NAME'],'my-calendar.php') && !strpos($_SERVER['SCRIPT_NAME'],'edit_event.php')){?>
<script type=text/javascript src="https://www.nigerianseminarsandtrainings.com/min/f=js/jquery-1.10.1.min.js,css/smartforms/js/jquery-ui-1.10.4.custom.min.js,css/smartforms/js/jquery-ui-monthpicker.min.js"></script>
<!--<script type="text/javascript" src="<?php //echo SITE_URL;?>js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php //echo SITE_URL;?>css/smartforms/js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="<?php //echo SITE_URL;?>css/smartforms/js/jquery-ui-monthpicker.min.js"></script>-->
<?php } ?>
<script type=text/javascript src="https://www.nigerianseminarsandtrainings.com/min/f=css/menu/js/orion-menu.js,js/jquery.sticky.js,js/tooltipsy.min.js,js/eventCategory.js,js/jquery.zweatherfeed.min.js,js/contact-form.js,js/scroller.js"></script>
<!--<script type="text/javascript" src="<?php //echo SITE_URL;?>css/menu/js/orion-menu.js"></script>
<script src="<?php //echo SITE_URL;?>js/jquery.sticky.js" type="text/javascript"></script>
<script src="<?php //echo SITE_URL;?>js/tooltipsy.min.js" type="text/javascript"></script>
<script src="<?php //echo SITE_URL;?>js/eventCategory.js" type="text/javascript"></script>
<script src="<?php //echo SITE_URL;?>js/jquery.zweatherfeed.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php //echo SITE_URL;?>js/contact-form.js"></script>
<script type="text/javascript" src="<?php //echo SITE_URL;?>js/scroller.js"></script>-->
<script>
$(document).ready(function(){
/*Works for the category auto complete search*/
GetCategoryEvents(<?php echo @$_GET['category'];?>);
//scroll to top code
var offset = 250; var duration = 300;
$(window).scroll(function() { if ($(this).scrollTop() > offset) { $('.back-to-top').fadeIn(duration); } else { $('.back-to-top').fadeOut(duration); } });
$('.back-to-top').click(function(event) { event.preventDefault(); $('html, body').animate({scrollTop: 0}, duration); return false; }); });
</script>
<script type="text/javascript">
$('#hotelbanner').html('<a href="http://www.nsthotels.com" title="Book hotel here" rel="nofollow" target="_blank"><img src="<?php echo SITE_URL; ?>images/hotelIMG.gif" alt="book hotel" /></a>');
$(document).ready(function () { $('#weather').weatherfeed(['NIXX0012'], { refresh: 1 }); });
</script>
<script> $(document).ready(function(){ $(".menu_container").sticky({topSpacing:0}); }); </script> 
<script type="text/javascript">
function Subscriber(){ window.location='<?php echo SITE_URL;?>subscribers'; } function Account(){ window.location='<?php echo SITE_URL;?>login'; }
//script for the search calender
$(function() { $("#month-picker1").monthpicker({ changeYear: false, stepYears: 1, prevText: '<i class="fa fa-chevron-left"></i>', nextText: '<i class="fa fa-chevron-right"></i>', dateFormat: 'MM yy', showButtonPanel: true }); });	
/**************** function to show the state when nigeria is selected in the countries dropdown*************/
function GetState(){ if($('#country').val() == 38){ $('#stateSelect').fadeIn('slow'); } else{ $('#stateSelect').fadeOut('slow'); } }
/**************************** script for the links that loads in the tabs ***********************/
//TabsLinks //category
$(document).ready(function(){ $.post("<?php echo SITE_URL;?>tools/category_new.php", {query:'category'}, function(data) { $('#categoryTab').html(data); });
//Event Location Tab
$.post("<?php echo SITE_URL;?>tools/event_location.php", {query:'category'}, function(data) { $('#eventLocTab').html(data) });
//Event Location Nigeria Tab
$.post("<?php echo SITE_URL;?>tools/event_location_nigeria.php", {query:'category'}, function(data) { $('#eventLocNigTab').html(data); });
//Category Training Tab
$.post("<?php echo SITE_URL;?>tools/category_new_training.php", {query:'category'}, function(data) { $('#categoryTrainingTab').html(data); });
//Category Training Tab
$.post("<?php echo SITE_URL;?>tools/event_location_training.php", {query:'category'}, function(data) { $('#eventLocTraining').html(data); });
//Event Location Training Nigeria Tab
$.post("<?php echo SITE_URL;?>tools/event_location_nigeria_training.php", {query:'category'}, function(data) { $('#eventLocNigTraining').html(data); });
});
/*********** script to show the training providers on the search form **************/
//fires up the training providers when the keboard is pressed
$('#textInput').keyup(function(){
$('#output').fadeIn('slow');
$('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image"  /></center>');
$.post("<?php echo SITE_URL;?>tools/search.php", {query:$(this).val()}, function(data) { $('#output').html(data); }); });
//disappears the training providers when the text box looses focus
$('#textInput').blur(function(){ $('#output').fadeOut(); });
//displays the training providers when the text box gains focus
$('#textInput').focus(function(){ $('#output').fadeIn('slow'); $('#output').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image" width="20px" height="14px" /></center>');
if($(this).val() == ""){ $.post("<?php echo SITE_URL;?>tools/search.php", {queryFocus:$(this).val()}, function(data) { $('#output').html(data); }); }
else{ $.post("<?php echo SITE_URL;?>tools/search.php", {query:$(this).val()}, function(data) { $('#output').html(data);}); } });
//funtion to retrieve the value from the training providers drop down
function GetVal(elem){ $('#textInput').val($('#'+elem).text()); $('#output').hide(); }
/*********** script to show the training providers,event managers, suppliers and venues page **************/
//fires up the training providers when the keboard is pressed
$('#search_provider').keyup(function(){ $('#outputTprovider').fadeIn('slow'); $('#outputTprovider').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image"  /></center>'); $.post("<?php echo SITE_URL;?>tools/search_providers.php", {query:$(this).val(), type:$('#biz_type').val()}, function(data) { $('#outputTprovider').html(data); }); });
//disappears the training providers when the text box looses focus
$('#search_provider').blur(function(){ $('#outputTprovider').fadeOut(); });
//displays the training providers when the text box gains focus
$('#search_provider').focus(function(){
$('#outputTprovider').fadeIn('slow');
$('#outputTprovider').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image" width="20px" height="14px" /></center>')
if($(this).val() == ""){
$.post("<?php echo SITE_URL;?>tools/search_providers.php", {queryFocus:$(this).val(), type:$('#biz_type').val()}, function(data) { $('#outputTprovider').html(data); }); } else{ $.post("<?php echo SITE_URL;?>tools/search_providers.php", {query:$(this).val(), type:$('#biz_type').val()}, function(data) { $('#outputTprovider').html(data); }); } }); 
//funtion to retrieve the value from the training providers drop down
function GetValProvider(elem){ $('#search_provider').val($('#'+elem).text()); $('#outputTprovider').hide(); }
//this function records the clicks on the adverts
function GetAds(AdID){ $.post("<?php echo SITE_URL;?>tools/hit.php", {id:"Advert-"+AdID}, function(data) {
if(data == 'Yes'){ //document.getElementById("test").innerHTML = data; window.location = url; // needed for safari 4.0.5
} }); }
//get current action
function GetAction(type){
$.post("<?php echo SITE_URL;?>tools/SetUrl.php?url="+type, function(data) { if(data == 'Yes'){ //document.getElementById("test").innerHTML = data; //window.location = url; // needed for safari 4.0.5
 } }); }
// orion-menu menu script

//google script for the google+ 1
(function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/plusone.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })();
// over lay pop up controler
$(document).ready(function() {	
//select all the a tag with name equal to modal
$('.prompt').click(function(e) { e.preventDefault(); var id = $(this).attr('href'); var maskHeight = $(document).height();
var maskWidth = $(window).width();
//Set heigth and width to mask to fill up the whole screen
$('#maskLog').css({'width':maskWidth,'height':maskHeight});
//transition effect		
$('#maskLog').fadeIn(1000); $('#maskLog').fadeTo("slow",0.8);	
//Get the window height and width
var winH = $(window).height(); var winW = $(window).width();
//Set the popup window to center
$(id).css('top',  winH/2-$(id).height()/2); $(id).css('left', winW/2-$(id).width()/2); $(id).fadeIn(2000);  });
//if close button is clicked
$('.window_currency .close').click(function (e) { e.preventDefault(); $('#maskLog').fadeOut('slow'); $('.window_currency').fadeOut('slow'); });		
$('#maskLog').click(function () { $(this).fadeOut('slow'); $('.window_currency').fadeOut('slow'); });			
$(window).resize(function () { var box = $('#boxes .window_currency'); var maskHeight = $(document).height(); var maskWidth = $(window).width();
$('#maskLog').css({'width':maskWidth,'height':maskHeight}); var winH = $(window).height(); var winW = $(window).width(); box.css('top',  winH/2 - box.height()/2); box.css('left', winW/2 - box.width()/2); });
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
/*********** script to show the training providers on the search form **************/
//fires up the training providers when the keboard is pressed
$('#evtsearch').keyup(function(){ $('#output_events').fadeIn('slow'); $('#output_events').html('<center><img src="<?php echo SITE_URL;?>images/loader.GIF" alt="loader image"  /></center>');
$.post("<?php echo SITE_URL;?>tools/searchEvents.php", {query:$(this).val(),type:'Training'}, function(data) { $('#output_events').html(data); }); });
//disappears the training providers when the text box looses focus
$('#evtsearch').blur(function(){ $('#output_events').fadeOut(); });
});
//funtion to retrieve the value from the training providers drop down
function GetEvtVal(elem){ var URL = $('#'+elem).attr('data'); $('#evtsearch').val($('#'+elem).text()); $('#output_events').hide(); $('#searchform_basic').attr('action',URL); }
$(document).ready(function(e) { $('.basic a').click(function(e) { $('.basic').fadeOut('slow',function(){ $('.advanced').fadeIn('slow'); });
e.preventDefault(); }); }); $(document).ready(function(e) { $('.advanced a').click(function(e) { $('.advanced').fadeOut('slow',function(){ $('.basic').fadeIn('slow'); }); e.preventDefault(); });
});
function GetState(){
    if($("#country").val()==38){
        $('p#use-advance').css({'margin-top':'-22px'});
        $("#stateSelect").css('display','block').fadeIn("slow");
    }
    else{$("#stateSelect").fadeOut("fast");$("div.lagDivs").fadeOut("fast");$('p#use-advance').css({'margin-top':'0px'});$('a#use-basic').css({'top':'0px', 'position':'relative'});}
}
function showLagosDivisions(){
    if($("#state").val()==25){
        $('div#lagMainDivs').css({'margin-top':'3px', 'display':'block'}).fadeIn("slow");
        $('a#use-basic').css({'top':'-45px', 'position':'relative'});
    }
    else{$("div.lagDivs").fadeOut("fast");$('a#use-basic').css({'top':'0px', 'position':'relative'});}
}
function getLagosSubDivions(division, selector){
    $(selector).closest('div').css({'margin-top':'3px', 'display':'block'}).fadeIn("slow");
    $.post("<?php echo SITE_URL; ?>tools/countries.php", {LagosSubDivisons: division}, function(data) {
        $(selector).html(data);
    });
}
</script> 
<script type="text/javascript">function url_location(a){window.location=a}</script>
<script type="text/javascript">$(document).ready(function() {$(this).dwseeTopBottomMenu()})</script>
<script async src="<?php echo SITE_URL?>/js/app.js?<?php echo time(); ?>"></script>
<script src="<?php echo SITE_URL;?>/js/dwsee.top.bottom.menu.min.js" ></script>
</div>