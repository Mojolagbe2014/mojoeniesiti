<?php
echo phpinfo();

$file = "php.ini"; 									/* Name of the final file you want to create */
$handle = fopen($file, 'w'); 							/* open (clean) / create the file 'php5.ini' */
$vData = file_get_contents('/usr/local/lib/' . $file); 		/* Replace '/web/conf/' to '/your/path/here' if this does not work by default. */
fwrite($handle, $vData);  								/* write the contents of Godaddy's php5.ini to your php5.ini file */
print "File Saved!";  									/* Tell you it's saved (sorry didn't test for exceptions) */
fclose($handle); 