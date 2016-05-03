<?php
require_once("scripts/config.php");
require_once("scripts/functions.php");
if(connection());


$errorArray = [];
$userId = filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT) ? filter_input(INPUT_POST, 'userId', FILTER_VALIDATE_INT) : array_push($errorArray, "Empty Id");
$userName = filter_input(INPUT_POST, 'userName') ? filter_input(INPUT_POST, 'userName') : array_push($errorArray, "Empty User name");
$amount = filter_input(INPUT_POST, 'amount') ? filter_input(INPUT_POST, 'amount') : array_push($errorArray, "Empty amount ");
$transactionReference = filter_input(INPUT_POST, 'transactionReference') ? filter_input(INPUT_POST, 'transactionReference') : array_push($errorArray, "Empty transaction reference ");
$dateAdded = ' NOW() ';
$status = "Pending";


if(count($errorArray)<1){
	$sql = "INSERT INTO web_pay (user_id, user_name, transaction_reference, date_added, amount, status)
	 VALUES ('{$userId}', '{$userName}', '{$transactionReference}', $dateAdded, '{$amount}', '{$status}')";
	$logStatus = MysqlQuery($sql);
	echo $logStatus;
}
else{
	echo false;
}