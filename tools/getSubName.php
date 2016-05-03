<?php
include("../scripts/config.php");
connection ();
        if(isset($_POST['email'])){
	$email=$_POST['email'];


$query5="select lname,fname from subscribers where email='$email'";

$result=mysql_query($query5);
$rows=mysql_fetch_array($result);
echo $rows['fname']." ".$rows['lname'];

		}

?>