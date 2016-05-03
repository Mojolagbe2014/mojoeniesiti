<?php
require_once("../../scripts/config.php");
require_once("../../scripts/functions.php");

// Query String for selecting all articles using id
$result =  MysqlSelectQuery("SELECT * FROM articles ");

// Full Article Sample file
$sampleFile = 'sample-article.php';

//Loop through the article_ids 
while($rows = SqlArrays($result)){
	//this gets the characters 0 to the period and stores it in $newFile
    $newFile = substr(trim($rows['article_title']), 0, 49);	
	$newFile = str_replace(" ", "000", $newFile);
	//Remove special Characters
	$newFile = preg_replace("/[^A-Za-z0-9\-]/","", $newFile);
	//Replace spaces with dash/hyphen
	$newFile = str_replace("000", "-", $newFile);
	$newFile = str_replace("--", "-", $newFile);
	//Covert d name to lowercase
	$newFile = strtolower($newFile.".php");
		
	//copy d sample file
	if (copy($sampleFile, $newFile)) {
		
		//Open the copied file
		$data = file_get_contents($newFile);
		
		//Replace '[fetched-id]' string with the article_id
		$newdata = str_replace("'[fetched-id]'", $rows['article_id'], $data);
		$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		$newdata = str_replace("[metadescription]", substr(strip_tags($rows['article_description']),0,130)."-".$rows['article_id'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		//$newdata = str_replace("[headtitle]", $rows['article_title'], $data); 
		
		
		
		
		
		//Put the edited content back into d file
		file_put_contents($newFile, $newdata);
		
		//Sso success message
		echo "Created id: ". $rows['article_id']."<br/>"; 
	}
}
?>
