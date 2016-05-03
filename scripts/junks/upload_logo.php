<?php
session_start();
require_once("config.php");
require_once("functions.php");
if(connection());
$upload_result = 2;

							 
?>
<script language="javascript" type="text/javascript">
window.top.window.stopUpload(<?php echo $upload_result;?>);
</script> 