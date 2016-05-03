<?php
$name = $_POST['contactname'];
$email = $_POST['email'];
$comments = $_POST['message'];

// Add Email Address
$to = 'your email address';
$subject = "New message: $name";
$message .= "$name ($email)";
$message .= "\n";
$message .= "$email";
$message .= "\n";
$message .= "$comments";
$message .= "\n";
$headers = "From: $email";

mail($to, $subject, $message, $headers);

// Redirect Link
header("Location: http://www.yourwebsitegoeshere.com/");
?>