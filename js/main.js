// JavaScript Document

	
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto();
	});

			$(document).ready(function(){
				$(".panel a").click(function(e){
					e.preventDefault();
					var style = $(this).attr("class");
					$(".orion-menu").removeAttr("class").addClass("orion-menu").addClass(style);
				});
			});
		
			$(document).ready(function(){  
				$().orion({
					speed: 500
				});
			});
		
			$(document).ready(function(){
			$('#searchform').submit(function(){
			var keyword_val = document.getElementById("month")
					if(keyword_val.value == 'Please select month to find event'){
						keyword_val.value ='';
					}
				});
			});
			
			$(document).ready(function(){
			$('#search_site').submit(function(){
			var keyword_val = document.getElementById("query")
					if(keyword_val.value == 'Search Site...'){
						keyword_val.value ='';
					}
				});
			});
			
				jQuery(document).ready(function() {
				
					jQuery("#month").monthpicker({
						showOn:     "both",
						buttonImage: "<?php echo SITE_URL_S;?>images/calendar.png",
						buttonImageOnly: true,
						dateFormat: 'MM yy',
						prevText: 'Prev'

						});
					});
					


$(document).ready(function()
{
	$("#login-form").submit(function()
	{
		if($('#email').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#password').val() == ''){
			alert("Please enter your password");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Authenticating....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("https://www.nigerianseminarsandtrainings.com/tools/login.php",{ user_email:$('#email').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login successfull, Redirecting.....').addClass('messageboxok').fadeTo(900,1,
              function()
			  { 
			  	 //redirect to secure page
				 document.location='https://www.nigerianseminarsandtrainings.com/user/profile';
			  });
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox

			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Login Failed!').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
});


$(document).ready(function()
{
	$("#login-form2").submit(function()
	{
		if($('#name').val() == ''){
			alert("Please enter your name");
			
			return false;
		}
		else if ($('#email').val() == ''){
			alert("Please enter your email");
			
			return false;
		}
		else if ($('#message').val() == ''){
			alert("Please enter your message");
			
			return false;
		}
		else{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").removeClass().addClass('messagebox').text('Sending message....').fadeIn(1000);
		//check the username exists or not from ajax
		$.post("https://www.nigerianseminarsandtrainings.com/scripts/send.php",{ name:$('#name').val(),email:$('#email').val(),message:$('#message').val(),subject:$('#title').val(),to:$('#to').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Your message has been sent!').addClass('messageboxok').fadeTo(900,1);
			  
			});
		  }
		  else 
		  {
		  	$("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).html('Error sending message!').addClass('messageboxerror').fadeTo(900,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
		}
	});
	/*//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login-form").trigger('submit');
	});*/
	
});

	function GetAds(AdID){
		// change /examples/linkstats/ajax-linkstat.php with the path to your file
		$.post("<?php echo SITE_URL;?>tools/hit.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
				
			
			
		});
	}
	
	function GetImp(AdID){
		// change /examples/linkstats/ajax-linkstat.php with the path to your file
		$.post("<?php echo SITE_URL;?>tools/impression.php", {id:"Advert-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
	
	function GetWebClicks(AdID){
		// change /examples/linkstats/ajax-linkstat.php with the path to your file
		$.post("<?php echo SITE_URL;?>tools/WebClicks.php", {id:"Business-"+AdID}, function(data) {
				if(data == 'Yes'){
					//document.getElementById("test").innerHTML = data;
					//window.location = url; // needed for safari 4.0.5
				
				}
		});
	}
