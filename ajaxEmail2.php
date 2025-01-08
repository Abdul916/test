<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
if (!isset($data['email']) || !isset($data['messages'])) {
    echo json_encode(['msg' => 'error', 'response' => 'Invalid input data.']);
    exit;
}

$userEmail = htmlspecialchars($data['email']);
$messages = $data['messages'];

$emailContent = "<h1>Questions and Answers Summary</h1>";
$emailContent .= "<p><strong>Form submitted by: </strong>" . $userEmail . "</p>";
$emailContent .= "<ul>";
foreach ($messages as $message) {
    if (isset($message['type']) && isset($message['text'])) {
        if ($message['type'] === 'received') {
            $emailContent .= "<li><strong>Question: </strong>" . htmlspecialchars($message['text']) . "</li>";
        } elseif ($message['type'] === 'sent') {
            $emailContent .= "<li><strong>Answer: </strong>" . htmlspecialchars($message['text']) . "</li>";
        }
    }
}
$emailContent .= "</ul>";

$to = "dev1@explorelogicsit.net";
$subject = "New Messages Summary";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: noreply@explorelogicsit.net\r\n";
$headers .= "Content-Transfer-Encoding: 7bit\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-MSMail-Priority: Normal\r\n";
$headers .= "Importance: Normal\r\n";

if (mail($to, $subject, $emailContent, $headers)) {
    echo json_encode(['msg' => 'success', 'response' => 'Email sent successfully.']);
} else {
    echo json_encode(['msg' => 'error', 'response' => 'Something went wrong. Failed to send email.']);
}

?>