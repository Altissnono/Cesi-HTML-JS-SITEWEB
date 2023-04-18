<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['username']) && isset($data['email']) && isset($data['subject']) && isset($data['message'])) {
    $username = $data['username'];
    $email = $data['email'];
    $subject = $data['subject'];
    $message = $data['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'cesi-test-envoie-smtp-js-php-css-html@soundco.me';
        $mail->Password = 'g4A4mzrB3Fc82N!';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 465;

        $mail->setFrom('cesi-test-envoie-smtp-js-php-css-html@soundco.me', 'Your Name');
        $mail->addAddress('recipient.email@example.com', 'Recipient Name');

        $mail->isHTML(false);
        $mail->Subject = "[Formulaire de contact] $subject";
        $mail->Body = "Nom d'utilisateur: $username\nEmail: $email\nSujet: $subject\nMessage: $message";

        $mail->send();
        http_response_code(200);
    } catch (Exception $e) {
        http_response_code(500);
        echo 'Erreur lors de l\'envoi du message : ', $mail->ErrorInfo;
    }
} else {
    http_response_code(400);
    echo 'Les données du formulaire sont incomplètes.';
}
