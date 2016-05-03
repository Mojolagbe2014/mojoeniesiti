<?php
session_start();
require_once("scripts/config.php");
require_once("scripts/functions.php");
session_destroy();

header("location: ".SITE_URL);
?>