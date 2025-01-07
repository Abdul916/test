<?php
$postedData = '[{"id":1,"text":"Bonjour! 🎁 Découvrez combien vous pouvez économiser sur vos impôts cette année et comment préparer votre avenir financier. Cela ne prendra que 2 minutes!","type":"received","options":[{"nextId":2,"text":"Ok je veux découvrir!"},{"nextId":3,"text":"option 1"}]},{"id":2,"text":"Ok je veux découvrir!","type":"sent"},{"id":2,"text":"Super! Je suis ravi de vous aider à économiser de limpôt. Combien denfants avez-vous?","type":"received","options":[{"nextId":3,"text":"2 enfants"},{"nextId":4,"text":"3 enfants"}]},{"id":4,"text":"3 enfants","type":"sent"},{"id":4,"text":"Merci pour votre réponse. Vous pourriez économiser un montant de 2,000€. Avez-vous des questions supplémentaires?","type":"received","inputField":true,"nextId":5}]';

// $postedData = $_POST['messages'];
$messages = json_decode($postedData, true);
if (json_last_error() !== JSON_ERROR_NONE) {
	die("Invalid JSON format.");
}

$emailContent = "<h1>Questions and Answers Summary</h1><ul>";
foreach ($messages as $message) {
    if ($message['type'] == 'received') {
        $emailContent .= "<li><strong>Question: </strong>" . htmlspecialchars($message['text']) . "</li><br>";
    } elseif ($message['type'] == 'sent') {
        $emailContent .= "<span><strong>Answer: </strong>" . htmlspecialchars($message['text']) . "</span><br><br>";
    }
}

$emailContent .= "</ul>";

$to = "admin@example.com";
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
	echo "Email sent successfully.";
} else {
	echo "Failed to send email.";
}
?>