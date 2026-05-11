<?php
require __DIR__ . '/../config/database.php';
require __DIR__ . '/../config/helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL)) {
    $stmt = $pdo->prepare('INSERT IGNORE INTO newsletter_subscribers (email) VALUES (?)');
    $stmt->execute([trim($_POST['email'])]);
}

redirect('../index.php?subscribed=1');
