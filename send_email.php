<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cesi-test-envoie-smtp-js-php-css-html@soundco.me';
        $mail->Password   = 'H5v3yS83s4TUbr!';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 465;

        $mail->setFrom('cesi-test-envoie-smtp-js-php-css-html@soundco.me', 'cesi-test-envoie-smtp-js-php-css-html');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (!isset($_SESSION['userId'])) {
    http_response_code(401);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['uname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $body = "Nom : {$name}<br>Email : {$email}<br>Message : {$message}";

    $emailSent = sendEmail($email, $subject, $body);

    if ($emailSent) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
