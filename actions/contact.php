<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../index.php#contact');
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$stmt = $pdo->prepare('INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)');
$stmt->execute([$name, $email, $phone, $subject, $message]);

// Send Email
$to = 'prashant.upadhyay7080@gmail.com';
$mailSubject = "New Contact Message: $subject";
$mailBody = "You have received a new message from your website contact form.\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n\n" .
            "Message:\n$message";
$headers = "From: noreply@sahyog.org";

@mail($to, $mailSubject, $mailBody, $headers);

redirect('../index.php?message=sent#contact');
