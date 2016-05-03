// JavaScript Document
function BaseUrl(){
	var url  = 'http://localhost/nigerianseminars/'
	return url;
}
//loads individual provider images on events
			var items;
			var StrippedString;
			items = $('#loadEvent .respond').toArray();
			for(var i = 0; i < items.length; i++){
				StrippedString = items[i].innerHTML.replace(/(<([^>]+)>)/ig,'');
				
				GetTrainingImage(StrippedString);
			}
			function GetTrainingImage(id){
				$.post(BaseUrl()+"tools/t_providerImg.php?imgID="+id,function(data) {
				$('#'+id).html(data);
				//alert(data)
				});
			}