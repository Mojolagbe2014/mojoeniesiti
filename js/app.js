var app = (function () {
		$(".mobile-show > a").click(function(e) {
			e.preventDefault();
			$(this).parent().children("ul").toggle();
		});
})();

var hamburgerToggle = (function() {
	$("#hamburger").click(function(e) {
            if (e.target.id == "showNav" || e.target.id == "menu") {
                $("#showNav").text()=='Show Menu' ? $("#showNav").text('Hide Menu') : $("#showNav").text('Show Menu');//#home .respond .testImg img

                $("#main-menu").toggleClass("mobile-hide");
            };
            
	});
})();


var searchToggle = (function() {
	$(".wrap").click(function(e) {
		$("#search_input").focus();
	});
})();

var desktopSearch = (function() {
	
});
var MenuToggle = (function() {
	$('.icon-menu').click(function () {
    if($('.menu').css("right") == '-285px'){
	    	$('.menu').animate({
	      right: '0px'
	    }, 200);

	    $('body').animate({
	      left: '-285px'
	    }, 200);
	    $("#menu-text").text("Hide Menu");
    }else {
    	$('.menu').animate({
      right: '-285px'
	    }, 200);

	    $('body').animate({
	      left: '0px'
	    }, 200);
	    $("#menu-text").text("More Menu");
    }
  });

  $('.icon-close').click(function () {
    $('.menu').animate({
      right: '-285px'
    }, 200);

    $('body').animate({
      left: '0px'
    }, 200);
    $("#menu-text").text("More Menu");
  });
})();
$(function(){
    $('.mobile-enabled').click( function(){ window.location = $(this).attr('data-href');});
});
$(document).ready(function(){
    $("#hamburger").click(function(e) {
        var _menSupprImg = $("#home .respond .testImg img");
        _menSupprImg.css('z-index') != '-1' ?  _menSupprImg.css('z-index', '-1') : _menSupprImg.css('z-index', 'auto');
    });
});
