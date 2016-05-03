// JavaScript Document

function BaseUrl(){
	var url  = 'https://www.nigerianseminarsandtrainings.com/'
	return url;
}

function GetCategoryEvents(catID){
		
	/*********** script to show the training providers on the search form **************/
		//fires up the training providers when the keboard is pressed
		$('#evtsearchCat').keyup(function(){
			$('#output_events').fadeIn('slow');
			$('#output_events').html('<center><img src="'+BaseUrl()+'images/loader.GIF" alt="loader"  /></center>')
			$.post(BaseUrl()+"tools/searchEvents.php", {query:$(this).val(),cat:catID}, function(data) {
				
				$('#output_events').html(data)
			
			
		});
	})
	//disappears the training providers when the text box looses focus
	$('#evtsearchCat').blur(function(){
		$('#output_events').fadeOut();
		
	})

}
//funtion to retrieve the value from the training providers drop down
	function GetCatVal(elem){
		var URL = $('#'+elem).attr('data');
				
		$('#evtsearchCat').val($('#'+elem).text());
		$('#output_events').hide();
		
		$('#searchform_basic').attr('action',URL)
	

			}
	