/*'contactname=' + name.val() + '&email='+email.val() + '&comment=' + message.val() +'&phone=' + telephone.val() + '&company=' + company.val() + '&code='+ security.val()*/
function Url(){
	var url  = 'https://www.nigerianseminarsandtrainings.com/'
	return url;
}

function ChangeCaptcha(){
					$("#captcha_contact").attr("src",Url()+"tools/captcha.php?r=" + Math.random());
}

$('.captcode').click(function(e){
					e.preventDefault();
					ChangeCaptcha();
	});
				
    	$("#feedback_button").click(function(){
    		$('.form').slideToggle(); 
			$(this).hide();  		
    	});
		
		function OpenContactForm(){
    		$('.form').slideToggle();
			$("#feedback_button").show();   		
    	
		}
    
    	$('#contact-form').submit(function(){
    			var name = $('#contact_name');
				var email = $('#email_contact');
				var telephone = $('#phone_contact');
				var company = $('#company_contact');
				var message = $('#comment_contact');
			
				var security = $('#securitycode_contact2');
				
    			$("#msgbox").removeClass('alert-success alert-error ').addClass('alert-info').html('<i class="fa fa-refresh fa-spin"></i> Sending mail...').fadeIn(1000)
    			
    			$.ajax({  
    				type: "POST",  
      			  	url: Url()+"tools/process-mail-contact.php",  
      			  	data: $(this).serialize(),  
	      			success: function(result,status) { 
	      				//email sent successfully displays a success message
	      				if(result == 'email issue'){
	      					$("#msgbox_contact").removeClass('alert-success alert-info ').addClass('alert-error').html('Invalid email entered').fadeIn(1000)
	      				} else if(result == 'security code') {
	      					$("#msgbox_contact").removeClass('alert-success alert-info ').addClass('alert-error').html('Invalid security code').fadeIn(1000)
	      				}
						else if(result == 'success') {
							name.val('')
							company.val('')
							email.val('')
							security.val('')
							telephone.val('')
							message.val('');
	      					$("#msgbox_contact").removeClass('alert-error alert-info ').addClass('alert-success').html('<i class="fa fa-check "></i> Thank you for contacting us!').fadeIn(1000)
	      				}
						else{
							alert(result);
						}
	      			},
	      			error: function(result,status){
	      				$("#msgbox_contact").removeClass('alert-success alert-info').addClass('alert-error').html('<i class="fa fa-times "></i> Failed to send').fadeIn(1000)
	      			}  
      			});
		
			return false;
    	});

