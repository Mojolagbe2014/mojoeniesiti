<?php
require_once("../../scripts/config.php");

require_once("../../scripts/functions.php");

$result =  MysqlSelectQuery("select * from lagos_divisions ");

$file = 'agege.php';

$newFile = 'urlConfig.txt';
$fh = fopen($newFile,'w');
/*ftruncate($fh,0);
fclose($fh);*/
  while($rowsCat = SqlArrays($result)){
		  $strip = str_replace($title_link,"-",$rowsCat['name']);

						$final = str_replace("--","-",$strip);
												
						$newfile = strtolower($final).".php";
						$file_content = strtolower($final).".php=>".$rowsCat['id'];
					if (copy($file, $newfile)) {
						
						//fwrite($fh,$file_content."\n");
						
    					echo "Created file: ".$rowsCat['name']." => ".$newfile." <br />";
						
					}
  }
	fclose($fh);
	
/*$Content = file($newFile);
foreach($Content as $Contents){
	$FileContent = explode("=>",$Contents);
	echo $FileContent[0]." => ".$FileContent[1]."<br />";
}*/
	
	/*if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
			
			$path_parts = pathinfo($entry);
			
			$ext = $path_parts['extension'];
			
			if($ext == 'php')
            echo "$entry <br />";
        }
    }

    closedir($handle);
}*/
		/*if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
			
			$path_parts = pathinfo($entry);
			
			$ext = $path_parts['extension'];
			
			if($entry != 'dup_files.php')
           unlink ($entry);
		   
        }
    }

    closedir($handle);
}*/
?>
