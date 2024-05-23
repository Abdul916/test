<?php
// Verify reCAPTCHA response
if (isset($_POST)) {
    $recaptcha_secret = "6Lc0juInAAAAAO1GTmJg0L4QSjdn3KPoOOn6D6TT";
    $recaptcha_response = $_POST['recaptcha-response'];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
    $response_data = json_decode($response);

    if (!$response_data->success) {
        echo json_encode( array('msg' => 'error', 'response' => 'Oops! Something went wrong. Please reload the page and try again.') );
        exit;
    }

    $name = $_POST['complete_name'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone_no'];
    $consult_method = $_POST['consult_method'];
    if(empty($name) || empty($email) || empty($phone) || empty($consult_method)) {
        echo 'fail 1'; exit;
    }


    $subject = "New Quote Request";
    // $to = "dev.mwaqas@gmail.com";
    $to = "<info@explorelogics.com>, <yaseen3327095758@gmail.com>";

    $message = 'Name: '.$name."\r\n".'Email: '.$email."\r\n".'Phone: '.$phone."\r\n".'Preferred Consult Method: '.$consult_method;
    $from = "<noreply@explorelogics.com>";

    $headers = "From: Request Quote " . $from;
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "X-Priority: 3\r\n";
    $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode( array('msg' => 'success', 'response' => 'Email successfully sent. We will be in touch with you shortly. Thanks.') );
        exit;
    } else {
        echo json_encode( array('msg' => 'error', 'response' => 'Sorry, an error occurred while a sending message, Please try again.') );
        exit;
    }
    
}?>