<?php 
$to = 'micevski.kosta@gmail.com';
$subject = 'From ' . $_POST["name"] ;
$message = $_POST["message"];

$headers .= 'From:' . $_POST["email"] . "\r\n";

mail($to, $subject, $message, $headers);

?>