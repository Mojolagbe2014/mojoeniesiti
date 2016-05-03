$(document).ready(function(){
	//Examples of how to assign the ColorBox event to elements
	$("a[rel='example1']").colorbox();
	$("a[rel='example2']").colorbox({transition:"fade"});
	$("a[rel='example3']").colorbox({transition:"none", width:"75%", height:"75%"});
	$("a[rel='example4']").colorbox({slideshow:true});
	$(".single").colorbox({}, function(){
		alert('Howdy, this is an example callback.');
	});
	$(".colorbox").colorbox();
	$(".youtube").colorbox({iframe:true, width:650, height:550});
	$(".iframe").colorbox({width:"80%", height:"80%", iframe:true});
	$(".inline").colorbox({width:"50%", inline:true, href:"#inline_example1"});

	//Example of preserving a JavaScript event for inline calls.
	$("#click").click(function(){ 
		$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
		return false;
	});
});

/*$(function() {
    $('#slideshow').cycle({
        fx:     'fade',
        speed:  'slow',
        timeout: 0,
        pager:  '#slider_nav',
        pagerAnchorBuilder: function(idx, slide) {
            // return sel string for existing anchor
            return '#slider_nav li:eq(' + (idx) + ') a';
        }
    });
});*/

$(function() {
    $('#featured_items').cycle({
        fx:     'scrollHorz',
		easing: 'backinout',
        timeout: 0,
        pager:  '.content_nav',
        cleartypeNoBg:  true,
        pagerAnchorBuilder: function(idx, slide) {
            return '.content_nav li:eq(' + (idx) + ') a';
        }
    });
});

$(function() {
    $('#latest_content_items').cycle({
        fx:     'scrollHorz',
		easing: 'backinout',
        timeout: 0,
        pager:  '.content_nav1',
        cleartypeNoBg:  true,
        pagerAnchorBuilder: function(idx, slide) {
            return '.content_nav1 li:eq(' + (idx) + ') a';
        }
    });
});

$(function() {
    $('#popular_content_items').cycle({
        fx:     'scrollHorz',
		easing: 'backinout',
        timeout: 0,
        pager:  '.content_nav2',
        cleartypeNoBg:  true,
        pagerAnchorBuilder: function(idx, slide) {
            return '.content_nav2 li:eq(' + (idx) + ') a';
        }
    });
});

$(function() {
    $('#staff_content_items').cycle({
        fx:     'scrollHorz',
		easing: 'backinout',
        timeout: 0,
        pager:  '.content_nav3',
        cleartypeNoBg:  true,
        pagerAnchorBuilder: function(idx, slide) {
            return '.content_nav3 li:eq(' + (idx) + ') a';
        }
    });
});

$(function() {
    $('#tab_slider').cycle({
        fx:     'fade',
        speed:  'fast',
        timeout: 0,
        pager:  '#main_content_slider',
        cleartypeNoBg:  true,
        pagerAnchorBuilder: function(idx, slide) {
            return '#main_content_slider li:eq(' + (idx) + ') a';
        }
    });
});

$(function() {
    $('#news_rotator').cycle({
        fx:     'fade',
        speed:  'fast',
        pause: 1,
        timeout: 5000,
        containerResize: 1
    });
});