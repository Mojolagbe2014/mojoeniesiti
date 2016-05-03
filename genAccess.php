<?php
//file where to the countries ids exists
	$newFile = 'urlConfig.txt';
//read the file content
	$Content = file($newFile);
	
	//looping through the file content array
	foreach($Content as $Contents){
	//removing the => from each like of the array
	$FileContent = explode("=>",$Contents);
	$name = str_replace(".php",'',$FileContent[0]);
	echo "Redirect 301 /states/$name https://www.nigerianseminarsandtrainings.com/$name<br />";
	}
?>