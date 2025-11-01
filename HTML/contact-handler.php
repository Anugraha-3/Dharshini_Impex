<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Validation
    if (empty($name) || empty($phone) || empty($email) || empty($subject)) {
        header("Location: contact4.html?status=error");
        exit();
    }
    
    // Create WhatsApp message
    $whatsapp_message = "🔔 New Contact Form Submission\n\n";
    $whatsapp_message .= "👤 Name: $name\n";
    $whatsapp_message .= "📞 Phone: $phone\n";
    $whatsapp_message .= "📧 Email: $email\n";
    $whatsapp_message .= "📋 Subject: $subject\n\n";
    $whatsapp_message .= "💬 Message:\n$message\n\n";
    $whatsapp_message .= "🕐 Time: " . date('Y-m-d H:i:s');
    
    // URL encode the message
    $encoded_message = urlencode($whatsapp_message);
    
    // WhatsApp number (replace 9698023992 with the correct WhatsApp number)
    $whatsapp_number = "919095016318";
    
    // Create WhatsApp URL
    $whatsapp_url = "https://wa.me/$whatsapp_number?text=$encoded_message";
    
    // Save to file as backup
    $backup_data = "=== CONTACT FORM SUBMISSION ===\n";
    $backup_data .= "Date: " . date('Y-m-d H:i:s') . "\n";
    $backup_data .= "Name: $name\n";
    $backup_data .= "Phone: $phone\n";
    $backup_data .= "Email: $email\n";
    $backup_data .= "Subject: $subject\n";
    $backup_data .= "Message: $message\n";
    $backup_data .= "==============================\n\n";
    
    file_put_contents('contact_submissions.txt', $backup_data, FILE_APPEND);
    
    // Redirect directly to WhatsApp
    header("Location: $whatsapp_url");
    exit();
}

// If not POST request, redirect to contact page
header("Location: contact4.html");
exit();
?>