function GetVal(a){ $("#textInput").val($("#"+a).text()); $("#output").hide();}
function GetAction(a){$.post("https://www.nigerianseminarsandtrainings.com/tools/SetUrl?url="+a,function(b){if(b=="Yes"){}});};
$(".basic a").click(function(b){$(".basic").fadeOut("slow",function(){$(".advanced").fadeIn("slow");});b.preventDefault();});
$(".advanced a").click(function(b){$(".advanced").fadeOut("slow",function(){$(".basic").fadeIn("slow");});b.preventDefault();});
$("#evtsearch").keyup(function(){$("#output_events").fadeIn("slow");$("#output_events").html('<center"><img src="https://www.nigerianseminarsandtrainings.com/images/loader.GIF" alt="loader"  /></center>').css('z-index','9999');$.post("https://www.nigerianseminarsandtrainings.com/tools/searchEvents.php",{query:$(this).val(),type:"Training"},function(b){$("#output_events").html(b);});});
$("#evtsearch").blur(function(){$("#output_events").fadeOut();});
function GetEvtVal(b){var a=$("#"+b).attr("data");$("#evtsearch").val($("#"+b).text());$("#output_events").hide();$("#searchform_basic").attr("action",a);}
$(".currency").click(function(f){f.preventDefault();var h=$(this).attr("data-id");var c=$(document).height();var g=$(window).width();$("#mask").css({width:g,height:c});$("#mask").fadeIn(1000);$("#mask").fadeTo("slow",0.8);var d=$(window).height();var b=$(window).width();$(h).css("top",d/2-$(h).height()/2);$(h).css("left",b/2-$(h).width()/2);$(h).fadeIn(2000);});$(".currency-footer #closeBoxCurr").click(function(b){b.preventDefault();$("#msgbox").fadeOut("slow");$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow");});$("#mask").click(function(){$(this).fadeOut("slow");$("#msgbox").fadeOut("slow");$(".window_currency").fadeOut("slow");});$(window).resize(function(){var d=$("#boxes .window_currency");var c=$(document).height();var f=$(window).width();$("#mask").css({width:f,height:c});var e=$(window).height();var b=$(window).width();d.css("top",e/2-d.height()/2);d.css("left",b/2-d.width()/2);});
function Close(){$("#mask").fadeOut("slow");$(".window_currency").fadeOut("slow");}
function shuffleDisplay(e,d,f){setInterval(function(){var a=$(e).get().sort(function(){return Math.round(Math.random())-0.5}).slice(0,e.length-1);$(a).hide();$(a).appendTo(a[0].parentNode).fadeIn(d)},f)}
function GetState(){
    if($("#country").val()==38){
        $('p#use-advance').css({'margin-top':'-12px'});
        $("#stateSelect").css('display','block').fadeIn("slow");
    }
    else{$("#stateSelect").fadeOut("fast");$("div.lagDivs").fadeOut("fast");$('p#use-advance').css({'margin-top':'5px'});$('#home a#use-basic').css({'top':'-5px'});}
}
function showLagosDivisions(){
    if($("#state").val()==25){
        $('div#lagMainDivs').css({'margin-top':'3px', 'display':'block'}).fadeIn("slow");
        $('#home a#use-basic').css({'top':'-45px'});
    }
    else{$("div.lagDivs").fadeOut("fast");$('#home a#use-basic').css({'top':'-5px'});}
}

$(document).ready(function(){
    $("#currency-widget").currency({localRateProvider:"https://www.nigerianseminarsandtrainings.com/api_currency.php",loadingImage:"https://www.nigerianseminarsandtrainings.com/images/img/loader.gif"});
    $(".menu_float").sticky({topSpacing:0});
    var a=$("#slider_video").mostSlider();
    $.post("https://www.nigerianseminarsandtrainings.com/tools/loadVenueProviders.php",function(b){$("#venuProviders").html(b);});
    $("#EvtTags").html("Loading....");
    $.post("tools/loadTags.php",function(a){$("#EvtTags").html(a);});
    $("#email_login").keypress(function(c){var b=$(this).val().length;
        if(b>0){$("#forgot").text("?");} else{$("#forgot").text("Forgot?");}
    });
    $("#password").keypress(function(c){var b=$(this).val().length;
        if(b>0){
            $("#password_forget").text("?");
        }else{$("#password_forget").text("Forgot?");}
    });
    $(".prompt").click(function(b){
        b.preventDefault();
        var d=$(this).attr("href");
        var g=$(document).height();
        var c=$(window).width();
        $("#mask").css({width:c,height:g});
        $("#mask").fadeIn(1000);
        $("#mask").fadeTo("slow",0.8);
        var a=$(window).height();
        var f=$(window).width();
        $(d).css("top",a/2-$(d).height()/2);
        $(d).css("left",f/2-$(d).width()/2);
        $(d).fadeIn(2000);
    });
    $(".window_currency #closeBox").click(function(a){
        a.preventDefault();
        $("#mask").fadeOut("slow");
        $(".window_currency").fadeOut("slow");
    });
    $("#mask").click(function(){ $(this).fadeOut("slow"); $(".window_currency").fadeOut("slow");});
    $(window).resize(function(){
        var a=$("#boxes .window_currency");
        var e=$(document).height();
        var c=$(window).width();
        $("#mask").css({width:c,height:e});
        var b=$(window).height();
        var d=$(window).width();
        a.css("top",b/2-a.height()/2);
        a.css("left",d/2-a.width()/2);
    });
    function Subscriber(){window.location="subscribers";}function Account(){window.location="login";}
    $(window).resize(function(){$("#clock-show").text($(window).width());});
    $("#month-picker1").monthpicker({
        changeYear:false,stepYears:1,prevText:'<i class="fa fa-chevron-left"></i>',nextText:'<i class="fa fa-chevron-right"></i>',showButtonPanel:true,dateFormat:"MM yy"
    });
    
    $("#textInput").keyup(function(){
        $("#output").fadeIn("slow");
        $("#output").html('<center><img src="https://www.nigerianseminarsandtrainings.com/images/loader.GIF" alt="loader"  /></center>');
        $.post("https://www.nigerianseminarsandtrainings.com/tools/search.php",{query:$(this).val()},function(a){$("#output").html(a);});
    });
    $("#textInput").blur(function(){$("#output").fadeOut();});
    $("#textInput").focus(function(){
        $("#output").fadeIn("slow");
        $("#output").html('<center><img src="https://www.nigerianseminarsandtrainings.com/images/loader.GIF" alt="loader" width="20px" height="14px" /></center>');
        if($(this).val()==""){$.post("https://www.nigerianseminarsandtrainings.com/tools/search.php",{queryFocus:$(this).val()},function(a){$("#output").html(a);});}
        else{$.post("https://www.nigerianseminarsandtrainings.com/tools/search.php",{query:$(this).val()},function(a){$("#output").html(a);});}
    });
    
    shuffleDisplay("div.shuffleproviders",1000,75000);shuffleDisplay("div.shufflesupplier",1000,75000);shuffleDisplay("div.shufflevenuepro",1000,75000);
    var c=250;var a=300;$(window).scroll(function(){if($(this).scrollTop()>c){$(".back-to-top").fadeIn(a);}else{$(".back-to-top").fadeOut(a);}});$(".back-to-top").click(function(d){d.preventDefault();$("html, body").animate({scrollTop:0},a);return false;});
    $("#get_news").load("https://www.nigerianseminarsandtrainings.com/tools/get_resources.php?news");
    $("#get_article").load("https://www.nigerianseminarsandtrainings.com/tools/get_resources.php?articles");
    $("#hotel").html('<a href="http://www.nsthotels.com" title="Book hotel here" target=_blank rel=nofollow"><img src="images/hotelIMG.gif" alt="book hotel" /></a>');
    $(this).dwseeTopBottomMenu();
    $('.mobile-enabled').click( function(){ window.location = $(this).attr('data-href');});
});