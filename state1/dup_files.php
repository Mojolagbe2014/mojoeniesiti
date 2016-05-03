<?php
require_once("../scripts/config.php");

require_once("../scripts/functions.php");

$result =  MysqlSelectQuery("select * from states ");

$file = 'abia.php';

  while($rowsCat = SqlArrays($result)){
		  $strip = str_replace(" ","-",$rowsCat['name']);

						$final = str_replace(" ","-",$strip);
												
						$newfile = strtolower($final).".php";

					if (copy($file, $newfile)) {
    					echo "Created file: ".$newfile." <br />";
					}
  }
	
	
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
	
?>
