<?php
require 'vendor/autoload.php';
use SendGrid\Mail\Mail;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = new Mail();
    $email->setFrom($_POST['email'], $_POST['name']);
    $email->setSubject($_POST['subject']);
    $email->addTo("anugraha2403@gmail.com", "Dharshini Impex");
    $email->addContent("text/plain", 
        "Name: {$_POST['name']}\n".
        "Phone: {$_POST['phone']}\n".
        "Message: {$_POST['message']}"
    );
    
    $sendgrid = new \SendGrid('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');
    
    try {
        $response = $sendgrid->send($email);
        header("Location: contact4.html?status=success");
    } catch (Exception $e) {
        header("Location: contact4.html?status=error");
    }
}
?>