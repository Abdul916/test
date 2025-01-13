<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);
if (!isset($data['email']) || !isset($data['messages'])) {
    echo json_encode(['msg' => 'error', 'response' => 'Invalid request.']);
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
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = false;
    $mail->Port = 25;
    $mail->setFrom('noreply@explorelogicsit.net', 'Explore Logics');
    $mail->addAddress('dev1@explorelogicsit.net', 'Explore Logics');
    $mail->isHTML(true);
    $mail->Subject = 'New Messages Summary';
    $mail->Body    = $emailContent;
    $mail->send();
    echo json_encode(['msg' => 'success', 'response' => 'Data successfully submitted.']);
} catch (Exception $e) {
    echo json_encode(['msg' => 'error', 'response' => "Submission failed. Please try again. Error: {$mail->ErrorInfo}"]);
}
