<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../enrollment.php');
}

$fullName = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$city = trim($_POST['city'] ?? '');
$interest = trim($_POST['interest'] ?? '');
$preferredTime = trim($_POST['preferred_time'] ?? '');
$message = trim($_POST['message'] ?? '');

$stmt = $pdo->prepare('INSERT INTO enrollments (full_name, email, phone, city, interest, preferred_time, message) VALUES (?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$fullName, $email, $phone, $city, $interest, $preferredTime, $message]);

// Send Email
$to = 'prashant.upadhyay7080@gmail.com';
$mailSubject = "New Enrollment Request: $interest";
$mailBody = "You have received a new enrollment request from your website.\n\n" .
            "Name: $fullName\n" .
            "Email: $email\n" .
            "Phone: $phone\n" .
            "City: $city\n" .
            "Interest: $interest\n" .
            "Preferred Time: $preferredTime\n\n" .
            "Message:\n$message";
$headers = "From: noreply@sahyog.org";

@mail($to, $mailSubject, $mailBody, $headers);

redirect('../enrollment.php?sent=1');
