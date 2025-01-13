<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log'); // Log errors to this file


$to = "dev1@explorelogicsit.net";
$subject = "Test Email";
$body = "
<html>
<head>
<title>Test Email</title>
</head>
<body>
<h1>This is a test email</h1>
<p>If you receive this email, your PHP mail function is working correctly.</p>
</body>
</html>
";

$headers = "MIME-Version: 1.0\r\n";
$headers .= 'From: Test <noreply@explorelogicsit.net>' . "\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "Content-Transfer-Encoding: 7bit\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-MSMail-Priority: Normal\r\n";
$headers .= "Importance: Normal\r\n";


if (mail($to, $subject, $body, $headers)) {
    echo "Test email sent successfully to $to.";
} else {
    echo "Failed to send test email.";
    $error = error_get_last();
    if ($error) {
        echo " Error details: " . $error['message'];
    }
}
?>