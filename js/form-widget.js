// JavaScript Document
(function(){
	var jQuery;
	var site_url = "https://www.nigerianseminarsandtrainings.com/";
	if(window.jQuery === undefined || window.jQuery.fn.jquery !== '1.4.2'){
		var script = document.createElement('script');
		script.setAttribute("type","text/javascript");
		script.setAttribute("src","http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
		if(script.readyState){
			 script.onreadystatechange = function () { // For old versions of IE
         		 if (this.readyState == 'complete' || this.readyState == 'loaded') {
              		scriptLoadHandler();
         		 }
      		};
		}
			else { // Other browsers
      		script.onload = scriptLoadHandler;
   		 }
		  (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(script);
	}
		else {
    // The jQuery version on the window is the one we want to use
    	jQuery = window.jQuery;
   		main();
	}
	
	
	/******** Called once jQuery has loaded ******/
	function scriptLoadHandler() {
    // Restore $ and window.jQuery to their previous values and store the
    // new jQuery in our local jQuery variable
   		 jQuery = window.jQuery.noConflict(true);
    // Call our main function
   		 main(); 
	}

	/******** Our main function ********/
	function main() { 
   		 jQuery(document).ready(function($) { 
		 
		 //create and insert css
		 var css = $("<link>",{
				rel: "stylesheet",
				href: site_url+"css/smartforms/css/smart-forms.css",
				type: "text/css",
			});
			css.appendTo('head');
		
        // load the form
		$.ajax({
			url: "tools/widget/widget.php",
		 dataType: 'jsonp',
			success: function(data){
				$('#NST_Widget').html(data)
			}
			});
			
			
    	});	
		

	}
})();